<?php


namespace CoBoard\modeles;


class Client extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'client';
    protected $primaryKey = 'idCli';
    public $timestamps = false ;

    function role(){
        return $this->belongsTo('CoBoard\modeles\role','id');
    }
}