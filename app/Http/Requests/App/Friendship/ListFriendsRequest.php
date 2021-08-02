<?php

namespace App\Http\Requests\App\Friendship;

use Illuminate\Foundation\Http\FormRequest;

class ListFriendsRequest extends FormRequest
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
            'friends_for_user_id' => 'numeric',
            'birth_city_id'       => 'numeric',
            'current_city_id'     => 'numeric',
            'age_from'            => 'numeric',
            'age_to'              => 'numeric',
        ];
    }
}
