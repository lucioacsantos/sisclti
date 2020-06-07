<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

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
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col"><canvas class="my-4 w-100" id="canvas" width="900" height="380"></canvas></th>
                </tr>
              </thead>
              <tr>
                <th scope="row"><!--<canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>--></th>
              </tr>
              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>