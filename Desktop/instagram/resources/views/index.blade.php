@include('layouts.header')
<div class="container">
  <div class="col-md-8 mx-auto">
    <div class="mt-4">
      @foreach($articles as $article)
      <div class="card mb-5">
        <div class="col card-header">
          <img class="post-profile-icon" src="https://www.gravatar.com/avatar/c2525a7f58ae3776070e44c106c48e15.jpg" alt="C2525a7f58ae3776070e44c106c48e15">
          {{$article->user->name}}
          @if($article->user->id == auth()->user()->id)
          <form class="float-right" action="/posts/{{$article->id}}" name="delete{{$article->id}}" method="post">
            @method('DELETE')
            @csrf
            <a href="#"><i class="fas fa-trash-alt fa-2x"></i></a>
          </form>
          @endif

        </div>
        <div class="card-img-top text-center">
          <img src="storage/images/{{$article->image}}" class="img-fluid"><br>
        </div>
        <div class="card-footer">
          <div class="col favorites">
            <a href="ajax/favorites/{{$article->id}}" id="favorite_{{$article->id}}"><i class="far @foreach($article->favorite as $fav) @if($fav->user->name == auth()->user()->name){{'fas'}} @endif @endforeach fa-heart fa-2x" id="favorites_inner{{$article->id}}"></i></a>
            <p>@foreach($article->favorite as $fav){{$fav->user->name.' '}} @if($loop->last){{'がいいねしました'}} @endif @endforeach</p>
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
          <div id="comment_area"></div>
          <div class="comment">
            <form action="/comments/{{$article->id}}" class="row" method="post">
              @csrf
              <input type="text" class="h-100 col-md-10 input" name="comment" placeholder="コメント...">
              <a class="col-md-2 btn-block bg-primary center-block comments" href="/comments/{{$article->id}}"><i class="fas fa-angle-right text-white fa-3x"></i></a>
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
// ゴミ箱をクリックすると、削除処理
let card_headers = document.getElementsByClassName('card-header');
for (let card_header of card_headers) {
  let form = card_header.getElementsByTagName('form');
  let a = card_header.getElementsByTagName('a');
  if ( typeof a[0] !== "undefined") {
    a[0].addEventListener('click',function(){
      event.preventDefault();
      form[0].submit();
    });
  }
}
</script>

<!-- <script type="text/javascript">
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
</script> -->

<script type="text/javascript">
// ハートをクリックすると、いいね処理
let favorites = document.getElementsByClassName('favorites');

for (let favorite of favorites) {
  // targetはaタグのこと
  let target = favorite.children[0];

  target.addEventListener('click', function(event){
    event.preventDefault();

    // aタグのhref記載のURLにajaxでアクセスしデータを取得
    let url = target.getAttribute('href');
    var httpRequest = new XMLHttpRequest;
    httpRequest.onreadystatechange = makeRequest;
    httpRequest.open('GET', url);
    httpRequest.send();

    function makeRequest(){
      try {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
          if (httpRequest.status ===200 ) {

            // この投稿をファボったユーザーを取得
            let article_favorite_users = JSON.parse(httpRequest.responseText).article_favorite_users;
            createFavoriteNode(article_favorite_users);

            let auth_user_favorited = JSON.parse(httpRequest.responseText).auth_user_favorited;
            toggleHeart(auth_user_favorited);

          }else{
            console.log("リクエストに問題が発生しました");
          }
        }
      } catch (e) {
        console.log(e.getMesssage());
      }
    }

    // ajaxで取得したファボっているユーザーを表示する
    function createFavoriteNode(users){

      var newP = document.createElement('p');
      var newContents = document.createTextNode(users.join(" ")+'がいいねしました');
      newP.appendChild(newContents);

      if(target.nextElementSibling){
        target.parentElement.removeChild(target.nextElementSibling);
      }
      if (users.length > 0) {
        target.parentElement.insertBefore(newP, target.nextElementSibling);
      }
    }

    // ajaxで取得した、ログインユーザーがファボったかを利用して、ハートを切り替える
    function toggleHeart(auth_user_favorited){
      if(auth_user_favorited){
        target.firstChild.classList.add('fas');
      }else{
        target.firstChild.classList.remove('fas');
      }
    }
  });
}
</script>
<script>
// コメントをajaxで実装・・
// やじるしをクリックすると、コメント投稿処理
let comments = document.getElementsByClassName('comment');
for (let comment of comments) {
  let form = comment.getElementsByTagName('form');
  let a = comment.getElementsByTagName('a');
  a[0].addEventListener('click',function(event){
    event.preventDefault();
    let url = a[0].getAttribute('href');
    let value = comment.getElementsByClassName('input')[0].value;
    var httpRequest = new XMLHttpRequest;
    var token = document.getElementsByName('csrf-token').item(0).content;
    httpRequest.onreadystatechange = makeRequest;
    httpRequest.open('POST', url, true);
    httpRequest.setRequestHeader('X-CSRF-TOKEN',token);
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    httpRequest.send('value=' + encodeURIComponent(value));

    function makeRequest(){
      try {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
          if (httpRequest.status ===200 ) {
            console.log("成功です");
            console.log(httpRequest.responseText);
          }else{
            console.log("リクエストに問題が発生しました");
          }
        }
      } catch (e) {
        console.log(e.getMesssage());
      }
    }
  });

  // ajaxで取得したファボっているユーザーを表示する
  // function createCommentNode(users){
  //
  //   var newP = document.createElement('p');
  //   var newContents = document.createTextNode(users.join(" ")+'がいいねしました');
  //   newP.appendChild(newContents);
  //
  //   if(target.nextElementSibling){
  //     target.parentElement.removeChild(target.nextElementSibling);
  //   }
  //   if (users.length > 0) {
  //     target.parentElement.insertBefore(newP, target.nextElementSibling);
  //   }
  // }
}

  </script>

  </html>
