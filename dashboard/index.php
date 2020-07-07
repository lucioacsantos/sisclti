<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/* Clasee de interação com o PostgreSQL */
require_once "../class/pgsql.class.php";
$pg = new PgSql();

/* URL Recuperada do Banco de Dados */
$url = $pg->getCol("SELECT valor FROM db_clti.tb_config WHERE parametro='URL'");

include "../head.php";

include "../nav.php";

?>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <?php echo "<h1 class=\"h2\">ATIVOS DE TI - ".$sigla."</h1>"; ?>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                <!--<button class="btn btn-sm btn-outline-secondary">Enviar</button>
                <button class="btn btn-sm btn-outline-secondary">Exportar</button>-->
                </div>
                <!--<button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                    <span data-feather="calendar"></span>
                    Esta Semana
                </button>-->
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col">
                    <canvas class="my-4 w-100" id="grafico_barras_om" width="900" height="380"></canvas>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <canvas class="my-4 w-100" id="grafico_barras" width="900" height="380"></canvas>
                </div>
                <div class="col">
                    <canvas class="my-4 w-100" id="ativos_ti" width="900" height="380"></canvas>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <canvas class="my-4 w-100" id="pessoal_ti" width="900" height="380"></canvas>
                </div>
                <div class="col">
                    <canvas class="my-4 w-100" id="qualificacao_ti" width="900" height="380"></canvas>
                </div>
            </div>
        </div>
    </main>
    </div>
    </div>

<?php
include "../foot.php";
?>