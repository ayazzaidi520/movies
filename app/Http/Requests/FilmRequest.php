<?php

namespace App\Http\Requests;

use App\Services\MediaService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Str;

class FilmRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:255', 'unique:films'],
            'slug' => ['required'],
            'genre' => ['required'],
            'media' => ['required', File::image()->max(6 * 1024)],
            'rating' => ['required', 'digits_between:1,5'],
            'country' => ['required', 'max:255'],
            'description' => ['required'],
            'release_date' => ['required', 'date_format:Y-m-d'],
            'ticket_price' => ['required', 'lt:1000000'],
            'media_id' => "nullable",
        ];
    }

    /**
     * Passed the data for validation.
     *
     * @return void
     */
    protected function passedValidation()
    {
        $media = app(MediaService::class)->store($this);
        $this->merge([
            'media_id' => $media->id,
        ]);
    }

    /**
     * Passed the data for validation.
     *
     * @return void
     */
    protected function prepareforValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->name),
        ]);
    }
}
