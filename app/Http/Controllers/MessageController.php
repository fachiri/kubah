<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MessageController extends Controller
{
    public function store(StoreMessageRequest $request, Chat $chat)
    {
        Gate::authorize('create', [Message::class, $chat]);

        try {
            Message::create($request->validated());

            return redirect()->back()->with('success', 'Pesan terkirim.');
        } catch (\Throwable $th) {
            logger()->error($th->getMessage());
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan.'])->withInput();
        }
    }
}
