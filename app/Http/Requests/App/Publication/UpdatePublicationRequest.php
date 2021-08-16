<?php

namespace App\Http\Requests\App\Publication;

class UpdatePublicationRequest extends BasePublicationRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            'deleted_files' => 'array',
        ]);
    }
}
