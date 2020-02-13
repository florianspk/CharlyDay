<?php
namespace CoBoard\modeles;

use Illuminate\Database\Eloquent\Builder;

class Role extends \Illuminate\Database\Eloquent\Model {

    protected $table = 'role';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function users(){
        return $this->hasMany('CoBoard\modeles\Role','user.id');
    }





}
