<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAuthorRequest extends FormRequest
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
            'name' => 'required|unique:author,name,' . request()->id
        ];
    }
    public function messages()
    {
        return [
            'name.required' => "Author's name cannot be blank",
            'name.unique' => "Author's name is already taken"
        ];
    }
}
