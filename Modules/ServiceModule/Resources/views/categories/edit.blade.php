@extends('commonmodule::layouts.master')

@section('title')
    @lang('commonmodule::site.edit')
@endsection

@section('css')


    <style>
        .nav-tabs-custom {
            margin-bottom: 20px !important;
            background: #ecf0f5 !important;
            box-shadow: 0 1px 2px 2px rgba(0, 0, 0, 0.1) !important;
            border-radius: 3px !important;
        }

    </style>
@endsection




@section('content-header')
    <section class="content-header">
        <h1>
            @lang('commonmodule::site.edit')
        </h1>
    </section>
@endsection

@section('content')

    <section class="content">
        <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"> @lang('commonmodule::site.create')</h3>
            </div>
            <!-- /.box-header -->
            <form class="form-horizontal" action="{{route('servicesCategories.update',$cat->id)}}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="box-body">

                    <div class="col-md-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                @foreach($langs as $lang)
                                    <li @if($loop->first) class="active" @endif >
                                        <a href="#{{ $lang->display_lang }}" data-toggle="tab">{{ $lang->lang }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content">
                                @foreach($langs as $lang)
                                    <div class="tab-pane @if($loop->first) active @endif" id="{{ $lang->display_lang }}">

                                        <div class="form-group">
                                            {{-- Title --}}
                                            <label class="control-label col-sm-2" for="title"> @lang('commonmodule::site.title')({{ $lang->lang}}) :</label>
                                            <div class="col-sm-8">
                                                <input value="{{$cat->translate($lang->display_lang)['title']}}" type="text" autocomplete="off" class="form-control" placeholder=" @lang('commonmodule::site.title')" required name="{{$lang->display_lang}}[title]"
                                                >
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            {{-- Description --}}
                                            <label class="control-label col-sm-2" for="title"> @lang('commonmodule::site.description') ({{$lang->lang}}) :</label>
                                            <div class="col-sm-8">
                                                <textarea class="ckeditor" name="{{$lang->display_lang}}[description]" placeholder="@lang('commonmodule::site.description')">{{$cat->translate($lang->display_lang)['description']}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>


                    <div class="form-group">
                        {{--Status--}}
                        <label class="control-label col-sm-2" for="status">@lang('commonmodule::site.status') : </label>
                        <div class="col-sm-8">

                            <select class="form-control" name="status">
                                <option value="0" {{$cat->status == 0 ?'selected':''}} >@lang('commonmodule::site.unactive')</option>
                                <option value="1" {{$cat->status == 1 ?'selected':''}}>@lang('commonmodule::site.active')</option>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        {{-- Upload photo --}}
                        <label class="control-label col-sm-2" for="img">@lang('commonmodule::site.photo')</label>
                        <div class="col-sm-8">
                            <input type="file" autocomplete="off" class="" name="photo">
                        </div>

                        <img style="max-height: 250px; max-width: 250px;" src="{{asset('/images/serviceCategories/'.$cat->photo)}}" alt="">

                    </div>


                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{url('/admin-panel/categories')}}" type="button" class="btn btn-default">@lang('commonmodule::site.cancel') &nbsp; <i class="fa fa-remove" aria-hidden="true"></i> </a>
                    <button type="submit" class="btn btn-primary pull-right">@lang('commonmodule::site.submit') &nbsp;<i class="fa fa-save"></i></button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </section>
@endsection

@section('javascript')

    <!-- jQuery form validator -->
    <script src="{{asset('assets/admin/plugins/jquery_form_validator/jquery.form-validator.min.js')}}"></script>
    <script>
        $.validate();
    </script>


@endsection
