<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PagoReservacione extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pago_reservaciones';

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
    protected $fillable = ['id_reservacion', 'pago_parcial', 'valor_pago', 'fecha_pago', 'medio_pago'];

    public function reservacion()
    {
        return $this->belongsTo('App\Models\Reservacione');
    }
    
}
