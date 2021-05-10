<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Habitacione extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'habitaciones';

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
    protected $fillable = ['id_sucursal', 'clasificacion', 'valor_dia','estado','numero_habitacion'];

    public function hotel()
    {
        return $this->belongsTo('App\Models\Sucursale');
    }

}