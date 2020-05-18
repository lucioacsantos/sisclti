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
$sql = "SELECT * FROM db_clti.tb_servidores";

$row = $pg->getRow($sql);

@$act = $_GET['act'];

/* Checa se o tipo de CLTI está cadastrado */
if (($row == '0') AND ($act == NULL)) {
	echo "<h5>Não há servidores cadastrados,<br />
		 clique <a href=\"?cmd=servidores&act=cad\">aqui</a> para fazê-lo.</h5>";
}

/* Carrega form para cadastro de Servidores */
if ($act == 'cad') {
    $omapoiada = "SELECT * FROM db_clti.tb_om_apoiadas ORDER BY sigla ASC";
    $omapoiada = $pg->getRows($omapoiada);
    $so = "SELECT * FROM db_clti.tb_sor ORDER BY desenvolvedor,versao ASC";
    $so = $pg->getRows($so);
	echo "
	<div class=\"container-fluid\">
        <div class=\"row\">
            <main>
                <div id=\"form-cadastro\">
                    <form id=\"form\" action=\"?cmd=servidores&act=insert\" method=\"post\" enctype=\"multipart/form-data\">
                        <fieldset>
                            <legend>Servidores - Cadastro</legend>

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
                                      placeholder=\"ex. DELL / IBM\" style=\"text-transform:uppercase\" required=\"required\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"modelo\">Modelo:</label>
                                <input id=\"modelo\" class=\"form-control\" type=\"text\" name=\"modelo\"
                                      placeholder=\"ex. DL 360 Gen9\" style=\"text-transform:uppercase\" required=\"required\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"processador\">Processador:</label>
                                <input id=\"processador\" class=\"form-control\" type=\"text\" name=\"processador\"
                                       placeholder=\"ex. Intel Xeon 3.2GHz\" style=\"text-transform:uppercase\" 
                                       required=\"required\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"memoria\">Memória:</label>
                                <input id=\"memoria\" class=\"form-control\" type=\"text\" name=\"memoria\"
                                       placeholder=\"ex. 2x16GB (Qtde x Tamanho GB)\" style=\"text-transform:uppercase\" 
                                       required=\"required\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"armazenamento\">Armazenamento:</label>
                                <input id=\"armazenamento\" class=\"form-control\" type=\"text\" name=\"armazenamento\"
                                       placeholder=\"ex. 4x600GB SAS (Qtde x Tamanho GB Tipo)\" style=\"text-transform:uppercase\" 
                                       required=\"required\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"rede\">Rede:</label>
                                <input id=\"rede\" class=\"form-control\" type=\"text\" name=\"rede\"
                                       placeholder=\"ex. 2xGigaBit (Qtde x Tipo)\" style=\"text-transform:uppercase\" 
                                       required=\"required\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"end_ip\">Endereço IP:</label>
                                <input id=\"end_ip\" class=\"form-control\" type=\"text\" name=\"end_ip\"
                                       placeholder=\"ex. 192.168.1.1\" style=\"text-transform:uppercase\" required=\"required\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"finalidade\">Finalidade:</label>
                                <input id=\"finalidade\" class=\"form-control\" type=\"text\" name=\"finalidade\"
                                       placeholder=\"ex. Servidor Web\" style=\"text-transform:uppercase\" required=\"required\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"sor\">Sistema Operacional:</label>
                                <select id=\"sor\" class=\"form-control\" name=\"sor\">";
                                    foreach ($so as $key => $value) {
                                        echo"<option value=\"".$value->idtb_sor."\">
                                            ".$value->descricao." - ".$value->versao."</option>";
                                    };
                                echo "</select>
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
	$srv = "SELECT * FROM db_clti.tb_servidores ORDER BY idtb_om_apoiadas ASC";
    $srv = $pg->getRows($srv);

    echo"<div class=\"table-responsive\">
            <table class=\"table table-hover\">
                <thead>
                    <tr>
                        <th scope=\"col\">OM Apoiada</th>
                        <th scope=\"col\">Fabricante/Modelo</th>
                        <th scope=\"col\">Hardware</th>
                        <th scope=\"col\">Sistema Operacional</th>
                        <th scope=\"col\">Endereço IP</th>
                        <th scope=\"col\">Ações</th>
                    </tr>
                </thead>";

    foreach ($srv as $key => $value) {

        #Seleciona Sigla da OM Apoiada
        $omapoiada = $pg->getCol("SELECT sigla FROM db_clti.tb_om_apoiadas WHERE idtb_om_apoiadas = $value->idtb_om_apoiadas");

        #Seleciona Sistema Operacional
        $sor = $pg->getRows("SELECT descricao, versao FROM db_clti.tb_sor WHERE idtb_sor = $value->idtb_sor");
        
        echo"       <tr>
                        <th scope=\"row\">".$omapoiada."</th>
                        <td>".$value->fabricante." / ".$value->modelo."</td>
                        <td>".$value->processador." / ".$value->memoria." / ".$value->armazenamento."".$value->rede."</td>
                        <td>".$value->end_ip."</td>
                        <td>";
                            foreach ($sor as $key => $value){
                                echo"$value->descricao"." "."$value->versao";
                            }
                 echo  "</td>
                        <td>Editar - Excluir</td>
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
    $processador = strtoupper($_POST['processador']);
	$memoria = strtoupper($_POST['memoria']);
    $armazenamento = strtoupper($_POST['armazenamento']);
    $rede = strtoupper($_POST['rede']);
    $end_ip = $_POST['end_ip'];
    $finalidade = strtoupper($_POST['finalidade']);
    $sor = $_POST['sor'];
    $localizacao = strtoupper($_POST['localizacao']);
    $data_aquisicao = $_POST['data_aquisicao'];
    $data_garantia = $_POST['data_garantia'];

	$sql = "INSERT INTO db_clti.tb_servidores(
		idtb_om_apoiadas, fabricante, modelo, processador, memoria, armazenamento, rede, end_ip, 
            finalidade, idtb_sor, localizacao, data_aquisicao, data_garantia)
	    VALUES ('$idtb_om_apoiadas', '$fabricante', '$modelo', '$processador', '$memoria', '$armazenamento', 
            '$rede', '$end_ip', '$finalidade', '$sor', '$localizacao', '$data_aquisicao', '$data_garantia')";

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