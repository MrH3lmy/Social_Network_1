<div class="media">
    <a class="pull-left" href="{{ route('profile.index',['username'=>$user->username] )}}">
        <img class="media-object" src="{{ $user->getAvatarUrl() }}" alt="{{ $user->getName0rUsername() }}">
    </a>
    <div class="media-body">
      <h4 class="media-heading"><a href="{{ route('profile.index',['username'=>$user->username] ) }}">{{ $user->getName0rUsername() }}</a></h4>
      @if ($user->location)
        <p>{{ $user->location }}</p>
          
      @endif
    </div>
  </div>