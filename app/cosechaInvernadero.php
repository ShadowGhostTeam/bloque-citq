<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cosechaInvernadero extends Model
{
    //

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cosechaInvernadero';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','comentario','id_invernadero','id_stInvernadero'];


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
    public  function siembraTransplante(){
        return $this->belongsTo('App\siembraTransplanteInvernadero','id_stInvernadero');
    }
    public  function invernadero(){
        return $this->belongsTo('App\invernadero','id_invernadero');
    }
}
