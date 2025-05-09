<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TelegramWebhookController extends Controller
{
    public function webhook(Request $request)
    {
        $data = $request->all();
        Log::info('Received Telegram webhook:', $data);

        // Optional: extract and respond
        $chat_id = $data['message']['chat']['id'] ?? null;
        $text = $data['message']['text'] ?? '';

        if ($chat_id && $text) {
            // You can process message here or trigger reply logic
            Log::info("Message from $chat_id: $text");
        }

        return response()->json(['status' => 'received']);
    }
}
