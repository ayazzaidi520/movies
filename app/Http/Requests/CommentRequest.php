<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'comment' => ['required'],
            'film_id' => ['required', 'exists:films,id'],
            'user_id' => ['required', 'exists:users,id'],
        ];
    }

    /**
     * Passed the data for validation.
     *
     * @return void
     */
    protected function prepareforValidation()
    {
        $this->merge([
            'user_id' => Auth()->Id(),
        ]);
    }
}
