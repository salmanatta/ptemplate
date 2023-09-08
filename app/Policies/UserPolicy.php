<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy extends Policy
{
    public function delete(User $user): Response|bool
    {
        return false;
    }

    public function forceDelete(User $user): Response|bool
    {
        return false;
    }
}
