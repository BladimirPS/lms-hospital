<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Diploma;
use Illuminate\Auth\Access\HandlesAuthorization;

class DiplomaPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Diploma');
    }

    public function view(AuthUser $authUser, Diploma $diploma): bool
    {
        return $authUser->can('View:Diploma');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Diploma');
    }

    public function update(AuthUser $authUser, Diploma $diploma): bool
    {
        return $authUser->can('Update:Diploma');
    }

    public function delete(AuthUser $authUser, Diploma $diploma): bool
    {
        return $authUser->can('Delete:Diploma');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Diploma');
    }

    public function restore(AuthUser $authUser, Diploma $diploma): bool
    {
        return $authUser->can('Restore:Diploma');
    }

    public function forceDelete(AuthUser $authUser, Diploma $diploma): bool
    {
        return $authUser->can('ForceDelete:Diploma');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Diploma');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Diploma');
    }

    public function replicate(AuthUser $authUser, Diploma $diploma): bool
    {
        return $authUser->can('Replicate:Diploma');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Diploma');
    }

}