<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuizRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->type === 'admin' ? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'quiz_title' => 'required|min:2|max:150|unique:App\Models\Quiz,quiz_title',
            'quiz_description' => 'nullable|min:10|max:1000',
            'finished_at' => 'nullable|after:' . now()
        ];
    }
}
