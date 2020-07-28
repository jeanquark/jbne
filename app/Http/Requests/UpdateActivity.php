<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateActivity extends FormRequest
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
            'content' => ['required'],
            'image' => ['required', 'new_image', 'dimensions:min_width=300,min_height=200,ratio=3/2']
        ];
    }
}
