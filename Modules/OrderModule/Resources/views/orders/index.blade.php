@extends('commonmodule::layouts.master')
@section('title','orders')
@section('css')
    <link rel="stylesheet"
          href="{{ asset('/assets/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@stop
@section('content-header')

    <section class="content-header">

        <h1>Orders</h1>
    </section>
@stop

@section('content')

    <section class="content">
        <div class="box box-info">

            <div class="box-header">

                <h3 class="box-title">Orders</h3>
            </div>

            <div class="box-body">
                <table class="table table-bordered table-hover" id="ordersTable">
                    <thead>
                    <tr>

                        <td>id</td>
                        <td>client</td>
                        <td>address</td>
                        <td>phone</td>
                        <td>$ total</td>
                        <td>operations</td>
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

        $('document').ready(function () {

            $('#ordersTable').DataTable({

                dom: 'lBfrtip',
                buttons: [
                    {extend: 'print', messageBottom: ' <strong>All Rights Reserved to IceCode .</strong>'},
                    {extend: 'excel'},
                ],
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{route('orders.dataTable')}}",
                    "type": "GET",

                },

                "columns": [
                    {data: 'id', name: 'id'},
                    {data: 'client', name: 'client'},
                    {data: 'address', name: 'address'},
                    {data: 'phone', name: 'phone'},
                    {data: 'total', name: 'total'},
                    {data: 'operations', name: 'operations', orderable: false, searchable: false},


                ]


            });

        })

    </script>

@stop
