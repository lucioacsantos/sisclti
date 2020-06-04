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

@$cmd = $_GET['cmd'];

if (isset($_SESSION['user_name'])){
  $perfil = $_SESSION['perfil']; 
  if ($perfil == 'TEC_CLTI'){

    /* Montagem do grid html5 conforme módulo solicidade */
    switch ($cmd) {
      case 'tipoclti':
        echo "
            <main role=\"main\" class=\"col-md-9 ml-sm-auto col-lg-10 px-4\">
              <div class=\"d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom\">
                <h1 class=\"h2\">Gerenciamento - Tipos de CLTI</h1>
                <div class=\"btn-toolbar mb-2 mb-md-0\">
                  <div class=\"btn-group mr-2\">
                    <a href=\"?cmd=gerclti\"><button class=\"btn btn-sm btn-outline-secondary\">Gerenciamento do CLTI</button></a>
                  </div>
                  <!--<button class=\"btn btn-sm btn-outline-secondary dropdown-toggle\">
                    <span data-feather=\"calendar\"></span>
                    Esta Semana
                  </button>-->
                </div>
              </div>";
        include "tipoclti.inc.php";
        echo"
        </main>
          </div>
        </div>";

        break;

      case 'gerclti':
        echo "
            <main role=\"main\" class=\"col-md-9 ml-sm-auto col-lg-10 px-4\">
              <div class=\"d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom\">
                <h1 class=\"h2\">Gerenciamento - CLTI Ativo</h1>
                <div class=\"btn-toolbar mb-2 mb-md-0\">
                  <div class=\"btn-group mr-2\">
                    <a href=\"?cmd=gerclti\"><button class=\"btn btn-sm btn-outline-secondary\">Dados do CLTI</button></a>
                  </div>
                  <!--<button class=\"btn btn-sm btn-outline-secondary dropdown-toggle\">
                    <span data-feather=\"calendar\"></span>
                    Esta Semana
                  </button>-->
                </div>
              </div>";
        include "gerclti.inc.php";
        echo"
        </main>
          </div>
        </div>";

        break;

      case 'lotclti':
        echo "
            <main role=\"main\" class=\"col-md-9 ml-sm-auto col-lg-10 px-4\">
              <div class=\"d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom\">
                <h1 class=\"h2\">Gerenciamento - Lotação do CLTI</h1>
                <div class=\"btn-toolbar mb-2 mb-md-0\">
                  <div class=\"btn-group mr-2\">
                    <a href=\"?cmd=lotclti\"><button class=\"btn btn-sm btn-outline-secondary\">Efetivo do CLTI</button></a>
                    <a href=\"?cmd=lotclti&act=cad\"><button class=\"btn btn-sm btn-outline-secondary\">Cadastro</button></a>
                  </div>
                  <!--<button class=\"btn btn-sm btn-outline-secondary dropdown-toggle\">
                    <span data-feather=\"calendar\"></span>
                    Esta Semana
                  </button>-->
                </div>
              </div>";
        include "lotclti.inc.php";
        echo"
        </main>
          </div>
        </div>";

        break;

        case 'qualificacao':
          echo "
              <main role=\"main\" class=\"col-md-9 ml-sm-auto col-lg-10 px-4\">
                <div class=\"d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom\">
                  <h1 class=\"h2\">Gerenciamento - Lotação do CLTI</h1>
                  <div class=\"btn-toolbar mb-2 mb-md-0\">
                    <div class=\"btn-group mr-2\">
                      <a href=\"?cmd=qualificacao\"><button class=\"btn btn-sm btn-outline-secondary\">Cursos Pessoal do CLTI</button></a>
                      <a href=\"?cmd=qualificacao&act=cad\"><button class=\"btn btn-sm btn-outline-secondary\">Cadastro</button></a>
                    </div>
                    <!--<button class=\"btn btn-sm btn-outline-secondary dropdown-toggle\">
                      <span data-feather=\"calendar\"></span>
                      Esta Semana
                    </button>-->
                  </div>
                </div>";
          include "qualificacao.inc.php";
          echo"
          </main>
            </div>
          </div>";
  
          break;

        case 'omapoiadas':
        echo "
            <main role=\"main\" class=\"col-md-9 ml-sm-auto col-lg-10 px-4\">
              <div class=\"d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom\">
                <h1 class=\"h2\">Gerenciamento - OM Apoiadas pelo CLTI</h1>
                <div class=\"btn-toolbar mb-2 mb-md-0\">
                  <div class=\"btn-group mr-2\">
                    <a href=\"?cmd=omapoiadas\"><button class=\"btn btn-sm btn-outline-secondary\">OM Apoiadas</button></a>
                    <a href=\"?cmd=omapoiadas&act=cad\"><button class=\"btn btn-sm btn-outline-secondary\">Nova OM</button></a>
                  </div>
                  <!--<button class=\"btn btn-sm btn-outline-secondary dropdown-toggle\">
                    <span data-feather=\"calendar\"></span>
                    Esta Semana
                  </button>-->
                </div>
              </div>";
        include "omapoiadas.inc.php";
        echo"
        </main>
          </div>
        </div>";

        break;

        case 'osic':
        echo "
            <main role=\"main\" class=\"col-md-9 ml-sm-auto col-lg-10 px-4\">
              <div class=\"d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom\">
                <h1 class=\"h2\">Gerenciamento - OSIC das OM Apoiadas</h1>
                <div class=\"btn-toolbar mb-2 mb-md-0\">
                  <div class=\"btn-group mr-2\">
                    <a href=\"?cmd=osic\"><button class=\"btn btn-sm btn-outline-secondary\">
                      OSIC das OM</button></a>
                    <a href=\"?cmd=osic&act=cad\"><button class=\"btn btn-sm btn-outline-secondary\">Cadastro</button></a>
                  </div>
                  <!--<button class=\"btn btn-sm btn-outline-secondary dropdown-toggle\">
                    <span data-feather=\"calendar\"></span>
                    Esta Semana
                  </button>-->
                </div>
              </div>";
        include "osic.inc.php";
        echo"
        </main>
          </div>
        </div>";

        break;

        case 'admin':
        echo "
            <main role=\"main\" class=\"col-md-9 ml-sm-auto col-lg-10 px-4\">
              <div class=\"d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom\">
                <h1 class=\"h2\">Gerenciamento - Admin das OM Apoiadas</h1>
                <div class=\"btn-toolbar mb-2 mb-md-0\">
                  <div class=\"btn-group madminr-2\">
                    <a href=\"?cmd=admin\"><button class=\"btn btn-sm btn-outline-secondary\">Administradores</button></a>
                    <a href=\"?cmd=admin&act=cad\"><button class=\"btn btn-sm btn-outline-secondary\">Cadastro</button></a>
                  </div>
                  <!--<button class=\"btn btn-sm btn-outline-secondary dropdown-toggle\">
                    <span data-feather=\"calendar\"></span>
                    Esta Semana
                  </button>-->
                </div>
              </div>";
        include "admin.inc.php";
        echo"
        </main>
          </div>
        </div>";

        break;

        case 'sistema':
          echo "
              <main role=\"main\" class=\"col-md-9 ml-sm-auto col-lg-10 px-4\">
                <div class=\"d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom\">
                  <h1 class=\"h2\">Gerenciamento - Parâmetros de Configuração</h1>
                  <div class=\"btn-toolbar mb-2 mb-md-0\">
                    <div class=\"btn-group madminr-2\">
                      <a href=\"?cmd=sistema\"><button class=\"btn btn-sm btn-outline-secondary\">Configurações</button></a>
                    </div>
                    <!--<button class=\"btn btn-sm btn-outline-secondary dropdown-toggle\">
                      <span data-feather=\"calendar\"></span>
                      Esta Semana
                    </button>-->
                  </div>
                </div>";
          include "sistema.inc.php";
          echo"
          </main>
            </div>
          </div>";
      
          break;
      
      default:

        echo "
            <main role=\"main\" class=\"col-md-9 ml-sm-auto col-lg-10 px-4\">
              <div class=\"d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom\">
                <h1 class=\"h2\">Módulo de Gerenciamento do CLTI</h1>
                <div class=\"btn-toolbar mb-2 mb-md-0\">
                  <div class=\"btn-group mr-2\">
                    <!--<a href=\"?cmd=tipoclti\"><button class=\"btn btn-sm btn-outline-secondary\">Tipo do CLTI</button></a>-->
                    <a href=\"?cmd=gerclti\"><button class=\"btn btn-sm btn-outline-secondary\">Gerenciamento do CLTI</button></a>
                    <a href=\"?cmd=sistema\"><button class=\"btn btn-sm btn-outline-secondary\">Configurações</button></a>
                  </div>
                  <!--<button class=\"btn btn-sm btn-outline-secondary dropdown-toggle\">
                    <span data-feather=\"calendar\"></span>
                    Esta Semana
                  </button>-->
                </div>
              </div>
              <p>OM Apoiadas: ".$pg->getCol("SELECT COUNT(idtb_om_apoiadas)
                FROM db_clti.tb_om_apoiadas;")." OM</p>
              <p>Pessoal de TI (Admin): ".$pg->getCol("SELECT COUNT(idtb_admin)
                FROM db_clti.tb_admin;")."</p>
              <p>Pessoal de TI (OSIC): ".$pg->getCol("SELECT COUNT(idtb_osic)
                FROM db_clti.tb_osic;")."</p>
              <p>Pessoal de TI (Manutenção/Suporte): ".$pg->getCol("SELECT COUNT(idtb_pessoal_ti)
                FROM db_clti.tb_pessoal_ti;")."</p>
              <p>Servidores (Total): ".$pg->getCol("SELECT COUNT(idtb_servidores)
                FROM db_clti.tb_servidores;")."</p>
              <p>Estações de Trabalho (Total): ".$pg->getCol("SELECT COUNT(idtb_estacoes)
                FROM db_clti.tb_estacoes;")."</p>
              <p>Equipamentos de Conectividade (Total): ".$pg->getCol("SELECT COUNT(idtb_conectividade)
                FROM db_clti.tb_conectividade;")."</p>
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
  }
  else{
    echo "<h5>Acesso não autorizado!</h5>
      <meta http-equiv=\"refresh\" content=\"5;$url\">";
  }
}


include "../foot.php";
?>