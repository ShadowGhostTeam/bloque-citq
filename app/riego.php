<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class riego extends Model
{
    //

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'riego';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fecha','tiempo','distanciaLineas','litrosHectarea','lamina','id_siembra','id_sector'];


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
        return $this->belongsTo('App\siembraSector','id_siembra');
    }
    public  function sector(){
        return $this->belongsTo('App\sector','id_sector');
    }
}
