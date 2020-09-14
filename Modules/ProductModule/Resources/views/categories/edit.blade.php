@extends('commonmodule::layouts.master')
@section('title')
    @lang('commonmodule::site.edit')
@endsection
@section('css')
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{asset('assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

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
        <h1>@lang('commonmodule::site.edit')</h1>

    </section>


@endsection
@section('content')
    <section class="content">


        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('commonmodule::site.edit')</h3>

            </div>

            <form class="form-horizontal" action="{{route('categories.update',$cat->id)}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                @method('put')

                <div class="box-body">
                    <div class="col-md-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                @foreach($langs as $lang)
                                    <li @if ($loop->first) class="active" @endif>
                                        <a href="#{{$lang->display_lang}}" data-toggle="tab">{{$lang->lang}}</a>
                                    </li>
                                @endforeach

                            </ul>
                            <div class="tab-content">


                                @foreach($langs as $lang)
                                    <div class="tab-pane @if($loop->first) active @endif" id="{{$lang->display_lang}}">

                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="title">@lang('commonmodule::site.title')({{$lang->display_lang}}) :</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="{{$lang->display_lang}}[title]" class="form-control" value="{{$cat->translate($lang->display_lang)->title}}">


                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="slug">@lang('commonmodule::site.slug') ({{$lang->display_lang}}) :</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="{{$lang->display_lang}}[slug]" class="form-control" value="{{$cat->translate($lang->display_lang)->slug}}">


                                            </div>
                                        </div>

                                        <div class="form-group">
                                            {{-- Description --}}
                                            <label class="control-label col-sm-2" or="title"> @lang('commonmodule::site.description')({{$lang->display_lang}}):</label>
                                            <div class="col-sm-8">
                                                <textarea class="textarea" name="{{$lang->display_lang}}[description]" placeholder="@lang('commonmodule::site.description')"
                                                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$cat->translate($lang->display_lang)->description}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                            </div>

                        </div>

                    </div>
                    <div class="form-group">

                        <label class="control-label col-sm-2" for="title">@lang('commonmodule::site.parent_category')
                            :</label>
                        <div class="col-sm-8">

                            <select class="form-control" name="parent_id">
                                <option value="0"> Parent Category</option>
                                @foreach($categories as $categ)
                                    @if($categ->id != $cat->id)
                                        <option
                                            @if($cat->parent_id != null)
                                            @if($categ->id == $cat->parent->id) selected @endif
                                            @endif

                                            value="{{$categ->id}}">{{$categ->title}}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group">

                        <label class="control-label col-sm-2" for="status">@lang('commonmodule::site.status') : </label>
                        <div class="col-sm-8">

                            <select class="form-control" name="status">
                                <option value="0" @if($cat->status==0) selected @endif>@lang('commonmodule::site.unactive')</option>
                                <option value="1" @if($cat->status==1) selected @endif>@lang('commonmodule::site.active')</option>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        {{-- Upload photo --}}
                        <label class="control-label col-sm-2" for="img">@lang('commonmodule::site.photo')</label>
                        <div class="col-sm-8">
                            <input type="file" autocomplete="off" class="" name="photo">
                            @if ($cat->photo)
                                <img src="{{asset('/images/categories/' . $cat->photo)}}" style="margin-top: 5px;" height="70" width="100">
                            @else
                                <br>
                                "<strong>No Photo</strong>"
                            @endif

                        </div>


                    </div>


                </div>
                <div class="box-footer">
                    <a href="{{url('/admin-panel/categories')}}" type="button" class="btn btn-default">@lang('commonmodule::site.cancel') &nbsp; <i class="fa fa-remove" aria-hidden="true"></i> </a>
                    <button type="submit" class="btn btn-primary pull-right">@lang('commonmodule::site.submit') &nbsp; <i class="fa fa-save"></i></button>
                </div>


            </form>

        </div>


    </section>
@endsection
@section('javascript')
    <script src="{{asset('assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
    <script>
        $(function () {
            //bootstrap WYSIHTML5 - text editor
            $('.textarea').wysihtml5({
                toolbar: {
                    "font-styles": true,
                    "emphasis": true,
                    "lists": true,
                    "html": true,
                    "link": true,
                    "image": false
                }
            });
        });

    </script>

@endsection

