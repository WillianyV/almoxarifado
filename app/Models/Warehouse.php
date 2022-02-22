<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Warehouse extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $fillable = ['description', 'address_id', 'status'];

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

    /*
     | Relacionamentos
     */

    public function address()
    {
        //Um Almoxarefado pertence a um endereço
        return $this->belongsTo(Address::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'description' => "bail|required|min:3|max:100|unique:warehouses,description,$this->id",
            'status'      => 'bail|required',
            'address'     => 'bail|required|min:3|max:150',
            'district'    => 'bail|required|min:2|max:150',
            'number'      => 'bail|required|string',
            'city'        => 'bail|required|min:3|max:150',
            'state'       => 'bail|required|max:2',
            'zipcode'     => 'bail|required|max:9',
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
