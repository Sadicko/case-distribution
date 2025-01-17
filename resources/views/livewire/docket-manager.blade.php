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
                            @if(Auth::user()->hasRole('Super Admin') || !Gate::any(limited_access_level()))
                                <div class="col form-group">
                                    <label for="location"  class="form-label">Location*</label>
                                    <select class="form-control select2" name="location"  id="location" required wire:model="selectedLocation">
                                        <option value="all">All</option>
                                        @foreach($locations as $location)
                                            <option value="{{ $location->id }}" {{ old('location', $selectedLocation) == $location->id ? 'selected' : '' }} >{{ $location->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label for="registry"  class="form-label">Registry*</label>
                                    <select class="form-control select2" name="registry"  id="registry" required wire:model="selectedRegistry">
                                        <option value="all">All</option>
                                        @foreach($registries as $registry)
                                            <option value="{{ $registry->id }}" {{ old('registry', $selectedRegistry) == $registry->id ? 'selected' : '' }}>{{ $registry->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-3 mb-2">
                                    <label for="court"  class="form-label">Court</label>
                                    <select name="court" id="court" wire:model="selectedCourt" class="form-control select2">
                                        <option value="all">All</option>
                                        @foreach($courts as $court)
                                            <option value="{{ $court->id }}"  {{ old('courts', $selectedCourt) == $court->id ? 'selected' : '' }}>{{ $court->name }}  @if(!in_array(Auth::user()->access_type, registry_level())) - {{  $court->courttypes->name }} @endif  </option>
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
                                <div class="form-group col-8 mb-2">
                                    <label for="searchTerm"> Enter search</label>
                                    <input type="text" name="searchTerm" class="form-control" id="searchTerm" placeholder="Enter Suit no or Case title" wire:model="searchTerm" >
                                </div>
                                <div class="form-group col-4 mb-2 mt-2">
                                    <div class="form-group btn-group  d-flex justify-content-end pt-3">
                                        <button type="submit" class="btn btn-primary bg-dark btn-sm btn-block "><i
                                                class="fas fa-search"></i>
                                            Search</button>
                                        <button type="button" class="btn btn-secondary btn-sm btn-block" wire:click="clear"><i
                                                class="fas fa-undo"></i>
                                            Reset search</button>
                                        <button type="button" class="btn bg-danger text-white btn-sm btn-block" wire:click="$refresh"><i
                                                class="fas fa-refresh"></i>
                                            Refresh page</button>
                                    </div>
                                </div>
                            @elseif(!in_array(Auth::user()->access_type, court_room_level()))
                                <div class="form-group col-5 mb-2" wire:ignore>
                                    <label for="case_category">Case category</label>
                                    <select name="category" id="case_category" wire:model.live="selectedCategory" class="form-control select2">
                                        <option></option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }} @if(!in_array(Auth::user()->access_type, registry_level())) - {{  $category->courttypes->name }} @endif</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-3 mb-2">
                                    <label for="court">Court</label>
                                    <select name="court" id="court" wire:model="selectedCourt" wire:key="{{ $selectedCategory }}" @if(!$selectedCategory) disabled @endif class="form-control select2">
                                        <option></option>
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
                                <div class="form-group col-8 mb-2">
                                    <label for="searchTerm"> Enter search</label>
                                    <input type="text" name="searchTerm" class="form-control" id="searchTerm" placeholder="Enter Suit no or Case title" wire:model="searchTerm" >
                                </div>
                                <div class="form-group col-4 mb-2 mt-2">
                                    <div class="form-group btn-group  d-flex justify-content-end pt-3">
                                        <button type="submit" class="btn btn-primary bg-dark btn-sm btn-block "><i
                                                class="fas fa-search"></i>
                                            Search</button>
                                        <button type="button" class="btn btn-secondary btn-sm btn-block" wire:click="clear"><i
                                                class="fas fa-undo"></i>
                                            Reset search</button>
                                        <button type="button" class="btn bg-danger text-white btn-sm btn-block" wire:click="$refresh"><i
                                                class="fas fa-refresh"></i>
                                            Refresh page</button>
                                    </div>
                                </div>
                            @else
                                <div class="form-group col-8 mb-2">
                                    <label for="searchTerm"> Enter search</label>
                                    <input type="text" name="searchTerm" class="form-control" id="searchTerm" placeholder="Enter Suit no or Case title" wire:model="searchTerm" >
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
                                <div class="form-group d-flex justify-content-end  mb-2 mt-2">
                                    <div class="form-group btn-group pt-3">
                                        <button type="submit" class="btn btn-primary bg-dark btn-sm btn-block "><i
                                                class="fas fa-search"></i>
                                            Search</button>
                                        <button type="button" class="btn btn-secondary btn-sm btn-block" wire:click="clear"><i
                                                class="fas fa-undo"></i>
                                            Reset search</button>
                                        <button type="button" class="btn bg-danger text-white btn-sm btn-block" wire:click="$refresh"><i
                                                class="fas fa-refresh"></i>
                                            Refresh page</button>
                                    </div>
                                </div>
                            @endif

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
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>##</th>
                                    <th>Suit number</th>
                                    <th>Case title</th>
                                    <th>Case category</th>
                                    <th>Court</th>
                                    <th>Judge</th>
                                    <th>Date assigned</th>
                                    <th>Status</th>
                                    @can('view-action-column')
                                        <th  class="text-nowrap w-auto">Action</th>
                                    @endcan
                                </tr>
                                </thead>
                                <tbody>
                                @if($dockets->total() > 0)
                                    @foreach($dockets as $docket)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>

                                                @can('Read cases')
                                                    <a href="{{ route('cases.show', $docket->slug) }}" class="text-info"> {{ $docket->suit_number }}</a>
                                                @else
                                                    {{ $docket->suit_number }}
                                                @endcan
                                            </td>
                                            <td>{{ $docket->case_title }}</td>
                                            <td>{{ $docket->categories->name }}</td>
                                            <td>{{ $docket->courts?->name ?? '-' }}</td>
                                            <td>{{ $docket->judges?->name ?? '-' }}</td>
                                            <td>{{ !empty($docket->assigned_date) ? getCustomLocalTime($docket->assigned_date) : '-' }}</td>
                                            <td>{{ $docket->status }}</td>
                                            @can('view-action-column')
                                                <td class="text-center">
                                                    @canany(['Update cases', 'Re-assign cases', 'Print cases'])
                                                        @can('Update cases')
                                                            <a href="{{ route('cases.edit', $docket->slug) }}" class="me-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit case"><i class="fas fa-pencil" style="font-size: 11px;"></i></a>
                                                        @endcan
                                                        {{-- @can('Re-assign cases')
                                                            <a href="{{ route('court-judge', $docket->slug) }}"  class="me-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Re-assign case"><i class="fas fa-sync" style="font-size: 11px;"></i></a>
                                                        @endcan --}}
                                                        @if(!empty($docket->assigned_date))
                                                            @can('Print cases')
                                                                <a href="{{ route('cases.print', $docket->slug) }}" class="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Print case"><i class="fas fa-print" style="font-size: 11px;"></i></a>
                                                            @endcan
                                                        @endif
                                                    @else
                                                        <span>-</span>
                                                    @endcanany
                                                </td>
                                            @endcan
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9">
                                            <h5 class="text-muted text-center">No records found</h5>
                                        </td>
                                    </tr>
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
</div>

@script
<script>

    $(function (){

        $('#case_category').on('change', function (e) {
            var selectData = $(this).select2("val");
        @this.set('selectedCategory', selectData);
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
                const startDate = document.getElementById('startDate');
                const endDate = document.getElementById('endDate');

                if (startDate) {
                    startDate.setAttribute('max', today);
                }

                if (endDate) {
                    endDate.setAttribute('max', today);
                }

                $('.select2').select2({
                    placeholder: 'Choose court',
                });

            }, 100); // Delay to ensure DOM is updated
        });


        $('#filterForm').submit(function (event) {
            event.preventDefault(); // Prevent form submission if necessary

            let selectedLocation = $('#location').val();
            if (selectedLocation) {
            @this.set('selectedLocation', selectedLocation);
            }

            let selectedRegistry = $('#registry').val();
            if (selectedRegistry) {
            @this.set('selectedRegistry', selectedRegistry);
            }

            let selectedCourt = $('#court').val();
            if (selectedCourt) {
            @this.set('selectedCourt', selectedCourt);
            }

            let searchTerm = $('#searchTerm').val();
            if (searchTerm) {
            @this.set('searchTerm', searchTerm);
            }

            let startDate = $('#startDate').val();
            if (startDate) {
            @this.set('startDate', startDate);
            }

            let endDate = $('#endDate').val();
            if (endDate) {
            @this.set('endDate', endDate);
            }

        @this.call('search'); // Trigger the Livewire method
        });

    })
</script>
@endscript

