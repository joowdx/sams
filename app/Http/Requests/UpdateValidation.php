<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UpdateValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(!Auth::user())
        {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type'      => 'required|in:d.o.,admin,h.r.,registrar,student,faculty',
            'name'      => 'required|string|max:255',
            'username'  => 'required|string|min:4|max:20|unique:users,username,' . $this->user,
            'phone'     => 'required|numeric|unique:users,phone,' . $this->user,
            'email'     => 'required|string|email|max:255|unique:users,email,' . $this->user,
            'password'  => 'sometimes|nullable|min:4|confirmed',
            'faculty_id' => 'sometimes|nullable|exists:faculties,id|unique:users,faculty_id,' . $this->user
        ];
    }
}
