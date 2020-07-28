<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrainee extends FormRequest
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
            'content' => [],
            'image' => ['image', 'mimes:jpeg,jpg,png', 'dimensions:min_width=300,min_height=200,ratio=3/2'],
            // 'image' => ['required', 'image', 'mimes:jpeg,jpg,png', 'dimensions:min_width=300,min_height=200']
            'file' => ['file', 'mimes:pdf', 'max:5000'], // max size is in kilobytes
            'order_of_appearance' => ['required']
        ];
    }
}
