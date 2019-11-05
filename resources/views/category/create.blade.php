@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-12 col-md-8 mx-auto">
				<h3 class="text-center">Unit Categories</h3>
				<hr>
				<form action="" method="post">
				@csrf
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
						<button type="submit" class="btn btn-info w-100">{{isset($category) ? "Update" : "Add"}}</button>
				</form>
			</div>	
		</div>
	</div>


@endsection
