<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Reviews;
use App\Models\User;

class ReviewsPolicy
{
    public function viewPending(User $user): bool
    {
        return $user->role === UserRole::Admin;
    }

    public function validate(User $user, Reviews $reviews): bool
    {
        return $user->role === UserRole::Admin;
    }

    public function delete(User $user, Reviews $reviews): bool
    {
        return $user->role === UserRole::Admin;
    }
}
