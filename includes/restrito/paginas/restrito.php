<?php
# GRÁFICO 1
$dia0 = date('Y-m-d');
$dia1 = date('Y-m-d', strtotime('-1 days'));
$dia2 = date('Y-m-d', strtotime('-2 days'));
$dia3 = date('Y-m-d', strtotime('-3 days'));
$dia4 = date('Y-m-d', strtotime('-4 days'));
$dia5 = date('Y-m-d', strtotime('-5 days'));
$dia6 = date('Y-m-d', strtotime('-6 days'));
$dias = array($dia0,$dia1,$dia2,$dia3,$dia4,$dia5,$dia6);
$quantidadeDias = array();
foreach($dias as $dia){
    $sql = '
    SELECT *
    FROM helpdesk_atendimentos
    WHERE datahora LIKE :datahora
    ';
    $stm = $conexao->prepare($sql);
    $stm->bindValue(':datahora', '%'.$dia.'%');
    $stm->execute();
    $totalRegistros = $stm->rowCount();
    array_push($quantidadeDias, $totalRegistros);
}
# GRÁFICO 2/3
$mes0 = date('Y-m');
$mes1 = date('Y-m', strtotime('-1 month'));
$mes2 = date('Y-m', strtotime('-2 month'));
$mes3 = date('Y-m', strtotime('-3 month'));
$mes4 = date('Y-m', strtotime('-4 month'));
$mes5 = date('Y-m', strtotime('-5 month'));
$meses = array($mes0,$mes1,$mes2,$mes3,$mes4,$mes5);
$quantidadeMes = array();
$horasTotaisMes = array();
foreach($meses as $mes){
    $sql = '
    SELECT *
    FROM helpdesk_atendimentos
    WHERE datahora LIKE :datahora
    ';
    $stm = $conexao->prepare($sql);
    $stm->bindValue(':datahora', '%'.$mes.'%');
    $stm->execute();
    $totalRegistros = $stm->rowCount();
    array_push($quantidadeMes, $totalRegistros);

    $sql = "
    SELECT time_format(SEC_TO_TIME(SUM(TIME_TO_SEC(tempoparaatendimento))),'%H:%i') AS horastotais
    FROM helpdesk_atendimentos
    WHERE datahora LIKE :datahora
    AND (
        diasemana = '1'
        OR diasemana = '2'
        OR diasemana = '3'
        OR diasemana = '4'
        OR diasemana = '5'
    )
    ";
    $stm = $conexao->prepare($sql);
    $stm->bindValue(':datahora', '%'.$mes.'%');
    $stm->execute();
    $resultado = $stm->fetch(PDO::FETCH_OBJ);
    array_push($horasTotaisMes, $resultado->horastotais);
}
if(!empty($quantidadeMes[0])){
    $registrosMes0 = $quantidadeMes[0];
}else{
    $registrosMes0 = 0;
}
if(!empty($quantidadeMes[1])){
    $registrosMes1 = $quantidadeMes[1];
}else{
    $registrosMes1 = 0;
}
if(!empty($quantidadeMes[2])){
    $registrosMes2 = $quantidadeMes[2];
}else{
    $registrosMes2 = 0;
}
if(!empty($quantidadeMes[3])){
    $registrosMes3 = $quantidadeMes[3];
}else{
    $registrosMes3 = 0;
}
if(!empty($quantidadeMes[4])){
    $registrosMes4 = $quantidadeMes[4];
}else{
    $registrosMes4 = 0;
}
if(!empty($quantidadeMes[5])){
    $registrosMes5 = $quantidadeMes[5];
}else{
    $registrosMes5 = 0;
}
if(!empty($horasTotaisMes[0])){
    $explode1 = explode(':', $horasTotaisMes[0]);
    $minutosMes0 = $explode1[0]*60+$explode1[1];
    if($registrosMes0 != 0){
        $mediaMes0 = $minutosMes0/$registrosMes0;
    }else{
        $mediaMes0 = NULL;
    }
}
if(!empty($horasTotaisMes[1])){
    $explode2 = explode(':', $horasTotaisMes[1]);
    $minutosMes1 = $explode2[0]*60+$explode2[1];
    if($registrosMes1 != 0){
        $mediaMes1 = $minutosMes1/$registrosMes1;
    }else{
        $mediaMes1 = NULL;
    }
}
if(!empty($horasTotaisMes[2])){
    $explode3 = explode(':', $horasTotaisMes[2]);
    $minutosMes2 = $explode3[0]*60+$explode3[1];
    if($registrosMes2 != 0){
        $mediaMes2 = $minutosMes2/$registrosMes2;
    }else{
        $mediaMes2 = NULL;
    }
}
if(!empty($horasTotaisMes[3])){
    $explode4 = explode(':', $horasTotaisMes[3]);
    $minutosMes3 = $explode4[0]*60+$explode4[1];
    if($registrosMes3 != 0){
        $mediaMes3 = $minutosMes3/$registrosMes3;
    }else{
        $mediaMes3 = NULL;
    }
}
if(!empty($horasTotaisMes[4])){
    $explode5 = explode(':', $horasTotaisMes[4]);
    $minutosMes4 = $explode5[0]*60+$explode5[1];
    if($registrosMes4 != 0){
        $mediaMes4 = $minutosMes4/$registrosMes4;
    }else{
        $mediaMes4 = NULL;
    }
}
if(!empty($horasTotaisMes[5])){
    $explode6 = explode(':', $horasTotaisMes[5]);
    $minutosMes5 = $explode6[0]*60+$explode6[1];
    if($registrosMes5 != 0){
        $mediaMes5 = $minutosMes5/$registrosMes5;
    }else{
        $mediaMes5 = NULL;
    }
}
# INDICADOR NUMÉRICO SUPERIOR
$sql = '
SELECT MAX(id_atendimento) AS total
FROM helpdesk_atendimentos
';
$stm = $conexao->prepare($sql);
$stm->execute();
$totalOsCriadas = $stm->fetch(PDO::FETCH_OBJ);

