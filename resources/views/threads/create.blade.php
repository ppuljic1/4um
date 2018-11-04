@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">Create a New thread</div>

                <div class="card-body">

                    <!-- Create thread form -->
                    <form method="POST" action="/threads">

                        {{ csrf_field() }}
                        
                        <div class="form-group">
                            <label for="channel_id">Choose a Channel:</label>
                            <select name="channel_id" id="channel_id" class="form-control" required>

                                <option value="">Choose one....</option>

                                @foreach($channels as $channel)
                                    <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>
                                        {{ $channel->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                          <label for="title">Title:</label>
                          <input type="text" class="form-control" name="title" id="title" aria-describedby="helpId" value="{{ old('title') }}" required>
                        </div>

                        <div class="form-group">
                          <label for="body">Body:</label>
                          <textarea class="form-control" name="body" id="body" rows="8" required> {{ old('body') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Publish</button>
                        <br><br>
                        @if(count($errors))
                            <ul class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach  
                            </ul>
                        @endif
                    </form>

                </div>
            </div>
            
        </div>
    </div>

</div>
@endsection
