<div id="DeleteModal" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="" id="deleteForm" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <p class="text-center">Você tem certeza que deseja excluir?</p>
                    </div>
                    <div class="modal-footer text-right">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
                        <button type="submit" name="" class="btn btn-success" data-dismiss="modal"
                            onclick="formSubmit()">Sim</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>