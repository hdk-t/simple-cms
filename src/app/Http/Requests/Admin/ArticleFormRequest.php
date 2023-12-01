<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ArticleFormRequest extends FormRequest
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
            'storeType'   => 'required|in:draft,next',
            'title'       => 'required_if:storeType,next|nullable|max:250',
            'tags'        => 'nullable|array',
            'body'        => 'required_if:storeType,next|nullable|max:60000',
        ];
    }
    
    /**
     * Custom varidation messages
     */
    public function messages(): array
    {
        return [
            'title.max'             => '記事タイトルは最大250文字までです。',
            'title.required_if'     => '記事タイトルは必須です。',
            'body.max'              => '記事本文は最大60,000文字までです。',
            'body.required_if'      => '記事本文は必須です。',
        ];
    }
}
