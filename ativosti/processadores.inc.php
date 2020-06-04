<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/* Classe de interação com o PostgreSQL */
require_once "../class/pgsql.class.php";
$pg = new PgSql();

/* Recupera informações dos Admin */
$sql = "SELECT * FROM db_clti.tb_sor";

$row = $pg->getRow($sql);

@$act = $_GET['act'];

/* Checa se há SO cadastrado */
if (($row == '0') AND ($act == NULL)) {
	echo "<h5>Não há Processadores cadastrados,<br />
		 clique <a href=\"?cmd=processadores&act=cadfab\">aqui</a> para fazê-lo.</h5>";
}

/* Carrega form para cadastro de Fabricante */
if ($act == 'cadfab') {
    @$param = $_GET['param'];
    if ($param){
        $procfab = $pg->getRow("SELECT * FROM db_clti.tb_proc_fab WHERE idtb_proc_fab = '$param'");
    }
    else{
        $procfab = (object)['idtb_proc_fab'=>'','nome'=>''];
    }
    echo "
	<div class=\"container-fluid\">
        <div class=\"row\">
            <main>
                <div id=\"form-cadastro\">
                    <form id=\"procfab\" role=\"form\" action=\"?cmd=processadores&act=insertfab\" 
                        method=\"post\" enctype=\"multipart/form-data\">
                        <fieldset>
                            <legend>Processadores - Cadastro</legend>

                            <div class=\"form-group\">
                                <label for=\"fabricante\">Fabricante:</label>
                                <input id=\"fabricante\" class=\"form-control\" type=\"text\" name=\"fabricante\"
                                       placeholder=\"fabricante\" style=\"text-transform:uppercase\" 
                                       required=\"true\" value=\"$procfab->nome\">
                            </div>

                        </fieldset>
                        <input type=\"hidden\" name=\"idtb_proc_fab\" value=\"$procfab->idtb_proc_fab\">
                        <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Salvar\">
                    </form>
                </div>
            </main>
        </div>
    </div>";
}

/* Carrega form para cadastro de Modelos */
if ($act == 'cadproc') {
    @$param = $_GET['param'];
    if ($param){
        $procmodelo = $pg->getRow("SELECT * FROM db_clti.vw_processadores WHERE idtb_proc_modelo = '$param'");
    }
    else{
        $procmodelo = (object)['idtb_proc_modelo'=>'','idtb_proc_fab'=>'','fabricante'=>'','modelo'=>''];
    }
    $procfab = "SELECT * FROM db_clti.tb_proc_fab ORDER BY nome ASC";
    $procfab = $pg->getRows($procfab);
    echo "
	<div class=\"container-fluid\">
        <div class=\"row\">
            <main>
                <div id=\"form-cadastro\">
                    <form id=\"procfab\" role=\"form\" action=\"?cmd=processadores&act=insertmodelo\" 
                        method=\"post\" enctype=\"multipart/form-data\">
                        <fieldset>
                            <legend>Processadores - Cadastro</legend>

                            <div class=\"form-group\">
                                <label for=\"idtb_proc_fab\">Fabricante:</label>
                                <select id=\"idtb_proc_fab\" class=\"form-control\" name=\"idtb_proc_fab\">
                                    <option value=\"$procmodelo->idtb_proc_fab\" selected=\"true\">
                                        ".$procmodelo->fabricante."</option>";
                                    foreach ($procfab as $key => $value) {
                                        echo"<option value=\"".$value->idtb_proc_fab."\">
                                            ".$value->nome."</option>";
                                    };
                                echo "</select>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"modelo\">Modelo:</label>
                                <input id=\"modelo\" class=\"form-control\" type=\"text\" name=\"modelo\"
                                       placeholder=\"modelo\" style=\"text-transform:uppercase\" 
                                       required=\"true\" value=\"$procmodelo->modelo\">
                            </div>

                        </fieldset>
                        <input type=\"hidden\" name=\"idtb_proc_modelo\" value=\"$procmodelo->idtb_proc_modelo\">
                        <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Salvar\">
                    </form>
                </div>
            </main>
        </div>
    </div>";
}

