<?php

namespace App\Http\Controllers\apps;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

use Twilio\Rest\Client;
use Auth;

class Chat extends Controller
{
  public function test(Request $request)
  {
    // // $db = \Illuminate\Support\Facades\DB::connection('pgsql');
    // // return $db->select('leads')->toSql();
    // $chat = new \App\Models\Dealer();
    // $chat->setConnection('pgsql');
    // dd($chat->get()->toArray());

    $service = new \PHPSupabase\Service(env('SUPABASE_KEY'), env('SUPABASE_URL'));
    $auth = $service->createAuth();
    $auth->signInWithEmailAndPassword('dandi@pasima.co', '123456asd');
    $dataAuth = $auth->data();

    if (isset($dataAuth->access_token)) {
      $query = $service->initializeQueryBuilder();
      $data = $query
        ->select('fcm_token')
        ->from('profiles')
        ->where('dealer_id', 'eq.5')
        ->execute()
        ->getResult();
      \Illuminate\Support\Arr::pluck($data, 'fcm_token');

      $db = $service->setBearerToken($dataAuth->access_token)->initializeDatabase('leads', 'id');
      $leads = $db->insert([
        'dealer_id' => 5,
        'phone_number' => '09090909090',
      ]);
      dd($leads);
      $lead = $leads[0];
      //   dd($db->findBy('id', $request->dealer_id)->getResult()[0]->name);
      // $data = $db->insert([
      //   'name' => 'Test dari BE',
      //   'package' => '1',
      //   'due_date' => '2024-01-31',
      //   'phone' => '621234567890',
      // ]);
      // dd($data);
    }

    // $curl = curl_init();

    // curl_setopt_array($curl, [
    //   CURLOPT_URL => env('FACEBOOK_URL') . '/' . env('TWILIO_SID') . '/messages',
    //   CURLOPT_RETURNTRANSFER => true,
    //   CURLOPT_ENCODING => '',
    //   CURLOPT_MAXREDIRS => 10,
    //   CURLOPT_TIMEOUT => 0,
    //   CURLOPT_FOLLOWLOCATION => true,
    //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //   CURLOPT_CUSTOMREQUEST => 'POST',
    //   CURLOPT_POSTFIELDS => '{
    //     "messaging_product": "whatsapp",
    //     "to": "6285159969353",
    //     "type": "template",
    //     "template": {
    //         "name": "hello_pasima",
    //         "language": {
    //             "code": "id"
    //         }
    //     }
    // }',
    //   CURLOPT_HTTPHEADER => ['Content-Type: application/json', 'Authorization: Bearer ' . env('TWILIO_AUTH_TOKEN')],
    // ]);

    // $response = curl_exec($curl);

    // curl_close($curl);

    // dd($response);

    // // if ($lead) {
    // $to = [
    //   'ddj1UxuwSC6IeSsgC_n8KN:APA91bF9Z1O5ByPrWww3o8F60pMN6T96E5KA5ppyP6GPJ4ibe4nhM-RrFLVqUo0RhTZSqHiMB1M8u364XD1P3bHfnLFUPTokpuF932oRgn1V4emnWbJ3kC3NFttLBrfGEZOEblpEMIhm',
    // ];
    // $title = 'Pesan dari Pasima BE Test';
    // $r = $this->sendFCM($to, $title, 'halo', $img = '', [
    //   'screen' => 'chat',
    //   'lead_id' => '1',
    //   'dealer_id' => '1',
    // ]);

    // dd($r);
    // // }
  }

