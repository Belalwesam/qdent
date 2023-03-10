<div class="table-responsive">
    <table class="table table-bordered table-hover" id="kt_datatable">
        <thead>
        <tr>
            <th> #</th>
            <th>Name</th>
            <th>الإسم</th>
            <th>الهاتف </th>
            <th>الحالة </th>

            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr class="deleted-row-{{$user->id}}">
                <td>{{$user->id}}</td>
                <td class="pl-0 py-4">
                    <div class="symbol symbol-50 symbol-light mr-1">
                                <span class="symbol-label">
                                    <img src="{{$user->imgs ?? "https://alshshamil.com/assets/arab.png"}}" class="h-50 align-self-center"/>
                                </span>
                    </div>
                </td>
                <td>{{$user->name}}

                </td>
                <td> {{$user->email}}</td>

                <td>
                    <span class="label label-lg label-light-{{$user->span()}} label-inline">{{$user->status}}</span>

                </td>
                <Td>


                    <a href="{{route('users.UserEdit',$user->id)}}" data-href="{{route('users.UserEdit',$user->id)}}" data-entity_id="{{$user->id}}"  class="btn  btn-sm btn-clean btn-icon" data-toggle="tooltip" title="تعديل">
                        {{ Metronic::getSVG("media/svg/icons/Communication/Write.svg", "svg-icon-md svg-icon-primary") }}

                    </a>
                    <a href="javascript:;" data-href="{{route('users.UserDelete',$user->id)}}" data-entity_id="{{$user->id}}" data-token="{{csrf_token()}}" class="btn delete-btn btn-sm btn-clean btn-icon" data-toggle="tooltip" title="حدف">
                        {{ Metronic::getSVG("media/svg/icons/General/Trash.svg", "svg-icon-md svg-icon-primary") }}
                    </a>
                    <a href="{{route('users.userOrder',$user)}}" class="btn  btn-sm btn-clean btn-icon" data-toggle="tooltip" title="طلبات العميل">
                        {{ Metronic::getSVG("media/svg/icons/Text/Bullet-list.svg", "svg-icon-md svg-icon-primary") }}
                    </a>

{{--                  --}}


                </Td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$users->links()}}
</div>
