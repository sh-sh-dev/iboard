<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
