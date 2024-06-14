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

    /**
     * Kirim notifikasi kepada satu user dengan token tertentu.
     *
     * @param string $token
     * @param string $title
     * @param string $body
     * @param array $data
     * @return mixed
     */
    public function sendToUser(string $token, string $title, string $body, array $data = [])
    {
        $payload = [
            "to" => $token,
            "notification" => [
                "title" => $title,
                "body" => $body,
            ],
            // "data" => $data,
        ];

        return $this->send($payload);
    }

    /**
     * Broadcast notifikasi kepada array tokens.
     *
     * @param array $tokens
     * @param string $title
     * @param string $body
     * @param array $data
     * @return mixed
     */
    public function broadcast(array $tokens, string $title, string $body, array $data = [])
    {
        $payload = [
            "registration_ids" => $tokens,
            "notification" => [
                "title" => $title,
                "body" => $body,
            ],
            // "data" => $data,
        ];

        return $this->send($payload);
    }

    /**
     * Fungsi untuk mengirim payload ke FCM.
     *
     * @param array $payload
     * @return mixed
     */
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
