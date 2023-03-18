<div class="card card-custom {{ @$class }}">
    {{-- Header --}}
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">{{$page_title}}
                    <div class="text-muted pt-2 font-size-sm">{{$page_description}}</div>
                </h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Dropdown-->
                <!--end::Dropdown-->
                <!--begin::Button-->
                <!--end::Button-->
            </div>
        </div>

        <div class="card-body">

            <!--begin::Search Form-->
            <!--end::Search Form-->

            <table class="table table-bordered table-hover" id="datatable">
                <thead>
                <tr>
                    <th> #</th>
                    <th>{{__("Status")}}</th>
                    <th>{{__(" User Name")}}</th>
                    <th>{{__("Product")}}</th>
                    <th>{{__("Quantity ")}}</th>
                    <th>{{__("total ")}}</th>
                    <th>{{__("Delivery Location")}} </th>
                    <th>{{__("  Ordered Data")}}</th>
                    <th>Actions</th>
                </tr>
                </thead>

            </table>

        </div>
    </div>
    {{-- vendors --}}


</div>
