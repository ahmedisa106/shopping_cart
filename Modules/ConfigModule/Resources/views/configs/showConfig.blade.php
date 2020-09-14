@extends('commonmodule::layouts.master')

@section('title')
  Settings -   {{$cat->title}}

@stop
@section('css')
    <style>
        .nav-tabs-custom {
            margin-bottom: 20px !important;
            background: #ecf0f5 !important;
            box-shadow: 0 1px 2px 2px rgba(0, 0, 0, 0.1) !important;
            border-radius: 3px !important;
        }

    </style>
@stop
@section('content-header')

    <section class="content-header">

        <h1>@lang('commonmodule::site.settings')</h1>
    </section>
@stop

@section('content')
    <section class="content">


        <div class="box box-info">

            <div class="box-header with-border">
                <h3>{{$cat->title}}</h3>

            </div>

            <form class="form form-horizontal" action="{{route('configs.update')}}" method="post">
                @csrf
                @method('put')
                <div class="box-body">

                    <div class="col-md-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">

                                @foreach($langs as $lang)
                                    <li @if($loop->first) class="active" @endif>
                                        <a href="#{{$lang->display_lang}}" data-toggle="tab">{{$lang->lang}}</a>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="tab-content">
                                @foreach($langs as $lang)
                                    <div class="tab-pane @if($loop->first) active  @endif" id="{{$lang->display_lang}}">

                                        @foreach($cat->configs as $config)
                                            @if($config->is_static == 0)
                                                @if($config->type == 1)

                                                    <div class="form-group">
                                                        <label for="" class="control-label col-sm-2">{{$config->translate($lang->display_lang)->display_name}} :</label>
                                                        <div class="col-sm-8">
                                                            <input class="form-control" type="text" value="{{$config->translate($lang->display_lang)->value}}" name="{{$lang->display_lang}}[{{$config->var}}]">
                                                        </div>
                                                    </div>
                                                @elseif($config->type == 2)
                                                    <div class="form-group">
                                                        <label for="" class="control-label col-sm-2">{{$config->translate($lang->display_lang)->display_name}} :</label>
                                                        <div class="col-sm-8">
                                                            <textarea class="form-control ckeditor" type="text" name="{{$lang->display_lang}}[{{$config->var}}]">{{$config->translate($lang->display_lang)->value}}</textarea>
                                                        </div>
                                                    </div>

                                                @endif


                                            @endif



                                        @endforeach


                                    </div>




                                @endforeach

                            </div>

                        </div>
                        @foreach($cat->configs as $config)

                            @if($config->is_static ==1)
                                @if($config->type ==1)
                                    <div class="form-group">
                                        <label for="" class="control-label col-sm-3">{{$config->translate($lang->display_lang)->display_name}} :</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" value="{{$config->static_value}}" name="{{$config->var}}">
                                        </div>

                                    </div>
                                @endif
                            @endif
                        @endforeach


                    </div>


                </div>

                <div class="box-footer">
                    <button class="button btn btn-primary pull-right">@lang('commonmodule::site.submit') <i class="fa fa-save"></i></button>
                </div>

            </form>


        </div>

    </section>
@stop
@section('javascript')
    @include('commonmodule::includes.swal')
@stop
