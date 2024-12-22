<?php

namespace App\Policies;

use App\Models\Confirmation;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ConfirmationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isSuperAdmin() || $user->isSecretary() || $user->isUser();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Confirmation $confirmation): bool
    {
        return $user->isSuperAdmin() || $user->isSecretary();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isSuperAdmin() || $user->isSecretary();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Confirmation $confirmation): bool
    {
        return $user->isSuperAdmin() || $user->isSecretary();
        
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Confirmation $confirmation): bool
    {
        return $user->isSuperAdmin();
        
    }
     /**
     * Determine whether the user can delete the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->isSuperAdmin();
        
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Confirmation $confirmation): bool
    {
        return $user->isSuperAdmin();
     
    }
     /**
     * Determine whether the user can restore the model.
     */
    public function restoreAny(User $user): bool
    {
        return $user->isSuperAdmin();
     
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Confirmation $confirmation): bool
    {
        return $user->isSuperAdmin();
        
    }
     /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->isSuperAdmin();
        
    }
}

