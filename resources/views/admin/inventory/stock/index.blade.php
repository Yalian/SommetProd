@extends('admin.layouts.dashboard')

@section('page_heading','Facturas')

@section('section')

    <div class="container">
        <div class="col-md-offset-9 col-md-2">

        </div>

        <div style="height: 100px"></div>

        <div class="col-md-10 center-block">

            <table id="stock" class="table table-striped">
                <thead>
                <tr>
                    <th>Material</th>
                    <th>Cantidad</th>
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
            $('#stock').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('material.data') }}",
                columns: [
                    { data: 0  },
                    { data: 1, name: 'material' },
                    { data: 2, name: 'quantity'  },
                    { data: 3, name: 'actions' }
                ],
                language:{
                    url: '//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json'
                }
            });
        });
    </script>
@endpush