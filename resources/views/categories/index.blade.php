@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-12 col-md-8 mx-auto">
				{{-- update/add category alert --}}
				@if(Session::has('category_message'))
				<div class="alert alert-success">
					{{Session::get('category_message')}}
				</div>
				@endif
				@if($errors->any())
					<div class="alert alert-danger">
						{{$errors->first()}}
					</div>
				@endif
				{{-- delete alert --}}
				@if(Session::has('destroy_message'))
				<div class="alert alert-success">
					{{Session::get('destroy_message')}}
				</div>
				@endif

				<h2 class="text-center">Categories</h2>
				{{-- Start of table --}}
				<table class="table  table-dark table-hover">
					<th class="pl-5">Categories</th>
					<th class="float-right mr-5">Action</th>
					<tbody class="table-borderless">
						@foreach($categories as $category)
						{{-- {{dd($category)}} --}}
							<tr>
								<td scope="col">
									<strong class="float-left">{{$category->name}}</strong>
								</td>
								<td class="float-right">
									<a href="{{route('categories.edit', ['category'=> $category->id])}}" class="btn btn-primary">Edit</a>

									<form action="{{route('categories.destroy', ['category'=> $category->id])}}" method="post">
										@csrf
										@method("delete")
										<button class="btn btn-danger">Delete</button>
									</form>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>


			</div>	
		</div>
	</div>

@endsection


