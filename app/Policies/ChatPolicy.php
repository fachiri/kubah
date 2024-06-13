<?php

namespace App\Policies;

use App\Constants\ChatStatus;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ChatPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isCommonUser() || $user->isVolunteer();
    }

    public function view(User $user, Chat $chat): bool
    {
        return ($user->isCommonUser() && $user->common_user->id == $chat->common_user_id) || $user->isVolunteer();
    }

    public function create(User $user): bool
    {
        return $user->isCommonUser();
    }

    public function close(User $user, Chat $chat): bool
    {
        return $user->id === $chat->common_user->user_id && $chat->status === ChatStatus::OPEN;
    }
}
