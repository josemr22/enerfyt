<?php

namespace App\Http\Requests;

use App\Models\Color;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Size;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UpdateProductRequest extends FormRequest
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
            'name' => ['required', Rule::unique('products')->ignore($this->product)],
            'code' => ['required', Rule::unique('products')->ignore($this->product)],
            'description' => 'nullable',
            'price' => 'required',
            'category_id' => [
                'required',
                Rule::exists('categories', 'id')
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo nombre es obligatorio',
            'code.required' => 'El campo código de producto es obligatorio',
            'code.unique' => 'Ya existe un producto con el código especificado',
            'precio.required' => 'El campo precio es obligatorio',
            'category_id.required' => 'Se debe asignar una categoría',
        ];
    }

    public function updateProduct(Product $product)
    {
        $product->fill([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'code' => $this->code,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category_id,
        ]);

        $product->save();
    }
}
