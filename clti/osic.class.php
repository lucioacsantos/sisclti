<?php
/**
 * OSIC
 * Operações relacionadas aos OSIC
 * osci.class.php
 * 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/* Classe de interação com o PostgreSQL */
require_once "../class/pgsql.class.php";
$pg = new PgSql();

/* Recupera informações dos OSIC */
$sql = "SELECT * FROM db_clti.tb_osic";

$row = $pg->getRow($sql);

@$act = $_GET['act'];

/* Checa se há OSIC cadastrado */
if (($row == '0') AND ($act == NULL)) {
	echo "<h5>Não há OSIC cadastrados, clique <a href=\"?cmd=osic&act=cad\">aqui</a> para fazê-lo.</h5>";
}

/* Carrega form para cadastro de OSIC */
if ($act == 'cad') {
	$omapoiada = "SELECT * FROM db_clti.tb_om_apoiadas ORDER BY sigla ASC";
    $omapoiada = $pg->getRows($omapoiada);
    $postograd = "SELECT * FROM db_clti.tb_posto_grad";
    $postograd = $pg->getRows($postograd);
    $corpoquadro = "SELECT * FROM db_clti.tb_corpo_quadro";
    $corpoquadro = $pg->getRows($corpoquadro);
    $especialidade = "SELECT * FROM db_clti.tb_especialidade ORDER BY nome ASC";
    $especialidade = $pg->getRows($especialidade);
    echo "
	<div class=\"container-fluid\">
        <div class=\"row\">
            <main>
                <div id=\"form-cadastro\">
                    <form id=\"form\" action=\"?cmd=osic&act=insert\" method=\"post\" enctype=\"multipart/form-data\">
                        <fieldset>
                            <legend>OSIC - Cadastro</legend>

                            <div class=\"form-group\">
                                <label for=\"omapoiada\">OM Apoiada:</label>
                                <select id=\"omapoiada\" class=\"form-control\" name=\"omapoiada\">";
                                    foreach ($omapoiada as $key => $value) {
                                        echo"<option value=\"".$value->idtb_om_apoiadas."\">
                                            ".$value->sigla."</option>";
                                    };
                                echo "</select>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"postograd\">Posto/Graduação:</label>
                                <select id=\"postograd\" class=\"form-control\" name=\"postograd\">";
                                    foreach ($postograd as $key => $value) {
                                        echo"<option value=\"".$value->idtb_posto_grad."\">
                                            ".$value->nome."</option>";
                                    };
                                echo "</select>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"corpoquadro\">Corpo/Quadro:</label>
                                <select id=\"corpoquadro\" class=\"form-control\" name=\"corpoquadro\">";
                                    foreach ($corpoquadro as $key => $value) {
                                        echo"<option value=\"".$value->idtb_corpo_quadro."\">
                                            ".$value->nome."</option>";
                                    };
                                echo "</select>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"especialidade\">Especialidade:</label>
                                <select id=\"especialidade\" class=\"form-control\" name=\"especialidade\">";
                                    foreach ($especialidade as $key => $value) {
                                        echo"<option value=\"".$value->idtb_especialidade."\">
                                            ".$value->nome."</option>";
                                    };
                                echo "</select>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"nip\">NIP:</label>
                                <input id=\"nip\" class=\"form-control\" type=\"text\" name=\"nip\"
                                       placeholder=\"NIP\" maxlength=\"8\" required=\"required\">
                            </div>
                            <div class=\"form-group\">
                                <label for=\"cpf\">CPF (Servidores Civis):</label>
                                <input id=\"cpf\" class=\"form-control\" type=\"text\" name=\"cpf\"
                                       placeholder=\"CPF (Servidores Civis)\" maxlength=\"11\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"nome\">Nome Completo:</label>
                                <input id=\"nome\" class=\"form-control\" type=\"text\" name=\"nome\"
                                       placeholder=\"Nome Completo\" minlength=\"2\" 
                                       style=\"text-transform:uppercase\" required=\"required\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"nomeguerra\">Nome de Guerra:</label>
                                <input id=\"nomeguerra\" class=\"form-control\" type=\"text\" name=\"nomeguerra\"
                                       placeholder=\"Nome de Guerra\" minlength=\"2\"
                                       style=\"text-transform:uppercase\" required=\"required\">
                            </div>

                        </fieldset>
                        <input type=\"hidden\" id=\"status\" name=\"status\" value=\"Ativo\">
                        <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Salvar\">
                    </form>
                </div>
            </main>
        </div>
    </div>";
}

/* Monta quadro de OSIC */
if (($row) AND ($act == NULL)) {

	echo "<p>OM Apoiadas: ".$pg->getCol("SELECT COUNT(idtb_om_apoiadas)
        FROM db_clti.tb_om_apoiadas;")."</p>";
    echo "<p>Distribuição de OM por  ".$pg->getCol("SELECT COUNT(id_estado) 
    	FROM (SELECT id_estado FROM db_clti.tb_om_apoiadas 
    	GROUP BY id_estado) AS vw;;")." Estados </p>";
}

/* Método INSERT */
if ($act == 'insert') {
	$omapoiada = $_POST['omapoiada'];
    $postograd = $_POST['postograd'];
    $corpoquadro = $_POST['corpoquadro'];
    $especialidade = $_POST['especialidade'];
    $nip = $_POST['nip'];
    $cpf = $_POST['cpf'];
    $nome = strtoupper($_POST['nome']);
    $nomeguerra = strtoupper($_POST['nomeguerra']);
    $status = $_POST['status'];

    $sql = "INSERT INTO db_clti.tb_osic(id_om,
            id_posto_grad, id_corpo_quadro, id_especialidade, 
            nip, cpf, nome, nome_guerra, status)
        VALUES ('$omapoiada', '$postograd', '$corpoquadro', '$especialidade', 
            '$nip', '$cpf', '$nome', '$nomeguerra', '$status')";


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