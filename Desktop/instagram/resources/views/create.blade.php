@include('layouts.header')
<div class="container">
  <div class="col-md-8 mx-auto">
    <div class="mt-4">
      <div class="card">

        <div class="upload_zone">
            クリックして画像をアップロード
        </div>


        <form class="" action="/posts" method="post" enctype="multipart/form-data"><br>
          @csrf

          <input type="text" name="caption" value=""><br>
          <input type="file" name="image" value="" id="image"><br>
          <div class="d-flex justify-content-end">
            <div class="col-md-1 btn-block bg-primary text-white">
              送信
            </div>
            <input type="submit" id="submit">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</body>

<script type="text/javascript">
// 黒の点線をクリックしたら、画像の参照が働くようにする
let upload_zone = document.getElementsByClassName('upload_zone');
upload_zone[0].addEventListener("click", function(){
  document.getElementById("image").click();
});


// // やじるしをクリックすると、コメント投稿処理
// let comments = document.getElementsByClassName('comment');
// for (let comment of comments) {
//   let form = comment.getElementsByTagName('form');
//   let a = comment.getElementsByTagName('a');
//   a[0].addEventListener('click',function(event){
//     event.preventDefault();
//     form[0].submit();
//   });
// }
</script>
</html>
