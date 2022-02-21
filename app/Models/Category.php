<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Category extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $fillable = ['description','status'];    
    
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
            return self::where('description','ILIKE', "%{$search}%")->get();
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
            'description' => "bail|required|min:3|max:100|unique:departments,description,$this->id",
            'status'      => 'bail|required',
        ];
    }
    
    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    { 
        return ['description' => $this->description];
    }

    /*
     | Get's e Set de função
     */

    public function description():Attribute
    {
        return new Attribute(
            set: fn($value) => mb_strtoupper($value, 'UTF-8')
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
