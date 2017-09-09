<?php

declare(strict_types=1);

namespace Cortex\Categories\Policies;

use Rinvex\Fort\Contracts\UserContract;
use Illuminate\Auth\Access\HandlesAuthorization;
use Rinvex\Categories\Contracts\CategoryContract;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can list categories.
     *
     * @param string                              $ability
     * @param \Rinvex\Fort\Contracts\UserContract $user
     *
     * @return bool
     */
    public function list($ability, UserContract $user)
    {
        return $user->allAbilities->pluck('slug')->contains($ability);
    }

    /**
     * Determine whether the user can create categories.
     *
     * @param string                              $ability
     * @param \Rinvex\Fort\Contracts\UserContract $user
     *
     * @return bool
     */
    public function create($ability, UserContract $user)
    {
        return $user->allAbilities->pluck('slug')->contains($ability);
    }

    /**
     * Determine whether the user can update the category.
     *
     * @param string                                        $ability
     * @param \Rinvex\Fort\Contracts\UserContract           $user
     * @param \Rinvex\Categories\Contracts\CategoryContract $resource
     *
     * @return bool
     */
    public function update($ability, UserContract $user, CategoryContract $resource)
    {
        return $user->allAbilities->pluck('slug')->contains($ability);   // User can update categories
    }

    /**
     * Determine whether the user can delete the category.
     *
     * @param string                                        $ability
     * @param \Rinvex\Fort\Contracts\UserContract           $user
     * @param \Rinvex\Categories\Contracts\CategoryContract $resource
     *
     * @return bool
     */
    public function delete($ability, UserContract $user, CategoryContract $resource)
    {
        return $user->allAbilities->pluck('slug')->contains($ability);   // User can delete categories
    }
}
