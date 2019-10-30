<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class StoreValidation extends FormRequest
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
            'username'  => 'required|string|min:4|max:20|unique:users',
            'phone'     => ['nullable','numeric','unique:users','regex:/(\+639|09|9)[0-9]{9}/'],
            'email'     => 'nullable|string|email|max:255|unique:users',
            'password'  => 'required|string|min:4|confirmed',
        ];
    }
}
