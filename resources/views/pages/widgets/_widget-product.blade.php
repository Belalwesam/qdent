{{-- List Widget 9 --}}



<div class="card card-custom card-stretch gutter-b">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start fw-bold flex-column">
            <span class="card-label" style="color: #464545e3; font-size:15px; !important">Last Product</span>
            <span class="text-muted mt-3 font-weight-bold font-size-sm">count in store {{\App\Model\Product::all()->count()}}  </span>
        </h3>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body pt-8">
        <!--begin::Item-->
        @foreach(\App\Model\Product::take(5)->get() as $product)
            <div class="d-flex align-items-center mb-10">
                <div class="symbol symbol-50 symbol-light mr-5">
                    <div class="symbol-label">
                        <img src="{{$product->images->first() ? asset('qdent/storage/app/'.$product->images->first()->src) : null }}" class="h-50 align-self-center" alt=""/>
                    </div>
                </div>
                <div class="d-flex flex-column flex-grow-1 mr-2">
                    <a href="#" class="font-weight-bolder text-dark-75 text-hover-primary font-size-lg mb-1">{{$product->name}}</a>
                    <span class="text-muted font-weight-bold">{{$product->price}}</span>
                </div>
                <span class="label label-light-success label-lg label-inline font-weight-bold">{{$product->category->name}}</span>
            </div>
    @endforeach
    <!--end::Item-->
    </div>
    <!--end::Body-->
</div>
