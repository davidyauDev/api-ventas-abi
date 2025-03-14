<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class SaleRequestForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'code' => 'required|string|max:255|unique:sales,code',
            'customer_name' => 'required|string|max:255',
            'customer_identification' => 'required|string|max:50',
            'customer_email' => 'required|email|max:255',
            'seller' => 'required|string|max:255',
            'sale_date' => 'required|date',
            'products' => 'required|array|min:1',
            'products.*.product_id' => [
                'required',
                'exists:products,id',
                function ($attribute, $value, $fail) {
                    $product = \App\Models\Product::find($value);
                    if (!$product) {
                        $fail("El producto no existe.");
                    }
                },
            ],
            'products.*.quantity' => [
                'required',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) {
                    $index = explode('.', $attribute)[1];
                    $productId = request()->input("products.$index.product_id");
                    $product = \App\Models\Product::find($productId);

                    if ($product && $value > $product->stock) {
                        $fail("El producto '{$product->name}' no tiene suficiente stock disponible.");
                    }
                },
            ],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ], 422));
    }
}
