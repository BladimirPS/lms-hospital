<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Subdirection;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubdirectionPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Subdirection');
    }

    public function view(AuthUser $authUser, Subdirection $subdirection): bool
    {
        return $authUser->can('View:Subdirection');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Subdirection');
    }

    public function update(AuthUser $authUser, Subdirection $subdirection): bool
    {
        return $authUser->can('Update:Subdirection');
    }

    public function delete(AuthUser $authUser, Subdirection $subdirection): bool
    {
        return $authUser->can('Delete:Subdirection');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Subdirection');
    }

    public function restore(AuthUser $authUser, Subdirection $subdirection): bool
    {
        return $authUser->can('Restore:Subdirection');
    }

    public function forceDelete(AuthUser $authUser, Subdirection $subdirection): bool
    {
        return $authUser->can('ForceDelete:Subdirection');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Subdirection');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Subdirection');
    }

    public function replicate(AuthUser $authUser, Subdirection $subdirection): bool
    {
        return $authUser->can('Replicate:Subdirection');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Subdirection');
    }

}