<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fertilizacion extends Model
{
    //

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'fertilizacion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fecha','programaNPK','cantidad','id_fuente','id_siembra','id_sector'];


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
    public  function fuente(){
        return $this->belongsTo('App\fuente','id_fuente');
    }
    public  function siembra(){
        return $this->belongsTo('App\siembra','id_siembra');
    }
    public  function sector(){
        return $this->belongsTo('App\sector','id_sector');
    }
}
