@extends('admin.layouts.dashboard')

@section('page_heading','Nueva Factura')

@section('section')

    <div class="col-md-11" style="position: relative; left: 50%; transform: translate(-50%,0%)">

        <form class="form-horizontal" id="orderForm" method="post">
            <meta name="_token" content="{{ csrf_token() }}"/>


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
                <div class="form-group col-md-3">
                    <label class="control-label">Imagen</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <input id="discountF" name="discount" hidden>
                <input id="subTotalF" name="subTotal" hidden>
                <input id="totalF" name="total" hidden>
            </div>

            <hr>


            <div class="row form-horizontal">

                <div class="form-group col-md-2">
                    <label>Materiales</label>
                    <select id="material" class="col-md-12">
                        @foreach($materials as $material)
                            <option value="{{$material->id}}">{{$material->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-10">

                    <div class="form-group col-md-2" align="center">
                        <label>Unidad</label>
                        <select id="unit" class="form-control">
                            <option value="Mts">Metros</option>
                            <option value="Kgs">Kilogramos</option>
                            <option value="Unidades">Unidades</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2" align="center">
                        <label>Cantidad</label>
                        <input class="form-control" id="quantity" placeholder="Cantidad">
                    </div>

                    <div class="form-group col-md-2" align="center">
                        <label>P.U.</label>
                        <input class="form-control" id="pu" placeholder="P.U.">
                    </div>

                    <div class="form-group col-md-2" align="center">
                        <label>P.U.D.</label>
                        <input class="form-control" id="PUD" placeholder="P.U.D" disabled>
                    </div>

                    <div class="form-group col-md-2" align="center">
                        <label>Sub-Total</label>
                        <input class="form-control" id="subTotal" placeholder="Sub-Total">
                    </div>

                    <div class="form-group col-md-2" align="center">
                        <label>Iva</label>
                        <input class="form-control" id="iva" placeholder="Iva" disabled>
                    </div>

                    <div class="form-group col-md-2" align="center">
                        <label>Total</label>
                        <input class="form-control" id="total" placeholder="Total" disabled>
                    </div>

                    <div class="col-sm-1">
                        <button type="button" id="addRow" class="btn btn-success" style="margin-top: 25px"><i
                                    class="fa fa-plus"></i></button>
                    </div>
                </div>
            </div>

            <hr>

            <table id="lines" class="table table-striped">
                <thead>
                <tr>
                    <th hidden width="0%">ID</th>
                    <th width="11%">Material</th>
                    <th width="11%">Unidad</th>
                    <th width="11%">Cantidad</th>
                    <th width="11%">P.U.</th>
                    <th width="10%">%</th>
                    <th width="11%">P.U.D.</th>
                    <th width="11%">Sub-Total</th>
                    <th width="11%">Iva</th>
                    <th width="11%">Total</th>
                </tr>
                </thead>
                <tbody>

                </tbody>

            </table>
            <hr>

            <div style="margin-top: 50px; margin-bottom: 20px" class="row col-md-offset-9">
                <a class="btn btn-danger" href="{{route('order.index')}}">Cancelar</a>
                <a class="btn btn-success" id="saveForm">Guardar</a>
            </div>
        </form>
    </div>
    @push('scripts')
        <script>
            $('#material').select2({});

            let $lines = [];


            let quantity = $('#quantity'); //Cantidad
            let pu = $('#pu'); //P.U.
            let pud = $('#PUD'); //P.U.D
            let subTotal = $('#subTotal'); //Sub-Total
            let iva = $('#iva');
            let total = $('#total');

            let discountF = 0.0;
            let subTotalF = 0.0;
            let totalF = 0.0;

            let $percentage;

            $('#date').val(new Date().toISOString().slice(0, 10));

            subTotal.change(function (e) {
                let $subTotal = subTotal.val();
                let $quantity = quantity.val();

                let $pud = ($subTotal / $quantity).toFixed(2);
                pud.val($pud);

                let $iva = ($subTotal * 0.12).toFixed(2);
                iva.val($iva);

                let $total = (($subTotal * 0.12) + ($subTotal * 1)).toFixed(2);
                total.val($total);

                $percentage = (((($pud / pu.val()) * 100) - 100) * -1).toFixed(2);
            });

            $('#addRow').on('click', function (e) {
                e.preventDefault();

                let unitName = $('#unit option:selected'); //Nombre Unidad
                let unit = $('#unit'); //Unidad
                let id = $('#material');  //ID
                let name = $('#material option:selected');



                if (!(pu.val() == '' || quantity.val() == '' || subTotal.val() == '')) {
                    let line = {};
                    line['id'] = id.val();
                    line['unit'] = unit.val();
                    line['quantity'] = quantity.val();
                    line['pu'] = pu.val();
                    line['percentage'] = $percentage;
                    line['pud'] = pud.val();
                    line['subTotal'] = subTotal.val();
                    line['iva'] = iva.val();
                    line['total'] = total.val();

                    discountF += (((pu.val() * quantity.val()) - ((subTotal.val() / quantity.val()) * quantity.val())).toFixed(2)) * 1;
                    subTotalF += (subTotal.val()) * 1;
                    totalF += (total.val()) *1;

                    console.log('Descuento: ' + discountF + ' sub-Total: ' + subTotalF + ' Total: ' + totalF);

                    $lines.push(line);

                    $('#lines > tbody:last-child').append(
                        '<tr>' +
                        '<td hidden>' + id.val() + '</td>' +
                        '<td>' + name.text() + '</td>' +
                        '<td>' + unitName.text() + '</td>' +
                        '<td>' + quantity.val() + '</td>' +
                        '<td>' + '$ ' + pu.val() + '</td>' +
                        '<td>' + $percentage + ' %' + '</td>' +
                        '<td>' + '$ ' + pud.val() + '</td>' +
                        '<td>' + '$ ' + subTotal.val() + '</td>' +
                        '<td>' + '$ ' + iva.val() + '</td>' +
                        '<td>' + '$ ' + total.val() + '</td>' +
                        '</tr>'
                    );

                    pu.val('');
                    quantity.val('');
                    subTotal.val('');

                    total.val('');
                    iva.val('');
                    pud.val('');
                }
            });

            $('#saveForm').on('click', function (e) {
                e.preventDefault();

                if ($('#lines > tbody tr').length > 0) {
                    $('#discountF').val(discountF);
                    $('#subTotalF').val(subTotalF);
                    $('#totalF').val(totalF);

                    let $lines2 = JSON.stringify($lines);
                    let $formData2 = new FormData($('form')[0]);
                    $formData2.append('lines', $lines2);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'POST',
                        url: "{{route('order.store')}}",
                        enctype: 'multipart/form-data',
                        processData: false,
                        contentType: false,
                        data: $formData2,
                        success: function (response) {
                            if (response.view){
                                window.location.replace("{{env('APP_URL').'/inventario/facturas'}}");
                            }
                        }
                    });
                } else {
                    bootbox.alert({
                        title: 'Error!',
                        message: 'No se han ingresado materiales!'
                    })
                }
            })
        </script>
    @endpush
@endsection


