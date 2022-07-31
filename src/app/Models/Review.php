<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function shop()
    {
        return $this->belongsTo('App\Models\Shop');
    }

    public function reserve()
    {
        return $this->belongsTo('App\Models\Reserve');
    }
    public function getReserveItem($id)
    {
        return $this->find($id)->reserve()->first();
    }

}
