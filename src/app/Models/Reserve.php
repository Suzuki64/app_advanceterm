<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
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

    public function review()
    {
        return $this->hasOne('App\Models\Review');
    }

    public function getUserItem($id)
    {
        return $this->find($id)->user()->first();
    }
    
    public function getShopItem($id)
    {
        return $this->find($id)->shop()->first();
    }
    
    public function getReviewItem($id)
    {
        return $this->find($id)->review()->first();
    }

    public function scopeLeftJoinShop($query){
        $query->leftJoin('shops','shops.id','=','reserves.shop_id')
              ->select('reserves.*','shops.name_shop');
    }

    public function inputToTimestamp($id)
        {
            return mktime(
                date('h',strtotime($this->find($id)->time)),
                date('i',strtotime($this->find($id)->time)),
                0,
                date('m',strtotime($this->find($id)->date)),
                date('d',strtotime($this->find($id)->date)),
                date('y',strtotime($this->find($id)->date))
            );
        }
}
