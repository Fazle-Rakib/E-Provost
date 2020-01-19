<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //Primary Key
    public $primaryKey = 'user_id';
    public function user(){
        return $this->belongsTo('App\User');
    }
}
