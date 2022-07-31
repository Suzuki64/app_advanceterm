@extends('layouts.layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="detail-box">
  <div class="shop-detail-box">
    <div class="shop-name-box">
      <div class="shop-name-icon" ><</div>
      <div class="shop-name">&nbsp;{{$items->name_shop}}</div>
    </div>

    <div class="shop-img">
      <img src="{{ Storage::url($items->image_path) }}" alt="準備中">
    </div>

    <div class="shop-tag">
      #{{$items->name_area}}&nbsp;#{{$items->name_genre}}
    </div>

    <div class="shop-detail">
      {{$items->detail}}
    </div>
  </div>

  
   <div class="reserve-box">
      <div class="reserve-ttl">予約</div>
      <form  class="reserve-form" action="/reserve/make" method="post">
        @csrf
        <div class="reserve-form-item">
          <div><input type="hidden" name='shop_id' value="{{$items->id}}"></div>
          <div><input type="date" name='date' value={{old('date')}}></div>
          <div><input type="time" name='time' value={{old('time')}}></div>
          <div><input type="text" name='number' value={{old('number')}}></div>
          @error('number')
          <div class="error-message">{{$message}}</div> 
          @enderror
        </div>
        @foreach($reserves as $reserve)
        <div class="reserve-table-box">
          <table class="reserve-desc-table">
            <form action="/reserve/delete" method='post'>
            @csrf
            <tr>
              <th>shop</th>
              <td><input type="text" value="{{$items->name_shop}}"></td>
            </tr>
            <tr>
              <th>date</th>
              <td><input type="text" value="{{$reserve->date}}"></td>
            </tr>
            <tr>
              <th>time</th>
              <td><input type="text" value="{{$reserve->time}}"></td>
            </tr>
            <tr>
              <th>number</th>
              <td><input type="text" value="{{$reserve->number}}"></td>
            </tr>
              <input type="hidden" name='id' value="{{$reserve->id}}">
            <tr>
              <th><button type="submit">取消</button></th>
            </tr>
            </form>
          </table>
        </div>
        @endforeach 
        <div class="reserve-button-box">
          <button class="reserve-button" type="submit">予約する</button>
        </div>
      </form>
    </div>
</div>

@endsection