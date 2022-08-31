<?php

    namespace App\Http\Requests;

    use App\Traits\GeneralTrait;
    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Contracts\Validation\Validator;
    use Illuminate\Http\Exceptions\HttpResponseException;

    class UserRegisterRequest extends FormRequest
    {
        use GeneralTrait;

        public function rules()
        {
            return [
                'name' => 'required|string|between:2,100',
                'email' => 'required|string|email|max:100|unique:users',
                'password' => 'required|string|confirmed|min:6',
            ];
        }
        protected function failedValidation(Validator $validator) {
            throw new HttpResponseException($this->returnError($validator->errors()->all(),422));
        }
    }
