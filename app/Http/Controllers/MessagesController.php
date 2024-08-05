<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;
use App\Models\User;
use App\Models\ChMessage as Message;
use App\Models\ChFavorite as Favorite;
use App\Models\ChChannel as Channel;
use Chatify\Facades\ChatifyMessenger as Chatify;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client as GuzzleHttp;

class MessagesController extends Controller
{
  protected $perPage = 30;

  /**
   * Authenticate the connection for pusher
   *
   * @param Request $request
   * @return JsonResponse
   */
  public function pusherAuth(Request $request)
  {
    return Chatify::pusherAuth($request->user(), Auth::user(), $request['channel_name'], $request['socket_id']);
  }

  /**
   * Returning the view of the app with the required data.
   *
   * @param int $id
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function index($id = null)
  {
    $messenger_color = Auth::user()->messenger_color;
    return view('Chatify::pages.app', [
      'id' => $id ?? 0,
      'messengerColor' => $messenger_color ? $messenger_color : Chatify::getFallbackColor(),
      'dark_mode' => Auth::user()->dark_mode < 1 ? 'light' : 'dark',
    ]);
  }

  /**
   * Fetch data (user, favorite.. etc).
   *
   * @param Request $request
   * @return JsonResponse
   */
  public function idFetchData(Request $request)
  {
    $favorite = Chatify::inFavorite($request['id']);
    $fetch = User::where('id', $request['id'])->first();
    if ($fetch) {
      $userAvatar = Chatify::getUserWithAvatar($fetch)->avatar;
    }

    $infoHtml = view('Chatify::layouts.info')->render();

    return Response::json([
      'infoHtml' => $infoHtml,
      'favorite' => $favorite,
      'fetch' => $fetch ?? null,
      'user_avatar' => $userAvatar ?? null,
    ]);
  }

  /**
   * Fetch data (user, favorite.. etc).
   *
   * @param Request $request
   * @return JsonResponse
   */
  public function groupFetchData(Request $request)
  {
    $fetch = null;
    $channel_avatar = null;

    $favorite = '';
    // $favorite = Chatify::inFavorite($request['channel_id']);
    $channel = Channel::find($request['channel_id']);

    if (!$channel) {
      return Response::json([
        'message' => "This chat channel doesn't exist!",
      ]);
    }

    $allow_loading =
      $channel->owner_id === Auth::user()->id ||
      in_array(
        Auth::user()->id,
        $channel
          ->users()
          ->pluck('users.id')
          ->all()
      );
    if (!$allow_loading) {
      return Response::json([
        'message' => "You haven't joined this chat channel!",
      ]);
    }

    // check if this channel is a group
    if (isset($channel->owner_id)) {
      $fetch = $channel;
      $channel_avatar = Chatify::getChannelWithAvatar($channel)->avatar;
    } else {
      $fetch = Chatify::getUserInOneChannel($request['channel_id']);
      if ($fetch) {
        $channel_avatar = Chatify::getUserWithAvatar($fetch)->avatar;
      }
      $channel_avatar = Chatify::getChannelWithAvatar($channel)->avatar;
    }

    $fetch = $channel;
    $channel_avatar = Chatify::getChannelWithAvatar($channel)->avatar;

    $infoHtml = view('Chatify::layouts.info-group', [
      'channel' => $channel,
    ])->render();

    return Response::json([
      'infoHtml' => $infoHtml,
      'favorite' => $favorite,
      'fetch' => $fetch ?? null,
      'channel_avatar' => $channel_avatar ?? null,
    ]);
  }

  /**
   * This method to make a links for the attachments
   * to be downloadable.
   *
   * @param string $fileName
   * @return \Symfony\Component\HttpFoundation\StreamedResponse|void
   */
  public function download($fileName)
  {
    $filePath = config('chatify.attachments.folder') . '/' . $fileName;
    if (Chatify::storage()->exists($filePath)) {
      return Chatify::storage()->download($filePath);
    }
    return abort(404, 'Sorry, File does not exist in our server or may have been deleted!');
  }

