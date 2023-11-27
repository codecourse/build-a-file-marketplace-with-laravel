<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'paid_at',
        'stripe_session_id',
        'price',
        'token'
    ];

    protected $casts = [
        'paid_at' => 'datetime'
    ];

    public static function booted()
    {
        static::creating(function ($sale) {
            $sale->token = Str::random(128);
        });
    }

    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn (float $price) => money($price / 100)
        );
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
