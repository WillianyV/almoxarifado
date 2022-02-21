<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Clemdesign\PhpMask\Mask as Mask;

class Provider extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $fillable = ['name','cnpj', 'status'];   
    
    /*
     | --------------------------------------------
     | Metodos estáticos 
     | --------------------------------------------
     | Exportação
     */
    public static function exports($search = null)
    {
        if ($search == null) {
            return self::all();
        } else {
            return self::where('name','ILIKE', "%{$search}%")
                ->orWhere('cnpj','ILIKE', "%{$search}%")->get();
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'   => "bail|required|min:3|max:100|unique:providers,name,$this->id",
            'cnpj'   => "bail|required|max:18|unique:providers,cnpj,$this->id",
            'status' => 'bail|required',
        ];
    }
    
    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    { 
        return [
            'name' => $this->name, 
            'cnpj' => $this->cnpj
        ];
    }

    /*
     | Get's e Set de função
     */

    public function name():Attribute
    {
        return new Attribute(
            set: fn($value) => mb_strtoupper($value, 'UTF-8')
        );
    }

    public function cnpj():Attribute
    {
        return new Attribute(
            get: fn($value) => Mask::apply($value, '00.000.000/0000-00'),
            set: fn($value) => str_replace(['.','-','/'],'', $value)
        );
    }

    public function status():Attribute
    {
        return new Attribute(
            get: fn($value) => ($value == 1) ? 'Ativo' : 'Desativado',
            set: fn($value) => ($value == 'Ativo') ? 1 : 0
        );
    }
}
