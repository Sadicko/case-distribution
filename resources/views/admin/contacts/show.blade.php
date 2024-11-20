@extends('admin.layouts.app')

@section('title', 'Contact message details')

@section('current_page', 'Contact message details')


@section('back_to_page')
<a href="{{ route('admin.messages') }}" class="btn btn-primary btn-sm"><i class="fas fa-circle-left"></i> Back</a>@endsection

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')

<div class="container py-4">
	
	<div class="card">
		<div class="card-header">
			Contact message from <em>{{ $contact->name }}</em>
		</div>
		<div class="card-body">
			<div class="list-group">
				<a href="#!" class="list-group-item list-group-item-action flex-column align-items-start active">
					<div class="d-flex w-100 justify-content-between">
						<h5 class="mb-1">Sender:</h5>
						<small>{{ $contact->created_at->format('d M Y') }}</small>
					</div>
					<p class="mb-1">{{ $contact->name }}</p>
					<small>{{ $contact->phone }}</small><br>
					<small>{{ $contact->email }}</small>
				</a>
				<a href="#!" class="list-group-item list-group-item-action flex-column align-items-start">
					<div class="d-flex w-100 justify-content-between">
						<h5 class="mb-1">Message:</h5>
					</div>
					<p class="mb-1">{{ $contact->message }}</p>
				</a>
			</div>
			{{-- <div class="">
				<form action="{{ route('admin.message.delete', $contact->slug) }}" method="post">
					@csrf
					<input type="hidden" name="slug" value="{{ $contact->slug }}">
					<button type="submit" class="btn btn-danger btn-sm float-right mt-3">Delete</button>
				</form>
			</div>
 --}}		</div>
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