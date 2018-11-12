@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6">
			@if (session('status'))
    <div class="alert alert-success alert-dismissible border-0 fade show" role="alert" role="alert">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
		    </div>
		@endif
			
			<div class="wall">
		    <h3>{{ $post_details->title}}</h3>
		    <h4>{{ $post_details->body}}</h4>
		    <hr>
		    <h3>Drop Comment Here</h3>
		    <form action="/process_comment" enctype="multipart/form-data" method="post">
		    	{{ csrf_field() }}
		    <input type="hidden" name="post_id" value="{{ $post_details->id}}" class="form-control">
		    <input type="hidden" name="user_id" value="1" class="form-control">
		    	<div class="form-group">
		    		<label>Email Address</label>
		    		<input type="text" name="email" value="{{ old('email') }}" class="form-control">
		    		@if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif	
		    	</div>

		    	<div class="form-group">
		    		<label>Comment</label>
		    		<textarea type="text" name="comment" value="{{ old('body') }}" class="form-control">
		    		</textarea>
		    			@if ($errors->has('comment'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('comment') }}</strong>
                </span>
                @endif
		    			
		    	</div>
		    	<input type="submit" value="Post Cooment" class="btn btn-primary">
		    </form>
		    </div>
		     
		</div>
	</div>
</div><!-- /.container -->
@endsection

   