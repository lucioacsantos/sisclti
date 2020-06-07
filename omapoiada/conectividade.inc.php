<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
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
    @$param = $_GET['param'];
    if ($param){
        $conectividade = $pg->getRow("SELECT * FROM db_clti.vw_conectividade WHERE idtb_conectividade = '$param'");
    }
    else{
        $conectividade = (object)['idtb_conectividade'=>'','idtb_om_apoiadas'=>'','modelo'=>'','end_ip'=>'','data_aquisicao'=>'',
            'data_garantia'=>'','fabricante'=>'','localizacao'=>'','idtb_om_apoiadas'=>'','sigla'=>''];
    }
    $idtb_om_apoiadas = $_SESSION['id_om_apoiada'];

	echo "
	<div class=\"container-fluid\">
        <div class=\"row\">
            <main>
                <div id=\"form-cadastro\">
                <form id=\"form\" action=\"?cmd=conectividade&act=insert\" method=\"post\" enctype=\"multipart/form-data\">
                <fieldset>
                    <legend>Equipamentos de Conectividade - Cadastro</legend>

                    <input type=\"hidden\" name=\"idtb_om_apoiadas\" value=\"$idtb_om_apoiadas\">

                    <div class=\"form-group\">
                        <label for=\"fabricante\">Fabricante:</label>
                        <input id=\"fabricante\" class=\"form-control\" type=\"text\" name=\"fabricante\"
                              placeholder=\"ex. CISCO\" style=\"text-transform:uppercase\"
                              value=\"$conectividade->fabricante\" required=\"true\">
                    </div>

                    <div class=\"form-group\">
                        <label for=\"modelo\">Modelo:</label>
                        <input id=\"modelo\" class=\"form-control\" type=\"text\" name=\"modelo\"
                              placeholder=\"ex. C3750-48PS-S\" style=\"text-transform:uppercase\"
                              value=\"$conectividade->modelo\" required=\"true\">
                    </div>

                    <div class=\"form-group\">
                        <label for=\"end_ip\">Endereço IP:</label>
                        <input id=\"end_ip\" class=\"form-control\" type=\"text\" name=\"end_ip\"
                               placeholder=\"ex. 192.168.1.1\" style=\"text-transform:uppercase\"
                               value=\"$conectividade->end_ip\">
                    </div>

                    <div class=\"form-group\">
                        <label for=\"localizacao\">Localização:</label>
                        <input id=\"localizacao\" class=\"form-control\" type=\"text\" name=\"localizacao\"
                            placeholder=\"ex. Sala de Servidores\"style=\"text-transform:uppercase\"
                            value=\"$conectividade->localizacao\" required=\"true\">
                    </div>

                    <div class=\"form-group\">
                        <label for=\"data_aquisicao\">Data de Aquisição:</label>
                        <input id=\"data_aquisicao\" class=\"form-control\" type=\"date\" name=\"data_aquisicao\"
                            style=\"text-transform:uppercase\" value=\"$conectividade->data_aquisicao\"
                            required=\"true\">
                    </div>

                    <div class=\"form-group\">
                        <label for=\"data_garantia\">Final da Garantia/Suporte:</label>
                        <input id=\"data_garantia\" class=\"form-control\" type=\"date\" name=\"data_garantia\"
                            style=\"text-transform:uppercase\"value=\"$conectividade->data_garantia\"
                            required=\"true\">
                    </div>

                </fieldset>
                <input id=\"idtb_conectividade\" type=\"hidden\" name=\"idtb_conectividade\" 
                            value=\"$conectividade->idtb_conectividade\">
                <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Salvar\">
            </form>
                </div>
            </main>
        </div>
    </div>";
}

/* Monta quadro com tipo do CLTI */
if (($row) AND ($act == NULL)) {
	$conectividade = $pg->getRows("SELECT * FROM db_clti.vw_conectividade ORDER BY idtb_om_apoiadas ASC");

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
        
        echo"       <tr>
                        <th scope=\"row\">".$value->sigla."</th>
                        <td>".$value->fabricante."</td>
                        <td>".$value->modelo."</td>
                        <td>".$value->end_ip."</td>
                        <td><a href=\"?cmd=conectividade&act=cad&param=".$value->idtb_conectividade."\">Editar</a> - 
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
    if (isset($_SESSION['status'])){
        $idtb_conectividade = $_POST['idtb_conectividade'];
        $idtb_om_apoiadas = $_POST['idtb_om_apoiadas'];
        $fabricante = strtoupper($_POST['fabricante']);
        $modelo = strtoupper($_POST['modelo']);
        $end_ip = $_POST['end_ip'];
        $localizacao = strtoupper($_POST['localizacao']);
        $data_aquisicao = $_POST['data_aquisicao'];
        $data_garantia = $_POST['data_garantia'];

        /* Opta pelo Método Update */
        if ($idtb_conectividade){

            $checa_ip = $pg->getRow("SELECT end_ip FROM db_clti.tb_conectividade WHERE end_ip = '$end_ip'");
            $checa_ip = $pg->getRow("SELECT end_ip FROM db_clti.tb_estacoes WHERE end_ip = '$end_ip'");
            $checa_ip = $pg->getRow("SELECT end_ip FROM db_clti.tb_servidores WHERE end_ip = '$end_ip'");

            if ($checa_ip){
                echo "<h5>Endereço IP informado já está em uso, 
                    por favor verifique!</h5>
                    <meta http-equiv=\"refresh\" content=\"5;url=?cmd=conectividade\">";
            }

            else{

                $sql = "UPDATE db_clti.tb_conectividade SET
                    idtb_om_apoiadas='$idtb_om_apoiadas', fabricante='$fabricante', modelo='$modelo', end_ip='$end_ip', 
                    localizacao='$localizacao', data_aquisicao='$data_aquisicao', data_garantia='$data_garantia'
                WHERE idtb_conectividade='$idtb_conectividade'";
        
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
        }
        
        /* Opta pelo Método Insert */
        else {

            $checa_ip = $pg->getRow("SELECT end_ip FROM db_clti.tb_conectividade WHERE end_ip = '$end_ip'");
            $checa_ip = $pg->getRow("SELECT end_ip FROM db_clti.tb_estacoes WHERE end_ip = '$end_ip'");
            $checa_ip = $pg->getRow("SELECT end_ip FROM db_clti.tb_servidores WHERE end_ip = '$end_ip'");
            
            if ($checa_ip){
                echo "<h5>Endereço IP informado já está em uso, 
                    por favor verifique!</h5>
                    <meta http-equiv=\"refresh\" content=\"5;url=?cmd=conectividade\">";
            }

            else{

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

        }
    }
    else{
        echo "<h5>Ocorreu algum erro, usuário não autenticado.</h5>
            <meta http-equiv=\"refresh\" content=\"1;$url\">";
    }
}

?>