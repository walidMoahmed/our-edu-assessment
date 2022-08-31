<?php

namespace App\Http\Requests;

use App\Traits\GeneralTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class FilterDateRangeRequest extends FormRequest
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
            'from' => 'required|min:2|date:"Y-m-d"|before_or_equal:'.date('Y-m-d'),
            'to' => 'required|date:"Y-m-d"|after_or_equal:'.$from.'|before_or_equal:'.date('Y-m-d'),
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->returnError($validator->errors()->all(), 422));
    }
}
