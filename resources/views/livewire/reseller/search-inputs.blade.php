<div class="row align-items-center">
    <div class="col-sm-4">
        <div class="form-group text-left">
            <label class="text-white" for="filter_name">Pickup Country</label>
            <div>
                <div class="autocomplete">

                    {{ $fromcountry }}

                    <input type="hidden" name="fromCountry" wire:model="selectedFromCountry">
                    <select id="fromCountry" class="form-control select2" name="fromCountry" wire:model="fromcountry"
                        required>
                        @foreach ($fromcountries as $item)
                            <option value="{{ $item->id }}">{{ $item->text }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group text-left">
            <label class="text-white" for="filter_name">Pickup City</label>
            <div>
                <div class="autocomplete">
                    <select id="fromCity" class="form-control select2" name="fromCity"></select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group text-left">
            <label class="text-white" for="filter_name">Pickup Pincode</label>
            <div>
                <div class="autocomplete">
                    <select id="fromPincode" class="form-control select2" name="fromPincode"></select>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row align-items-center">
    <div class="col-sm-4">
        <div class="form-group text-left">
            <label class="text-white" for="filter_name">Delivery Country</label>
            <div>
                <div class="autocomplete">
                    <select id="toCountry" class="form-control" name="toCountry" required></select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group text-left">
            <label class="text-white" for="filter_name">Delivery City</label>
            <div>
                <div class="autocomplete">
                    <select id="toCity" class="form-control select2" name="toCity"></select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group text-left">
            <label class="text-white" for="filter_name">Delivery Pincode</label>
            <div>
                <div class="autocomplete">
                    <select id="toPincode" class="form-control select2" name="toPincode"></select>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#fromCountry').select2();

        $('#fromCountry').on('select2:select', function(e) {
            var data = e.params.data;
            Livewire.emit('updatedFromcountry', data.id)
        })


        // $('#fromCountry').select2();

        // $('#fromCountry').on('select2:select', function(e) {
        //     var data = e.params.data;
        //     Livewire.emit('updatedFromcountry', data.id)
        // })
    </script>

</div>
