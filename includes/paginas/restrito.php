<?php
session_start();
if(@$_SESSION['helpdesk'] || @$_SESSION['helpdesk'] == true){
    header("Location: $url/help-desk/restrito");
    die();
}
if(@$_POST){
    $usuario = @$_POST['usuario'] ? $_POST['usuario'] : '';
    $senha = @$_POST['senha'] ? $_POST['senha'] : '';
    $servidorLdap = "ldap://dominio.local";
    $ldap = ldap_connect($servidorLdap);
    $ldaprdn = 'DOMINIO' . "\\" . $usuario;
    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
    $bind = @ldap_bind($ldap, $ldaprdn, $senha);
    $usuariosPermitidos = array(
        'exemplo1',
        'exemplo2'
    );
    if($bind){
        $filtro="(sAMAccountName=$usuario)";
        $resultado = ldap_search($ldap,'dc=DOMINIO,dc=LOCAL',$filtro);
        $informacoes = ldap_get_entries($ldap, $resultado);
        for($i=0; $i<$informacoes['count']; $i++){
            if($informacoes['count'] > 1)
            break;
            if(!in_array($informacoes[$i]['samaccountname'][0], $usuariosPermitidos)){
                @ldap_close($ldap);
                $retorno = 'permissao';
                header("Location: $url/help-desk/?modulo=restrito&retorno=$retorno");
		        die();
            }else{
                $_SESSION['helpdesk'] = true;
                $_SESSION['helpdesk_usuario'] = $informacoes[$i]['samaccountname'][0];
                $_SESSION['helpdesk_nomeCompleto'] = $informacoes[$i]['cn'][0];
                @ldap_close($ldap);
                header("Location: $url/help-desk/restrito");
                die();
            }
        }
        @ldap_close($ldap);
    }else{
        $retorno = 'autenticacao';
        header("Location: $url/help-desk/?modulo=restrito&retorno=$retorno");
		die();
    }
}
?>