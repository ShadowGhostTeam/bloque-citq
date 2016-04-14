<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cultivo extends Model
{
    //

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cultivo';

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
    public function siembras(){
        return $this->hasMany('App\siembraSector', 'id_cultivo', 'id')->orderBy('fecha','asc');
    }

    public function siembrasInvernadero(){
        return $this->hasMany('App\siembraTransplanteInvernadero', 'id_cultivo', 'id');
    }

    public function siembrasPlantula(){
        return $this->hasMany('App\siembraPlantula', 'id_cultivo', 'id');
    }


}
