
    <form method="post" id="editContractForm">
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
                <input name="name" type="text" id="name" class="form-control" value="{{$contract->name}}">
            </div>
        </div>

        <div class="modal-body">
            <div class="input-group">
                <label class="control-label" for="address">Direccion</label>
                <input name="address" type="text" id="address" class="form-control" value="{{$contract->address}}">
            </div>
        </div>

        <div class="modal-footer">
            <button class="btn btn-danger" id="close" data-dismiss="modal">Cancelar</button>
            <a class="btn btn-success" id="save">Guardar</a>
        </div>
    </form>
<script>
    $(function () {
        $('#save').on('click', function (e) {
            e.preventDefault();
            $.ajax({
                method: 'post',
                url: "{{route('contratos.update',['id'=> $contract->id])}}",
                data: $('#editContractForm').serialize(),
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
                    $('#close').click();
                }
            })
        })
    })
</script>