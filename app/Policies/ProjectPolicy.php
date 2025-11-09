<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\Response;

/**
 * ProjectPolicy
 * 
 * Policy class untuk authorization logic pada Project model.
 * Policy ini mengontrol siapa yang boleh melakukan action terhadap projects.
 * 
 * Konsep: User hanya boleh manage projects milik mereka sendiri.
 */
class ProjectPolicy
{
    /**
     * Determine whether the user can view any models.
     * 
     * Semua authenticated users boleh melihat list projects mereka sendiri.
     * 
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        // Semua user yang sudah login boleh view list
        return true;
    }

    /**
     * Determine whether the user can view the model.
     * 
     * User hanya boleh view project milik mereka sendiri.
     * 
     * @param User $user
     * @param Project $project
     * @return bool
     */
    public function view(User $user, Project $project): bool
    {
        // Cek apakah project ini milik user
        return $user->id === $project->user_id;
    }

    /**
     * Determine whether the user can create models.
     * 
     * Semua authenticated users boleh membuat project baru.
     * 
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        // Semua user yang sudah login boleh create project
        return true;
    }

    /**
     * Determine whether the user can update the model.
     * 
     * User hanya boleh update project milik mereka sendiri.
     * 
     * @param User $user
     * @param Project $project
     * @return bool
     */
    public function update(User $user, Project $project): bool
    {
        // Hanya owner yang boleh update
        return $user->id === $project->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     * 
     * User hanya boleh delete project milik mereka sendiri.
     * 
     * @param User $user
     * @param Project $project
     * @return bool
     */
    public function delete(User $user, Project $project): bool
    {
        // Hanya owner yang boleh delete
        return $user->id === $project->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     * 
     * User boleh restore project milik mereka yang sudah di-soft delete.
     * 
     * @param User $user
     * @param Project $project
     * @return bool
     */
    public function restore(User $user, Project $project): bool
    {
        // Hanya owner yang boleh restore
        return $user->id === $project->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     * 
     * User boleh force delete (permanent delete) project milik mereka.
     * 
     * @param User $user
     * @param Project $project
     * @return bool
     */
    public function forceDelete(User $user, Project $project): bool
    {
        // Hanya owner yang boleh force delete
        return $user->id === $project->user_id;
    }
}

