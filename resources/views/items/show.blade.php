@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-12 col-md-6 mx-auto">
				<h3 class="text-center">
					View Units
				</h3>
				<hr>
				<div class="card">
					<img src="{{ url('/public/'. $items->image) }}" class="card-img-top view">

					<div class="card-body">
							<h5><span class="badge badge-success float-right">Available</span></h5>
							<h2 class="card-title">{{$items->name}}</h2>
							<span class="text-primary font-weight-bold">Model Details:</span>
							<p class="card-text">{{$items->description}}</p>
					</div>
					<div class="input-group mb-3">
						<form action="{{route('transactions.index')}}" method="post" class="w-100">
							<div class="form-group">
								@csrf
								<input type="hidden" name="id" value="{{$items->id}}">
								<label for="request_date"></label>
								{{-- calendar button --}}
								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <a class="btn btn-info borrow-date ml-4"data-id="{{$items->id}}">Borrow Date:</a>
								    <input id="datepicker" width="354" />
								</div>

								<div class="input-group mt-2">
								  <div class="input-group-prepend">
								    <a class="btn btn-info return-date ml-4 "data-id="{{$items->id}}">Return Date:</a>
								    <input id="datepicker2" width="356" />
								</div>
								{{-- end of calendar --}}
							</div>

							<button type="submit" class="btn btn-success mt-5 w-100">Request</button>
						</form>

						<a href="{{route('items.edit', ['item'=> $items->id])}}" class="btn btn-warning w-100 my-1">Edit Products</a>

						<form action="{{route('items.destroy', ['item'=> $items->id])}}" method="post" class="w-100">
							@csrf
							@method('DELETE')
							<button class="btn btn-danger btn-block">Delete Product</button>
						</form>
						
					</div>
				</div>
			</div>
		</div>
	</div>


    <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4'
        });

        $('#datepicker2').datepicker({
            uiLibrary: 'bootstrap4'
        });
    </script> 
@endsection