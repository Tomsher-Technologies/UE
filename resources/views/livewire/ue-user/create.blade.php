<div>
    <form wire:submit.prevent="save">
        <input wire:model="name" type="text" class="form-control" placeholder="Name">
        @error('name')
            <span class="invalid-feedback d-block">{{ $message }}</span>
        @enderror

        <input wire:model="email" type="email" class="form-control" placeholder="Email">
        @error('email')
            <span class="invalid-feedback d-block">{{ $message }}</span>
        @enderror

        <input wire:model="password" type="password" class="form-control" placeholder="password">
        @error('password')
            <span class="invalid-feedback d-block">{{ $message }}</span>
        @enderror

        <input type="submit" value="Save">

    </form>

</div>
