<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Document</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
  <link rel="stylesheet" href="{{ asset('css/done.css') }}">
</head>
<body>
  <header>
    <nav class="nav" id="nav">
      <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/login">Login</a></li>
        <li><a href="/register">Registration</a></li>
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

  <div class="message-box">
    <div class="message">会員登録ありがとうございます</div>
    <a href="/login">
      <div class="link">ログインする</div>
    </a>
  </div>
</body>
</html>

