<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <script src="/js/app.js"></script>
  <link rel="stylesheet" href="/css/app.css">
  <meta charset="utf-8">
  <title></title>
</head>
<body>
  投稿一覧ページ
  <div class="container">
    <div class="card-deck">
      <div class="row">
        <div class="col">
          <?php foreach ($articles as $article): ?>
            <div class="card mb-5">
              <div class="col card-header">
                <img class="post-profile-icon" src="https://www.gravatar.com/avatar/c2525a7f58ae3776070e44c106c48e15.jpg" alt="C2525a7f58ae3776070e44c106c48e15">
                {{$article->user->name}}
                <form class="float-right" action="/posts/{{$article->id}}" method="post">
                  @csrf
                  @method('DELETE')
                  <input type="submit" value="削除する">
                </form>
              </div>
              <div class="col card-img-top">
                <img src="storage/images/{{$article->image}}"><br>
              </div>
              <div class="col">
                <a href="/favorites/{{$article->id}}" id="favorite{{$article->id}}">イイネボタン</a>
              </div>
              <div class="col mb-1">
                <strong class='mr-1'>{{$article->user->name}}</strong>{{$article->caption}}<br>
                <span class="text-secondary">{{$article->updated_at}}</span>
              </div>
              <input type="text" name="" value="" placeholder="コメント...">
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
