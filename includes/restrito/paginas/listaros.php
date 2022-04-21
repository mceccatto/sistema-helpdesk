<?php
require('../includes/phpmailer/class.phpmailer.php');
require('../includes/phpmailer/class.smtp.php');
$usuario = $_SESSION['helpdesk_nomeCompleto'];
$agora = date('Y-m-d H:i:s');
if(@$_POST['acao'] === 'iniciarAtendimento'){
  $reposicoes = @$_POST['reposicoes'] ? $_POST['reposicoes'] : NULL;
  if(!empty($reposicoes)){
    $reposicoes = implode(",", $reposicoes);
  }
  $observacoes = @$_POST['observacoes'] ? $_POST['observacoes'] : NULL;
  if(empty($observacoes)){
    $observacoes = $observacoes;
  }else{
    $observacoes = $observacoes.'<br/><i>Usuário: '.$usuario.' em '.$agora.'</i><hr>';
  }
  $idProtocolo = @$_POST['id_protocolo'] ? $_POST['id_protocolo'] : NULL;
  $datahora = @$_POST['datahora'] ? $_POST['datahora'] : NULL;
  $email = @$_POST['email'] ? $_POST['email'] : NULL;
  $status = '2';
  $datahora = new DateTime($datahora);
  $inicioAtendimento = new DateTime($agora);
  $tempoArray = $datahora->diff($inicioAtendimento);
  $minutos = $tempoArray->d*24*60;
  $minutos += $tempoArray->h*60;
  $minutos += $tempoArray->i;
  $horas = floor($minutos/60);
  $minutos = $minutos%60;
  $tempoParaAtendimento = $horas.':'.$minutos;
  $sql = '
    UPDATE helpdesk_atendimentos
    SET reposicoes = :reposicoes,
    observacoes = :observacoes,
    status = :status,
    usuarioatendimento = :usuario,
    inicioatendimento = :inicioatendimento,
    tempoparaatendimento = :tempoparaatendimento
    WHERE id_atendimento = :id_protocolo
  ';
  $stm = $conexao->prepare($sql);
  $stm->bindValue(':reposicoes', $reposicoes);
  $stm->bindValue(':observacoes', $observacoes);
  $stm->bindValue(':status', $status);
  $stm->bindValue(':usuario', $usuario);
  $stm->bindValue(':inicioatendimento', $agora);
  $stm->bindValue(':tempoparaatendimento', $tempoParaAtendimento);
  $stm->bindValue(':id_protocolo', $idProtocolo);
  $executa = $stm->execute();
  if($executa){
    if(!empty($email)){
      $conteudo = '
        Protocolo: '.$protocolo.'<br/><br/>
        Status: Em atendimento<br/><br/>
        Usuário Atendimento: '.$usuario.'<br/><br/>
        Acesse: http://srv-sistemas/help-desk/<br/><br/>
        Este é um email automático. Favor não responder!
      ';
      $disparoEmail = new PHPMailer\PHPMailer\PHPMailer();
      $disparoEmail->IsSMTP();
      $disparoEmail->Host = 'dominio.com.br';
      $disparoEmail->Port = 587;
      $disparoEmail->SMTPAutoTLS = false;
      $disparoEmail->SMTPAuth = true;
      $disparoEmail->Username = 'exemplo@dominio.com.br';
      $disparoEmail->Password = 'senha';
      $disparoEmail->From = 'exemplo@dominio.com.br';
      $disparoEmail->FromName = 'Help-Desk';
      $disparoEmail->ClearAllRecipients();
      $disparoEmail->AddAddress($$email);
      $disparoEmail->IsHTML(true);
      $disparoEmail->CharSet = 'UTF-8';
      $disparoEmail->Subject = 'Status - Ordem de Serviço';
      $disparoEmail->Body = '<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px">'.$conteudo.'</span>';
      $disparoEmail->Send();
    }
	  header("Location: $url/help-desk/restrito/?modulo=listarOS");
	  die();
  }else{
	  header("Location: $url/help-desk/restrito/?modulo=listarOS");
	  die();
  }
}elseif(@$_POST['acao'] === 'atualizarHistorico'){
  $reposicoes = @$_POST['reposicoes'] ? $_POST['reposicoes'] : NULL;
  if(!empty($reposicoes)){
    $reposicoes = implode(",", $reposicoes);
  }
  $observacoes = @$_POST['observacoes'] ? $_POST['observacoes'] : NULL;
  $idProtocolo = @$_POST['id_protocolo'] ? $_POST['id_protocolo'] : NULL;
  $email = @$_POST['email'] ? $_POST['email'] : NULL;
  $observacoesantigasti = @$_POST['observacoesantigasti'] ? $_POST['observacoesantigasti'] : NULL;
  if(empty($observacoes) && empty($observacoesantigasti)){
    $observacoesTi = $observacoes;
  }elseif(!empty($observacoes) && empty($observacoesantigasti)){
    $observacoesTi = $observacoes.'<br/><i>Usuário: '.$usuario.' em '.$agora.'</i><hr>';
  }elseif(empty($observacoes) && !empty($observacoesantigasti)){
    $observacoesTi = $observacoesantigasti;
  }elseif(!empty($observacoes) && !empty($observacoesantigasti)){
    $observacoesTi = $observacoesantigasti.$observacoes.'<br/><i>Usuário: '.$usuario.' em '.$agora.'</i><hr>';
  }
  $status = 11;
  $sql = '
    UPDATE helpdesk_atendimentos
    SET reposicoes = :reposicoes,
    observacoes = :observacoes,
    status = :status
    WHERE id_atendimento = :id_protocolo
  ';
  $stm = $conexao->prepare($sql);
  $stm->bindValue(':reposicoes', $reposicoes);
  $stm->bindValue(':observacoes', $observacoesTi);
  $stm->bindValue(':status', $status);
  $stm->bindValue(':id_protocolo', $idProtocolo);
  $executa = $stm->execute();
  if($executa){
    if(!empty($email)){
      $conteudo = '
        Protocolo: '.$protocolo.'<br/><br/>
        Status: Em atendimento / Aguardando retorno do setor<br/><br/>
        Usuário Atendimento: '.$usuario.'<br/><br/>
        Observações: '.$observacoes.'<br/><br/>
        Acesse: http://srv-sistemas/help-desk/<br/><br/>
        Este é um email automático. Favor não responder!
      ';
      $disparoEmail = new PHPMailer\PHPMailer\PHPMailer();
      $disparoEmail->IsSMTP();
      $disparoEmail->Host = 'dominio.com.br';
      $disparoEmail->Port = 587;
      $disparoEmail->SMTPAutoTLS = false;
      $disparoEmail->SMTPAuth = true;
      $disparoEmail->Username = 'exemplo@dominio.com.br';
      $disparoEmail->Password = 'senha';
      $disparoEmail->From = 'exemplo@dominio.com.br';
      $disparoEmail->FromName = 'Help-Desk';
      $disparoEmail->ClearAllRecipients();
      $disparoEmail->AddAddress($$email);
      $disparoEmail->IsHTML(true);
      $disparoEmail->CharSet = 'UTF-8';
      $disparoEmail->Subject = 'Status - Ordem de Serviço';
      $disparoEmail->Body = '<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px">'.$conteudo.'</span>';
      $disparoEmail->Send();
    }
    header("Location: $url/help-desk/restrito/?modulo=listarOS");
    die();
  }else{
    header("Location: $url/help-desk/restrito/?modulo=listarOS");
    die();
  }
}elseif(@$_POST['acao'] === 'finalizarAtendimento'){
  $idProtocolo = @$_POST['id_protocolo'] ? $_POST['id_protocolo'] : NULL;
  $email = @$_POST['email'] ? $_POST['email'] : NULL;
  $status = '3';
  $sql = '
  UPDATE helpdesk_atendimentos
  SET status = :status,
  fimatendimento = :fimatendimento
  WHERE id_atendimento = :id_protocolo
  ';
  $stm = $conexao->prepare($sql);
  $stm->bindValue(':status', $status);
  $stm->bindValue(':fimatendimento', $agora);
  $stm->bindValue(':id_protocolo', $idProtocolo);
  $executa = $stm->execute();
  if($executa){
    if(!empty($email)){
      $conteudo = '
        Protocolo: '.$protocolo.'<br/><br/>
        Status: Atendimento Finalizado<br/><br/>
        Acesse: http://srv-sistemas/help-desk/<br/><br/>
        Este é um email automático. Favor não responder!
      ';
      $disparoEmail = new PHPMailer\PHPMailer\PHPMailer();
      $disparoEmail->IsSMTP();
      $disparoEmail->Host = 'dominio.com.br';
      $disparoEmail->Port = 587;
      $disparoEmail->SMTPAutoTLS = false;
      $disparoEmail->SMTPAuth = true;
      $disparoEmail->Username = 'exemplo@dominio.com.br';
      $disparoEmail->Password = 'senha';
      $disparoEmail->From = 'exemplo@dominio.com.br';
      $disparoEmail->FromName = 'Help-Desk';
      $disparoEmail->ClearAllRecipients();
      $disparoEmail->AddAddress($$email);
      $disparoEmail->IsHTML(true);
      $disparoEmail->CharSet = 'UTF-8';
      $disparoEmail->Subject = 'Status - Ordem de Serviço';
      $disparoEmail->Body = '<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px">'.$conteudo.'</span>';
      $disparoEmail->Send();
    }
	  header("Location: $url/help-desk/restrito/?modulo=listarOS");
	  die();
  }else{
	  header("Location: $url/help-desk/restrito/?modulo=listarOS");
	  die();
  }
}
?>