<?php

namespace App\Http\Requests\App\Respond;

use Illuminate\Foundation\Http\FormRequest;

class StoreRespondRequest extends FormRequest
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
            'vacancy_id' => 'numeric',
            'resume_id'  => 'numeric',
            'letter'     => 'string|nullable',
        ];
    }
}
