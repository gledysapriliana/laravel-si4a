<?php

namespace App\Policies;

use App\Models\Prodi;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProdiPolicy
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
    public function view(User $user, Prodi $prodi): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin'; //hanya admin yang boleh nambahin ditabel Prodi
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Prodi $prodi): bool
    {
        return $user->role === 'admin'; //hanya admin yang boleh update ditabel Prodi 
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Prodi $prodi): bool
    {
        return $user->role === 'admin'; //hanya admin yang boleh hapus ditabel Prodi 
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Prodi $prodi): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Prodi $prodi): bool
    {
        return false;
    }
}
