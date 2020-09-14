@extends('commonmodule::layouts.master')

@section('title')

    @lang('commonmodule::site.create')
    @stop
@section('content')
    <section class="content-header">
        <h1>
            @lang('commonmodule::site.languages')
            <small>@lang('commonmodule::site.create')</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> @lang('commonmodule::site.home')</a></li>
            <li><a href="{{route('languages.index')}}">@lang('commonmodule::site.languages')</a></li>
            <li class="active">@lang('commonmodule::site.create')</li>
        </ol>
    </section>
   <section class="content">
       <div class="box box-info">
           <div class="box-header with-border">
               <h3 class="box-title">@lang('commonmodule::site.create')</h3>
           </div>
           <!-- /.box-header -->
           <!-- form start -->
           <form class="form-horizontal" action="{{route('languages.store')}}"  method="post">
               @csrf
               @method('post')
               <div class="box-body">
                   <div class="form-group">
                       <label for="lang" class="col-sm-2 control-label">@lang('commonmodule::site.lang')</label>

                       <div class="col-sm-6">
                           <input type="text" name="lang" class="form-control" id="inputEmail3" required placeholder="@lang('commonmodule::site.lang')">
                       </div>
                   </div>
                   <div class="form-group">
                       <label for="inputDisplay_lang" class="col-sm-2 control-label">@lang('commonmodule::site.display_lang')</label>

                       <div class="col-sm-6">
                           <input type="text" name="display_lang" class="form-control" id="inputDisplau_lang" required placeholder="@lang('commonmodule::site.display_lang')">
                       </div>
                   </div>


                   <div class="form-group ">
                       <label for="inputDisplay_lang" class="col-sm-2 control-label">@lang('commonmodule::site.active')</label>
                       <div class="col-sm-6">
                       <select  class="col-md-4" name="active" id="" required>

                           <option value="1">@lang('commonmodule::site.active')</option>
                           <option value="0">@lang('commonmodule::site.unactive')</option>

                       </select>
                       </div>
                   </div>

               </div>
               <!-- /.box-body -->
               <div class="box-footer ">
                   <a href="{{route('languages.index')}}" type="submit" onclick="return confirm('@lang('commonmodule::site.are_you_sure')')" class="btn btn-default">@lang('commonmodule::site.cancel')</a>
                   <button type="submit" class="btn btn-info pull-right">@lang('commonmodule::site.create')</button>
               </div>
               <!-- /.box-footer -->
           </form>
       </div>

   </section>
@stop
