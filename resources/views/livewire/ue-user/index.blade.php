<div>

    <input wire:model="search" type="text" class="form-control search mb-2 mr-sm-2 mb-sm-0"
                    id="inlineFormFilterBy" placeholder="Search ..." />

    <br>

    @foreach ($users as $user)
        {{ $user->name }} <br>
    @endforeach

</div>
