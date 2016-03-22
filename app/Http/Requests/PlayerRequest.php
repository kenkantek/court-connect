<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PlayerRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => "required|email|unique:users,email",
            'password' => "required",
            'cfrpassword' => "required|same:password",
        ];
    }
    public function messages()
    {
        return [
            'firstname.required' => "Please Enter First Name",
            'lastname.required' => "Please Enter Last Name",
            'email.required' => "Please Enter Email",
            'email.email' => "Email Is Not Correct",
            'email.unique' => "Email Is Exists",
            'password.required' => "Please Enter Password",
            'cfrpassword.required' => "Please Enter Confirm Password",
            'cfrpassword.same' => "Password Is Not Match",
        ];
    }
}
