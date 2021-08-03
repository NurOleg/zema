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
            'avatar'            => 'image|nullable',
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

    /**
     * @return array
     */
    public function validationData(): array
    {
        $json = $this->get('data');
        return array_merge(json_decode($json, true), $this->allFiles());
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'string'   => 'The :attribute must be a string.',
            'required' => 'The :attribute is required.',
            'image'    => 'The :attribute must be an image.',
            'numeric'  => 'The :attribute must be a numeric.',
            'in'       => 'The :attribute must be one of the following types: :values',
        ];
    }
}
