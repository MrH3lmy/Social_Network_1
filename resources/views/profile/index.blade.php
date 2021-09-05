@extends('templates.default')

@section('content')
  
<div class="row">
        <div class="col-lg-5">
                @include('user.paritals.userblock')
                <hr>

                
        </div>
        <div class="col-lg-4 col-lg-offset-3">
                @if (Auth::user()->hasFriendRequestPending($user))
                        <p> waiting for {{ $user->getFirstNamerUsername() }} to accept your request.</p>
                @elseif (Auth::user()->hasFriendRequestReceived($user))
                        <a href="{{ route('friend.accept',['username' => $user -> username]) }}" class="btn btn-primary"> Accept Friend Request</a>
                @elseif (Auth::user()->isFriendsWith($user))
                        <p>You and {{ $user->getFirstNamerUsername() }} are Friends.</p>

                @elseif (Auth::user()->id !== $user->id)
                        <a href="{{ route('friend.add',['username'=> $user->username]) }}" class="btn btn-primary"> add as friend</a>


                @endif
                


                <h4>{{ $user->getFirstNamerUsername() }}'s friends.</h4>

                @if (!$user->friends()->count())
                        <p>{{ $user->getFirstNamerUsername() }} has no friends.</p>
                @else
                        @foreach ($user->friends() as $user )
                                @include('user.paritals.userblock')
                        @endforeach
                        
                @endif

        </div>
    </div>
@stop




