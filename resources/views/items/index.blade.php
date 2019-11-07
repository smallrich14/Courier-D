@extends('layouts.app')

@section('content')
 
	@if(Session::has('destroy_message'))
		<div class="alert alert-success">
			{{ Session::get('destroy_message') }}
		</div>
	@endif

	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="jumbotron bg-warning">
					<h1 class="text-center">Looking for a Ride?</h1>
				</div>
			</div>
		</div>
		<div class="row">
			{{-- <div class="col-12 col-md-8"> --}}
				{{-- {{dd($items)}} --}}
				@foreach($items as $item)
					<div class="col-12 col-md-4 mb-5">
						<div class="card w-100 h-100 shadow-lg p-3 bg-white rounded">
							<img src="{{ url('/public/'. $item->image) }}" class="card-img-top imgIndex">

							<h6 class="mt-2"><span class="badge badge-success float-right">{{$item->isAvailable ? 'Available' : 'Not available' }}</span></h6>
							
							<div class="card-body">
								<div class="pb-3">
									<h4 class="card-title text-primary prod">{{$item->name}}</h4>
								</div>
									<p class="card-text mt-2 des">{{$item->description}}</p>  
							</div>
							<div class="card-foot">
								
								{{-- view button --}}
								<a href="{{route('items.show', ['item'=> $item->id])}}" class="btn btn-primary w-100 ">View</a>

								{{-- edit item --}}
								@can('isAdmin')
								<a href="{{route('items.edit', ['item'=> $item->id])}}" class="btn btn-warning w-100 my-1">Edit item</a>

								{{-- delete form --}}
								<form action="{{route('items.destroy', ['item' => $item->id])}}" method="post">
									@csrf
									@method('DELETE')
									<button class="btn btn-danger w-100">Delete Unit</button>
								</form>
								@endcan
								
							</div>
						</div>
					</div>
				@endforeach
			{{-- </div> --}}
		</div>
	</div>

@endsection