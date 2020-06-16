<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

function ativos_ti(){

    /* Classe de interação com o PostgreSQL */
    $path = dirname(__FILE__) . '';
    require_once "$path/../class/pgsql.class.php";
    $pg = new PgSql();

    $servidores = $pg->getCol("SELECT COUNT(idtb_servidores) AS qtde FROM db_clti.vw_servidores ");

    $estacoes = $pg->getCol("SELECT COUNT(idtb_estacoes) AS qtde FROM db_clti.vw_estacoes ");
    
    $conectividade = $pg->getCol("SELECT COUNT(idtb_conectividade) AS qtde FROM db_clti.vw_conectividade ");

    echo"
    <script>
        var ctx = document.getElementById(\"ativos_ti\");
        var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [\"SRV\",\"ET\",\"EQ.CONECT.\"],
            datasets: [{
            data: [\"$servidores\",\"$estacoes\",\"$conectividade\"],
            backgroundColor: [
                window.chartColors.blue,
                window.chartColors.green,
                window.chartColors.yellow,
            ],
            lineTension: 0,
            pointBackgroundColor: '#007bff'
            }]
        },
        options: {
            responsive: true,
            legend: {
                position: 'top',
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
        });
    </script>";
}
    
function pessoal_ti(){

    /* Classe de interação com o PostgreSQL */
    $path = dirname(__FILE__) . '';
    require_once "$path/../class/pgsql.class.php";
    $pg = new PgSql();

    $pessoal_ti = $pg->getRows("SELECT desc_funcao, sigla_funcao, COUNT(idtb_pessoal_ti) AS qtde FROM db_clti.vw_pessoal_ti 
        GROUP BY desc_funcao, sigla_funcao ORDER BY sigla_funcao; ");

    #$conectividade = $pg->getRows("SELECT descricao, versao, situacao, COUNT(descricao) AS qtde FROM db_clti.vw_conectividade 
    #  GROUP BY descricao, versao, situacao HAVING situacao='EM PRODUÇÃO' ORDER BY descricao, versao ");

    echo"
    <script>
        var ctx = document.getElementById(\"pessoal_ti\");
        var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [";
            foreach ($pessoal_ti as $key => $value){
                echo "\"".$value->sigla_funcao."\",";
            }
            echo"],
            datasets: [{
            data: [";
            foreach ($pessoal_ti as $key => $value){
                echo "\"".$value->qtde."\",";
            }                
            echo"],
            backgroundColor: [
                window.chartColors.blue,
                window.chartColors.green,
                window.chartColors.yellow,
            ],
            lineTension: 0,
            pointBackgroundColor: '#007bff'
            }]
        },
        options: {
            responsive: true,
            legend: {
                position: 'top',
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
        });
    </script>";
}

function qualificacao_ti(){

    /* Classe de interação com o PostgreSQL */
    $path = dirname(__FILE__) . '';
    require_once "$path/../class/pgsql.class.php";
    $pg = new PgSql();

    $pessoal_ti = $pg->getRows("SELECT funcao, descricao, COUNT(funcao) AS qtde FROM db_clti.vw_pessoal_ti 
        GROUP BY funcao, descricao ORDER BY funcao; ");

    echo"
    <script>
      var ctx = document.getElementById(\"myChart\");
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: [\"Domingo\", \"Segunda\", \"Terça\", \"Quarta\", \"Quinta\", \"Sexta\", \"Sábado\"],
          datasets: [{
            data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],
            lineTension: 0,
            backgroundColor: 'transparent',
            borderColor: '#007bff',
            borderWidth: 4,
            pointBackgroundColor: '#007bff'
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: false
              }
            }]
          },
          legend: {
            display: false,
          }
        }
      });
    </script>";
}

function grafico_barras(){

    /* Classe de interação com o PostgreSQL */
    $path = dirname(__FILE__) . '';
    require_once "$path/../class/pgsql.class.php";
    $pg = new PgSql();

    $et = $pg->getRows("SELECT COUNT(idtb_estacoes) AS qtde FROM db_clti.vw_estacoes ");
    $srv = $pg->getRows("SELECT COUNT(idtb_servidores) AS qtde FROM db_clti.vw_servidores ");
    $conec = $pg->getRows("SELECT COUNT(idtb_conectividade) AS qtde FROM db_clti.vw_conectividade ");
    $omapoiadas = $pg->getRows("SELECT * FROM db_clti.tb_om_apoiadas ORDER BY cod_om;");

    echo"
    <script>
        var color = Chart.helpers.color;
		var barChartData = {
            labels: [";
                foreach ($omapoiadas as $key => $value){
                    echo "'".$value->sigla."',";
                }
                echo"],
                datasets: [{
                label: 'Estações de Trabalho',
                backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
                borderColor: window.chartColors.blue,
                borderWidth: 1,
                data: [";
                    foreach ($et as $key => $value){
                        print "".$value->qtde.",";
                    }
                    echo "]
                },{
                label: 'Servidores',
                backgroundColor: color(window.chartColors.green).alpha(0.5).rgbString(),
                borderColor: window.chartColors.green,
                borderWidth: 1,
                data: [";
                    foreach ($srv as $key => $value){
                        print "".$value->qtde.",";
                    }
                    echo "]
                },{
                label: 'Eq. Conectividade',
                backgroundColor: color(window.chartColors.yellow).alpha(0.5).rgbString(),
                borderColor: window.chartColors.yellow,
                borderWidth: 1,
                data: [";
                    foreach ($conec as $key => $value){
                        print "".$value->qtde.",";
                    }
                    echo "]
                }]
        };
		window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myBar = new Chart(ctx, {
				type: 'bar',
				data: barChartData,
				options: {
					responsive: true,
					scales: {
						yAxes: [{
						    ticks: {
							beginAtZero: true
						    }
						}]
					    },
					legend: {
						position: 'top',
					},
					title: {
						display: false,
						text: 'Ativos de TI'
					}
				}
			});

		};

    </script>
    ";
}

function grafico_barras_om(){

    /* Classe de interação com o PostgreSQL */
    $path = dirname(__FILE__) . '';
    require_once "$path/../class/pgsql.class.php";
    $pg = new PgSql();

    if (isset($_SESSION['id_om_apoiada'])){
        $omapoiada = $_SESSION['id_om_apoiada'];
        $et = $pg->getRows("SELECT idtb_om_apoiadas, COUNT(idtb_estacoes) AS qtde FROM db_clti.vw_estacoes 
            GROUP BY idtb_om_apoiadas HAVING idtb_om_apoiadas='$omapoiada'");
        $srv = $pg->getRows("SELECT idtb_om_apoiadas, COUNT(idtb_servidores) AS qtde FROM db_clti.vw_servidores 
            GROUP BY idtb_om_apoiadas HAVING idtb_om_apoiadas='$omapoiada'");
        $conec = $pg->getRows("SELECT idtb_om_apoiadas, COUNT(idtb_conectividade) AS qtde FROM db_clti.vw_conectividade 
            GROUP BY idtb_om_apoiadas HAVING idtb_om_apoiadas='$omapoiada'");
    }
    else{
        $et = $pg->getRows("SELECT COUNT(idtb_estacoes) AS qtde FROM db_clti.vw_estacoes ");
        $srv = $pg->getRows("SELECT COUNT(idtb_servidores) AS qtde FROM db_clti.vw_servidores ");
        $conec = $pg->getRows("SELECT COUNT(idtb_conectividade) AS qtde FROM db_clti.vw_conectividade ");
        $omapoiadas = $pg->getRows("SELECT * FROM db_clti.tb_om_apoiadas ORDER BY cod_om;");
    }

    echo"
    <script>
        var color = Chart.helpers.color;
		var barChartData = {
            labels: [";
                foreach ($omapoiadas as $key => $value){
                    echo "'".$value->sigla."',";
                }
                echo"],
                datasets: [{
                label: 'Estações de Trabalho',
                backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
                borderColor: window.chartColors.blue,
                borderWidth: 1,
                data: [";
                    foreach ($et as $key => $value){
                        print "".$value->qtde.",";
                    }
                    echo "]
                },{
                label: 'Servidores',
                backgroundColor: color(window.chartColors.green).alpha(0.5).rgbString(),
                borderColor: window.chartColors.green,
                borderWidth: 1,
                data: [";
                    foreach ($srv as $key => $value){
                        print "".$value->qtde.",";
                    }
                    echo "]
                },{
                label: 'Eq. Conectividade',
                backgroundColor: color(window.chartColors.yellow).alpha(0.5).rgbString(),
                borderColor: window.chartColors.yellow,
                borderWidth: 1,
                data: [";
                    foreach ($conec as $key => $value){
                        print "".$value->qtde.",";
                    }
                    echo "]
                }]
        };
		window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myBar = new Chart(ctx, {
				type: 'bar',
				data: barChartData,
				options: {
					responsive: true,
					scales: {
						yAxes: [{
						    ticks: {
							beginAtZero: true
						    }
						}]
					    },
					legend: {
						position: 'top',
					},
					title: {
						display: false,
						text: 'Ativos de TI'
					}
				}
			});

		};

    </script>
    ";
}

?>
