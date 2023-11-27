<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'slug',
        'price',
        'live'
    ];

    public function scopeLive($query)
    {
        $query->where('live', true);
    }

    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn (float $price) => money($price / 100),
            set: fn (float $price) => $price * 100,
        )
            ->withoutObjectCaching();
    }

    public function applicationFeeAmount()
    {
        return $this->price->multiply(10)->divide(100);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