  private function sendFCM($to, $title, $message, $img = '', $datapayload = '')
  {
    $msg = urlencode($message);
    $data = [
      'title' => $title,
      // 'sound' => 'default',
      // 'msg' => $msg,
      'data' => $datapayload,
      'body' => $message,
      // 'color' => '#79bc64',
    ];
    if ($img) {
      $data['image'] = $img;
      $data['style'] = 'picture';
      $data['picture'] = $img;
    }
    $fields = [
      'registration_ids' => $to,
      'notification' => $data,
      'data' => $datapayload,
      'priority' => 'high',
    ];
    $headers = ['Authorization: key=' . env('GOOGLE_API_KEY'), 'Content-Type: application/json'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
  }

  public function index()
  {
    $user = Auth::user();
    $chats = \App\Models\Chat::with('lead')
      ->where('to', env('TWILIO_WHATSAPP_FROM'))
      ->groupBy('from')
      ->latest()
      ->get();

    $chatPhones = $chats->pluck('from')->toArray();

    $leadNotChats = \App\Models\Lead::where('dealer_id', $user->dealer_id)
      ->whereNotIn('phone_number', $chatPhones)
      ->get();

    return view('content.apps.app-chat', [
      'userId' => $user->id,
      'chats' => $chats,
      'leadNotChats' => $leadNotChats,
    ]);
  }

  public function getChats($leadNumber)
  {
    $chats = \App\Models\Chat::where('to', $leadNumber)
      ->orWhere('from', $leadNumber)
      ->get();

    return response()->json($chats, 200);
  }

  public function addContact(Request $request)
  {
    $sid = env('TWILIO_SID');
    $token = env('TWILIO_AUTH_TOKEN');
    $twilio = new Client($sid, $token);

    $validation_request = $twilio->validationRequests->create(
      $request->phone, // phoneNumber
      ['friendlyName' => $request->phone]
    );

    return $validation_request;
  }

  public function verifiedLead(Request $request)
  {
    Log::info('ChatController - verifiedLead', [
      'request' => $request->all(),
    ]);

    $sid = env('TWILIO_SID');
    $token = env('TWILIO_AUTH_TOKEN');
    // $twilio = new Client($sid, $token);
    // $from = env('TWILIO_WHATSAPP_FROM');

    $data = null;

    $service = new \PHPSupabase\Service(env('SUPABASE_KEY'), env('SUPABASE_URL'));
    $auth = $service->createAuth();
    $auth->signInWithEmailAndPassword('dandi@pasima.co', '123456asd');
    $dataAuth = $auth->data();

    $dealer = null;
    if ($request->dealer_id) {
      // $dealer = \App\Models\Dealer::find($request->dealer_id);
      if (isset($dataAuth->access_token)) {
        $db = $service->setBearerToken($dataAuth->access_token)->initializeDatabase('dealers', 'id');
        $dealers = $db->findBy('id', $request->dealer_id)->getResult();
        if ($dealers) {
          $dealer = $dealers[0];
          $sid = $dealer->wa_account_phone_number_id;
          $token = $dealer->wa_account_token;
          // $from = $dealer->business_phone;
        }
      }
    }

    $lead = null;
    if ($request->lead_id) {
      if (isset($dataAuth->access_token)) {
        $db = $service->setBearerToken($dataAuth->access_token)->initializeDatabase('leads', 'id');
        $leads = $db->findBy('id', $request->lead_id)->getResult();
        if ($leads) {
          $lead = $leads[0];

          try {
            $db = $service->setBearerToken($dataAuth->access_token)->initializeDatabase('leads', 'id');
            $data = $db->update($lead->id, ['is_verified' => true]);

            Log::info('ChatController - verifiedLead', [
              'request' => $request->all(),
              'data' => $data,
            ]);
          } catch (Exception $e) {
            Log::info('ChatController - verifiedLead', [
              'request' => $request->all(),
              'exception' => $e->getMessage(),
            ]);
          }

          if ($dealer) {
            $chatData = [
              'from' => $lead->phone_number,
              'to' => $dealer->business_phone,
              'message' => $request->message,
              'user_id' => $request->user_id,
              'dealer_id' => $dealer->id,
              'lead_id' => $lead->id,
              'lead_is_verified' => true,
              'type' => 'text',
              'request_body' => json_encode($request->all()),
            ];
            $chat = \App\Models\Chat::create($chatData);

            $db = $service->setBearerToken($dataAuth->access_token)->initializeDatabase('chats', 'id');
            $data = $db->insert($chatData);

            $query = $service->initializeQueryBuilder();
            $users = $query
              ->select('fcm_token')
              ->from('profiles')
              ->where('dealer_id', 'eq.' . $dealer->id)
              ->execute()
              ->getResult();
            $to = \Illuminate\Support\Arr::pluck($users, 'fcm_token');
            $title = 'Pesan dari ' . $lead->phone_number;
            $this->sendFCM($to, $title, $request->message, $img = '', [
              'screen' => 'chat',
              'lead_id' => $lead->id,
              'dealer_id' => $dealer->id,
            ]);
          }
        }
      }
    }

    return 'Message sent: ' . json_encode($data);
  }

  public function sendWhatsAppMessage(Request $request)
  {
    try {
      $validator = Validator::make($request->all(), [
        'type' => ['required', 'string'],
        'lead_id' => ['required', 'integer'],
        'dealer_id' => ['required', 'integer'],
        'user_id' => ['required', 'string'],
        'message' => ['required', 'string'],
        'phone' => ['required', 'string'],
      ]);

      $params = $validator->validate();

      // PRICES
      // https://developers.facebook.com/docs/whatsapp/pricing
      // Cost per conversation in USD, effective June 1, 2023,,,,,,
      // Note: Authentication templates will be available in India as of July 1, 2024.,,,,,,
      // Note: Authentication-International rate applies for Indonesia as of June 1, 2024 and India as of July 1, 2024. Refer to our developer documentation for more detail on this rate.,,,,,,
      // Market,Currency,Marketing,Utility,Authentication,Authentication-International,Service
      //   Indonesia,$US,0.0411,0.0200,0.0300,0.1360,0.0190
      // Malaysia,$US,0.0860,0.0200,0.0180,n/a,0.0220
      // Other,$US,0.0604,0.0338,0.0304,n/a,0.0145

      Log::info('ChatController - sendWhatsAppMessage', [
        'request' => $request->all(),
      ]);

      // $sid = env('TWILIO_SID');
      // $token = env('TWILIO_AUTH_TOKEN');
      // // $twilio = new Client($sid, $token);
      // $from = env('TWILIO_WHATSAPP_FROM');

      $service = new \PHPSupabase\Service(env('SUPABASE_KEY'), env('SUPABASE_URL'));
      $auth = $service->createAuth();
      $auth->signInWithEmailAndPassword(env('SUPABASE_EMAIL'), env('SUPABASE_PASSWORD'));
      $dataAuth = $auth->data();

      if ($params['dealer_id']) {
        // $dealer = \App\Models\Dealer::find($params['dealer_id']);
        if (isset($dataAuth->access_token)) {
          $db = $service->setBearerToken($dataAuth->access_token)->initializeDatabase('dealers', 'id');
          $dealers = $db->findBy('id', $params['dealer_id'])->getResult();

          if ($dealers) {
            $dealer = $dealers[0];
            $sid = $dealer->wa_account_phone_number_id;
            $token = $dealer->wa_account_token;
            $from = $dealer->business_phone;
          }
        }
      }

      $lead = null;
      if ($request->lead_id) {
        if (isset($dataAuth->access_token)) {
          $db = $service->setBearerToken($dataAuth->access_token)->initializeDatabase('leads', 'id');
          $leads = $db->findBy('id', $request->lead_id)->getResult();

          if ($leads) {
            $lead = $leads[0];
          }
        }
      }

      $chatData = [
        'from' => $from,
        'to' => str_replace('+', '', $request->phone),
        'message' => $request->message,
        'user_id' => $request->user_id,
        'dealer_id' => $request->dealer_id,
        'lead_id' => $request->lead_id,
        'lead_is_verified' => $lead->is_verified ?? false,
        'type' => $request->type,
        'media' => $request->media ?? '',
        'template_name' => $request->template_name ?? '',
        'media_link' => $request->media_link ?? '',
        'request_body' => json_encode($request->all()),
        'client_phone' => str_replace('+', '', $request->phone),
        'status' => 'read',
      ];

      Log::info('ChatController - sendWhatsAppMessage - chatData', [
        'data' => $chatData,
      ]);

      $chat = \App\Models\Chat::create($chatData);

      // $chat = \App\Models\Chat::create($chatData);

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
      if ($request->type == 'template') {
        $template = 'hello_pasima';
        $languageCode = 'id';
        $body = [
          'messaging_product' => 'whatsapp',
          'to' => str_replace('+', '', $request->phone),
          'type' => 'template',
          'template' => [
            'name' => $request->template_name ?: $template,
            'language' => [
              'code' => $request->language_code ?: $languageCode,
            ],
          ],
        ];

        $response = Http::withHeaders([
          'Authorization' => 'Bearer ' . $token,
          'Content-Type' => 'application/json',
        ])->post(env('FACEBOOK_URL') . '/' . $phone_number_id . '/messages', $body);

        if (isset($dataAuth->access_token)) {
          $clientDb = $service->setBearerToken($dataAuth->access_token)->initializeDatabase('clients', 'id');
          $clients = $clientDb->findBy('phone', $from)->getResult();
          if ($clients) {
            $client = $clients[0];

            $fee = 0.0411;
            $tmpDb = $service->setBearerToken($dataAuth->access_token)->initializeDatabase('templates', 'id');
            $tmps = $tmpDb->findBy('template_name', $request->template_name)->getResult();
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
                'to' => 'eq.' . $request->phone,
                'template_name' => 'eq.' . $request->template_name,
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
                'to' => $request->phone,
                'template_name' => $request->template_name,
                'type' => $tmp->type,
                'session' => \Carbon\Carbon::now()->format('Y-m-d h:i:s'),
              ]);
            }

            $updateDate = $clientDb->update($client->id, ['quota' => (float) $client->quota - $fee * 0.2]);
          }
        }

        Log::info('ChatController - sendWhatsAppMessage To Facebook API', [
          'headers' => [
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
          ],
          'url' => env('FACEBOOK_URL') . '/' . $phone_number_id . '/messages',
          'body' => $body,
          'response' => json_encode($response),
        ]);
      } else {
        if ($request->media && $request->media_link) {
          $bodyText = [
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => str_replace('+', '', $request->phone),
            'type' => $request->media,
            $request->media => [
              'link' => $request->media_link,
            ],
          ];
        } else {
          $bodyText = [
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => str_replace('+', '', $request->phone),
            'type' => 'text',
            'text' => [
              'preview_url' => true,
              'body' => $request->message,
            ],
          ];
        }

        // dd('body', $bodyText, $token, $phone_number_id);
        // https://graph.facebook.com/v19.0/216074638249648/messages
        $response = Http::withHeaders([
          'Authorization' => 'Bearer ' . $token,
          'Content-Type' => 'application/json',
        ])->post(env('FACEBOOK_URL') . '/' . $phone_number_id . '/messages', $bodyText);

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

        Log::info('ChatController - sendWhatsAppMessage', [
          'headers' => [
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
          ],
          'url' => env('FACEBOOK_URL') . '/' . $phone_number_id . '/messages',
          'body' => $bodyText,
          'response' => json_encode($response),
        ]);
      }

