<?php
echo "
<script>
setTimeout(function(){
    window.location.reload(1);
}, 60000);

var ctx = document.getElementById('grafico1').getContext('2d');
var grafico1 = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
            '$dia0',
            '$dia1',
            '$dia2',
            '$dia3',
            '$dia4',
            '$dia5',
            '$dia6'
        ],
        datasets: [{
            label: 'Total',
            data: [
                $quantidadeDias[0],
                $quantidadeDias[1],
                $quantidadeDias[2],
                $quantidadeDias[3],
                $quantidadeDias[4],
                $quantidadeDias[5],
                $quantidadeDias[6]
            ],
            backgroundColor: [
                'rgba(255, 0, 0, 0.2)',
                //'rgba(255, 94, 0, 0.2)',
                'rgba(255, 174, 0, 0.2)',
                //'rgba(255, 242, 0, 0.2)',
                'rgba(195, 255, 0, 0.2)',
                //'rgba(119, 255, 0, 0.2)',
                'rgba(21, 255, 0, 0.2)',
                //'rgba(0, 255, 140, 0.2)',
                'rgba(0, 255, 217, 0.2)',
                //'rgba(0, 229, 255, 0.2)',
                'rgba(0, 166, 255, 0.2)',
                //'rgba(0, 94, 255, 0.2)',
                'rgba(30, 0, 255, 0.2)',
                //'rgba(115, 0, 255, 0.2)',
                'rgba(153, 0, 255, 0.2)',
                //'rgba(195, 0, 255, 0.2)',
                'rgba(251, 0, 255, 0.2)',
                //'rgba(255, 0, 191, 0.2)',
                'rgba(255, 0, 106, 0.2)'
            ],
            borderColor: [
                'rgba(255, 0, 0, 1)',
                //'rgba(255, 94, 0, 1)',
                'rgba(255, 174, 0, 1)',
                //'rgba(255, 242, 0, 1)',
                'rgba(195, 255, 0, 1)',
                //'rgba(119, 255, 0, 1)',
                'rgba(21, 255, 0, 1)',
                //'rgba(0, 255, 140, 1)',
                'rgba(0, 255, 217, 1)',
                //'rgba(0, 229, 255, 1)',
                'rgba(0, 166, 255, 1)',
                //'rgba(0, 94, 255, 1)',
                'rgba(30, 0, 255, 1)',
                //'rgba(115, 0, 255, 1)',
                'rgba(153, 0, 255, 1)',
                //'rgba(195, 0, 255, 1)',
                'rgba(251, 0, 255, 1)',
                //'rgba(255, 0, 191, 1)',
                'rgba(255, 0, 106, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },
        plugins: {
            title: {
                display: true,
                text: 'Total de Orgens de Serviço por dia nos últimos 7 dias.'
            }
        },
    }
});

var ctx = document.getElementById('grafico2').getContext('2d');
var grafico1 = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
            '$mes0',
            '$mes1',
            '$mes2',
            '$mes3',
            '$mes4',
            '$mes5'
        ],
        datasets: [{
            label: 'Total',
            data: [
                $quantidadeMes[0],
                $quantidadeMes[1],
                $quantidadeMes[2],
                $quantidadeMes[3],
                $quantidadeMes[4],
                $quantidadeMes[5]
            ],
            backgroundColor: [
                'rgba(255, 0, 0, 0.2)',
                //'rgba(255, 94, 0, 0.2)',
                'rgba(255, 174, 0, 0.2)',
                //'rgba(255, 242, 0, 0.2)',
                'rgba(195, 255, 0, 0.2)',
                //'rgba(119, 255, 0, 0.2)',
                'rgba(21, 255, 0, 0.2)',
                //'rgba(0, 255, 140, 0.2)',
                'rgba(0, 255, 217, 0.2)',
                //'rgba(0, 229, 255, 0.2)',
                'rgba(0, 166, 255, 0.2)',
                //'rgba(0, 94, 255, 0.2)',
                'rgba(30, 0, 255, 0.2)',
                //'rgba(115, 0, 255, 0.2)',
                'rgba(153, 0, 255, 0.2)',
                //'rgba(195, 0, 255, 0.2)',
                'rgba(251, 0, 255, 0.2)',
                //'rgba(255, 0, 191, 0.2)',
                'rgba(255, 0, 106, 0.2)'
            ],
            borderColor: [
                'rgba(255, 0, 0, 1)',
                //'rgba(255, 94, 0, 1)',
                'rgba(255, 174, 0, 1)',
                //'rgba(255, 242, 0, 1)',
                'rgba(195, 255, 0, 1)',
                //'rgba(119, 255, 0, 1)',
                'rgba(21, 255, 0, 1)',
                //'rgba(0, 255, 140, 1)',
                'rgba(0, 255, 217, 1)',
                //'rgba(0, 229, 255, 1)',
                'rgba(0, 166, 255, 1)',
                //'rgba(0, 94, 255, 1)',
                'rgba(30, 0, 255, 1)',
                //'rgba(115, 0, 255, 1)',
                'rgba(153, 0, 255, 1)',
                //'rgba(195, 0, 255, 1)',
                'rgba(251, 0, 255, 1)',
                //'rgba(255, 0, 191, 1)',
                'rgba(255, 0, 106, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },
        plugins: {
            title: {
                display: true,
                text: 'Total de Orgens de Serviço por mês nos últimos 6 meses.'
            }
        }
    }
});

