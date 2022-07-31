<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editor extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public function users()
    {
        return $this->belongstoMany('App\Models\User');
    }

    public function shops()
    {
        return $this->belongstoMany('App\Models\Shop');
    }
}
