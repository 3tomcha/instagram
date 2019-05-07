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
          @endauth

        </div>
        <div class="card-img-top text-center">
          <img src="storage/images/{{$article->image}}" class="img-fluid"><br>
        </div>
        <div class="card-footer">
          @include('layouts/favorite')
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
// ハートをクリックすると、いいね処理
var favorites = document.getElementsByClassName('favorites');

for (let favorite of favorites) {
  let target = favorite.children[0];

  target.addEventListener('click', function(event){
    event.preventDefault();

    let url = target.getAttribute('href');
    var httpRequest = new XMLHttpRequest;
    httpRequest.onreadystatechange = makeRequest;
    httpRequest.open('GET', url);
    httpRequest.send();

    function makeRequest(){
      try {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
          if (httpRequest.status ===200 ) {
            // この投稿をファボったユーザー
            var article_favorite_users = JSON.parse(httpRequest.responseText).article_favorite_users;
            createFavoriteNode(article_favorite_users);
          }else{
            alert("リクエストに問題が発生しました");
          }
        }
      } catch (e) {
        alert(e.getMessage());
      }
    }

    function createFavoriteNode(users){
      if(target.firstChild.classList.contains('far')){
        target.firstChild.classList.replace('far','fas');
      }else if (target.firstChild.classList.contains('fas')) {
        target.firstChild.classList.replace('fas','far');
      }
      var newP = document.createElement('p');
      var newContents1 = document.createTextNode(users.join(" ")+'がいいねしました');
      newP.appendChild(newContents1);
      target.parentElement.removeChild(target.nextElementSibling);
      target.parentElement.insertBefore(newP, target.nextElementSibling);
    }
  });
}
</script>


</html>
