<?php

namespace App\Http\Requests\App\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'avatar'            => 'string|nullable',
            'name'              => 'string|required',
            //'phone'             => 'string|regex:/(7)[0-9]{9}/',
            'education'         => 'string|nullable|in:' . implode(',', User::EDUCATION),
            'help_needed'       => 'string|nullable',
            'help_offer'        => 'string|nullable',
            'areas_of_interest' => 'string|nullable',
            'career'            => 'string|nullable',
            'age'               => 'numeric|nullable',
            'birth_city_id'     => 'numeric|required',
            'current_city_id'   => 'numeric|required',
            'surname'           => 'string|required',
            'patronymic'        => 'string|nullable',
            'gender'            => 'string|required|in:' . implode(',', User::GENDER),
        ];
    }

    ///**
    // * @return array
    // */
    //public function validationData(): array
    //{
    //    $json = $this->get('data');
    //    return array_merge(json_decode($json, true), $this->allFiles());
    //}

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'avatar.image'             => 'A avatar must be image',
            'name.required'            => 'A name is required',
            'name.string'              => 'A name must be string',
            'education.in'             => 'A education must be one of: ' . implode(',', User::EDUCATION),
            'gender.in'                => 'A gender must be one of: ' . implode(',', User::GENDER),
            'education.string'         => 'A education must be string',
            'gender.string'            => 'A gender must be string',
            'surname.string'           => 'A surname must be string',
            'surname.required'         => 'A surname is required',
            'patronymic.string'        => 'A patronymic must be string',
            'birth_city_id.numeric'    => 'A birth_city_id must be numeric',
            'age.numeric'              => 'A age must be numeric',
            'current_city_id.numeric'  => 'A current_city_id must be numeric',
            'help_needed.string'       => 'A help_needed must be string',
            'help_offer.string'        => 'A help_offer must be string',
            'areas_of_interest.string' => 'A areas_of_interest must be string',
            'career.string'            => 'A career must be string',
        ];
    }
}
