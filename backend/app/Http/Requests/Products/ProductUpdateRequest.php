<?php

namespace App\Http\Requests\Products;

use App\Rules\ImageArrayItemRule;
use App\Rules\ImageArrayRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'images' => new ImageArrayRule($this),
            'images.*' => new ImageArrayItemRule()
        ];
    }
}
