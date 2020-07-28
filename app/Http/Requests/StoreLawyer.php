<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLawyer extends FormRequest
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
            'email' => ['required', 'email'],
            'username' => ['required', 'string', 'min:6', 'max:24', 'regex:/^[a-zàâçéèêëîïôûùüÿñæœ_ ,.\'-]+$/i', 'unique:lawyers,username'],
            'password' => ['required', 'min:6', 'confirmed'],
            'password_confirmation' => ['required'],
            'lastname' => ['required', 'min:2', 'max:32', 'regex:/^[a-zàâçéèêëîïôûùüÿñæœ ,.\'-]+$/i'],
            'firstname' => ['required', 'min:2', 'max:32', 'regex:/^[a-zàâçéèêëîïôûùüÿñæœ ,.\'-]+$/i'],
            'phone_mobile' => ['required', 'min:7', 'max:24', 'regex:/^[()+-.\/0-9 ]+$/'],
            // 'street'  => ['required', 'min:2', 'max:64', 'regex:/^[a-z0-9àâçéèêëîïôûùüÿñæœ ,.\'-]+$/i'],
            // 'city' => ['required', 'min:2', 'max:32', 'regex:/^[a-z0-9àâçéèêëîïôûùüÿñæœ ,.\'-]+$/i'],
            // 'phone_office' => ['sometimes', 'nullable', 'min:7', 'max:24', 'regex:/^[()+-.0-9 ]+$/'],
            // 'fax_office' => ['required', 'min:7', 'max:24', 'regex:/^[()+-.0-9 ]+$/'],
            'other_languages_input' => ['string', 'max: 64', 'regex:/^[a-zàâçéèêëîïôûùüÿñæœ ,.\'-]+$/i'],
        ];
    }
}
