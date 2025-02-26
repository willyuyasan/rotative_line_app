<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Casts\MoneyCast;

class Rotativeline extends Model
{
    //
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }
 
    public function payment_plan_quotes(): HasMany
    {
        return $this->hasMany(Paymentplanquote::class);
    }

    protected $casts = [
        'financed_amount' => MoneyCast::class,
    ];
}
