<div>
    <form wire:submit.prevent="save">
        <input wire:model="user.name" type="text" class="form-control" placeholder="Name">
        @error('user.name')
            <span class="invalid-feedback d-block">{{ $message }}</span>
        @enderror

        <input wire:model="user.email" type="email" class="form-control" placeholder="Email">
        @error('user.email')
            <span class="invalid-feedback d-block">{{ $message }}</span>
        @enderror

        <input wire:model="password" type="password" class="form-control" placeholder="password">
        @error('password')
            <span class="invalid-feedback d-block">{{ $message }}</span>
        @enderror

        <select wire:model="user.status" wire:ignore>
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>

        <input type="submit" value="Save">
    </form>
</div>
