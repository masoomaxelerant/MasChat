<?php

namespace App\Policies;

use App\Models\Maschat;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MasChatPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Maschat $maschat): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Maschat $maschat): bool
    {
        $this->authorize('update', $maschat);
        if ($user->cannot('update', $maschat)) {
          abort(403);
        }
        return $maschat->user()->is($user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Maschat $mashat): bool
    {
        this->authorize('delete', $maschat);
        if ($user->cannot('delete', $maschat)) {
          abort(403);
        }
        return $maschat->user()->is($user);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Maschat $maschat): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Maschat $maschat): bool
    {
        return false;
    }
}
