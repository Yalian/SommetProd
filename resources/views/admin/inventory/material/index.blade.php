@extends('admin.layouts.dashboard')

@section('page_heading','Materiales')

@section('section')

    <div class="container">
        <div class="col-md-offset-9 col-md-2">
                <a id="new_material"  class="btn btn-success" href="#"><span class="fa fa-plus"></span></a>

        </div>

        <div style="height: 100px"></div>

        <div class="col-md-10 center-block">

            <table id="material" class="table table-striped">
                <thead>
                <tr>
                    <th>Nombre</th>
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
            $('#material').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('material.data') }}",
                columns: [
                    { data:'name', className:'center', width: '90%'  },
                    { data:'action', className:'center', width: '10%%'}

                ],
                language:{
                    url: '//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json'
                }
            });

            $('#new_material').on('click', function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'GET',
                    url: "{{ route('material.create') }}",
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