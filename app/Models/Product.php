<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['code', 'image', 'description', 'stock', 'minimumStock',
    'status', 'category_id', 'provider_id', 'warehouse_id'];


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code'         => 'bail|required',
            'image'        => 'bail|nullable|mimes:jpg,bmp,png',
            'description'  => 'bail|required',
            'stock'        => 'bail|required',
            'minimumStock' => 'bail|required',
            'status'       => 'bail|required',
            'category_id'  => 'bail|required',
            'provider_id'  => 'bail|required',
            'warehouse_id' => 'bail|required',
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
            'code' => $this->code,
            'description' => $this->description
        ];
    }

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
            return self::where('description','ILIKE', "%{$search}%")
                ->orWhere('code','ILIKE',"%{$search}%")
                ->get();
        }
    }

    /*
     | Relacionamentos
     */

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function cost()
    {
        return $this->hasMany(Cost::class);
    }

    /*
     | Get's e Set de produtos
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
