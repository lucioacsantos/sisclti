<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/* Classe de interação com o PostgreSQL */
require_once "../class/pgsql.class.php";
$pg = new PgSql();

/* Recupera informações dos Admin */
$sql = "SELECT * FROM db_clti.tb_funcoes_ti";

$row = $pg->getRow($sql);

@$act = $_GET['act'];

/* Checa se há SO cadastrado */
if (($row == '0') AND ($act == NULL)) {
	echo "<h5>Não há Funções de TI cadastradas,<br />
		 clique <a href=\"?cmd=funcoesti&act=cad\">aqui</a> para fazê-lo.</h5>";
}

/* Carrega form para cadastro de Admin */
if ($act == 'cad') {
    @$param = $_GET['param'];
    if ($param){
        $funcoesti = $pg->getRow("SELECT * FROM db_clti.tb_funcoes_ti WHERE idtb_funcoes_ti = '$param'");
    }
    else{
        $funcoesti = (object)['idtb_funcoes_ti'=>'','descricao'=>'','sigla'=>''];
    }
    echo "
	<div class=\"container-fluid\">
        <div class=\"row\">
            <main>
                <div id=\"form-cadastro\">
                    <form id=\"insertso\" role=\"form\" action=\"?cmd=funcoesti&act=insert\" 
                        method=\"post\" enctype=\"multipart/form-data\">
                        <fieldset>
                            <legend>Funções de TI - Cadastro</legend>

                            <div class=\"form-group\">
                                <label for=\"descricao\">Descrição:</label>
                                <input id=\"descricao\" class=\"form-control\" type=\"text\" name=\"descricao\"
                                       placeholder=\"ex. Administrador da Rede Local\" 
                                       style=\"text-transform:uppercase\" autofocus=\"true\"
                                       required=\"true\" value=\"$funcoesti->descricao\">
                            </div>
                            <div class=\"form-group\">
                                <label for=\"sigla\">Sigla:</label>
                                <input id=\"sigla\" class=\"form-control\" type=\"text\" name=\"sigla\"
                                       placeholder=\"ex. ADMIN\" style=\"text-transform:uppercase\" 
                                       required=\"true\" value=\"$funcoesti->sigla\">
                            </div>

                        </fieldset>
                        <input type=\"hidden\" name=\"idtb_funcoes_ti\" value=\"$funcoesti->idtb_funcoes_ti\">
                        <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Salvar\">
                    </form>
                </div>
            </main>
        </div>
    </div>";
}

/* Monta quadro de administradores */
if (($row) AND ($act == NULL)) {

    echo"<div class=\"table-responsive\">
            <table class=\"table table-hover\">
                <thead>
                    <tr>
                        <th scope=\"col\">Descrição</th>
                        <th scope=\"col\">Sigla</th>
                        <th scope=\"col\">Ações</th>
                    </tr>
                </thead>";

    $funcoesti = "SELECT * FROM db_clti.tb_funcoes_ti WHERE sigla !='ADMIN' AND sigla != 'OSIC' ORDER BY descricao ASC";
    $funcoesti = $pg->getRows($funcoesti);

    foreach ($funcoesti as $key => $value) {
        echo"       <tr>
                        <th scope=\"row\">".$value->descricao."</th>
                        <td>".$value->sigla."</td>
                        <td><a href=\"?cmd=funcoesti&act=cad&param=".$value->idtb_funcoes_ti."\">Editar</a> - 
                            Excluir</td>
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
        $idtb_funcoes_ti = $_POST['idtb_funcoes_ti'];
        $descricao = strtoupper($_POST['descricao']);
        $sigla = strtoupper($_POST['sigla']);
        
        if ($idtb_funcoes_ti){
            $sql = "UPDATE db_clti.tb_funcoes_ti SET
                descricao='$descricao', sigla='$sigla'
                WHERE idtb_funcoes_ti='$idtb_funcoes_ti' ";
            
            $pg->exec($sql);
    
            if ($pg) {
                echo "<h5>Resgistros incluídos no banco de dados.</h5>
                <meta http-equiv=\"refresh\" content=\"1;url=?cmd=funcoesti\">";
            }
    
            else {
                echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
                echo(pg_result_error($pg) . "<br />\n");
            }
        }

        else {
            $sql = "INSERT INTO db_clti.tb_funcoes_ti(
                descricao, sigla)
                VALUES ('$descricao', '$sigla')";
            
            $pg->exec($sql);
    
            if ($pg) {
                echo "<h5>Resgistros incluídos no banco de dados.</h5>
                <meta http-equiv=\"refresh\" content=\"1;url=?cmd=funcoesti\">";
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