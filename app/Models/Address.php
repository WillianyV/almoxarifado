<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Clemdesign\PhpMask\Mask as Mask;

class Address extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['address','number','district','zip_code','city','state'];

    /*
     | Aqui estão os get's e set's de endereço
     */

    public function address():Attribute
    {
        return new Attribute(
            set: fn($value) => mb_strtoupper($value, 'UTF-8')
        );
    }

    public function number():Attribute
    {
        return new Attribute(
            set: fn($value) => strtoupper($value)
        );
    }

    public function district():Attribute
    {
        return new Attribute(
            set: fn($value) => mb_strtoupper($value, 'UTF-8')
        );
    }

    public function zip_code():Attribute
    {
        return new Attribute(
            get: fn($value) => Mask::apply($value, '00000-000'),
            set: fn($value) => str_replace(['-'], '', $value)
        );
    }

    public function city():Attribute
    {
        return new Attribute(
            set: fn($value) => mb_strtoupper($value, 'UTF-8')
        );
    }

    public function state():Attribute
    {
        return new Attribute(
            set: fn($value) => strtoupper($value)
        );
    }

}
