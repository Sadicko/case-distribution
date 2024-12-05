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
            <div class="col-md-4 form-group">
                <label for="case_category">Case category</label>
                <select name="category" id="case_category" wire:model="selectedCategory" class="form-control">
                    <option value="all">All</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 form-group">
                <label for="startDate">Start date</label>
                <input type="date" class="form-control" required wire:model.defer="startDate">
                @error('startDate')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-3 form-group">
                <label for="endDate">End date</label>
                <input type="date" class="form-control" required wire:model.defer="endDate">
                @error('endDate')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-2 form-group pt-4">
                <button type="button" class="btn btn-secondary float-end text-white" wire:click="clearFilter"><i class="fas fa-eraser"></i> clear</button>
                <button type="submit" class="btn btn-primary float-end me-2" id="filterButton"><i class="fas fa-check"></i> Filter</button>
            </div>
        </div>
    </form>
    
    
    <div id="print-area" class="table-card mt-5 print-area" wire:loading.class="opacity-25">
        <div class="card">
            <div class="card-header border-bottom pt-3">
                <div class="row justify-content-center text-center top-header mb-4" style="display: none">
                    <h3 class="text-uppercase">JUDICIAL SERVICE OF GHANA</h3>
                    <h5 class="text-uppercase">ELECTRONIC CASE DISTRIBUTION SYSTEM</h5>
                    <img src="{{ asset('images/coat_of_arms.png') }}" alt="coat_of_arms" style="width: 150px">
                </div>
                <h5 class="text-info text-uppercase text-center">{{ $selectedCategory == 'all' ? $selectedCategory : '' }} Case load for {{ !empty($category) && ($selectedCategory != 'all') ? $category->name .' Courts' : 'All categories' }} <br> from {{  getCustomLocalDate($startDate) }} to {{  getCustomLocalDate($endDate) }}</h5>
            </div>
            <div class="card-body mb-5">
                <table class="table table-stripe table-borded">
                    <thead>
                        <tr>
                            <th>##</th>
                            <th>Court</th>
                            <th>Judge</th>
                            <th>Case load</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($dockets) > 0)
                        @foreach ($dockets as $docket)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $docket->courts?->name }}</td>
                            <td>{{ $docket->judges?->name ?? 'N/A' }}</td>
                            <td>{{ $docket->case_load }}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="4"><h5 class="text-center text-muted">No records found</h5></td>
                        </tr>
                        @endif
                    </tbody>
                </table>                
            </div>
            <div class="custom-footer text-center mt-5" style="display: none">
                <p style="font-size: 12px;">Powered by Judicial Service ICT</p>
            </div>
        </div>
    </div>
    
    @if (count($dockets) != 0)
    <div class="d-flex justify-content-center mt-5">
        <button class="btn btn-primary btn-sm me-3 bg-gradient-primary print-button" id="print-button"><i class="fas fa-print"></i> Print</button>
    </div>
    @endif
</div>


@script
<script>
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