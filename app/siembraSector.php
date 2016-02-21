<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class siembraSector extends Model
{
    //

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'siembraSector';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fecha','variedad','tipo','temporada','status','fechaTerminacion','id_sector','id_cultivo'];


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
    public  function sector(){
        return $this->belongsTo('App\sector','id_sector');
    }

    public  function cultivo(){
        return $this->belongsTo('App\cultivo','id_cultivo');
    }


    public function riegos(){
        return $this->hasMany('App\riego', 'id_siembra', 'id')->orderBy('fecha','asc');
    }

    public function fertilizaciones(){
        return $this->hasMany('App\fertilizacion', 'id_siembra', 'id')->orderBy('fecha','asc');
    }

    public function mantenimientos(){
        return $this->hasMany('App\mantenimientoSector', 'id_siembra', 'id')->orderBy('fecha','asc');
    }

    public function cosechas(){
        return $this->hasMany('App\cosecha', 'id_siembra', 'id')->orderBy('fecha','asc');
    }


}
