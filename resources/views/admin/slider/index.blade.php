@extends('layouts.app')

@section('title', 'Slider')

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
							<h4 class="card-title ">All sliders<a class="btn btn-info pull-right" href="{{ route('slider.create') }}">Add New</a></h4>
							
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="myTable" class="table display">
									<thead class=" text-primary">
										<th>ID</th>
										<th>Title</th>
										<th>Sub Title</th>
										<th>Image</th>
										<th>Created At</th>
										<th>Updated At</th>
										<th>Actions</th>
									</thead>
									<tbody>
										@foreach ($sliders as $key=>$slider)
											<tr>
												<td>{{ $key+1 }}</td>
												<td>{{ $slider->title }}</td>
												<td>{{ $slider->sub_title }}</td>
												<td><img src="{{ asset('uploads/slider/'.$slider->image) }}" class="img-responsive img-thumbnail" style="height: 100px; width: 100px"></td>
												<td>{{ $slider->created_at }}</td>
												<td>{{ $slider->updated_at }}</td>
												<td>
													<a href="{{ route('slider.edit', $slider->id) }}" class="btn btn-info btn-sm"><i class="material-icons">mode_edit</i></a>

													<form id="delete-form-{{ $slider->id }}" action="{{ route('slider.destroy', $slider->id) }}" method="post" style="display: none;">
														
														@csrf
														@method('delete')
													</form>
													<button type="button" class="btn btn-danger btn-sm"><i class="material-icons" onclick="if(confirm('Are you sure you want to delete this?')){
														event.preventDefault();
														document.getElementById('delete-form-{{ $slider->id }}').submit();
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