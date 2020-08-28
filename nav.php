<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/* Classe de interação com o PostgreSQL */
require_once "class/constantes.inc.php";
$config = new Config();
$url = $config->SelectURL();
$sigla = $config->SelectSigla();
$versao = $config->SelectVersao();

?>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <p class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">
        <?php echo "".$sigla." - SisCLTI v".$versao.""; ?>
      </p>
      <!--<input class="form-control form-control-dark w-100" type="text" placeholder="Pesquisa" aria-label="Pesquisa">-->
      <p class="navbar-brand">
        <?php 
          if (isset($_SESSION['user_name'])){
            echo "".$_SESSION['posto_grad']." - ".$_SESSION['user_name']." - ".$_SESSION['perfil']."";
            $perfil = $_SESSION['perfil'];
          }
          else{
            // muda o valor de logged_in para false
            $_SESSION['logged_in'] = false;
            // finaliza a sessão
            session_destroy();
            // retorna para a login.php
            header('Location: '.$url.'/login.php');
          }          
        ?>
      </p>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="<?php echo "$url/logout.php"; ?>">Sair</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                  <a class="nav-link active" href="<?php echo "$url"; ?>">
                    <span data-feather="home"></span>
                    Início <span class="sr-only">(current)</span>
                  </a>
                </li>
              <?php
              if ($perfil == 'TEC_CLTI'){
                echo"
                <li class=\"nav-item\">
                  <a class=\"nav-link\" href=\"$url/dashboard\">
                    <span data-feather=\"hash\"></span>
                    Dashboard
                  </a>
                </li>
                <li class=\"nav-item\">
                  <a class=\"nav-link\" href=\"$url/clti\">
                    <span data-feather=\"settings\"></span>
                    Configurações do Sistema
                  </a>
                </li>
                <li class=\"nav-item\">
                  <a class=\"nav-link\" href=\"$url/clti/?cmd=omapoiadas\">
                    <span data-feather=\"anchor\"></span>
                    OM Apoiadas
                  </a>
                </li>
                <li class=\"nav-item\">
                  <a class=\"nav-link\" href=\"$url/clti/?cmd=lotclti\">
                    <span data-feather=\"users\"></span>
                    Lotação do CLTI
                  </a>
                </li>
                <li class=\"nav-item\">
                  <a class=\"nav-link\" href=\"$url/clti/?cmd=qualificacao\">
                    <span data-feather=\"book-open\"></span>
                    Qualificação CLTI
                  </a>
                </li>
                <li class=\"nav-item\">
                  <a class=\"nav-link\" href=\"$url/clti/?cmd=osic\">
                    <span data-feather=\"users\"></span>
                    OSIC
                  </a>
                </li>
                <li class=\"nav-item\">
                  <a class=\"nav-link\" href=\"$url/clti/?cmd=admin\">
                    <span data-feather=\"users\"></span>
                    Admin
                  </a>
                </li>
                <li class=\"nav-item\">
                  <a class=\"nav-link\" href=\"$url/clti/?cmd=funcoesti\">
                    <span data-feather=\"crosshair\"></span>
                    Funções de TI
                  </a>
                </li>
                <h6 class=\"sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted\">
                  <span>Ativos de TI</span>
                  <span data-feather=\"plus-circle\"></span>
                </h6>
                <li class=\"nav-item\">
                  <a class=\"nav-link\" href=\"$url/ativosti/?cmd=sistoperacionais\">
                    <span data-feather=\"globe\"></span>
                    Sistemas Operacionais
                  </a>
                </li>
                <li class=\"nav-item\">
                  <a class=\"nav-link\" href=\"$url/ativosti/?cmd=processadores\">
                    <span data-feather=\"cpu\"></span>
                    Processadores
                  </a>
                </li>
                <li class=\"nav-item\">
                  <a class=\"nav-link\" href=\"$url/ativosti/?cmd=memorias\">
                    <span data-feather=\"credit-card\"></span>
                    Memórias
                  </a>
                </li>
                <!--<li class=\"nav-item\">
                  <a class=\"nav-link\" href=\"$url/omapoiada/?cmd=setores\">
                    <span data-feather=\"layout\"></span>
                    Setores da OM
                  </a>
                </li>
                <li class=\"nav-item\">
                  <a class=\"nav-link\" href=\"$url/ativosti/?cmd=servidores\">
                    <span data-feather=\"server\"></span>
                    Servidores
                  </a>
                </li>
                <li class=\"nav-item\">
                  <a class=\"nav-link\" href=\"$url/ativosti/?cmd=estacoes\">
                    <span data-feather=\"monitor\"></span>
                    Estações de Trabalho
                  </a>
                </li>
                <li class=\"nav-item\">
                  <a class=\"nav-link\" href=\"$url/ativosti/?cmd=conectividade\">
                    <span data-feather=\"command\"></span>
                    Equipamentos de Conectividade
                  </a>
                </li>-->
              </ul>";
              }
              else{
                echo"
                <li class=\"nav-item\">
                  <a class=\"nav-link\" href=\"$url/omapoiada/?cmd=setores\">
                    <span data-feather=\"layout\"></span>
                    Setores da OM
                  </a>
                </li>
                <li class=\"nav-item\">
                  <a class=\"nav-link\" href=\"$url/omapoiada/?cmd=servidores\">
                    <span data-feather=\"server\"></span>
                    Servidores
                  </a>
                </li>
                <li class=\"nav-item\">
                  <a class=\"nav-link\" href=\"$url/omapoiada/?cmd=estacoes\">
                    <span data-feather=\"monitor\"></span>
                    Estações de Trabalho
                  </a>
                </li>
                <li class=\"nav-item\">
                  <a class=\"nav-link\" href=\"$url/omapoiada/?cmd=conectividade\">
                    <span data-feather=\"command\"></span>
                    Equipamentos de Conectividade
                  </a>
                </li>
                <h6 class=\"sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted\">
                    <span>Controle OM Apoiadas</span>
                    <span data-feather=\"plus-circle\"></span>
                  </h6>
                <li class=\"nav-item\">
                  <a class=\"nav-link\" href=\"$url/omapoiada/?cmd=pessoalti\">
                    <span data-feather=\"user-plus\"></span>
                    Pessoal de TI
                  </a>
                </li>
                <li class=\"nav-item\">
                  <a class=\"nav-link\" href=\"$url/omapoiada/?cmd=cursosti\">
                    <span data-feather=\"book-open\"></span>
                    Qualificação na Área de TI
                  </a>
                </li>
                <!--<li class=\"nav-item\">
                  <a class=\"nav-link\" href=\"#\">
                    <span data-feather=\"bar-chart-2\"></span>
                    Relatórios
                  </a>
                </li>
                <li class=\"nav-item\">
                  <a class=\"nav-link\" href=\"#\">
                    <span data-feather=\"layers\"></span>
                    Integração
                  </a>
                </li>-->
              </ul>";
              }
              ?>
          </div>
        </nav>