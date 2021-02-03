<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/* Classe de interação com o PostgreSQL */
require_once "../class/constantes.inc.php";
$pad = new PAD();

/* Recupera informações dos PAD Ativos */
$pad->idtb_om_apoiadas = $_SESSION['id_om_apoiada'];
$row = $pad->SelectPADCorrente();

@$act = $_GET['act'];

/* Formulário para Cadastro */
if ((!$row) AND ($act == NULL) OR ($act == 'cad')) {
    echo "
    <div class=\"container-fluid\">
        <div class=\"row\">
            <main>
                <div id=\"form-cadastro\">
                    <form id=\"nip_cpf\" role=\"form\" action=\"?cmd=padsictic&act=insert\" 
                    method=\"post\" enctype=\"multipart/form-data\">
                        <fieldset>
                        <legend>PAD SIC/TIC - Cadastro</legend>
                            <div class=\"form-group\">
                                <label for=\"ano_base\">Ano Base:</label>
                                <input id=\"ano_base\" class=\"form-control\" type=\"number\" name=\"ano_base\" 
                                    required=\"true\" autocomplete=\"off\" autofocus=\"true\">
                            </div>
                            <div class=\"form-group\">
                                <label for=\"data_assinatura\">Data de Assinatura:</label>
                                <input id=\"data_assinatura\" class=\"form-control\" type=\"date\" name=\"data_assinatura\" 
                                    required=\"true\" autocomplete=\"off\">
                            </div>
                            <div class=\"form-group\">
                                <label for=\"data_revisao\">Data de Revisão:</label>
                                <input id=\"data_revisao\" class=\"form-control\" type=\"date\" name=\"data_revisao\" 
                                    required=\"true\" autocomplete=\"off\">
                            </div>
                            <div class=\"form-group\">
                                <label for=\"status\">Situação:</label>
                                <select id=\"status\" class=\"form-control\" name=\"status\">
                                    <option value=\"CORRENTE\" selected=\"true\">CORRENTE</option>
                                    <option value=\"FINALIZADO\">FINALIZADO</option>
                                </select>
                            </div>
                        </fieldset>
                        <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Cadastrar\">
                    </form>
                </div>
            </main>
        </div>
    </div>";
}

/* Carrega form para cadastro de Admin */
if ($act == 'cad_temas') {
    @$idtb_pad_sic_tic = $_POST['idtb_pad_sic_tic'];

    if ($idtb_pad_sic_tic){
        $pad->idtb_pad_sic_tic = $idtb_pad_sic_tic;
        /** CONTINUAR DAQUI */
    }
    else{
        $pad_corrente = $pad->SelectPADOM();
        echo "
        <div class=\"container-fluid\">
            <div class=\"row\">
                <main>
                    <div id=\"form-cadastro\">
                        <form id=\"nip_cpf\" role=\"form\" action=\"?cmd=padsictic&act=cad_temas\" 
                        method=\"post\" enctype=\"multipart/form-data\">
                            <fieldset>
                            <legend>Selecione PAD (Ano)</legend>
                                <select id=\"idtb_pad_sic_tic\" class=\"form-control\" name=\"idtb_pad_sic_tic\">";
                                    foreach ($pad_corrente as $key => $value) {
                                        echo"<option value=\"".$value->idtb_pad_sic_tic."\">
                                            ".$value->ano_base."</option>";
                                    };
                                echo "</select>
                            </fieldset>
                            <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Localizar\">
                        </form>
                    </div>
                </main>
            </div>
        </div>";
    }    
}

/* Monta quadro */
if (($row) AND ($act == NULL)) {

    echo"<div class=\"table-responsive\">
            <table class=\"table table-hover\">
                <thead>
                    <tr>
                        <th scope=\"col\">Ano Base</th>
                        <th scope=\"col\">Data de Assinatura</th>
                        <th scope=\"col\">Data de Revisão</th>
                        <th scope=\"col\">Situação</th>
                    </tr>
                </thead>";

    //foreach ($row as $key => $value) {
        echo"       <tr>
                        <th scope=\"row\">".$row->ano_base."</th>
                        <td>$row->data_assinatura</td>
                        <td>$row->data_revisao</td>
                        <td>$row->status</td>
                        <td><a href=\"?cmd=padsictic&act=cad&param=".$row->idtb_pad_sic_tic."\">Editar</a> - 
                            Excluir</td>
                    </tr>";
    //}
    echo"
                </tbody>
            </table>
            </div>";
}

/* Método INSERT */
if ($act == 'insert') {
    if (isset($_SESSION['status'])){
        $pad->ano_base = $_POST['ano_base'];
        $pad->data_assinatura = $_POST['data_assinatura'];
        $pad->data_revisao = $_POST['data_revisao'];
        $pad->status = $_POST['status'];

        $row = $pad->InsertPAD();
        if ($row) {
            echo "<h5>Resgistros incluídos no banco de dados.</h5>
            <meta http-equiv=\"refresh\" content=\"1;?cmd=padsictic\">";
        }
        else {
            echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
            echo(pg_result_error($row) . "<br />\n");
        }
    }
    else{
        echo "<h5>Ocorreu algum erro, usuário não autenticado.</h5>
            <meta http-equiv=\"refresh\" content=\"1;$url\">";
    }
    
}

?>