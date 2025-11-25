<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;

use function Laravel\Prompts\password;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username'=>'required',
            'password'=>'required',
        ];
    }

    public function getCredentials(){

        $username=$this->get('username');

        if($this->isEmail($username)){
            return[
                'email'=>$username,
                'password'=>$this->get('password')
            ];
        }

        return $this->only('username','password');
    }

    private function isEmail($value){
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

   
}
