@extends('commonmodule::layouts.master')
@section('title')
    @lang('commonmodule::site.languages')
@stop
@section('css')
    <link rel="stylesheet"
          href="{{ asset('/assets/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

@stop
@section('content')
    <section class="content-header">
        <h1>
            @lang('commonmodule::site.languages')

        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> @lang('commonmodule::site.home')</a></li>
            <li class="active">@lang('commonmodule::site.languages')</li>
        </ol>
    </section>



    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('commonmodule::site.languages')</h3>
                        {{-- Add New --}}
                        <a href="{{route('languages.create')}}" type="button" class="btn btn-success pull-right"><i class="fa fa-plus"
                                                                                                                    aria-hidden="true"></i> &nbsp;
                            @lang('commonmodule::site.create_new') </a>
                    </div>
                    <!-- /.box-header -->


                    <div class="box-body">
                        <table id="lang" class="table table-bordered table-hover text-center ">
                            <thead>
                            <tr>

                                <th>@lang('commonmodule::site.id')</th>
                                <th>@lang('commonmodule::site.lang')</th>
                                <th>@lang('commonmodule::site.display_lang')</th>
                                <th>@lang('commonmodule::site.active')</th>
                                <th>@lang('commonmodule::site.operations')</th>


                            </tr>
                            </thead>
                            <tbody>

                            </tbody>


                        </table>

                        <div class="text-center">

                            {{$languages->links()}}
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>


    </section>




    @include('commonmodule::includes.swal')


@endsection

@section('javascript')
    <script src="{{asset('assets/admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>


    <script>


        $(document).ready(function () {


            $('#lang').DataTable({
                dom: 'lBfrtip',
                buttons: [
                    {extend: 'print', messageBottom: ' <strong>All Rights Reserved to IceCode .</strong>'},
                    {extend: 'excel'},
                ],
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ url('admin-panel/languages/ajax') }}",
                    "type": "GET"
                },
                "columns": [
                    {data: 'id', name: 'id'},
                    {data: 'lang', name: 'lang'},
                    {data: 'display_lang', name: 'display_lang'},
                    {data: 'active', name: 'active'},
                    {data: 'operations', name: 'operations', orderable: false, searchable: false},


                ]
            });

        });
    </script>
@endsection
