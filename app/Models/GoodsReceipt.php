<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodsReceipt extends Model
{
    use HasFactory, HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['value', 'date', 'amount', 'product_id'];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'value'      => 'bail|required',
            'date'       => 'bail|required',
            'amount'     => 'bail|required',
            'product_id' => 'bail|required',
        ];
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /*
     | Get's e Set de Entrada de Mercadoria
     */
    public function value():Attribute
    {
        return new Attribute(
            get: fn($value) => number_format($value, 2, ",", "."),
            set: fn($value) => number_format(str_replace(',','.',$value), 2, '.', '')
        );
    }

    public function date():Attribute
    {
        return new Attribute(
            get: fn($value) => Carbon::createfromformat('Y-m-d', $value)->format("d/m/Y"),
            set: fn ($value) => Carbon::parse($value)->format('Y-m-d'),
        );
    }
}
