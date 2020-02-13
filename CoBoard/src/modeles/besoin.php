<?php


namespace CoBoard\modeles;


class besoin extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'besoin';
    protected $primaryKey = ['role_id','creneau_id'];
    public $timestamps = false ;

    public function role(){
        return $this->belongsTo('CoBoard\modeles\Role','id');
    }

    public function creneau(){
        return $this->belongsTo('CoBoard\modeles\Creneau' , 'id');
    }

}