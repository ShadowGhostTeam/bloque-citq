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
    protected $table = 'invernaderoPlantula';

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
        return $this->hasMany('App\siembraPlantula', 'id_invernaderoPlantula', 'id')->orderBy('fecha','asc');
    }

    public function preparaciones(){
        return $this->hasMany('App\preparacionPlantula', 'id_invernaderoPlantula', 'id')->orderBy('fecha','asc');
    }


    public function salidas(){
        return $this->hasMany('App\salidaPlanta', 'id_invernaderoPlantula', 'id')->orderBy('fecha','asc');
    }
}
