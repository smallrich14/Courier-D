@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-8 mx-auto">
				<h3 class="text-center">Pending Details</h3>
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

						@foreach($transactions as $transaction)
						{{-- {{dd($transaction)}} --}}
							@if($transaction->status->name == "pending")
				
							<tr class="text-center">
									<td scope="col">
										<strong>{{$transaction->transaction_number}}</strong>
									</td>

									<td scope="col">
										<strong>{{$transaction->item->name}}</strong>
									</td>
							
									<td scope="col">
										<strong>{{$transaction->borrow_date}}</strong>
									</td>

									<td scope="col">
										<strong>{{$transaction->return_date}}</strong>
									</td>
									{{-- {{dd($statuses)}} --}}
									<td class="col float-right pl-5">
							
										<form action="{{ route('transactions.update', ['transaction' => $transaction->id]) }}" method="post">
				        						@csrf
				        						@method('PUT')
				        						{{-- <label for="edit-transaction-{{$transaction->id}}"></label> --}}
				        						<input type="hidden" name="item_id" value="{{$transaction->item_id}}">
				        						<select class="custom-select mb-1" id="edit-transaction-{{$transaction->id}}" name="status">
				        							@foreach($statuses as $status)
				        							<option value="{{$status->id}}" 
				        								@if($status->id == $transaction->status_id)
				        								selected 
				        								@endif 
				        								{{ $status->id == $transaction->status_id ? "selected" : ""}}
				        								>{{$status->name}}</option>
				        							@endforeach
				        						</select>
				        						@can('isAdmin')
				        						<button class="badge badge-primary">Update</button>
				        						@endcan
				        				</form>
									</td>
							@endif
						@endforeach
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
						<th class="pl-5 text-warning">Borrow_Date</th>
						<th class="pl-5 text-warning">Return_Date</th>
						<th class="float-right mr-5 text-warning">Status</th>
						<tbody class="table-borderless">
						
						@foreach($transactions as $transaction)
						@if($transaction->status->name == 'approved')
							<tr class="text-center">
									<td scope="col">
										<strong>{{$transaction->transaction_number}}</strong>
									</td>

									<td scope="col">
										<strong>{{$transaction->item->name}}</strong>
									</td>

									<td scope="col">
										<strong>{{$transaction->borrow_date}}</strong>
									</td>

									<td scope="col">
										<strong>{{$transaction->return_date}}</strong>
									</td>

									<td class="col float-right pl-5">
										@can('isAdmin')
										<form action="{{ route('transactions.update', ['transaction' => $transaction->id]) }}" method="post">
											@csrf
											@method('put')
											<input type="hidden" name="status" value="4">
										<button class="btn btn-info">Tag as Returned</button>
										</form>
										@endcan
										@cannot('isAdmin')
										<span class="badge badge-success">{{$transaction->status->name}}</span>
										@endcannot
									</td>
							</tr>
							@endif
						@endforeach
						</tbody>
					</table>

				</div>
			</div>
		</div>
	</div>

		<div class="container">
		<div class="row">
			<div class="col-12 col-md-8 mx-auto">
				<h3 class="text-center pt-5"> Completed Transactions</h3>
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
						
						@foreach($transactions as $transaction)
						@if($transaction->status->name == 'returned')
							<tr class="text-center">
									<td scope="col">
										<strong>{{$transaction->transaction_number}}</strong>
									</td>

									<td scope="col">
										<strong>{{$transaction->item->name}}</strong>
									</td>

									<td scope="col">
										<strong>{{$transaction->borrow_date}}</strong>
									</td>

									<td scope="col">
										<strong>{{$transaction->return_date}}</strong>
									</td>

									<td class="col float-right pl-5">
										<span class="badge badge-success">{{$transaction->status->name}}</span>
									</td>
							</tr>
							@endif
						@endforeach
						</tbody>
					</table>

				</div>
			</div>
		</div>
	</div>

@can('isAdmin')
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-8 mx-auto">
				<h3 class="text-center pt-5"> Reject/Cancelled Transactions</h3>
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
						
						@foreach($transactions as $transaction)
						@if($transaction->status->name == 'reject')
							<tr class="text-center">
									<td scope="col">
										<strong>{{$transaction->transaction_number}}</strong>
									</td>

									<td scope="col">
										<strong>{{$transaction->item->name}}</strong>
									</td>

									<td scope="col">
										<strong>{{$transaction->borrow_date}}</strong>
									</td>

									<td scope="col">
										<strong>{{$transaction->return_date}}</strong>
									</td>

									<td class="col float-right pl-5">
										@if($transaction->status->name == "cancelled")
											<button class="btn btn-warning">{{$transaction->status->name}}</button>
										@elseif($transaction->status->name == "reject")
											<span class="badge badge-danger">{{$transaction->status->name}}</span>
										@else
											<button class="badge badge-danger">{{$transaction->status->name}}</button>
										@endif
									</td>
							</tr>
							@endif
						@endforeach
						</tbody>
					</table>

				</div>
			</div>
		</div>
	</div>
@endcan
@endsection