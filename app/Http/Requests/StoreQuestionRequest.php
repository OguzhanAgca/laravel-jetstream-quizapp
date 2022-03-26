<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
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
            'question' => 'required|min:10|max:1000',
            'question_image' => 'nullable|image|max:2048|mimes:jpg,png,jpeg,gif',
            'answer_a' => 'required',
            'answer_b' => 'required',
            'answer_c' => 'required',
            'answer_d' => 'required',
            'correct_answer' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'answer_a' => 'option a',
            'answer_b' => 'option b',
            'answer_c' => 'option c',
            'answer_d' => 'option d',
        ];
    }
}
