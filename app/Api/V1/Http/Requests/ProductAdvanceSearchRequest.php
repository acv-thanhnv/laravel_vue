<?php

namespace App\Api\V1\Http\Requests;

use App\Api\V1\Http\Requests\Request as ApiRequest;

class ProductAdvanceSearchRequest extends ApiRequest
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
        return [];
    }
}
