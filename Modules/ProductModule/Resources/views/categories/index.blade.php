@extends('commonmodule::layouts.master')
@section('title')
    @lang('commonmodule::site.categories')
@stop
@section('css')
    <link rel="stylesheet"
          href="{{ asset('/assets/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <style>
        .cat {
            width: fit-content;
            display: flex;
            margin: auto;
        }

        .parent {
            margin-left: 25px;
        }
    </style>
@stop
@section('content-header')
    <section class="content-header">
        <h1> @lang('commonmodule::site.categories')</h1>
    </section>
@stop
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('commonmodule::site.categories')</h3><a href="{{route('categories.create')}}" class="button btn btn-success pull-right"> <i
                                class="fa fa-plus"></i> @lang('commonmodule::site.create')</a>
                        <div class="cat">
                            <div class="parent">
                                <input type="radio" class="parent_id" name="parent_id" value="all" checked>
                                <label for="">@lang('commonmodule::site.all')</label>
                            </div>
                            <div class="parent">
                                <input type="radio" class="parent_id" name="parent_id" value="parent">
                                <label for="">@lang('commonmodule::site.parent_categories')</label>
                            </div>
                            <div class="parent">
                                <input type="radio" class="parent_id" name="parent_id" value="sub">
                                <label for="">@lang('commonmodule::site.sub_category')</label>
                            </div>
                        </div>
                    </div>
                    <div class="box-body" id="filter">
                        @include('productmodule::categories.category_table')
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@section('javascript')

    @include('commonmodule::includes.swal')
    <script src="{{asset('assets/admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

    <script>

        $(document).ready(function () {
            $('#ProductModuleIndex').DataTable({
                'paging': true,
                'lengthChange': true,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': false,
                "scrollX": true,


            });
            $('.parent_id').on('click', function (e) {
                type = $(this).val();
                $('#filter').html('<h3 class="text-center">@lang('commonmodule::site.loading')</h3>');
                $.ajax({
                    'type': 'get',
                    'url': '{{url('admin-panel/categories/filter')}}',
                    data: {
                        '_token': '{{csrf_token()}}',
                        'type': type,
                    },
                    'statusCode': {
                        200: function (response) {
                            $('#filter').html(response);
                            $('#ProductModuleIndex').DataTable({
                                'paging': true,
                                'lengthChange': true,
                                'searching': true,
                                'ordering': true,
                                'info': true,
                                'autoWidth': false,
                                "scrollX": true,
                            });
                        }
                    }


                });


            });


        })

    </script>

@stop
