<?php

namespace App\Http\Requests\App\Vacancy;

class StoreVacancyRequest extends BaseVacancyRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            'category_id'        => 'required',
            'employment_type_id' => 'required',
            'experience_id'      => 'required',
            'city_id'            => 'required',
            'name'               => 'required',
            'description'        => 'required',
            'user_id'            => 'required',
        ]);
    }
}
