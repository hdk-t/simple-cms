<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ArticlePictureFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'articleId' => $this->route('articleId'),
            'storeType' => $this->route('storeType'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'articleId'  => 'required|exists:App\Models\Article,id',
            'storeType'  => 'required|in:draft,publish',
            'pictureId'  => 'required_if:storeType,publish|integer',
        ];
    }
    
    /**
     * Custom varidation messages
     */
    public function messages(): array
    {
        return [
            'pictureId.required_if' => 'サムネイル画像は必ず選択して下さい。',
        ];
    }
}
