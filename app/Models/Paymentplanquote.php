<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Casts\MoneyCast;

class Paymentplanquote extends Model
{
    //
    public function rotative_line(): BelongsTo
    {
        return $this->belongsTo(Rotativeline::class);
    }

    protected $casts = [
        'financed_amount' => MoneyCast::class,
    ];
}
