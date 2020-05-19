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
$sql = "SELECT * FROM db_clti.tb_estacoes";

$row = $pg->getRow($sql);

@$act = $_GET['act'];

/* Checa se o tipo de CLTI está cadastrado */
if (($row == '0') AND ($act == NULL)) {
	echo "<h5>Não há estações cadastradas,<br />
		 clique <a href=\"?cmd=estacoes&act=cad\">aqui</a> para fazê-lo.</h5>";
}

/* Carrega form para cadastro do tipo de CLTI */
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
                    <form id=\"form\" action=\"?cmd=estacoes&act=insert\" method=\"post\" enctype=\"multipart/form-data\">
                    <fieldset>
                        <legend>Estações de Trabalho - Cadastro</legend>

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
                                  placeholder=\"ex. HP / DELL\" style=\"text-transform:uppercase\" required=\"required\">
                        </div>

                        <div class=\"form-group\">
                            <label for=\"modelo\">Modelo:</label>
                            <input id=\"modelo\" class=\"form-control\" type=\"text\" name=\"modelo\"
                                  placeholder=\"ex. Ellite 800\" style=\"text-transform:uppercase\" required=\"required\">
                        </div>

                        <div class=\"form-group\">
                            <label for=\"processador\">Processador:</label>
                            <input id=\"processador\" class=\"form-control\" type=\"text\" name=\"processador\"
                                   placeholder=\"ex. Intel Core i5 3.2GHz\" style=\"text-transform:uppercase\" 
                                   required=\"required\">
                        </div>

                        <div class=\"form-group\">
                            <label for=\"memoria\">Memória:</label>
                            <input id=\"memoria\" class=\"form-control\" type=\"text\" name=\"memoria\"
                                   placeholder=\"ex. 2x8GB (Qtde x Tamanho GB)\" style=\"text-transform:uppercase\" 
                                   required=\"required\">
                        </div>

                        <div class=\"form-group\">
                            <label for=\"armazenamento\">Armazenamento:</label>
                            <input id=\"armazenamento\" class=\"form-control\" type=\"text\" name=\"armazenamento\"
                                   placeholder=\"ex. 1x500GB SATA (Qtde x Tamanho GB Tipo)\" style=\"text-transform:uppercase\" 
                                   required=\"required\">
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

                        <div class=\"form-group\">
                            <label for=\"req_minimos\">Confomidade com Requisitos Mínimos:</label>
                            <select id=\"req_minimos\" class=\"form-control\" name=\"req_minimos\">
                                <option value=\"SIM\">SIM</option>
                                <option value=\"NÃO\">NÃO</option>
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

/* Monta quadro com tipo do CLTI */
if ($row) {
	$estacoes = "SELECT * FROM db_clti.tb_estacoes ORDER BY idtb_om_apoiadas ASC";
    $estacoes = $pg->getRows($estacoes);

    echo"<div class=\"table-responsive\">
            <table class=\"table table-hover\">
                <thead>
                    <tr>
                        <th scope=\"col\">OM Apoiada</th>
                        <th scope=\"col\">Fabricante/Modelo</th>
                        <th scope=\"col\">Hardware</th>
                        <th scope=\"col\">Sistema Operacional</th>
                        <th scope=\"col\">Endereço IP</th>
                        <th scope=\"col\">Req. Mínimos</th>
                        <th scope=\"col\">Situação</th>
                        <th scope=\"col\">Ações</th>
                    </tr>
                </thead>";

    foreach ($estacoes as $key => $value) {

        #Seleciona Sigla da OM Apoiada
        $omapoiada = $pg->getCol("SELECT sigla FROM db_clti.tb_om_apoiadas WHERE idtb_om_apoiadas = $value->idtb_om_apoiadas");

        #Seleciona Sistema Operacional
        $sor = $pg->getRows("SELECT descricao, versao FROM db_clti.tb_sor WHERE idtb_sor = $value->idtb_sor");
        
        echo"       <tr>
                        <th scope=\"row\">".$omapoiada."</th>
                        <td>".$value->fabricante." / ".$value->modelo."</td>
                        <td>".$value->processador." / ".$value->memoria." / ".$value->armazenamento."</td>
                        <td>".$value->end_ip."</td>
                        <td>";
                            foreach ($sor as $chave => $valor){
                                echo"$valor->descricao"." "."$valor->versao";
                            }
                 echo  "</td>
                        <td>".$value->req_minimos."</td>
                        <td>";
                        if ($value->situacao == "EM PRODUÇÃO"){
                            echo "<span data-feather=\"check-circle\"></span></td>";
                        }
                        if ($value->situacao == "EM MANUTENÇÃO"){
                            echo "<span data-feather=\"activity\"></span></td>";
                        }
                        if ($value->situacao == "SEM ATIVIDADE"){
                            echo "<span data-feather=\"alert-triangle\"></span></td>";
                        }
                 echo  "<td><a href=\"?cmd=admin&act=cad&param=".$value->idtb_admin."\">Editar</a> - 
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
    $processador = strtoupper($_POST['processador']);
	$memoria = strtoupper($_POST['memoria']);
    $armazenamento = strtoupper($_POST['armazenamento']);
    $end_ip = $_POST['end_ip'];
    $sor = $_POST['sor'];
    $localizacao = strtoupper($_POST['localizacao']);
    $data_aquisicao = $_POST['data_aquisicao'];
    $data_garantia = $_POST['data_garantia'];
    $req_minimos = $_POST['req_minimos'];

	$sql = "INSERT INTO db_clti.tb_estacoes(
		idtb_om_apoiadas, fabricante, modelo, processador, memoria, armazenamento, end_ip, 
            idtb_sor, localizacao, data_aquisicao, data_garantia, req_minimos)
	    VALUES ('$idtb_om_apoiadas', '$fabricante', '$modelo', '$processador', '$memoria', '$armazenamento', 
            '$end_ip', '$sor', '$localizacao', '$data_aquisicao', '$data_garantia', '$req_minimos')";

	$pg->exec($sql);

	foreach ($pg as $key => $value) {
		if ($value != '0') {
            echo "<h5>Resgistros incluídos no banco de dados.</h5>
            <meta http-equiv=\"refresh\" content=\"1;url=?cmd=estacoes\">";
		}

		else {
			echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
		}
	break;
	}
}

?>