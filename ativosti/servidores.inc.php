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
    @$param = $_GET['param'];
    if ($param){
        $servidor = $pg->getRow("SELECT * FROM db_clti.tb_servidores WHERE idtb_servidores = '$param'");
        $srv_om = $pg->getRow("SELECT * FROM db_clti.tb_om_apoiadas WHERE idtb_om_apoiadas = '$servidor->idtb_om_apoiadas'");
        $srv_sor = $pg->getRow("SELECT * FROM db_clti.tb_sor WHERE idtb_sor = '$servidor->idtb_sor'");
    }
    else{
        $servidor = (object)['idtb_servidores'=>'','idtb_om_apoiadas'=>'','modelo'=>'','processador'=>'','memoria'=>'',
            'armazenamento'=>'','rede'=>'','idtb_sor'=>'','end_ip'=>'','finalidade'=>'','data_aquisicao'=>'',
            'data_garantia'=>'','fabricante'=>'','localizacao'=>''];
        $srv_om = (object)['idtb_om_apoiadas'=>'','sigla'=>''];
    }
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
                                <select id=\"idtb_om_apoiadas\" class=\"form-control\" name=\"idtb_om_apoiadas\">
                                    <option value=\"$servidor->idtb_om_apoiadas\" selected=\"true\">
                                        $srv_om->sigla</option>";
                                    foreach ($omapoiada as $key => $value) {
                                        echo"<option value=\"".$value->idtb_om_apoiadas."\">
                                            ".$value->sigla."</option>";
                                    };
                                echo "</select>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"fabricante\">Fabricante:</label>
                                <input id=\"fabricante\" class=\"form-control\" type=\"text\" name=\"fabricante\"
                                      placeholder=\"ex. DELL / IBM\" style=\"text-transform:uppercase\" 
                                      value=\"$servidor->fabricante\" required=\"required\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"modelo\">Modelo:</label>
                                <input id=\"modelo\" class=\"form-control\" type=\"text\" name=\"modelo\"
                                      placeholder=\"ex. DL 360 Gen9\" style=\"text-transform:uppercase\"
                                      value=\"$servidor->modelo\"  required=\"required\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"processador\">Processador:</label>
                                <input id=\"processador\" class=\"form-control\" type=\"text\" name=\"processador\"
                                       placeholder=\"ex. Intel Xeon 3.2GHz\" style=\"text-transform:uppercase\" 
                                       value=\"$servidor->processador\" required=\"required\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"memoria\">Memória:</label>
                                <input id=\"memoria\" class=\"form-control\" type=\"text\" name=\"memoria\"
                                       placeholder=\"ex. 2x16GB (Qtde x Tamanho GB)\" style=\"text-transform:uppercase\" 
                                       value=\"$servidor->memoria\" required=\"required\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"armazenamento\">Armazenamento:</label>
                                <input id=\"armazenamento\" class=\"form-control\" type=\"text\" name=\"armazenamento\"
                                       placeholder=\"ex. 4x600GB SAS (Qtde x Tamanho GB Tipo)\" style=\"text-transform:uppercase\" 
                                       value=\"$servidor->armazenamento\" required=\"required\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"rede\">Rede:</label>
                                <input id=\"rede\" class=\"form-control\" type=\"text\" name=\"rede\"
                                       placeholder=\"ex. 2xGigaBit (Qtde x Tipo)\" style=\"text-transform:uppercase\" 
                                       value=\"$servidor->rede\" required=\"required\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"end_ip\">Endereço IP:</label>
                                <input id=\"end_ip\" class=\"form-control\" type=\"text\" name=\"end_ip\"
                                       placeholder=\"ex. 192.168.1.1\" style=\"text-transform:uppercase\" 
                                       value=\"$servidor->end_ip\" required=\"required\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"finalidade\">Finalidade:</label>
                                <input id=\"finalidade\" class=\"form-control\" type=\"text\" name=\"finalidade\"
                                       placeholder=\"ex. Servidor Web\" style=\"text-transform:uppercase\" 
                                       value=\"$servidor->finalidade\" required=\"required\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"sor\">Sistema Operacional:</label>
                                <select id=\"sor\" class=\"form-control\" name=\"sor\">
                                    <option value=\"$servidor->idtb_sor\" selected=\"true\">
                                        ".$srv_sor->descricao." - ".$srv_sor->versao."</option>";
                                    foreach ($so as $key => $value) {
                                        echo"<option value=\"".$value->idtb_sor."\">
                                            ".$value->descricao." - ".$value->versao."</option>";
                                    };
                                echo "</select>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"localizacao\">Localização:</label>
                                <input id=\"localizacao\" class=\"form-control\" type=\"text\" name=\"localizacao\"
                                    placeholder=\"ex. Sala de Servidores\" style=\"text-transform:uppercase\" 
                                    value=\"$servidor->localizacao\" required=\"required\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"data_aquisicao\">Data de Aquisição:</label>
                                <input id=\"data_aquisicao\" class=\"form-control\" type=\"date\" name=\"data_aquisicao\"
                                    style=\"text-transform:uppercase\" value=\"$servidor->data_aquisicao\" required=\"required\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"data_garantia\">Final da Garantia/Suporte:</label>
                                <input id=\"data_garantia\" class=\"form-control\" type=\"date\" name=\"data_garantia\"
                                    style=\"text-transform:uppercase\" value=\"$servidor->data_garantia\" required=\"required\">
                            </div>

                        </fieldset>
                        <input id=\"idtb_servidores\" type=\"hidden\" name=\"idtb_servidores\" 
                            value=\"$servidor->idtb_servidores\">
                        <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Salvar\">
                    </form>
                </div>
            </main>
        </div>
    </div>";
}

