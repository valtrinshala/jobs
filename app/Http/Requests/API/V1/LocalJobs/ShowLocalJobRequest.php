<?php

namespace App\Http\Requests\API\V1\LocalJobs;

use Illuminate\Foundation\Http\FormRequest;

class ShowLocalJobRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'min:2', 'max:5000'],
            'description' => ['nullable', 'min:2', 'max:5000'],
            'deadline' => ['nullable', 'date'],
            'url' => ['nullable', 'url'],
        ];
    }
}
