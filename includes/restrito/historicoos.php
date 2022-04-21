<?php
include('../config.php');

$limite = '10';
$pagina = 1;
if(@$_POST['pagina'] > 1){
  $inicio = (($_POST['pagina'] - 1) * $limite);
  $pagina = $_POST['pagina'];
}else{
  $inicio = 0;
}

$sql = '
  SELECT tb1.id_atendimento AS id,
  tb1.protocolo AS protocolo,
  tb2.descricao AS empresa,
  tb5.descricao AS setor,
  tb1.ramal AS ramal,
  tb3.descricao AS equipamento,
  tb1.descricao AS descricao,
  tb1.anexos AS anexos,
  tb1.ip AS ip,
  tb1.computador AS computador,
  tb1.datahora AS datahora,
  tb4.descricao AS `status`,
  tb1.inicioatendimento AS inicioatendimento,
  tb1.fimatendimento AS fimatendimento,
  tb1.usuarioatendimento AS usuarioatendimento,
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
';

if(@$_POST['protocolo'] != ''){
  $sql .= "
    WHERE tb1.protocolo LIKE '%".$_POST['protocolo']."%'
    AND tb1.`status` = '3'
    ORDER BY tb1.fimatendimento DESC
  ";
}else{
  $sql .= "
    WHERE tb1.`status` = 3
    ORDER BY tb1.fimatendimento DESC
  ";
}

$filtro = $sql.' LIMIT '.$inicio.', '.$limite;

$stm = $conexao->prepare($sql);
$stm->execute();
$totalRegistros = $stm->rowCount();

$stm = $conexao->prepare($filtro);
$stm->execute();
$retorno = $stm->fetchAll();
$total_filter_data = $stm->rowCount();

$saida = '
<label>Total de Ordens de Serviço finalizadas - '.$totalRegistros.'</label>
<table class="table table-striped table-hover">
  <thead>
      <tr>
          <th scope="col">Protocolo</th>
          <th scope="col">Estabelecimento</th>
          <th scope="col">Data/Hora</th>
          <th scope="col">Setor</th>
          <th scope="col">Equipamento</th>
          <th scope="col">Usuário Atendimento</th>
          <th scope="col">Status</th>
      </tr>
  </thead>
  <tbody>';

if($totalRegistros > 0){
  foreach($retorno as $linha){
    if($linha['id_status'] === '1'){
      $cor = 'style="color: red;"';
    }elseif($linha['id_status'] === '2'){
      $cor = 'style="color: orange;"';
    }elseif($linha['id_status'] === '3'){
      $cor = 'style="color: green;"';
    }
    $saida .= '
    <tr>
      <th scope="row">
      <a style="text-decoration: none;" href="" data-toggle="modal" data-target="#modal" data-id="'.$linha['id'].'" id="btnModal">'.$linha['protocolo'].'</a>
      </th>
      <td>'.$linha['empresa'].'</td>
      <td>'.$linha['datahora'].'</td>
      <td>'.$linha['setor'].'</td>
      <td>'.$linha['equipamento'].'</td>
      <td>'.$linha['usuarioatendimento'].'</td>
      <td '.$cor.'>'.$linha['status'].'</td>
    </tr>
    ';
  }
}else{
  $saida .= '
  <tr>
    <td colspan="7" align="center">Nenhum registro foi encontrado</td>
  </tr>
  ';
}
$saida .= '</tbody>
</table>
<div align="center">
  <ul class="pagination">
';

$total_links = ceil($totalRegistros/$limite);
$previous_link = '';
$next_link = '';
$pagina_link = '';

$paginaArray = array();

if($total_links > 4){
  if($pagina < 5){
    for($contagem = 1; $contagem <= 5; $contagem++){
      $paginaArray[] = $contagem;
    }
    $paginaArray[] = '...';
    $paginaArray[] = $total_links;
  }else{
    $end_limit = $total_links - 5;
    if($pagina > $end_limit){
      $paginaArray[] = 1;
      $paginaArray[] = '...';
      for($contagem = $end_limit; $contagem <= $total_links; $contagem++){
        $paginaArray[] = $contagem;
      }
    }else{
      $paginaArray[] = 1;
      $paginaArray[] = '...';
      for($contagem = $pagina - 1; $contagem <= $pagina + 1; $contagem++){
        $paginaArray[] = $contagem;
      }
      $paginaArray[] = '...';
      $paginaArray[] = $total_links;
    }
  }
}else{
  for($contagem = 1; $contagem <= $total_links; $contagem++){
    $paginaArray[] = $contagem;
  }
}
if(!$totalRegistros == 0) {
  for($contagem = 0; $contagem < count($paginaArray); $contagem++){
    if($pagina == $paginaArray[$contagem]){
      $pagina_link .= '
      <li class="page-item active">
        <a class="page-link" href="#">'.$paginaArray[$contagem].'</a>
      </li>
      ';

      $previous_id = $paginaArray[$contagem] - 1;
      if($previous_id > 0){
        $previous_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$previous_id.'">Anterior</a></li>';
      }else{
        $previous_link = '
        <li class="page-item disabled">
          <a class="page-link" href="#">Anterior</a>
        </li>
        ';
      }
      $next_id = $paginaArray[$contagem] + 1;
      if($next_id > $total_links){
        $next_link = '
        <li class="page-item disabled">
          <a class="page-link" href="#">Próximo</a>
        </li>
          ';
      }else{
        $next_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$next_id.'">Próximo</a></li>';
      }
    }else{
      if($paginaArray[$contagem] == '...'){
        $pagina_link .= '
        <li class="page-item disabled">
            <a class="page-link" href="#">...</a>
        </li>
        ';
      }else{
        $pagina_link .= '
        <li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$paginaArray[$contagem].'">'.$paginaArray[$contagem].'</a></li>
        ';
      }
    }
  }
}

$saida .= $previous_link . $pagina_link . $next_link;
$saida .= '
  </ul>
</div>
';

echo $saida;

?>