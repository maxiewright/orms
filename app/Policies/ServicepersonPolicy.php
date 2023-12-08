<?php

namespace App\Policies;

use App\Models\Serviceperson;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServicepersonPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_serviceperson');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Serviceperson $serviceperson): bool
    {
        return $user->can('view_serviceperson');
    }

    /**
     * Determine whether the user can create models.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user): bool
    {
        return $user->can('create_serviceperson');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Serviceperson $serviceperson): bool
    {
        return $user->can('update_serviceperson');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Serviceperson $serviceperson): bool
    {
        return $user->can('delete_serviceperson');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_serviceperson');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Serviceperson $serviceperson): bool
    {
        return $user->can('force_delete_serviceperson');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_serviceperson');
    }

    /**
     * Determine whether the user can restore.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Serviceperson $serviceperson): bool
    {
        return $user->can('restore_serviceperson');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_serviceperson');
    }

    /**
     * Determine whether the user can replicate.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function replicate(User $user, Serviceperson $serviceperson): bool
    {
        return $user->can('replicate_serviceperson');
    }

    /**
     * Determine whether the user can reorder.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_serviceperson');
    }
}
