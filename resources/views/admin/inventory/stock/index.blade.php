@extends('admin.layouts.dashboard')

@section('page_heading','Bodega')

@section('section')

    <div class="container">
        <div class="col-md-offset-9 col-md-2">

        </div>

        <div class="col-md-10 center-block" style="margin-top: 100px">

            <table id="stock" class="table table-striped">
                <thead>
                <tr>
                    <th>Material</th>
                    <th>Metros</th>
                    <th>Kilogramos</th>
                    <th>Unidades</th>
                </tr>
                </thead>
            </table>

        </div>
    </div>
@stop

@push('scripts')
    <script>
        $(function() {
            $('#stock').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('stock.data') }}",
                columns: [
                    { data: 'name', width:'40%' },
                    { data: 'qtyMts', width:'20%' },
                    { data: 'qtyKgs', width:'20%' },
                    { data: 'qtyUnits', width:'20%' }
                ],
                language:{
                    url: '//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json'
                }
            });
        });
    </script>
@endpush