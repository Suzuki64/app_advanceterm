<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
    
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
    
    public function favorite_shops()
    {
        return $this->belongsToMany('App\Models\User','favorites','shop_id','user_id');
    }

    public function reserve_shops()
    {
        return $this->belongsToMany('App\Models\User','reserves','shop_id','user_id');
    }

    public function scopeJoinfavorite($query){
        $query -> join('favorites','favorites.shop_id','=','shops.id');
    }

    public function scopeJoinAreaGenre($query){
        $query->join('areas','areas.id','=','shops.area_id')
            ->join('genres','genres.id','=','shops.genre_id' )
            ->select('shops.*','areas.name_area','genres.name_genre');
    }

    public function scopeWhereArea($query,$name_area){
        if($name_area != ''){
            return $query->where('name_area','=',$name_area);
        }
    }

    public function scopeWhereGenre($query,$name_genre){
        if($name_genre != ''){
            return $query->where('name_genre','=',$name_genre);
        }
    }

    public function scopeWhereKeyword($query,$keyword){
        if($keyword != ''){
            return $query->where('name_shop','like',"%{$keyword}%")
                        ->orwhere('detail','like',"%{$keyword}%");
        }
    }

    public function editors()
    {
        return $this->belongsToMany('App\Models\User','editors','shop_id','user_id');
    }

    public function setEditor($user_id)
    {
        $this->editors()->syncWithoutDetaching($user_id);
    }

    public function unsetEditor($user_id)
    {
        $this->editors()->detach($user_id);
    }
}