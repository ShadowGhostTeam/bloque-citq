<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class siembraPlantula extends Model
{
    //

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'siembraPlantula';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fecha','variedad','destino','status','fechaTerminacion','id_cultivo','id_invernaderoPlantula'];


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
    //N a N




    // 1 a N


    public function salidas(){
        return $this->hasMany('App\salidaPlanta', 'id_siembraPlantula', 'id')->orderBy('fecha','asc');
    }
    public  function invernadero(){
        return $this->belongsTo('App\invernaderoPlantula','id_invernaderoPlantula');
    }

    public  function cultivo(){
        return $this->belongsTo('App\cultivo','id_cultivo');
    }


}
