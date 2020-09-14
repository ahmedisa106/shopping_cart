@extends('commonmodule::layouts.master')

@section('title')
    @lang('commonmodule::site.show_album')
@stop
@section('content-header')
    <section class="content-header">
        <h1> @lang('commonmodule::site.show_album')</h1>
    </section>
@stop

@section('content')
    <section class="content">

        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">

                        <h3 class="box-title">@lang('commonmodule::site.show_album')</h3>
                    </div>

                    <div class="box-body">

                        <table class="table table-bordered table-hover text-center">
                            <thead>
                            <tr>
                                <td>@lang('commonmodule::site.id')</td>
                                <td>@lang('commonmodule::site.photo')</td>
                                <td>@lang('commonmodule::site.operations')</td>
                            </tr>
                            </thead>
                            @foreach($product->photos as $index => $photo)

                                <tbody>

                                <tr>
                                    <td>{{$index+1}}</td>

                                    <td>
                                        <img style="max-width: 150px; max-height: 150px;" src="{{asset('/images/product_photos/'.$photo->photos)}}" alt="">
                                    </td>
                                    <td>
                                        <a class="button btn btn-danger" href="{{route('products.deletePhoto',$photo->id)}}">@lang('commonmodule::site.delete') <i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>


                                </tbody>
                            @endforeach


                        </table>


                    </div>
                    <hr>


                    <form action="{{route('products.addToAlbum')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <input type="hidden" value="{{$product->id}}" name="product_id">
                        <label class="control-label col-sm-2">@lang('commonmodule::site.album')</label>
                        <input type="file" name="album[]" multiple>
                        <div class="box-footer">
                            <button class="button btn btn-primary" type="submit">@lang('commonmodule::site.submit') <i class="fa fa-save"></i></button>
                        </div>

                    </form>


                </div>

            </div>

        </div>

    </section>
@stop

