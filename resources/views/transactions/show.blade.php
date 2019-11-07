@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-12 col-md-8 mx-auto">
				<h3 class="text-center">Request Details</h3>
				<hr>
			</div>	
		</div>

		<div class="row">
			<div class="col-12 col-md-12 mx-auto">
				<div class="table-responsive">
					<table class="table  table-dark table-hover">
						<th class="pl-5 text-warning">Transaction Number</th>
						<th class="pl-5 text-warning">Unit Name</th>
						<th class="pl-5 text-warning">Unit Details</th>
						<th class="pl-5 text-warning">Barrow_Date</th>
						<th class="pl-5 text-warning">Return_Date</th>
						<th class="pl-5 text-warning">Status</th>
						<th class="pl-5 text-warning">Action</th>

						<tbody class="table-borderless">
					
							<tr class="text-center">
						{{-- {{dd($transactionss)}} --}}
						{{-- {{dd($items)}} --}}
									<td scope="col">
										<strong>{{$transaction->transaction_number}}</strong>
									</td>

									<td scope="col">
										<strong>{{$transaction->item->name}}</strong>
									</td>
									
									<td scope="col">
										<strong>{{$transaction->item->description}}></strong>
									</td>

									<td scope="col">
										<strong>{{$transaction->borrow_date}}</strong>
									</td>

									<td scope="col">
										<strong>{{$transaction->return_date}}</strong>
									</td>

									<td class="col float-right pl-5">
										<span class="badge badge-warning">Pending</span>
									</td>

									<td class="col">
										<form action="{{ route('transactions.destroy', ['transaction' => $transaction->id])}}" method="post">
											{{-- {{dd($transaction->id)}} --}}
											@csrf
											@method("delete")
											<button class="btn btn-danger"><small>Delete Transaction</small></button>
										</form>
									</td>
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
				<h3 class="text-center pt-5">Approved Details</h3>
				<hr>
			</div>	
		</div>

		<div class="row">
			<div class="col-12 col-md-10 mx-auto">
				<div class="table-responsive">
					<table class="table  table-dark table-hover">
						<th class="pl-5 text-warning">Transaction Number</th>
						<th class="pl-5 text-warning">Unit Name</th>
						<th class="pl-5 text-warning">Unit Details</th>
						<th class="pl-5 text-warning">Barrow_Date</th>
						<th class="pl-5 text-warning">Return_Date</th>
						<th class="float-right mr-5 text-warning">Status</th>
						<tbody class="table-borderless">
					
							<tr class="text-center">
						{{-- {{dd($transactionss)}} --}}
						{{-- {{dd($items)}} --}}
									<td scope="col">
										<strong>{{$transaction->transaction_number}}</strong>
									</td>

									<td scope="col">
										<strong>{{$transaction->item->name}}</strong>
									</td>
									
									<td scope="col">
										<strong>{{$transaction->item->description}}></strong>
									</td>

									<td scope="col">
										<strong>{{$transaction->borrow_date}}</strong>
									</td>

									<td scope="col">
										<strong>{{$transaction->return_date}}</strong>
									</td>

									<td class="col float-right pl-5">
										<button class="btn btn-success">Approved</button>
									</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

@endsection