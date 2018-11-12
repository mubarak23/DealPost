@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
             <h1>Add Video</h1>
        <form action="/process_video" enctype="multipart/form-data" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="hidden" name="user_id" value="1">
            </div>
            <div class="form-group">
                <label>Video Title</label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="Enter Video Title Here" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" >
                @if ($errors->has('title'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('title') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group">
                <label>Upload Video</label>
                
                <input type="file" name="video" value="{{ old('video') }}"  class="form-control{{ $errors->has('video') ? ' is-invalid' : '' }}" >
                @if ($errors->has('video'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('video') }}</strong>
                </span>
                @endif   
            </div>
            <button type="submit" class="btn btn-primary" >Add Video</button>
        </form> 
        </div>
      </div>

    </div><!-- /.container -->

    @endsection