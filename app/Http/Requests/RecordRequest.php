<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\RecordStatus;
use App\Rules\ValidDocumentFile;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Override;

class RecordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'date_time' => ['required', 'date'],
            'status' => [
                'required',
                Rule::enum(RecordStatus::class),
            ],

            'images' => ['nullable', 'array'],
            'images.*' => ['file', 'image', 'max:10240', 'mimes:jpg,jpeg,png,webp'],

            'files' => ['nullable', 'array'],
            'files.*' => ['file', 'max:20480', new ValidDocumentFile()],
        ];
    }

    /**
     * @return array<string, string>
     */
    #[Override]
    public function attributes(): array
    {
        return [
            'name' => 'record name',
            'description' => 'record description',
            'date_time' => 'date and time',
            'status' => 'record status',
        ];
    }
}
