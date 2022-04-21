<?php
echo '
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <div class="d-flex align-items-center p-3 my-3 text-white bg-blue rounded shadow-sm">
                        <div class="lh-1">
                        <h1 class="h4 mb-0 text-white lh-1">Restrito</h1>
                        <small>Acesso restrito</small>
                        </div>
                    </div>';
                    if(@$_GET['retorno'] === 'autenticacao'){
                        echo '<div class="alert alert-warning" role="alert">Usuário ou Senha incorreto(s).</div>';
                    }elseif(@$_GET['retorno'] === 'permissao'){
                        echo '<div class="alert alert-danger" role="alert">Você não possui autorização para acessar este conteúdo.</div>';
                    }elseif(@$_GET['retorno'] === 'sessao'){
                        echo '<div class="alert alert-warning" role="alert">Sua sessão expirou. Efetue login novamente.</div>';
                    }
                    echo '<div class="my-3 p-3 bg-body rounded shadow-sm">
                        <h6 class="border-bottom pb-2 mb-0">Acesso a área de administração de Ordens de Serviço</h6>
                        <div class="d-flex text-muted pt-3">
                            <div class="col">
                                <form action="" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                                    <div class="row g-3">
                                        <div class="col-xs-12 col-sm-9 col-md-6 col-lg-3">
                                            <label for="usuario" class="form-label">Usuário AD</label>
                                            <input type="text" class="form-control" name="usuario" id="usuario" required>
                                            <div class="invalid-feedback">Este campo é obrigatório</div>
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-xs-12 col-sm-9 col-md-6 col-lg-3">
                                            <label for="senha" class="form-label">Senha AD</label>
                                            <input type="password" class="form-control" name="senha" id="senha" required>
                                            <div class="invalid-feedback">Este campo é obrigatório</div>
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-xs-12 col-sm-9 col-md-6 col-lg-3">
                                            <label class="form-label">&nbsp;</label>
                                            <button class="w-100 btn btn-primary" type="submit">Autenticar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
';
?>