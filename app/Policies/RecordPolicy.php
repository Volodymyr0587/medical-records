<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Record;
use App\Models\User;

class RecordPolicy
{
    public function update(User $user, Record $record): bool
    {
        return $user->is($record->user);
    }
}