var ctx = document.getElementById('grafico3').getContext('2d');
var grafico1 = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
            '$mes0',
            '$mes1',
            '$mes2',
            '$mes3',
            '$mes4',
            '$mes5',
        ],
        datasets: [{
            label: 'Minutos',
            data: [
                ".(int)@$mediaMes0.",
                ".(int)@$mediaMes1.",
                ".(int)@$mediaMes2.",
                ".(int)@$mediaMes3.",
                ".(int)@$mediaMes4.",
                ".(int)@$mediaMes5."
            ],
            backgroundColor: [
                'rgba(255, 0, 0, 0.2)',
                //'rgba(255, 94, 0, 0.2)',
                'rgba(255, 174, 0, 0.2)',
                //'rgba(255, 242, 0, 0.2)',
                'rgba(195, 255, 0, 0.2)',
                //'rgba(119, 255, 0, 0.2)',
                'rgba(21, 255, 0, 0.2)',
                //'rgba(0, 255, 140, 0.2)',
                'rgba(0, 255, 217, 0.2)',
                //'rgba(0, 229, 255, 0.2)',
                'rgba(0, 166, 255, 0.2)',
                //'rgba(0, 94, 255, 0.2)',
                'rgba(30, 0, 255, 0.2)',
                //'rgba(115, 0, 255, 0.2)',
                'rgba(153, 0, 255, 0.2)',
                //'rgba(195, 0, 255, 0.2)',
                'rgba(251, 0, 255, 0.2)',
                //'rgba(255, 0, 191, 0.2)',
                'rgba(255, 0, 106, 0.2)'
            ],
            borderColor: [
                'rgba(255, 0, 0, 1)',
                //'rgba(255, 94, 0, 1)',
                'rgba(255, 174, 0, 1)',
                //'rgba(255, 242, 0, 1)',
                'rgba(195, 255, 0, 1)',
                //'rgba(119, 255, 0, 1)',
                'rgba(21, 255, 0, 1)',
                //'rgba(0, 255, 140, 1)',
                'rgba(0, 255, 217, 1)',
                //'rgba(0, 229, 255, 1)',
                'rgba(0, 166, 255, 1)',
                //'rgba(0, 94, 255, 1)',
                'rgba(30, 0, 255, 1)',
                //'rgba(115, 0, 255, 1)',
                'rgba(153, 0, 255, 1)',
                //'rgba(195, 0, 255, 1)',
                'rgba(251, 0, 255, 1)',
                //'rgba(255, 0, 191, 1)',
                'rgba(255, 0, 106, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },
        plugins: {
            title: {
                display: true,
                text: 'Média de tempo para atendimento por mês nos últimos 6 meses.'
            }
        }
    }
});

