<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Reserve;
use App\Models\Review;
use App\Models\Shop;
use Illuminate\Http\Request;


class CustomerController extends Controller
{
    public function mypage()
    {
        $auth = Auth::user(); 
        $reserve_ins = New Reserve();
        $review_ins = New Review();
        $reserves = Reserve::leftJoinShop()
                ->where('user_id','=',Auth::user()->id)
                ->orderby('id','desc')
                ->take(5)
                ->get();
        $items = Shop::JoinAreaGenre()
                ->Joinfavorite()
                ->where('user_id','=',Auth::user()->id)
                ->orderby('id','asc')
                ->get();
        $now = time();
        
        return view('mypage', compact('reserve_ins','review_ins','reserves','items','auth','now') );
    }
    
    public function review(Request $request)
    {
        $review = $request->all();
        Review::create($review);
        return back();
    }

    public function addFavo(Request $request)
    { 
        $shop_id = $request->input('shop_id');
        Auth::user()->favo($shop_id );
        return back();
    }

    public function deleteFavo(Request $request)
    {
        $shop_id = $request->input('shop_id');
        Auth::user()->unfavo($shop_id );
        return back();
    }
}
