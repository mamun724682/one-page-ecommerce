@extends('layouts.app')

@section('title', 'Item')

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
							<h4 class="card-title ">All items<a class="btn btn-info pull-right" href="{{ route('item.create') }}">Add New</a></h4>
							
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="myTable" class="table display">
									<thead class=" text-primary">
										<th>ID</th>
										<th>Name</th>
										<th>Image</th>
										<th>Category Name</th>
										<th>Description</th>
										<th>Price</th>
										<th>Created At</th>
										<th>Updated At</th>
										<th>Actions</th>
									</thead>
									<tbody>
										@foreach ($items as $key=>$item)
											<tr>
												<td>{{ $key+1 }}</td>
												<td>{{ $item->name }}</td>
												<td><img src="{{ asset('uploads/item/'.$item->image) }}" class="img-responsive img-thumbnail" style="height: 100px; width: 100px"></td>
												<td>{{ $item->category->name }}</td>
												<td>{{ str_limit($item->description, 50) }}</td>
												<td>{{ $item->price }}</td>
												<td>{{ $item->created_at }}</td>
												<td>{{ $item->updated_at }}</td>
												<td>
													<a href="{{ route('item.edit', $item->id) }}" class="btn btn-info btn-sm"><i class="material-icons">mode_edit</i></a>

													<form id="delete-form-{{ $item->id }}" action="{{ route('item.destroy', $item->id) }}" method="post" style="display: none;">
														
														@csrf
														@method('delete')
													</form>
													<button type="button" class="btn btn-danger btn-sm"><i class="material-icons" onclick="if(confirm('Are you sure you want to delete this?')){
														event.preventDefault();
														document.getElementById('delete-form-{{ $item->id }}').submit();
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