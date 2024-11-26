<div>

    <div class="accordion mb-5" id="accordionSearch">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button bg-teal text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <i class="fas fa-filter me-2"></i> Search
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionSearch">
                <div class="accordion-body">
                    <form id="filterForm"  wire:submit="search">
                        <div class="row mb-2">
                            <div class="form-group col-5 mb-2">
                                <label for="case_category">Case category</label>
                                <select name="category" id="case_category" wire:model.live="selectedCategory" class="form-control select2">
                                    <option value="">---Select---</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-3 mb-2">
                                <label for="case_court">Court</label>
                                <select name="court" id="case_court" wire:model="selectedCourt" wire:key="{{ $selectedCategory }}" @if(!$selectedCategory) disabled @endif class="form-control">
                                    <option value="">---Select---</option>
                                    @foreach ($courts as $court)
                                        <option value="{{ $court->id }}">{{ $court->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-2 mb-2">
                                <label for="from">From</label>
                                <input type="date" name="startDate" id="startDate" class="form-control datepicker" placeholder="Start date"
                                       autocomplete="off" wire:model="startDate">
                            </div>
                            <div class="form-group col-2 mb-2">
                                <label for="to"> To</label>
                                <input type="date" name="endDate" id="endDate" class="form-control datepicker" placeholder="End date"
                                       autocomplete="off"  wire:model="endDate">
                            </div>
                            <div class="form-group col-9 mb-2">
                                <label for="searchTerm"> Enter search</label>
                                <input type="text" name="searchTerm" class="form-control" id="searchTerm" placeholder="Enter Suit no or Case title" wire:model="searchTerm" >
                            </div>
                            <div class="form-group col-3 mb-2 mt-2">
                                <div class="form-group btn-group  d-flex justify-content-end pt-3">
                                    <button type="submit" class="btn btn-primary bg-dark btn-sm btn-block "><i
                                            class="fas fa-search"></i>
                                        Search</button>
                                    <button type="button" class="btn btn-secondary btn-sm btn-block" wire:click="clear"><i
                                            class="fas fa-undo"></i>
                                        Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="accordion mb-5" id="accordionCases">
        <div class="accordion-item">
            <h2 class="accordion-header" id="caseHeadingOne">
                <button class="accordion-button bg-teal text-white" type="button" data-bs-toggle="collapse" data-bs-target="#caseCollapseOne" aria-expanded="true" aria-controls="caseCollapseOne">
                    <i class="fas fa-folder-open me-2"></i> Case list
                </button>
            </h2>
            <div id="caseCollapseOne" class="accordion-collapse collapse show" aria-labelledby="caseHeadingOne" data-bs-parent="#accordionCases">
                <div class="accordion-body" wire:loading.class="opacity-25">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover display">
                                <thead>
                                <tr>
                                    <th>##</th>
                                    <th>Suit number</th>
                                    <th>Case title</th>
                                    <th>Case category</th>
                                    <th>Court</th>
                                    <th>Judge</th>
                                    <th>Date Filed</th>
                                    <th>Date assigned</th>
                                    <th>Status</th>
                                    <th  class="text-nowrap w-auto">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($dockets->total() > 0)
                                    @foreach($dockets as $docket)
                                        <tr>
                                            <td>{{ $docket->index + 1 }}</td>
                                            <td>{{ $docket->suit_number }}</td>
                                            <td>{{ $docket->case_title }}</td>
                                            <td>{{ $docket->categories->name }}</td>
                                            <td>{{ $docket->courts?->name ?? '-' }}</td>
                                            <td>{{ $docket->courts?->currentJudge[0]?->name ?? '-' }}</td>
                                            <td>{{ $docket->date_filed->format('d-m-Y') }}</td>
                                            <td>{{ $docket->assigned_date?->format('d-m-Y') ?? '-' }}</td>
                                            <td>{{ $docket->status }}</td>
                                            <td class="text-center">
                                                @canany(['Update cases', 'Re-assign cases', 'Print cases'])
                                                    @can('Update cases')
                                                        <a href="{{ route('courts.edit', $docket->slug) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit case"><i class="fas fa-pencil"></i></a>
                                                    @endcan
{{--                                                    @can('Re-assign cases')--}}
{{--                                                        <a href="{{ route('court-judge', $docket->slug) }}"  class="me-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Re-assign case"><i class="fas fa-sync"></i></a>--}}
{{--                                                    @endcan--}}
                                                    @can('Print cases')
                                                        <a href="{{ route('courts.assign-categories', $docket->slug) }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Print case"><i class="fas fa-print"></i></a>
                                                    @endcan
                                                @else
                                                    <span>-</span>
                                                @endcanany
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <td colspan="9">
                                        <h5 class="text-muted text-center">No records found</h5>
                                    </td>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $dockets->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @script
    <script>

        $(function (){
            $('#case_category').select2({
                placeholder: 'Choose case category',
            });

            $('#case_category').on('change', function (e) {
                var selectData = $(this).select2("val");
            @this.set('selectedCategory', selectData);
            });
            $('#case_court').select2({
                placeholder: 'Choose court',
            });

            // Gets today's date in YYYY-MM-DD format
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('startDate').setAttribute('max', today);
            document.getElementById('endDate').setAttribute('max', today);

            document.getElementById('startDate').addEventListener('change', function () {
                $('#endDate').attr('required', 'required');
            });

            //events
            $wire.on('search-completed', () => {

                //set dates
                const today = new Date().toISOString().split('T')[0];

                setTimeout(() => {
                    $('#case_category').select2({
                        placeholder: 'Choose case category',
                    });
                    $('#case_court').select2({
                        placeholder: 'Choose court',
                    });

                    const startDate = document.getElementById('startDate');
                    const endDate = document.getElementById('endDate');

                    if (startDate) {
                        startDate.setAttribute('max', today);
                    }

                    if (endDate) {
                        endDate.setAttribute('max', today);
                    }
                }, 100); // Delay to ensure DOM is updated
            });


            $('#filterForm').submit(function (){
                let selectedCourt = $('#case_court').val();
            @this.set('selectedCourt', selectedCourt);

                let searchTerm = $('#searchTerm').val();
            @this.set('searchTerm', searchTerm);

                let startDate = $('#startDate').val();
            @this.set('startDate', startDate);

                let endDate = $('#endDate').val();
            @this.set('endDate', endDate);


            })

        })
    </script>
    @endscript

