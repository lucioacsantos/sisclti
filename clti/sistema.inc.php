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
                            <form id=\"form\" action=\"?cmd=sistema&act=update\" method=\"post\" enctype=\"multipart/form-data\">
                                <input id=\"valor\" class=\"form-control\" type=\"text\" name=\"valor\"
                                       placeholder=\"Novo Parâmetro\" required=\"required\">
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
if ($act == 'update') {
	$valor = $_POST['valor'];
	$idtb_config = $_POST['idtb_config'];

	$sql = "UPDATE db_clti.tb_config SET valor = '$valor' WHERE idtb_config = '$idtb_config'";

	$pg->exec($sql);

	foreach ($pg as $key => $value) {
		if ($value != '0') {
            echo "<h5>Resgistros incluídos no banco de dados.</h5>
            <meta http-equiv=\"refresh\" content=\"1;url=?cmd=sistema\">";
		}

		else {
			echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
		}
	break;
	}
}

?>