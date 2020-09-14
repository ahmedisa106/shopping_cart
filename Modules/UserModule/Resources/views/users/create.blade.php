@extends('commonmodule::layouts.master')

@section('title')
    @lang('commonmodule::site.clients') - @lang('commonmodule::site.create')
@stop

@section('content-header')
    <section class="content-header">
        <h1>@lang('commonmodule::site.clients')</h1>

    </section>
@stop
@section('content')
    <section class="content">

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('commonmodule::site.create')</h3>

            </div>

            <form class="form-horizontal" action="{{route('users.store')}}" method="POST">
                {{csrf_field()}}

                <div class="box-body">

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="name">@lang('commonmodule::site.name') :</label>
                        <div class="col-md-8">
                            <input type="text" name="name" class="form-control" placeholder="@lang('commonmodule::site.name')" required>
                            @error('name')
                            <span class="text-danger">
                                {{$message}}
                            </span>
                            @enderror


                        </div>

                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="name">@lang('commonmodule::site.email') :</label>
                        <div class="col-md-8">
                            <input type="email" name="email" class="form-control" placeholder="@lang('commonmodule::site.email')" required>
                            @error('email')
                            <span class="text-danger">
                                {{$message}}
                            </span>
                            @enderror

                        </div>

                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="name">@lang('commonmodule::site.address') :</label>
                        <div class="col-md-8">
                            <input type="text" name="address" class="form-control" placeholder="@lang('commonmodule::site.address')" required>
                            @error('address')
                            <span class="text-danger">
                                {{$message}}
                            </span>
                            @enderror

                        </div>

                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="name">@lang('commonmodule::site.phone') :</label>
                        <div class="col-md-8">
                            <input type="text" name="phone" class="form-control" placeholder="@lang('commonmodule::site.phone')">

                        </div>

                    </div>

                    <div class="form-group">
                        <label for="password" class="control-label col-sm-2">@lang('commonmodule::site.password') :</label>
                        <div class="col-md-8">
                            <input type="password" name="password" class="form-control" required>
                            @error('password')
                            <span class="text-danger">
                                {{$message}}
                            </span>
                            @enderror
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="control-label col-sm-2">@lang('commonmodule::site.password_confirmation') :</label>
                        <div class="col-md-8">
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                    </div>


                </div>

                <div class="box-footer">
                    <a href="{{route('users.index')}}" class="button btn btn-default">@lang('commonmodule::site.cancel') <i class="fa fa-close"></i></a>
                    <button class="button btn btn-primary pull-right">@lang('commonmodule::site.submit') <i class="fa fa-save"></i></button>

                </div>


            </form>

        </div>

    </section>
@stop

