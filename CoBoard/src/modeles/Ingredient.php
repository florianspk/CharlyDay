<?php
namespace fridgie\modeles;
use Illuminate\Database\Eloquent;
use mywishlist\modele\Item;

class Ingredient extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'ingredient';
    protected $primaryKey = 'idIngre';
    public $timestamps = false ;

    public function contient() {
        return $this->hasMany('fridgie\modeles\Contient', 'idIngre');
    }
}