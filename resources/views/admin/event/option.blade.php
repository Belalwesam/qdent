<style>
    .checkbox.checkbox-success > input:checked ~ span {
        background-color: #1BC5BD !important;
        margin: -9px;
    }</style>
@foreach($attrbiutes as $item )

    <div class="form-group row">
        <label class="col-3 col-form-label">{{$item->name}}</label>
    </div>
    <div class="form-group row">

    <div class="col-9 col-form-label">
                @foreach($item->attributes as $attr)

                    @if($attr->type == "value")
                <div class="form-group" bis_skin_checked="1">
                    <label>{{$attr->name}}</label>
                    <div class="input-group" bis_skin_checked="1">
                        <div class="input-group-prepend" bis_skin_checked="1">
																<span class="input-group-text">
																	<label class="checkbox checkbox-inline ">
																		<input type="checkbox" checked="checked" name="attr[{{$item->id}}][{{$attr->id}}]">
																		<span></span>
																	</label>
																</span>
                            <span class="input-group-text">العدد</span>
                        </div>
                        <input type="text" name="attr[{{$item->id}}][{{$attr->id}}]value" class="form-control" aria-label="Text input with checkbox">
                    </div>
                </div>
                    @else


                <div class="form-group row" bis_skin_checked="1">
                    <label class="col-3 col-form-label">{{$attr->name}}</label>
                    <div class="col-9 col-form-label" bis_skin_checked="1">
                        <div class="checkbox-inline" bis_skin_checked="1">
                            <label class="checkbox ">
                                <input type="checkbox" name="attr[{{$item->id}}][{{$attr->id}}]">
                                <span></span>{{$attr->name}}</label>

                        </div>

                    </div>
                </div>
            @endif
                @endforeach
            </div>
        </div>
    </div>

@endforeach
