<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
{
/**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */public function authorize()
    {
        return true;
    }
/**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */public function rules()
    {
        return [
      'task' => 'required',
			'tag_id' => 'integer|min:0|max:150',
			'user_id' => 'required'
        ];
    }
}