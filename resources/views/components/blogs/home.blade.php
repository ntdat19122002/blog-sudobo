@extends('layouts.home_layout')
@section('content')

@if($message = Session::get('success'))

<div class="alert alert-success">
	{{ $message }}
</div>

@endif

<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col col-md-6">
				<form class="input-group" action="/blogs/search" method="get">
					@csrf
					<div class="form-outline">
						<input type="search" id="form123" class="form-control" name="search_title"/>
					</div>
					<input type="submit"  class="btn btn-primary" value="Search">
			  	</form>	
			</div>
			<div class="col col-md-6">
				<a href="{{ route('blogs.create') }}" class="btn btn-success btn-sm float-end">Add</a>
			</div>
		</div>
	</div>
	<div class="card-body">
		<table class="table table-bordered">
			<tr>
				<th>Image</th>
				<th>Title</th>
				<th>Category</th>
				<th>Description</th>
				<th>Action</th>
			</tr>
			@if(count($data) > 0)

				@foreach($data as $row)

					<tr>
						<td><img src="{{ asset('images/' . $row->blog_image) }}" width="75" /></td>
						<td>{{ $row->blog_title }}</td>
						<td>{{ $row->blog_category }}</td>
						<td>{{ $row->blog_description }}</td>
						<td>
							<a href="{{ route('blogs.show', $row->id) }}" class="btn btn-primary btn-sm">View</a>
							@if (session('user') == $row->blog_owner)
								<a href="{{ route('blogs.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
								<form style="display: inline" method="post" action="{{ route('blogs.destroy', $row->id) }}">
									@csrf
									@method('DELETE')
									<input type="submit" class="btn btn-danger btn-sm" value="Delete" />
								</form>
							@else
								{{-- <form style="display: inline" method="post" action='/likes/{{ $row->id }}/add'>
									@csrf --}}
									<i onclick="likeSubmit({{ $row->id }},this)" class="fa-regular fa-heart {{ in_array( $row->id  , $like_id) ? 'pink-color' : '' }}"></i>
									<span id="like{{ $row->id }}" class="like-number {{ in_array( $row->id  , $like_id) ? 'pink-color' : '' }}">{{ $row->like_number }} </span>
								{{-- </form> --}}
								
							@endif
						</td>
					</tr>

				@endforeach
			@endif
		</table>
		{!! $data->links() !!}
	</div>
</div>

	
<script>
	function likeSubmit(id,heart){
		heart.classList.toggle('pink-color');
		document.getElementById(`like${id}`).classList.toggle('pink-color');
		$.ajax({
			url: `/likes/${id}/add`,
			type: "POST",
			success: function (response) {
				$(`#like${id}`).text(response.like_number) ;
			}
		});
	}
</script>
@endsection