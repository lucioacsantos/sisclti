<?php
/**
 * NAV
 * Menus e acessórios de navegação HTML5
 * nav.php
 * 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

$sql = "SELECT sigla FROM db_clti.tb_clti";

$sigla = $pg->getCol($sql);

?>
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <p class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">
        <?php echo $sigla; ?>
      </p>
      <!--<input class="form-control form-control-dark w-100" type="text" placeholder="Pesquisa" aria-label="Pesquisa">-->
      <p class="navbar-brand">Usuário ativo: <?php print $_SESSION['user_name']." - "; print $_SESSION['perfil']; ?></p>
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
                  Dashboard <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo "$url/clti"; ?>">
                  <span data-feather="briefcase"></span>
                  Módulo Gerência (CLTI)
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo "$url/clti/?cmd=omapoiadas"; ?>">
                  <span data-feather="anchor"></span>
                  OM Apoiadas
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo "$url/clti/?cmd=lotclti"; ?>">
                  <span data-feather="users"></span>
                  Lotação do CLTI
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo "$url/clti/?cmd=osic"; ?>">
                  <span data-feather="users"></span>
                  OSIC
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo "$url/clti/?cmd=admin"; ?>">
                  <span data-feather="users"></span>
                  Admin
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo "$url/ativosti/?cmd=sistoperacionais"; ?>">
                  <span data-feather="globe"></span>
                  Sistemas Operacionais
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo "$url/ativosti/?cmd=servidores"; ?>">
                  <span data-feather="server"></span>
                  Servidores
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo "$url/ativosti/?cmd=estacoes"; ?>">
                  <span data-feather="monitor"></span>
                  Estações de Trabalho
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo "$url/ativosti/?cmd=conectividade"; ?>">
                  <span data-feather="cpu"></span>
                  Equipamentos de Conectividade
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="bar-chart-2"></span>
                  Relatórios
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="layers"></span>
                  Integração
                </a>
              </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Relatórios Salvos</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
              </a>
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Mês Atual
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Últimos Quinze Dias
                </a>
              </li>
            </ul>
          </div>
        </nav>