<?php

namespace App\Http\Controllers;

use App\Constants\ChatStatus;
use App\Http\Requests\StoreChatRequest;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('viewAny', Chat::class);

        $chatQuery = Chat::query();

        if (auth()->user()->isCommonUser()) {
            $chatQuery->where('common_user_id', auth()->user()->common_user->id);
        }

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $chatQuery->where(function ($query) use ($searchTerm) {
                $query->where('subject', 'like', '%' . $searchTerm . '%')
                    ->orWhere('status', 'like', '%' . $searchTerm . '%');
            });
        }

        $chats = $chatQuery->latest()->paginate(10);

        return view('pages.chats.index', compact('chats'));
    }

    public function create()
    {
        Gate::authorize('create', Chat::class);

        return view('pages.chats.create');
    }

    public function store(StoreChatRequest $request)
    {
        Gate::authorize('create', Chat::class);

        try {
            $chat = Chat::create($request->validated());

            $name = $chat->is_anonim == 1 ? 'Anonim' : $chat->common_user->user->name;
            Message::create([
                'chat_id' => $chat->id,
                'is_system' => 1,
                'message' => "$name memulai konsultasi."
            ]);

            return redirect()->route('chats.show', $chat->ulid)->with('success', 'Anda memulai obrolan baru.');
        } catch (\Throwable $th) {
            logger()->error($th->getMessage());
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan.'])->withInput();
        }
    }

    public function show(Chat $chat)
    {
        Gate::authorize('view', $chat);

        return view('pages.chats.show', compact('chat'));
    }

    public function close(Chat $chat)
    {
        Gate::authorize('close', $chat);

        try {
            $chat->status = ChatStatus::CLOSED;
            $chat->update();

            $name = $chat->is_anonim == 1 ? 'Anonim' : $chat->common_user->user->name;
            Message::create([
                'chat_id' => $chat->id,
                'is_system' => 1,
                'message' => "$name menutup konsultasi."
            ]);

            return redirect()->back()->with('success', 'Sesi konsultasi telah ditutup.');
        } catch (\Throwable $th) {
            logger()->error($th->getMessage());
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan.']);
        }
    }
}