/* Monta quadro com tipo do CLTI */
if (($row) AND ($act == NULL)) {
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
                            foreach ($sor as $key => $sor){
                                echo"$sor->descricao"." "."$sor->versao";
                            }
                 echo  "</td>
                        <td><a href=\"?cmd=servidores&act=cad&param=".$value->idtb_servidores."\">Editar</a> - 
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
    $idtb_servidores = $_POST['idtb_servidores'];
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

    /* Opta pelo Método Update */
    if ($idtb_servidores){

        $checa_ip = $pg->getRow("SELECT end_ip FROM db_clti.tb_conectividade WHERE end_ip = '$end_ip'");
        $checa_ip = $pg->getRow("SELECT end_ip FROM db_clti.tb_estacoes WHERE end_ip = '$end_ip'");
        $checa_ip = $pg->getRow("SELECT end_ip FROM db_clti.tb_servidores WHERE end_ip = '$end_ip'");

        if ($checa_ip){
            echo "<h5>Endereço IP informado já está em uso, 
                por favor verifique!</h5>
                <meta http-equiv=\"refresh\" content=\"5;url=?cmd=servidores\">";
        }

        else{

            $sql = "UPDATE db_clti.tb_servidores SET 
            idtb_om_apoiadas='$idtb_om_apoiadas', fabricante='$fabricante', modelo='$modelo', processador='$processador', 
                memoria='$memoria', armazenamento='$armazenamento', rede='$rede', end_ip='$end_ip', finalidade='$finalidade', 
                idtb_sor='$sor', localizacao='$localizacao', data_aquisicao='$data_aquisicao', data_garantia='$data_garantia'
            WHERE idtb_servidores='$idtb_servidores'";
    
            $pg->exec($sql);
        
            foreach ($pg as $key => $value) {
                if ($value != '0') {
                    echo "<h5>Resgistros incluídos no banco de dados.</h5>
                    <meta http-equiv=\"refresh\" content=\"1;url=?cmd=servidores\">";
                }
        
                else {
                    echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
                }
            break;
            }

        }

    }

    /* Opta pelo Método Insert */
    else{

        $checa_ip = $pg->getRow("SELECT end_ip FROM db_clti.tb_conectividade WHERE end_ip = '$end_ip'");
        $checa_ip = $pg->getRow("SELECT end_ip FROM db_clti.tb_estacoes WHERE end_ip = '$end_ip'");
        $checa_ip = $pg->getRow("SELECT end_ip FROM db_clti.tb_servidores WHERE end_ip = '$end_ip'");

        if ($checa_ip){
            echo "<h5>Endereço IP informado já está em uso, 
                por favor verifique!</h5>
                <meta http-equiv=\"refresh\" content=\"5;url=?cmd=servidores\">";
        }

        else{

            $sql = "INSERT INTO db_clti.tb_servidores(
                idtb_om_apoiadas, fabricante, modelo, processador, memoria, armazenamento, rede, end_ip, 
                    finalidade, idtb_sor, localizacao, data_aquisicao, data_garantia)
                VALUES ('$idtb_om_apoiadas', '$fabricante', '$modelo', '$processador', '$memoria', '$armazenamento', 
                    '$rede', '$end_ip', '$finalidade', '$sor', '$localizacao', '$data_aquisicao', '$data_garantia')";
        
            $pg->exec($sql);
        
            foreach ($pg as $key => $value) {
                if ($value != '0') {
                    echo "<h5>Resgistros incluídos no banco de dados.</h5>
                    <meta http-equiv=\"refresh\" content=\"1;url=?cmd=servidores\">";
                }
        
                else {
                    echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
                }
            break;
            }

        }

    }

}

?>