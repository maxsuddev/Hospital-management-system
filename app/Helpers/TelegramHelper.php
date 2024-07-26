<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class TelegramHelper
{
    /**
     * @throws GuzzleException
     */

    public static function sendMessage($chatId, $message)
    {
        $client = new Client();
        $token = config('services.telegram.bot_token');

        $url = "https://api.telegram.org/bot" . $token . "/sendMessage";

        $response = $client->post($url, [
            'json' => [
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => 'html'

            ],
        ]);


    }



}
