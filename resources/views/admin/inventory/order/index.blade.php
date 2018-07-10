@extends('admin.layouts.dashboard')

@section('page_heading','Facturas')

@section('section')

    <div class="container">
        <div class="col-md-offset-9 col-md-2">
                <a href="{{route('order.create')}}"  class="btn btn-success"><span class="fa fa-plus"></span></a>

        </div>

        <div style="height: 100px"></div>

        <div class="col-md-10 center-block">

            <table id="order" class="table table-striped">
                <thead>
                <tr>
                    <th># Guia</th>
                    <th>Fecha</th>
                    <th>Sub-Total</th>
                    <th>Descuento</th>
                    <th>Total</th>
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
            $('#order').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('order.data') }}",
                columns: [
                    { data: 'guide', width:'20%' },
                    { data: 'date', width:'15%' },
                    { data: 'total', width:'15%'  },
                    { data: 'discount', width:'15%' },
                    { data: 'final', width:'15%'},
                    { data: 'action', width:'10%' }
                ],
                language:{
                    url: '//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json'
                }
            });
        });
    </script>
    @if($message)
        <script>
            switch ("{{$message['messageType']}}"){
                case 'success':
                    toastr.success("{{$message['text']}}");
                    break;
                case 'error':
                    toastr.error("{{$message['text']}}",'Error!');
                    break;
            }
        </script>
   @endif
@endpush