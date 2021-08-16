<?php

namespace App\Http\Requests\App\Vacancy;

use Illuminate\Foundation\Http\FormRequest;

class ListVacancyRequest extends FormRequest
{
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
            'salary'             => 'numeric',
        ];
    }
}