$sql = "
SELECT status
FROM helpdesk_atendimentos
WHERE status = '1'
";
$stm = $conexao->prepare($sql);
$stm->execute();
$totalOsAbertas = $stm->rowCount();

$sql = "
SELECT status
FROM helpdesk_atendimentos
WHERE status = '2'
OR status = '10'
OR status = '11'
";
$stm = $conexao->prepare($sql);
$stm->execute();
$totalOsEmAtendimento = $stm->rowCount();

$sql = "
SELECT status
FROM helpdesk_atendimentos
WHERE status = '3'
";
$stm = $conexao->prepare($sql);
$stm->execute();
$totalOsFinalizadas = $stm->rowCount();
# GRAFICO 4
$sql = '
    SELECT setores.descricao,
    COUNT(atendimentos.setor) AS registros
    FROM helpdesk_atendimentos AS atendimentos
    INNER JOIN helpdesk_setores AS setores
    ON atendimentos.setor = setores.id_setor
    GROUP BY atendimentos.setor
    HAVING COUNT(atendimentos.setor) > 0
    ORDER BY registros DESC
    LIMIT 10
    ';
$stm = $conexao->prepare($sql);
$stm->execute();
$resultadosTop10 = $stm->fetchAll(PDO::FETCH_OBJ);
# GRAFICO 5
$sql = '
SELECT usuarioatendimento,
COUNT(usuarioatendimento) AS atendimentos
FROM helpdesk_atendimentos
GROUP BY usuarioatendimento
HAVING COUNT(usuarioatendimento) > 0
ORDER BY atendimentos DESC;
';
$stm = $conexao->prepare($sql);
$stm->execute();
$usuariosAtendimentos = $stm->fetchAll(PDO::FETCH_OBJ);
?>
