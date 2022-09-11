@extends('layouts.home_layout')
@section('content')

@section('content')

<div class="card">
	<div class="card-header">Edit blog</div>
	<div class="card-body">
		<form method="post" action="{{ route('blogs.update', $blog->id) }}" enctype="multipart/form-data">
			@csrf
			@method('PUT')
			<div class="row mb-3">
				<label class="col-sm-2 col-label-form">Blog Name</label>
				<div class="col-sm-10">
					<input type="text" name="blog_title" class="form-control" value="{{ $blog->blog_title }}" />
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-sm-2 col-label-form">Blog Description</label>
				<div class="col-sm-10">
					<input type="text" name="blog_description" class="form-control" value="{{ $blog->blog_description }}" />
				</div>
			</div>
			<div class="row mb-4">
				<label class="col-sm-2 col-label-form">Blog Gender</label>
				<div class="col-sm-10">
					<select name="blog_category" class="form-control">
						<option value="Action">Action</option>
						<option value="Comedy">Comedy</option>
					</select>
				</div>
			</div>
			<div class="row mb-4">
				<label class="col-sm-2 col-label-form">Blog Image</label>
				<div class="col-sm-10">
					<input type="file" name="blog_image" />
					<br />
					<img src="{{ asset('images/' . $blog->blog_image) }}" width="100" class="img-thumbnail" />
					<input type="hidden" name="hidden_blog_image" value="{{ $blog->blog_image }}" />
				</div>
			</div>
			<div class="row mb-4">
				<label class="col-sm-2 col-label-form">Blog Content</label>
				<div class="col-sm-10">
					<textarea name="content" id="editor">
						{{$blog->blog_content}}
					</textarea>
				</div>
			</div>
			<div class="text-center">
				<input type="hidden" name="hidden_id" value="{{ $blog->id }}" />
				<input type="submit" class="btn btn-primary" value="Edit" />
			</div>	
		</form>
	</div>
</div>
<script>
	document.getElementsByName('blog_category')[0].value = "{{ $blog->blog_category }}";
</script>

@endsection('content')