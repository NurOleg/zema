<?php

namespace App\Http\Requests\App\Publication;

use Illuminate\Foundation\Http\FormRequest;

class BasePublicationRequest extends FormRequest
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
            'content' => 'string',
            'user_id' => 'numeric',
        ];
    }
}
