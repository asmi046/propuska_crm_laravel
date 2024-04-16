<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NumberEditRequest extends FormRequest
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
            'truc_number.required' => 'Поле "Госномер" должно быть заполнено',
            'email.required' => 'Поле "e-mail" должно быть заполнено',
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
            'truc_number' => ['required', 'string'],
            'email' => ['required', 'string'],
            'email_dop' => [],
            'phone' => [],
        ];
    }
}
