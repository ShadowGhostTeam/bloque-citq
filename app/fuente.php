<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fuente extends Model
{
    //

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'fuente';

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
    //N a N




    // 1 a N
    public function riegos(){
        return $this->hasMany('App\riego', 'id_fuente', 'id')->orderBy('fecha','asc');
    }

    public  function siembra(){
        return $this->belongsTo('App\siembra','id_siembra');
    }

}
