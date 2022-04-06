<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Clemdesign\PhpMask\Mask as Mask;

class Employee extends Model
{
    use HasFactory, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'code', 'cpf', 'status', 'role_id', 'department_id', 'company_id'];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'    => 'bail|required|min:3',
            'code'    => "bail|required|unique:employees,code,$this->id",
            'cpf'     => "bail|required|cpf|max:14|unique:employees,cpf,$this->id",
            'status'  => 'bail|required',
            'role_id' => 'bail|required',
            'department_id' => 'bail|required',
            'company_id'    => 'bail|required',
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
                ->orWhere('cpf','ILIKE',"%{$search}%")
                ->orWhere('code','ILIKE',"%{$search}%")
                ->with(['role'])
                ->get();
        }
    }

    /*
     | Relacionamentos
     */

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
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

    public function status():Attribute
    {
        return new Attribute(
            get: fn($value) => ($value == 1) ? 'Ativo' : 'Desativado',
            set: fn($value) => ($value == 'Ativo') ? 1 : 0
        );
    }

}
