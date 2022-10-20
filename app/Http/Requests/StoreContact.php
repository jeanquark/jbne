<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContact extends FormRequest
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
        // dd('abc');

        return [
            'nom' => ['required', 'min:2', 'max:32', 'regex:/^[a-zàâçéèêëîïôûùüÿñæœ ,.\'-]+$/i'],
            'prenom' => ['required', 'min:2', 'max:32', 'regex:/^[a-zàâçéèêëîïôûùüÿñæœ ,.\'-]+$/i'],
            'email' => ['required', 'email'],
            'message' => ['required','max:2048', "regex:/^[a-zàâçéèêëîïôûùüÿñæœ0-9?$@#()'!,+\-=_:.&€£*%\s]+$/i"],
            'g-recaptcha-response' => ['required', 'captcha']
        ];
    }
}
