@extends('layouts.layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')

<div class="user-name-box">
  <p class="user-name">{{Auth::user()->name}}さん</p>
</div>

<div class="mypage-box">
  
  <div class="reserve-frame">
    <p class="reserve-frame-ttl">予約状況</p>
    @error('number')
    <div class="error-message">{{$message}}</div>
    @enderror
    @foreach($reserves as $reserve)
    <div class="reserve-table-box">    
        <form action="?" method='post'>
          @csrf
          <div class="reserve-ttl-box">
            <div>
              <span class="reserve-ttl-icon"><img src="{{Storage::url('img/icon_clock.svg')}}" alt=""></span>
              <span class="reserve-id">予約{{$reserve->id}}</span>
              <input type="hidden" name='id' value="{{$reserve->id}}">
            </div>
            <div>
              <button type="submit" formaction="/reserve/update">修正</button>
              @if($now < $reserve_ins->inputToTimestamp($reserve->id))
              <button type="submit" formaction="/reserve/delete">削除</button>
              @endif
            </div>
          </div>
        <table class="reserve-desc-table">
          <tr>
            <th>Shop</th>
            <td><input type="text" value="{{$reserve->name_shop}}"></td>
          </tr>
          <tr>
            <th>Date</th>
            <td><input type="date" name='date' value="{{$reserve->date}}"></td>
          </tr>
          <tr>
            <th>Time</th>
            <td><input type="time" name='time' value="{{$reserve->time}}"></td>
          </tr>
          <tr>
            <th>Number</th>
            <td><input type="text" name='number' value="{{$reserve->number}}"></td>
          </tr>
        </form>
      </table>
      
      @if($now > $reserve_ins->inputToTimestamp($reserve->id))
      <div class="review-box">
        @if($review_ins->where('reserve_id','=',$reserve->id)->exists())
          <p>＜評価済み＞</P>
          <table class="review-table">
            <tr>
              <th>点数</th>
              <td>{{config('rating')[$reserve_ins->getReviewItem($reserve->id)->rating]}}</td>
            </tr>
            <tr>
              <th>コメント</th>
              <td>{{$reserve_ins->getReviewItem($reserve->id)->comment}}</td>
            </tr>
          </table>
        @else
        <form action="/mypage/review" method="post">
        @csrf
        <p>点数</p>
        <select type="text" name="rating">
          @foreach(config('rating') as $key => $rating)
          <option value="{{ $key }}">{{ $rating }}</option>
          @endforeach
        </select>
        <div>
          <p>コメント</p>
          <textarea name="comment" id="" cols="40" rows="3"></textarea>
        </div>
        <div>
          <input type="hidden" name="shop_id" value="{{$reserve->shop_id}}"> 
        </div>
        <div>
          <input type="hidden" name="user_id" value="{{$reserve->user_id}}"> 
        </div>
        <div>
          <input type="hidden" name="reserve_id" value="{{$reserve->id}}"> 
        </div>
        <button type="submit">評価する</button>
        </form>
        @endif
      </div>
      @endif
      
      <form action="/charge" method="post" class="text-center mt-5">
        @csrf
        <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="{{ env('STRIPE_KEY') }}"
            data-amount="1000"
            data-name="Stripe Demo"
            data-label="決済をする"
            data-description="これはStripeのデモです。"
            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
            data-locale="auto"
            data-currency="JPY">
         </script>
      </form>
      
    </div>
    @endforeach
  </div>

  <div class="shop-card-frame">
    <p class="shop-card-frame-ttl">お気に入り店舗</p>
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
            <form action="?" method="Post" >
            @csrf
            <div class="link-box">
              <a href="/detail/{{$item->id}}">
                <span class="link-detail">詳しく見る</span>
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
  </div>
</div>
@endsection