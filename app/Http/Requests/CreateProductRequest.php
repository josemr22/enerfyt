<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class CreateProductRequest extends FormRequest
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
            'name' => ['required', 'unique:products,name'],
            'code' => ['required', 'unique:products,code'],
            'description' => 'nullable',
            'price' => 'required',
            'category_id' => [
                'required',
                Rule::exists('categories', 'id')//->whereNull('deleted_at')
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo nombre es obligatorio',
            'name.unique' => 'Ya existe un producto con el mismo nombre',
            'code.required' => 'El campo código de producto es obligatorio',
            'code.unique' => 'Ya existe un producto con el código especificado',
            'price.required' => 'El campo precio es obligatorio',
            'category_id.required' => 'Se debe asignar una categoría',
        ];
    }

    public function createProduct()
    {
        DB::transaction(function () {
            $product = Product::create([
                'name' => $this->name,
                'slug' => Str::slug($this->name),
                'code' => $this->code,
                'description' => $this->description ?? null,
                'price' => $this->price,
                'category_id' => $this->category_id,
            ]);

            $product->save();
        });
    }
}
