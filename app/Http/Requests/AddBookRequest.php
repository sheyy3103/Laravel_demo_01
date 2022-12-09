<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddBookRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'price' => 'required|numeric|gte:1',
            'sale_price' => 'numeric|gte:0|lte:' . request()->price - 1,
            'image' => 'required|mimes:jpg,jpeg,png,gif,svg'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => "Book's name cannot be blank",
            'price.required' => "Price cannot be blank",
            'price.numeric' => "Price must be a number",
            'price.gte' => "Price must be greater than 0",
            'sale_price.numeric' => "Sale price must be a number",
            'sale_price.gte' => "Sale price must be greater than or equal to 0",
            'sale_price.lte' => "The sale price must be less than price",
            'image.required' => "Please select an image",
            'image.mimes' => "Ivalid type of image"
        ];
    }
}
