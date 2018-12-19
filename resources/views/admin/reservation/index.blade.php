@extends('layouts.app')

@section('title', 'Reservation')

@push('css')
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endpush

@section('content')
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">

					@include('layouts.partial.msg')
					
					<div class="card">
						<div class="card-header card-header-primary">
							<h4 class="card-title ">All resrvations</h4>
							
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="myTable" class="table display">
									<thead class=" text-primary">
										<th>ID</th>
										<th>Name</th>
										<th>Email</th>
										<th>Phone</th>
										<th>Date & Time</th>
										<th>Message</th>
										<th>Status</th>
										<th>Actions</th>
									</thead>
									<tbody>
										@foreach ($reservations as $key=>$resrvation)
											<tr>
												<td>{{ $key+1 }}</td>
												<td>{{ $resrvation->name }}</td>
												<td>{{ $resrvation->email }}</td>
												<td>{{ $resrvation->phone }}</td>
												<td>{{ $resrvation->date_and_time }}</td>
												<td>{{ $resrvation->message }}</td>
												<td>
													@if ($resrvation->status == true)
														<h4><span class="badge badge-info">Confirmed</span></h4>
													@else
														<h4><span class="badge badge-danger">Not confirm yet</span></h4>
													@endif
												</td>
												<td>
													@if ($resrvation->status == false)
														<form id="status-form-{{ $resrvation->id }}" action="{{ route('reservation.status', $resrvation->id) }}" method="post" style="display: none;">
															@csrf
															
														</form>
														<button type="button" class="btn btn-info btn-sm"><i class="material-icons" onclick="if(confirm('Are you verify this reserve by phone?')){
															event.preventDefault();
															document.getElementById('status-form-{{ $resrvation->id }}').submit();
														}else {
															event.preventDefault();
														}">done</i></button>
													@endif

													<form id="delete-form-{{ $resrvation->id }}" action="{{ route('reservation.destroy', $resrvation->id) }}" method="post" style="display: none;">
														
														@csrf
														@method('delete')
													</form>
													<button type="button" class="btn btn-danger btn-sm"><i class="material-icons" onclick="if(confirm('Are you sure you want to delete this?')){
														event.preventDefault();
														document.getElementById('delete-form-{{ $resrvation->id }}').submit();
													} else {
														event.preventDefault();
													}">delete</i></button>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('scripts')
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript">
		$(document).ready( function () {
			$('#myTable').DataTable();
		} );
	</script>
@endpush