<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla 
    protected $table = 'contrato';

    // Si la tabla no tiene columnas timestamps (created_at, updated_at)
    public $timestamps = false;

    // Define los campos que se pueden llenar
    protected $fillable = ['id', 'codigo', 'aeropuerto', 'fecha_hora_registro', 'tipo_solicitante', 'cliente', 'ci', 'nit', 'domicilio_legal', 'telefono_celular',
                           'correo', 'actividad_principal', 'matricula_comercio', 'garantia', 'saldo_garantia', 'pago_garantia', 'estado', 'representante1', 'numero_documento1', 'expedido1', 'documento_designacion1', 
                           'fecha_emision_documento1', 'notaria1', 'notario1', 'representante2', 'numero_documento2', 'expedido2', 'documento_designacion2', 'fecha_emision_documento2', 
                           'notaria2', 'notario2', 'representante3', 'numero_documento3', 'expedido3', 'documento_designacion3', 'fecha_emision_documento3', 'notaria3', 'notario3'];
}