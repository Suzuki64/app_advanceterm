<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\User;
use App\Models\Reserve;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\EditRequest;

class EditController extends Controller
{
    public function edit()
    {
        $auth = Auth::user();        
        $user = New User();
        $shop_id = $user->getEditorItem($auth->id)->id;

        $items = Shop::JoinAreaGenre()->find($shop_id);
        $area_list = Area::all();
        $genre_list = Genre::all();
        $shop_list = Shop::all();
        $reserve_ins = New Reserve;
        $reserves= Reserve::where('shop_id','=',$shop_id)
        ->take(5)
        ->get();
        
        return view('edit', compact('items','area_list','genre_list','shop_list','reserve_ins','reserves','auth'));
    }

    public function create(EditRequest $request)
    {
        $img = $request->file('image_path');
        
        if(isset($img)){
            $path = $img->store('img','public');
            if ($path) {
                Shop::create([
                    'image_path' => $path,
                    'name_shop' => $request->input('name_shop'),
                    'area_id' => $request->input('area_id'),
                    'genre_id' => $request->input('genre_id'), 
                    'detail' => $request->input('detail')
                    ]);
                }
        }else{
            $shop = $request->all();
            Shop::create($shop);
        }
        return redirect('/edit');
    }

    public function update(EditRequest $request)
    {
        $img = $request->file('image_path');
        
        if(isset($img)){
            $path = $img->store('img','public');
            if ($path) {
                Shop::find($request->id)->update([
                    'image_path' => $path,
                    'name_shop' => $request->input('name_shop'),
                    'area_id' => $request->input('area_id'),
                    'genre_id' => $request->input('genre_id'), 
                    'detail' => $request->input('detail')
                    ]);
                }
        }else{
        $shop = $request->all();
        unset($shop['_token']);
        Shop::find($request->id)->update($shop);
        }
        return redirect('/edit');
    }
}
