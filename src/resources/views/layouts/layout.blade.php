<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Document</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
  @yield('css')
</head>
<body>
  <header>
    <nav class="nav" id="nav">
      <ul>
        <li><a href="/">Home</a></li>
        <li>
          <form method="POST" action="{{ route('logout') }}">
          @csrf
            <input type="submit" class="logout" value="logout">
          </form>
        </li>
        <li><a href="/mypage">Mypage</a></li>
        @if($auth->editors()->exists())
        <li><a href="/edit">Edit</a></li>
        @endif
        @if($auth->role_id==1)
        <li><a href="/admin">Admin</a></li>
        @endif
      </ul>
    </nav>
    <div class="menu" id="menu">
      <span class="menu__line--top"></span>
      <span class="menu__line--middle"></span>
      <span class="menu__line--bottom"></span>
      <div class="app-ttl">Rese</div>
    </div>
    <script src="{{ asset('js/layout.js') }}"></script>
  </header>

 @yield('content') 
</body>


</html>