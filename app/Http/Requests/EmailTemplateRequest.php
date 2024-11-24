<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailTemplateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Получить сообщения об ошибках для определенных правил валидации.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'id.required' => 'Поле id должно быть заполнено',
            'subj.required' => 'Тема письма не может быть пустой',
            'text.required' => 'Текст письма должен быть заполнен',
        ];
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "id" => ['required', 'integer'],
            "subj" => ['required', 'string'],
            "text" => ['required', 'string'],
        ];
    }
}
