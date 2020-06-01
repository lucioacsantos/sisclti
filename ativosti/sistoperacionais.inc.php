<?php
/**
 * SistemasOperacionais
 * Gerenciamento de SO/SOR
 * sistoperacionais.inc.php
 * 99242991 | Lúcio ALEXANDRE Correia dos Santos
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
	echo "<h5>Não há Sistemas Operacionais cadastrados,<br />
		 clique <a href=\"?cmd=sistoperacionais&act=cad\">aqui</a> para fazê-lo.</h5>";
}

/* Carrega form para cadastro de Admin */
if ($act == 'cad') {
    @$param = $_GET['param'];
    if ($param){
        $sor = $pg->getRow("SELECT * FROM db_clti.tb_sor WHERE idtb_sor = '$param'");
    }
    else{
        $sor = (object)['idtb_sor'=>'','desenvolvedor'=>'','descricao'=>'','versao'=>'','situacao'=>''];
    }
    echo "
	<div class=\"container-fluid\">
        <div class=\"row\">
            <main>
                <div id=\"form-cadastro\">
                    <form id=\"insertso\" role=\"form\" action=\"?cmd=sistoperacionais&act=insert\" 
                        method=\"post\" enctype=\"multipart/form-data\">
                        <fieldset>
                            <legend>Sistemas Operacionais - Cadastro</legend>

                            <div class=\"form-group\">
                                <label for=\"desenvolvedor\">Desenvolvedor:</label>
                                <input id=\"desenvolvedor\" class=\"form-control\" type=\"text\" name=\"desenvolvedor\"
                                       placeholder=\"Desenvolvedor\" style=\"text-transform:uppercase\" 
                                       required=\"true\" value=\"$sor->desenvolvedor\">
                            </div>
                            <div class=\"form-group\">
                                <label for=\"descricao\">Descrição:</label>
                                <input id=\"descricao\" class=\"form-control\" type=\"text\" name=\"descricao\"
                                       placeholder=\"Descrição\" style=\"text-transform:uppercase\" 
                                       required=\"true\" value=\"$sor->descricao\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"versao\">Versão:</label>
                                <input id=\"versao\" class=\"form-control\" type=\"text\" name=\"versao\"
                                       placeholder=\"Versão\" style=\"text-transform:uppercase\" 
                                       required=\"true\" value=\"$sor->versao\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"situacao\">Situação:</label>
                                <select id=\"situacao\" class=\"form-control\" name=\"situacao\">
                                <option value=\"$sor->situacao\" selected=\"true\">$sor->situacao</option>
                                    <option value=\"ATIVO\">Ativo</option>
                                    <option value=\"DESCONTINUADO\">Descontinuado</option>
                                </select>
                            </div>

                        </fieldset>
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
                        <th scope=\"col\">Desenvolvedor</th>
                        <th scope=\"col\">Descrição</th>
                        <th scope=\"col\">Versão</th>
                        <th scope=\"col\">Situação</th>
                        <th scope=\"col\">Ações</th>
                    </tr>
                </thead>";

    $so = "SELECT * FROM db_clti.tb_sor ORDER BY desenvolvedor,versao ASC";
    $so = $pg->getRows($so);
    echo "<p>Sistemas Operacionais: </p>";
    foreach ($so as $key => $value) {
        echo"       <tr>
                        <th scope=\"row\">".$value->desenvolvedor."</th>
                        <td>".$value->descricao."</td>
                        <td>".$value->versao."</td>
                        <td>".$value->situacao."</td>
                        <td><a href=\"?cmd=sistoperacionais&act=cad&param=".$value->idtb_sor."\">Editar</a> - 
                            Excluir</td>
                    </tr>";
    };
    echo"
                </tbody>
            </table>
            </div>";
}

/* Método INSERT */
if ($act == 'insert') {
    if (isset($_SESSION['status'])){
        $desenvolvedor = strtoupper($_POST['desenvolvedor']);
        $descricao = strtoupper($_POST['descricao']);
        $versao = strtoupper($_POST['versao']);
        $situacao = $_POST['situacao'];
        
        $sql = "INSERT INTO db_clti.tb_sor(
            desenvolvedor, descricao, versao, situacao)
            VALUES ('$desenvolvedor', '$descricao', '$versao', '$situacao')";
        
        $pg->exec($sql);

        if ($pg) {
            echo "<h5>Resgistros incluídos no banco de dados.</h5>
            <meta http-equiv=\"refresh\" content=\"1;url=?cmd=sistoperacionais\">";
        }

        else {
            echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
            echo(pg_result_error($pg) . "<br />\n");
        }
    }
    else{
        echo "<h5>Ocorreu algum erro, usuário não autenticado.</h5>
            <meta http-equiv=\"refresh\" content=\"1;$url\">";
    }
}

?>