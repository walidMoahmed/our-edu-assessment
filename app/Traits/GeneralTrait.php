<?php
namespace App\Traits;


trait GeneralTrait
{
    public function getCurrentLang(){
        return app()->getLocale();
    }

    public function returnError($message,$code){
        return response()->json([
           'status' => false,
           'message' => $message
        ],$code);
    }

    public function returnSuccessMessage($message = ""){
        return response()->json(['status' => true, 'message' => $message],200);
    }

    public function returnDate($key, $value, $message){
        return response()->json([
           'status' => true,
           'message' => $message,
            $key => $value
        ],200);
    }

    public function returnCodeAccordingToInput($validator){
        $inputs = array_keys($validator->errors()->toArray());
        $code = $this->getErrorCode($inputs[0]);
        return $code;
    }

    public function getErrorCode($input){
        if ($input =="email")
            return 'E001';
        else if ($input == "password")
            return 'E002';
    }

    public function returnValidationError($validator){
        return $this->returnError($validator->errors()->first());
    }


}
