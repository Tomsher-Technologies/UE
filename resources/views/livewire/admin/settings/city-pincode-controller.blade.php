<div class="container page__container">
    <div class="page-section">
        <div class="page-separator">
            <div class="page-separator__text">Add new city</div>
        </div>

        <form wire:submit.prevent="saveCity" class="mb-44pt">
            <div class="form-group">
                <div class="form-row">
                    <div class="col-6 mb-2">
                        <label class="mr-sm-2 mb-2 form-label justify-content-start" for="inlineFormFilterBy">
                            Select Country
                        </label>
                        <div class="autocomplete" id="fromCountryCont" wire:ignore>
                            <select tabindex="3" id="p_country" class="form-control select2"
                                name="p_country"></select>
                        </div>
                        <x-form.error name="p_country" />
                    </div>
                    <div class="col-6 mb-2">
                        <label class="mr-sm-2 mb-2 form-label justify-content-start" for="inlineFormFilterBy">
                            Enter city name
                        </label>
                        <input class="form-control" name="p_city" id="p_city" wire:model="p_city" />
                        <x-form.error name="p_city" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-12 p-0">
                    @if ($p_msg)
                        <div class="alert alert-warning">
                            {{ $p_msg }}
                        </div>
                    @endif
                    @if ($p_success)
                        <div class="alert alert-success">
                            {{ $p_success }}
                        </div>
                    @endif
                    <button class="btn btn-primary">Save City</button>
                </div>
            </div>
        </form>


        <div class="page-separator">
            <div class="page-separator__text">Add new pincode</div>
        </div>

        <form wire:submit.prevent="savePin" class="mb-44pt">
            <div class="form-group">
                <div class="form-row">
                    <div class="col-4 mb-2">
                        <label class="mr-sm-2 mb-2 form-label justify-content-start" for="inlineFormFilterBy">
                            Select Country
                        </label>
                        <div class="autocomplete" id="fromCountryCont" wire:ignore>
                            <select tabindex="3" id="n_country" class="form-control n_country"
                                name="n_country" required></select>
                        </div>
                        <x-form.error name="n_country" />
                    </div>

                    <div class="col-4 mb-2">
                        <label class="mr-sm-2 mb-2 form-label justify-content-start" for="inlineFormFilterBy">
                            Select City
                        </label>
                        <div class="searchable">
                            <input tabindex="4" name="n_city" id="n_city" type="text" placeholder="search city"
                                onkeyup="delayCity(this,event,'from')" placeholder="off" required>
                            <ul></ul>
                        </div>
                        <x-form.error name="n_city" />
                    </div>
                    <div class="col-4 mb-2">
                        <label class="mr-sm-2 mb-2 form-label justify-content-start" for="inlineFormFilterBy">
                            Enter Pincode
                        </label>
                        <input type="text" class="form-control" name="n_pin" id="n_pin" wire:model="n_pin">
                        <x-form.error name="n_pin" />
                    </div>

                </div>
            </div>
            <div class="form-group">
                <div class="col-12 p-0">
                    @if ($n_msg)
                        <div class="alert alert-warning">
                            {{ $n_msg }}
                        </div>
                    @endif
                    @if ($n_success)
                        <div class="alert alert-success">
                            {{ $n_success }}
                        </div>
                    @endif
                    <button class="btn btn-primary">Save Pin</button>
                </div>
            </div>
        </form>

    </div>
</div>


