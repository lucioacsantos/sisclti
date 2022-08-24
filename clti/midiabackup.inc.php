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
$bkp = new Backup();

/* Recupera informações */
$row = $bkp->SelectMidias();

/** Carrega form para cadastro/alteração de mídia de backup */
if ($act == 'cad_midia') {
    if ($param){
        $bkp->idtb_midias_backup = $param;
        $midia = $bkp->SelectMidiaId();
    }
    else{
        $midia = (object)['idtb_midias_backup'=>'','tipo'=>'','numero'=>'','capacidade'=>''];
    }
    $tipos = $bkp->SelectTipos();
    echo "
	<div class=\"container-fluid\">
        <div class=\"row\">
            <main>
                <div id=\"form-cadastro\">
                    <form id=\"midiabackup\" role=\"form\" action=\"?cmd=midiabackup&act=insert_midia\" 
                        method=\"post\" enctype=\"multipart/form-data\">
                        <fieldset>
                            <div class=\"form-group\">
                                <label for=\"tipo\">Tipo da Mídia:</label>
                                <select id=\"tipo\" class=\"form-control\" name=\"tipo\">
                                    <option value=\"$midia->tipo\" selected=\"true\">
                                        $midia->tipo</option>";
                                    foreach ($tipo as $key => $value) {
                                        echo"<option value=\"".$value->sigla."\">
                                            ".$value->descricao."</option>";
                                    };
                                echo "</select>
                            </div>
                            <div class=\"form-group\">
                                <label for=\"capacidade\">Capacidade (GB):</label>
                                <input id=\"capacidade\" class=\"form-control\" type=\"text\" name=\"capacidade\" autocomplete=\"off\"
                                       placeholder=\"Em GB\" maxlength=\"15\" value=\"$midia->capacidade\">
                            </div>
                            <div class=\"form-group\">
                                <label for=\"numero\">Número da Mídia:</label>
                                <input id=\"numero\" class=\"form-control\" type=\"number\" name=\"numero\" autocomplete=\"off\"
                                       placeholder=\"Nº\" maxlength=\"11\" value=\"$midia->numero\">
                            </div>
                        </fieldset>
                        <input id=\"idtb_midias_backup\" type=\"hidden\" name=\"idtb_midias_backup\" value=\"$midia->idtb_midias_backup\">
                        <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Salvar\">
                    </form>
                </div>
            </main>
        </div>
    </div>";
}

/** Carrega form para cadastro/alteração de tipos de mídia de backup */
if ($act == 'cad_tipos') {
    if ($param){
        $bkp->idtb_tipos_midias_backup = $param;
        $tipos = $bkp->SelectTipoId();
    }
    else{
        $tipos = (object)['idtb_tipos_midias_backup'=>'','descricao'=>'','sigla'=>''];
    }
    echo "
	<div class=\"container-fluid\">
        <div class=\"row\">
            <main>
                <div id=\"form-cadastro\">
                    <form id=\"midiabackup\" role=\"form\" action=\"?cmd=midiabackup&act=insert_tipo\" 
                        method=\"post\" enctype=\"multipart/form-data\">
                        <fieldset>
                            <div class=\"form-group\">
                                <label for=\"descricao\">Descrição:</label>
                                <input id=\"descricao\" class=\"form-control\" type=\"text\" name=\"descricao\" autocomplete=\"off\"
                                       placeholder=\"Em GB\" maxlength=\"255\" value=\"$midia->descricao\">
                            </div>
                            <div class=\"form-group\">
                                <label for=\"sigla\">Sigla:</label>
                                <input id=\"sigla\" class=\"form-control\" type=\"text\" name=\"sigla\" autocomplete=\"off\"
                                       placeholder=\"Nº\" maxlength=\"50\" value=\"$midia->sigla\">
                            </div>
                        </fieldset>
                        <input id=\"idtb_tipos_midias_backup\" type=\"hidden\" name=\"idtb_tipos_midias_backup\" value=\"$midia->idtb_tipos_midias_backup\">
                        <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Salvar\">
                    </form>
                </div>
            </main>
        </div>
    </div>";
}

