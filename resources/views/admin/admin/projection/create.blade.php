@extends('admin.layouts.dashboard')

@section('page_heading','Nueva Proyeccion')

@section('section')

    <form method="post" id="createContractForm">
        @Csrf

        <div class="row">
            <div class="col-md-12">


                <div class="form-group col-md-4">
                    <label class="control-label col-md-3" for="name">De:</label>
                    <div class="col-md-7">
                        <input name="name" type="date" id="name" class="form-control date">
                    </div>
                </div>


                <div class="form-group col-md-4">
                    <label class="control-label col-md-3" for="address">Hasta:</label>
                    <div class="col-md-7">
                        <input name="address" type="date" id="address" class="form-control date">
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label class="control-label col-md-3" for="contract">Contrato</label>
                    <div class="col-md-7">
                        <select id="contract" class="col-md-9 form-control">
                            @foreach($contracts as $contract)
                                <option value="{{$contract->id}}">{{$contract->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


            </div>
        </div>

        <div class="col-md-10" style="position: relative; left: 45%; transform: translate(-50%,0%)">
            <div class="row">
                <h3>Prendas</h3>
            </div>

            <div class="row form-horizontal">


                <div class="col-md-12">
                    <div class="row">
                        <h4>Tallas</h4>
                    </div>

                    <div class="col-md-6">
                        <div class="col-md-6 form-group">
                            <div class="form-group">
                                <label class="control-label" for="material">Productos</label>
                                <select id="product" class="col-md-12 form-control">
                                </select>
                            </div>

                            <div class="form-group" align="center">
                                <label class="control-label col-md-3" for="talla2">2</label>
                                <div class="col-md-8">
                                    <input class="form-control" id="talla2">
                                </div>
                            </div>

                            <div class="form-group" align="center">
                                <label class="control-label col-md-3" for="talla4">4</label>
                                <div class="col-md-8">
                                    <input class="form-control" id="talla4">
                                </div>
                            </div>

                            <div class="form-group" align="center">
                                <label class="control-label col-md-3" for="talla6">6</label>
                                <div class="col-md-8">
                                    <input class="form-control" id="talla6">
                                </div>
                            </div>

                            <div class="form-group" align="center">
                                <label class="control-label col-md-3" for="talla8">8</label>
                                <div class="col-md-8">
                                    <input class="form-control" id="talla8">
                                </div>
                            </div>

                            <div class="form-group" align="center">
                                <label class="control-label col-md-3" for="talla10">10</label>
                                <div class="col-md-8">
                                    <input class="form-control" id="talla10">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6" style="margin-left: 10px; margin-top: 30px">

                            <div class="form-group" align="center">
                                <label class="control-label col-md-3" for="talla12">12</label>
                                <div class="col-md-8">
                                    <input class="form-control" id="talla12">
                                </div>
                            </div>

                            <div class="form-group" align="center">
                                <label class="control-label col-md-3" for="talla14">14</label>
                                <div class="col-md-8">
                                    <input class="form-control" id="talla14">
                                </div>
                            </div>

                            <div class="form-group" align="center">
                                <label class="control-label col-md-3" for="tallaS">S</label>
                                <div class="col-md-8">
                                    <input class="form-control" id="tallaS">
                                </div>
                            </div>

                            <div class="form-group" align="center">
                                <label class="control-label col-md-3" for="tallaM">M</label>
                                <div class="col-md-8">
                                    <input class="form-control" id="tallaM">
                                </div>
                            </div>

                            <div class="form-group" align="center">
                                <label class="control-label col-md-3" for="tallaL">L</label>
                                <div class="col-md-8">
                                    <input class="form-control" id="tallaL">
                                </div>
                            </div>

                            <div class="form-group" align="center">
                                <label class="control-label col-md-3" for="tallaXL">XL</label>
                                <div class="col-md-8">
                                    <input class="form-control" id="tallaXL">
                                </div>
                            </div>

                            <div>
                                <button type="button" id="addRow" class="btn btn-success pull-right"
                                        style="margin-top: 25px"><i
                                            class="fa fa-plus"></i> Agregar
                                </button>
                            </div>


                        </div>


                    </div>


                    <div class="col-md-6">

                        <table class="table table-hover table-striped table-responsive" width="100%">
                            <tbody>

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

            {{--<button class="btn btn-danger" id="close" data-dismiss="modal">Cancelar</button>--}}
            {{--<a class="btn btn-success" id="save">Guardar</a>--}}
        </div>


    </form>
@endsection
@push('scripts')
    <script>
        $(function () {

            let $products = [];

            $('#product').select2({
                ajax: {
                    dataType: 'json',
                    url: '{{ route('productos.list') }}',
                    delay: 400,
                    data: function (params) {
                        return {
                            term: $('#contract').val()
                        }
                    },
                    processResults: function (data, page) {
                        return {
                            results: data
                        };
                    },
                }
            });

            $('#addRow').on('click', function (e) {
                e.preventDefault();

                let product = $('#product'); //ID
                let productName = $('#product option:selected').text(); //ID

                let talla2 = $('#talla2');
                let talla4 = $('#talla4');
                let talla6 = $('#talla6');
                let talla8 = $('#talla8');
                let talla10 = $('#talla10');
                let talla12 = $('#talla12');
                let talla14 = $('#talla14');
                let tallaS = $('#tallaS');
                let tallaM = $('#tallaM');
                let tallaL = $('#tallaL');
                let tallaXL = $('#tallaXL');

                $('.table tbody').append(
                    '<tr>' +
                    '<td colspan="11" style="text-align:center">' + productName + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>2</td>' +
                    '<td>4</td>' +
                    '<td>6</td>' +
                    '<td>8</td>' +
                    '<td>10</td>' +
                    '<td>12</td>' +
                    '<td>14</td>' +
                    '<td>S</td>' +
                    '<td>M</td>' +
                    '<td>L</td>' +
                    '<td>XL</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>' + talla2.val() + '</td>' +
                    '<td>' + talla4.val() + '</td>' +
                    '<td>' + talla6.val() + '</td>' +
                    '<td>' + talla8.val() + '</td>' +
                    '<td>' + talla10.val() + '</td>' +
                    '<td>' + talla12.val() + '</td>' +
                    '<td>' + talla14.val() + '</td>' +
                    '<td>' + tallaS.val() + '</td>' +
                    '<td>' + tallaM.val() + '</td>' +
                    '<td>' + tallaL.val() + '</td>' +
                    '<td>' + tallaXL.val() + '</td>' +
                    '</tr>'
                );
            })
        })
    </script>
@endpush



