<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeedBackRequest extends FormRequest
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
            'name' => 'required|max: 100',
            'email' => 'required|email|max: 100',
            'message' => 'required',
        ];
    }

    public function messages() {
        return [
            'required' => 'Поле обязательно к заполнению',
            'email' => 'Поле должно быть e-mail адресом',
            'max' => 'Поле не должно превышать длину в 100 символов',
        ];
    }
}
