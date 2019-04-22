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
            @foreach($articles as $article)
            <div class="card mb-5">
              <div class="col card-header">
                <img class="post-profile-icon" src="https://www.gravatar.com/avatar/c2525a7f58ae3776070e44c106c48e15.jpg" alt="C2525a7f58ae3776070e44c106c48e15">
                {{$article->user->name}}
                <form class="float-right" action="/posts/{{$article->id}}" name="delete{{$article->id}}" method="post">
                  @csrf
                  @method('DELETE')
                  <a href="#"><p id='submit{{$article->id}}'><i class="fas fa-trash-alt fa-5x"></i></p></a>
                </form>
              </div>
              <div class="col card-img-top">
                <img src="storage/images/{{$article->image}}"><br>
              </div>
              <div class="col favorites">
                <a href="/favorites/{{$article->id}}" id="favorite_outer{{$article->id}}"><i class="far fa-heart fa-2x" id="favorites_inner{{$article->id}}"></i></a>
                <!-- いいね済みだったらfar、いいね未だったらfas -->
                <!-- いいねされているarticle_idを送るようにする -->

                <!-- <script type="text/javascript">
                document.getElementById("favorite_outer{{$article->id}}").addEventListener('click', function(event){
                  event.preventDefault();
                  var target = document.getElementById("favorite_outer{{$article->id}}");
                  if(target.firstChild.classList.contains('far')){
                    target.firstChild.classList.replace('far','fas');
                    var newP = document.createElement('p');
                    var newContents = document.createTextNode('いいねしました');
                    newP.appendChild(newContents);
                    document.getElementById("favorite_outer{{$article->id}}").parentElement.insertBefore(newP, document.getElementById("favorite_outer{{$article->id}}").nextSibling);
                  }else if (target.firstChild.classList.contains('fas')) {
                    target.firstChild.classList.replace('fas','far');
                    target.parentElement.removeChild(target.nextSibling);
                  }
                });
                </script> -->

              </div>
              <div class="col mb-1">
                <strong class='mr-1'>{{$article->user->name}}</strong>{{$article->caption}}<br>
                <span class="text-secondary">{{$article->updated_at}}</span>
              </div>
                @foreach($article->comment as $comment)
                <div class="col mb-1">
                  <strong class='mr-1'>{{$comment->user->name}}</strong>{{$comment->comment}}<br>
                  <span class="text-secondary">{{$comment->updated_at}}</span>
                </div>
              @endforeach
              <form action="/comments/{{$article->id}}" method="post">
                @csrf
                <input type="text" name="comment" placeholder="コメント...">
                <input type="submit" value="コメントを書き込む">
              </form>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</body>
<script type="text/javascript">
// ゴミ箱をクリックすると、削除処理
var card_headers = document.getElementsByClassName('card-header');

for (let card_header of card_headers) {
  var form = card_header.getElementsByTagName('form');
  var a = card_header.getElementsByTagName('a');
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
