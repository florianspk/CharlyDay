<?php


namespace CoBoard\modeles;


use Illuminate\Database\Eloquent\Model;

class Creneau extends Model
{
    protected $table = 'creneau';
    protected $primaryKey = 'id_creneau';
    public $timestamps = false ;

    public function cycle() {
        return $this->belongsTo('CoBoard\modeles\Cycle','id_cycle');
    }
}