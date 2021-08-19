<?php

namespace App\Http\Requests\App\Resume;

use Illuminate\Foundation\Http\FormRequest;

class BaseResumeRequest extends FormRequest
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
            'position'           => 'string',
            'experience'         => 'string|nullable',
            'salary'             => 'numeric|nullable',
            'category_id'        => 'numeric',
            'employment_type_id' => 'numeric',
            'user_id'            => 'numeric',
        ];
    }
}
