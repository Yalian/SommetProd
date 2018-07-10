@extends('admin.layouts.dashboard')

@section('page_heading','Contrato')

@section('section')

    <div class="container">
        <div class="col-md-offset-9 col-md-2">
            <a id="new_contract" class="btn btn-success" href="#"><span class="fa fa-plus"></span></a>

        </div>

        <div style="height: 100px"></div>

        <div class="col-md-10 center-block">

            <table id="contracts" class="table table-striped">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Direccion</th>
                    <th>Acciones</th>
                </tr>
                </thead>
            </table>

        </div>
    </div>
@stop

@push('scripts')
    <script>
        $(function () {
            let $contract = $('#contracts');
            let $table = $contract.DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('contratos.data') }}",
                columns: [
                    {data: 'name', className: 'center', width: '25%'},
                    {data: 'address', className: 'center', width: '70%'},
                    {data: 'action', className: 'center', width: '5%%'}

                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json'
                }
            });

            $contract.on('click', 'tbody tr a', function (e) {
                let $button = $(this);
                $.ajax({
                    type: 'GET',
                    url: $button.data('href'),
                    success: function (data) {
                        bootbox.dialog({
                            message: data,
                            closeButton: false
                        });
                    }
                })

            });


            $('#new_contract').on('click', function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'GET',
                    url: "{{ route('contratos.create') }}",
                    success: function (data) {
                        bootbox.dialog({
                            message: data,
                            closeButton: false
                        });
                    }
                })
            })
        });
    </script>
@endpush