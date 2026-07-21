<?php

namespace App\Policies;

use App\Models\Record;
use App\Models\User;

class RecordPolicy
{
    public function view(User $user, Record $record): bool
    {
        return $user->id === $record->user_id;
    }

    public function update(User $user, Record $record): bool
    {
        return $user->id === $record->user_id;
    }

    public function delete(User $user, Record $record): bool
    {
        return $user->id === $record->user_id;
    }
}
