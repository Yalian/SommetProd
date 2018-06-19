<form method="post"  id="createMaterialForm">
    @Csrf
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Nuevo Material</h4>
    </div>

    <div class="modal-body">

        <div class="form-group row">
            <label class="control-label col-md-3" for="name">Nombre</label>
            <div class="col-md-7">
                <input name="name" type="text" id="name" class="form-control">
            </div>

        </div>

    </div>

    <div class="modal-footer">
        <button class="btn btn-danger" id="close" data-dismiss="modal">Cancelar</button>
        <a class="btn btn-success" id="save">Guardar</a>
    </div>
</form>
<script>
    $(function () {
        $('#save').on('click',function (e) {
            e.preventDefault();
            $.post("{{route('material.store')}}", $('#createMaterialForm').serialize());
            $('#close').click();
        })
    })

</script>



