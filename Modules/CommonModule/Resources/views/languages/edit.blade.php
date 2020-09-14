@extends('commonmodule::layouts.master')

@section('title')

    @lang('commonmodule::site.edit')->{{$lang->lang}}
@stop
@section('content')
    <section class="content-header">
        <h1>
            @lang('commonmodule::site.languages')
            <small>@lang('commonmodule::site.edit') -> {{$lang->lang}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> @lang('commonmodule::site.home')</a></li>
            <li><a href="{{route('languages.index')}}">@lang('commonmodule::site.languages')</a></li>
            <li class="active">@lang('commonmodule::site.edit')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('commonmodule::site.edit')</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{{route('languages.update',$lang->id)}}"  method="post">
                @csrf
                @method('put')
                <div class="box-body">
                    <div class="form-group">
                        <label for="lang" class="col-sm-2 control-label">@lang('commonmodule::site.lang')</label>

                        <div class="col-sm-6">
                            <input type="text" name="lang" value="{{$lang->lang}}" class="form-control" id="inputEmail3" required placeholder="Lang">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDisplay_lang" class="col-sm-2 control-label">@lang('commonmodule::site.display_lang')</label>

                        <div class="col-sm-6">
                            <input type="text" name="display_lang" value="{{$lang->display_lang}}" class="form-control" id="inputDisplau_lang" required placeholder="@lang('commonmodule::site.display_lang')">
                        </div>
                    </div>


                    <div class="form-group ">
                        <label for="inputDisplay_lang" class="col-sm-2 control-label">@lang('commonmodule::site.active')</label>
                        <div class="col-sm-6">
                            <select  class="col-md-4" name="active" id="" required>

                                <option value="1" {{$lang->active =='1' ?'selected':''}}>@lang('commonmodule::site.active')</option>
                                <option value="0" {{$lang->active =='0' ?'selected':''}}>@lang('commonmodule::site.unactive')</option>

                            </select>
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer ">
                    <a href="{{route('languages.index')}}" type="submit" onclick="return confirm('@lang('commonmodule::site.are_you_sure')') " class="btn btn-default">@lang('commonmodule::site.cancel')</a>
                    <button type="submit" class="btn btn-info pull-right">@lang('commonmodule::site.update')</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>

    </section>
@stop
