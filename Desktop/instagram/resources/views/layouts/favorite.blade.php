<div class="col favorites">

  <?php
  $heart = 'far';
  $fav_user_names = [];
  foreach($article->favorite as $fav):
    $fav_user_names[] = $fav->user->name;
    if($fav->user->id == auth()->user()->id){
      $heart = 'fas';
    }
    endforeach;
    if(count($fav_user_names) > 0){
      $fav_message = implode(" ", $fav_user_names)."がいいねしました";
    }
  ?>

  <a href="ajax/favorites/{{$article->id}}" id="favorite_{{$article->id}}"><i class="{{$heart}} fa-heart fa-2x" id="favorites_inner{{$article->id}}"></i></a>
  <p>{{$fav_message}}</p>
</div>
