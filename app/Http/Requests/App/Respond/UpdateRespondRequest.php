<?php

namespace App\Http\Requests\App\Respond;

use App\Models\Respond;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRespondRequest extends FormRequest
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
            'status' => 'numeric|required|in:' . implode(',', array_keys(Respond::STATUSES)),
        ];
    }
}
