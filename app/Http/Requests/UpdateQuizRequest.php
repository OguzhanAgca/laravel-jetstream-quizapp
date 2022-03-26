<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateQuizRequest extends FormRequest
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
        $id = $this->route('quiz'); // Resource Controller Route'undan Eriştik

        return [
            'quiz_title' => ['required', 'min:2', 'max:150', Rule::unique('quizzes', 'quiz_title')->ignore($id, 'quiz_id')],
            'quiz_description' => 'nullable|min:10|max:1000',
            'quiz_status' => 'required',
            'finished_at' => 'nullable|after:' . now()
        ];
    }
}
