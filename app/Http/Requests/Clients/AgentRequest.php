<?php

namespace App\Http\Requests\Clients;

use App\Http\Requests\Request;

class AgentRequest extends Request
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

            'businessNumber' => 'required',
            'agentName' => 'required',
            'agentEmail' => 'required',
            'agentMobileNumber' => 'required | numeric',
            'openingHourWeekDay' => 'required',
            'closingHourWeekDay' => 'required',
            'openingHourSaturday' => 'required',
            'closingHourSaturday' => 'required',
            'openingHourSunday' => 'required',
            'closingHourSunday' => 'required'

        ];
    }
}
