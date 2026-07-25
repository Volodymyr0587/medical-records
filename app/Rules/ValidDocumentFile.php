<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Http\UploadedFile;
use Illuminate\Translation\PotentiallyTranslatedString;

class ValidDocumentFile implements ValidationRule
{
    private const ALLOWED_MIME_TYPES = [
        'application/pdf',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/vnd.oasis.opendocument.text',
        'application/vnd.ms-excel', // .xls
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // .xlsx
        'application/vnd.oasis.opendocument.spreadsheet', // .ods
        'text/markdown',
        'text/plain',
    ];

    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$value instanceof UploadedFile) {
            $fail('The :attribute must be a file.');

            return;
        }

        if (!in_array($value->getMimeType(), self::ALLOWED_MIME_TYPES, true)) {
            $fail('The :attribute must be a document (pdf, doc, docx, odt, md, txt).');
        }
    }
}