  /**
   * Send a message to database
   *
   * @param Request $request
   * @return JsonResponse
   */
  public function send(Request $request)
  {
    // dd($request);
    /**
     * "_token" => "oIiRjzjbZBNOStEoq3KGiXDBjyfXt2TRrHIqhBAa"
     *"message" => "test"
     *"type" => "contactChat"
     *"id" => "628128068812"
     *"temporaryMsgId" => "temp_1"
     */ // default variables
    $error = (object) [
      'status' => 0,
      'message' => null,
    ];
    $attachment = null;
    $attachment_title = null;

    // if there is attachment [file]
    if ($request->hasFile('file')) {
      // allowed extensions
      $allowed_images = Chatify::getAllowedImages();
      $allowed_files = Chatify::getAllowedFiles();
      $allowed = array_merge($allowed_images, $allowed_files);

      $file = $request->file('file');
      // check file size
      if ($file->getSize() < Chatify::getMaxUploadSize()) {
        if (in_array(strtolower($file->extension()), $allowed)) {
          // get attachment name
          $attachment_title = $file->getClientOriginalName();
          // upload attachment and store the new name
          $attachment = Str::uuid() . '.' . $file->extension();
          $file->storeAs(config('chatify.attachments.folder'), $attachment, config('chatify.storage_disk_name'));
        } else {
          $error->status = 1;
          $error->message = 'File extension not allowed!';
        }
      } else {
        $error->status = 1;
        $error->message = 'File size you are trying to upload is too large!';
      }
    }

    if (!$error->status) {
      if ($request['type'] == 'contactChat') {
        $message = Chatify::newContactMessage([
          'to' => $request['id'],
          'from' => env('TWILIO_WHATSAPP_FROM'),
          'type' => 'text',
          'message' => htmlentities(trim($request['message']), ENT_QUOTES, 'UTF-8'),
          'attachment' => $attachment
            ? json_encode(
              (object) [
                'new_name' => $attachment,
                'old_name' => htmlentities(trim($attachment_title), ENT_QUOTES, 'UTF-8'),
              ]
            )
            : null,
        ]);

        $messageData = Chatify::parseMessageContact($message);
        if (Auth::user()->id != $request['id']) {
          Chatify::push('private-chatify.' . $request['id'], 'messaging', [
            'from_id' => Auth::user()->id,
            'to_id' => $request['id'],
            'message' => Chatify::messageCard($messageData, true),
          ]);
        }
      }
    }

    // PRICES
    // https://developers.facebook.com/docs/whatsapp/pricing
    // Cost per conversation in USD, effective June 1, 2023,,,,,,
    // Note: Authentication templates will be available in India as of July 1, 2024.,,,,,,
    // Note: Authentication-International rate applies for Indonesia as of June 1, 2024 and India as of July 1, 2024. Refer to our developer documentation for more detail on this rate.,,,,,,
    // Market,Currency,Marketing,Utility,Authentication,Authentication-International,Service
    //   Indonesia,$US,0.0411,0.0200,0.0300,0.1360,0.0190
    // Malaysia,$US,0.0860,0.0200,0.0180,n/a,0.0220
    // Other,$US,0.0604,0.0338,0.0304,n/a,0.0145

    // Log::info('ChatController - sendWhatsAppMessage', [
    //     'request' => $request->all(),
    //   ]);

    $sid = env('TWILIO_SID');
    $token = env('TWILIO_AUTH_TOKEN');
    // $twilio = new Client($sid, $token);
    $from = env('TWILIO_WHATSAPP_FROM');

    //   $service = new \PHPSupabase\Service(env('SUPABASE_KEY'), env('SUPABASE_URL'));
    //   $auth = $service->createAuth();
    //   $auth->signInWithEmailAndPassword('dandi@pasima.co', '123456asd');
    //   $dataAuth = $auth->data();

    //   if ($request->dealer_id) {
    //     // $dealer = \App\Models\Dealer::find($request->dealer_id);
    //     if (isset($dataAuth->access_token)) {
    //       $db = $service->setBearerToken($dataAuth->access_token)->initializeDatabase('dealers', 'id');
    //       $dealers = $db->findBy('id', $request->dealer_id)->getResult();
    //       if ($dealers) {
    //         $dealer = $dealers[0];
    //         $sid = $dealer->wa_account_phone_number_id;
    //         $token = $dealer->wa_account_token;
    //         $from = $dealer->business_phone;
    //       }
    //     }
    //   }

    //   $lead = null;
    //   if ($request->lead_id) {
    //     if (isset($dataAuth->access_token)) {
    //       $db = $service->setBearerToken($dataAuth->access_token)->initializeDatabase('leads', 'id');
    //       $leads = $db->findBy('id', $request->lead_id)->getResult();
    //       if ($leads) {
    //         $lead = $leads[0];
    //       }
    //     }
    //   }

    //   $chatData = [
    //     'from' => $from,
    //     'to' => str_replace('+', '', $request->phone),
    //     'message' => $request->message,
    //     'user_id' => $request->user_id,
    //     'dealer_id' => $request->dealer_id,
    //     'lead_id' => $request->lead_id,
    //     'lead_is_verified' => $lead->is_verified,
    //     'type' => $request->type,
    //     'media' => $request->media,
    //     'template_name' => $request->template_name,
    //     'media_link' => $request->media_link,
    //     'request_body' => json_encode($request->all()),
    //     'client_phone' => str_replace('+', '', $request->phone),
    //     'status' => "read"
    //   ];
    //       Log::info('ChatController - sendWhatsAppMessage - chatData', [
    //             'data' => $chatData,
    //           ]);
    //   $chat = \App\Models\Chat::create($chatData);

    if (isset($dataAuth->access_token)) {
      $db = $service->setBearerToken($dataAuth->access_token)->initializeDatabase('chats', 'id');
      $data = $db->insert($chatData);
    }

    // $message = $twilio->messages->create(
    //   'whatsapp:' . $request->phone, // to
    //   [
    //     'from' => 'whatsapp:' . env('TWILIO_WHATSAPP_FROM'), // from
    //     'body' => $request->message,
    //   ]
    // );

    $phone_number_id = $sid;
    if ($request['type'] == 'template') {
      $template = 'hello_pasima';
      $languageCode = 'id';
      $body = [
        'messaging_product' => 'whatsapp',
        'to' => str_replace('+', '', $request['id']),
        'type' => 'template',
        'template' => [
          'name' => $request['template_name'] ?: $template,
          'language' => [
            'code' => $request['language_code'] ?: $languageCode,
          ],
        ],
      ];
      $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $token,
        'Content-Type' => 'application/json',
      ])->post('https://graph.facebook.com/v18.0/' . $phone_number_id . '/messages', $body);

