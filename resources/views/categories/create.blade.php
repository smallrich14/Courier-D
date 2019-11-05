@extends('layouts.app')

@section('content')

	<div class="container shadow p-5">
		<div class=row>
			<div class="col-12 col-md-8 mx-auto">
				<h3 class="text-center">
					{{isset($category) ? 'Edit Category' : 'Create Category'}}
				</h3>
				<hr>
				<form action="{{isset($category) ? route('categories.update', ['category'=>$category->id]) : route('categories.store')}}" method="post">
					@csrf
					@if(isset($category))
					@method('put')
					@endif
				@if(Session::has('category_message'))
				<div class="alert alert-success">
					{{Session::get('category_message')}}
				</div>
				@endif
					<div class="form-group text-center">
						<label for="category" >New Category</label>
						{{-- <div class="pb-3">
							<input type="name" name="title" class="form-control">
						</div>
						<div class="pb-3">
							<input type="file" name="image" class="file form-control">
						</div> --}}
							<input type="text" name="category" class="form-control" 
								value="{{isset($category) ? $category->name : "" 	}}"
							>
					</div>
						<button  class="btn btn-info w-100">{{isset($category) ? "Update" : "Add"}}</button>
				</form>
			</div>	
		</div>
		
	</div>

@endsection

