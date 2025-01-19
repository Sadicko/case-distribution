<div>
    @section('styles')
    <style>
        @media print {
            @page {
                size: A4;
            }

            .print-button {
                display: none;
            }

            .top-header{
                display: block !important;
            }

            .print-area {
                display: block !important;
            }

            .non-printable {
                display: none !important;
            }
            img{
                width: 100px;
                height: 100px;
                object-fit: contain;
            }

            .custom-footer{
                display: block !important;
            }

        }

    </style>
    @endsection

    <form id="filterForm" wire:submit.prevent="fetchReport">

        <div class="row justify-content-center">
            <div class="col form-group">
                <label for="location"  class="form-label">Location*</label>
                <select class="form-control select2" name="location"  id="location" required wire:model="selectedLocation">
                    <option value="all">All</option>
                    @foreach($locations as $location)
                    <option value="{{ $location->id }}" {{ old('location') == $location->id ? 'selected' : '' }} >{{ $location->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col form-group">
                <label for="registry"  class="form-label">Registry*</label>
                <select class="form-control select2" name="registry"  id="registry" required wire:model="selectedRegistry">
                    <option value="all">All</option>
                    @foreach($registries as $registry)
                    <option value="{{ $registry->id }}" {{ old('registry') == $registry->id ? 'selected' : '' }} >{{ $registry->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col form-group">
                <label for="case_category" class="form-label">Case category</label>
                <select name="category" class="form-control select2" id="case_category" wire:model="selectedCategory">
                    <option value="all">All</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }} @if(!in_array(Auth::user()->access_type, registry_level())) - {{  $cat->courttypes->name }} @endif </option>
                    @endforeach
                </select>
            </div>
            {{-- <div class="col form-group">
                <label for="startDate"  class="form-label">Start date</label>
                <input type="date" class="form-control" required wire:model.defer="startDate">

            </div>
            <div class="col form-group">
                <label for="endDate"  class="form-label">End date</label>
                <input type="date" class="form-control" required wire:model.defer="endDate">
            </div> --}}
            <div class="col-12 form-group pt-4">
                <button type="button" class="btn btn-secondary float-end text-white" wire:click="clearFilter"><i class="fas fa-eraser"></i> clear</button>
                <button type="submit" class="btn btn-primary float-end me-2" id="filterButton"><i class="fas fa-check"></i> Filter</button>
            </div>
        </div>
    </form>

    <hr>

    <div id="print-area" class="table-card mt-5 print-area" wire:loading.class="opacity-25">
        <div class="card">
            <div class="card-header border-bottom pt-3">
                <div class="row justify-content-center text-center top-header mb-4" style="display: none">
                    <h3 class="text-uppercase">JUDICIAL SERVICE OF GHANA</h3>
                    <h5 class="text-uppercase">ELECTRONIC CASE DISTRIBUTION SYSTEM</h5>
                    <img src="{{ asset('images/coat_of_arms.png') }}" alt="coat_of_arms" style="width: 150px">
                </div>
                <h5 class="text-primary text-uppercase text-center">
                    Workload load
                    @if(Auth::user()->hasRole('Super Admin') || !Gate::any(limited_access_level()))
                        {{ !empty($courtSelected) && ($selectedCourt != 'all') ? "for " . $courtSelected->name : ' For all '.$courtRegistry?->name . " courts"  }}

                        {{ !empty($courtLocation) && ($selectedLocation != 'all') ? ' - '. $courtLocation->name : ' ' }}
                    @else
                        {{ !empty($courtSelected) && ($selectedCourt != 'all') ? "for " . $courtSelected->name : ' For all '.Auth::user()->registries->name . " courts"  }}

                        {{  ', '. Auth::user()->locations->name }}
                    @endif
                    {{-- <br> from
                    <br> {{  getCustomLocalDate($startDate) }} to {{  getCustomLocalDate($endDate) }} --}}
                </h5>
            </div>
            <div class="card-body mb-5">
                <table class="table table-stripe table-borded">
                    <thead>
                        <tr>
                            <th>##</th>
                            <th>Court</th>
                            <th>Judge</th>
                            <th class="text-center">Total workload</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($courts) > 0)
                        @foreach ($courts as $court)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $court->name }}</td>
                            <td>{{ $court->currentJudge[0]?->name ?? 'N/A' }}</td>
                            <td class="text-center">{{ $court->case_count }}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="4"><h5 class="text-center text-muted">No records found</h5></td>
                        </tr>
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2"></th>
                            <th>Total</th>
                            <th class="text-center">{{ $courts->sum('case_count') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="custom-footer text-center mt-5" style="display: none">
                <p style="font-size: 12px;">Powered by Judicial Service ICT</p>
            </div>
        </div>
    </div>

    @if (count($courts) != 0)
    <div class="d-flex justify-content-center mt-5">
        <button class="btn btn-primary btn-sm me-3 bg-gradient-primary print-button" id="print-button"><i class="fas fa-print"></i> Print</button>
    </div>
    @endif
</div>


@script
<script>
    $(function (){

        //events
        $wire.on('search-completed', () => {


            setTimeout(() => {

                $('.select2').select2({
                    placeholder: 'Choose option',
                });

            }, 100); // Delay to ensure DOM is updated
        });


        $('#filterForm').submit(function (event) {
            // Prevent form submission if necessary
            event.preventDefault();

            let selectedLocation = $('#location').val();
            if (selectedLocation) {
                @this.set('selectedLocation', selectedLocation);
            }

            let selectedRegistry = $('#registry').val();
            if (selectedRegistry) {
                @this.set('selectedRegistry', selectedRegistry);
            }

            let selectedCategory = $('#case_category').val();
            if (selectedCategory) {
                @this.set('selectedCategory', selectedCategory);
            }

            // let startDate = $('#startDate').val();
            // if (startDate) {
            //     @this.set('startDate', startDate);
            // }

            // let endDate = $('#endDate').val();
            // if (endDate) {
            //     @this.set('endDate', endDate);
            // }

            // Trigger the Livewire method
            @this.call('fetchReport');
        });

    })

    document.addEventListener('click', function (event) {
        // Check if the clicked element has the ID 'print-button'
        if (event.target.id === 'print-button') {
            const printArea = document.getElementById('print-area').innerHTML;
            const originalContent = document.body.innerHTML;

            // Replace body content with the print area
            document.body.innerHTML = printArea;

            // Trigger the print dialog
            window.print();

            // Restore the original content
            document.body.innerHTML = originalContent;

            // Reload the scripts (if needed)
            window.location.reload();
        }
    });


</script>
@endscript
