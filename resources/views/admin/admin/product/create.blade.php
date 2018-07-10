@extends('admin.layouts.dashboard')

@section('page_heading','Nuevo Producto')

@section('section')

    <form method="post" id="createContractForm">
        @Csrf

        <div class="col-md-12">
            <div class="col-md-6">

                <div class="form-group row">
                    <label class="control-label col-md-3" for="name">Nombre</label>
                    <div class="col-md-7">
                        <input name="name" type="text" id="name" class="form-control date">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-md-3" for="contracts">Contrato</label>
                    <div class="col-md-7">
                        <select name="contract" id="contracts" class="form-control">
                            @foreach($contracts as $contract)
                                <option value="{{$contract->id}}">{{$contract->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <hr>

                <div>
                    <h3>Agregar Materiales</h3>
                    <br>

                    <div class="form-group row">
                        <label class="control-label col-md-3" style="text-align: center"
                               for="materials">Material</label>
                        <div class="col-md-7">
                            <select id="materials" class="form-control">
                                @foreach($materials as $material)
                                    <option value="{{$material->id}}">{{$material->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <a class="btn btn-primary" id="addRow"><span class="fa fa-plus"></span></a>
                        </div>

                    </div>

                </div>
            </div>


            <div class="col-md-6">
                <table class="table table-hover table-hover table-responsive">
                    <thead>
                    <tr>
                        <td class="control-label" align="center"><h4>Nombre</h4></td>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>

        </div>

        <div class="row pull-right" style="margin-top: 50px; margin-right: 50px">
            <a class="btn btn-danger" href="{{route('productos.index')}}">Cancelar</a>
            <a class="btn btn-success" id="save">Guardar</a>
        </div>
    </form>
@endsection
@push('scripts')
    <script>
        $(function () {
            let $materials = [];

            $('#addRow').on('click', function (e) {
                e.preventDefault();
                let matID = $('#materials');
                let matName = $('#materials option:selected');

                let $material = {};
                $material['id'] = matID.val() * 1;
                $materials.push($material);

                $('.table > tbody:last-child').append(
                    '<tr>' +
                    '<td class="control-label" align="center"><h5>' + matName.text() + '</h5></td>'
                )
            });

            $('#save').on('click', function (e) {
                e.preventDefault();

                let $lines = JSON.stringify($materials);
                let $formData2 = new FormData($('form')[0]);
                $formData2.append('materials', $lines);

                if ($('.table > tbody tr').length > 0) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });

                    $.ajax({
                        method: 'post',
                        url: "{{route('productos.store')}}",
                        enctype: 'multipart/form-data',
                        processData: false,
                        contentType: false,
                        data: $formData2,
                        success: function (response) {
                            if (response.message) {
                                switch (response.message.type) {
                                    case 'success':
                                        toastr.success(response.message.text);
                                        break;
                                    case 'error':
                                        toastr.error(response.message.text, 'Error!');
                                        break;
                                }
                            }
                        }
                    })
                } else {
                    bootbox.alert({
                        title: 'Error!',
                        message: 'No se han ingresado materiales!'
                    })
                }
            })

        })


    </script>
@endpush




