@extends('layouts.home_layout')
@section('content')

@if($errors->any())

<div class="alert alert-danger">
	<ul>
	@foreach($errors->all() as $error)

		<li>{{ $error }}</li>

	@endforeach
	</ul>
</div>

@endif
<div class="card">
	<div class="card-header">Add Blog</div>
	<div class="card-body">
		<form method="post" action="{{ route('blogs.store') }}" enctype="multipart/form-data">
			@csrf
			<div class="row mb-3">
				<label class="col-sm-2 col-label-form">Blog Title</label>
				<div class="col-sm-10">
					<input type="text" name="blog_title" class="form-control" />
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-sm-2 col-label-form">Blog Description</label>
				<div class="col-sm-10">
					<input type="text" name="blog_description" class="form-control" />
				</div>
			</div>
			<div class="row mb-4">
				<label class="col-sm-2 col-label-form">Blog Category</label>
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
				</div>
			</div>
			<div class="row mb-4">
				<label class="col-sm-2 col-label-form">Blog Content</label>
				<div class="col-sm-10">
					<textarea name="content" id="editor">
						
					</textarea>
				</div>
			</div>
			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Add" />
			</div>	
		</form>
	</div>
</div>

@endsection('content')