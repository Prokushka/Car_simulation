<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;



class Key extends Model
{

    protected $table = 'keys';
    protected $guarded = false;

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }




}
