<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class Order extends Model
{
    public static array $products = [
        '3G',
        '3Gs',
        '4',
        '4s',
        '5',
        '5s',
        '6',
        '6s',
        'SE',
        '7',
        '8',
        'X',
        'PS4',
        'Watch',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'product',
        'price',
        'date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'datetime',
    ];

    public function getHumanizedProductAttribute(): string
    {
        $product = $this->attributes['product'];

        if (in_array($product, ['PS4', 'Watch']))
            return $product;
        else
            return 'iPhone ' . $product;
    }

    public function getHumanizedPriceAttribute(): string
    {
        return number_format($this->attributes['price']) . ' ' . 'تومان';
    }

    public function getJalaliDateAttribute(): string
    {
        return Jalalian::fromCarbon($this->date)->format('Y-m-d');
    }
}
