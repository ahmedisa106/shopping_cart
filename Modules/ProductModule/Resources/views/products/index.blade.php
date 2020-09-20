@extends('commonmodule::layouts.master')

@section('title')
    @lang('commonmodule::site.products')
@stop
@section('css')
    <link rel="stylesheet"
          href="{{ asset('/assets/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

@stop
@section('content-header')
    <section class="content-header">
        <h1>@lang('commonmodule::site.products')</h1>
    </section>
@stop

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title pull-right"><a class="button btn btn-success" href="{{route('products.create')}}">@lang('commonmodule::site.create') <i class="fa fa-plus"></i></a></h3>
                    </div>

                    <form method="get" role="form" action="{{route('products.actived')}}">
                        {{csrf_field()}}
                        <div class="box-body">

                            <div class="form-group col-md-2"></div>
                            <div class="form-group col-md-4">

                                <label for="">حال المنتج</label>
                                <select class="select2 form-control" name="status" id="">
                                    <option value="-1" {{$status==-1 ?'selected':''}}>الكل</option>
                                    <option value="1" {{$status ==1 ?'selected' :''}}>active</option>
                                    <option value="0" {{$status ==0 ?'selected' :''}}>unActive</option>

                                </select>


                            </div>
                            <div class="form-group col-md-3" style="top:24px">
                                <button type="submit" class="btn btn-primary" style="float: right">بحث</button>
                            </div>

                        </div>
                    </form>


                    <hr>

                    <div class="box-body">
                        <table class="table table-hover table-bordered text-center" id="productsTable">
                            <thead>
                            <tr>
                                <td>@lang('commonmodule::site.id')</td>
                                <td>@lang('commonmodule::site.title')</td>
                                <td>@lang('commonmodule::site.photo')</td>
                                <td>@lang('commonmodule::site.sell_price')</td>
                                <td>@lang('commonmodule::site.categories')</td>
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


            $('#productsTable').DataTable({
                dom: 'lBfrtip',
                buttons: [
                    {extend: 'print', messageBottom: ' <strong>All Rights Reserved to IceCode .</strong>'},
                    {extend: 'excel'},
                ],
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ url('admin-panel/products/ajax') }}",
                    "type": "GET",
                    "data": {
                        'status':{{$status}}
                    }
                },
                "columns": [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'photo', name: 'photo'},
                    {data: 'sell_price', name: 'sell_price'},
                    {data: 'categories', name: 'categories'},
                    {data: 'active', name: 'active'},
                    {data: 'operations', name: 'operations', orderable: false, searchable: false},


                ]
            });


        });

    </script>
    <script>
        $(document).on('click', '#updateActive', function (e) {

            e.preventDefault();
            icon = $(this).find('#icon');
            icon.removeClass('fa-check');
            icon.removeClass('fa-close');
            icon.html(' @lang('commonmodule::site.loading')');
            icon.addClass('fa-spinner');

            tr = $(this).closest('tr');

            id = tr.find('#product_id').val()
            active = tr.find('#active').val()
            $.ajax({

                'type': 'POST',
                'url': '{{route('product.updateActive')}}',
                data: {
                    '_token': '{{csrf_token()}}',
                    'id': id,
                    'active': active,
                },
                'statusCode': {
                    200: function (response) {


                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            onOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: '@lang('commonmodule::site.data_updated_successfully')'
                        });

                        $('#productsTable').DataTable().ajax.reload();


                    },
                    422: function (response) {
                        swal("خطأ", "حدث خطأ ما، أعد ادخال البيانات الصحيحة", "error", {button: "Ok",});
                    }
                },
            });

        });
    </script>



@stop
