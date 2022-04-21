<?php
include('../config.php');
if(@$_POST){
  $sql = "
    SELECT tb1.id_atendimento AS id,
    tb1.protocolo AS protocolo,
    tb2.descricao AS empresa,
    tb5.descricao AS setor,
    tb1.ramal AS ramal,
    tb1.nome AS nome,
    tb1.email AS email,
    tb3.descricao AS equipamento,
    tb1.descricao AS descricao,
    tb1.anexos AS anexos,
    tb1.ip AS ip,
    tb1.computador AS computador,
    tb1.datahora AS datahora,
    tb4.descricao AS status,
    tb1.inicioatendimento AS inicioatendimento,
    tb1.fimatendimento AS fimatendimento,
    tb1.usuarioatendimento AS usuarioatendimento,
    tb1.observacoes AS observacoes,
    tb1.observacoessetor AS observacoessetor,
    tb1.reposicoes AS reposicoes,
    tb1.`status` AS id_status
    FROM helpdesk_atendimentos AS tb1
    INNER JOIN helpdesk_empresas AS tb2
    ON tb1.empresa = tb2.id_empresa
    INNER JOIN helpdesk_equipamentos AS tb3
    ON tb1.equipamento = tb3.id_equipamento
    INNER JOIN helpdesk_filtros AS tb4
    ON tb1.`status` = tb4.id_filtro
    INNER JOIN helpdesk_setores AS tb5
    ON tb1.setor = tb5.id_setor
    WHERE tb1.id_atendimento = :id_atendimento
  ";
  $stm = $conexao->prepare($sql);
  $stm->bindValue(':id_atendimento', $_POST['id_protocolo']);
  $stm->execute();
  $retorno = $stm->fetch(PDO::FETCH_OBJ);
}
if($retorno->id_status === '1'){
  $cor = 'style="color: red;"';
}elseif($retorno->id_status === '2'){
  $cor = 'style="color: orange;"';
}elseif($retorno->id_status === '3'){
  $cor = 'style="color: green;"';
}elseif($retorno->id_status === '10'){
  $cor = 'style="color: orange;"';
}elseif($retorno->id_status === '11'){
  $cor = 'style="color: orange;"';
}
$sqlReposicoes = '
  SELECT *
  FROM helpdesk_pecas
  ORDER BY descricao ASC
';
$stm = $conexao->prepare($sqlReposicoes);
$stm->execute();
$resultadosReposicoes = $stm->fetchAll();
$saida = '
  <div class="modal-header">
  <h5 class="modal-title" id="modalInfo">Protocolo: '.$retorno->protocolo.'</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
  </div>
  <div class="modal-body">
  <span><b>Estabelecimento:</b> '.$retorno->empresa.'<span>
  <br/>
  <span><b>Nome:</b> '.$retorno->nome.'<span>
  <br/>
  <span><b>Setor:</b> '.$retorno->setor.'<span>
  <br/>
  <span><b>Equipamento:</b> '.$retorno->equipamento.'<span>
  <br/>
  <span><b>Ramal:</b> '.$retorno->ramal.'<span>
  <br/>
  <span><b>Descrição:</b> '.nl2br($retorno->descricao).'<span>
';
if($retorno->anexos != ''){
  $saida .= '
    <br/>
    <span><b>Anexos:</b> <span>
    <div id="imagensAnexo" class="carousel carousel-dark slide" data-bs-ride="carousel">
    <div class="carousel-inner">
  ';
  $explodeAnexos = explode(',', $retorno->anexos);
  if($explodeAnexos[0] != ''){
    $saida .= '
      <div class="carousel-item active">
      <img src="'.$url.'/help-desk/img/anexos/'.$retorno->protocolo.'/'.$explodeAnexos[0].'" class="d-block w-100">
      </div>
    ';
  }
  if(@$explodeAnexos[1] != ''){
    $saida .= '
      <div class="carousel-item">
      <img src="'.$url.'/help-desk/img/anexos/'.$retorno->protocolo.'/'.$explodeAnexos[1].'" class="d-block w-100">
      </div>
    ';
  }
  if(@$explodeAnexos[2] != ''){
    $saida .= '
      <div class="carousel-item">
      <img src="'.$url.'/help-desk/img/anexos/'.$retorno->protocolo.'/'.$explodeAnexos[2].'" class="d-block w-100">
      </div>
    ';
  }
  if(@$explodeAnexos[3] != ''){
    $saida .= '
      <div class="carousel-item">
      <img src="'.$url.'/help-desk/img/anexos/'.$retorno->protocolo.'/'.$explodeAnexos[3].'" class="d-block w-100">
      </div>
    ';
  }
  $saida .= '
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#imagensAnexo" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#imagensAnexo" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
    </button>
    </div>
  ';
}
$saida .= '
  <br/>
  <span><b>Endereço IP:</b> '.$retorno->ip.'<span>
  <br/>
  <span><b>Computador:</b> '.$retorno->computador.'<span>
  <br/>
  <span><b>Data/Hora:</b> '.$retorno->datahora.'<span>
  <br/>
  <span><b>Status:</b> <text '.$cor.'>'.$retorno->status.'</text><span>
';
if($retorno->inicioatendimento != ''){
  $saida .= '
    <br/>
    <span><b>Usuário de atendimento:</b> '.$retorno->usuarioatendimento.'<span>
    <br/>
    <span><b>Início do atendimento:</b> '.$retorno->inicioatendimento.'<span>
  ';
}
if($retorno->fimatendimento != ''){
  $saida .= '
    <br/>
    <span><b>Encerramento do atendimento:</b> '.$retorno->fimatendimento.'<span>
  ';
}
if(!empty($retorno->reposicoes) || !empty($retorno->observacoes)){
  $saida .= '
    <hr/>
    <h4>Histórico</h4>
    <div class="row g-3">
    <div class="col-md-12 mb-1">
  ';
}
if(!empty($retorno->reposicoes)){
  $reposicoesExplode = explode(',', $retorno->reposicoes);
  $saida .= '
    <span><b>Reposições:</b></span>
  ';
  foreach($resultadosReposicoes as $resultadoReposicao) {
    if(in_array($resultadoReposicao['id_peca'], $reposicoesExplode)){
      $saida .= $resultadoReposicao['descricao'].', ';
    }
  }
}
if(!empty($retorno->observacoes) || !empty($retorno->observacoessetor)){
  $saida .= '
    </div>
    </div>
    <div class="row">
    <div class="col-md-6">
    <span><b>Histórico Suporte:</b><br/>'.nl2br($retorno->observacoes).'<span>
    </div>
    <div class="col-md-6">
    <span><b>Histórico Solicitante:</b><br/>'.nl2br($retorno->observacoessetor).'<span>
    </div>
    </div>
  ';
}
$saida .= '
  </div>
  </div>
';
$saida .= '
  <div class="modal-footer">
  <button type="button" class="btn btn-success" data-bs-dismiss="modal">Fechar</button>
  </div>
';
echo $saida;
?>