var ctx = document.getElementById('grafico4').getContext('2d');
var grafico1 = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [";
            foreach($resultadosTop10 as $resultadoTop10){
                echo "'"."$resultadoTop10->registros - "."$resultadoTop10->descricao',";
            }
            echo "],
        datasets: [{
            label: 'Ordens de Serviço',
            data: [";
            foreach($resultadosTop10 as $resultadoTop10){
                echo "'$resultadoTop10->registros',";
            }
            echo "],
            backgroundColor: [
                'rgba(255, 0, 0, 0.2)',
                //'rgba(255, 94, 0, 0.2)',
                'rgba(255, 174, 0, 0.2)',
                //'rgba(255, 242, 0, 0.2)',
                'rgba(195, 255, 0, 0.2)',
                //'rgba(119, 255, 0, 0.2)',
                'rgba(21, 255, 0, 0.2)',
                //'rgba(0, 255, 140, 0.2)',
                'rgba(0, 255, 217, 0.2)',
                //'rgba(0, 229, 255, 0.2)',
                'rgba(0, 166, 255, 0.2)',
                //'rgba(0, 94, 255, 0.2)',
                'rgba(30, 0, 255, 0.2)',
                //'rgba(115, 0, 255, 0.2)',
                'rgba(153, 0, 255, 0.2)',
                //'rgba(195, 0, 255, 0.2)',
                'rgba(251, 0, 255, 0.2)',
                //'rgba(255, 0, 191, 0.2)',
                'rgba(255, 0, 106, 0.2)'
            ],
            borderColor: [
                'rgba(255, 0, 0, 1)',
                //'rgba(255, 94, 0, 1)',
                'rgba(255, 174, 0, 1)',
                //'rgba(255, 242, 0, 1)',
                'rgba(195, 255, 0, 1)',
                //'rgba(119, 255, 0, 1)',
                'rgba(21, 255, 0, 1)',
                //'rgba(0, 255, 140, 1)',
                'rgba(0, 255, 217, 1)',
                //'rgba(0, 229, 255, 1)',
                'rgba(0, 166, 255, 1)',
                //'rgba(0, 94, 255, 1)',
                'rgba(30, 0, 255, 1)',
                //'rgba(115, 0, 255, 1)',
                'rgba(153, 0, 255, 1)',
                //'rgba(195, 0, 255, 1)',
                'rgba(251, 0, 255, 1)',
                //'rgba(255, 0, 191, 1)',
                'rgba(255, 0, 106, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },
        plugins: {
            title: {
                display: true,
                text: 'Top 10 abertura de Ordens de Serviço.'
            }
        }
    }
});

var ctx = document.getElementById('grafico5').getContext('2d');
var grafico1 = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [";
            foreach($usuariosAtendimentos as $usuarioAtendimentos):
            echo "'"."$usuarioAtendimentos->atendimentos - "."$usuarioAtendimentos->usuarioatendimento',";
            endforeach;
        echo "],
        datasets: [{
            label: 'Atendimentos por usuário',
            data: [";
                foreach($usuariosAtendimentos as $usuarioAtendimentos):
                echo "'$usuarioAtendimentos->atendimentos',";
                endforeach;
            echo "],
            backgroundColor: [
                'rgba(255, 0, 0, 0.2)',
                //'rgba(255, 94, 0, 0.2)',
                'rgba(255, 174, 0, 0.2)',
                //'rgba(255, 242, 0, 0.2)',
                'rgba(195, 255, 0, 0.2)',
                //'rgba(119, 255, 0, 0.2)',
                'rgba(21, 255, 0, 0.2)',
                //'rgba(0, 255, 140, 0.2)',
                'rgba(0, 255, 217, 0.2)',
                //'rgba(0, 229, 255, 0.2)',
                'rgba(0, 166, 255, 0.2)',
                //'rgba(0, 94, 255, 0.2)',
                'rgba(30, 0, 255, 0.2)',
                //'rgba(115, 0, 255, 0.2)',
                'rgba(153, 0, 255, 0.2)',
                //'rgba(195, 0, 255, 0.2)',
                'rgba(251, 0, 255, 0.2)',
                //'rgba(255, 0, 191, 0.2)',
                'rgba(255, 0, 106, 0.2)'
            ],
            borderColor: [
                'rgba(255, 0, 0, 1)',
                //'rgba(255, 94, 0, 1)',
                'rgba(255, 174, 0, 1)',
                //'rgba(255, 242, 0, 1)',
                'rgba(195, 255, 0, 1)',
                //'rgba(119, 255, 0, 1)',
                'rgba(21, 255, 0, 1)',
                //'rgba(0, 255, 140, 1)',
                'rgba(0, 255, 217, 1)',
                //'rgba(0, 229, 255, 1)',
                'rgba(0, 166, 255, 1)',
                //'rgba(0, 94, 255, 1)',
                'rgba(30, 0, 255, 1)',
                //'rgba(115, 0, 255, 1)',
                'rgba(153, 0, 255, 1)',
                //'rgba(195, 0, 255, 1)',
                'rgba(251, 0, 255, 1)',
                //'rgba(255, 0, 191, 1)',
                'rgba(255, 0, 106, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },
        plugins: {
            title: {
                display: true,
                text: 'Total de atendimentos por usuário'
            }
        }
    }
});
</script>
";
?>