<?php

namespace App\Http\Controllers;

use App\Helpers\PushNotif;
use App\Http\Requests\StoreMessageRequest;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

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
                $imagePath = 'avatars/' . $message->user->avatar;
                $imageUrl = Storage::exists('public/' . $imagePath) && $message->user->avatar ? asset('storage/' . $imagePath) : null;
                $payload = [
                    'title' => "Pesan baru",
                    'notificationTitle' => "Pesan baru dari $senderName",
                    'body' => $message->message,
                    'senderName' => $senderName,
                    'image' => $imageUrl
                ];
                $this->pushNotif->sendToUser($tsDeviceToken, $payload);
            }

            return redirect()->back()->with('success', 'Pesan terkirim.');
        } catch (\Throwable $th) {
            logger()->error($th->getMessage());
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan.'])->withInput();
        }
    }
}
