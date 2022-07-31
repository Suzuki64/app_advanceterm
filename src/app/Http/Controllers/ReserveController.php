<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Reserve;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\ReserveRequest;

class ReserveController extends Controller
{
    public function makeReserve(ReserveRequest $request)
    {
        $auth = Auth::user();
        $form = [    
            'user_id' => $auth->id,
            'shop_id' => $request->input('shop_id'),
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'number' => $request->input('number'),
            ];
        Reserve::create($form);

        return redirect('/reserve/done');
    }

    public function updateReserve(ReserveRequest $request)
    {   
        $form = [    
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'number' => $request->input('number'),
            ];
        Reserve::find($request->id)->update($form);
        return back();
    }

    public function deleteReserve(Request $request)
    {
        Reserve::find($request->id)->delete();
        return back();
    }

    public function done()
    {
        $auth = Auth::user();
        return view('done',compact('auth'));
    }

}
