<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ParcelRequest extends Request
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
            'parcelName' => 'required',
            'parcelWeight' => 'required|numeric|digits_between:1,100',
            'parcelCategory' => 'required'
        ];
    }
}
