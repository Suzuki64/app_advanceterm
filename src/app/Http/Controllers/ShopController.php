<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Reserve;
use Illuminate\Http\Request;
use simplesoftwareio\QrCode\Facades\QrCode;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $auth = Auth::user(); 
        
        $name_area = $request->input('name_area');
        $name_genre = $request->input('name_genre');
        $keyword = $request->input('keyword');
        
        $area_list = Area::all();
        $genre_list = Genre::all();

        $items = Shop::JoinAreaGenre()
                ->WhereArea($name_area)
                ->WhereGenre($name_genre)
                ->WhereKeyword($keyword)
                ->orderby('id','asc')
                ->get();
 
        return view('index', compact('name_area','name_genre','keyword','area_list','genre_list','items','auth') );
    }

    public function shopDetail($shop_id)
    {
        $auth = Auth::user(); 
        $items = Shop::JoinAreaGenre()->find($shop_id);     
        $reserves= Reserve::where('user_id','=',Auth::user()->id)
                    ->where('shop_id','=',$shop_id)
                    ->take(2)
                    ->get();

        return view('detail',compact('items','reserves','auth'));
    }
}