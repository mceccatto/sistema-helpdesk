<?php
require('includes/phpmailer/class.phpmailer.php');
require('includes/phpmailer/class.smtp.php');
$agora = date('Y-m-d H:i:s');
if(@$_POST['acao'] === 'atualizarHistoricoUsuario'){
    $observacoes = @$_POST['observacoes'] ? $_POST['observacoes'] : NULL;
    $idProtocolo = @$_POST['id_protocolo'] ? $_POST['id_protocolo'] : NULL;
    $email = @$_POST['email'] ? $_POST['email'] : NULL;
    $observacoesantigassetor = @$_POST['observacoesantigassetor'] ? $_POST['observacoesantigassetor'] : NULL;
    $status = 10;
    if(empty($observacoes) && empty($observacoesantigassetor)){
      $observacoesSetor = $observacoes;
    }elseif(!empty($observacoes) && empty($observacoesantigassetor)){
      $observacoesSetor = $observacoes.'<br/><i>Retorno setor em '.$agora.'</i><hr>';
    }elseif(empty($observacoes) && !empty($observacoesantigassetor)){
      $observacoesSetor = $observacoesantigassetor;
    }elseif(!empty($observacoes) && !empty($observacoesantigassetor)){
      $observacoesSetor = $observacoesantigassetor.$observacoes.'<br/><i>Retorno setor em '.$agora.'</i><hr>';
    }
    $sql = '
      UPDATE helpdesk_atendimentos
      SET observacoessetor = :observacoessetor,
      status = :status
      WHERE id_atendimento = :id_protocolo
    ';
    $stm = $conexao->prepare($sql);
    $stm->bindValue(':observacoessetor', $observacoesSetor);
    $stm->bindValue(':status', $status);
    $stm->bindValue(':id_protocolo', $idProtocolo);
    $executa = $stm->execute();
    if($executa){
      if(!empty($email)){
        $conteudo = '
          Protocolo: '.$protocolo.'<br/><br/>
          Status: Em atendimento / Aguardando retorno da T.I.<br/><br/>
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
      header("Location: $url/help-desk/?modulo=listarOS");
      die();
    }else{
      header("Location: $url/help-desk/?modulo=listarOS");
      die();
    }
}
?>