      return 'Message sent: ' . json_encode($response);
    } catch (Exception $e) {
      return json_encode($e->getMessage());
    }
  }

  public function beforeReceiveWhatsAppMessage(Request $request)
  {
    Log::info('ChatController - beforeReceiveWhatsAppMessage', [
      'request' => json_encode($request),
    ]);

    $verifyToken = 'HAPPY';
    $mode = $request->query('hub_mode');
    $token = $request->query('hub_verify_token');
    $challenge = $request->query('hub_challenge');

    if ($mode && $token) {
      if ($mode === 'subscribe' && $token === $verifyToken) {
        \Illuminate\Support\Facades\Log::info('WEBHOOK_VERIFIED');

        return $challenge;
      } else {
        return response()->json([], 403);
      }
    } else {
      return 'Invalid!';
    }
  }

  public function receiveWhatsAppMessage(Request $request)
  {
    Log::info('ChatController - receiveWhatsAppMessage', [
      'request' => $request->entry,
    ]);
    Log::info('ChatController - receiveWhatsAppMessage - entry0', [
      'request' => $request->input('entry.0'),
    ]);

    // //   return response()->json("Message Saved", 200);
    // $sid = env('TWILIO_SID');
    $token = env('TWILIO_AUTH_TOKEN');
    // $twilio = new Client($sid, $token);

    // // Mendapatkan data dari Twilio
    // $from = $request->From; // Nomor pengirim
    // $body = $request->Body; // Isi pesan

    // if (strpos($from, 'whatsapp:') !== false) {
    //   // Remove "whatsapp:" from the body
    //   $from = str_replace('whatsapp:', '', $from);
    // }
    $dealerId = null;
    $phone_number_id = $request->input('entry.0.changes.0.value.metadata.phone_number_id');
    $service = new \PHPSupabase\Service(env('SUPABASE_KEY'), env('SUPABASE_URL'));
    $auth = $service->createAuth();
    $auth->signInWithEmailAndPassword('dandi@pasima.co', '123456asd');
    $dataAuth = $auth->data();

    if (isset($dataAuth->access_token)) {
      $db = $service->setBearerToken($dataAuth->access_token)->initializeDatabase('dealers', 'id');
      $dealers = $db->findBy('wa_account_phone_number_id', $phone_number_id)->getResult();
      if ($dealers) {
        $dealer = $dealers[0];
        $dealerId = $dealer->id;
        $token = $dealer->wa_account_token;
      }
    }
    // info on WhatsApp text message payload: https://developers.facebook.com/docs/whatsapp/cloud-api/webhooks/payload-examples#text-messages
    if ($request->has('object')) {
      if (
        $request->has('entry.0.changes.0.value.messages.0') &&
        $request->has('entry.0.changes.0.value.metadata.phone_number_id')
      ) {
        $display_phone_number = $request->input('entry.0.changes.0.value.metadata.display_phone_number');
        $phone_number_id = $request->input('entry.0.changes.0.value.metadata.phone_number_id');
        $from = $request->input('entry.0.changes.0.value.messages.0.from'); // extract the phone number from the webhook payload
        $msg_body = null;
        $media = null;
        $media_link = null;
        $mediaType = $request->input('entry.0.changes.0.value.messages.0.type');
        if ($mediaType == 'text') {
          $msg_body = $request->input('entry.0.changes.0.value.messages.0.text.body'); // extract the message text from the webhook payload
        }
        if (
          $mediaType == 'image' ||
          $mediaType == 'video' ||
          $mediaType == 'audio' ||
          $mediaType == 'document' ||
          $mediaType == 'sticker'
        ) {
          $mediaData = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
          ])->get(
            'https://graph.facebook.com/v17.0/' .
              $request->input('entry.0.changes.0.value.messages.0.' . $mediaType . '.id')
          );
          Log::info('ChatController - receiveWhatsAppMessage - getMediaData', [
            'token' => $token,
            'type' => $mediaType,
            'request' => $request->input('entry.0.changes.0.value.messages.0.' . $mediaType . '.id'),
            'data' => json_decode($mediaData),
          ]);
          $media = $mediaType;
          $mediaUrl = json_decode($mediaData)->url;

          $mediaDownload = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
          ])->get($mediaUrl);
          \Illuminate\Support\Facades\Storage::disk('media')->put(
            $request->input('entry.0.changes.0.value.messages.0.' . $mediaType . '.id') .
              '.' .
              explode('/', json_decode($mediaData)->mime_type)[1],
            $mediaDownload
          );
          \Illuminate\Support\Facades\Storage::disk('public')->put(
            $request->input('entry.0.changes.0.value.messages.0.' . $mediaType . '.id') .
              '.' .
              explode('/', json_decode($mediaData)->mime_type)[1],
            $mediaDownload
          );
          $media_link = url(
            '/storage/' .
              $request->input('entry.0.changes.0.value.messages.0.' . $mediaType . '.id') .
              '.' .
              explode('/', json_decode($mediaData)->mime_type)[1]
          );
          Log::info('ChatController - receiveWhatsAppMessage - media_link', [
            'data' => $media_link,
          ]);
        }

        // $dealer = \App\Models\Dealer::where('wa_account_phone_number_id', $phone_number_id)->first();
        // if ($dealer) {
        //   $token = $dealer->wa_account_token;
        // }

        // yang adam comment
        // $dealerId = null;

        // $service = new \PHPSupabase\Service(env('SUPABASE_KEY'), env('SUPABASE_URL'));
        // $auth = $service->createAuth();
        // $auth->signInWithEmailAndPassword('dandi@pasima.co', '123456asd');
        // $dataAuth = $auth->data();

        // if (isset($dataAuth->access_token)) {
        //   $db = $service->setBearerToken($dataAuth->access_token)->initializeDatabase('dealers', 'id');
        //   $dealers = $db->findBy('wa_account_phone_number_id', $phone_number_id)->getResult();
        //   if ($dealers) {
        //     $dealer = $dealers[0];
        //     $dealerId = $dealer->id;
        //     $token = $dealer->wa_account_token;
        //   }
        // }
        // yang adam comment

        $response = Http::post(
          'https://graph.facebook.com/v12.0/' . $phone_number_id . '/messages',
          [
            'messaging_product' => 'whatsapp',
            'to' => $from,
            'text' => ['body' => 'Ack: ' . $msg_body],
          ],
          [
            'access_token' => $token,
            'Content-Type' => 'application/json',
          ]
        );

        // Check the response from the API call if needed
        // $response->status();

        $lead = null;
        $leadId = null;
        $leadIsVerified = null;
        $leadDealerId = null;
        // $lead = \App\Models\Lead::where('phone_number', $from)->first();
        // if ($lead) {
        //   $leadDealerId = $lead->dealer_id;
        // }
        if (isset($dataAuth->access_token)) {
          $db = $service->initializeDatabase('leads', 'id');
          $query = [
            'select' => '*',
            'from' => 'leads',
            'where' => [
              'phone_number' => 'eq.' . $from,
              'dealer_id' => 'eq.' . $dealerId,
            ],
          ];
          $leads = $db->createCustomQuery($query)->getResult();
          if ($leads) {
            Log::info('ChatController - sendWhatsAppMessage', [
              'STATUS' => 'ADA',
              'LEAD' => $leads,
            ]);
            $lead = $leads[0];
            $leadId = $lead->id;
            $leadIsVerified = $lead->is_verified;
            $leadDealerId = $lead->dealer_id;
          } else {
            Log::info('ChatController - sendWhatsAppMessage', [
              'STATUS' => 'GA ADA',
              'LEAD' => $leads,
            ]);
            $leads = $db->insert([
              'dealer_id' => $dealerId,
              'phone_number' => $from,
              'is_verified' => false,
            ]);
            $lead = $leads[0];
            $leadId = $lead->id;
            $leadIsVerified = $lead->is_verified;
            $leadDealerId = $lead->dealer_id;
          }
        }

        $requestData = [
          'from' => $from,
          'to' => $display_phone_number,
          'client_phone' => $from,
          'message' => $msg_body,
          'user_id' => null,
          'dealer_id' => $dealer->id,
          'lead_id' => $leadId,
          'lead_is_verified' => $leadIsVerified,
          'type' => $mediaType,
          'media' => $media,
          'media_link' => $media_link,
          'request_body' => null,
          'client_phone' => $display_phone_number,
          'status' => null,
        ];
        Log::info('ChatController - receiveWhatsAppMessage - requestData', [
          'data' => $requestData,
        ]);

        \App\Models\Chat::create($requestData);
        // $chat = new \App\Models\Chat();
        // $chat->setConnection('pgsql');
        // $chat->create($requestData);

        $service = new \PHPSupabase\Service(env('SUPABASE_KEY'), env('SUPABASE_URL'));
        $auth = $service->createAuth();
        $auth->signInWithEmailAndPassword('dandi@pasima.co', '123456asd');
        $dataAuth = $auth->data();
        if (isset($dataAuth->access_token)) {
          $db = $service->setBearerToken($dataAuth->access_token)->initializeDatabase('chats', 'id');
          $db->insert($requestData);
        }

        if ($lead) {
          // $to = \App\Models\User::where('dealer_id', $leadDealerId)
          //   ->get()
          //   ->pluck('fcm_token');
          if (isset($dataAuth->access_token)) {
            $query = $service->initializeQueryBuilder();
            $users = $query
              ->select('fcm_token')
              ->from('profiles')
              ->where('dealer_id', 'eq.' . $dealer->id)
              ->execute()
              ->getResult();
            $to = \Illuminate\Support\Arr::pluck($users, 'fcm_token');
            $title = 'Pesan dari ' . $lead->client_name . '(' . $from . ')';
            $this->sendFCM($to, $title, $msg_body, $img = '', [
              'screen' => 'chat',
              'lead_id' => $leadId,
              'dealer_id' => $leadDealerId,
            ]);
          }
        }

        // \App\Models\Lead::create([
        //   'dealer_id' => '1',
        //   'client_name' => $from,
        //   'phone_number' => $from,
        // ]);

        // Return status code 200
        return response()->json([], 200);
      } else {
        // Return status code 404 if required data not found
        return response()->json([], 404);
      }
    }
  }

  public function createConversation()
  {
    $sid = env('TWILIO_SID');
    $token = env('TWILIO_AUTH_TOKEN');
    $serviceSid = env('TWILIO_CONVERSATIONS_SERVICE_SID');
    $twilio = new Client($sid, $token);

    $conversation = $twilio->conversations->v1->conversations->create(['messagingServiceSid' => $serviceSid]);

    return 'Conversation created: ' . $conversation->sid;
  }

  public function addParticipant($conversationSid, $participantIdentity)
  {
    $sid = env('TWILIO_SID');
    $token = env('TWILIO_AUTH_TOKEN');
    $twilio = new Client($sid, $token);

    $participant = $twilio->conversations->v1
      ->conversations($conversationSid)
      ->participants->create(['messagingBinding.address' => 'whatsapp:' . $participantIdentity]);

    return 'Participant added: ' . $participant->sid;
  }

  public function sendMessageToConversation($conversationSid, $messageBody)
  {
    $sid = env('TWILIO_SID');
    $token = env('TWILIO_AUTH_TOKEN');
    $twilio = new Client($sid, $token);

    $message = $twilio->conversations->v1->conversations($conversationSid)->messages->create([
      'body' => $messageBody,
      'from' => 'system', // Identifikasi dari pengirim pesan, bisa "system" atau pengguna lain
    ]);

    return 'Message sent to conversation: ' . $message->sid;
  }

  public function receiveMessage(Request $request)
  {
    // ... (kode sebelumnya untuk menerima pesan dari pelanggan)

    // Balas pesan ke semua partisipan dalam percakapan Twilio
    $conversationSid = 'YOUR_CONVERSATION_SID'; // Ganti dengan SID percakapan Anda
    $twilio = new \Twilio\Rest\Client(env('TWILIO_ACCOUNT_SID'), env('TWILIO_AUTH_TOKEN'));

    // Mendapatkan daftar partisipan dalam percakapan
    $participants = $twilio->conversations->v1->conversations($conversationSid)->participants->read();

    foreach ($participants as $participant) {
      // Mengirim pesan ke setiap partisipan kecuali pengirim asli pesan
      if ($participant->messagingBinding->address !== $from) {
        $message = $twilio->conversations->v1
          ->conversations($conversationSid)
          ->participants($participant->sid)
          ->messages->create([
            'from' => 'system', // Pengirim pesan
            'body' => $body, // Isi pesan dari pelanggan
          ]);
      }
    }

    // Kirim respon balasan kosong (Twilio membutuhkan respon 200 OK)
    $response = new MessagingResponse();
    return $response;
  }

  public function getWhatsAppMessageHistory($conversationSid)
  {
    $sid = env('TWILIO_ACCOUNT_SID');
    $token = env('TWILIO_AUTH_TOKEN');
    $twilio = new Client($sid, $token);

    // Mendapatkan riwayat pesan dari percakapan tertentu
    $messages = $twilio->conversations->v1->conversations($conversationSid)->messages->read();

    // Menyimpan atau menampilkan riwayat pesan
    foreach ($messages as $message) {
      echo 'From: ' . $message->author . ', Body: ' . $message->body . '<br>';
      // Lakukan sesuatu dengan pesan, misalnya simpan ke database atau tampilkan di aplikasi
    }
  }
}
