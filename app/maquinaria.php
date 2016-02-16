<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class maquinaria extends Model
{
    //

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'maquinaria';

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
    public function preparacionesSector(){
        return $this->hasMany('App\preparacionSector', 'id_maquinaria', 'id')->orderBy('fecha','asc');
    }





}
