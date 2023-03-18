<div class="table-responsive" id="table_data">
    <table class="table table-bordered table-hover" id="kt_datatable">
        <thead>
        <tr>
            <th> Id</th>
            <th>{{__("إسم المنتج")}}</th>
            <th>{{__(" التصنيف")}}</th>
            <th>{{__("المخزن    ")}}</th>

            <th>{{__("تفاصيل")}}</th>
            <th>{{__("تاريخ الإنشاء")}}</th>
            <th>{{__("الحالة")}} </th>

            <th>خيارات</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr class="deleted-row-{{$product->id}}">
                <td>{{$product->id}}</td>
                <td>
                    {{$product->name}}
                </td>
                <td >
                    {{$product->category->name ?? null}}
                </td>
                <td >
                    {{$product->stock }}
                </td>
                <td>{{$product->description}}</td>
                <td> {{$product->created_at}}</td>

                <td>
                    <span class="label label-lg label-light-{{$product->span()}} label-inline" style="color:black;">{{$product->status()}}</span>

                </td>

                <Td>
                    <a href="{{route('product.edits',$product->id)}}" data-href="{{route('product.edits',$product->id)}}" data-entity_id="{{$product->id}}"  class="btn  btn-sm btn-clean btn-icon" data-toggle="tooltip" title="تعديل">
                        {{ Metronic::getSVG("media/svg/icons/Communication/Write.svg", "svg-icon-md svg-icon-primary") }}

                    </a>
                        <a href="{{route('front.product',$product->id)}}" data-href="{{route('front.product',$product->id)}}" target="_blank" data-entity_id="{{$product->id}}"class="btn  btn-sm btn-clean btn-icon" data-toggle="tooltip" title="عرض">

                        {{ Metronic::getSVG("media/svg/icons/General/Expand-arrows.svg", "svg-icon-md svg-icon-primary") }}

                    </a>
                    <a href="javascript:;" data-href="{{route('product.delete',$product->id)}}" data-entity_id="{{$product->id}}" data-token="{{csrf_token()}}" class="btn delete-btn btn-sm btn-clean btn-icon" data-toggle="tooltip" title="حدف">
                        {{ Metronic::getSVG("media/svg/icons/General/Trash.svg", "svg-icon-md svg-icon-primary") }}
                    </a>


                </Td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{$products->links()}}
</div>
