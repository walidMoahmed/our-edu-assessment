<?php

namespace App\Http\Requests;

use App\Traits\GeneralTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class FilterCurrencyRequest extends FormRequest
{
    use GeneralTrait;
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|alpha|exists:App\Models\Currency,name',
        ];

    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->returnError($validator->errors()->all(), 422));
    }
}
