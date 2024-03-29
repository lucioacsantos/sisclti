<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/* ClasSe de interação com o PostgreSQL */
require_once "../class/constantes.inc.php";
$config = new Config();
$om = new OMApoiadas();
$pesti = new PessoalTI();
$srv = new Servidores();
$et = new Estacoes();
$conect = new Conectividade();
$cont = new Contadores();
$qtdeom = $om->CountOMApoiadas();
$qtdeadmin = $pesti->CountAdmin();
$qtdeosic = $pesti->CountOSIC();
$qtdepesti = $pesti->CountPesTI();
$qtdesrv = $srv->CountSrv();
$qtdeet = $et->CountET();
$qtdeconect = $conect->CountConect();
$email_admin = '';
$email_osic = '';

foreach ($pesti->SelectEmailAdmin() as $key => $value){
  $email_admin = $email_admin." ".$value->correio_eletronico;

}

foreach ($pesti->SelectEmailOSIC() as $key => $value){
  $email_osic = $email_osic." ".$value->correio_eletronico;

}



/* URL Recuperada do Banco de Dados */
$url = $config->SelectURL();

include_once "../head.php";

include_once "../nav.php";

@$cmd = $_GET['cmd'];

if (isset($_SESSION['user_name'])){
  $perfil = $_SESSION['perfil']; 
  if ($perfil == 'TEC_CLTI'){

    /* Montagem do grid html5 conforme módulo solicitado */
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
                </div>
              </div>";
        include_once "tipoclti.inc.php";
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
                </div>
              </div>";
        include_once "gerclti.inc.php";
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
                    <a href=\"?cmd=lotclti&act=calcula\"><button class=\"btn btn-sm btn-outline-secondary\">Calcular Lotação</button></a>
                    <a href=\"?cmd=lotclti&act=inativos\"><button class=\"btn btn-sm btn-outline-secondary\">Inativos</button></a>
                    <a href=\"?cmd=lotclti&act=aprovrelsv\"><button class=\"btn btn-sm btn-outline-secondary\">Aprovador Rel. Serviço</button></a>
                    <a href=\"?cmd=lotclti&act=servico\"><button class=\"btn btn-sm btn-outline-secondary\">Escala de Serviço</button></a>
                  </div>
                </div>
              </div>";
        include_once "lotclti.inc.php";
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
                    <a href=\"?cmd=qualificacao&act=concluidos\"><button class=\"btn btn-sm btn-outline-secondary\">Concluídos</button></a>
                    <a href=\"?cmd=qualificacao&act=andamento\"><button class=\"btn btn-sm btn-outline-secondary\">Em Andamento</button></a>
                    <a href=\"?cmd=qualificacao&act=cad\"><button class=\"btn btn-sm btn-outline-secondary\">Cadastro</button></a>
                  </div>
                </div>
              </div>";
        include_once "qualificacao.inc.php";
        echo"
        </main>
          </div>
        </div>";
  
      break;

      case 'qualificacaoom':
        echo "
            <main role=\"main\" class=\"col-md-9 ml-sm-auto col-lg-10 px-4\">
              <div class=\"d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom\">
                <h1 class=\"h2\">Qualificação em TI das OM Apoiadas</h1>
                <div class=\"btn-toolbar mb-2 mb-md-0\">
                  <div class=\"btn-group mr-2\">
                    
                  </div>
                </div>
              </div>";
        include_once "qualificacaoom.inc.php";
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
                </div>
              </div>";
        include_once "omapoiadas.inc.php";
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
                    <a onClick=\"javascript:window.open('mailto:".$email_osic."', 'mail');event.preventDefault()\" 
                      href=\"mailto:".$email_osic."\"><button class=\"btn btn-sm btn-outline-secondary\">E-mail</button></a>
                    <a href=\"?cmd=osic\"><button class=\"btn btn-sm btn-outline-secondary\">
                      OSIC das OM</button></a>
                    <a href=\"?cmd=osic&act=cad\"><button class=\"btn btn-sm btn-outline-secondary\">Cadastro</button></a>
                  </div>
                </div>
              </div>";
        include_once "osic.inc.php";
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
                    <a onClick=\"javascript:window.open('mailto:".$email_admin."', 'mail');event.preventDefault()\" 
                      href=\"mailto:".$email_admin."\"><button class=\"btn btn-sm btn-outline-secondary\">E-mail</button></a>
                    <a href=\"?cmd=admin\"><button class=\"btn btn-sm btn-outline-secondary\">Administradores</button></a>
                    <a href=\"?cmd=admin&act=cad\"><button class=\"btn btn-sm btn-outline-secondary\">Cadastro</button></a>
                  </div>
                </div>
              </div>";
        include_once "admin.inc.php";
        echo"
        </main>
          </div>
        </div>";

      break;

      case 'pessoalti':
        echo "
            <main role=\"main\" class=\"col-md-9 ml-sm-auto col-lg-10 px-4\">
              <div class=\"d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom\">
                <h1 class=\"h2\">Pessoal de TI das OM Apoiadas</h1>
                <div class=\"btn-toolbar mb-2 mb-md-0\">
                  <div class=\"btn-group madminr-2\">
                    
                  </div>
                </div>
              </div>";
        include_once "pessoalti.inc.php";
        echo"
        </main>
          </div>
        </div>";

      break;

      case 'funcoesti':
          echo "
              <main role=\"main\" class=\"col-md-9 ml-sm-auto col-lg-10 px-4\">
                <div class=\"d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom\">
                  <h1 class=\"h2\">Gerenciamento - Funções de TI</h1>
                  <div class=\"btn-toolbar mb-2 mb-md-0\">
                    <div class=\"btn-group madminr-2\">
                      <a href=\"?cmd=funcoesti\"><button class=\"btn btn-sm btn-outline-secondary\">Funções de TI</button></a>
                      <a href=\"?cmd=funcoesti&act=cad\"><button class=\"btn btn-sm btn-outline-secondary\">Cadastro</button></a>
                    </div>
                  </div>
                </div>";
          include_once "funcoesti.inc.php";
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
                </div>
              </div>";
        include_once "sistema.inc.php";
        echo"
        </main>
          </div>
        </div>";
    
      break;

      case 'perfilinternet':
        echo "
            <main role=\"main\" class=\"col-md-9 ml-sm-auto col-lg-10 px-4\">
              <div class=\"d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom\">
                <h1 class=\"h2\">Perfis de Internet</h1>
                <div class=\"btn-toolbar mb-2 mb-md-0\">
                  <div class=\"btn-group mr-2\">
                    <a href=\"?cmd=perfilinternet\"><button class=\"btn btn-sm btn-outline-secondary\">
                      Perfis</button></a>
                    <a href=\"?cmd=perfilinternet&act=cad\"><button class=\"btn btn-sm btn-outline-secondary\">
                      Cadastro</button></a>
                  </div>
                </div>
              </div>";
        include_once "perfilinternet.inc.php";
        echo"
        </main>
          </div>
        </div>";
    
      break;

      case 'monitoramento':
        echo "
            <main role=\"main\" class=\"col-md-9 ml-sm-auto col-lg-10 px-4\">
              <div class=\"d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom\">
                <h1 class=\"h2\">Monitoramento</h1>
                <div class=\"btn-toolbar mb-2 mb-md-0\">
                  <div class=\"btn-group mr-2\">
                    <a href=\"?cmd=monitoramento\"><button class=\"btn btn-sm btn-outline-secondary\">
                      Perfis</button></a>
                    <a href=\"?cmd=monitoramento&act=cad\"><button class=\"btn btn-sm btn-outline-secondary\">
                      Cadastro</button></a>
                  </div>
                </div>
              </div>";
        include_once "monitoramento.inc.php";
        echo"
        </main>
          </div>
        </div>";
    
      break;

      case 'detsv':
        echo "
            <main role=\"main\" class=\"col-md-9 ml-sm-auto col-lg-10 px-4\">
              <div class=\"d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom\">
                <h1 class=\"h2\">Detalhe de Serviço</h1>
                <div class=\"btn-toolbar mb-2 mb-md-0\">
                  <div class=\"btn-group mr-2\">
                    <a href=\"?cmd=detsv\"><button class=\"btn btn-sm btn-outline-secondary\">
                      Detalhe de Serviço</button></a>
                    <a href=\"?cmd=detsv&act=cad\"><button class=\"btn btn-sm btn-outline-secondary\">
                      Cadastro</button></a>
                  </div>
                </div>
              </div>";
        include_once "detsv.inc.php";
        echo"
        </main>
          </div>
        </div>";
    
      break;

      case 'relservico':
        echo "
            <main role=\"main\" class=\"col-md-9 ml-sm-auto col-lg-10 px-4\">
              <div class=\"d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom\">
                <h1 class=\"h2\">Relatório de Serviço</h1>
                <div class=\"btn-toolbar mb-2 mb-md-0\">
                  <div class=\"btn-group mr-2\">
                    <a href=\"?cmd=detsv\"><button class=\"btn btn-sm btn-outline-secondary\">
                      Detalhe de Serv.</button></a>
                    <a href=\"?cmd=relservico\"><button class=\"btn btn-sm btn-outline-secondary\">
                      Em Andamento</button></a>
                    <a href=\"?cmd=relservico&act=encerrados\"><button class=\"btn btn-sm btn-outline-secondary\">
                      Encerrados</button></a>
                    <a href=\"?cmd=relservico&act=aprovados\"><button class=\"btn btn-sm btn-outline-secondary\">
                      Aprovados</button></a>
                  </div>
                </div>
              </div>";
        include_once "relservico.inc.php";
        echo"
        </main>
          </div>
        </div>";
    
      break;

      case 'relservicov2':
        echo "
        <main role=\"main\" class=\"col-md-9 ml-sm-auto col-lg-10 px-4\">
          <div class=\"d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom\">
            <h1 class=\"h2\">Relatório de Serviço</h1>
            <div class=\"btn-toolbar mb-2 mb-md-0\">
              <div class=\"btn-group mr-2\">
                <a href=\"?cmd=detsv\"><button class=\"btn btn-sm btn-outline-secondary\">
                  Detalhe de Serv.</button></a>
                <a href=\"?cmd=relservicov2&act=configrel\"><button class=\"btn btn-sm btn-outline-secondary\">
                  Configurar Relatório</button></a>
                <a href=\"?cmd=relservicov2\"><button class=\"btn btn-sm btn-outline-secondary\">
                  Em Andamento</button></a>
                <a href=\"?cmd=relservicov2&act=encerrados\"><button class=\"btn btn-sm btn-outline-secondary\">
                  Encerrados</button></a>
                <a href=\"?cmd=relservicov2&act=aprovados\"><button class=\"btn btn-sm btn-outline-secondary\">
                  Aprovados</button></a>
              </div>
            </div>
          </div>";
        include_once "relservicov2.inc.php";
      echo"
        </main>
        </div>
        </div>";
      
      break;

      case 'seguranca':
        echo "
            <main role=\"main\" class=\"col-md-9 ml-sm-auto col-lg-10 px-4\">
              <div class=\"d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom\">
                <h1 class=\"h2\">Segurança do Ambiente</h1>
                <div class=\"btn-toolbar mb-2 mb-md-0\">
                  <div class=\"btn-group mr-2\">
                    <a href=\"?cmd=seguranca&act=bloqueados\"><button class=\"btn btn-sm btn-outline-secondary\">
                      Usuários Bloqueados</button></a>
                    <a href=\"?cmd=seguranca&act=ZeraContador\"><button class=\"btn btn-sm btn-outline-secondary\">
                      Reset Contadores</button></a>
                  </div>
                </div>
              </div>";
        include_once "seguranca.inc.php";
        echo"
        </main>
          </div>
        </div>";
    
      break;

      case 'midiabackup':
        echo "
            <main role=\"main\" class=\"col-md-9 ml-sm-auto col-lg-10 px-4\">
              <div class=\"d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom\">
                <h1 class=\"h2\">Gerência de Backup</h1>
                <div class=\"btn-toolbar mb-2 mb-md-0\">
                  <div class=\"btn-group mr-2\">
                    <a href=\"?cmd=midiabackup\"><button class=\"btn btn-sm btn-outline-secondary\">
                      Mídias de Backup</button></a>
                    <a href=\"?cmd=midiabackup&act=cad_midia\"><button class=\"btn btn-sm btn-outline-secondary\">
                      Cad. Mídias</button></a>
                    <a href=\"?cmd=midiabackup&act=tipos_midia\"><button class=\"btn btn-sm btn-outline-secondary\">
                      Tipos de Mídia</button></a>
                    <a href=\"?cmd=midiabackup&act=cad_tipo\"><button class=\"btn btn-sm btn-outline-secondary\">
                      Cad. Tipo</button></a>
                    <a href=\"?cmd=midiabackup&act=srv_bk\"><button class=\"btn btn-sm btn-outline-secondary\">
                      Servidor de Backup</button></a>
                    <a href=\"?cmd=midiabackup&act=cad_srv\"><button class=\"btn btn-sm btn-outline-secondary\">
                      Cad. Srv. Backup</button></a>
                  </div>
                </div>
              </div>";
        include_once "midiabackup.inc.php";
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
                    <a href=\"$url/update.php\"><button class=\"btn btn-sm btn-outline-secondary\">Atualizar</button></a>
                  </div>
                  <!--<button class=\"btn btn-sm btn-outline-secondary dropdown-toggle\">
                    <span data-feather=\"calendar\"></span>
                    Esta Semana
                  </button>-->
                </div>
              </div>
              <p>OM Apoiadas: ".$qtdeom." OM</p>
              <p>Pessoal de TI (Admin): ".$qtdeadmin."</p>
              <p>Pessoal de TI (OSIC): ".$qtdeosic."</p>
              <p>Pessoal de TI (Manutenção/Suporte): ".$qtdepesti."</p>
              <p>Servidores (Total): ".$qtdesrv."</p>
              <p>Estações de Trabalho (Total): ".$qtdeet."</p>
              <p>Equipamentos de Conectividade (Total): ".$qtdeconect."</p>
              <!--<p>Chamados Totais: xx Chamados</p>
              <p>Chamados no Mês Corrente: xx Chamados</p>
              <p>Incidentes de TIC Relatados: xx Incidentes</p>
              <p>Tráfego do Correio Eletrônico (Mês Anterior): xx Mensagens</p>
              <p>Usuários do Correio Eletrônico: xx Usuários</p>
              <p>Tráfego de Dados Estimado de Correio Eletrônico: xx Gigabytes</p>
              <p>Tráfego de Dados Total Estimado (Backbone CLTI): xx Gigabytes</p>-->
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
include_once "../foot.php";
?>
