<?php
/**
 * Index
 * Carrega estrutura em HTML5
 * index.php
 * 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/* Clasee de interação com o PostgreSQL */
require_once "../class/pgsql.class.php";
$pg = new PgSql();

/* URL Recuperada do Banco de Dados */
$url = $pg->getCol("SELECT valor FROM db_clti.tb_config WHERE parametro='URL'");

include "../head.php";

include "../nav.php";

@$cmd = $_GET['cmd'];

/* Montagem do grid html5 conforme módulo solicidade */
switch ($cmd) {
	case 'pessoalti':
		echo "
        <main role=\"main\" class=\"col-md-9 ml-sm-auto col-lg-10 px-4\">
          <div class=\"d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom\">
            <h1 class=\"h2\">Gerenciamento - Tipos de CLTI</h1>
            <div class=\"btn-toolbar mb-2 mb-md-0\">
              <div class=\"btn-group mr-2\">
                <a href=\"?cmd=pessoalti\"><button class=\"btn btn-sm btn-outline-secondary\">Pessoal de TI</button></a>
                <a href=\"?cmd=pessoalti&actn=cad\"><button class=\"btn btn-sm btn-outline-secondary\">Cadastro</button></a>
              </div>
              <!--<button class=\"btn btn-sm btn-outline-secondary dropdown-toggle\">
                <span data-feather=\"calendar\"></span>
                Esta Semana
              </button>-->
            </div>
          </div>";
		include "pessoalti.inc.php";
		echo"
		</main>
      </div>
    </div>";

		break;

	case 'cursosti':
		echo "
        <main role=\"main\" class=\"col-md-9 ml-sm-auto col-lg-10 px-4\">
          <div class=\"d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom\">
            <h1 class=\"h2\">Gerenciamento - CLTI Ativo</h1>
            <div class=\"btn-toolbar mb-2 mb-md-0\">
              <div class=\"btn-group mr-2\">
                <a href=\"?cmd=cursosti\"><button class=\"btn btn-sm btn-outline-secondary\">Cursos de TI</button></a>
                <a href=\"?cmd=cursosti&act=cad\"><button class=\"btn btn-sm btn-outline-secondary\">Cadastro</button></a>
              </div>
              <!--<button class=\"btn btn-sm btn-outline-secondary dropdown-toggle\">
                <span data-feather=\"calendar\"></span>
                Esta Semana
              </button>-->
            </div>
          </div>";
		include "cursosti.inc.php";
		echo"
		</main>
      </div>
    </div>";

		break;
	
	default:

		echo "
        <main role=\"main\" class=\"col-md-9 ml-sm-auto col-lg-10 px-4\">
          <div class=\"d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom\">
            <h1 class=\"h2\">Módulo de Gerenciamento do Pessoal de TI</h1>
            <div class=\"btn-toolbar mb-2 mb-md-0\">
              <div class=\"btn-group mr-2\">
                <a href=\"?cmd=pessoalti\"><button class=\"btn btn-sm btn-outline-secondary\">Pessoal de TI</button></a>
                <a href=\"?cmd=cursosti\"><button class=\"btn btn-sm btn-outline-secondary\">Cursos de TI</button></a>
              </div>
              <!--<button class=\"btn btn-sm btn-outline-secondary dropdown-toggle\">
                <span data-feather=\"calendar\"></span>
                Esta Semana
              </button>-->
            </div>
          </div>
          <p>OM Apoiadas: ".$pg->getCol("SELECT COUNT(idtb_om_apoiadas)
            FROM db_clti.tb_om_apoiadas;")." OM</p>
          <p>Servidores: xx Servidores</p>
          <p>Estações de Trabalho (ET): xx Estações de Trabalho</p>
          <p>Pessoal de TI (OM Apoiadas): xx Técnicos de TI</p>
          <p>Chamados Totais: xx Chamados</p>
          <p>Chamados no Mês Corrente: xx Chamados</p>
          <p>Incidentes de TIC Relatados: xx Incidentes</p>
          <p>Tráfego do Correio Eletrônico (Mês Anterior): xx Mensagens</p>
          <p>Usuários do Correio Eletrônico: xx Usuários</p>
          <p>Tráfego de Dados Estimado de Correio Eletrônico: xx Gigabytes</p>
          <p>Tráfego de Dados Total Estimado (Backbone CLTI): xx Gigabytes</p>
		    </main>
      </div>
    </div>";
		break;
}

include "../foot.php";
?>