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
  <header class="bg-white">
    <div class="navbar navbar-light container mx-auto">
      <img src="/img/logo.png">
      <div class="justyfy-content-end">
        <a href="/posts/new">投稿する</a>
      </div>
    </div>
  </header>
  <div class="container">
    <div class="col-md-8 mx-auto">
      <div class="card mt-4">
        @foreach($articles as $article)
        <div class="card mb-5">
          <div class="col card-header">
            <img class="post-profile-icon" src="https://www.gravatar.com/avatar/c2525a7f58ae3776070e44c106c48e15.jpg" alt="C2525a7f58ae3776070e44c106c48e15">
            {{$article->user->name}}
            <form class="float-right" action="/posts/{{$article->id}}" name="delete{{$article->id}}" method="post">
              @csrf
              @method('DELETE')
              <a href="#"><i class="fas fa-trash-alt fa-2x"></i></a>
            </form>
          </div>
          <div class="card-img-top text-center">
            <img src="storage/images/{{$article->image}}" class="img-fluid"><br>
          </div>
          <div class="card-footer">
            <div class="col favorites">
              <a href="/favorites/{{$article->id}}" id="favorite_outer{{$article->id}}"><i class="{{ (count($article->favorite) > 0) ? 'fas':'far'}} fa-heart fa-2x" id="favorites_inner{{$article->id}}"></i></a><br>
              @if(count($article->favorite) > 0)
              @foreach($article->favorite as $fav)
              {{$fav->user->name}}
              @endforeach
              がいいねしました
              @endif
            </div>
            <div class="col mb-1 caption">
              <strong class='mr-1'>{{$article->user->name}}</strong>{{$article->caption}}<br>
              <span class="text-secondary">{{$article->updated_at}}</span>
            </div>
            @foreach($article->comment as $comment)
            <div class="col mb-1">
              <strong class='mr-1'>{{$comment->user->name}}</strong>{{$comment->comment}}<br>
              <span class="text-secondary">{{$comment->updated_at}}</span>
            </div>
            @endforeach
            <div class="comment">
              <form action="/comments/{{$article->id}}" class="row" method="post">
                @csrf
                  <input type="text" class="h-100 col-md-10" name="comment" placeholder="コメント...">
                <a class="col-md-2 btn-block bg-primary center-block comments" href="#"><i class="fas fa-angle-right text-white fa-3x"></i></a>
              </form>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</body>
<script type="text/javascript">
// やじるしをクリックすると、コメント投稿処理
let comments = document.getElementsByClassName('comment');
for (let comment of comments) {
  let form = comment.getElementsByTagName('form');
  let a = comment.getElementsByTagName('a');
  a[0].addEventListener('click',function(event){
    event.preventDefault();
    form[0].submit();
  });
}
</script>

<script type="text/javascript">
// ゴミ箱をクリックすると、削除処理
let card_headers = document.getElementsByClassName('card-header');

for (let card_header of card_headers) {
  let form = card_header.getElementsByTagName('form');
  let a = card_header.getElementsByTagName('a');
  a[0].addEventListener('click',function(event){
    event.preventDefault();
    form[0].submit();
  });
}
</script>

<script type="text/javascript">
// ハートをクリックすると、いいね処理
var favorites = document.getElementsByClassName('favorites');

for (let favorite of favorites) {
  let target = favorite.children[0];

  target.addEventListener('click', function(event){
    // event.preventDefault();
    if(target.firstChild.classList.contains('far')){
      target.firstChild.classList.replace('far','fas');
      var newP = document.createElement('p');
      var newContents = document.createTextNode('いいねしました');
      newP.appendChild(newContents);
      target.parentElement.insertBefore(newP, target.nextSibling);
    }else if (target.firstChild.classList.contains('fas')) {
      target.firstChild.classList.replace('fas','far');
      target.parentElement.removeChild(target.nextSibling);
    }
  });
}
</script>


</html>
