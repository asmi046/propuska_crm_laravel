<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailReplaceRequest extends FormRequest
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
            'email.required' => 'Поле "e-mail" должно быть заполнено',
            'new_email.required' => 'Поле "Новый e-mail" должно быть заполнено',
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
            'email' => ['required', 'string'],
            'new_email' => ['required', 'string'],
        ];
    }
}
