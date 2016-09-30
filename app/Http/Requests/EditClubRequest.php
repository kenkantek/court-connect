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
        $flat_fee = $this->input('flat_fee') ? $this->input('flat_fee') : null;
        if($flat_fee != null){
            return [
                'name' => 'required|max:255',
                'address' => 'required|max:255',
                'phone' => 'required|max:60',
                'city' => 'required|max:60',
                'state' => 'required|max:60',
                'zipcode' => 'required|max:60',
                'price_flat_fee' => 'required|numeric|min:0',
                'down_box_flat_fee' => 'required|in:monthly,quarterly,yearly',
            ];
        }else {
            return [
                'name' => 'required|max:255',
                'address' => 'required|max:255',
                'phone' => 'required|max:60',
                'city' => 'required|max:60',
                'state' => 'required|max:60',
                'zipcode' => 'required|max:60',
                'otb_front_per' => 'required|numeric|min:0|max:100',
                'otb_front_mon' => 'required|numeric|min:0',
                'otb_back_per' => 'required|numeric|min:0|max:100',
                'otb_back_mon' => 'required|numeric|min:0',
                'ctb_front_per' => 'required|numeric|min:0|max:100',
                'ctb_front_mon' => 'required|numeric|min:0',
                'ctb_back_per' => 'required|numeric|min:0|max:100',
                'ctb_back_mon' => 'required|numeric|min:0',
            ];
        }
    }
}
