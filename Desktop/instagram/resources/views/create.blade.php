@extends('layouts.app')
@section('content')
<div class="container create">
  <div class="col-md-8 mx-auto">
    <div class="mt-4">
      <div class="card row">
        <div class="card-header">
          新規投稿
        </div>
        <div class="card-body text-center">

          @if($errors->any())
            <div class="alert alert-danger text-left">
              <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
              </ul>
            </div>
          @endif
        <div id="upload_zone" class="text-center mt-2">
          クリックして画像をアップロード
        </div>
          <img src="" class="mt-2 img-fluid mx-auto" alt="" id="preview">
          <form class="" id="post" action="/posts" method="post" enctype="multipart/form-data"><br>
            @csrf
            <input type="text" name="caption" value="" class="mx-auto" placeholder="青空が素敵でしょ"><br>
            <input type="file" name="image" value="" id="image" onchange="previewFile()"><br>
            <div class="d-flex justify-content-end">
              <a href="#" id="submit">
                <div class="btn-block bg-primary text-white">
                  送信
                </div>
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>

<script type="text/javascript">
// 黒の点線をクリックしたら、画像の参照が働くようにする
var upload_zone = document.getElementById('upload_zone');
upload_zone.addEventListener("click", function(){
  document.getElementById("image").click();
});

// みかけのsubmitボタンをクリックしたら、submitの処理が働くようにする
let submit = document.getElementById('submit');
submit.addEventListener("click", function(){
  document.getElementById("post").submit();
});

// 画像プレビュー処理
function previewFile(){
  var preview = document.querySelector('#preview');
  var reader = new FileReader();
  var file = document.querySelector("input[type=file]").files[0];

  reader.addEventListener("load",function(){
    preview.src = reader.result;
    upload_zone.style.display = "none";
  });

  if (file) {
    reader.readAsDataURL(file);
  }
}

</script>
@endsection
