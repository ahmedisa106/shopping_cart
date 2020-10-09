@extends('commonmodule::layouts.master')
@section('css')
    <link rel="stylesheet"
          href="{{ asset('/assets/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@stop
@section('title')
    services
@stop
@section('content-header')
    <section class="content-header">
        <h1>services</h1>

    </section>
@stop

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-xs-12 ">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">services</h3>
                        <a href="{{route('services.create')}}" class="pull-right button btn btn-success"><i class=" fa fa-plus"></i> create new </a>

                    </div>

                    <div class="box-body">
                        <table id="services" class="table table-hover table-bordered">

                            <thead>
                            <tr>
                                <td>id</td>
                                <td>title</td>
                                <td>description</td>
                                <td>photo</td>
                                <td>cover</td>
                                <td>status</td>
                                <td>operations</td>

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
        $('document').ready(function () {
            $('#services').DataTable({
                dom: 'lBfrtip',
                buttons: [
                    {extend: 'print', messageBottom: ' <strong>All Rights Reserved to IceCode .</strong>'},
                    {extend: 'excel'},
                ],
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "processing": true,
                "serverSide": true,
                "ajax": {
                    'url': '{{route('services.dataTable')}}',
                    'type': 'get',


                },
                "columns": [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'description', name: 'description'},
                    {data: 'photo', name: 'photo'},
                    {data: 'cover', name: 'cover'},
                    {data: 'status', name: 'status'},
                    {data: 'operations', name: 'operations', orderable: false, searchable: false},

                ],

            });

        })

        $(document).on('click', '#status', function () {

            var tr = $(this).closest('tr');
            id = tr.find('#service_id').val();
            active_number = tr.find('#active').val();
            $(this).removeClass('btn-success').removeClass('btn-danger').addClass('btn-default').html('loading...');
            $('#icon').removeClass('fa fa-close').removeClass('fa fa-check').addClass('fa fa-spinner');


            $.ajax({
                'type': 'POST',
                'url': '{{route('services.changeActive')}}',
                data: {
                    '_token': '{{csrf_token()}}',
                    'id': id,
                    'active_number': active_number,

                },
                'statusCode': {
                    200: function (response) {


                        $('#services').DataTable().ajax.reload();

                    },
                    404: function (response) {
                    },
                }
            });

        })

    </script>

@stop
