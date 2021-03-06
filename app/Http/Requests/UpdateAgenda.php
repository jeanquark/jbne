<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAgenda extends FormRequest
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
            'content' => ['required', 'max:470'],
            'new_image' => ['required', 'image', 'dimensions:min_width=200,min_height=200,ratio=1/1']
        ];
    }
}
