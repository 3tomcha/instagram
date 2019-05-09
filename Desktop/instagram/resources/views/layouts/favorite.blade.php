<div class="col favorites">
  <a href="ajax/favorites/{{$article->id}}" id="favorite_{{$article->id}}"><i class="far @foreach($article->favorite as $fav) @if($fav->user->name == auth()->user()->name){{'fas'}} @endif @endforeach fa-heart fa-2x" id="favorites_inner{{$article->id}}"></i></a>
  <p>@foreach($article->favorite as $fav){{$fav->user->name.' '}}@endforeach がいいねしました</p>
</div>
