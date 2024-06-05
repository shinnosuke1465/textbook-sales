<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TextbookRequest extends FormRequest
{
    const FORM_ITEMS = [
        'name' => '商品名',
        'description' => '商品の説明',
        'university_id' => '大学',
        'faculty_id' => '学部',
        'condition' => '商品の状態',
        'price' => '販売価格',
    ];


    const RULES = [
        'name' => ['required', 'string','max:255'],
        'description' => ['required', 'string','max:2000'],
        'condition'   => ['required', 'integer'],
        'university_id' => ['required', 'integer'],
        'faculty_id' => ['required', 'integer'],
        'price'       => ['required', 'integer', 'min:100', 'max:9999999'],
    ];

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
    public function rules()
    {
        return self::RULES;
    }

    public function attributes()
    {
        return self::FORM_ITEMS;
    }
}
