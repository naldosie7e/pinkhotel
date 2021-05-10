<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sucursale extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sucursales';

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
    protected $fillable = ['id_hotel', 'codigo', 'direccion', 'fecha_creacion', 'telefono','nombre'];

    public function hotel()
    {
        return $this->belongsTo(InfoHotel::class, 'id_hotel', 'id');
    }

}
