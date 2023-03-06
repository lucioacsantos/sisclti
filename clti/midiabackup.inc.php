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
$srv = new Servidores();

/* Recupera informações */
$row = $bkp->SelectMidias();

/** Carrega form para cadastro/alteração de mídia de backup */
if ($act == 'cad_midia') {
    if ($param){
        $bkp->idtb_midias_backup = $param;
        $midia = $bkp->SelectMidiaId();
    }
    else{
        $midia = (object)['idtb_midias_backup'=>'','tipo'=>'','numero'=>'','capacidade'=>'','situacao'=>'DISPONÍVEL'];
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
                                    foreach ($tipos as $key => $value) {
                                        echo"<option value=\"".$value->sigla."\">
                                            ".$value->sigla."</option>";
                                    };
                                echo "</select>
                            </div>
                            <div class=\"form-group\">
                                <label for=\"capacidade\">Capacidade (GB):</label>
                                <input id=\"capacidade\" class=\"form-control\" type=\"text\" name=\"capacidade\" autocomplete=\"off\"
                                    style=\"text-transform:uppercase\" placeholder=\"Em GB\" maxlength=\"15\" value=\"$midia->capacidade\">
                            </div>
                            <div class=\"form-group\">
                                <label for=\"numero\">Número da Mídia:</label>
                                <input id=\"numero\" class=\"form-control\" type=\"number\" name=\"numero\" autocomplete=\"off\"
                                    style=\"text-transform:uppercase\" placeholder=\"Nº\" maxlength=\"11\" value=\"$midia->numero\">
                            </div>
                            <div class=\"form-group\">
                                <label for=\"situacao\">Situação:</label>
                                <input id=\"situacao\" class=\"form-control\" type=\"text\" name=\"situacao\" autocomplete=\"off\"
                                    style=\"text-transform:uppercase\" placeholder=\"LTO5\" maxlength=\"50\" value=\"$midia->situacao\">
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
if ($act == 'cad_tipo') {
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
                                    style=\"text-transform:uppercase\" placeholder=\"FITA LTO 5\" maxlength=\"255\" value=\"$tipos->descricao\">
                            </div>
                            <div class=\"form-group\">
                                <label for=\"sigla\">Sigla:</label>
                                <input id=\"sigla\" class=\"form-control\" type=\"text\" name=\"sigla\" autocomplete=\"off\"
                                    style=\"text-transform:uppercase\" placeholder=\"LTO5\" maxlength=\"50\" value=\"$tipos->sigla\">
                            </div>                            
                        </fieldset>
                        <input id=\"idtb_tipos_midias_backup\" type=\"hidden\" name=\"idtb_tipos_midias_backup\" value=\"$tipos->idtb_tipos_midias_backup\">
                        <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Salvar\">
                    </form>
                </div>
            </main>
        </div>
    </div>";
}

/** Cadastro do Servidor de Backup */
if ($act == 'cad_srv'){
    $servidores = $srv->SelectAllSrvTable();
    
    echo "
	<div class=\"container-fluid\">
        <div class=\"row\">
            <main>
                <div id=\"form-cadastro\">
                    <form id=\"midiabackup\" role=\"form\" action=\"?cmd=midiabackup&act=insert_srv_bk\" 
                        method=\"post\" enctype=\"multipart/form-data\">
                        <fieldset>
                            <div class=\"form-group\">
                                <label for=\"idtb_servidores\">Selecione o Servidor:</label>
                                <select id=\"idtb_servidores\" class=\"form-control\" name=\"idtb_servidores\">";
                                    foreach ($servidores as $key => $value) {
                                        echo"<option value=\"".$value->idtb_servidores."\">
                                            ".$value->nome."</option>";
                                    };
                                echo "</select>
                            </div>
                            <div class=\"form-group\">
                                <label for=\"dir_backup\">Diretório de Destino do Backup:</label>
                                <input id=\"dir_backup\" class=\"form-control\" type=\"text\" name=\"dir_backup\" autocomplete=\"off\"
                                    style=\"text-transform:lowercase\" placeholder=\"/home/backup\" maxlength=\"50\">
                            </div>                            
                        </fieldset>
                        <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Salvar\">
                    </form>
                </div>
            </main>
        </div>
    </div>";
}

/** Exibe relação de tipos de mídias de backup */
if ($act == 'tipos_midia') {
    $midia = $bkp->SelectTipos();
    echo"<div class=\"table-responsive\">
            <table class=\"table table-hover\">
                <thead>
                    <tr>
                        <th scope=\"col\">Descrição</th>
                        <th scope=\"col\">Sigla</th>
                        <th scope=\"col\">Ações</th>
                    </tr>
                </thead>";

    foreach ($midia as $key => $value){
        
        echo"       <tr>
                        <th scope=\"row\">".$value->descricao."</th>
                        <td>".$value->sigla."</td>
                        <td>
                            <!--<a href=\"?cmd=midiabackup&act=cad_midia&param=".$value->idtb_tipos_midias_backup."\">Editar</a> - 
                            <a href=\"?cmd=midiabackup&act=del&param=".$value->idtb_tipos_midias_backup."\">Excluir</a>-->
                        </td>
                    </tr>";
    }
    echo"
                </tbody>
            </table>
            </div>";
}

/** Exibe relação de mídias de backup */
if ($act == NULL) {
    $midia = $bkp->SelectMidias();
    echo"<div class=\"table-responsive\">
            <table class=\"table table-hover\">
                <thead>
                    <tr>
                        <th scope=\"col\">Tipo</th>
                        <th scope=\"col\">Nº</th>
                        <th scope=\"col\">Capacidade (GB)</th>
                        <th scope=\"col\">Situação</th>
                        <th scope=\"col\">Ações</th>
                    </tr>
                </thead>";

    foreach ($midia as $key => $value){
        
        echo"       <tr>
                        <th scope=\"row\">".$value->tipo."</th>
                        <td>".$value->numero."</td>
                        <td>".$value->capacidade."</td>
                        <td>".$value->situacao."</td>
                        <td>
                            <!--<a href=\"?cmd=midiabackup&act=cad_midia&param=".$value->idtb_midias_backup."\">Editar</a> - 
                            <a href=\"?cmd=midiabackup&act=del&param=".$value->idtb_midias_backup."\">Excluir</a>-->
                        </td>
                    </tr>";
    }
    echo"
                </tbody>
            </table>
            </div>";
}

/* Método INSERT/UPDATE Mídia de Backup */
if ($act == 'insert_midia') {
    if (isset($_SESSION['status'])){
        $idtb_midias_backup = $_POST['idtb_midias_backup'];
        $bkp->idtb_midias_backup = $idtb_midias_backup;
        $bkp->tipo = mb_strtoupper($_POST['tipo']);
        $bkp->capacidade = $_POST['capacidade'];
        $bkp->numero = $_POST['numero'];
        $bkp->situacao = mb_strtoupper($_POST['situacao']);

        /** Opta pelo UPDATE */
        if ($idtb_midias_backup){
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
        $bkp->descricao = mb_strtoupper($_POST['descricao']);
        $bkp->sigla = mb_strtoupper($_POST['sigla']);

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

/* Método INSERT/UPDATE Servidor de Backup */
if ($act == 'insert_srv_bk') {
    if (isset($_SESSION['status'])){
        $idtb_servidores = $_POST['idtb_servidores'];
        $bkp->idtb_servidores = $idtb_servidores;
        $bkp->diretorio_backup = mb_strtolower($_POST['dir_backup']);

        $row = $bkp->InsertSrvBk();
        if ($row) {
            echo "<h5>Resgistros incluídos no banco de dados.</h5>
            <meta http-equiv=\"refresh\" content=\"1;url=?cmd=midiabackup\">";
        }
        else {
            echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
        }
        
    }
    else{
        echo "<h5>Ocorreu algum erro, usuário não autenticado.</h5>
            <meta http-equiv=\"refresh\" content=\"1;$url\">";
    }
}

/** Lista Servidor de Backup */
if ($act == 'srv_bk'){
    $srv_bk = $bkp->SelectSrvBk();
    if ($srv_bk){
    echo"<div class=\"table-responsive\">
            <table class=\"table table-hover\">
                <thead>
                    <tr>
                        <th scope=\"col\">Nome</th>
                        <th scope=\"col\">Endereço IP</th>
                        <th scope=\"col\">Diretório de Destino</th>
                        <th scope=\"col\">Ações</th>
                    </tr>
                </thead>";

    foreach ($srv_bk as $key => $value){
        
        echo"       <tr>
                        <th scope=\"row\">".$value->nome."</th>
                        <td>".$value->end_ip."</td>
                        <td>".$value->diretorio_backup."</td>
                        <td>
                            <!--<a href=\"?cmd=midiabackup&act=cad_midia&param=".$value->idtb_srv_backup."\">Editar</a> - 
                            <a href=\"?cmd=midiabackup&act=del&param=".$value->idtb_srv_backup."\">Excluir</a>-->
                        </td>
                    </tr>";
    }
    echo"
                </tbody>
            </table>
            </div>";
    }
    else{
        
    }
}



/** Método Cadastro de Servidores/Diretórios para Backup */
if ($act == 'cad_dir'){
    $servidores = $srv->SelectIdOMSrvView();
}

?>