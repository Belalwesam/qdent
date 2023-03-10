{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom  gutter-b example example-compact">
                <div class="card-header">
                    <div class="card-title">إضافة تصنيف جديد </div>
                </div>
                <form  method="POST" action="{{route('sub-category.store')}}" class="formAction">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>الإسم</label>
                            <input type="text" name="name"  class="form-control">
                        </div>
                        <div class="form-group">
                            <label>التصنيف الرئيسي</label>
                            <select  name="category_id"  class="form-control">

                                    <option value="{{$category->id}}" selected>{{$category->name}}</option>

                            </select>
                        </div>

                        <input type="hidden" value="3" name="type">





                        <button type="submit" class="btn btn-primary btn-save mr-2 w-100px p-4 ">حفظ</button>
                    </div>

                </form>
            </div>
        </div>

    </div>

    <div class="card card-custom">

        <div class="card-body">

            <!--begin::Search Form-->
            <!--end::Search Form-->

            <table class="table table-bordered table-hover" id="kt_datatable">
                <thead>
                <tr>
                    <th> #</th>
                    <th>الإسم</th>
                    <th>التصنيف الرئيسي </th>

                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sub_category as $categorey)
                <tr class="deleted-row-{{$categorey->id}}">
                    <td>{{$categorey->id}}</td>
                    <td>{{$categorey->name}}</td>
                    <td>{{$categorey->category->name}}</td>

                    <Td>


                        <a href="{{route('subcategoeryEdit',$categorey->id)}}" data-href="{{route('subcategoeryEdit',$categorey->id)}}" data-entity_id="{{$categorey->id}}"  class="btn  btn-sm btn-clean btn-icon" data-toggle="tooltip" title="تعديل">
                            {{ Metronic::getSVG("media/svg/icons/Communication/Write.svg", "svg-icon-md svg-icon-primary") }}

                        </a>
                        <a href="javascript:;" data-href="{{route('subcatDelete',$categorey->id)}}" data-entity_id="{{$categorey->id}}" data-token="{{csrf_token()}}" class="btn delete-btn btn-sm btn-clean btn-icon" data-toggle="tooltip" title="حدف">
                            {{ Metronic::getSVG("media/svg/icons/General/Trash.svg", "svg-icon-md svg-icon-primary") }}
                        </a>
                        <a href="{{route('childCategory_new',$categorey->id)}}" data-href="{{route('childCategory_new',$categorey->id)}}" data-entity_id="{{$categorey->id}}" data-token="{{csrf_token()}}" class="btn  btn-sm btn-clean btn-icon" data-toggle="tooltip" title="إنشاء تصنيف فرعي جديد">
                            {{ Metronic::getSVG("media/svg/icons/Navigation/Plus.svg", "svg-icon-md svg-icon-primary") }}
                        </a>
                    </Td>


                </tr>
                @endforeach
                </tbody>
            </table>

        </div>

    </div>

@endsection

{{-- Styles Section --}}
@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection


{{-- Scripts Section --}}
@section('scripts')
    {{-- vendors --}}
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>

    {{-- page scripts --}}
    <script src="{{ asset('js/pages/crud/datatables/basic/basic.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <script src="{{asset('/js/ajax.js')}}"></script>

@endsection
