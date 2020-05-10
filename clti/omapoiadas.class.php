<?php
/**
 * OMApoiadas
 * Operações relacionadas às OM Apoiadas
 * omapoiadas.class.php
 * 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/* Classe de interação com o PostgreSQL */
require_once "../class/pgsql.class.php";
$pg = new PgSql();

/* Recupera informações do tipo das OM Apoiadas */
$sql = "SELECT * FROM db_clti.tb_om_apoiadas";

$row = $pg->getRow($sql);

@$act = $_GET['act'];

/* Checa se há OM cadastradas */
if (($row == '0') AND ($act == NULL)) {
	echo "<h5>Não há OM Apoiadas cadastradas neste CLTI,<br />
		 clique <a href=\"?cmd=omapoiadas&act=cad\">aqui</a> para fazê-lo.</h5>";
}

/* Carrega form para cadastro de OM */
if ($act == 'cad') {
	echo "
	<div class=\"container-fluid\">
        <div class=\"row\">
            <main>
                <div id=\"form-cadastro\">
                    <form id=\"insertom\" action=\"?cmd=omapoiadas&act=insert\" method=\"post\" enctype=\"multipart/form-data\">
                        <fieldset>
                            <legend>OM Apoiadas pelo CLTI - Cadastro</legend>

                            <div class=\"form-group\">
                                <label for=\"estado\">Selecione o Estado:</label>
                                <select id=\"estado\" class=\"form-control\" name=\"estado\" value=\"RN\"></select>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"cidade\">Selecione a Cidade:</label>
                                <select id=\"cidade\" class=\"form-control\" name=\"cidade\" value=\"Natal\"></select>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"cod_om\">Código da OM:</label>
                                <input id=\"cod_om\" class=\"form-control\" type=\"number\" name=\"cod_om\"
                                       placeholder=\"Código da OM\" maxlength=\"8\" required=\"required\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"nome\">Nome da OM:</label>
                                <input id=\"nome\" class=\"form-control\" type=\"text\" name=\"nome\"
                                       style=\"text-transform:uppercase\" placeholder=\"Nome da OM\" 
                                       minlength=\"2\" required=\"required\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"sigla\">Sigla da OM:</label>
                                <input id=\"sigla\" class=\"form-control\" type=\"text\" name=\"sigla\"
                                       style=\"text-transform:uppercase\" placeholder=\"Sigla da OM\" 
                                       minlength=\"2\" required=\"required\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"indicativo\">Indicativo Naval da OM:</label>
                                <input id=\"indicativo\" class=\"form-control\" type=\"text\" name=\"indicativo\"
                                       style=\"text-transform:uppercase\" placeholder=\"Indicativo Naval da OM\" 
                                       maxlength=\"6\" required=\"required\">
                            </div>

                        </fieldset>
                        <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Salvar\">
                    </form>
                </div>
            </main>
        </div>
    </div>";
}

/* Monta quadro de OM */
if (($row) AND ($act == NULL)) {

	echo "<p>OM Apoiadas: ".$pg->getCol("SELECT COUNT(idtb_om_apoiadas)
        FROM db_clti.tb_om_apoiadas;")."</p>";
    echo "<p>Distribuição de OM por  ".$pg->getCol("SELECT COUNT(id_estado) 
    	FROM (SELECT id_estado FROM db_clti.tb_om_apoiadas 
    	GROUP BY id_estado) AS vw;;")." Estados </p>";
}

/* Método INSERT */
if ($act == 'insert') {
	$estado = $_POST['estado'];
	$cidade = $_POST['cidade'];
	$cod_om = $_POST['cod_om'];
	$nome = strtoupper($_POST['nome']);
    $sigla = strtoupper($_POST['sigla']);
    $indicativo = strtoupper($_POST['indicativo']);

    $sql = "SELECT id FROM db_clti.tb_estado WHERE uf = '$estado' ";
    $estado = $pg->getCol($sql);

    $sql = "SELECT id FROM db_clti.tb_cidade WHERE nome = '$cidade' ";
    $cidade = $pg->getCol($sql);

	$sql = "INSERT INTO db_clti.tb_om_apoiadas(
            id_estado, id_cidade, cod_om, 
            nome, sigla, indicativo)
	    VALUES ('$estado', '$cidade', '$cod_om', 
	    	'$nome', '$sigla', '$indicativo')";


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