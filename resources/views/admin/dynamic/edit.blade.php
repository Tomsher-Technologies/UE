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

                        <div class="form-group">
                            <label class="form-label">Heading</label>
                            <input name="heading" type="text" value="{{ old('heading', $dynamicContent->heading) }}"
                                class="form-control mb-2">
                            <x-form.error name="heading" />
                        </div>

                        <div class="form-group">
                            <label class="form-label">Content</label>
                            <textarea name="content" id="myeditorinstance">{{ old('content', $dynamicContent->content) }}</textarea>
                            <x-form.error name="content" />
                        </div>

                        <button class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('header')
    <script src="{{ adminAsset('vendor/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: 'textarea#myeditorinstance',
            toolbar: 'undo redo | blocks| bold italic | bullist numlist checklist | code | table'
        });
    </script>
@endpush
@push('footer')
@endpush
