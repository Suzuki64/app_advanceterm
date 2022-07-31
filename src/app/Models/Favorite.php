<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $guarded = array('id');


    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

    public function shops()
    {
        return $this->hasMany('App\Models\Shop');
    }
}
