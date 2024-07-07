<?php

namespace App\Http\Controllers\apps;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Twilio\Rest\Client;
use Auth;
class Chat extends Controller
{
  public function index()
  {
    $userId = Auth::user()->id;
    return view('content.apps.app-chat', [
        'userId' => $userId,
        'user' => Auth::user()
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

  public function sendWhatsAppMessage(Request $request)
  {
    $sid = env('TWILIO_SID');
    $token = env('TWILIO_AUTH_TOKEN');
    $twilio = new Client($sid, $token);

    \App\Models\Chat::create([
      'from' => env('TWILIO_WHATSAPP_FROM'),
      'to' => $request->phone,
      'body' => $request->message,
      'user_id' => $request->user_id,
    ]);

    $message = $twilio->messages->create(
      'whatsapp:' . $request->phone, // to
      [
        'from' => 'whatsapp:' . env('TWILIO_WHATSAPP_FROM'), // from
        'body' => $request->message,
      ]
    );

    return 'Message sent: ' . $message;
  }

  public function receiveWhatsAppMessage(Request $request)
  {
    $sid = env('TWILIO_SID');
    $token = env('TWILIO_AUTH_TOKEN');
    $twilio = new Client($sid, $token);

    // Mendapatkan data dari Twilio
    $from = $request->From; // Nomor pengirim
    $body = $request->Body; // Isi pesan

    if (strpos($from, 'whatsapp:') !== false) {
      // Remove "whatsapp:" from the body
      $from = str_replace('whatsapp:', '', $from);
    }

    // Lakukan sesuatu dengan pesan yang diterima
    // Misalnya, simpan pesan ke database atau jalankan logika tertentu
    Log::info($request->all());
    \App\Models\Chat::create([
      'from' => $from,
      'to' => env('TWILIO_WHATSAPP_FROM'),
      'message' => $body,
    ]);
    // Kirim respon balasan kosong (Twilio membutuhkan respon 200 OK)
    return response()->json('Message Saved', 200);
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
