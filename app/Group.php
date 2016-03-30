<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'groups';

    // one to one
    //tem um usuario
    public function user()
    {
        return $this->hasOne('App\User');
    }

    

    public function permissions()
    {
        return $this->belongsToMany('App\Permission','group_permission');
    }
}
