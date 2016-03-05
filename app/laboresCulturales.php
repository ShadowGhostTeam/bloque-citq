<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class laboresCulturales extends Model
{
    //

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'laboresCulturales';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fecha','actividad','id_invernadero','id_stInvernadero'];


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
