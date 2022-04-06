<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Clemdesign\PhpMask\Mask as Mask;

class Company extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $fillable = ['cnpj', 'fantasyName', 'corporateName', 'status', 'address_id', 'warehouse_id'];

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
            return self::where('fantasyName', 'ILIKE', "%{$search}%")
                ->orWhere('cnpj', 'ILIKE', "%{$search}%")
                ->get();
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
            'cnpj'          => "bail|required|min:3|max:100|unique:companies,cnpj,$this->id",
            'fantasyName'   => 'bail|required|max:100',
            'corporateName' => 'bail|required|max:100',
            'status'        => 'bail|required',
            'address_id'    => 'bail|required',
        ];
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return ['fantasyName' => $this->fantasyName, 'cnpj' => $this->cnpj];
    }

    /*
     | Relacionamentos
     */

    public function warehouse()
    {
        //Um usuario pertence a um almoxarifado
        return $this->belongsTo(Warehouse::class);
    }

    public function address()
    {
        //Uma empresa pertence a um endereço
        return $this->belongsTo(Address::class);
    }

    /*
     | Get's e Set de empresa
     */
    public function cnpj():Attribute
    {
        return new Attribute(
            get: fn($value) => Mask::apply($value, '00.000.000/0000-00'),
            set: fn($value) => str_replace(['.','-','/'],'', $value)
        );
    }

    public function fantasyName():Attribute
    {
        return new Attribute(
            set: fn($value) => mb_strtoupper($value, 'UTF-8')
        );
    }

    public function corporateName():Attribute
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
