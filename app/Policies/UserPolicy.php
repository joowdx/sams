<?php

namespace App\Policies;

use App\User;
use App\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */

     public function admin_view(User $user)
    {
        return in_array($user->type, [
            'admin',
        ]);
    }
    //  NAV VIEWS
    public function map_view(User $user)
    {
        return in_array($user->type, [
            'admin',
            'h.r.'
        ]);
    }

    public function calendar_view(User $user)
    {
        return in_array($user->type, [
            'admin',
            'faculty',
            'd.o.',
            'h.r.'
        ]) || ($user->faculty && $user->faculty->isdepartmenthead()) || ($user->faculty && $user->faculty->isdepartmenthead());
    }

    public function attendance_view(User $user)
    {
        return in_array($user->type, [
            'admin',
            'd.o.',
            'h.r.'
        ]) || ($user->faculty && $user->faculty->isdepartmenthead()) || ($user->faculty && $user->faculty->isdepartmenthead());
    }
    //END NAV VIEWS

    //SIDE VIEWS
    public function programs_view(User $user)
    {
        return in_array($user->type, [
            'admin',
            'depthead',
            'd.o.'
        ]) || ($user->faculty && $user->faculty->isdepartmenthead());
    }

    public function courses_view(User $user)
    {
        return in_array($user->type, [
            'admin',
            'faculty',
            'd.o.'
        ]) || ($user->faculty && $user->faculty->isdepartmenthead()) || ($user->faculty && $user->faculty->isdepartmenthead());
    }

    public function faculties_view(User $user)
    {
        return in_array($user->type, [
            'admin',
            'faculty',
            'd.o.',
            'h.r.'
        ]) || ($user->faculty && $user->faculty->isdepartmenthead()) || ($user->faculty && $user->faculty->isdepartmenthead());
    }

    public function students_view(User $user)
    {
        return in_array($user->type, [
            'admin',
        ]) || ($user->faculty && $user->faculty->isdepartmenthead()) || ($user->faculty && $user->faculty->isdepartmenthead());
    }
    //END SIDE VIEWS

    //DATA
    public function users_data(User $user)
    {
        return in_array($user->type, [
            'admin',
        ]);
    }
    public function academicperiods_data(User $user)
    {
        return in_array($user->type, [
            'admin',
        ])|| ($user->faculty && $user->faculty->isdepartmenthead()) || ($user->faculty && $user->faculty->isdepartmenthead());
    }
    public function courses_data(User $user)
    {
        return in_array($user->type, [
            'admin',
        ])|| ($user->faculty && $user->faculty->isdepartmenthead()) || ($user->faculty && $user->faculty->isdepartmenthead());
    }
    public function faculties_data(User $user)
    {
        return in_array($user->type, [
            'admin',
        ])|| ($user->faculty && $user->faculty->isdepartmenthead()) || ($user->faculty && $user->faculty->isdepartmenthead());
    }
    public function students_data(User $user)
    {
        return in_array($user->type, [
            'admin',
        ])|| ($user->faculty && $user->faculty->isdepartmenthead()) || ($user->faculty && $user->faculty->isdepartmenthead());
    }
    public function programs_data(User $user)
    {
        return in_array($user->type, [
            'admin',
        ])|| ($user->faculty && $user->faculty->isdepartmenthead());
    }
    //END DATA

    public function view(User $user, Course $course)
    {
        return in_array($user->type, [
            'faculty',
            'admin'
        ]);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return in_array($user->type, [
            'admin'
        ]);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function update(User $user)
    {
        return in_array($user->type, [
            'admin'
        ]);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function delete(User $user)
    {
        return in_array($user->type, [
            'admin'
        ]);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function restore(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function forceDelete(User $user, User $model)
    {
        //
    }
}
