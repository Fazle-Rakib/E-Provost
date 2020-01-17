<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //Primary Key
    public $primaryKey = 'user_id';
    public function users(){
        return $this->belongsTo('App\User');
    }
}
