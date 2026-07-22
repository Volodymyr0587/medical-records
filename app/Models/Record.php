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

#[Fillable([
    'name',
    'description',
    'date_time',
    'status',
])]
class Record extends Model
{
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
            fn (Builder $query) => $query->where(function (Builder $query) use ($search) {
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
            fn (Builder $query) => $query->where('status', $status)
        );
    }
}
