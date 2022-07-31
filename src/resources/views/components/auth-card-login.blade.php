<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
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

    <div class="w-full h-15 text-lg text-white sm:max-w-md mt-20 sm:mt-0 px-6 py-4 bg-blue-600 shadow-md overflow-hidden sm:rounded-t-lg">
        Login
    </div>
    <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-b-lg">
        {{ $slot }}
    </div>
</div>
