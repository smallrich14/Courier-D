@extends('layouts.app')

@section('content')
{{-- {{dd($items)}} --}} 

	<div class="container">
		<div class="row">
			<div class="col-12 col-md-6 mx-auto">
				<h3 class="text-center">
					View Units
				</h3>
				<hr>
				<div class="card">
					<img src="{{ url('/public/'. $items->image) }}" class="card-img-top view">
					
					<form action="{{route('transactions.store')}}" method="post">
					<div class="card-body">
							<h5><span class="badge badge-success float-right">{{$items->isAvailable ? 'Available' : 'Not available'}}</span></h5>
							<input type="hidden" name="item_name" value="{{$items->id}}">
							<h2 class="card-title">{{$items->name}}</h2>
							<span class="text-primary font-weight-bold">Model Details:</span>
							<p class="card-text">{{$items->description}}</p>
					</div>
					<div class="input-group mb-3">
							<div class="form-group w-100">
								@csrf
								@if(Session::has('transaction_message'))
								<div class="alert alert-success">
									{{Session::get('transaction_message')}}
								</div>
								@endif

								<input type="hidden" name="request" value="{{$items->id}}">
								<label for="request_date"></label>
								{{-- calendar --}}
								<div class="form-group">
								    <p class="ml-2 text-info">Borrow Date:</p>
								    <input type="date" name="borrow" id="borrow" class="form-control"/>
								 </div>

								 @if($errors->has('borrow'))
								 	<div class="alert alert-danger">
								 		<small class="mb-0">Date Required</small>
								 	</div>
								 @endif

								<div class="form-group">
								    <p class="ml-2 text-info">Return Date:</p>
								    <input type="date" name="return" id="return" class="form-control"/>
								</div>
								
							 @if($errors->has('return'))
								 <div class="alert alert-danger">
								 	<small class="mb-0">Date Required</small>
								 </div>
							 @endif
							</div> {{-- end of calendar --}}
							
							 @cannot('isAdmin')
							 @if($items->isAvailable)
								<button type="submit" class="btn btn-success mt-5 w-100">Rent</button>
							 @endif
							 @endcannot
						</form>

						@can('isAdmin')
						<a href="{{route('items.edit', ['item'=> $items->id])}}" class="btn btn-warning w-100 my-1">Edit Products</a>

						<form action="{{route('items.destroy', ['item'=> $items->id])}}" method="post" class="w-100">
							@csrf
							@method('DELETE')
							<button class="btn btn-danger btn-block">Delete Product</button>
						</form>
						@endcan 
						
					</div>
						
				</div>
			</div>
		</div>
	</div>

@endsection