/** Exibe relação de mídias de backup */
if ($row) {
    $midia = $bkp->SelectMidias();
    echo"<div class=\"table-responsive\">
            <table class=\"table table-hover\">
                <thead>
                    <tr>
                        <th scope=\"col\">Tipo</th>
                        <th scope=\"col\">Nº</th>
                        <th scope=\"col\">Capacidade</th>
                        <th scope=\"col\">Ações</th>
                    </tr>
                </thead>";

    foreach ($midia as $key => $value){
        
        echo"       <tr>
                        <th scope=\"row\">".$value->tipo."</th>
                        <td>".$value->numero."</td>
                        <td>".$value->capacidade."</td>
                        <td>
                            <a href=\"?cmd=midiabackup&act=cad&param=".$value->idtb_midias_backup."\">Editar</a> - 
                            <a href=\"?cmd=midiabackup&act=del&param=".$value->idtb_midias_backup."\">Excluir</a>
                        </td>
                    </tr>";
    }
    echo"
                </tbody>
            </table>
            </div>";
}
else{
    echo "<h5>Não há mídias de backup cadastradas.</h5>";
}

/* Método INSERT/UPDATE Mídia de Backup */
if ($act == 'insert_midia') {
    if (isset($_SESSION['status'])){
        $idtb_midias_backup = $_POST['idtb_midias_backup'];
        $bkp->idtb_midias_backup = $idtb_midias_backup;
        $bkp->tipo = $_POST['tipo'];
        $bkp->capacidade = $_POST['capacidade'];
        $bkp->numero = $_POST['numero'];

        /** Opta pelo UPDATE */
        if ($idtb_tipos_midias_backup){
            $row = $bkp->UpdateMidia();
            if ($row) {
                echo "<h5>Resgistros incluídos no banco de dados.</h5>
                <meta http-equiv=\"refresh\" content=\"1;url=?cmd=midiabackup\">";
            }
            else {
                echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
            }
        }
        /** Opta pelo INSERT */
        else{
            $row = $bkp->InsertMidia();
            if ($row) {
                echo "<h5>Resgistros incluídos no banco de dados.</h5>
                <meta http-equiv=\"refresh\" content=\"1;url=?cmd=midiabackup\">";
            }
            else {
                echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
            }
        }
    }
    else{
        echo "<h5>Ocorreu algum erro, usuário não autenticado.</h5>
            <meta http-equiv=\"refresh\" content=\"1;$url\">";
    }
}

/* Método INSERT/UPDATE Tipo de Mídia de Backup */
if ($act == 'insert_tipo') {
    if (isset($_SESSION['status'])){
        $idtb_tipos_midias_backup = $_POST['idtb_tipos_midias_backup'];
        $bkp->idtb_tipos_midias_backup = $idtb_tipos_midias_backup;
        $bkp->descricao = $_POST['descricao'];
        $bkp->sigla = $_POST['sigla'];

        /** Opta pelo UPDATE */
        if ($idtb_tipos_midias_backup){
            $row = $bkp->UpdateTipo();
            if ($row) {
                echo "<h5>Resgistros incluídos no banco de dados.</h5>
                <meta http-equiv=\"refresh\" content=\"1;url=?cmd=midiabackup\">";
            }
            else {
                echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
            }
        }
        /** Opta pelo INSERT */
        else{
            $row = $bkp->InsertTipo();
            if ($row) {
                echo "<h5>Resgistros incluídos no banco de dados.</h5>
                <meta http-equiv=\"refresh\" content=\"1;url=?cmd=midiabackup\">";
            }
            else {
                echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
            }
        }
        
    }
    else{
        echo "<h5>Ocorreu algum erro, usuário não autenticado.</h5>
            <meta http-equiv=\"refresh\" content=\"1;$url\">";
    }
}

?>