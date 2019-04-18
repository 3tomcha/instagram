投稿一覧ページ
<!-- <img src='storage/images/8an0RBsel64wKYFnd7DhWtdDCyh3SMRi8SfXyueY.jpeg'> -->
<?php foreach ($articles as $article): ?>
{{$article->user->name}}<br>
<!-- <a href="/posts/{{$article->id}}">削除する</a> -->
<form  action="/posts/{{$article->id}}" method="post">
@csrf
@method('DELETE')
<input type="submit" value="削除する">
</form>
<img src="storage/images/{{$article->image}}"><br>
{{$article->user->name}}<br>
{{$article->caption}}<br>
{{$article->updated_at}}<br>
<?php endforeach; ?>
