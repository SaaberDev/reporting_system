<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Http\FormRequest;

class AdminPasswordValidation extends FormRequest
{
    use AuthenticatesUsers;
    /**
     * @var mixed
     */

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
            $this->password() => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }

    public function password(){
        return 'current_pass';
    }
}
