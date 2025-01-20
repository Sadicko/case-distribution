@extends('dashboard.layouts.app')

@section('title', 'Judges')

@section('setting_active', 'active')


@section('content')
    <div class="body d-flex py-3">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div
                        class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="h4 mb-0">Judges</h3>
                        <div class="col-auto d-flex w-sm-100 mt-2 mt-sm-0">
                            <a href="{{ route('judges.create') }}" class="btn btn-dark  w-sm-100"><i class="fas fa-plus-circle me-2"></i>New judge</a>
                        </div>
                    </div>
                </div>
            </div> <!-- Row end  -->

            <div class="row align-item-center">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body basic-custome-color">
                            <div class="table-responsive">
                                <table id="initTable" class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col" class="text-center">Availability</th>
                                        <th scope="col">Assigned court</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">status</th>
                                        <th scope="col" class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($judges as $judge)
                                        <tr>
                                            <th scope="row">{{ $loop->index + 1 }}</th>
                                            <td>{{ $judge->name }}</td>
                                            <td class="text-center">
                                                @if($judge->availability)
                                                    <span class="text-success"><i class="fas fa-check-circle"></i></span>
                                                @else
                                                    <span class="text-danger"><i class="fas fa-times-circle"></i></span>
                                                @endif
                                            </td>
                                            <td>{{ $judge->currentCourt[0]->name ?? '-' }}</td>
                                            <td>{{ $judge->currentCourt[0]?->locations?->name ?? '-' }}</td>
                                            <td>{{ $judge->status }}</td>
                                            <td class="text-center">
                                                @canany(['Update judges', 'Un-assign court judges'])
                                                    @can('Update judges')
                                                        <a href="{{ route('judges.edit', $judge->slug) }}"  class="me-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="fas fa-pencil"></i></a>
                                                    @endcan
                                                    @can('Un-assign court judges')
                                                        <a href="javascript:void(0)"  class="me-2 text-danger unassignModal" data-slug="{{ $judge->id }}" data-judge="{{ $judge->name ?? '-' }}" data-court="{{ $judge->currentCourt[0]->name ?? '-' }}"  data-bs-toggle="tooltip" data-bs-placement="bottom" title="Change/Un-assign from current court"><i class="fas fa-user-slash"></i></a>
                                                    @endcan
                                                @else
                                                    <span>-</span>
                                                @endcanany
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- Row end  -->

        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="unAssignModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="unAssignModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="unassignForm" action="{{ route('court-judge.unassign') }}" method="post">
                    @csrf
                    <input type="hidden" name="judge_id" id="judge_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="unAssignModalLabel"><i class="fas fa-exclamation-circle"></i> Change/Un-assigned judge from Court</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to change/un-assign <span class="judge fw-bolder"></span> from <span class="court fw-bolder"></span>?</p>
                        <p>This will move <span class="judge fw-bolder"></span> to the historical judge for court  <span class="court fw-bolder"></span>.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="proceedBtn">Yes! Proceed.</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>

        $(function (){
            $(document).on("click", ".unassignModal", function (){
                $('.judge').html($(this).data('judge'));
                $('.court').html($(this).data('court'));
                $('#judge_id').val($(this).data('slug'));
                $('#unAssignModal').modal('show');
            })

            $('#unassignForm').submit(function (){
                $('#proceedBtn').attr('disabled', 'disabled');
            })

            @error('judge_id')
            toastr.error('Unable to change/unassign the judge from the court. Try again')
            @enderror
        })
    </script>
@endsection
