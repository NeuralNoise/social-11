@extends('layouts.app')
@section('content')
<style>
	.col-centered{
    	float: none;
    	margin: 0 auto;
	}
	.panel-heading-own {
		background-color: #337AB7 !important;
		color: #fff !important;
	}
</style>
<div class="container">
	<div class="row">
		<div class="text-center">
			<h1>Head</h1>
			<img src="" alt="">
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 col-centered">

			<!-- Add Post -->
			@if (\Auth::user()->id == $user->id)
				<div class="panel panel-default">
					<form action="{{url('/')}}/addPost" method="POST">
						{{csrf_field()}}
						<div class="panel-body">
							<label for="title">Title:</label>
							<input name="title" type="text" class="form-control">
							<label for="text">Text:</label>
							<textarea name="text" style="resize:vertical" class="form-control"></textarea> 
						</div>
						<div class="panel-footer">
								<input class="btn btn-default" type="submit" value="Add">
						</div>
					</form>
				</div>
			@endif
			<h2>content from {{$user->name}}</h2>			
			<!-- Posts -->
			@foreach ($posts as $post)
			<div class="panel panel-default post">	
				<div class="bg-info panel-heading panel-heading-own">
					<span>{{$post->author[0]->name}} has written at {{$post->created_at}}</span>
					<form class="pull-right" action="{{url('/')}}/deletePost/{{$post->id}}" method="POST">
						{{csrf_field()}}
						@if (\Auth::user()->id == $user->id)
							<input type="submit" class="btn btn-danger btn-xs" value="X">
						@endif
					</form>
				</div>

				<div class="panel-body">
					
						<img src="" alt="">
						<h3>{{$post->title}}</h3>
						<p>{{$post->text}}</p>
						
					@if ($post->isRepost($post->id))
						<br>
						<h4>Repost:</h4>
						<div class="repost panel panel-default">
							<div class="panel-heading">
								<h4>{{\App\User::find($post->repost[0]->orig_poster_id)->name}} has written</h4>
							</div>
							<div class="panel-body">
									<h4>{{$post->repost[0]->orig_post_title}}</h4>
									<p>{{$post->repost[0]->orig_post_text}}</p>
							</div>
						</div>					
					@endif
				</div>
				<div class="panel-footer">
					<a href="{{url('/')}}/addLike/{{$post->id}}">likes:</a> {{count($post->likes()->get())}}
					<a data-toggle="modal" data-target="#myModal_{{$post->id}}">reposts:</a> {{$post->repostsCount()}}
					<!-- Modal -->
					<div class="modal fade" id="myModal_{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
					      </div>
					      <!-- Form for add comment to repost -->
					      <form action="{{url('/')}}/makeRepost/{{$post->id}}" method="POST">
						      {{csrf_field()}}
						      <div class="modal-body">
						        <label for="comment_title">Your comment's title:</label>
						        <input type="text" name="comment_title" class="form-control">
						        <label for="comment_text">Your comment:</label>
						        <textarea name="comment_text" class="form-control"></textarea>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						        <input type="submit" class="btn btn-primary" value="Save changes">
						      </div>
						   </form>
					    </div>
					  </div>
					</div>




					<p>
						@foreach ($post->likes()->get() as $userWhoLike)
							<span><a href="{{url('/')}}/user/{{$userWhoLike->id}}">{{$userWhoLike->name}}</a></span>,
						@endforeach

					</p>	
				</div>
			</div>
			@endforeach

		</div>	
	</div>
</div>

@endsection