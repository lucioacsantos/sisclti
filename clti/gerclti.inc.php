<?php
/**
 * GerCLTI
 * Gerenciamento de parâmetros do CLTI
 * gerclti.class.php
 * 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/* Clasee de interação com o PostgreSQL */
require_once "../class/pgsql.class.php";
$pg = new PgSql();

/* Recupera informações do CLTI */
$sql = "SELECT * FROM db_clti.tb_clti";

$row = $pg->getRow($sql);

@$act = $_GET['act'];

/* Checa se há cadastro do CLTI */
if (($row == '0') AND ($act == NULL)) {
	echo "<h5>Não há um CLTI cadastrado, clique <a href=\"?cmd=gerclti&act=cad\">aqui</a> para fazê-lo.</h5>";
}

/* Carregar form para cadastro do CLTI */
if (($row == '0') AND ($act)) {
	$tiposclti = "SELECT * FROM db_clti.tb_tipos_clti";
	$tiposclti = $pg->getRow($tiposclti);
	echo "
	<div class=\"container-fluid\">
        <div class=\"row\">
            <main>
                <div id=\"form-cadastro\">
                    <form id=\"form\" action=\"?cmd=gerclti&act=insert\" method=\"post\" enctype=\"multipart/form-data\">
                        <fieldset>
                            <legend>CLTI - Cadastro</legend>

                            <div class=\"form-group\">
                                <label for=\"tipoclti\">Tipo do CLTI:</label>
                                <select id=\"tipoclti\" class=\"form-control\" name=\"tipoclti\">
                                	<option value=\"".$tiposclti->idtipos_clti."\">
                                		CLTI Tipo: ".$tiposclti->tipo_clti."</option>
                                </select>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"nomeclti\">Nome do CLTI:</label>
                                <input id=\"nomeclti\" class=\"form-control\" type=\"text\" name=\"nomeclti\"
                                       placeholder=\"Nome do CLTI\" minlength=\"2\" required=\"true\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"siglaclti\">Sigla do CLTI:</label>
                                <input id=\"siglaclti\" class=\"form-control\" type=\"text\" name=\"siglaclti\"
                                       placeholder=\"Sigla do CLTI\" minlength=\"2\" required=\"true\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"indicativoclti\">Indicativo Naval do CLTI:</label>
                                <input id=\"indicativoclti\" class=\"form-control\" type=\"text\" name=\"indicativoclti\"
                                       placeholder=\"Indicativo Naval do CLTI\" minlength=\"2\" required=\"true\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"dataativacao\">Data de Ativação do CLTI:</label>
                                <input id=\"dataativacao\" class=\"form-control\" type=\"date\" name=\"dataativacao\"
                                       placeholder=\"Data de Ativação do CLTI\" minlength=\"2\" required=\"true\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"efetivooficiais\">Efetivo de Oficiais:</label>
                                <input id=\"efetivooficiais\" class=\"form-control\" type=\"number\" name=\"efetivooficiais\"
                                       placeholder=\"Efetivo de Oficiais\" minlength=\"2\" required=\"true\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"efetivopracas\">Efetivo de Praças:</label>
                                <input id=\"efetivopracas\" class=\"form-control\" type=\"number\" name=\"efetivopracas\"
                                       placeholder=\"Efetivo de Praças\" minlength=\"2\" required=\"true\">
                            </div>
                        </fieldset>
                        <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Salvar\">
                    </form>
                </div>
            </main>
        </div>
    </div>";
}

if ($row) {
    $idtipos_clti = $row->idtipos_clti;
    $tiposclti = "SELECT tipo_clti FROM db_clti.tb_tipos_clti WHERE idtipos_clti='$idtipos_clti' ";
    $tiposclti = $pg->getCol($tiposclti);
	echo "<p>Tipo do CLTI: ".$tiposclti."</p>";
	echo "<p>Nome do CLTI: ".$row->nome."</p>";
	echo "<p>Sigla do CLTI: ".$row->sigla."</p>";
	echo "<p>Indicativo do CLTI: ".$row->indicativo."</p>";
	echo "<p>Data de Ativação: ".$row->data_ativacao."</p>";
	echo "<p>Efetivo de Oficiais: ".$row->efetivo_oficiais."</p>";
	echo "<p>Efetivo de Praças: ".$row->efetivo_pracas."</p>";
	echo $act;
}

/* Método INSERT */
if ($act == 'insert') {
    if (isset($_SESSION['status'])){
        $tipoclti = $_POST['tipoclti'];
        $nomeclti = $_POST['nomeclti'];
        $siglaclti = $_POST['siglaclti'];
        $indicativoclti = $_POST['indicativoclti'];
        $dataativacao = $_POST['dataativacao'];
        $efetivooficiais = $_POST['efetivooficiais'];
        $efetivopracas = $_POST['efetivopracas'];

        $sql = "INSERT INTO db_clti.tb_clti(
            idtipos_clti, efetivo_oficiais, efetivo_pracas, nome, 
                sigla, indicativo, data_ativacao)
            VALUES ('$tipoclti','$efetivooficiais','$efetivopracas',
                '$nomeclti','$siglaclti','$indicativoclti','$dataativacao');";

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
    else{
        echo "<h5>Ocorreu algum erro, usuário não autenticado.</h5>
            <meta http-equiv=\"refresh\" content=\"1;$url\">";
    }
}

?>