<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeamMember extends FormRequest
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
            'title' => ['required', 'min:2', 'max:128'],
            'firstname' => ['required', 'min:2', 'max:128'],
            'lastname' => ['required', 'min:2', 'max:128'],
            'status' => ['required', 'min:2', 'max:128'],
            'email' => ['nullable', 'email'],
            'website' => ['nullable', 'url'],
            'linkedIn' => ['nullable', 'url'],
            'image' => ['required', 'image', 'mimes:jpeg,jpg,png', 'dimensions:min_width=300,min_height=300', 'dimensions:ratio=1/1'],
            'order_of_appearance' => ['required', 'integer']
        ];
    }
}
