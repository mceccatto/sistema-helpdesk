<?php
echo '
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex align-items-center p-3 my-3 text-white bg-blue rounded shadow-sm">
        <div class="lh-1">
        <h1 class="h4 mb-0 text-white lh-1">Nova O.S.</h1>
        <small>Nova Ordem de Serviço</small>
        </div>
    </div>';
    if(@$_GET['retorno'] === 'sucesso'){
        echo '<div class="alert alert-success" role="alert"><h5>Seu chamado foi aberto com sucesso.</h5><hr>Seu número de protocolo é: <b>'.@$_GET['protocolo'].'</b></div>';
    }elseif(@$_GET['retorno'] === 'falha'){
        echo '<div class="alert alert-danger" role="alert"><h5>Não foi possível abrir um novo chamado no momento.</h5><hr>Tente novamente mais tarde.</div>';
    }
    echo '
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h6 class="border-bottom pb-2 mb-0">Preencha os campos abaixo para abrir um novo chamado</h6>
        <div class="d-flex text-muted pt-3">
            <div class="col-md-12">
                <form action="" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                    <div class="row g-3">
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-2">
                            <label for="nome" class="form-label">Nome *</label>
                            <input type="text" class="form-control" name="nome" id="nome" maxlength="50" required>
                            <div class="invalid-feedback">Campo obrigatório</div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-2">
                            <label for="email" class="form-label">Email (opcional)</label>
                            <input type="text" class="form-control" name="email" id="email" maxlength="75">
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-2">
                            <label for="estabelecimento" class="form-label">Estabelecimento *</label>
                            <select class="form-select" name="estabelecimento" id="estabelecimento" required>
                                <option value="">-- Selecione</option>';
                                foreach($resultadoEmpresas as $resultadoEmpresa){
                                echo '<option value="'.$resultadoEmpresa['id_empresa'].'">'.$resultadoEmpresa['descricao'].'</option>';
                                }
                            echo '</select>
                            <div class="invalid-feedback">Campo obrigatório</div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-2">
                            <label for="setor" class="form-label">Setor *</label>
                            <select class="form-select" name="setor" id="setor" required>
                                <option value="">-- Selecione</option>';
                                foreach($resultadoSetores as $resultadoSetor){
                                echo '<option value="'.$resultadoSetor['id_setor'].'">'.$resultadoSetor['descricao'].'</option>';
                                }
                            echo '</select>
                            <div class="invalid-feedback">Campo obrigatório</div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-2">
                            <label for="equipamento" class="form-label">Equipamento *</label>
                            <select class="form-select" name="equipamento" id="equipamento" required>
                                <option value="">-- Selecione</option>';
                                foreach($resultadoEquipamentos as $resultadoEquipamento){
                                echo '<option value="'.$resultadoEquipamento['id_equipamento'].'">'.$resultadoEquipamento['descricao'].'</option>';
                                }
                            echo '</select>
                            <div class="invalid-feedback">Campo obrigatório</div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-2">
                            <label for="ramal" class="form-label">Ramal *</label>
                            <input type="text" class="form-control" name="ramal" id="ramal" maxlength="4" required>
                            <div class="invalid-feedback">Campo obrigatório</div>
                        </div>
                        <div class="col-sm-8">
                            <label for="descricao" class="form-label">Descrição do problema</label>
                            <textarea type="text" class="form-control" name="descricao" id="descricao" required></textarea>
                            <div class="invalid-feedback">Campo obrigatório</div>
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label">Prévia do(s) anexo(s)</label>
                            <div id="previa"></div>
                            <br/>
                            <a href="#" class="btn btn-danger" id="limpar">Remover anexos</a>
                        </div>
                        <div class="col-sm-12">
                            <label for="anexo" class="form-label">Anexo</label>
                            <input class="form-control" type="file" name="anexo[]" id="anexo" accept=".jpg,.jpeg,.png,.gif" onmouseup="limpaPrevia()" multiple>
                            <div>Você pode carregar até 4 imagens nos seguintes formatos: JPG, JPEG, PNG ou GIF. Formatos não autorizados não serão salvos.</div>
                        </div>
                        <input type="hidden" name="acao" value="salvar">
                    </div>
                    <hr class="my-4">
                    <button class="w-100 btn btn-primary btn-lg" type="submit" id="submit">
                        <i class="fa fa-spinner fa-spin" id="loading"></i> Salvar
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>';
?>