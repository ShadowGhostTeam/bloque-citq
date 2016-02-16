<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sector extends Model
{
    //

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sector';

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
        return $this->hasMany('App\siembraSector', 'id_sector', 'id')->orderBy('fecha','asc');
    }

    public function preparaciones(){
        return $this->hasMany('App\preparacionSector', 'id_sector', 'id')->orderBy('fecha','asc');
    }

    public function riegos(){
        return $this->hasMany('App\riego', 'id_sector', 'id')->orderBy('fecha','asc');
    }

    public function fertilizaciones(){
        return $this->hasMany('App\fertilizacion', 'id_sector', 'id')->orderBy('fecha','asc');
    }

    public function mantenimientos(){
        return $this->hasMany('App\mantenimientoSector', 'id_sector', 'id')->orderBy('fecha','asc');
    }

    public function cosechas(){
        return $this->hasMany('App\cosecha', 'id_sector', 'id')->orderBy('fecha','asc');
    }




}
