@extends('layouts.admin')

@section('content')
    <div class="container page__container">
        <div class="page-section">
            <div class="page-separator">
                <div class="page-separator__text">Edit dynamic Contents
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <form method="POST" action="{{ route('admin.dynamic-content.update', $dynamicContent) }}">

                        @csrf
                        @method('PATCH')

                        <x-form.input name='heading' text='Heading' :model="$dynamicContent" />

                        <div class="form-group">
                            <label class="form-label">Name</label>
                            <input type="text" name="heading" class="form-control mb-2">
                            <x-form.error name="heading" />
                        </div>

                        <button class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
