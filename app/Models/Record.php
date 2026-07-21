<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\RecordStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
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
}
