<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\RecordStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Override;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

#[Fillable([
    'name',
    'description',
    'date_time',
    'status',
])]
class Record extends Model implements HasMedia
{
    use InteractsWithMedia;
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    #[Override]
    protected function casts(): array
    {
        return [
            'date_time' => 'datetime',
            'status' => RecordStatus::class,
        ];
    }

    #[Scope]
    public function search(Builder $query, ?string $search): Builder
    {
        return $query->when(
            filled($search),
            fn(Builder $query) => $query->where(function (Builder $query) use ($search) {
                $query
                    ->whereLike('name', "%{$search}%")
                    ->orWhereLike('description', "%{$search}%");
            })
        );
    }

    #[Scope]
    public function status(Builder $query, ?RecordStatus $status): Builder
    {
        return $query->when(
            $status,
            fn(Builder $query) => $query->where('status', $status)
        );
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
            ->acceptsMimeTypes([
                'image/jpeg',
                'image/png',
                'image/webp',
                'image/gif',
            ]);

        $this->addMediaCollection('files')
            ->acceptsMimeTypes([
                'application/pdf',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/vnd.oasis.opendocument.text',
                'application/vnd.ms-excel', // .xls
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // .xlsx   
                'application/vnd.oasis.opendocument.spreadsheet', // .ods
                'text/markdown',
                'text/plain',
            ]);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(300)
            ->performOnCollections('images')
            ->nonQueued(); // приберіть, якщо у вас налаштовані черги
    }
}
