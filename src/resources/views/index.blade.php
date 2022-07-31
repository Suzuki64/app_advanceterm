@extends('layouts.layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<body>
  <form class="search-form" action="/" method="get">
    @csrf
    <table>
    <tr>
      <td>
        <select name="name_area" id="">
          <option value="">ALL area</option>
          @foreach($area_list as $area_item)
          <option value="{{$area_item->name_area}}" @if($name_area=="{{$area_item->name_area}}") selected @endif>
            {{$area_item->name_area}}
          </option>
          @endforeach
        </select>
      </td>
      <td>
        <select class="unkown" name="name_genre" id="">
          <option value="">All genre</option>
          @foreach($genre_list as $genre_item)
          <option value="{{$genre_item->name_genre}}" @if($name_area=="{{$genre_item->name_genre}}") selected @endif>
            {{$genre_item->name_genre}}
          </option>
          @endforeach
        </select>
      </td>
      <td>
        <button type=submit><img class="search-icon" src="{{Storage::url('img/icon_search.svg')}}" alt="button"></button>
      </td>
      <td>
        <input type="text" name="keyword" value="{{old('keyword')}}"placeholder="Search...">
      </td>
    </tr>
    </table>
  </form>
  
  
  <div class="shop-card-box">
    @foreach($items as $item) 
    <div class="shop-card">
      <div class="shop-card-img">
        <img src="{{ Storage::url($item->image_path) }}" alt="準備中">
      </div>
      <div class="shop-card-contents">
        <div class="shop-card-name">
          {{$item->name_shop}}
        </div>
        <div class="shop-card-area">
          #{{$item->name_area}}&nbsp;#{{$item->name_genre}}
        </div>
        
        <form action="?" method="Post">
          @csrf
          <div class="link-box">
            <a href="/detail/{{$item->id}}">
              <span class="link-detail" >詳しく見る</span>
            </a>
            @if(Auth::user()->isFavorite($item->id))
            <button class="favo" type="submit" formaction="/favorite/delete"></button>
            @else
            <button class="unfavo" type="submit" formaction="/favorite/add"></button>
            @endif
          </div>
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">  
            <input type="hidden" name="shop_id" value="{{$item->id}}">
        </form>
      </div>
    </div>
    @endforeach
  </div>
</body>
@endsection