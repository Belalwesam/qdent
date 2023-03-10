@extends('layout.default')
@section('styles')
    <style>
        .ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-editor__editable_inline.ck-blurred {
            text-align: right;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom  gutter-b example example-compact">
                <div class="card-header">
                    <div class="card-title">إضافة كوبون خصم جديد </div>
                </div>
                <form  method="POST" action="{{route('coupon.store')}}" class="formAction">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>كود الخصم  مثل : (Funny2020)</label>
                            <input type="text" name="code"  class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea" >العقار التابع لهذا الكود</label>
                            <select class="form-control"   name="ads_id">
                                <option value="none">
                                    يرجى تحديد العقار الذي تريد تطبيق هذا الكود عليه
                                </option>
                                @foreach($ads as $ad)
                                    <option value="{{$ad->id}}" > {{$ad->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea" > نوع الخصم (مبلغ ثابت - نسبة مئوية من قيمة حجز العقار)</label>
                            <select class="form-control" id="type"    name="type">
                                <option value="none">
                                    يرجى تحديد نوع الخصم
                                </option>
                                <option value="amount">مبلغ ثابت</option>
                                <option value="percent">  نسبة مئوية من قيمة حجز العقار</option>
                            </select>
                        </div>

                        <div class="form-group" id="amount" style="display: none">
                            <label for="exampleTextarea" >قيمة الخصم </label>

                            <input type="number" name="amount"  class="form-control">

                        </div>
                        <div class="form-group" id="percent" style="display: none">
                            <label for="exampleTextarea" >النسبة المئوية للخصم </label>

                            <input type="number" name="percent"  class="form-control" placeholder="%">

                        </div>

                        <div class="form-group">
                            <label for="exampleTextarea" >تاريخ الإنتهاء  </label>

                            <input type="date" name="expire_date"  class="form-control">

                        </div>







                        <button type="submit" class="btn btn-primary btn-save mr-2 w-100px p-4 ">حفظ</button>
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
    <script src="{{asset('/js/ajax.js')}}"></script>
<script>


        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $("#imgInp").change(function() {
        readURL(this);
    });
</script>

    <script>

        $('#percent').hide();
        $('#amount').hide();

        $('#type').change(function(){
            if($('#type').val() == 'amount') {
                $('#percent').hide();
                $('#amount').show();
            }else {
                $('#percent').show();
                $('#amount').hide();
            }

        });
    </script>
@endsection

