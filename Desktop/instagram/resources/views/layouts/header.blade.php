<!DOCTYPE html>
<html lang="ja">
<head>
  <link rel="stylesheet" href="/css/app.css">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="/js/app.js"></script>
  <title></title>
</head>
<body>
  <header class="bg-white">
    <div class="navbar navbar-light container mx-auto">
      <img src="/img/logo.png">
      <div class="justyfy-content-end">
        <a href="/posts/new">投稿する</a>
      </div>
    </div>
  </header>
