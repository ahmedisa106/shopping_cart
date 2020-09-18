@extends('commonmodule::layouts.master')

@section('title')
    {{--    <link rel="stylesheet" href="{{asset('assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">--}}

    @lang('commonmodule::site.create')

@stop
<link rel="stylesheet" href="{{asset('assets/admin/plugins/treeview/treeview.css')}}">
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
        <h1>@lang('commonmodule::site.products')</h1>
    </section>

@stop
@section('content')
    <div class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('commonmodule::site.create')</h3>
            </div>

            @if($errors->any())
                <div class="alert alert-danger text-center">
                    @foreach($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                </div>
            @endif

            <form class="form-horizontal" action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
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
                                    <div class="tab-pane @if  ($loop->first) active  @endif" id="{{$lang->display_lang}}">
                                        <div class="form-group">

                                            <label for="title" class="control-label col-sm-2">@lang('commonmodule::site.title') ({{$lang->lang}}) :</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="{{$lang->display_lang}}[title]" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="slug" class="control-label col-sm-2">@lang('commonmodule::site.slug') ({{$lang->lang}}) :</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="{{$lang->display_lang}}[slug]" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="description" class="control-label col-sm-2">@lang('commonmodule::site.desc') ({{$lang->lang}}) :</label>
                                            <div class="col-sm-8">
                                                <textarea class="ckeditor" name="{{$lang->display_lang}}[description]"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="photo" class="control-label col-sm-2">@lang('commonmodule::site.photo') :</label>
                            <div class="col-sm-4">
                                <input type="file" name="photo">
                            </div>
                            <label for="photo" class="control-label col-sm-2">@lang('commonmodule::site.album') :</label>
                            <div class="col-sm-4">
                                <input type="file" multiple name="photos[]">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">@lang('commonmodule::site.sell_price') :</label>
                            <div class="col-sm-3">
                                <input class="form-control" type="number" name="sell_price" min="0" value="0" required>

                            </div>
                            <label class="control-label col-sm-2">@lang('commonmodule::site.price_before_discount') :</label>
                            <div class="col-sm-3">
                                <input class="form-control" type="number" name="price_before_discount" min="0" value="0" required>

                            </div>
                        </div>

                        <div class="form-group">

                            <label for="" class="control-label col-sm-2">@lang('commonmodule::site.quantity') :</label>
                            <div class="col-sm-3">
                                <input type="number" value="0" min="0" name="current_quantity" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">@lang('commonmodule::site.choose_category') : </label>
                            <div class="col-sm-4">

                                <ul data-role="treeview-metro">
                                    @foreach($categories as $cat)
                                        <li>
                                            <input type="checkbox" data-role="checkbox" value="{{ $cat->id}}" name="product_cats[]" data-caption="{{ $cat->title  }}" title=""><br>
                                            @if(count($cat->child)>0)
                                                <ul>
                                                    @foreach($cat->child as $child)
                                                        <li>
                                                            <input type="checkbox" data-role="checkbox" value="{{ $child->id}}" name="product_cats[]" required data-caption="{{ $child->title  }}" title="">
                                                            @if($child->child->count() > 0)

                                                                <ul>
                                                                    @foreach($child->child as $pr)
                                                                        <li>
                                                                            <input type="checkbox" data-role="checkbox" value="{{ $pr->id}}" name="product_cats[]" required data-caption="{{ $pr->title  }}" title="">

                                                                        </li>
                                                                    @endforeach

                                                                </ul>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-sm-5">
                                <label for="status" class="label-control col-sm-3"> @lang('commonmodule::site.status'):</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="active">
                                        <option value="1">@lang('commonmodule::site.active')</option>
                                        <option value="0">@lang('commonmodule::site.unactivate')</option>

                                    </select>

                                </div>
                            </div>

                            <br><br>
                            <div class="col-sm-5">
                                <label for="status" class="label-control col-sm-3"> @lang('commonmodule::site.type'):</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="type">
                                        <option value="0">@lang('commonmodule::site.default_pro')</option>
                                        <option value="1">@lang('commonmodule::site.featured')</option>
                                        <option value="2">@lang('commonmodule::site.best_rated')</option>
                                        <option value="3">@lang('commonmodule::site.deal_of_week')</option>

                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="box-footer">
                    <a href="{{url('/admin-panel/products')}}" type="button" class="btn btn-default">@lang('commonmodule::site.cancel') &nbsp; <i class="fa fa-remove" aria-hidden="true"></i> </a>

                    <button type="submit" class="btn btn-primary pull-right">@lang('commonmodule::site.submit') <i class="fa fa-save"></i></button>
                </div>
                <!-- /.box-footer -->

            </form>


        </div>
    </div>
@stop

@section('javascript')
    <script src="{{asset('assets/admin/plugins/treeview/metro.js')}}"></script>


@stop

