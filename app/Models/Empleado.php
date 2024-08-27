<?php

namespace App\Models;

use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Empleado extends Model implements Auditable
{
    use HasFactory, Userstamps, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'ap_paterno',
        'ap_materno',
        'nombres',
        'sexo',
        'fecha_nacimiento',
        'edad',
        'estado_civil',
        'nro_hijos',
        'ciudad_id',
        'ci',
        'ci_complemento',
        'ci_lugar',
        'domicilio',
        'nro_libreta_militar',
        'email',
        'nro_celular',
        'nro_telefono',
        'redes_sociales',
        'contacto_nombre',
        'contacto_telefono',
        'contacto_parentesco',
        'profesion_id',
        'formacion_id',
        'institucion_formacion_id',
        'ultimo_empleo',
        'nro_cuenta',
        'banco_id',
        'afp_id',
        'seguro_salud_id',
        'foto',
        'fecha_registro','discapacidad','nit'
    ];
    //relacion con tabla cargo_empleados
    public function cargo(){
        return $this->belongsToMany(Cargo::class,'cargo_empleados','empleado_id','cargo_id')->withPivot('fecha_inicio','fecha_conclusion','cargos.area_id','cargos.tipo_cargo');
    }

    public function documentacion(){
        return $this->hasOne(Documentacion::class);
    }

    public function declaraciones(){
        return $this->hasMany(DeclaracionJurada::class);
    }
    
    public function complementarios(){
        return $this->hasMany(DocumentoComplementario::class);
    }


    public function anios_servicio(){
        return $this->hasMany(AnioServicio::class);
    }
    public function discapacitado(){
        return $this->hasOne(Discapacidad::class);
    }

    public function lactancia(){
        return $this->hasMany(Lactancia::class);
    }
    
    
    public function licencia(){
        return $this->hasMany(Licencia::class);
    }


    public function ciudad(){
        return $this->belongsTo(Ciudad::class);
    }

    public function formacion(){
        return $this->belongsTo(Formacion::class);
    }

    

}
