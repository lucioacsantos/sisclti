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
                                       required=\"required\">
                            </div>
                            <div class=\"form-group\">
                                <label for=\"descricao\">Descrição:</label>
                                <input id=\"descricao\" class=\"form-control\" type=\"text\" name=\"descricao\"
                                       placeholder=\"Descrição\" style=\"text-transform:uppercase\" 
                                       required=\"required\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"versao\">Versão:</label>
                                <input id=\"versao\" class=\"form-control\" type=\"text\" name=\"versao\"
                                       placeholder=\"Versão\" style=\"text-transform:uppercase\" 
                                       required=\"required\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"situacao\">Situação:</label>
                                <select id=\"situacao\" class=\"form-control\" name=\"situacao\">
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
    $so = "SELECT * FROM db_clti.tb_sor ORDER BY desenvolvedor ASC";
    $so = $pg->getRows($so);
    echo "<p>Sistemas Operacionais: </p>";
    foreach ($so as $key => $value) {
        echo"<p>".$value->desenvolvedor." - ".$value->descricao." - ".$value->versao." - ".$value->situacao."</p>";
    };
}

/* Método INSERT */
if ($act == 'insert') {
	$desenvolvedor = strtoupper($_POST['desenvolvedor']);
    $descricao = strtoupper($_POST['descricao']);
    $versao = strtoupper($_POST['versao']);
    $situacao = $_POST['situacao'];
    
    $sql = "INSERT INTO db_clti.tb_sor(
        desenvolvedor, descricao, versao, situacao)
        VALUES ('$desenvolvedor', '$descricao', '$versao', '$situacao')";

    $pg->exec($sql);

    if ($pg) {
        echo "<h5>Resgistros incluídos no banco de dados.</h5>";
    }

    else {
        echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
        echo(pg_result_error($pg) . "<br />\n");
    }

}

?>