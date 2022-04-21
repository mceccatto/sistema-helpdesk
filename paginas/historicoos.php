<?php
echo '
                <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalInfo" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div id="retornoBuscaInfo"></div>
                        </div>
                    </div>
                </div>
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <div class="d-flex align-items-center p-3 my-3 text-white bg-blue rounded shadow-sm">
                        <div class="lh-1">
                        <h1 class="h4 mb-0 text-white lh-1">Histórico de O.S.</h1>
                        <small>Histórico de Ordem de Serviço</small>
                        </div>
                    </div>
                    <div class="my-3 p-3 bg-body rounded shadow-sm">
                        <h6 class="border-bottom pb-2 mb-0">Histórico de Ordens de Serviço já finalizadas</h6>
                        <div class="d-flex text-muted pt-3">
                            <div class="col-md-12">
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="protocolo" id="protocolo" placeholder="Preencha com o número do protocolo">
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div id="retornoBusca"></div>
                            </div>
                        </div>
                    </div>
                </main>
';
?>