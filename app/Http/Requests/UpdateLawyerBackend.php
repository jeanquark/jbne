<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Lawyer;

class UpdateLawyerBackend extends FormRequest
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
        // dd($this->lawyer);
        // dd($this->id);
        $lawyer = Lawyer::findOrFail($this->lawyer);
        // dd($lawyer->id);

        return [
            'email' => ['required', 'email'],
            'username' => ['required', 'string', 'min:6', 'max:24', 'unique:lawyers,username,'.$lawyer->id],
            'lastname' => ['required', 'min:2', 'max:32', 'regex:/^[a-zàâçéèêëîïôûùüÿñæœ ,.\'-]+$/i'],
            'firstname' => ['required', 'min:2', 'max:32', 'regex:/^[a-zàâçéèêëîïôûùüÿñæœ ,.\'-]+$/i'],
            'phone_mobile' => ['required', 'min:7', 'max:24', 'regex:/^[()+-.0-9 ]+$/'],
            // 'street'  => ['required', 'min:2', 'max:64', 'regex:/^[a-z0-9àâçéèêëîïôûùüÿñæœ ,.\'-]+$/i'],
            // 'city' => ['required', 'min:2', 'max:32', 'regex:/^[a-z0-9àâçéèêëîïôûùüÿñæœ ,.\'-]+$/i'],
            // 'phone_office' => ['sometimes', 'nullable', 'min:7', 'max:24', 'regex:/^[()+-.0-9 ]+$/'],
            // 'fax_office' => ['required', 'min:7', 'max:24', 'regex:/^[()+-.0-9 ]+$/'],
            'languages' => ['max:128', 'regex:/^[a-z0-9àâçéèêëîïôûùüÿñæœ ,.\'-]+$/i']
        ];
    }
}
