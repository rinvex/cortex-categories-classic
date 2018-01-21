<?php

declare(strict_types=1);

namespace Cortex\Categories\Policies;

use Rinvex\Fort\Models\User;
use Rinvex\Categories\Models\Category;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can list categories.
     *
     * @param string                   $ability
     * @param \Rinvex\Fort\Models\User $user
     *
     * @return bool
     */
    public function list($ability, User $user): bool
    {
        return $user->allAbilities->pluck('slug')->contains($ability);
    }

    /**
     * Determine whether the user can create categories.
     *
     * @param string                   $ability
     * @param \Rinvex\Fort\Models\User $user
     *
     * @return bool
     */
    public function create($ability, User $user): bool
    {
        return $user->allAbilities->pluck('slug')->contains($ability);
    }

    /**
     * Determine whether the user can update the category.
     *
     * @param string                             $ability
     * @param \Rinvex\Fort\Models\User           $user
     * @param \Rinvex\Categories\Models\Category $resource
     *
     * @return bool
     */
    public function update($ability, User $user, Category $resource): bool
    {
        return $user->allAbilities->pluck('slug')->contains($ability);   // User can update categories
    }

    /**
     * Determine whether the user can delete the category.
     *
     * @param string                             $ability
     * @param \Rinvex\Fort\Models\User           $user
     * @param \Rinvex\Categories\Models\Category $resource
     *
     * @return bool
     */
    public function delete($ability, User $user, Category $resource): bool
    {
        return $user->allAbilities->pluck('slug')->contains($ability);   // User can delete categories
    }
}
