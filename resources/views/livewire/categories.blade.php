<div>

    <div class="row align-item-center">
        <div class="@can('Create categories') col-md-8  @else col-md-12 @endcan">
            <div class="card mb-3">
                <div class="card-body basic-custome-color pt-5">
                    <form wire:submit="search">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Category" aria-label="Category"  wire:model="query" aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fas fa-search"></i> Search</button>
                            <button class="btn btn-outline-default border text-muted" type="button" id="button-addon2" wire:click="clear"><i class="fas fa-times-circle text-danger"></i></button>
                        </div>
                    </form>

                    {{-- <nav>
                        <div class="nav nav-tabs nav-justified" id="nav-tab" role="tablist">
                            @foreach ($courtTypes as $courttype)
                            @if ($courttype->categories_count > 0)
                            <button class="nav-link @if($loop->first) active @endif" id="{{  $courttype->name }}-tab" data-bs-toggle="tab" data-bs-target="#{{ $courttype->name }}-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">{{ $courttype->name  }}</button>
                            @endif
                            @endforeach
                        </div>
                    </nav> --}}
                    {{-- <div class="tab-content" id="nav-tabContent">
                        @foreach ($courtTypes as $courttype2)
                        @if ($courttype->categories_count > 0)
                        <div class="tab-pane fade @if($loop->first) show active @endif" id="{{  $courttype2->name }}-home" role="tabpanel" aria-labelledby="{{  $courttype2->name }}-tab">
                            {{ $courttype2->name }}
                        </div>
                        @endif
                        @endforeach
                    </div> --}}

                    <div class="wire:opacity=4">
                        <table id="" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>##</th>
                                    <th>Category</th>
                                    <th>Court type</th>
                                    <th>Date Created</th>
                                    <th>Status</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($categories->total() > 0)
                                @foreach($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ ucfirst($category->name) }}</td>
                                    <td>{{ $category->courttypes?->name ?? '-' }}</td>
                                    <td>{{ $category->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        @if($category->status == "Published")
                                        <small class="w-100 badge bg-success text-white">{{ $category->status }}</small>
                                        @elseif($category->status == "Archived")
                                        <small class="w-100 badge bg-primary text-white">{{ $category->status }}</small>
                                        @else
                                        <small class="w-100 badge bg-info text-white">{{ $category->status }}</small>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @can('Edit categories')
                                        <a href="#" wire:click.prevent="edit('{{ $category->slug }}')"><i class="fas fa-pencil-alt"></i></a>
                                        @else
                                        <span>-</span>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="6">
                                        <h5 class="text-muted text-center">No records found</h5>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
        @can('Create categories')
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body basic-custome-color">
                    <form wire:submit.prevent="saveCategory">
                        <div class="row">
                            <div class="form-group mb-3">
                                <label for="category_name" class="form-label">Category name</label>
                                <input type="text" class="form-control" name="category_name" id="category_name" wire:model="categoryName" required>
                                @error('categoryName') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="courtType">Court type</label>
                                <select class="form-control" wire:model="courtType" required>
                                    <option>---Choose court type---</option>
                                    @foreach($courtTypes as $court_type)
                                    <option value="{{ $court_type->id }}">{{ ucfirst($court_type->name) }}</option>
                                    @endforeach
                                </select>
                                @error('courtType') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" id="status" wire:model="status" required>
                                    <option>---Choose status---</option>
                                    @foreach(status() as $status)
                                    <option value="{{ $status }}">{{ $status }}</option>
                                    @endforeach
                                </select>
                                <div>
                                    @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endcan
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                    <button type="button" class="close-modal btn btn-outline-secondary">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="update">
                        <input type="hidden" wire:model="slug" value="{{ $slug }}">
                        <div class="form-group mb-4">
                            <label for="editCategoryName">Category Name</label>
                            <input type="text" id="editCategoryName" class="form-control" wire:model="editCategoryName">
                            @error('editCategoryName') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="editCourtType">Court type</label>
                            <select class="form-control" wire:model="editCourtType">
                                <option>---Choose court type---</option>
                                @foreach($courtTypes as $court_type)
                                <option value="{{ $court_type->id }}" {{  $court_type->id == $editCourtType ? 'selected' : '' }}>{{ $court_type->name }}</option>
                                @endforeach
                            </select>
                            @error('editCourtType') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="editStatus">Status</label>
                            <select class="form-control wire-select2" wire:model="editStatus">
                                <option>---Choose status---</option>
                                @foreach(status() as $e_status)
                                <option value="{{ $e_status }}" {{  $e_status == $editStatus ? 'selected' : '' }}>{{ $e_status }}</option>
                                @endforeach
                            </select>
                            @error('editStatus') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mt-4 float-end">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>


@script
<script>

    // Handle reopening the modal when validation errors occur
    window.addEventListener('show-edit-modal', () => {
        const modal = new bootstrap.Modal(document.getElementById('editCategoryModal'), {
            backdrop: 'static',
            keyboard: false
        });
        modal.show();
    });

    // Handle closing the modal after a successful update
    window.addEventListener('hide-edit-modal', () => {
        const modal = bootstrap.Modal.getInstance(document.getElementById('editCategoryModal'));
        if (modal) {
            modal.hide();
        }
    });

    // Close modal programmatically on click
    document.querySelectorAll('.close-modal').forEach(button => {
        button.addEventListener('click', () => {
            const modalElement = document.getElementById('editCategoryModal');
            const modal = bootstrap.Modal.getInstance(modalElement);

            if (modal) {
                modal.hide();
                // Explicitly remove the backdrop
                document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
            }
        });
    });

</script>
@endscript
