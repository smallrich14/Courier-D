@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-12 col-md-8 mx-auto">
				<h3 class="jumbotron text-center bg-info text-light">{{isset($item) ? 'Edit Units' : 'Create New Units'}}</h3>
				<hr>
				<form method="post" action="{{ route('items.store') }}" enctype="multipart/form-data">
					@csrf
					@if(isset($item))
					@method('put')
					@endif
				@if(Session::has('item_message'))
				<div class="alert alert-success">
					{{Session::get('item_message')}}
				</div>
				@endif
					{{-- input for Unit name --}}
					<div class="form-group">
						<label type="text" name="name" class="form-control" id="name">Unit Name:</label>
						<input type="text" name="name" class="form-control" id="name">
					</div>
					@if($errors->has('name'))
						<div class="alert alert-danger">
							<small class="mb-0">Unit name Required</small>
						</div>
					@endif

					{{-- input for Category --}}
					<div class="form-group">
						<label name="category" class="form-control" id="category">Category:</label>
						<select class="form-control" id="category" name="category">
							@foreach($categories as $category)
								<option value="{{$category->id}}">{{$category->name}}</option>
							@endforeach
						</select>
					</div>

					{{-- input for image --}}
					<div class="form-group">
						<label class="image">Unit Image:</label>
						<input type="file" name="image" class="form-control-file" id="image">
					</div>
					@if($errors->has('image'))
						<div class="alert alert-danger">
							<small class="mb-0">Product image Required</small>
						</div>
					@endif

					{{-- input for description --}}
					<div class="form-group">
						<label class="image">Description:</label>
						<textarea id="description" name="description" class="form-control" id="description" cols="30" rows="10"></textarea>
					</div>
					@if($errors->has('description'))
						<div class="alert alert-danger">
							<small class="mb-0">Product description Required</small>
						</div>
					@endif

					<button class="btn btn-primary btn-block">Add Units</button>
				</form>
			</div>
		</div>
	</div>


@endsection