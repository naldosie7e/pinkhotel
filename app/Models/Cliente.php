<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'clientes';

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
    protected $fillable = ['users_id', 'numero_documento', 'nombre', 'apellidos', 'genero', 'edad', 'fecha_nacimiento', 'correo_electronico', 'telefono'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
}
