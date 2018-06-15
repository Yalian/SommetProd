@extends('admin.layouts.dashboard')

@section('page_heading','Nueva Factura')

@section('section')

    <div class="col-md-11" style="position: relative; left: 50%; transform: translate(-50%,0%)">

        <form class="form-horizontal" method="post">
            @Csrf


            <div class="row">
                <div class="form-group col-md-6">

                    <label class="control-label col-sm-3" for="guide"># Guia</label>
                    <div class="col-sm-7">
                        <input name="guide" type="text" id="guide" class="form-control">
                    </div>
                </div>


                <div class="form-group col-md-6">
                    <label class="control-label col-sm-3" for="date">Fecha</label>

                    <div class="col-sm-7 input-group date" id="datepicker">
                        <input type='date' name="date" id="date" class="form-control"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>

                </div>
            </div>

            <div class="row">

                <div class="form-group col-md-4">
                    <label class="control-label col-sm-5" for="totalPrice">Precio Total</label>

                    <div class="col-sm-7 input-group">
                        <span class="input-group-addon">
                            <span class="fa fa-dollar"></span>
                        </span>
                        <input name="totalPrice" type="text" id="subPrice" class="form-control">
                    </div>

                </div>

                <div class="form-group col-md-4">
                    <label class="control-label col-sm-5" for="discount">Descuento</label>

                    <div class="col-sm-7 input-group">
                        <span class="input-group-addon">
                            <span class="fa fa-dollar"></span>
                        </span>
                        <input name="discount" type="text" id="discount" class="form-control">
                    </div>

                </div>

                <div class="form-group col-md-4">
                    <label class="control-label col-sm-5" for="finalPrice">Precio Final</label>

                    <div class="col-sm-7 input-group">
                        <span class="input-group-addon">
                            <span class="fa fa-dollar"></span>
                        </span>
                        <input name="finalPrice" type="text" id="finalPrice" class="form-control">
                    </div>
                </div>
            </div>

            <hr>


            <div class="row form-horizontal">

                <div class="col-md-3">
                    <select id="material" class="col-md-12">
                        @foreach($materials as $material)
                            <option value="{{$material->id}}">{{$material->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <input class="form-control" id="unitPrice" placeholder="Precio Unitario">
                </div>

                <div class="col-md-2">
                    <input class="form-control" id="quantity" placeholder="Cantidad">
                </div>

                <div class="col-md-2">
                    <input class="form-control" id="totalAmount" placeholder="Kg / Mts">
                </div>

                <div class="col-md-2">
                    <input class="form-control" id="totalPrice" placeholder="Precio Total">
                </div>

                <div class="col-sm-1">
                    <button type="button" id="addRow" class="btn btn-success"><i class="fa fa-plus"></i></button>
                </div>

            </div>

            <hr>

            <table id="lines" class="table table-striped">
                <thead>
                <tr>
                    <th hidden>ID</th>
                    <th>Material</th>
                    <th>Precio Unitario</th>
                    <th>Cantidad</th>
                    <th>Total Kg/mts</th>
                    <th>Precio Total</th>
                </tr>
                </thead>
                <tbody>

                </tbody>

            </table>

            <div style="margin-top: 50px" class="row col-md-offset-9">
                <a class="btn btn-danger" href="{{route('order.index')}}">Cancelar</a>
                <button class="btn btn-success" type="button" id="save">Guardar</button>
            </div>
        </form>
    </div>
    @push('scripts')
        <script>
            $('#material').select2({});
            let lines = [];

            $('#addRow').on('click', function (e) {
                e.preventDefault();

                let id = $('#material');
                let name = $('#material option:selected');
                let unitPrice = $('#unitPrice');
                let quantity = $('#quantity');
                let totalAmount = $('#totalAmount');
                let totalPrice = $('#totalPrice');

                if (unitPrice.val() == '' || quantity.val() == '' || totalAmount.val() == '' || totalPrice.val() == ''){

                } else {
                    let line = {
                        id: id,
                        unitPrice: unitPrice,
                        quantity: quantity,
                        totalAmount: totalAmount,
                        totalPrice: totalPrice
                    };

                    lines.push(line);

                    $('#lines > tbody:last-child').append(
                        '<tr>' +
                        '<td hidden>' + id.val() + '</td>' +
                        '<td>' + name.text() + '</td>' +
                        '<td>' + unitPrice.val() + '</td>' +
                        '<td>' + quantity.val() + '</td>' +
                        '<td>' + totalAmount.val() + '</td>' +
                        '<td>' + totalPrice.val() + '</td>' +
                        '</tr>'
                    );

                    unitPrice.val('');
                    quantity.val('');
                    totalAmount.val('');
                    totalPrice.val('');

                    console.log(lines);

                }
            });

            $('#save').on('click', function (e) {
                e.preventDefault();

                if ($('#lines > tbody tr').length > 0){

                    $.ajax({

                    })




                }else{
                    bootbox.alert({
                        title: 'Error!',
                        message: 'No se han ingresado materiales!'
                    })
                }


            })


        </script>
    @endpush
@endsection


