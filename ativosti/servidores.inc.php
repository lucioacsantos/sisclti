<?php
/**
 * Servidores
 * Configurações de Servidores
 * servidores.class.php
 * 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/* Classe de interação com o PostgreSQL */
require_once "../class/pgsql.class.php";
$pg = new PgSql();

/* Recupera informações do tipo de CLTI */
$sql = "SELECT * FROM db_clti.tb_tipos_clti";

$row = $pg->getRow($sql);

@$act = $_GET['act'];

/* Checa se o tipo de CLTI está cadastrado */
if (($row == '0') AND ($act == NULL)) {
	echo "<h5>A Classificação do CLTI não foi cadastrada,<br />
		 clique <a href=\"?cmd=tipoclti&act=cad\">aqui</a> para fazê-lo.</h5>";
}

/* Carrega form para cadastro do tipo de CLTI */
if (($row == '0') AND ($act == 'cad')) {
	echo "
	<div class=\"container-fluid\">
        <div class=\"row\">
            <main>
                <div id=\"form-cadastro\">
                    <form id=\"form\" action=\"?cmd=tipoclti&act=insert\" method=\"post\" enctype=\"multipart/form-data\">
                        <fieldset>
                            <legend>Tipos de CLTI - Cadastro</legend>

                            <div class=\"form-group\">
                                <label for=\"publicacao\">Publicação:</label>
                                <input id=\"publicacao\" class=\"form-control\" type=\"text\" name=\"publicacao\"
                                       placeholder=\"ex. DCTIMARINST 30-04B\" minlength=\"2\" required=\"required\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"datapublicacao\">Data de Publicação:</label>
                                <input id=\"datapublicacao\" class=\"form-control\" type=\"date\" name=\"datapublicacao\"
                                       placeholder=\"\" minlength=\"2\" required=\"required\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"tipoclti\">Tipo do CLTI:</label>
                                <input id=\"tipoclti\" class=\"form-control\" type=\"number\" name=\"tipoclti\"
                                       placeholder=\"0\" minlength=\"2\" required=\"required\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"lotacaooficiais\">Locatação de Oficiais:</label>
                                <input id=\"lotacaooficiais\" class=\"form-control\" type=\"number\" name=\"lotacaooficiais\"
                                       placeholder=\"0\" required=\"required\">
                            </div>
                            <div class=\"form-group\">
                                <label for=\"lotacaopracas\">Locatação de Praças:</label>
                                <input id=\"lotacaopracas\" class=\"form-control\" type=\"number\" name=\"lotacaopracas\"
                                       placeholder=\"0\" required=\"required\">
                            </div>
                        </fieldset>
                        <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Salvar\">
                    </form>
                </div>
            </main>
        </div>
    </div>";
}

/* Monta quadro com tipo do CLTI */
if ($row) {
	echo "<p>Publicação: ".$row->norma_atual."</p>";
	echo "<p>Data da Publicação: ".$row->data_norma."</p>";
	echo "<p>Tipo do CLTI: ".$row->tipo_clti."</p>";
	echo "<p>Lotação de Oficiais: ".$row->lotacao_oficiais."</p>";
	echo "<p>Lotação de Praças: ".$row->lotacao_pracas."</p>";
	echo $act;
}

/* Método INSERT */
if ($act == 'insert') {
	$publicacao = $_POST['publicacao'];
	$datapublicacao = $_POST['datapublicacao'];
	$tipoclti = $_POST['tipoclti'];
	$lotacaooficiais = $_POST['lotacaooficiais'];
	$lotacaopracas = $_POST['lotacaopracas'];

	$sql = "INSERT INTO db_clti.tb_tipos_clti(
		norma_atual, data_norma, tipo_clti, lotacao_oficiais, lotacao_pracas)
	    VALUES ('$publicacao', '$datapublicacao', '$tipoclti', 
	    	'$lotacaooficiais', '$lotacaopracas')";

	$pg->exec($sql);

	foreach ($pg as $key => $value) {
		if ($value != '0') {
			echo "<h5>Resgistros incluídos no banco de dados.</h5>";
		}

		else {
			echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
		}
	break;
	}
}

?>