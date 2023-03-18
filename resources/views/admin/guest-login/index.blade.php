@extends('layout.default')
@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom  gutter-b example example-compact">
                <div class="card-header">
                    <div class="card-title">Guest Login</div>
                </div>
                <form method="POST" action="{{ route('guest_login.update') }}" class="formAction">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="form-group">
                            <label>Guest Login </label>
                            <select class="form-select form-control" id="guest_login" name="guest_login">
                                <option value=1 @if ($guest_login == 1) selected @endif>On</option>
                                <option value=0 @if ($guest_login == 0) selected @endif>Off</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-update mr-2 w-100px p-4 ">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="toast-container">
        <div class="alert alert-success d-none" role="alert"></div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('/js/ajax.js') }}"></script>
@endsection
{{-- 
@section('scripts')
    <script src="/assets/js/pages/crud/forms/editors/tinymce.js?v=7.2.9"></script>
    <script>
        $(document).ready(function () {
            $('#summernote').summernote({
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
        // $(document).ready(function() {
        //     $('#summernote').summernote();
        // });
    </script>
@endsection --}}
