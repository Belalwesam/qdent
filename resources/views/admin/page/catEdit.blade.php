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
                    <div class="card-title"> تعديل صفحة  </div>
                </div>
                <form  method="POST" action="{{route('page.update',$page->id)}}" class="formAction">
                    @csrf
                    <input type="hidden" name="id" value="{{$page->id}}">
@method('Patch')
                    <div class="card-body">
                        <div class="form-group">
                            <label>العنوان </label>
                            <input type="text" name="name" value="{{$page->title}}" class="form-control">
                        </div>
  <div class="form-group">
                            <label>العنوان الفرعي </label>
                            <input type="text" name="name" value="{{$page->sub_title}}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>الإسم اللطيف </label>
                            <input type="text" name="slug"  value="{{$page->slug}}" class="form-control">
                            <span class="text-muted">يجب ان يكون بالانجليزي </span>
                        </div>

                        <div class="form-group">
                            <label>المحتوى </label>
                            <textarea id="summernote" name="content">{{$page->content}}</textarea>
                        </div>





                <button type="submit" class="btn btn-primary btn-update mr-2 w-100px p-4 " >حفظ</button>

            </div>
            </form>

            </div>
    </div>



        <div class="toast-container">
        <div class="alert alert-success d-none" role="alert"></div>
    </div>
@endsection

@section('scripts')

    <script src="{{asset('/js/ajax.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
@endsection

