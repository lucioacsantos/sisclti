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
$sql = "SELECT * FROM db_clti.tb_config";

$row = $pg->getRow($sql);

@$cmd = $_GET['cmd'];
@$act = $_GET['act'];

/* Carregar form para cadastro do CLTI */
if ($act == 'cad') {
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
                                       placeholder=\"Nome do CLTI\" minlength=\"2\" required=\"required\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"siglaclti\">Sigla do CLTI:</label>
                                <input id=\"siglaclti\" class=\"form-control\" type=\"text\" name=\"siglaclti\"
                                       placeholder=\"Sigla do CLTI\" minlength=\"2\" required=\"required\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"indicativoclti\">Indicativo Naval do CLTI:</label>
                                <input id=\"indicativoclti\" class=\"form-control\" type=\"text\" name=\"indicativoclti\"
                                       placeholder=\"Indicativo Naval do CLTI\" minlength=\"2\" required=\"required\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"dataativacao\">Data de Ativação do CLTI:</label>
                                <input id=\"dataativacao\" class=\"form-control\" type=\"date\" name=\"dataativacao\"
                                       placeholder=\"Data de Ativação do CLTI\" minlength=\"2\" required=\"required\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"efetivooficiais\">Efetivo de Oficiais:</label>
                                <input id=\"efetivooficiais\" class=\"form-control\" type=\"number\" name=\"efetivooficiais\"
                                       placeholder=\"Efetivo de Oficiais\" minlength=\"2\" required=\"required\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"efetivopracas\">Efetivo de Praças:</label>
                                <input id=\"efetivopracas\" class=\"form-control\" type=\"number\" name=\"efetivopracas\"
                                       placeholder=\"Efetivo de Praças\" minlength=\"2\" required=\"required\">
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

    $config = "SELECT * FROM db_clti.tb_config";
    $config = $pg->getRows($config);

    echo"<div class=\"table-responsive\">
            <table class=\"table table-hover\">
                <thead>
                    <tr>
                        <th scope=\"col\">Parâmetro</th>
                        <th scope=\"col\">Configuração</th>
                        <th scope=\"col\">Novo Parâmetro</th>
                        <th scope=\"col\">Ações</th>
                    </tr>
                </thead>";

    foreach ($config as $key => $value){
        
        echo"       <tr>
                        <th scope=\"row\">".$value->parametro."</th>
                        <td>".$value->valor."</td>
                        <td>
                            <form id=\"form\" action=\"?cmd=sistema&act=insert\" method=\"post\" enctype=\"multipart/form-data\">
                                <input id=\"valor\" class=\"form-control\" type=\"text\" name=\"valor\"
                                       placeholder=\"ex. http://www.site.mb/sisclti\" required=\"required\">
                                <input id=\"idtb_config\" class=\"form-control\" type=\"text\" name=\"idtb_config\" 
                                    value=\"$value->idtb_config\" hidden=\"true\">
                        </td>
                        <td>
                                <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Salvar\">
                            </form>
                        </td>
                    </tr>";
    }
    echo"
                </tbody>
            </table>
            </div>";
}

/* Método INSERT */
if ($act == 'insert') {
	$valor = $_POST['valor'];
	$idtb_config = $_POST['idtb_config'];

	$sql = "UPDATE db_clti.tb_config SET valor = '$valor' WHERE idtb_config = '$idtb_config'";

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