<?php

namespace App\Api\V1\Http\Requests;

use App\Api\V1\Http\Requests\Request as ApiRequest;

class RegisterNormalRequest extends ApiRequest
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
            'email' => 'required|string|max:45|unique:users|regex:/^([a-zA-Z0-9])([a-zA-Z0-9_\-]*)(\.[a-z0-9_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|same:password',
            'name' => 'required|string|max:45',
            'gender' => 'required|integer|in:1,2',
            'birth_date' => 'required|date_format:"Y-m-d"|',
        ];
    }

    public function messages()
    {
        return [
            'password.min' => trans('validation.password.min'),
            'password_confirmation.same' => trans('validation.password.same'),
            'password_confirmation.required' => trans('validation.password_confirmation.required'),
            'email.regex' => trans('validation.email'),
            'gender.required' => trans('validation.gender.required')
        ];
    }
}
