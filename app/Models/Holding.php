<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Holding extends Model
{
    use HasFactory;

    protected $fillable = [
        'portfolio_id',
        'security_id',
        'quantity',
        'purchase_price',
        'purchase_date',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'purchase_price' => 'decimal:2',
        'purchase_date' => 'date',
    ];

    protected function profit(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->security->price === null) {
                    return null;
                }
            
                return $this->quantity * ($this->security->price - $this->purchase_price);
            },
        );
    }

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }

    public function security()
    {
        return $this->belongsTo(Security::class);
    }
}
