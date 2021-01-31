<?php

namespace App\Http\Requests;

use App\Rules\TableUsesFromDateRule;
use App\Rules\TableUsesToDateRule;
use Illuminate\Foundation\Http\FormRequest;

class TableUsesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'from_date' => ['required', new TableUsesFromDateRule()],
            'to_date' => ['required', new TableUsesToDateRule()],
            'user_name' => 'required',
            'user_phone' => 'required',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