/* Monta quadro de processadores */
if (($row) AND ($act == NULL)) {

    echo"<div class=\"table-responsive\">
            <table class=\"table table-hover\">
                <thead>
                    <tr>
                        <th scope=\"col\">Fabricante</th>
                        <th scope=\"col\">Modelo</th>
                    </tr>
                </thead>";

    $proc = "SELECT * FROM db_clti.vw_processadores ORDER BY fabricante,modelo ASC";
    $proc = $pg->getRows($proc);
    foreach ($proc as $key => $value) {
        echo"       <tr>
                        <th scope=\"row\">
                            <a href=\"?cmd=processadores&act=cadfab&param=".$value->idtb_proc_fab."\">
                                ".$value->fabricante."</a>
                        </th>
                        <td>
                            <a href=\"?cmd=processadores&act=cadproc&param=".$value->idtb_proc_modelo."\">
                                ".$value->modelo."</a>
                        </td>
                    </tr>";
    };
    echo"
                </tbody>
            </table>
            </div>";
}

/* Método INSERT/UPDATE FABRICANTE */
if ($act == 'insertfab') {
    if (isset($_SESSION['status'])){
        $idtb_proc_fab = strtoupper($_POST['idtb_proc_fab']);
        $nome = strtoupper($_POST['fabricante']);
        
        if ($idtb_proc_fab){
            $sql = "UPDATE db_clti.tb_proc_fab SET nome='$nome' WHERE idtb_proc_fab='$idtb_proc_fab' ";
            
            $pg->exec($sql);
    
            if ($pg) {
                echo "<h5>Resgistros incluídos no banco de dados.</h5>
                <meta http-equiv=\"refresh\" content=\"1;url=?cmd=processadores\">";
            }
    
            else {
                echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
                echo(pg_result_error($pg) . "<br />\n");
            }
        }

        else{
            $sql = "INSERT INTO db_clti.tb_proc_fab(nome)
                VALUES ('$nome')";
            
            $pg->exec($sql);
    
            if ($pg) {
                echo "<h5>Resgistros incluídos no banco de dados.</h5>
                <meta http-equiv=\"refresh\" content=\"1;url=?cmd=processadores\">";
            }
    
            else {
                echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
                echo(pg_result_error($pg) . "<br />\n");
            }
        }
    }
    else{
        echo "<h5>Ocorreu algum erro, usuário não autenticado.</h5>
            <meta http-equiv=\"refresh\" content=\"1;$url\">";
    }
}

/* Método INSERT/UPDATE MODELO */
if ($act == 'insertmodelo') {
    if (isset($_SESSION['status'])){
        $idtb_proc_modelo = strtoupper($_POST['idtb_proc_modelo']);
        $idtb_proc_fab = strtoupper($_POST['idtb_proc_fab']);
        $modelo = strtoupper($_POST['modelo']);
        
        if ($idtb_proc_modelo){
            $sql = "UPDATE db_clti.tb_proc_modelo SET idtb_proc_fab='$idtb_proc_fab', modelo='$modelo' 
                WHERE idtb_proc_modelo='$idtb_proc_modelo' ";
            
            $pg->exec($sql);
    
            if ($pg) {
                echo "<h5>Resgistros incluídos no banco de dados.</h5>
                <meta http-equiv=\"refresh\" content=\"1;url=?cmd=processadores\">";
            }
    
            else {
                echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
                echo(pg_result_error($pg) . "<br />\n");
            }
        }

        else{
            $sql = "INSERT INTO db_clti.tb_proc_modelo(idtb_proc_fab,modelo)
                VALUES ('$idtb_proc_fab','$modelo')";
            
            $pg->exec($sql);
    
            if ($pg) {
                echo "<h5>Resgistros incluídos no banco de dados.</h5>
                <meta http-equiv=\"refresh\" content=\"1;url=?cmd=processadores\">";
            }
    
            else {
                echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
                echo(pg_result_error($pg) . "<br />\n");
            }
        }
    }
    else{
        echo "<h5>Ocorreu algum erro, usuário não autenticado.</h5>
            <meta http-equiv=\"refresh\" content=\"1;$url\">";
    }
}

?>