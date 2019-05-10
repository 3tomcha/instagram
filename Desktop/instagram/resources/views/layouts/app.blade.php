<!DOCTYPE html>
<html lang="ja">
<head>
  <link rel="stylesheet" href="/css/app.css">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="/js/app.js"></script>
  <title></title>
</head>
<body>
  <header class="bg-white">
    <div class="navbar navbar-light container mx-auto">
      <a href="/"><img src="/img/logo.png"></a>
      <div class="justyfy-content-end">
        @guest
        <a href="/login">ログイン</a>
        @endguest
        @auth
        <a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
        @endauth
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
        <a href="/posts/create">投稿する</a>
      </div>
    </div>
  </header>

  
  <main class="py-4">
    @yield('content')
  </main>
</div>
</body>
</html>
