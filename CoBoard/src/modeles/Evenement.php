<?php


namespace fridgie\modeles;


class Evenement extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'evenement';
    protected $primaryKey = 'idEvent';
    public $timestamps = false ;

    public function recette() {
        return $this->belongsTo('\fridgie\modeles\Recette', 'idRecette');
    }

    public function participe() {
        return $this->hasMany('\fridgie\modeles\Participe', 'idEvent');
    }

    public function apporte() {
        return $this->hasMany('\fridgie\modeles\Apporte', 'idEvent');
    }
}