<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/* Classe de interação com o PostgreSQL */
require_once "../class/constantes.inc.php";

$rel_svc = new RelServico();
$pess_clti = new PessoalCLTI();

$pess_clti->idtb_lotacao_clti = $_SESSION['user_id'];
$svc_sai = $pess_clti->SelectId();
$svc_entra = $pess_clti->SelectALL();
$num_rel = $rel_svc->NumRel();

@$act = $_GET['act'];

/* Carrega form para Novo Relatório */
if ($act == 'cad') {
    @$param = $_GET['param'];
    if ($param){
        $relservico->num_relatorio = $param;
    }
    else{
        
    }
    
	echo "
	<div class=\"container-fluid\">
        <div class=\"row\">
            <main>
                <div id=\"form-cadastro\">
                    <form id=\"insertom\" action=\"?cmd=relservico&act=insert\" method=\"post\" enctype=\"multipart/form-data\">
                        <fieldset>
                            <legend>Relatório de Serviço - Cadastro</legend>
                            <div class=\"form-group\">
                                <label for=\"num_rel\">Número do Relatório:</label>
                                <input id=\"num_rel\" class=\"form-control\" name=\"num_rel\" value=\"$num_rel\" readonly></select>
                            </div>

                            

                        </fieldset>
                        <input id=\"idtb_om_apoiadas\" type=\"hidden\" name=\"idtb_om_apoiadas\" value=\"\">
                        <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Salvar\">
                    </form>
                </div>
            </main>
        </div>
    </div>";
}

/* Monta quadro de OM */
/*if (($row) AND ($act == NULL)) {

    echo"<div class=\"table-responsive\">
            <table class=\"table table-hover\">
                <thead>
                    <tr>
                        <th scope=\"col\">Código</th>
                        <th scope=\"col\">Nome</th>
                        <th scope=\"col\">Sigla</th>
                        <th scope=\"col\">Ind. Naval</th>
                        <th scope=\"col\">Ações</th>
                    </tr>
                </thead>";

    $omap->ordena = "ORDER BY cod_om ASC";
    $om = $omap->SelectAllOMTable();

    foreach ($om as $key => $value) {
        echo"       <tr>
                        <th scope=\"row\">".$value->cod_om."</th>
                        <td>".$value->nome."</td>
                        <td>".$value->sigla."</td>
                        <td>".$value->indicativo."</td>
                        <td><a href=\"?cmd=omapoiadas&act=cad&param=".$value->idtb_om_apoiadas."\">Editar</a> - 
                            Excluir</td>
                    </tr>";
    };
    echo"
                </tbody>
            </table>
            </div>";
}*/

/* Método INSERT / UPDATE */
/*if ($act == 'insert') {
    if (isset($_SESSION['status'])){
        $idtb_om_apoiadas = $_POST['idtb_om_apoiadas'];
        $omap->idtb_om_apoiadas = $idtb_om_apoiadas;
        $omap->estado = $_POST['estado'];
        $omap->cidade = $_POST['cidade'];
        $omap->cod_om = $_POST['cod_om'];
        $omap->nome = mb_strtoupper($_POST['nome'],'UTF-8');
        $omap->sigla = mb_strtoupper($_POST['sigla'],'UTF-8');
        $omap->indicativo = mb_strtoupper($_POST['indicativo'],'UTF-8');
        $omap->estado = $omap->SelectUfEstado();
        $omap->cidade = $omap->SelectNomeCidade();

        # Opta pelo método UPDATE
        if ($idtb_om_apoiadas){
            $row = $omap->UpdateOM();
            if ($row) {
                echo "<h5>Resgistros incluídos no banco de dados.</h5>
                    <meta http-equiv=\"refresh\" content=\"1;url=?cmd=omapoiadas\">";
            }    
            else {
                echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
                echo(pg_result_error($row) . "<br />\n");
            }
        }

        # Opta pelo método INSERT
        else{
            $row = $omap->InsertOM();
            if ($row) {
                echo "<h5>Resgistros incluídos no banco de dados.</h5>
                    <meta http-equiv=\"refresh\" content=\"1;url=?cmd=omapoiadas\">";
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
}*/
?>