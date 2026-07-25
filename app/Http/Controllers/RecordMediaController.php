<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class RecordMediaController extends Controller
{
    public function destroy(Record $record, Media $media): RedirectResponse
    {
        Gate::authorize('update', $record);

        abort_unless($media->model_id === $record->id && $media->model_type === Record::class, 404);

        $media->delete();

        return back();
    }
}
