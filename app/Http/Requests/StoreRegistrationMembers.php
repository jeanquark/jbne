<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegistrationMembers extends FormRequest
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
            'firstname' => ['required', 'min:2', 'max:32', 'regex:/^[a-zàâçéèêëîïôûùüÿñæœ ,.\'-]+$/i'],
            'lastname' => ['required', 'min:2', 'max:32', 'regex:/^[a-zàâçéèêëîïôûùüÿñæœ ,.\'-]+$/i'],
            'email' => ['required', 'email', 'unique:members,email'],
            'rue' => ['required', 'max:64', 'regex:/^[a-zàâçéèêëîïôûùüÿñæœ0-9 ,.\'-]+$/i'],
            'localite' => ['required', 'max:64', 'regex:/^[a-zàâçéèêëîïôûùüÿñæœ0-9 ,.\'-]+$/i'],
            'statut' => ['required'],
            'password'  => ['required', 'min:6', 'confirmed'],
            'password_confirmation' => ['required'],
            'g-recaptcha-response' => 'required|captcha'
        ];
    }
}
