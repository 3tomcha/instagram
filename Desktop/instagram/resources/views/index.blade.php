<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <script src="/js/app.js"></script>
  <link rel="stylesheet" href="/css/app.css">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <meta charset="utf-8">
  <title></title>
</head>
<body>
  <header class="navbar navbar-light">
    <img class="h-100" src="/img/logo.png">
    <div class="justyfy-content-end">
      <a href="/posts/new">投稿する</a>
    </div>
  </header>
  <div class="container">
    <div class="card-deck">
      <div class="row">
        <div class="col">
          <?php foreach ($articles as $article): ?>
            <div class="card mb-5">
              <div class="col card-header">
                <img class="post-profile-icon" src="https://www.gravatar.com/avatar/c2525a7f58ae3776070e44c106c48e15.jpg" alt="C2525a7f58ae3776070e44c106c48e15">
                {{$article->user->name}}
                <form class="float-right" action="/posts/{{$article->id}}" name="delete{{$article->id}}" method="post">
                  @csrf
                  @method('DELETE')
                  <a href="#"><p id='submit{{$article->id}}'><i class="fas fa-trash-alt"></i>削除する</p></a>
                </form>
                <script type="text/javascript">
                var article_id = {{$article->id}};
                  document.getElementById("submit{{$article->id}}").addEventListener('click', function(event){
                        event.preventDefault();
                        document.forms["delete{{$article->id}}"].submit();
                  });
                </script>
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
              <?php foreach ($article->comment as $comment): ?>
                <div class="col mb-1">
                  <strong class='mr-1'>{{$comment->user->name}}</strong>{{$comment->comment}}<br>
                  <span class="text-secondary">{{$comment->updated_at}}</span>
                </div>

              <?php endforeach; ?>

              <form action="/comments/{{$article->id}}" method="post">
                @csrf
                <input type="text" name="comment" placeholder="コメント...">
                <input type="submit" value="コメントを書き込む">
              </form>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
