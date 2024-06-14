<?php

namespace App\Http\Controllers;

use App\Helpers\PushNotif;
use App\Http\Requests\StoreMessageRequest;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MessageController extends Controller
{
    protected $pushNotif;

    public function __construct(PushNotif $pushNotif)
    {
        $this->pushNotif = $pushNotif;
    }

    public function store(StoreMessageRequest $request, Chat $chat)
    {
        Gate::authorize('create', [Message::class, $chat]);

        try {
            $message = Message::create($request->validated());

            $tsDeviceToken = $chat->common_user->user->device_token;
            if ($tsDeviceToken && $message->user->id != $chat->common_user->user->id) {
                $senderName = $message->user->name;
                $title = "Pesan baru dari $senderName";
                $body = $message->message;
                $this->pushNotif->sendToUser($tsDeviceToken, $title, $body);
            }

            return redirect()->back()->with('success', 'Pesan terkirim.');
        } catch (\Throwable $th) {
            logger()->error($th->getMessage());
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan.'])->withInput();
        }
    }
}
