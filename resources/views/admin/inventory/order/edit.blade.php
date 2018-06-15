@extends('admin.layouts.dashboard')

@section('page_heading','Facturas')

@section('section')
    <div class="modal-content">
        <form method="post">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Nueva Factura</h4>
            </div>

            @Csrf

            <div class="modal-body">
                <div class="input-group">
                    <label class="control-label" for="name"># Guia</label>
                    <input name="name" type="text" id="name" class="form-control">
                </div>

                <div class="input-group">
                    <label class="control-label" for="name">Fecha</label>
                    <input name="name" type="text" id="name" class="form-control">
                </div>

                <div class="input-group">
                    <label class="control-label" for="name">Precio Total</label>
                    <input name="name" type="text" id="name" class="form-control">
                </div>

                <div class="input-group">
                    <label class="control-label" for="name">Descuento</label>
                    <input name="name" type="text" id="name" class="form-control">
                </div>

                <div class="input-group">
                    <label class="control-label" for="colour">Precio Final</label>
                    <input name="colour" type="text" id="colour" class="form-control">
                </div>
            </div>

            <div class="modal-footer">
                <a class="btn btn-danger" href="{{route('order.index')}}">Cancelar</a>
                <button class="btn btn-success" type="submit">Guardar</button>
            </div>
        </form>
    </div>
@endsection
