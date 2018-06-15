@extends('admin.layouts.dashboard')

@section('page_heading','Facturas')

@section('section')

    <div class="container">
        <div class="col-md-offset-9 col-md-2">
                <a href="{{route('order.create')}}"  class="btn btn-success"><span class="fa fa-plus"></span></a>

        </div>

        <div style="height: 100px"></div>

        <div class="col-md-10 center-block">

            <table id="order" class="table table-striped">
                <thead>
                <tr>
                    <th># Guia</th>
                    <th>Fecha</th>
                    <th>Precio Total</th>
                    <th>Descuento</th>
                    <th>Precio Final</th>
                    <th>Acciones</th>
                </tr>
                </thead>
            </table>

        </div>
    </div>
@stop

@push('scripts')
    <script>
        $(function() {
            $('#order').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('material.data') }}",
                columns: [
                    { data: 0  },
                    { data: 1, name: 'number_guide' },
                    { data: 2, name: 'date'  },
                    { data: 3, name: 'total_price' },
                    { data: 4, name: 'discount'},
                    { data: 5, name: 'final_price' }
                ],
                language:{
                    url: '//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json'
                }
            });
        });
    </script>
@endpush