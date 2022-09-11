@extends('layouts.home_layout')

@section('content')

<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col col-md-6"><b>blog Details</b></div>
			<div class="col col-md-6">
				<a href="{{ route('blogs.index') }}" class="btn btn-primary btn-sm float-end">View All</a>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="row mb-3">
			<label class="col-sm-2 col-label-form"><b>Blog Title</b></label>
			<div class="col-sm-10">
				{{ $blog->blog_title }}
			</div>
		</div>
		<div class="row mb-3">
			<label class="col-sm-2 col-label-form"><b>Blog Description</b></label>
			<div class="col-sm-10">
				{{ $blog->blog_description }}
			</div>
		</div>
		<div class="row mb-4">
			<label class="col-sm-2 col-label-form"><b>Blog Category</b></label>
			<div class="col-sm-10">
				{{ $blog->blog_category }}
			</div>
		</div>
		<div class="row mb-4">
			<label class="col-sm-2 col-label-form"><b>Blog Image</b></label>
			<div class="col-sm-10">
				<img src="{{ asset('images/' .  $blog->blog_image) }}" width="200" class="img-thumbnail" />
			</div>
		</div>

		<div class="row mb-4">
			<label class="col-sm-2 col-label-form"><b>Blog Content</b></label>
			<div class="col-sm-10" id="blog-show">
				{!! $blog->blog_content!!}
			</div>
		</div>
	</div>

	<div class="card-footer">
		<div class="row mb-4">
			<label class="col-sm-2 col-label-form"><b>Blog Coment</b></label>
			<div class="col-sm-10" id="blog-show">
				<form action="/comment" method="POST" enctype="multipart/form-data">
					@csrf
					<input type="hidden" name="hidden_id" value="{{ $blog->id }}">
					<textarea name="comment" id="editor">
					</textarea>
					<input type="submit" id="addComment" class="btn btn-primary" value="Add comment">
				</form>
			</div>
		</div>
			@foreach ($comments as $comment)
				@if ($comment->reply_id==null)
					<div id="comment{{ $comment->id }}">
						<div class="comment row" >

							<div class="ava ava-comment col-3"></div>
							<div class="col-9">
								<div class="comment-owner">
									{{ $comment->comment_by }}
								</div>
								<div class="comment-content">
									{!! $comment->content !!}
								</div>
								<div class="comment-respond row">
									<div class="comment-like col-4">
										<i onclick="likeComment({{ $comment->id }},this)" class="fa-regular fa-heart {{ in_array( $comment->id  , $like_id) ? 'pink-color' : '' }}"></i>
										<span id="likeCmt{{ $comment->id }}" class="{{ in_array( $comment->id  , $like_id) ? 'pink-color' : '' }}">{{ $comment->like_number }}</span>
									</div>
									<div onclick="replyComment({{ $comment->id }})" style='cursor: pointer; position:relative' class="comment-reply col-4">Reply
									
									</div>
									<div class="comment-time col-4"></div>
									{{-- <form action="/comment" method="POST" enctype="multipart/form-data">
										@csrf
										<input type="hidden" name="hidden_id" value="{{ $blog->id }}">
										<input type="hidden" name="comment_id" value="{{ $comment->id }}">
										<textarea cols="70" class="replyComment" name="replyComment({{ $comment->id }}" ></textarea>
										<input type="submit" id="addComment" class="btn btn-primary" value="Reply">
									</form>` --}}
									<div class="reply-contain row display-none" id="replyComment{{ $comment->id }}">
										<div class="display-flex">
											<div class="ava ava-comment col-3"></div>
											<div class="col-9">
												<div class="comment-owner">
													{{ $comment->comment_by }}
												</div>
												<div class="comment-content">
													<form action="/reply/{{ $comment->id }}" method="POST" enctype="multipart/form-data">
														@csrf
														<input type="hidden" name="hidden_id" value="{{ $blog->id }}">
														<textarea cols="70" class="replyComment" name="replyComment{{ $comment->id }}" ></textarea>
														<input type="submit" id="addComment" class="btn btn-primary" value="Reply" >
													</form>		
												</div>
				
											</div>
										</div>
										
			
									</div>
								</div>

							</div>

						</div>
					</div>
							{{-- Begin: Reply --}}
							@foreach ($comments as $commentReply)
								@if ($commentReply->reply_id==$comment->id)
									<div class="reply-comment" id="comment{{ $commentReply->id }}">
										<div class="comment row" >

											<div class="ava ava-comment col-3"></div>
											<div class="col-9">
												<div class="comment-owner">
													{{ $commentReply->comment_by }} <span>reply @/{{ $comment->comment_by }}</span>
												</div>
												<div class="comment-content">
													{!! $commentReply->content !!}
												</div>
												<div class="comment-respond row">
													<div class="comment-like col-6">
														<i onclick="likeComment({{ $commentReply->id }},this)" class="fa-regular fa-heart {{ in_array( $commentReply->id  , $like_id) ? 'pink-color' : '' }}"></i>
														<span id="likeCmt{{ $commentReply->id }}" class="{{ in_array( $commentReply->id  , $like_id) ? 'pink-color' : '' }}">{{ $commentReply->like_number }}</span>
													</div>
													{{-- <div class="comment-time col-6">{{ $commentReply->created_at }}</div> --}}
												</div>

											</div>

										</div>
									</div>

								@endif
							@endforeach
				@endif
			@endforeach
			
	</div>
</div>

<script>
	function likeComment(id,heart){
		heart.classList.toggle('pink-color');
		$(`#likeCmt${id}`).toggleClass('pink-color')
		$.ajax({
			url: `/like-comments/${id}/add`,
			type: "POST",
			success: function (response) {
				$(`#likeCmt${id}`).text(response.like_number) ;
			}
		});
	}
	function replyComment(id){
		console.log('ok')
		if($(`#replyComment${id}`).hasClass('display-none')){
			$(`#replyComment${id}`).slideDown();
			$(`#replyComment${id}`).removeClass('display-none')
		} else {
			$(`#replyComment${id}`).slideUp();
			$(`#replyComment${id}`).addClass('display-none')
		}
		
	}
	// $('#addComment').click(function(){
	// 	content = $('#editor').val();
	// 	$.ajax({
	// 		url:'/comment',
	// 		type:'POST',
	// 		data: JSON.stringify(content),
	// 		success: function(response){
	// 			console.log(1);
	// 		}
	// 	})
	// })
</script>
@endsection('content')