@extends('layouts.layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">
@endsection

@section('content')

<body>
  <div class="edit-contents">
    <div class="shop-detail-frame">
      <p class="shop-detail-ttl">店舗情報</p>
      <form class="shop-edit-form" action="/edit/update" method="post" enctype="multipart/form-data" >
      @csrf
        <div>
          <input type="hidden" name="id" value="{{$items->id}}">
        </div>
        <div>
          <p>Name</p>
          @error('name_shop')
          <div class="error-message">{{$message}}</div>
          @enderror
          <input class="shop-name" type="text" name="name_shop" value="{{$items->name_shop}}">
        </div>
        <div>
          <p>Image</p>
          @error('image_path')
          <div class="error-message">{{$message}}</div>
          @enderror
          <div>
            <img src="{{ Storage::url($items->image_path) }}" alt="準備中">
          </div>
          <input  class="shop-img" type="file" name="image_path">    
        </div>
        <div class="shop-tag">
          <div >
            <p>Area</p>
            <select name="area_id" id="">
              <option value="{{$items->area_id}}">{{$items->name_area}}
              </option>
              @foreach($area_list as $area_item)
              <option value="{{$area_item->id}}">
                {{$area_item->name_area}}
              </option>
              @endforeach
            </select>
          </div>
          <div>
            <p>Genre</p>
            <select name="genre_id" id="">
              <option value="{{$items->genre_id}}">{{$items->name_genre}}
              </option>
              @foreach($genre_list as $genre_item)
              <option value="{{$genre_item->id}}">
                {{$genre_item->name_genre}}
              </option>
              @endforeach
            </select>
          </div>
        </div>
        <div>
          <p>Detail</p>
          @error('detail')
          <div class="error-message">{{$message}}</div>
          @enderror
          <textarea name="detail" id="" cols="50" rows="4">@isset($items->detail){{$items->detail}} @else {{old('detail')}} @endisset</textarea>
        </div>
        <div class="button-box">
        <button type="submit">更新</button>
        </div>
      </form>
    </div>

    <div class="reserve-frame">
      <p class="reserve-frame-ttl">予約一覧</p>
      @foreach($reserves as $reserve)
      <div class="reserve-table-box">
        <table class="reserve-desc-table">
          <div class="reserve-ttl-box">
            <span>予約id</span>
            <input type="text" name='id' value="{{$reserve->id}}" disabled>
          </div>
          <tr>
            <th>Customer</th>
            <td><input type="text" value="{{$reserve_ins->getUserItem($reserve->id)->name}}" disabled></td>
          </tr>
          <tr>
            <th>Date</th>
            <td><input type="text" value="{{$reserve->date}}" disabled></td>
          </tr>
          <tr>
            <th>Time</th>
            <td><input type="text" value="{{$reserve->time}}" disabled></td>
          </tr>
          <tr>
            <th>Number</th>
            <td><input type="text" value="{{$reserve->number}}人" disabled></td>
          </tr>
        </table>
      </div>
        @endforeach
      </div>
  </div>
</body>

@endsection