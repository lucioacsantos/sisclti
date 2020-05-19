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
$sql = "SELECT * FROM db_clti.tb_conectividade";

$row = $pg->getRow($sql);

@$act = $_GET['act'];

/* Checa se o tipo de CLTI está cadastrado */
if (($row == '0') AND ($act == NULL)) {
	echo "<h5>Não há equipamentos de conectividade cadastrados,<br />
		 clique <a href=\"?cmd=conectividade&act=cad\">aqui</a> para fazê-lo.</h5>";
}

/* Carrega form para cadastro do tipo de CLTI */
if ($act == 'cad') {
    $omapoiada = "SELECT * FROM db_clti.tb_om_apoiadas ORDER BY sigla ASC";
    $omapoiada = $pg->getRows($omapoiada);
	echo "
	<div class=\"container-fluid\">
        <div class=\"row\">
            <main>
                <div id=\"form-cadastro\">
                <form id=\"form\" action=\"?cmd=conectividade&act=insert\" method=\"post\" enctype=\"multipart/form-data\">
                <fieldset>
                    <legend>Equipamentos de Conectividade - Cadastro</legend>

                    <div class=\"form-group\">
                        <label for=\"idtb_om_apoiadas\">OM Apoiada:</label>
                        <select id=\"idtb_om_apoiadas\" class=\"form-control\" name=\"idtb_om_apoiadas\">";
                            foreach ($omapoiada as $key => $value) {
                                echo"<option value=\"".$value->idtb_om_apoiadas."\">
                                    ".$value->sigla."</option>";
                            };
                        echo "</select>
                    </div>

                    <div class=\"form-group\">
                        <label for=\"fabricante\">Fabricante:</label>
                        <input id=\"fabricante\" class=\"form-control\" type=\"text\" name=\"fabricante\"
                              placeholder=\"ex. CISCO\" style=\"text-transform:uppercase\" required=\"required\">
                    </div>

                    <div class=\"form-group\">
                        <label for=\"modelo\">Modelo:</label>
                        <input id=\"modelo\" class=\"form-control\" type=\"text\" name=\"modelo\"
                              placeholder=\"ex. C3750-48PS-S\" style=\"text-transform:uppercase\" required=\"required\">
                    </div>

                    <div class=\"form-group\">
                        <label for=\"end_ip\">Endereço IP:</label>
                        <input id=\"end_ip\" class=\"form-control\" type=\"text\" name=\"end_ip\"
                               placeholder=\"ex. 192.168.1.1\" style=\"text-transform:uppercase\" required=\"required\">
                    </div>

                    <div class=\"form-group\">
                        <label for=\"localizacao\">Localização:</label>
                        <input id=\"localizacao\" class=\"form-control\" type=\"text\" name=\"localizacao\"
                            placeholder=\"ex. Sala de Servidores\"style=\"text-transform:uppercase\" required=\"required\">
                    </div>

                    <div class=\"form-group\">
                        <label for=\"data_aquisicao\">Data de Aquisição:</label>
                        <input id=\"data_aquisicao\" class=\"form-control\" type=\"date\" name=\"data_aquisicao\"
                            style=\"text-transform:uppercase\" required=\"required\">
                    </div>

                    <div class=\"form-group\">
                        <label for=\"data_garantia\">Final da Garantia/Suporte:</label>
                        <input id=\"data_garantia\" class=\"form-control\" type=\"date\" name=\"data_garantia\"
                            style=\"text-transform:uppercase\" required=\"required\">
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
	$conectividade = "SELECT * FROM db_clti.tb_conectividade ORDER BY idtb_om_apoiadas ASC";
    $conectividade = $pg->getRows($conectividade);

    echo"<div class=\"table-responsive\">
            <table class=\"table table-hover\">
                <thead>
                    <tr>
                        <th scope=\"col\">OM Apoiada</th>
                        <th scope=\"col\">Fabricante</th>
                        <th scope=\"col\">Modelo</th>
                        <th scope=\"col\">Endereço IP</th>
                        <th scope=\"col\">Ações</th>
                    </tr>
                </thead>";

    foreach ($conectividade as $key => $value) {

        #Seleciona Sigla da OM Apoiada
        $omapoiada = $pg->getCol("SELECT sigla FROM db_clti.tb_om_apoiadas WHERE idtb_om_apoiadas = $value->idtb_om_apoiadas");
        
        echo"       <tr>
                        <th scope=\"row\">".$omapoiada."</th>
                        <td>".$value->fabricante."</td>
                        <td>".$value->modelo."</td>
                        <td>".$value->end_ip."</td>
                        <td><a href=\"?cmd=admin&act=cad&param=".$value->idtb_admin."\">Editar</a> - 
                            Excluir</td>
                    </tr>";
    }
    echo"
                </tbody>
            </table>
            </div>";
}

/* Método INSERT */
if ($act == 'insert') {
	$idtb_om_apoiadas = $_POST['idtb_om_apoiadas'];
    $fabricante = strtoupper($_POST['fabricante']);
    $modelo = strtoupper($_POST['modelo']);
    $end_ip = $_POST['end_ip'];
    $localizacao = strtoupper($_POST['localizacao']);
    $data_aquisicao = $_POST['data_aquisicao'];
    $data_garantia = $_POST['data_garantia'];
    
	$sql = "INSERT INTO db_clti.tb_conectividade(
		    idtb_om_apoiadas, fabricante, modelo, end_ip, localizacao, data_aquisicao, data_garantia)
	    VALUES ('$idtb_om_apoiadas', '$fabricante', '$modelo', '$end_ip', '$localizacao', '$data_aquisicao', '$data_garantia')";

	$pg->exec($sql);

	foreach ($pg as $key => $value) {
		if ($value != '0') {
            echo "<h5>Resgistros incluídos no banco de dados.</h5>
            <meta http-equiv=\"refresh\" content=\"1;url=?cmd=conectividade\">";
		}

		else {
			echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
		}
	break;
	}
}

?>