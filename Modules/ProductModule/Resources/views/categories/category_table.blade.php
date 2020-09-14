<table class="table table-hover table-bordered" id="ProductModuleIndex">
    <thead>
    <tr>
        <td>@lang('commonmodule::site.id')</td>
        <td>@lang('commonmodule::site.title')</td>
        <td>@lang('commonmodule::site.photo')</td>
        <td>@lang('commonmodule::site.parent_category')</td>
        <td>@lang('commonmodule::site.status')</td>
        <td>@lang('commonmodule::site.operations')</td>
    </tr>
    </thead>
    <tbody>
    @foreach($categs as $cat)
        <tr>
            <td>{{$cat->id}}</td>
            <td>{{$cat->title}}</td>
            <td>
                @if($cat->photo)
                    <img src="{{asset('/images/categories/'.$cat->photo)}}" class="img-thumbnail" style="max-width: 150px; min-width: 150px; min-height: 100px; max-height: 100px;" alt="">
                @else
                    <img src="{{asset('/images/default.png')}}" class="img-thumbnail" style="max-width: 150px; max-height: 100px;" alt="">
                @endif
            </td>
            <td>{{$cat->parent_id == null ? 'parent Category' : $cat->parent->title }}</td>
            <td>
                @if($cat->status ==0)
                    <span class="btn btn-warning">@lang('commonmodule::site.unactivate')</span>
                    <a href="{{route('cat.active',$cat->id)}}" class="btn btn-reddit"><i class="fa fa-repeat"></i></a>
                @else
                    <span class="btn btn-success">@lang('commonmodule::site.activate')</span>
                    <a href="{{route('cat.unactive',$cat->id)}}" class="btn btn-reddit"> <i class="fa fa-repeat"></i></a>
                @endif
            </td>
            <td>

                <a href="{{route('categories.edit',$cat->id)}}" class="button btn btn-primary">@lang('commonmodule::site.edit') <i class="fa fa-edit"></i></a>
                <a href="{{route('cat.delete',$cat->id)}} " onclick="return confirm('are you sure !!')" class="button btn btn-danger">@lang('commonmodule::site.delete') <i class="fa fa-trash"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
