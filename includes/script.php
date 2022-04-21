<?php
######################################################################################################
# INFORMAÇÕES PARA O AGENDAMENTO DO SCRIPT
######################################################################################################
# "C:\Program Files\PHP\8.0.0\php.exe" -c "C:\Program Files\PHP\8.0.0\php.ini" -f C:\inetpub\wwwroot\help-desk\includes\script.php

######################################################################################################
# DEFINIÇÕES DE CACHE
######################################################################################################
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');

######################################################################################################
# DEFINIÇÕES DE RETORNO DE ERROS DO PHP
######################################################################################################
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

######################################################################################################
# DEFINIÇÃO DO TIME ZONE DO SERVIDOR PHP
######################################################################################################
date_default_timezone_set('America/Sao_Paulo');

######################################################################################################
# EFETUA CONEXÃO COM O BANCO DE DADOS MYSQL
######################################################################################################
define('HOST', 'srv-mysql');
define('DBNAME', 'db_sistemas');
define('USER', 'sistemas');
define('PASSWORD', 'sistemas');
class conexao{
	private static $pdo;
	private function __construct() {}
	private static function verificaExtensao(){
        $extensao = 'pdo_mysql';
		if(!extension_loaded($extensao)){
		    echo 'ATENÇÃO!!!<br/>Extensão {$extensao} não habilitada!';
		    die();
        }
	}
	public static function getInstance(){
		self::verificaExtensao();
		if(!isset(self::$pdo)){
			try {
				$opcoes = array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8');
				self::$pdo = new \PDO('mysql:host='.HOST.';dbname='.DBNAME.';', USER, PASSWORD, $opcoes);
				self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			}
			catch(PDOException $e){
				if($e->getCode() == 2002){
					echo 'ATENÇÃO!!!<br/>Não foi possível conectar-se com o banco de dados!';
					die();
				}
			}
		}
		return self::$pdo;
	}
	public static function isConectado(){
		if(self::$pdo){
		    return true;
        }else{
		    return false;
        }
	}
}
$conexao = conexao::getInstance();

######################################################################################################
# CLASSES NECESSÁRIAS PARA O DISPARO DE EMAILS
######################################################################################################
require_once('phpmailer/class.phpmailer.php');
require_once('phpmailer/class.smtp.php');

######################################################################################################
# FUNÇÃO PARA VERIFICAR SE A ARRAY POSSUI CONTEUDO
######################################################################################################
function verificaArray($arrays){
    foreach($arrays as $array){
        if(empty($array)){
            return false;
        }else{
            return true;
        }
    }
}

######################################################################################################
# INÍCIO DO SCRIPT
######################################################################################################
$diasemana = date('w');
$equipamento = NULL;
$descricao = NULL;
$dados = array();

######################################################################################################
# EFETUA VERIFICAÇÃO DOS DIAS DA SEMANA PARA SELECIONAR O EQUIPAMENTOS E DESCRIÇÃO APROPRIADOS
######################################################################################################
switch ($diasemana){
    case 0://Domingo
        break;
    case 1://Segunda
        array_push($dados, array('44' => 'Verificar as bobinas de papel de todos os relógios.'));
        break;
    case 2://Terça
        break;
    case 3://Quarta
        array_push($dados, array('44' => 'Verificar as bobinas de papel de todos os relógios.'));
        break;
    case 4://Quinta
        break;
    case 5://Sexta
        array_push($dados, array('44' => 'Verificar as bobinas de papel de todos os relógios.'));
        array_push($dados, array('44' => 'Verificar a capacidade de tonner dos seguintes setores:<br/>» Médicos (Neonatal, Verde, Azul, Laranja, Lilás e Pronto Socorro)<br/>» Postos de Internação<br/>» Recepções<br/>Caso estejam com menos de 10% de capacidade, efetuar a troca do tonner.'));
        array_push($dados, array('44' => 'Efetuar atualização semanal das tabelas da Simpro.'));
        break;
    case 6://Sábado
        break;
}

######################################################################################################
# VERIFICA SE A ARRAY POSSUI CONTEUDO PARA SER CADASTRADO
######################################################################################################
$verificaDados = verificaArray($dados);
if($verificaDados){
    foreach($dados as $dado){
        foreach($dado as $equipamento => $descricao){
            $nome = 'Agendamento do Sistema';
            $empresa = 1;
            $setor = 73;
            $ramal = '0000';
            $ip = '127.0.0.1';
            $computador = 'srv-sistemas.dominio.local';
            $protocolo = date('dmY').round(microtime(true));
            $status = 1;
            $datahora = date('Y-m-d H:i:s');
            $sql = '
                INSERT INTO helpdesk_atendimentos (
                protocolo,
                empresa,
                setor,
                ramal,
                nome,
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
            $stm->bindValue(':empresa', $empresa);
            $stm->bindValue(':setor', $setor);
            $stm->bindValue(':ramal', $ramal);
            $stm->bindValue(':nome', $nome);
            $stm->bindValue(':equipamento', $equipamento);
            $stm->bindValue(':descricao', $descricao);
            $stm->bindValue(':ip', $ip);
            $stm->bindValue(':computador', $computador);
            $stm->bindValue(':datahora', $datahora);
            $stm->bindValue(':diasemana', $diasemana);
            $stm->bindValue(':status', $status);
            $executa = $stm->execute();
            if($executa){
                $retorno = 'sucesso';
                $destinatarios = array(
                    'exemplo1@dominio.com.br',
					'exemplo2@dominio.com.br'
                );
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
            }
        }
    }
    die();
}else{
    die();
}
?>