@extends('layouts.layout')


@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<body>
  <div class="form-box">
    <div class="form-user">
      <p class="form-user-ttl">ユーザー作成</p>  
      <form action="/admin/createuser" method="post">
        @csrf
        <div>
          <span>Name</span>
          <input type="text" name="name" value="{{old('name')}}">
        </div>
        @error('name')
        <div class="error-message">{{$message}}</div>
        @enderror
        <div>
          <span>Email</span>
          <input type="email" name="email" value="{{old('email')}}">
        </div>
        @error('email')
        <div class="error-message">{{$message}}</div>
        @enderror
        <div>
          <span>Password</span>
          <input type="text" name="password">
        </div>
        @error('password')
        <div class="error-message" value="{{old('password')}}">{{$message}}</div>
        @enderror
        <div>
          <span>Role</span>
          <select name="role" id="">
            @foreach($role_list as $role_item)
              <option value="{{$role_item->id}}">
                {{$role_item->name_role}}
              </option>
            @endforeach
          </select>
        </div>
        <div class="button-box">
          <button type="submit">作成</button>
        </div>
      </form>
    </div>

    <div class="form-shop">
      <p class="form-shop-ttl">店舗作成</p>  
      <form action="/admin/createshop" method="post">
        @csrf
        <div>
          <span>Name</span>
          <input type="text" name="name_shop" value="{{old('name_shop')}}"></div>
        @error('name_shop')
        <div class="error-message">{{$message}}</div>
        @enderror
        <div>
          <span>Area</span>
          <select name="area_id" id="">
            @foreach($area_list as $area_item)
            <option value="{{$area_item->id}}">
              {{$area_item->name_area}}
            </option>
            @endforeach
          </select>
        </div>
        <div>
          <span>Genre</span>
          <select name="genre_id" id="">
            @foreach($genre_list as $genre_item)
            <option value="{{$genre_item->id}}">
              {{$genre_item->name_genre}}
            </option>
            @endforeach
          </select>
        </div>
        <div>
          <span>Detail</span>
          <input type="text" name='detail' value="{{old('detail')}}"></div>
        @error('detail')
        <div class="error-message">{{$message}}</div>
        @enderror
        <div class="button-box">
          <button type="submit">作成</button>
        </div>
      </form>
    </div>
    </div>

    <div class="editor-manage-box">
      <p class="editor-manage-box-ttl">店舗編集者管理</p> 
      <table>
        <tr>
          <th>ID</th>
          <th>name</th>
          <th>email</th>
          <th>role</th>
          <th>更新</th>
          <th>editor</th>
        </tr>
      @foreach($users as $user) 
        <tr>
          <form action="?" method="post">
            @csrf
            <td><input type="number" name="user_id" value="{{$user->id}}" disabled></td>
            <td><input type="text" name="name" value="{{$user->name}}" disabled></td>
            <td><input type="email" name="email" value="{{$user->email}}" disabled></td>
            <td>
              <select name="role_id" id="">
                @isset($user->role_id)
                  <option value="{{$user->role_id}}">
                    {{$user->getRoleItem($user->id)->name_role}}
                  </option>
                  @foreach($role_list as $role_item)
                  <option value="{{$role_item->id}}">
                    {{$role_item->name_role}}
                  </option>
                  @endforeach
                @else
                  <option value=""></option>
                  @foreach($role_list as $role_item)
                  <option value="{{$role_item->id}}">
                    {{$role_item->name_role}}
                  </option>
                  @endforeach
                @endisset
              </select>
            </td>
            <td>
              <button class="role-button" type="submit" formaction="/admin/updateuser">更新</button>
            </td>
              @if($editor->where('user_id',$user->id)->exists())
              <td>
              {{$user->getEditorItem($user->id)->name_shop}}
              </td>
              <td>
              <button class="detach-button" type="submit" formaction="/admin/deleditor">解除</button>
              </td>
              @else
              <td>
              <select name="shop_id" id="">
                @foreach($shop_list as $shop_item)
                <option value="{{$shop_item->id}}">
                  {{$shop_item->name_shop}}
                </option>
                @endforeach
              </select>
              </td>
              <td>
              <button class="attach-button" type="submit" formaction="/admin/addEditor">登録</button>
              </td>
              <td>
              @endif
          </form>
        </tr>
      @endforeach
      </table>
    </div>
    <div class="mail-box">
      <p class="mail-box-ttl">メール連絡</p>
      <form action="/mail" method='post'>
        @csrf
        <div>
          <span>Name</span>
          <input type="text" name='name'>
        </div>
        @error('name')
        <div class="error-message">{{$message}}</div>
        @enderror
        <div>
          <span>Email</span>
          <input type="email" name='email'>
        </div>
        @error('email')
        <div class="error-message">{{$message}}</div>
        @enderror
        <div>
          <span>Message</span>
          <input type="text" name='message' value='編集者登録が完了しました。'>
        </div>
        <div class="button-box">
          <button type="submit">送信</button>
        </div>
      </form>
    </div>
  
</body>
@endsection