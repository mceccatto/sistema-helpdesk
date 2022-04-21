<?php
if(empty($totalOsCriadas->total)){
    $totalOsCriadas = 0;
}else{
    $totalOsCriadas = $totalOsCriadas->total;
}
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
                        <h1 class="h4 mb-0 text-white lh-1">Dashboard</h1>
                        <small>Indicadores de O.S.</small>
                        </div>
                    </div>
                    <div class="my-3 p-3 bg-body rounded shadow-sm">
                        <h6 class="border-bottom pb-2 mb-3">Indicadores de gestão de O.S.</h6>
                        <main>
                            <div class="row row-cols-1 row-cols-md-4 mb-3 text-center">
                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3 mb-3">
                                    <div class="card mb-4 rounded-3 shadow-sm">
                                    <div class="card-header py-3">
                                        <h4 class="my-0 fw-normal">Total O.S.</h4>
                                    </div>
                                    <div class="card-body">
                                        <h1 class="card-title pricing-card-title">'.$totalOsCriadas.'</h1>
                                        <ul class="list-unstyled mt-3 mb-4">
                                            <li>Criadas</li>
                                        </ul>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3 mb-3">
                                    <div class="card mb-4 rounded-3 shadow-sm">
                                    <div class="card-header py-3">
                                        <h4 class="my-0 fw-normal">Total O.S.</h4>
                                    </div>
                                    <div class="card-body">
                                        <h1 class="card-title pricing-card-title">'.$totalOsAbertas.'</h1>
                                        <ul class="list-unstyled mt-3 mb-4">
                                            <li>Em aberto</li>
                                        </ul>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3 mb-3">
                                    <div class="card mb-4 rounded-3 shadow-sm">
                                    <div class="card-header py-3">
                                        <h4 class="my-0 fw-normal">Total O.S.</h4>
                                    </div>
                                    <div class="card-body">
                                        <h1 class="card-title pricing-card-title">'.$totalOsEmAtendimento.'</h1>
                                        <ul class="list-unstyled mt-3 mb-4">
                                            <li>Em andamento</li>
                                        </ul>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3 mb-3">
                                    <div class="card mb-4 rounded-3 shadow-sm">
                                    <div class="card-header py-3">
                                        <h4 class="my-0 fw-normal">Total O.S.</h4>
                                    </div>
                                    <div class="card-body">
                                        <h1 class="card-title pricing-card-title">'.$totalOsFinalizadas.'</h1>
                                        <ul class="list-unstyled mt-3 mb-4">
                                            <li>Finalizadas</li>
                                        </ul>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </main>
                        <div class="row align-items-md-stretch mb-3">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 mb-3">
                                <div class="h-100 p-5 bg-light border rounded-3">
                                    <canvas id="grafico1" width="400" height="250"></canvas>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 mb-3">
                                <div class="h-100 p-5 bg-light border rounded-3">
                                    <canvas id="grafico2" width="400" height="250"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-md-stretch">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 mb-3">
                                <div class="h-100 p-5 bg-light border rounded-3">
                                    <canvas id="grafico3" width="400" height="250"></canvas>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 mb-3">
                                <div class="h-100 p-5 bg-light border rounded-3">
                                    <canvas id="grafico4" width="400" height="250"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-md-stretch">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 mb-3">
                                <div class="h-100 p-5 bg-light border rounded-3">
                                    <canvas id="grafico5" width="400" height="250"></canvas>
                                </div>
                            </div>
                            <!--
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 mb-3">
                                <div class="h-100 p-5 bg-light border rounded-3">
                                    <canvas id="grafico6" width="400" height="250"></canvas>
                                </div>
                            </div>
                            -->
                        </div>
                    </div>
                </main>
';
?>