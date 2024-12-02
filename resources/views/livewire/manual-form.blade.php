<div>
    <div class="row">
        <div class="form-group col-6 mb-3" @if (in_array(Auth::user()->access_type, registry_level()) && count($categories) > 0 )  @endif>
            <label for="case_category" class="form-label">Case category*</label>
            <select name="case_category" class="form-control select2" id="case_category">
                <option value=""></option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('case_category') == $category->id ? 'selected' : (count($categories) ==  1 ? 'selected' : '') }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('case_category')
            <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group col-6 mb-3 commercial_type_box" @if($errors->any() || (count($categories) == 1 && $categories[0]->name == "COMMERCIAL")) @else style="display: none;" @endif>
            <label for="commercial_type" class="form-label">Type</label>
            <select name="commercial_type" class="form-control select2" id="commercial_type" style="width: 100%">
                <option value=""></option>
                @foreach(commercial_type() as $type)
                    <option value="{{ $type }}" {{ old('commercial_type') == $type ? 'selected' : ''}}>{{ $type }}</option>
                @endforeach
            </select>
            @error('commercial_type')
            <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group col-6 mb-3" @if (in_array(Auth::user()->access_type, registry_level()) && count($locations) > 0 )  @endif>
            <label for="location" class="form-label">Location*</label>
            <select name="location" class="form-control select2" id="selectedLocation"  wire:model.live="selectedLocation">
                <option value=""></option>
                @foreach($locations as $location)
                    <option value="{{ $location->id }}" {{ old('location') == $location->id ? 'selected' : (count($locations) ==  1 ? 'selected' : '')}}>{{ $location->name }}</option>
                @endforeach
            </select>
            @error('location')
            <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group col-6 mb-3" @if (in_array(Auth::user()->access_type, registry_level()) && count($courts) > 0 )  @endif>
            <label for="selectedCourt" class="form-label">Assigned Court*</label>
            <select name="court" class="form-control select2" id="selectedCourt" wire:model.live="selectedCourt"  wire:key="{{ $selectedLocation }}">
                <option value="">---Select a court---</option>
                @foreach($courts as $court)
                    <option value="{{ $court->id }}" {{ old('court') == $court->id ? 'selected' : (count($courts) ==  1 ? 'selected' : '')}}>{{ $court->name }}</option>
                @endforeach
            </select>
            @error('court')
            <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group col-6 mb-3">
            <label for="judge" class="form-label">Judge*</label>
            <select name="judge" class="form-control select2" wire:model="selectedJudge"  wire:key="{{ $selectedCourt }}" >
                <option value="">---Select a court---</option>
                @foreach($judges as $judge)
                    <option value="{{ $judge->id }}" {{ old('judge') == $judge->id ? 'selected' : (count($judges) ==  1 ? 'selected' : '')}}>{{ $judge->name }}</option>
                @endforeach
            </select>
            @error('judge')
            <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>

@script
<script>

    $(function (){

        $(document).on("change", "#case_category", function () {
            if($(this).find('option:selected').data('name') === "COMMERCIAL"){
                $('.commercial_type_box').show();
            }else{
                $('.commercial_type_box').hide();
            }

        })

        $('#selectedLocation').on('change', function (e) {
            var selectedLocation = $(this).select2("val");
        @this.set('selectedLocation', selectedLocation);
        });

        $('#selectedCourt').on('change', function (e) {
            var selectedCourt = $(this).select2("val");
            cosnole.log(selectedCourt)
        @this.set('selectedCourt', selectedCourt);
        });

        $('#selectedCourt').on('change', function (e) {
            var selectedJudge = $(this).select2("val");
            cosnole.log(selectedJudge)
        @this.set('selectedJudge', selectedJudge);
        });

        //events
        $wire.on('select2Updated', () => {
            setTimeout(function (){
                $('#selectedLocation').select2({
                    placeholder: 'Choose a location',
                }).on('change', function () {
                    // Trigger Livewire update when selection changes
                    $wire.dispatch('updatedSelectedLocation', $(this).val());
                });

                // $('#selectedCourt').select2({
                //     placeholder: 'Choose a court',
                // }).on('change', function () {
                //     $wire.dispatch('updatedSelectedCourt', $(this).val());
                // });
                //
                // $('#selectedJudge').select2({
                //     placeholder: 'Choose a judge',
                // }).on('change', function () {
                //     $wire.dispatch('updatedSelectedJudge', $(this).val());
                // });
            }, 100)
        })

    });
</script>
@endscript
