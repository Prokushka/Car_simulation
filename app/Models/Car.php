<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Car extends Model
{

    protected $table = 'cars';

    protected $guarded = false;

    public function key(): HasOne
    {
        return $this->hasOne(Key::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
