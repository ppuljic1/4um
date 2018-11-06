@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-8">

            {{-- Thread --}}
            <div class="card">
                <div class="card-header">
                    <a href="#">{{ $thread->creator->name }}</a> posted:
                    {{ $thread->title }}
                </div>

                <div class="card-body">
                    {{ $thread->body }}
                </div>
            </div>

        {{-- Replies --}}
            @foreach( $replies as $reply )
                @include('threads.reply')
                <br>
            @endforeach

            {{ $replies->links() }}
        
        {{-- Reply Form --}}
            @if( auth()->check() )    

                <form method="POST" action="{{ $thread->path() . '/replies' }}">
                    {{ csrf_field() }}
                
                    <div class="form-group">
                        <textarea class="form-control" name="body" id="body" rows="5" placeholder="Got something to say?"></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Post</button>
                </form>

            @else 
                <p class="text-center">You need to <a href="{{ route('login') }}">Sign in</a> to participate</p>
            @endif
                    
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <p>
                        This thread was published {{ $thread->created_at->diffForHumans() }} by <a href="#">{{ $thread->creator->name }}</a> and currently has {{ $thread->replies_count }} {{ $thread->replies_count > 1 ? 'comments' : 'comment' }}.
                    </p>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection
