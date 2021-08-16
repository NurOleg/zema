<?php

namespace App\Http\Requests\App\Vacancy;

use Illuminate\Foundation\Http\FormRequest;

class BaseVacancyRequest extends FormRequest
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
            'category_id'        => 'numeric',
            'employment_type_id' => 'numeric',
            'experience_id'      => 'numeric',
            'city_id'            => 'numeric',
            'salary_from'        => 'numeric|nullable',
            'salary_to'          => 'numeric|nullable',
            'name'               => 'string',
            'description'        => 'string',
            'user_id'            => 'numeric',
        ];
    }
}
