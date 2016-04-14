<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invernaderoPlantula extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'invernadero_plantula';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','descripcion'];


    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['remember_token'];

    // Task model
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    // 1 a N
    public function siembras(){
        return $this->hasMany('App\siembraPlantula', 'id_invernaderoPlantula', 'id');
    }

    public function aplicaciones(){
        return $this->hasMany('App\aplicacionesPlantula', 'id_invernaderoPlantula', 'id');
    }
    public function riegos(){
        return $this->hasMany('App\riegoPlantula', 'id_invernaderoPlantula', 'id');
    }

    public function salidas(){
        return $this->hasMany('App\salidaPlanta', 'id_invernaderoPlantula', 'id');
    }
}
