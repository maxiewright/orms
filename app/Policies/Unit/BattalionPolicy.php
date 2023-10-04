<?php

namespace App\Policies\Unit;

use App\Models\User;
use App\Models\Unit\Battalion;
use Illuminate\Auth\Access\HandlesAuthorization;

class BattalionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_metadata::battalion');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Unit\Battalion  $battalion
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Battalion $battalion): bool
    {
        return $user->can('view_metadata::battalion');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user): bool
    {
        return $user->can('create_metadata::battalion');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Unit\Battalion  $battalion
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Battalion $battalion): bool
    {
        return $user->can('update_metadata::battalion');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Unit\Battalion  $battalion
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Battalion $battalion): bool
    {
        return $user->can('delete_metadata::battalion');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_metadata::battalion');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Unit\Battalion  $battalion
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Battalion $battalion): bool
    {
        return $user->can('force_delete_metadata::battalion');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_metadata::battalion');
    }

    /**
     * Determine whether the user can restore.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Unit\Battalion  $battalion
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Battalion $battalion): bool
    {
        return $user->can('restore_metadata::battalion');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_metadata::battalion');
    }

    /**
     * Determine whether the user can replicate.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Unit\Battalion  $battalion
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function replicate(User $user, Battalion $battalion): bool
    {
        return $user->can('replicate_metadata::battalion');
    }

    /**
     * Determine whether the user can reorder.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_metadata::battalion');
    }

}
