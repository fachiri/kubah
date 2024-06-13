<?php

namespace App\Policies;

use App\Constants\ComplaintStatus;
use App\Models\Complaint;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ComplaintPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isCommonUser() || $user->isAdmin();
    }

    public function view(User $user, Complaint $complaint): bool
    {
        return $user->isAdmin() || ($user->id == $complaint->user_id);
    }

    public function create(User $user): bool
    {
        return $user->isCommonUser();
    }

    public function update(User $user, Complaint $complaint): bool
    {
        return $user->id == $complaint->user_id && $complaint->status == ComplaintStatus::PENDING;
    }

    public function delete(User $user, Complaint $complaint): bool
    {
        return $user->id == $complaint->user_id && $complaint->status == ComplaintStatus::CANCELED;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Complaint $complaint): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Complaint $complaint): bool
    {
        return false;
    }

    public function process(User $user, Complaint $complaint): bool
    {
        return $user->isAdmin() && $complaint->status == ComplaintStatus::PENDING;
    }

    public function cancel(User $user, Complaint $complaint): bool
    {
        return $user->id == $complaint->user_id && $complaint->status == ComplaintStatus::PENDING;
    }

    public function resolve(User $user, Complaint $complaint): bool
    {
        return $user->isAdmin() && $complaint->status == ComplaintStatus::IN_PROGRESS;
    }
}
