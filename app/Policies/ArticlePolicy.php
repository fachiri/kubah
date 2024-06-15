<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ArticlePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Article $article): bool
    {
        return ($user->isVolunteer() && $user->id == $article->user_id) || $user->isAdmin();
    }

    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isVolunteer();
    }

    public function update(User $user, Article $article): bool
    {
        return ($user->isVolunteer() && $user->id == $article->user_id) || $user->isAdmin();
    }
}