@push('footer')
    <style>
        select:focus,
        input:focus {
            box-shadow: inset 0 1px 1px rgba(39, 44, 51, 0.075), 0 0 0 1px #006b6e !important
        }

        .main-btn {
            font-size: 16px;
            padding: 10px 40px !important;
            line-height: 16px;
            transition: all .2s ease-in
        }

        .main-btn:focus,
        .main-btn:hover,
        .main-btn:active {
            color: #2f45ff !important;
            background: #fff !important;
            ;
        }

        .search-banner {
            background-image: url(https://blackswancapital.eu/wp-content/uploads/2020/03/20_03-scaled.jpg);
            background-size: cover;
        }

        .select2-container .select2-selection--single {
            height: 40px !important;
        }

        div.searchable {
            width: 100% float: left;
            background: #fff;
            border-radius: 5px;
        }

        .searchable input {
            width: 100%;
            height: 40px;
            font-size: 15px;
            padding: 10px;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            display: block;
            font-weight: 400;
            line-height: 1.6;
            color: #000;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            outline: none;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            background: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'%3E%3Cpath fill='%23343a40' d='M2 0L0 2h4zm0 5L0 3h4z'/%3E%3C/svg%3E") no-repeat right .75rem center/8px 10px;
        }

        .searchable ul {
            position: absolute;
            z-index: 1000;
            width: 92%;
            display: none;
            list-style-type: none;
            background-color: #fff;
            border-radius: 0 0 5px 5px;
            border: 1px solid #add8e6;
            border-top: none;
            max-height: 180px;
            margin: 0;
            overflow-y: scroll;
            overflow-x: hidden;
            padding: 0;
        }

        .searchable ul li {
            padding: 7px 9px;
            border-bottom: 1px solid #e1e1e1;
            cursor: pointer;
            color: #6e6e6e;
        }

        .searchable ul li.selected {
            background-color: #e8e8e8;
            color: #333;
        }

        #searchForm label.text-black {
            font-size: 17px;
        }

        .select2-container .select2-selection--single .select2-selection__rendered,
        .form-control,
        .power_grid,
        select {
            font-size: 16px !important;
        }
    </style>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });



        $(document).ready(function() {
            $('#p_country').select2({
                ajax: {
                    url: '{{ route('getCountries') }}',
                    dataType: 'json',
                    method: 'POST',
                    placeholder: 'Search for a repository',
                    delay: 250,
                    data: function(params) {
                        var query = {
                            name: params.term,
                        }
                        return query;
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(obj) {
                                return {
                                    id: obj.id,
                                    text: obj.text,
                                };
                            })
                        };
                    }
                },
            });
            $('#p_country').on('change', function(e) {
                var data = $('#p_country').select2("val");
                @this.set('p_country', data);
            });



            // Pin
            $('#n_country').select2({
                ajax: {
                    url: '{{ route('getCountries') }}',
                    dataType: 'json',
                    method: 'POST',
                    placeholder: 'Search for a repository',
                    delay: 250,
                    data: function(params) {
                        var query = {
                            name: params.term,
                        }
                        return query;
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(obj) {
                                return {
                                    id: obj.id,
                                    text: obj.text,
                                };
                            })
                        };
                    }
                },
            });
            $('#n_country').on('change', function(e) {
                var data = $('#n_country').select2("val");
                @this.set('n_country', data);
            });

            $(".searchable input").focus(function() {
                $(this).closest(".searchable").find("ul").show();
                $(this).closest(".searchable").find("ul li").show();
            });
        });


        let timeout = null;

        function delayCity(that, event, type) {
            clearTimeout(timeout);
            timeout = setTimeout(function() {
                filterCity(that, event, type);
            }, 1500);
        }

        function filterCity(that, event, type) {
            let container, input, filter, li, input_val;
            container = $(that).closest(".searchable");
            input_val = $(that).val().toUpperCase();


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            country = $('#n_country').val();

            if (country) {
                $.ajax({
                    method: "POST",
                    url: '{{ route('getCities') }}',
                    dataType: 'json',
                    data: {
                        country: country,
                        name: input_val
                    }
                }).done(function(data) {
                    container.find("ul").empty()
                    var results = $.map(data, function(obj) {
                        return {
                            id: obj.id,
                            text: obj.text
                        };
                    })
                    results.forEach(element => {
                        container.find("ul").append('<li data-val="' + element.id + '">' + element.text +
                            '</li>');
                    });
                });
                container.find("ul li").removeClass("selected");
                setTimeout(function() {
                    container.find("ul li:visible").first().addClass("selected");
                }, 100)
            }

        }

        $(".searchable input").blur(function() {
            let that = this;
            setTimeout(function() {
                $(that).closest(".searchable").find("ul").hide();
            }, 300);
        });

        $(document).on('click', '.searchable ul li', function() {
            @this.set('n_city', $(this).text());
            $(this).closest(".searchable").find("input").val($(this).text()).blur();
        });
        $(".searchable ul li").hover(function() {
            $(this).closest(".searchable").find("ul li.selected").removeClass("selected");
            $(this).addClass("selected");
        });
    </script>
@endpush
