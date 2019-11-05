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
							<h2 class="card-title">{{$items->name}}</h2>
							<p class="card-text">{{$items->description}}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection