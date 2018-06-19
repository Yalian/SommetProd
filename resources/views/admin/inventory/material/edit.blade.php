@extends('admin.layouts.dashboard')

@section('page_heading','Materiales')

@section('section')


            <div class="modal-content">
                <form method="post" action="{{route('material.update',['id'=> $material->id])}}">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Editar Material</h4>
                    </div>

                    @Csrf
                    @method('PUT')

                    <div class="modal-body">
                        <div class="input-group">
                            <label class="control-label" for="name">Nombre</label>
                            <input name="name" type="text" id="name" class="form-control" value="{{$material->name}}">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <a class="btn btn-danger" href="{{route('material.index')}}">Cancelar</a>
                        <button class="btn btn-success" type="submit">Guardar</button>
                    </div>
                </form>
            </div>

@endsection
