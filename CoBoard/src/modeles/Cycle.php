<?php


namespace CoBoard\modeles;


use Illuminate\Database\Eloquent\Model;

class Cycle extends Model

{
    protected $table = 'cycle';
    protected $primaryKey = ['role_id','creneau_id'];
    public $timestamps = false ;

    public function creneau(){
        return $this->hasMany('CoBoard\modeles\Creneau' , 'id_creneau');
    }
}