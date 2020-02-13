<?php


namespace fridgie\modeles;


class Client extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'client';
    protected $primaryKey = 'idCli';
    public $timestamps = false ;


}