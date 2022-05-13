<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Cost extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['value', 'initialDate', 'finalDate', 'amount', 'currentAmount', 'product_id'];

    protected $casts = [
        'initialDate' => 'datetime:d/m/Y',
        'finalDate'   => 'datetime:d/m/Y',
        'created_at'  => 'datetime:d/m/Y H:i:s',
        'updated_at'  => 'datetime:d/m/Y H:i:s',
    ];

    /*
     | Relacionamento
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function value():Attribute
    {
        return new Attribute(
            get: fn($value) => number_format($value, 2, ",", "."),
            set: fn($value) => number_format($value, 2, '.', '')
        );
    }
}
