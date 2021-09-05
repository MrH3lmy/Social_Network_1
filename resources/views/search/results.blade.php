@extends('templates.default')

@section('content')
   <h3>You search for "{{ Request::input('query') }}"</h3>

    @if (!$users->count())
        <p>NO RESULTS FOUND</p>
    @else

        <div class="row">
            <div class="col-lg-12">

                @foreach ($users as $user )
                            @include('user/paritals/userblock')

                @endforeach

            </div>

        </div>    
   @endif

@stop