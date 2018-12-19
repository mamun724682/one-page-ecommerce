@extends('layouts.app')

@section('title', 'Contact')

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
							<h4 class="card-title ">All Contact Messages</h4>
							
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="myTable" class="table display">
									<thead class=" text-primary">
										<th>ID</th>
										<th>Name</th>
										<th>Email</th>
										<th>Subject</th>
										<th>Message</th>
										<th>Created At</th>
										<th>Updated At</th>
										<th>Actions</th>
									</thead>
									<tbody>
										@foreach ($contacts as $key=>$contact)
											<tr>
												<td>{{ $key+1 }}</td>
												<td>{{ $contact->name }}</td>
												<td>{{ $contact->email }}</td>
												<td>{{ $contact->subject }}</td>
												<td>{{ $contact->message }}</td>
												<td>{{ $contact->created_at }}</td>
												<td>{{ $contact->updated_at }}</td>
												<td>
													<a href="{{ route('contact.show', $contact->id) }}" class="btn btn-info btn-sm"><i class="material-icons">details</i></a>

													<form id="delete-form-{{ $contact->id }}" action="{{ route('contact.destroy', $contact->id) }}" method="post" style="display: none;">
														
														@csrf
														@method('delete')
													</form>
													<button type="button" class="btn btn-danger btn-sm"><i class="material-icons" onclick="if(confirm('Are you sure you want to delete this?')){
														event.preventDefault();
														document.getElementById('delete-form-{{ $contact->id }}').submit();
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