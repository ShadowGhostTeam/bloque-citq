<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class salidaPlanta extends Model
{
    //

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'salidaPlanta';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fecha','descripcion','id_invernaderoPlantula','id_siembraPlantula'];


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
    public  function siembra(){
        return $this->belongsTo('App\siembraPlantula','id_siembraPlantula');
    }
    public  function invernadero(){
        return $this->belongsTo('App\invernadero','id_invernaderoPlantula');
    }
}
