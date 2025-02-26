<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    //
    public function rotative_lines(): HasMany
    {
        return $this->hasMany(Rotativeline::class);
    }
}
