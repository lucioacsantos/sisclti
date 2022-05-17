<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/** Leitura de parâmetros */
$oa = $cmd = $param = $act = $senha = NULL;
if (isset($_GET['oa'])){
  $oa = $_GET['oa'];
}

if (isset($_GET['cmd'])){
  $cmd = $_GET['cmd'];
}

if (isset($_GET['act'])){
  $act = $_GET['act'];
}

if (isset($_GET['param'])){
  $param = $_GET['param'];
}

if (isset($_GET['senha'])){
    $senha = $_GET['senha'];
}

/* Classe de interação com o PostgreSQL */
require_once "../class/constantes.inc.php";
$pesclti = new PessoalCLTI();
$relsv = new RelServico();

/* Recupera informações */
$relsv->ordena = 'ORDER BY data_entra_servico ASC';
$row = $relsv->SelectDetSv();
$pesclti->ordena = 'ORDER BY idtb_posto_grad ASC';
$svc_entra = $pesclti->SelectEscalaSV();

/* Carrega form para Novo Relatório */
if ($act == 'cad') {
    if ($param){
        $relsv->idtb_det_serv = $param;
        $servico = $relsv->SelectIdDetSv();
        $pesclti->idtb_lotacao_clti = $servico->idtb_lotacao_clti;
        $svc_atual = $pesclti->SelectId();
    }
    else{
        $servico = (object)['idtb_det_serv'=>'','idtb_lotacao_clti'=>'','data_entra_servico'=>'',
            'data_sai_servico'=>'','status'=>'PROGRAMADO'];
        $svc_atual = (object)['sigla_posto_grad'=>'','nome_guerra'=>''];
    }
    
	echo "
	<div class=\"container-fluid\">
        <div class=\"row\">
            <main>
                <div id=\"form-cadastro\">
                    <form id=\"insertom\" action=\"?cmd=detsv&act=insert\" method=\"post\" enctype=\"multipart/form-data\">
                        <fieldset>
                            <legend>Detalhe de Serviço</legend>
                            <div class=\"form-group\">
                                <label for=\"data_entra_servico\">Serviço do dia:</label>
                                <input id=\"data_entra_servico\" class=\"form-control\" name=\"data_entra_servico\" type=\"date\" 
                                    value=\"$servico->data_entra_servico\">
                            </div>
                            <div class=\"form-group\">
                                <label for=\"data_sai_servico\">Para o dia:</label>
                                <input id=\"data_sai_servico\" class=\"form-control\" name=\"data_sai_servico\" type=\"date\"
                                    value=\"$servico->data_sai_servico\">
                            </div>
                            <div class=\"form-group\">
                                <label for=\"idtb_lotacao_clti\">Supervisor que entra:</label>
                                <select id=\"idtb_lotacao_clti\" class=\"form-control\" name=\"idtb_lotacao_clti\">
                                        <option value=\"$servico->idtb_lotacao_clti\" selected>
                                            ".$svc_atual->sigla_posto_grad." - ".$svc_atual->nome_guerra."</option>";
                                            foreach ($svc_entra as $key => $value) {
                                                echo"<option value=\"".$value->idtb_lotacao_clti."\">
                                                    ".$value->sigla_posto_grad." - ".$value->nome_guerra."</option>";
                                            };
                                        echo "</select>
                            </div>                            
                        </fieldset>
                        <input id=\"idtb_det_serv\" name=\"idtb_det_serv\" value=\"$servico->idtb_det_serv\" type=\"hidden\">
                        <input id=\"status\" name=\"status\" value=\"$servico->status\" type=\"hidden\">
                        <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Salvar\">
                    </form>
                </div>
            </main>
        </div>
    </div>";
}

/* Monta quadro */
if (($row) AND ($act == NULL)) {

    echo"<div class=\"table-responsive\">
            <table class=\"table table-hover\">
                <thead>
                    <tr>
                        <th scope=\"col\">Posto/Grad.</th>
                        <th scope=\"col\">Nome de Guerra</th>
                        <th scope=\"col\">Serviço de:</th>
                        <th scope=\"col\">Para:</th>
                        <th scope=\"col\">Ações</th>
                    </tr>
                </thead>";
    $relsv->ordena = "ORDER BY data_entra_servico ASC";
    $detsv = $relsv->SelectDetSv();

    foreach ($detsv as $key => $value) {
        echo"       <tr>";
        $pesclti->idtb_lotacao_clti = $value->idtb_lotacao_clti;
        $svc_atual = $pesclti->SelectId();
        echo"           <th scope=\"row\">".$svc_atual->sigla_posto_grad."</th>
                        <th scope=\"row\">".$svc_atual->nome_guerra."</th>
                        <th scope=\"row\">".date('d-m-Y',strtotime($value->data_entra_servico))."</th>
                        <th scope=\"row\">".date('d-m-Y',strtotime($value->data_sai_servico))."</th>
                        <td><a href=\"?cmd=detsv&act=cad&param=".$value->idtb_det_serv."\">Editar</a></td>
                    </tr>";
    };
    echo"
                </tbody>
            </table>
            </div>";
}

/* Método INSERT/UPDATE */
if ($act == 'insert') {
    if (isset($_SESSION['status'])){
        //idtb_det_serv sup_servico data_entra_servico data_sai_servico status

        $idtb_det_serv = $_POST['idtb_det_serv'];
        $relsv->idtb_det_serv = $idtb_det_serv;
        $relsv->idtb_lotacao_clti = $_POST['idtb_lotacao_clti'];
        $relsv->data_entra_servico = $_POST['data_entra_servico'];
        $relsv->data_sai_servico = $_POST['data_sai_servico'];
        $relsv->status = $_POST['status'];
        
        if ($idtb_det_serv){
            $row = $relsv->UpdateDetSv();    
            if ($row) {
                echo "<h5>Resgistros incluídos no banco de dados.</h5>
                <meta http-equiv=\"refresh\" content=\"1;url=?cmd=detsv\">";
            }    
            else {
                echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
                echo(pg_result_error($row) . "<br />\n");
            }
        }
        else {
            $row = $relsv->InsertDetSv();
            if ($row) {
                echo "<h5>Resgistros incluídos no banco de dados.</h5>
                <meta http-equiv=\"refresh\" content=\"1;url=?cmd=detsv\">";
            }    
            else {
                echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
                echo(pg_result_error($row) . "<br />\n");
            }
        }
    }
    else{
        echo "<h5>Ocorreu algum erro, usuário não autenticado.</h5>
            <meta http-equiv=\"refresh\" content=\"1;$url\">";
    }
}

?>