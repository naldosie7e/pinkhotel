<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalificacionReservacion extends Model
{
   /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'calificacion_reservacion';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_reservacion', 'calificacion_hotel', 'calificacion_habitacion', 'calificacion_atencion', 'observacion'];
}