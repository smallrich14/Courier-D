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
				{{-- delete alert --}}
				@if(Session::has('destroy_message'))
				<div class="alert alert-success">
					{{Session::get('destroy_message')}}
				</div>
				@endif

				<h2 class="text-center titleCategory display-4">Categories</h2>
				{{-- Start of table --}}
				<table class="table  table-dark table-hover">
					<th class="pl-5 text-warning">Categories</th>
					@can('isAdmin')
					<th class="float-right ml-5 text-warning">Action</th>
					@endcan
					<tbody class="table-borderless">
						{{-- @foreach($items as $item) --}}
						@foreach($categories as $category)
							<tr>
								{{-- @if($item->category_id == $category->id) --}}
						{{-- {{dd($item->category_id == $category->id)}} --}}
								<td scope="col">
									<strong class="float-left">{{$category->name}}</strong>
								</td>
								<td class="float-right">
									@can('isAdmin')
									<a href="{{route('categories.edit', ['category'=> $category->id])}}" class="btn btn-primary"><small>Edit</small></a>
								</td>

								<td>
									<form action="{{route('categories.destroy', ['category'=> $category->id])}}" method="post">
										@csrf
										@method("delete")
										<button class="btn btn-danger"><small>Delete</small></button>
									</form>
									@endcan
								</td>
								{{-- @endif --}}	
							</tr>
						{{-- @endforeach --}}
						@endforeach
					</tbody>
				</table>
			</div>	
		</div>
	</div>

@endsection


