<?php

namespace App\Http\Requests\App\Resume;

class StoreResumeRequest extends BaseResumeRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            'position'           => 'required',
            'category_id'        => 'required',
            'employment_type_id' => 'required',
            'user_id'            => 'required',
        ]);
    }
}
