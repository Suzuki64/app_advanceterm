<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
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
            'name_shop' => 'required',
            'image_path'  => 'image',
            'detail' => 'max:200'
        ];
    }

    public function messages()
    {
        return [
            'name_shop.required' => '店名を入力してください',
            'file.image' => '画像形式（jpg、jpeg、png、bmp、gif、svg、webp）のデータをアップロードしてください',
            'detail.max' => '200字以内でご記入ください'
        ];
    }
}
