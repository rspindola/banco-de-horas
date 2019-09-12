<div id="editModal" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" id="editForm" method="post">
                @csrf
                @method('PATCH')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="inputData" class="col-sm-2 col-form-label">Data</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control @error('date') is-invalid @enderror" name="date"
                                    data-toggle="datepicker">
        
                                @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEntrada" class="col-sm-2 col-form-label">Entrada</label>
                            <div class="col-sm-10">
                                <input type="time" class="form-control timepicker @error('startTime') is-invalid @enderror"
                                    name='startTime'>
        
                                @error('startTime')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Saida</label>
                            <div class="col-sm-10">
                                <input type="time" class="form-control timepicker @error('finishTime') is-invalid @enderror"
                                    name='finishTime'>
        
                                @error('finishTime')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-right">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
                        <button type="submit" name="" class="btn btn-success" data-dismiss="modal" onclick="formEditar()">Sim</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>