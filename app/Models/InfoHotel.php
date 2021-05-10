<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfoHotel extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'info_hotels';

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
    protected $fillable = ['codigo', 'nit', 'nombre', 'fecha_creacion', 'representante_legal', 'telefono'];

    
}
