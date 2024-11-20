@extends('admin.layouts.app')

@section('title', 'Manage contact messages')

@section('current_page', 'Manage contact messages')

{{-- 
@section('back_to_page')
<a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-circle-plus"></i> New user</a>
@endsection --}}

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')

<div class="card">
	<div class="card-body">
		<div class="table-responsive">
			<table id="messageTable" class="table table-bordered table-hover table-custom spacing5 display">
				<thead>
					<tr>
						<th>##</th>
						<th>Name</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Message</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody class="">
					@foreach($messages as $message)
					<tr>
						<td>{{ $loop->index + 1 }}</td>
						<td>{{ $message->name }}</td>
						<td>{{ $message->email }}</td>
						<td>{{ $message->phone }}</td>
						<td>{{ Str::limit($message->message, 20) }}</td>
						<td class="text-center">
							<a href="{{ route('admin.messages.show', $message->slug) }}"><i class="fas fa-eye"></i></a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection

@section('scripts')
<!-- DataTables  & Plugins -->
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script type="text/javascript">
	$(function () {
		$("#messageTable").DataTable({
			"responsive": true, 
			"lengthChange": false, 
			"autoWidth": false,
			"stateSave": true,
			"ordering": true,
			"order": [[ 0, "desc" ]],
			"buttons": [
				
			{
				extend: 'excel',
				exportOptions: {
					columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8],
				},
				text: "Excel",
				extension: '.xlsx',
			},
			{
				extend: 'print',
				exportOptions: {
					columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8],
				},
				text: "Print",
				extension: '.pdf',
			}
			]
		}).buttons().container().appendTo('#messageTable_wrapper .col-md-6:eq(0)');

			// $('#example2').DataTable({
			// 	"paging": true,
			// 	"lengthChange": false,
			// 	"searching": false,
			// 	"ordering": true,
			// 	"info": true,
			// 	"autoWidth": false,
			// 	"responsive": true,
			// });
	});
</script>
@endsection