      if (isset($dataAuth->access_token)) {
        $clientDb = $service->setBearerToken($dataAuth->access_token)->initializeDatabase('clients', 'id');
        $clients = $clientDb->findBy('phone', $from)->getResult();
        if ($clients) {
          $client = $clients[0];

          $fee = 0.0411;
          $tmpDb = $service->setBearerToken($dataAuth->access_token)->initializeDatabase('templates', 'id');
          $tmps = $tmpDb->findBy('template_name', $request['template_name'])->getResult();
          if ($tmps) {
            $tmp = $tmps[0];

            if ($tmp->type == 'utility') {
              $fee = 0.02;
            }
            if ($tmp->type == 'authentication') {
              $fee = 0.03;
            }
            if ($tmp->type == 'authentication international') {
              $fee = 0.136;
            }
          }

          $waConDb = $service->setBearerToken($dataAuth->access_token)->initializeDatabase('wa_conversations', 'id');
          $query = [
            'select' => 'id,client_id,to,session,type,template_name',
            'from' => 'wa_conversations',
            'where' => [
              'client_id' => 'eq.' . $client->id,
              'to' => 'eq.' . $request['id'],
              'template_name' => 'eq.' . $request['template_name'],
              'session' =>
                'gt.' .
                \Carbon\Carbon::now()
                  ->subDay()
                  ->format('Y-m-d h:i:s'),
            ],
          ];
          $waCons = $waConDb->createCustomQuery($query)->getResult();
          if (!empty($waCons->session)) {
            $fee = 0;
          } else {
            $data = $waConDb->insert([
              'client_id' => $client->id,
              'to' => $request['id'],
              'template_name' => $request['template_name'],
              'type' => $tmp->type,
              'session' => \Carbon\Carbon::now()->format('Y-m-d h:i:s'),
            ]);
          }

          $updateDate = $clientDb->update($client->id, ['quota' => (float) $client->quota - $fee * 0.2]);
        }
      }

