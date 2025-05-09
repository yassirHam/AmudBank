<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramBotService
{
    // Send a message to a user
    public function sendTelegramMessage($chat_id, $message)
    {
        $bot_token = env('TELEGRAM_BOT_TOKEN');
        $url = "https://api.telegram.org/bot{$bot_token}/sendMessage";

        $response = Http::post($url, [
            'chat_id' => $chat_id,
            'text' => $message,
        ]);

        if ($response->successful()) {
            return true;
        } else {
            Log::error("Failed to send Telegram message", ['response' => $response->body()]);
            return false;
        }
    }

    // Set webhook for the bot
    public function setWebhook()
    {
        $bot_token = env('TELEGRAM_BOT_TOKEN');  // Get the bot token from .env file
        $webhook_url = "https://3f4e-196-65-171-33.ngrok-free.app/telegram/webhook";  // Your ngrok URL
    
        // Telegram setWebhook API URL
        $url = "https://api.telegram.org/bot{$bot_token}/setWebhook?url={$webhook_url}";

        // Disable SSL verification (for development only! Do not use in production)
        $response = Http::withOptions([
            'verify' => false
        ])->post($url);
        
        if ($response->successful()) {
            return true;
        } else {
            Log::error("Failed to set webhook", ['response' => $response->body()]);
            return false;
        }
    }
}
