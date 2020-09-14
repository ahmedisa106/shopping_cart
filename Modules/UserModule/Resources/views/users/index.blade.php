@extends('commonmodule::layouts.master')

@section('title')
    @lang('commonmodule::site.clients')
@stop
@section('css')
    <link rel="stylesheet"
          href="{{ asset('/assets/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

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
                <h3 class="box-title">@lang('commonmodule::site.clients')</h3>
                <a class="pull-right button btn btn-success" href="{{route('users.create')}}">@lang('commonmodule::site.create') <i class=" fa fa-plus"></i></a>

            </div>

            <div class="box-body">
                <table class="table table-bordered table-hover" id="usersTable">
                    <thead>

                    <tr>

                        <td>@lang('commonmodule::site.id')</td>
                        <td>@lang('commonmodule::site.name')</td>
                        <td>@lang('commonmodule::site.email')</td>
                        <td>@lang('commonmodule::site.phone')</td>
                        <td>@lang('commonmodule::site.address')</td>
                        <td>@lang('commonmodule::site.operations')</td>
                    </tr>


                    </thead>
                    <tbody>

                    </tbody>

                </table>


            </div>
        </div>


    </section>
@stop

@section('javascript')

    @include('commonmodule::includes.swal')

    <script src="{{asset('assets/admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script>


        $(document).ready(function () {


            $('#usersTable').DataTable({
                dom: 'lBfrtip',
                buttons: [
                    {extend: 'print', messageBottom: ' <strong>All Rights Reserved to IceCode .</strong>'},
                    {extend: 'excel'},
                ],
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ url('admin-panel/users/ajax') }}",
                    "type": "GET",

                },
                "columns": [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    {data: 'address', name: 'address'},
                    {data: 'operations', name: 'operations', orderable: false, searchable: false},


                ]
            });

        });
    </script>

@stop