      // Log::info('ChatController - sendWhatsAppMessage To Facebook API', [
      //   'headers' => [
      //     'Authorization' => 'Bearer ' . $token,
      //     'Content-Type' => 'application/json',
      //   ],
      //   'url' => 'https://graph.facebook.com/v18.0/' . $phone_number_id . '/messages',
      //   'body' => $body,
      //   'response' => json_encode($response),
      // ]);
    } else {
      if ($request['media'] && $request['media_link']) {
        $bodyText = [
          'messaging_product' => 'whatsapp',
          'recipient_type' => 'individual',
          'to' => str_replace('+', '', $request['id']),
          'type' => $request['media'],
          $request['media'] => [
            'link' => $request['media_link'],
          ],
        ];
      } else {
        $bodyText = [
          'messaging_product' => 'whatsapp',
          'recipient_type' => 'individual',
          'to' => str_replace('+', '', $request['id']),
          'type' => 'text',
          'text' => [
            'preview_url' => true,
            'body' => $request['message'],
          ],
        ];
      }

      $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $token,
        'Content-Type' => 'application/json',
      ])->post('https://graph.facebook.com/v18.0/' . $phone_number_id . '/messages', $bodyText);

      if (isset($dataAuth->access_token)) {
        $clientDb = $service->setBearerToken($dataAuth->access_token)->initializeDatabase('clients', 'id');
        $clients = $clientDb->findBy('phone', $from)->getResult();

        if ($clients) {
          $client = $clients[0];

          $fee = 0;
          if (!$client->counter_service) {
            $updateData = $clientDb->update($client->id, [
              'session_service' => \Carbon\Carbon::now()->fromat('Y-m-d h:i:s'),
              'counter_service' => 0,
            ]);
          } else {
            if (
              \Carbon\Carbon::createFromFormat('Y-m-d h:i:s', $client->session_service)->format('Y-m') <=
              \Carbon\Carbon::now()
                ->fromat('Y-m-d h:i:s')
                ->subMonth()
                ->format('Y-m')
            ) {
              $updateData = $clientDb->update($client->id, [
                'session_service' => \Carbon\Carbon::now()->fromat('Y-m-d h:i:s'),
                'counter_service' => 0,
              ]);
            } else {
              if ($client->counter_service > 1000) {
                $fee = 0.019;
              }
            }
          }

          $updateData = $db->update($client->id, [
            'quota' => (float) $client->quota - $fee * 0.2,
            'counter_service' => (int) $client->counter_service + 1,
          ]);
        }
      }

      // Log::info('ChatController - sendWhatsAppMessage', [
      //   'headers' => [
      //     'Authorization' => 'Bearer ' . $token,
      //     'Content-Type' => 'application/json',
      //   ],
      //   'url' => 'https://graph.facebook.com/v18.0/' . $phone_number_id . '/messages',
      //   'body' => $bodyText,
      //   'response' => json_encode($response),
      // ]);
    }

    //   return 'Message sent: ' . json_encode($response);
    // send the response
    return Response::json([
      'status' => '200',
      'error' => $error,
      'message' => Chatify::messageCard(@$messageData),
      'tempID' => $request['temporaryMsgId'],
    ]);
  }

  /**
   * Send a message to database
   *
   * @param Request $request
   * @return JsonResponse
   */
  public function sendTemplate(Request $request)
  {
    // dd($request);
    /**
     * "_token" => "oIiRjzjbZBNOStEoq3KGiXDBjyfXt2TRrHIqhBAa"
     *"message" => "test"
     *"type" => "contactChat"
     *"id" => "628128068812"
     *"temporaryMsgId" => "temp_1"
     */ // default variables
    $error = (object) [
      'status' => 0,
      'message' => null,
    ];
    $attachment = null;
    $attachment_title = null;

    // if there is attachment [file]
    if ($request->hasFile('file')) {
      // allowed extensions
      $allowed_images = Chatify::getAllowedImages();
      $allowed_files = Chatify::getAllowedFiles();
      $allowed = array_merge($allowed_images, $allowed_files);

      $file = $request->file('file');
      // check file size
      if ($file->getSize() < Chatify::getMaxUploadSize()) {
        if (in_array(strtolower($file->extension()), $allowed)) {
          // get attachment name
          $attachment_title = $file->getClientOriginalName();
          // upload attachment and store the new name
          $attachment = Str::uuid() . '.' . $file->extension();
          $file->storeAs(config('chatify.attachments.folder'), $attachment, config('chatify.storage_disk_name'));
        } else {
          $error->status = 1;
          $error->message = 'File extension not allowed!';
        }
      } else {
        $error->status = 1;
        $error->message = 'File size you are trying to upload is too large!';
      }
    }

    if (!$error->status) {
      if ($request['type'] == 'templateChat') {
        $templateMsg =
          'Hello! My name is [staff name] from [company name]. I hear you are interested in purchasing a car. Before we proceed, I need some information from you.';
        $message = Chatify::newContactMessage([
          'to' => $request['id'],
          'from' => env('TWILIO_WHATSAPP_FROM'),
          'type' => 'template',
          'message' => htmlentities(trim($templateMsg), ENT_QUOTES, 'UTF-8'),
          // 'message' => htmlentities(trim($body), ENT_QUOTES, 'UTF-8'),
          'attachment' => $attachment
            ? json_encode(
              (object) [
                'new_name' => $attachment,
                'old_name' => htmlentities(trim($attachment_title), ENT_QUOTES, 'UTF-8'),
              ]
            )
            : null,
        ]);

        $messageData = Chatify::parseMessageContact($message);
        if (Auth::user()->id != $request['id']) {
          Chatify::push('private-chatify.' . $request['id'], 'messaging', [
            'from_id' => Auth::user()->id,
            'to_id' => $request['id'],
            'message' => Chatify::messageCard($messageData, true),
          ]);
        }
      }
    }

    // PRICES
    // https://developers.facebook.com/docs/whatsapp/pricing
    // Cost per conversation in USD, effective June 1, 2023,,,,,,
    // Note: Authentication templates will be available in India as of July 1, 2024.,,,,,,
    // Note: Authentication-International rate applies for Indonesia as of June 1, 2024 and India as of July 1, 2024. Refer to our developer documentation for more detail on this rate.,,,,,,
    // Market,Currency,Marketing,Utility,Authentication,Authentication-International,Service
    //   Indonesia,$US,0.0411,0.0200,0.0300,0.1360,0.0190
    // Malaysia,$US,0.0860,0.0200,0.0180,n/a,0.0220
    // Other,$US,0.0604,0.0338,0.0304,n/a,0.0145

    // Log::info('ChatController - sendWhatsAppMessage', [
    //     'request' => $request->all(),
    //   ]);

    //   $sid = env('TWILIO_SID');
    //   $token = env('TWILIO_AUTH_TOKEN');
    //   // $twilio = new Client($sid, $token);
    //   $from = env('TWILIO_WHATSAPP_FROM');

    //   $service = new \PHPSupabase\Service(env('SUPABASE_KEY'), env('SUPABASE_URL'));
    //   $auth = $service->createAuth();
    //   $auth->signInWithEmailAndPassword('dandi@pasima.co', '123456asd');
    //   $dataAuth = $auth->data();

    //   if ($request->dealer_id) {
    //     // $dealer = \App\Models\Dealer::find($request->dealer_id);
    //     if (isset($dataAuth->access_token)) {
    //       $db = $service->setBearerToken($dataAuth->access_token)->initializeDatabase('dealers', 'id');
    //       $dealers = $db->findBy('id', $request->dealer_id)->getResult();
    //       if ($dealers) {
    //         $dealer = $dealers[0];
    //         $sid = $dealer->wa_account_phone_number_id;
    //         $token = $dealer->wa_account_token;
    //         $from = $dealer->business_phone;
    //       }
    //     }
    //   }

    //   $lead = null;
    //   if ($request->lead_id) {
    //     if (isset($dataAuth->access_token)) {
    //       $db = $service->setBearerToken($dataAuth->access_token)->initializeDatabase('leads', 'id');
    //       $leads = $db->findBy('id', $request->lead_id)->getResult();
    //       if ($leads) {
    //         $lead = $leads[0];
    //       }
    //     }
    //   }

    //   $chatData = [
    //     'from' => $from,
    //     'to' => str_replace('+', '', $request->phone),
    //     'message' => $request->message,
    //     'user_id' => $request->user_id,
    //     'dealer_id' => $request->dealer_id,
    //     'lead_id' => $request->lead_id,
    //     'lead_is_verified' => $lead->is_verified,
    //     'type' => $request->type,
    //     'media' => $request->media,
    //     'template_name' => $request->template_name,
    //     'media_link' => $request->media_link,
    //     'request_body' => json_encode($request->all()),
    //     'client_phone' => str_replace('+', '', $request->phone),
    //     'status' => "read"
    //   ];
    //       Log::info('ChatController - sendWhatsAppMessage - chatData', [
    //             'data' => $chatData,
    //           ]);
    //   $chat = \App\Models\Chat::create($chatData);

    //   if (isset($dataAuth->access_token)) {
    //     $db = $service->setBearerToken($dataAuth->access_token)->initializeDatabase('chats', 'id');
    //     $data = $db->insert($chatData);
    //   }

    // $message = $twilio->messages->create(
    //   'whatsapp:' . $request->phone, // to
    //   [
    //     'from' => 'whatsapp:' . env('TWILIO_WHATSAPP_FROM'), // from
    //     'body' => $request->message,
    //   ]
    // );

    //   $phone_number_id = $sid;
    //   if ($request['type'] == 'template') {
    //     $template = 'hello_pasima';
    //     $languageCode = 'id';
    //     $body = [
    //       'messaging_product' => 'whatsapp',
    //       'to' => str_replace('+', '', $request['id']),
    //       'type' => 'template',
    //       'template' => [
    //         'name' => $request['template_name'] ?: $template,
    //         'language' => [
    //           'code' => $request['language_code'] ?: $languageCode,
    //         ],
    //       ],
    //     ];
    //     $response = Http::withHeaders([
    //       'Authorization' => 'Bearer ' . $token,
    //       'Content-Type' => 'application/json',
    //     ])->post('https://graph.facebook.com/v18.0/' . $phone_number_id . '/messages', $body);

    // if (isset($dataAuth->access_token)) {
    //       $clientDb = $service->setBearerToken($dataAuth->access_token)->initializeDatabase('clients', 'id');
    //       $clients = $clientDb->findBy('phone', $from)->getResult();
    //       if ($clients) {
    //         $client = $clients[0];

    //           $fee = 0.0411;
    //           $tmpDb = $service->setBearerToken($dataAuth->access_token)->initializeDatabase('templates', 'id');
    //           $tmps = $tmpDb->findBy('template_name', $request['template_name'])->getResult();
    //           if ($tmps) {
    //               $tmp = $tmps[0];

    //               if($tmp->type == 'utility') {
    //                   $fee = 0.0200;
    //               }
    //               if($tmp->type == 'authentication') {
    //                   $fee = 0.0300;
    //               }
    //               if($tmp->type == 'authentication international') {
    //                   $fee = 0.1360;
    //               }
    //           }

    //           $waConDb = $service->setBearerToken($dataAuth->access_token)->initializeDatabase('wa_conversations', 'id');
    //           $query = [
    //               'select' => 'id,client_id,to,session,type,template_name',
    //               'from'   => 'wa_conversations',
    //               'where' =>
    //               [
    //                   'client_id' => 'eq.' . $client->id,
    //                   'to' => 'eq.' . $request['id'],
    //                   'template_name' => 'eq.' . $request['template_name'],
    //                   'session' => 'gt.' . \Carbon\Carbon::now()->subDay()->format('Y-m-d h:i:s'),
    //               ]
    //           ];
    //           $waCons = $waConDb->createCustomQuery($query)->getResult();
    //           if(!empty($waCons->session)) {
    //               $fee = 0;
    //           } else {
    //               $data = $waConDb->insert([
    //                   'client_id' => $client->id,
    //                   'to' => $request['id'],
    //                   'template_name' => $request['template_name'],
    //                   'type' => $tmp->type,
    //                   'session' => \Carbon\Carbon::now()->format('Y-m-d h:i:s'),
    //                   ]);
    //           }

    //         $updateDate = $clientDb->update($client->id, ['quota' => (float)$client->quota - ($fee * 0.2)]);
    //       }
    //   }

    // Log::info('ChatController - sendWhatsAppMessage To Facebook API', [
    //   'headers' => [
    //     'Authorization' => 'Bearer ' . $token,
    //     'Content-Type' => 'application/json',
    //   ],
    //   'url' => 'https://graph.facebook.com/v18.0/' . $phone_number_id . '/messages',
    //   'body' => $body,
    //   'response' => json_encode($response),
    // ]);

    // if ($request['media'] && $request['media_link']) {
    //   $bodyText = [
    //     'messaging_product' => 'whatsapp',
    //     'recipient_type' => 'individual',
    //     'to' => str_replace('+', '', $request['id']),
    //     'type' => $request['media'],
    //     $request['media'] => [
    //       'link' => $request['media_link'],
    //     ],
    //   ];
    // } else {
    //   $bodyText = [
    //     'messaging_product' => 'whatsapp',
    //     'recipient_type' => 'individual',
    //     'to' => str_replace('+', '', $request['id']),
    //     'type' => 'text',
    //     'text' => [
    //       'preview_url' => true,
    //       'body' => $request['message'],
    //     ],
    //   ];
    // }

    // $response = Http::withHeaders([
    //   'Authorization' => 'Bearer ' . $token,
    //   'Content-Type' => 'application/json',
    // ])->post('https://graph.facebook.com/v18.0/' . $phone_number_id . '/messages', $bodyText);

    // if (isset($dataAuth->access_token)) {
    //       $clientDb = $service->setBearerToken($dataAuth->access_token)->initializeDatabase('clients', 'id');
    //       $clients = $clientDb->findBy('phone', $from)->getResult();

    //       if ($clients) {
    //         $client = $clients[0];

    //           $fee = 0;
    //           if(!$client->counter_service) {
    //             $updateData = $clientDb->update($client->id, [
    //                 'session_service' => \Carbon\Carbon::now()->fromat('Y-m-d h:i:s'),
    //                   'counter_service' => 0
    //                 ]);
    //           } else {
    //               if(\Carbon\Carbon::createFromFormat('Y-m-d h:i:s', $client->session_service)->format('Y-m') <= \Carbon\Carbon::now()->fromat('Y-m-d h:i:s')->subMonth()->format('Y-m')) {
    //                   $updateData = $clientDb->update($client->id, [
    //                       'session_service' => \Carbon\Carbon::now()->fromat('Y-m-d h:i:s'),
    //                       'counter_service' => 0
    //                   ]);
    //               } else {
    //                   if($client->counter_service > 1000) {
    //                       $fee = 0.0190;
    //                   }
    //               }
    //           }

    //         $updateData = $db->update($client->id, [
    //             'quota' => (float)$client->quota - ($fee * 0.2),
    //             'counter_service' => (int)$client->counter_service + 1
    //             ]);
    //       }
    //   }

    // Log::info('ChatController - sendWhatsAppMessage', [
    //   'headers' => [
    //     'Authorization' => 'Bearer ' . $token,
    //     'Content-Type' => 'application/json',
    //   ],
    //   'url' => 'https://graph.facebook.com/v18.0/' . $phone_number_id . '/messages',
    //   'body' => $bodyText,
    //   'response' => json_encode($response),
    // ]);
    //   }

    //   return 'Message sent: ' . json_encode($response);
    // send the response
    $request->session()->flash('success', 'Ubah Data Berhasil');
    return redirect()->back();
  }

  /**
   * fetch [user/group] messages from database
   *
   * @param Request $request
   * @return JsonResponse
   */
  public function fetch(Request $request)
  {
    $type = $request['type'];
    $user_id = $request['id'];
    switch ($type) {
      case 'contactChat':
        $query = \App\Models\Chat::with('lead')
          ->where('to', $user_id)
          ->where('from', env('TWILIO_WHATSAPP_FROM'))
          ->orWhere('from', $user_id)
          ->where('to', env('TWILIO_WHATSAPP_FROM'))
          ->orderBy('created_at', 'DESC');
        break;
      case 'groupChat':
        // $query = Chatify::fetchMessagesQuery($request['id'])->latest();
        $query = \App\Models\Chat::with('lead')
          ->where('to', $user_id)
          ->where('from', env('TWILIO_WHATSAPP_FROM'))
          ->orWhere('from', $user_id)
          ->where('to', env('TWILIO_WHATSAPP_FROM'))
          ->orderBy('created_at', 'DESC');
        break;
      default:
        $query = Chatify::fetchMessagesQuery($request['id'])->latest();
        break;
    }

    $messages = $query->paginate($request->per_page ?? $this->perPage);
    // $messages = $customers->sortByDesc('created_at');
    $totalMessages = $messages->total();
    $lastPage = $messages->lastPage();
    $response = [
      'total' => $totalMessages,
      'last_page' => $lastPage,
      'last_message_id' => collect($messages->items())->last()->id ?? null,
      'messages' => '',
    ];

    // if there is no messages yet.
    if ($totalMessages < 1) {
      $response['messages'] = '<p class="message-hint center-el"><span>Say \'hi\' and start messaging</span></p>';
      return Response::json($response);
    }
    if (count($messages->items()) < 1) {
      $response['messages'] = '';
      return Response::json($response);
    }
    $allMessages = null;

    foreach ($messages->reverse() as $message) {
      $allMessages .= Chatify::messageCard(Chatify::parseMessageContact($message));
    }
    $response['messages'] = $allMessages;
    return Response::json($response);
  }

  /**
   * Make messages as seen
   *
   * @param Request $request
   * @return JsonResponse|void
   */
  public function seen(Request $request)
  {
    // make as seen
    $seen = Chatify::makeSeen($request['id']);
    // send the response
    return Response::json(
      [
        'status' => $seen,
      ],
      200
    );
  }

  /**
   * Get contacts list
   *
   * @param Request $request
   * @return JsonResponse
   */
  public function getContacts(Request $request)
  {
    // get all users that received/sent message from/to [Auth user]
    $users = Message::join('users', function ($join) {
      $join->on('ch_messages.from_id', '=', 'users.id')->orOn('ch_messages.to_id', '=', 'users.id');
    })
      ->where(function ($q) {
        $q->where('ch_messages.from_id', Auth::user()->id)->orWhere('ch_messages.to_id', Auth::user()->id);
      })
      ->where('users.id', '!=', Auth::user()->id)
      ->select('users.*', DB::raw('MAX(ch_messages.created_at) max_created_at'))
      ->orderBy('max_created_at', 'desc')
      ->groupBy('users.id')
      ->paginate($request->per_page ?? $this->perPage);

    $groupList = Channel::all();
    $groups = '';
    foreach ($groupList as $group) {
      $groups .= Chatify::getGroupItem($group);
    }

    $usersList = $users->items();
    if (count($usersList) > 0) {
      $contacts = '';
      foreach ($usersList as $user) {
        $contacts .= Chatify::getContactItem($user);
      }
    } else {
      $contacts = '<p class="message-hint center-el"><span>Your contact list is empty</span></p>';
    }

    return Response::json(
      [
        'contacts' => $contacts,
        'groups' => $groups,
        'total' => $users->total() ?? 0,
        'last_page' => $users->lastPage() ?? 1,
      ],
      200
    );
  }

  /**
   * Update user's list item data
   *
   * @param Request $request
   * @return JsonResponse
   */
  public function updateContactItem(Request $request)
  {
    // Get user data
    $user = User::where('id', $request['user_id'])->first();
    if (!$user) {
      return Response::json(
        [
          'message' => 'User not found!',
        ],
        401
      );
    }
    $contactItem = Chatify::getContactItem($user);

    // send the response
    return Response::json(
      [
        'contactItem' => $contactItem,
      ],
      200
    );
  }

  /**
   * Put a user in the favorites list
   *
   * @param Request $request
   * @return JsonResponse|void
   */
  public function favorite(Request $request)
  {
    $userId = $request['user_id'];
    // check action [star/unstar]
    $favoriteStatus = Chatify::inFavorite($userId) ? 0 : 1;
    Chatify::makeInFavorite($userId, $favoriteStatus);

    // send the response
    return Response::json(
      [
        'status' => @$favoriteStatus,
      ],
      200
    );
  }

  /**
   * Get favorites list
   *
   * @param Request $request
   * @return JsonResponse|void
   */
  public function getFavorites(Request $request)
  {
    $favoritesList = null;
    $favorites = Favorite::where('user_id', Auth::user()->id);
    foreach ($favorites->get() as $favorite) {
      // get user data
      $user = User::where('id', $favorite->favorite_id)->first();
      $favoritesList .= view('Chatify::layouts.favorite', [
        'user' => $user,
      ]);
    }
    // send the response
    return Response::json(
      [
        'count' => $favorites->count(),
        'favorites' => $favorites->count() > 0 ? $favoritesList : 0,
      ],
      200
    );
  }

  /**
   * Search in messenger
   *
   * @param Request $request
   * @return JsonResponse|void
   */
  public function search(Request $request)
  {
    $getRecords = null;
    $input = trim(filter_var($request['input']));
    $records = User::where('id', '!=', Auth::user()->id)
      ->where('name', 'LIKE', "%{$input}%")
      ->paginate($request->per_page ?? $this->perPage);
    foreach ($records->items() as $record) {
      $getRecords .= view('Chatify::layouts.listItem', [
        'get' => 'search_item',
        'user' => Chatify::getUserWithAvatar($record),
      ])->render();
    }
    if ($records->total() < 1) {
      $getRecords = '<p class="message-hint center-el"><span>Nothing to show.</span></p>';
    }
    // send the response
    return Response::json(
      [
        'records' => $getRecords,
        'total' => $records->total(),
        'last_page' => $records->lastPage(),
      ],
      200
    );
  }

  /**
   * Get shared photos
   *
   * @param Request $request
   * @return JsonResponse|void
   */
  public function sharedPhotos(Request $request)
  {
    $shared = Chatify::getSharedPhotos($request['user_id']);
    $sharedPhotos = null;

    // shared with its template
    for ($i = 0; $i < count($shared); $i++) {
      $sharedPhotos .= view('Chatify::layouts.listItem', [
        'get' => 'sharedPhoto',
        'image' => Chatify::getAttachmentUrl($shared[$i]),
      ])->render();
    }
    // send the response
    return Response::json(
      [
        'shared' => count($shared) > 0 ? $sharedPhotos : '<p class="message-hint"><span>Nothing shared yet</span></p>',
      ],
      200
    );
  }

  /**
   * Delete conversation
   *
   * @param Request $request
   * @return JsonResponse
   */
  public function deleteConversation(Request $request)
  {
    // delete
    $delete = Chatify::deleteConversation($request['channel_id']);

    // send the response
    return Response::json(
      [
        'deleted' => $delete ? 1 : 0,
      ],
      200
    );
  }

  /**
   * Delete group chat
   *
   * @param Request $request
   * @return JsonResponse
   */
  public function deleteGroupChat(Request $request)
  {
    $channel_id = $request['channel_id'];

    $channel = Channel::findOrFail($channel_id);
    $channel->users()->detach();

    Chatify::deleteConversation($channel_id);

    // send the response
    return Response::json(
      [
        'deleted' => $channel->delete(),
      ],
      200
    );
  }

  /**
   * Leave group chat
   *
   * @param Request $request
   * @return JsonResponse
   */
  public function leaveGroupChat(Request $request)
  {
    $channel_id = $request['channel_id'];
    $user_id = $request['user_id'];

    // add last message
    $message = Chatify::newMessage([
      'from_id' => Auth::user()->id,
      'to_channel_id' => $channel_id,
      'body' => Auth::user()->name . ' has left the group',
      'attachment' => null,
    ]);
    $message->user_avatar = Auth::user()->avatar;
    $message->user_name = Auth::user()->name;
    $message->user_email = Auth::user()->email;

    $messageData = Chatify::parseMessage($message, null);

    Chatify::push('private-chatify.' . $channel_id, 'messaging', [
      'from_id' => Auth::user()->id,
      'to_channel_id' => $channel_id,
      'message' => Chatify::messageCard($messageData, true),
    ]);

    // detach user
    $channel = Channel::findOrFail($channel_id);
    $channel->users()->detach($user_id);

    // send the response
    return Response::json(
      [
        'left' => $channel ? 1 : 0,
      ],
      200
    );
  }

  /**
   * Delete message
   *
   * @param Request $request
   * @return JsonResponse
   */
  public function deleteMessage(Request $request)
  {
    // delete
    $delete = Chatify::deleteMessage($request['id']);

    // send the response
    return Response::json(
      [
        'deleted' => $delete ? 1 : 0,
      ],
      200
    );
  }

  public function updateSettings(Request $request)
  {
    $msg = null;
    $error = $success = 0;

    // dark mode
    if ($request['dark_mode']) {
      $request['dark_mode'] == 'dark'
        ? User::where('id', Auth::user()->id)->update(['dark_mode' => 1]) // Make Dark
        : User::where('id', Auth::user()->id)->update(['dark_mode' => 0]); // Make Light
    }

    // If messenger color selected
    if ($request['messengerColor']) {
      $messenger_color = trim(filter_var($request['messengerColor']));
      User::where('id', Auth::user()->id)->update(['messenger_color' => $messenger_color]);
    }
    // if there is a [file]
    if ($request->hasFile('avatar')) {
      // allowed extensions
      $allowed_images = Chatify::getAllowedImages();

      $file = $request->file('avatar');
      // check file size
      if ($file->getSize() < Chatify::getMaxUploadSize()) {
        if (in_array(strtolower($file->extension()), $allowed_images)) {
          // delete the older one
          if (Auth::user()->avatar != config('chatify.user_avatar.default')) {
            $avatar = Auth::user()->avatar;
            if (Chatify::storage()->exists($avatar)) {
              Chatify::storage()->delete($avatar);
            }
          }
          // upload
          $avatar = Str::uuid() . '.' . $file->extension();
          $update = User::where('id', Auth::user()->id)->update(['avatar' => $avatar]);
          $file->storeAs(config('chatify.user_avatar.folder'), $avatar, config('chatify.storage_disk_name'));
          $success = $update ? 1 : 0;
        } else {
          $msg = 'File extension not allowed!';
          $error = 1;
        }
      } else {
        $msg = 'File size you are trying to upload is too large!';
        $error = 1;
      }
    }

    // send the response
    return Response::json(
      [
        'status' => $success ? 1 : 0,
        'error' => $error ? 1 : 0,
        'message' => $error ? $msg : 0,
      ],
      200
    );
  }

  /**
   * Set user's active status
   *
   * @param Request $request
   * @return JsonResponse
   */
  public function setActiveStatus(Request $request)
  {
    $activeStatus = $request['status'] > 0 ? 1 : 0;
    $status = User::where('id', Auth::user()->id)->update(['active_status' => $activeStatus]);
    return Response::json(
      [
        'status' => $status,
      ],
      200
    );
  }

  /**
   * Search users
   *
   * @param Request $request
   * @return JsonResponse|void
   */
  public function searchUsers(Request $request)
  {
    $getRecords = [];
    $input = trim(filter_var($request['input']));
    $records = User::where('id', '!=', Auth::user()->id)
      ->where('name', 'LIKE', "%{$input}%")
      ->paginate($request->per_page ?? $this->perPage);
    foreach ($records->items() as $record) {
      $getRecords[] = [
        'user' => $record,
        'view' => view('Chatify::layouts.listItem', [
          'get' => 'user_search_item',
          'user' => Chatify::getUserWithAvatar($record),
        ])->render(),
      ];
    }
    if ($records->total() < 1) {
      $getRecords = '<p class="message-hint"><span>Nothing to show.</span></p>';
    }
    // send the response
    return Response::json(
      [
        'records' => $getRecords,
        'total' => $records->total(),
        'last_page' => $records->lastPage(),
      ],
      200
    );
  }

  public function createGroupChat(Request $request)
  {
    $msg = null;
    $error = $success = 0;

    $user_ids = array_map('intval', explode(',', $request['user_ids']));
    $user_ids[] = Auth::user()->id;

    $group_name = $request['group_name'];

    $new_channel = new Channel();
    $new_channel->name = $group_name;
    $new_channel->owner_id = Auth::user()->id;
    $new_channel->save();
    $new_channel->users()->sync($user_ids);

    // add first message
    $message = Chatify::newMessage([
      'from_id' => Auth::user()->id,
      'to_channel_id' => $new_channel->id,
      'body' => Auth::user()->name . ' has created a new chat group: ' . $group_name,
      'attachment' => null,
    ]);
    $message->user_name = Auth::user()->name;
    $message->user_email = Auth::user()->email;

    $messageData = Chatify::parseMessage($message, null);
    Chatify::push('private-chatify.' . $new_channel->id, 'messaging', [
      'from_id' => Auth::user()->id,
      'to_channel_id' => $new_channel->id,
      'message' => Chatify::messageCard($messageData, true),
    ]);

    // if there is a [file]
    if ($request->hasFile('avatar')) {
      // allowed extensions
      $allowed_images = Chatify::getAllowedImages();

      $file = $request->file('avatar');
      // check file size
      if ($file->getSize() < Chatify::getMaxUploadSize()) {
        if (in_array(strtolower($file->extension()), $allowed_images)) {
          $avatar = Str::uuid() . '.' . $file->extension();
          $update = $new_channel->update(['avatar' => $avatar]);
          $file->storeAs(config('chatify.channel_avatar.folder'), $avatar, config('chatify.storage_disk_name'));
          $success = $update ? 1 : 0;
        } else {
          $msg = 'File extension not allowed!';
          $error = 1;
        }
      } else {
        $msg = 'File size you are trying to upload is too large!';
        $error = 1;
      }
    }

    return Response::json(
      [
        'status' => $success ? 1 : 0,
        'error' => $error ? 1 : 0,
        'message' => $error ? $msg : 0,
        'channel' => $new_channel,
      ],
      200
    );
  }
}
