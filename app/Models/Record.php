<?php

namespace App\Models;

use App\Enums\RecordStatus;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $fillable = [
        'name',
        'description',
        'date_time',
        'status',
    ];
    protected function casts(): array
    {
        return [
            'date_time' => 'datetime',
            'status' => RecordStatus::class,
        ];
    }
}
