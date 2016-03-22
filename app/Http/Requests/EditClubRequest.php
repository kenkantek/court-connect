<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditClubRequest extends Request
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
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'phone' => 'required|max:60',
            'city' => 'required|max:60',
            'state' => 'required|max:60',
            'zipcode' => 'required|max:60',
        ];
    }
}
