<?php

namespace App\Policies;

use App\Models\Questionnaire;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionnairePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Questionnaire  $questionnaire
     * @return mixed
     */
    public function view(User $user, Questionnaire $questionnaire)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return in_array($user->email, [
            'admin@mail.com',
        ]);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Questionnaire  $questionnaire
     * @return mixed
     */
    public function update(User $user, Questionnaire $questionnaire)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Questionnaire  $questionnaire
     * @return mixed
     */
    public function delete(User $user, Questionnaire $questionnaire)
    {
        return in_array($user->email, [
            'admin@mail.com',
        ]);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Questionnaire  $questionnaire
     * @return mixed
     */
    public function restore(User $user, Questionnaire $questionnaire)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Questionnaire  $questionnaire
     * @return mixed
     */
    public function forceDelete(User $user, Questionnaire $questionnaire)
    {
        return true;
    }
}
