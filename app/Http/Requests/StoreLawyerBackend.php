<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLawyerBackend extends FormRequest
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
            'firstname' => ['required', 'min:2', 'max:32'],
            'lastname'  => ['required', 'min:2', 'max:32'],
            'email' => ['required', 'email', 'max:64'],
            'username' => ['required', 'string', 'min:6', 'max:24', 'unique:lawyers,username'],
            'password'  => ['required', 'min:6', 'confirmed'],
            'password_confirmation' => ['required']
        ];
    }
}
