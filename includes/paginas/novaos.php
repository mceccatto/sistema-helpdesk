<?php
require('includes/phpmailer/class.phpmailer.php');
require('includes/phpmailer/class.smtp.php');

if(@$_POST['acao'] === 'salvar'){
    $estabelecimento = @$_POST['estabelecimento'] ? $_POST['estabelecimento'] : NULL;
    $setor = @$_POST['setor'] ? $_POST['setor'] : NULL;
    $equipamento = @$_POST['equipamento'] ? $_POST['equipamento'] : NULL;
    $ramal = @$_POST['ramal'] ? $_POST['ramal'] : NULL;
    $nome = @$_POST['nome'] ? mb_convert_case($_POST['nome'], MB_CASE_TITLE) : NULL;
    $email = @$_POST['email'] ? mb_convert_case($_POST['email'], MB_CASE_LOWER) : NULL;
    $descricao = @$_POST['descricao'] ? $_POST['descricao'] : NULL;
    $ip = $_SERVER['REMOTE_ADDR'];
    $computador = gethostbyaddr($_SERVER['REMOTE_ADDR']);
    $protocolo = date('dmY').round(microtime(true));
    $status = '1';
    $datahora = date('Y-m-d H:i:s');
    $diasemana = date('w');
    if($_FILES['anexo']['size'][0] != 0){
        $extensoesPermitidos = array('jpg','JPG','jpeg','JPEG','png','PNG','gif','GIF');
        $anexo = array();
        $anexoArray = $_FILES['anexo']['name'];
        $anexoArrayTemp = $_FILES['anexo']['tmp_name'];
        $anexoArrayTempQuantidade = count($anexoArrayTemp);
        $numeroRandomico = md5(uniqid(rand(), true));
        for($i = 0; $i < $anexoArrayTempQuantidade; $i++){
            $extension = pathinfo($anexoArray[$i] , PATHINFO_EXTENSION);
            if(in_array($extension, $extensoesPermitidos)){
                if(!is_dir('img/anexos/'.$protocolo)){
                    mkdir('img/anexos/'.$protocolo);
                }
                move_uploaded_file($anexoArrayTemp[$i], 'img/anexos/'.$protocolo.'/'.$numeroRandomico.'-'.$i.'.'.$extension);
                array_push($anexo, $numeroRandomico.'-'.$i.'.'.$extension);
            }
        }
        $anexos = implode(',', $anexo);
        $sql = '
            INSERT INTO helpdesk_atendimentos (
            protocolo,
            empresa,
            setor,
            ramal,
            nome,
            email,
            equipamento,
            descricao,
            anexos,
            ip,
            computador,
            datahora,
            diasemana,
            status
            ) VALUES (
            :protocolo,
            :empresa,
            :setor,
            :ramal,
            :nome,
            :email,
            :equipamento,
            :descricao,
            :anexos,
            :ip,
            :computador,
            :datahora,
            :diasemana,
            :status
        )
        ';
        $stm = $conexao->prepare($sql);
        $stm->bindValue(':protocolo', $protocolo);
        $stm->bindValue(':empresa', $estabelecimento);
        $stm->bindValue(':setor', $setor);
        $stm->bindValue(':ramal', $ramal);
        $stm->bindValue(':nome', $nome);
        $stm->bindValue(':email', $email);
        $stm->bindValue(':equipamento', $equipamento);
        $stm->bindValue(':descricao', $descricao);
        $stm->bindValue(':anexos', $anexos);
        $stm->bindValue(':ip', $ip);
        $stm->bindValue(':computador', $computador);
        $stm->bindValue(':datahora', $datahora);
        $stm->bindValue(':diasemana', $diasemana);
        $stm->bindValue(':status', $status);
        $executa = $stm->execute();
    }else{
        $sql = '
            INSERT INTO helpdesk_atendimentos (
            protocolo,
            empresa,
            setor,
            ramal,
            nome,
            email,
            equipamento,
            descricao,
            ip,
            computador,
            datahora,
            diasemana,
            status
            ) VALUES (
            :protocolo,
            :empresa,
            :setor,
            :ramal,
            :nome,
            :email,
            :equipamento,
            :descricao,
            :ip,
            :computador,
            :datahora,
            :diasemana,
            :status
            )
        ';
        $stm = $conexao->prepare($sql);
        $stm->bindValue(':protocolo', $protocolo);
        $stm->bindValue(':empresa', $estabelecimento);
        $stm->bindValue(':setor', $setor);
        $stm->bindValue(':ramal', $ramal);
        $stm->bindValue(':nome', $nome);
        $stm->bindValue(':email', $email);
        $stm->bindValue(':equipamento', $equipamento);
        $stm->bindValue(':descricao', $descricao);
        $stm->bindValue(':ip', $ip);
        $stm->bindValue(':computador', strtolower($computador));
        $stm->bindValue(':datahora', $datahora);
        $stm->bindValue(':diasemana', $diasemana);
        $stm->bindValue(':status', $status);
        $executa = $stm->execute();
    }
    if($executa){
        $retorno = 'sucesso';
        if($diasemana === '6' || $diasemana === '0'){
            $destinatarios = array(
                'exemplo1@dominio.com.br',
                'exemplo2@dominio.com.br'
            );
        }else{
            $destinatarios = array(
                'exemplo1@dominio.com.br',
                'exemplo2@dominio.com.br'
            );
        }
        if(!empty($email)){
            array_push($destinatarios, $email);
        }
        $conteudo = '
        Protocolo: '.$protocolo.'<br/><br/>
        Status: Aguardando atendimento<br/><br/>
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
        foreach($destinatarios as $destinatario){
            $disparoEmail->ClearAllRecipients();
            $disparoEmail->AddAddress($destinatario);
            $disparoEmail->IsHTML(true);
            $disparoEmail->CharSet = 'UTF-8';
            $disparoEmail->Subject = 'Nova Ordem de Serviço';
            $disparoEmail->Body = '<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px">'.$conteudo.'</span>';
            $disparoEmail->Send();
        }
		header("Location: $url/help-desk/?modulo=novaOS&retorno=$retorno&protocolo=$protocolo");
		die();
    }else{
        $retorno = 'falha';
		header("Location: $url/help-desk/?modulo=novaOS&retorno=$retorno");
		die();
    }
}
$sqlEmpresas = '
    SELECT *
    FROM helpdesk_empresas
    ORDER BY id_empresa ASC
';
$stm = $conexao->prepare($sqlEmpresas);
$stm->execute();
$resultadoEmpresas = $stm->fetchAll();
$sqlSetores = '
    SELECT *
    FROM helpdesk_setores
    WHERE status = 4
    ORDER BY descricao ASC
';
$stm = $conexao->prepare($sqlSetores);
$stm->execute();
$resultadoSetores = $stm->fetchAll();
$sqlEquipamentos = '
    SELECT *
    FROM helpdesk_equipamentos
    WHERE status = 6
    ORDER BY descricao ASC
';
$stm = $conexao->prepare($sqlEquipamentos);
$stm->execute();
$resultadoEquipamentos = $stm->fetchAll();
?>