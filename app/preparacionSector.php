<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class preparacionSector extends Model
{
    //

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'preparacionSector';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fecha','numPasadas','id_maquinaria'];


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
    public  function sector(){
        return $this->belongsTo('App\sector','id_sector');
    }


    public  function maquinaria(){
        return $this->belongsTo('App\maquinaria','id_maquinaria');
    }




}
