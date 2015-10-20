<?php

namespace App\Http\Requests\Street;

use App\Http\Requests\Request;

class StreetRequest extends Request
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
            'streetKeyName' => 'required',
            'streetKeyCode' => 'required',
            'streetDescription' => 'required'
        ];
    }
}
