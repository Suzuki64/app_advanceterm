<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Shop;
use App\Models\Role;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Editor;
use Illuminate\Http\Request;
use App\Http\Requests\EditRequest;
use App\Http\Requests\ClientRequest;

class AdminController extends Controller
{
    public function admin()
    {
        $auth = Auth::user();
        $users = User::all();
        $role_list = Role::all();    
        $area_list = Area::all();
        $genre_list = Genre::all();
        $shop_list = Shop::all();
        $editor = new Editor();
        $user = new User();
        
        return view('admin', compact('users','role_list','area_list','genre_list','shop_list','editor','user','auth'));
    }

    public function createUser(ClientRequest $request){

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role_id' => $request->input('role')
        ]);
        
        return back();
    }

    public function updateUser(Request $request)
    {
        $user_info = $request->all();
        unset($user_info['_token']);

        User::find($request->user_id)->update($user_info);

        return redirect('/admin');
    }

    public function addEditor(Request $request){ 
        $shop_id = $request->input('shop_id');
        $user_id = $request->input('user_id');

        Shop::find($shop_id)->setEditor($user_id );

        return back();
    }

    public function delEditor(Request $request){
        $user_id = $request->input('user_id');
        Editor::where('user_id',$user_id)->delete();

        return back();
    }

    public function createShop(EditRequest $request){
        $form = $request->all();
        $shop = Shop::create($form);
        
        return redirect('/admin');   
    }
}
