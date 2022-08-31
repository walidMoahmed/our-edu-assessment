<?php

namespace App\Http\Requests;

use App\Traits\GeneralTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class FilterAmountRangeRequest extends FormRequest
{
    use GeneralTrait;
    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        $from= $request->from;
        return [
            'from' => 'required|numeric',
            'to' => 'required|numeric|min:'. ($from+1),

        ];

    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->returnError($validator->errors()->all(), 422));
    }
}
