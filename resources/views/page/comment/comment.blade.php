<div id='load-comment'>
	@if (isset($comments))
	@foreach ($comments as $comment)
	<div style="width: 100%; display: flex;">
		<div style="width: 15%">{{$comment->user->name}}:</div>
		<div style="width: 80%">{{$comment->content}}</div>
		@if(Auth::id() == $comment->user->id)
			<a class="a" onclick='delComment({{$comment->id}})'><img src="{{asset('icon/delete.png')}}" style="width: 15px; height: 15px;"></a>
		@endif
	</div>
	@endforeach
	@endif
</div>