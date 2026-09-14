<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Security extends Model
{
    protected $fillable = [
        'name',
        'ticker',
        'ISIN',
        'price',
        'type',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];
    
    public function holdings()
    {
        return $this->hasMany(Holding::class);
    }
}
