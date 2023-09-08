<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Str;

class Policy
{
    use HandlesAuthorization;

    /**
     * The Permission key that Policy corresponds to.
     */
    protected ?string $modelKey = null;

    public function __construct()
    {
        if (null === $this->modelKey) {
            $modelClass = static::class;

            $modelClass = str_replace(['App\\', 'Policies\\', 'Policy'], ['', '', ''], $modelClass);

            $nestedNameSpaces = explode('\\', $modelClass);

            $modelClass = array_pop($nestedNameSpaces);

            $modelClass = Str::plural(Str::snake($modelClass, '-'));

            if (count($nestedNameSpaces)) {
                $prefix = Str::snake(implode(' ', $nestedNameSpaces), '-');
                $modelClass = $prefix . ' ' . $modelClass;
            }

            $this->modelKey = $modelClass;
        }
    }

    public function before(User $user)
    {
        if ($user->type == 'SADMIN') {
            return true;
        }
    }

    /**
     * @return Response|bool
     */
    public function viewAny(User $user): Response|bool
    {
        return $user->can('list ' . $this->modelKey);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @return Response|bool
     */
    public function view(User $user): Response|bool
    {
        return $user->can('view ' . $this->modelKey);
    }

    /**
     * Determine whether the user can create models.
     *
     * @return Response|bool
     */
    public function create(User $user): Response|bool
    {
        return $user->can('create ' . $this->modelKey);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @return Response|bool
     */
    public function update(User $user): Response|bool
    {
        return $user->can('update ' . $this->modelKey);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @return Response|bool
     */
    public function delete(User $user): Response|bool
    {
        return $user->can('delete ' . $this->modelKey);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @return Response|bool
     */
    public function restore(User $user): Response|bool
    {
        return $user->can('restore ' . $this->modelKey);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @return Response|bool
     */
    public function forceDelete(User $user): Response|bool
    {
        return $user->can('forceDelete ' . $this->modelKey);
    }
}
