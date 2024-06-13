<?php

namespace App\Policies;

use App\Constants\ChatStatus;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MessagePolicy
{
    public function create(User $user, Chat $chat): bool
    {
        return $chat->status === ChatStatus::OPEN;
    }
}
