@extends('layouts.app')
{{-- {{dd($categories->name)}} --}}
@section('content')

	<div class="container">
		<div class="row">
			<div class="col-12 col-md-8 mx-auto">
				<h3 class="text-center">Request Details</h3>
				<hr>
			</div>	
		</div>

		<div class="row">
			<div class="col-12 col-md-8 mx-auto">
				<div class="table-responsive">
					<table class="table  table-dark table-hover">
						<th class="pl-5">Model Unit</th>
						<th class="pl-5">Model Description</th>
						<th class="float-right mr-5">Status</th>
						<tbody class="table-borderless">
					
							<tr>
								
								@foreach($items as $item)
								@foreach($transactions as $transaction)
								<td scope="col">
									<strong class="float-left">{{$item->name}}</strong>
								</td>
								
								<td scope="col">
									<strong>{{$item->name}}</strong>
								</td>

								<td class="col float-right pl-5">
									<button class="btn btn-warning">Pending</button>
								</td>
								@endforeach
								@endforeach
							</tr>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

@endsection