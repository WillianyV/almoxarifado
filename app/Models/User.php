<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Clemdesign\PhpMask\Mask as Mask;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'cpf', 'password', 'type', 'status', 'warehouse_id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'     => 'bail|required|min:3',
            'cpf'      => "bail|required|cpf|max:14|unique:users,cpf,$this->id",
            'password' => 'bail|required|min:8|max:20',
            'type'     => 'bail|required',
            'status'   => 'bail|required',
            'warehouse_id' => 'bail|required'
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
            return self::where('name','ILIKE', "%{$search}%")
                ->orWhere('cpf','ILIKE',"%{$search}%")->get();
        }
    }

    /*
     | Relacionamentos
     */

    public function warehouse()
    {
        //Um usuario pertence a um almoxarifado
        return $this->belongsTo(Warehouse::class);
    }

    /*
     | Get's e Set de user
     */

    public function name():Attribute
    {
        return new Attribute(
            set: fn($value) => mb_strtoupper($value, 'UTF-8')
        );
    }

    public function cpf():Attribute
    {
        return new Attribute(
            get: fn($value) => Mask::apply($value, '000.000.000-00'),
            set: fn($value) => str_replace(['.','-'],'', $value)
        );
    }

    public function password():Attribute
    {
        return new Attribute(
            set: fn($value) => Hash::make($value)
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
