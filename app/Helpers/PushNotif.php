<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class PushNotif
{
    protected $client;
    protected $serverApiKey;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->serverApiKey = env('FCM_SERVER_KEY');
    }

    public function sendToUser(string $token, array $data)
    {
        $payload = [
            "to" => $token,
            "data" => $data,
        ];

        return $this->send($payload);
    }

    public function broadcast(array $tokens, array $data)
    {
        $payload = [
            "registration_ids" => $tokens,
            "data" => $data,
        ];

        return $this->send($payload);
    }

    protected function send(array $payload)
    {
        $headers = [
            'Authorization' => 'key=' . $this->serverApiKey,
            'Content-Type' => 'application/json',
        ];

        try {
            $response = $this->client->post('https://fcm.googleapis.com/fcm/send', [
                'headers' => $headers,
                'json' => $payload,
            ]);

            $responseBody = json_decode($response->getBody()->getContents(), true);

            // Log response for debugging purposes
            Log::info('FCM Response', ['response' => $responseBody]);

            return $responseBody;
        } catch (RequestException $e) {
            Log::error('FCM Request failed: ' . $e->getMessage());
            return false;
        }
    }
}
