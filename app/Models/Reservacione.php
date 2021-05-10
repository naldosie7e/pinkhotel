<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservacione extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'reservaciones';

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
    protected $fillable = ['id_hotel', 'id_sucursal', 'id_habitacion', 'dias_reservacion', 'valor_reservacion', 'id_cliente', 'estado'];

    public function hotel()
    {
        return $this->belongsTo(InfoHotel::class, 'id_hotel', 'id');
    }
    public function sucursal()
    {
        return $this->belongsTo(Sucursale::class, 'id_sucursal', 'id');
    }
    public function habitacion()
    {
        return $this->belongsTo(Habitacione::class, 'id_habitacion', 'id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id');
    }

}