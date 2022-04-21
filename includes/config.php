<?php
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
define('HOST', 'servidor');
define('DBNAME', 'bancodedados');
define('USER', 'usuario');
define('PASSWORD', 'senha');
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
# DEFUNIÇÃO DO PROTOCOLO A SER UTILIZADO NA URL
######################################################################################################
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
	$protocolo = 'https';
}else{
	$protocolo = 'http';
}
$url = $protocolo.'://'.$_SERVER['HTTP_HOST'];
?>