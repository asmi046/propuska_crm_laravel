<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
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
            'truc_number.unique' => 'Такой госномер уже есть в базе',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        // Log::channel("pms")->debug('hello example request');
        // Log::channel("pms")->debug($this);

        return [
            'truc_number' => ['required',
            'string',
            Rule::unique('car_numbers')->ignore($this->item_id)

            // 'unique:car_numbers,truc_number'
        ],

            'email' => [],
            'email_dop' => [],
            'email_dop2' => [],
            'phone' => [],
        ];
    }
}
