<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLawyerOffice extends FormRequest
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
            'name' => ['required', 'min:2', 'max:128', 'regex:/^[a-zàâçéèêëîïôûùüÿñæœ ,.\'-]+$/i'],
            'street' => ['required', 'min:2', 'max:128', 'regex:/^[0-9a-zàâçéèêëîïôûùüÿñæœ ,.()\'-]+$/i'],
            'city' => ['required', 'min:2', 'max:128', 'regex:/^[0-9a-zàâçéèêëîïôûùüÿñæœ ,.()\'-]+$/i'],
            'phone_office' => ['sometimes', 'nullable', 'min:7', 'max:24', 'regex:/^[()+-.0-9 ]+$/'],
            'fax_office' => ['required', 'min:7', 'max:24', 'regex:/^[()+-.\/0-9 ]+$/']
        ];
    }
}
