<?php

namespace App\Policies\Metadata;

use App\Models\User;
use App\Models\Metadata\OfficerAppraisalGrade;
use Illuminate\Auth\Access\HandlesAuthorization;

class OfficerAppraisalGradePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_metadata::officer::appraisal::grade');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, OfficerAppraisalGrade $officerAppraisalGrade): bool
    {
        return $user->can('view_metadata::officer::appraisal::grade');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_metadata::officer::appraisal::grade');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, OfficerAppraisalGrade $officerAppraisalGrade): bool
    {
        return $user->can('update_metadata::officer::appraisal::grade');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, OfficerAppraisalGrade $officerAppraisalGrade): bool
    {
        return $user->can('delete_metadata::officer::appraisal::grade');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_metadata::officer::appraisal::grade');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, OfficerAppraisalGrade $officerAppraisalGrade): bool
    {
        return $user->can('force_delete_metadata::officer::appraisal::grade');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_metadata::officer::appraisal::grade');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, OfficerAppraisalGrade $officerAppraisalGrade): bool
    {
        return $user->can('restore_metadata::officer::appraisal::grade');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_metadata::officer::appraisal::grade');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, OfficerAppraisalGrade $officerAppraisalGrade): bool
    {
        return $user->can('replicate_metadata::officer::appraisal::grade');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_metadata::officer::appraisal::grade');
    }
}
