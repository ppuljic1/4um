@extends('layouts.app')

@section('content')
<div class="container">

    <!-- Thread -->
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">

                <div class="card-header">
                    <a href="#">{{ $thread->creator->name }}</a> posted:
                    {{ $thread->title }}
                </div>

                <div class="card-body">
                    {{ $thread->body }}
                </div>

            </div>
            
        </div>
    </div>

    <!-- Replies -->
    <div class="row justify-content-center">
        <div class="col-md-8">

            @foreach( $thread->replies as $reply )
                @include('threads.reply')
            @endforeach

        </div>
    </div>

    <!-- Reply Form -->
    @if( auth()->check() )    
        <div class="row justify-content-center">
            <div class="col-md-8">

                <form method="POST" action="{{ $thread->path() . '/replies' }}">
                    {{ csrf_field() }}
                
                    <div class="form-group">
                      <textarea class="form-control" name="body" id="body" rows="5" placeholder="Got something to say?"></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Post</button>
                </form>

            </div>
        </div>
    @else 
        <p class="text-center">You need to <a href="{{ route('login') }}">Sign in</a> to participate</p>
    @endif

</div>
@endsection
