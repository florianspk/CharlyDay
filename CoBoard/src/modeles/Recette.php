<?php
namespace fridgie\modeles;
use Illuminate\Database\Eloquent;
use mywishlist\modele\Item;

class Recette extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'recette';
    protected $primaryKey = 'idRecette';
    public $timestamps = false ;

    public function contients() {
        return $this->hasMany('\fridgie\modeles\Contient', 'idRecette');
    }
}