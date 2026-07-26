<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class RecordMediaController extends Controller
{
    public function show(Record $record, Media $media)
    {
        Gate::authorize('update', $record);

        abort_unless(
            $media->model_type === Record::class &&
            $media->model_id === $record->id,
            404
        );

        return response()->file(
            $media->getPath(),
            [
                'Content-Type' => $media->mime_type.'; charset=UTF-8',
            ]
        );
    }

    public function download(Record $record, Media $media): BinaryFileResponse
    {
        Gate::authorize('update', $record);

        abort_unless(
            $media->model_type === Record::class &&
            $media->model_id === $record->id,
            404
        );

        return response()->download(
            $media->getPath(),
            $media->file_name,
            [
                'Content-Type' => $media->mime_type,
            ]
        );
    }

    public function destroy(Record $record, Media $media): RedirectResponse
    {
        Gate::authorize('update', $record);

        abort_unless($media->model_id === $record->id && $media->model_type === Record::class, 404);

        $media->delete();

        return back();
    }
}
