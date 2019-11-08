span@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-12 col-md-8 mx-auto">
				<h3 class="text-center">Request Details</h3>
				<hr>
			</div>	
		</div>

		<div class="row">
			<div class="col-12 col-md-11 mx-auto">
				<div class="table-responsive">
					<table class="table  table-dark table-hover">
						<th class="pl-5 text-warning">Transaction Number</th>
						<th class="pl-5 text-warning">Unit Name</th>
						<th class="pl-5 text-warning">Borrow_Date</th>
						<th class="pl-5 text-warning">Return_Date</th>
						<th class="pl-5 text-warning">Status</th>
						<th class="pl-5 text-warning">Action</th>

						<tbody class="table-borderless">
					
							<tr class="text-center">
						{{-- {{dd($transaction)}} --}}
						@foreach($items as $item)
							{{-- {{$item->name}}; --}}
						@endforeach
							@if($transaction->status->name !== "approved" && $transaction->status->name !== "reject" )
									<td scope="col">
										<strong>{{$transaction->transaction_number}}</strong>
									</td>

									<td scope="col">
										<strong>{{$item->name}}</strong>
									</td>

									<td scope="col">
										<strong>{{$transaction->borrow_date}}</strong>
									</td>

									<td scope="col">
										<strong>{{$transaction->return_date}}</strong>
									</td>

									<td class="col float-right pl-5">
										<span class="badge badge-warning">{{$transaction->status->name}}</span>
									</td>

									<td class="col">
										<form action="{{ route('transactions.destroy', ['transaction' => $transaction->id])}}" method="post">
											{{-- {{dd($transaction->id)}} --}}
											@csrf
											@method("delete")
											<button class="btn btn-danger"><small>Cancel Transaction</small></button>
										</form>
									</td>
								@endif
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


	<div class="container">
		<div class="row">
			<div class="col-12 col-md-8 mx-auto">
				<h3 class="text-center pt-5">Approval Status</h3>
				<hr>
			</div>	
		</div>

		<div class="row">
			<div class="col-12 col-md-10 mx-auto">
				<div class="table-responsive">
					<table class="table  table-dark table-hover">
						<th class="pl-5 text-warning">Transaction Number</th>
						<th class="pl-5 text-warning">Unit Name</th>
						<th class="pl-5 text-warning">Borrow_Date</th>
						<th class="pl-5 text-warning">Return_Date</th>
						<th class="float-right mr-5 text-warning">Status</th>
						<tbody class="table-borderless">
					
							<tr class="text-center">
						{{-- {{dd($transactionss)}} --}}
						{{-- {{dd($items)}} --}}
						@if($transaction->status->name == "approved" || $transaction->status->name == "reject" )
									<td scope="col">
										<strong>{{$transaction->transaction_number}}</strong>
									</td>

									<td scope="col">
										<strong>{{$item->name}}</strong>
									</td>

									<td scope="col">
										<strong>{{$transaction->borrow_date}}</strong>
									</td>

									<td scope="col">
										<strong>{{$transaction->return_date}}</strong>
									</td>

									<td class="col float-right pl-5">
										@if($transaction->status->name == "pending")
											<button class="btn btn-warning">{{$transaction->status->name}}</button>
										@elseif($transaction->status->name == "reject")
											<span class="badge badge-danger">{{$transaction->status->name}}</span>
										@else
											<button class="btn btn-success">{{$transaction->status->name}}</button>
										@endif
									</td>
								@endif
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

@endsection