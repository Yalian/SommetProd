@extends('admin.layouts.dashboard')

@section('page_heading','Ver Factura')

@section('section')

    <form>

        {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span--}}
        {{--aria-hidden="true">&times;</span>--}}
        {{--</button>--}}
        {{--<h4 class="modal-title" id="myModalLabel">Factura</h4>--}}


        @Csrf


        <div class="row form-inline col-md-11 pull-left"
             style="position: relative; left: 50%; transform: translate(-50%,0%)">
            <div class="input-group col-md-6">
                <label class="control-label" for="name"># Guia</label>
                <input name="name" type="text" id="name" class="form-control" disabled
                       value="{{$order->guide}}">
            </div>

            <div class="input-group col-md-5">
                <label class="control-label" for="name">Fecha</label>
                <input name="name" type="text" id="name" class="form-control" disabled value="{{$order->date}}">
            </div>

        </div>

        <div class="row form-inline row col-md-11"
             style="position: relative; left: 50%; transform: translate(-50%,0%)">
            <div class="input-group col-md-4 center-block">
                <label class="control-label" for="name">Sub Total</label>
                <input name="name" type="text" id="name" class="form-control" disabled
                       value="$ {{$order->sub_total}}">
            </div>

            <div class="input-group col-md-3 center-block">
                <label class="control-label" for="name">Iva</label>
                <input name="name" type="text" id="name" class="form-control" disabled
                       value="$ {{number_format($order->sub_total * 0.12,2)}}">
            </div>

            <div class="input-group col-md-4 center-block">
                <label class="control-label" for="colour">Total</label>
                <input name="colour" type="text" id="colour" class="form-control" disabled
                       value="$ {{$order->total}}">
            </div>
        </div>

        <div class="col-md-11" style="margin-left: 20px; margin-top: 30px; margin-bottom: 20px">
            <a class="btn btn-success" href="{{url('images/original/'.$order->img_name)}}">Ver Foto</a>
        </div>


        <div class="col-md-11">
            <table class="table table-striped" style="margin-left: 20px">
                <thead>
                <tr>
                    <th style="text-align: center">Material</th>
                    <th style="text-align: center">Unidad</th>
                    <th style="text-align: center">Cantidad</th>
                    <th style="text-align: center">P.U.</th>
                    <th style="text-align: center">%</th>
                    <th style="text-align: center">P.U.D.</th>
                    <th style="text-align: center">Sub-Total</th>
                    <th style="text-align: center">Iva</th>
                    <th style="text-align: center">Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order->lines as $line)
                    <tr>
                        <td align="center">{{$line->material->name}}</td>
                        <td align="center">{{$line->unit}}</td>
                        <td align="center">{{$line->quantity}}</td>
                        <td align="center">$ {{$line->unit_price}}</td>
                        <td align="center">{{$line->percentage}} %</td>
                        <td align="center">$ {{$line->unit_price_discount}}</td>
                        <td align="center">$ {{$line->sub_total}}</td>
                        <td align="center">$ {{$line->iva}}</td>
                        <td align="center">$ {{$line->total}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>



        <div class="col-md-11">
            <a class="btn btn-danger pull-right" href="{{route('order.index')}}">Volver</a>
        </div>

    </form>

@endsection
