<?php

    namespace App\Http\Requests;

    use App\Traits\GeneralTrait;
    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Contracts\Validation\Validator;
    use Illuminate\Http\Exceptions\HttpResponseException;

    class UserLoginRequest extends FormRequest
    {
        use GeneralTrait;

        public function rules()
        {
            return [
                'email' => 'required|string',
                'password' => 'required|',
            ];
        }
        protected function failedValidation(Validator $validator) {
            throw new HttpResponseException($this->returnError($validator->errors()->all(),422));
        }
    }
