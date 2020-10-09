@extends('commonmodule::layouts.master')

@section('css')
    <link rel="stylesheet"
          href="{{ asset('/assets/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@stop

@section('title')
@stop

@section('content-header')
    <section class="content-header">
        <h1>Categories</h1>

    </section>

@section('content')
    <section class="content">
        <div class="row">

            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">categories</h3>
                        <a href="{{route('servicesCategories.create')}}" class=" button btn btn-success pull-right"><i class="fa fa-plus"></i> Create New </a>
                    </div>

                    <div class="box-body">
                        <table class="table table-hover table-bordered text-center" id="categories">
                            <thead>
                            <tr>
                                <td>@lang('commonmodule::site.id')</td>
                                <td>@lang('commonmodule::site.title')</td>
                                <td>@lang('commonmodule::site.description')</td>
                                <td>@lang('commonmodule::site.photo')</td>
                                <td>@lang('commonmodule::site.status')</td>
                                <td>@lang('commonmodule::site.operations')</td>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>


                    </div>

                </div>

            </div>
        </div>

    </section>
@endsection
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


            $('#categories').DataTable({
                dom: 'lBfrtip',
                buttons: [
                    {extend: 'print', messageBottom: ' <strong>All Rights Reserved to IceCode .</strong>'},
                    {extend: 'excel'},
                ],
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('cats.dataTable') }}",
                    "type": "GET",

                },
                "columns": [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'description', name: 'description'},
                    {data: 'photo', name: 'photo'},
                    {data: 'status', name: 'status'},
                    {data: 'operations', name: 'operations', orderable: false, searchable: false},


                ]
            });


        });

        $(document).on('click', '#active_tag', function (e) {
            e.preventDefault();
            tr = $(this).closest('tr');
            id = tr.find('#cat_id').val();
            active_num = tr.find('#active').val();

            icon = tr.find('#icon');

            icon.removeClass('fa fa-check');
            icon.removeClass('fa fa-close');

            $(this).removeClass('btn-success');
            $(this).removeClass('btn-danger');
            $(this).html('@lang('commonmodule::site.loading')');
            icon.addClass('fa fa-spinner');
            $(this).addClass('btn-default');


            $.ajax({
                'type': 'POST',
                'url': '{{route('cat.changeActive')}}',
                data: {
                    '_token': '{{csrf_token()}}',
                    'id': id,
                    'active_num': active_num,

                },
                'statusCode': {
                    200: function (response) {


                        $('#categories').DataTable().ajax.reload();
                    },
                    404: function (response) {
                    },
                }
            });

        })

    </script>
@endsection
