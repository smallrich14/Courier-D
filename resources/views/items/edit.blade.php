@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-12 col-md-8 mx-auto">
				<h3 class="text-center">
					Edit Asset 
				</h3>
				<hr>
				<form method="POST" action="{{ route('items.update', ['item' => $item->id]) }}" enctype="multipart/form-data">
					@csrf
					@method('PUT')
					{{-- input for name --}}
					<div class="form-group">
						<label for="name">Product name:</label>
						<input 
							type="text" 
							name="name" 
							class="form-control" 
							id="name" 
							value="{{$item->name}}">
					</div>
					@if($errors->has('name'))
						<div class="alert alert-danger">
							<small class="mb-0">Product name Required</small>
						</div>
					@endif

					{{-- input for category --}}
					 <div class="form-group">
					    <label for="category">Product Category</label>
					    <select 
					    	class="form-control" 
					    	id="category" 
					    	name="category">
					      @foreach($categories as $category)
					     	 <option 
					     	 	value="{{$category->id}}" 
					     	 	@if($item->category_id == $category->id)selected @endif>{{$category->name}}
					     	 </option>
					      @endforeach

					      </select>
					 </div>

					{{-- input for image --}}
					<div class="form-group">
						<label for="image">Product image:</label>
						<input 
							type="file" 
							name="image" 
							class="form-control-file" 
							id="image">
					</div>
					@if($errors->has('image'))
						<div class="alert alert-danger">
							<small class="mb-0">Product image Required. Check if image is not greater than 2mb</small>
						</div>
					@endif

					{{-- input for description --}}
					<div class="form-group">
						<label for="description">Product description:</label>
						<textarea id="description" name="description" class="form-control" id="description" cols="30" rows="10">{{$item->description}}</textarea>
					</div>
					@if($errors->has('description'))
						<div class="alert alert-danger">
							<small class="mb-0">Product description Required</small>
						</div>
					@endif

					<button class="btn btn-primary btn-block">Update</button>

				</form>
			</div>
		</div>
	</div>

@endsection