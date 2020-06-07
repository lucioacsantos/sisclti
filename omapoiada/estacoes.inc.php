<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
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
    @$param = $_GET['param'];
    if ($param){
        $estacoes = $pg->getRow("SELECT * FROM db_clti.vw_estacoes WHERE idtb_estacoes = '$param'");
    }
    else{
        $estacoes = (object)['idtb_estacoes'=>'','idtb_om_apoiadas'=>'','sigla'=>'','fabricante'=>'','modelo'=>'',
            'idtb_proc_modelo'=>'','proc_modelo'=>'','proc_fab'=>'','clock_proc'=>'','memoria'=>'','armazenamento'=>'',
            'idtb_sor'=>'','descricao'=>'','versao'=>'','end_ip'=>'','end_mac'=>'','data_aquisicao'=>'NULL',
            'data_garantia'=>'NULL','localizacao'=>'','req_minimos'=>'','situacao'=>''];
    }
    $omapoiada = $_SESSION['id_om_apoiada'];
    $so = $pg->getRows("SELECT * FROM db_clti.tb_sor ORDER BY desenvolvedor,versao ASC");
    $proc = $pg->getRows("SELECT * FROM db_clti.vw_processadores ORDER BY fabricante ASC");
	echo "
	<div class=\"container-fluid\">
        <div class=\"row\">
            <main>
                <div id=\"form-cadastro\">
                    <form id=\"form\" action=\"?cmd=estacoes&act=insert\" method=\"post\" enctype=\"multipart/form-data\">
                    <fieldset>
                        <legend>Estações de Trabalho - Cadastro</legend>

                        <input type=\"hidden\" name=\"idtb_om_apoiadas\" value=\"$omapoiada\">

                        <div class=\"form-group\">
                            <label for=\"fabricante\">Fabricante:</label>
                            <input id=\"fabricante\" class=\"form-control\" type=\"text\" name=\"fabricante\"
                                  placeholder=\"ex. HP / DELL\" style=\"text-transform:uppercase\" 
                                  value=\"$estacoes->fabricante\" required=\"true\">
                        </div>

                        <div class=\"form-group\">
                            <label for=\"modelo\">Modelo:</label>
                            <input id=\"modelo\" class=\"form-control\" type=\"text\" name=\"modelo\"
                                  placeholder=\"ex. Ellite 800\" style=\"text-transform:uppercase\" 
                                  value=\"$estacoes->modelo\" required=\"true\">
                        </div>

                        <div class=\"form-group\">
                            <label for=\"idtb_proc_modelo\">Processador:</label>
                            <select id=\"idtb_proc_modelo\" class=\"form-control\" name=\"idtb_proc_modelo\">
                            <option value=\"$estacoes->idtb_proc_modelo\" selected=\"true\">
                                    ".$estacoes->proc_fab." - ".$estacoes->proc_modelo."</option>";
                                foreach ($proc as $key => $value) {
                                    echo"<option value=\"".$value->idtb_proc_modelo."\">
                                        ".$value->fabricante." - ".$value->modelo."</option>";
                                };
                            echo "</select>
                        </div>

                        <div class=\"form-group\">
                            <label for=\"clock_proc\">Clock do Processador:</label>
                            <input id=\"clock_proc\" class=\"form-control\" type=\"number\" name=\"clock_proc\"
                                min=\"0\" step=\"0.1\" placeholder=\"ex. 3.2 (Em GHZ)\" 
                                value=\"$estacoes->clock_proc\" required=\"true\">
                        </div>

                        <div class=\"form-group\">
                            <label for=\"memoria\">Memória:</label>
                            <input id=\"memoria\" class=\"form-control\" type=\"number\" name=\"memoria\"
                                   placeholder=\"ex. 16 (Total em GB)\" value=\"$estacoes->memoria\" required=\"true\">
                        </div>

                        <div class=\"form-group\">
                            <label for=\"armazenamento\">Armazenamento (HD):</label>
                            <input id=\"armazenamento\" class=\"form-control\" type=\"number\" name=\"armazenamento\"
                                   placeholder=\"500 (Total em GB)\" value=\"$estacoes->armazenamento\" required=\"true\">
                        </div>

                        <div class=\"form-group\">
                            <label for=\"idtb_sor\">Sistema Operacional:</label>
                            <select id=\"idtb_sor\" class=\"form-control\" name=\"idtb_sor\">
                                <option value=\"$estacoes->idtb_sor\" selected=\"true\">
                                    ".$estacoes->descricao." - ".$estacoes->versao."</option>";
                                foreach ($so as $key => $value) {
                                    echo"<option value=\"".$value->idtb_sor."\">
                                        ".$value->descricao." - ".$value->versao."</option>";
                                };
                            echo "</select>
                        </div>

                        <div class=\"form-group\">
                            <label for=\"end_ip\">Endereço IP:</label>
                            <input id=\"end_ip\" class=\"form-control\" type=\"text\" name=\"end_ip\"
                                   placeholder=\"ex. 192.168.1.1\" style=\"text-transform:uppercase\"
                                   value=\"$estacoes->end_ip\" maxlength=\"15\" required=\"true\">
                        </div>

                        <div class=\"form-group\">
                            <label for=\"end_mac\">Endereço MAC:</label>
                            <input id=\"end_mac\" class=\"form-control\" type=\"text\" name=\"end_mac\"
                                   placeholder=\"ex. FF-FF-FF-FF-FF-FF-FF-FF\" style=\"text-transform:uppercase\"
                                   value=\"$estacoes->end_mac\" maxlength=\"23\" required=\"true\">
                        </div>

                        <div class=\"form-group\">
                            <label for=\"localizacao\">Localização:</label>
                            <input id=\"localizacao\" class=\"form-control\" type=\"text\" name=\"localizacao\"
                                placeholder=\"ex. Sala de Servidores\" style=\"text-transform:uppercase\"
                                value=\"$estacoes->localizacao\" required=\"true\">
                        </div>

                        <div class=\"form-group\">
                            <label for=\"data_aquisicao\">Data de Aquisição:</label>
                            <input id=\"data_aquisicao\" class=\"form-control\" type=\"date\" name=\"data_aquisicao\"
                                style=\"text-transform:uppercase\" value=\"$estacoes->data_aquisicao\" required=\"true\">
                        </div>

                        <div class=\"form-group\">
                            <label for=\"data_garantia\">Final da Garantia/Suporte:</label>
                            <input id=\"data_garantia\" class=\"form-control\" type=\"date\" name=\"data_garantia\"
                                style=\"text-transform:uppercase\" value=\"$estacoes->data_garantia\" required=\"true\">
                        </div>

                        <div class=\"form-group\">
                            <label for=\"req_minimos\">Confomidade com Requisitos Mínimos:</label>
                            <select id=\"req_minimos\" class=\"form-control\" name=\"req_minimos\">
                                <option value=\"$estacoes->req_minimos\" selected=\"true\">
                                    $estacoes->req_minimos</option>
                                <option value=\"SIM\">SIM</option>
                                <option value=\"NÃO\">NÃO</option>
                            </select>
                        </div>";
                        if ($param){
                            echo"
                            <div class=\"form-group\">
                            <label for=\"status\">Situação:</label>
                            <select id=\"status\" class=\"form-control\" name=\"status\">
                                <option value=\"$estacoes->status\" selected=\"true\">
                                    $estacoes->status</option>
                                <option value=\"EM PRODUÇÃO\">EM PRODUÇÃO</option>
                                <option value=\"EM MANUTENÇÃO\">EM MANUTENÇÃO</option>
                            </select>
                        </div>";
                        }
                        else{
                            echo"<input id=\"status\" type=\"hidden\" name=\"status\" 
                            value=\"EM PRODUÇÃO\">";
                        }
                    echo"
                    </fieldset>
                    <input id=\"idtb_estacoes\" type=\"hidden\" name=\"idtb_estacoes\" 
                            value=\"$estacoes->idtb_estacoes\">
                    <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Salvar\">
                </form>
                </div>
            </main>
        </div>
    </div>";
}

/* Monta quadro com tipo do CLTI */
if (($row) AND ($act == NULL)) {

	$estacoes = "SELECT * FROM db_clti.vw_estacoes ORDER BY idtb_om_apoiadas ASC";
    $estacoes = $pg->getRows($estacoes);

    echo"<div class=\"table-responsive\">
            <table class=\"table table-hover\">
                <thead>
                    <tr>
                        <th scope=\"col\">OM Apoiada</th>
                        <th scope=\"col\">Fabricante/Modelo</th>
                        <th scope=\"col\">Hardware</th>
                        <th scope=\"col\">Sistema Operacional</th>
                        <th scope=\"col\">Endereço IP/MAC</th>
                        <th scope=\"col\">Req. Mínimos</th>
                        <th scope=\"col\">Situação</th>
                        <th scope=\"col\">Ações</th>
                    </tr>
                </thead>";

    foreach ($estacoes as $key => $value) {

        echo"       <tr>
                        <th scope=\"row\">".$value->sigla."</th>
                        <td>".$value->fabricante." / ".$value->modelo."</td>
                        <td>".$value->proc_fab." - ".$value->proc_modelo." - ".$value->clock_proc." GHz "
                            .$value->memoria." GB/RAM ".$value->armazenamento." GB/HD</td>
                        <td>".$value->descricao." - ".$value->versao."</td>
                        <td>".$value->end_ip." / ".$value->end_mac."</td>
                        <td>".$value->req_minimos."</td>
                        <td>";
                        if ($value->status == "EM PRODUÇÃO"){
                            echo "<span data-feather=\"check-circle\"></span></td>";
                        }
                        if ($value->status == "EM MANUTENÇÃO"){
                            echo "<span data-feather=\"activity\"></span></td>";
                        }
                        if ($value->status == "SEM ATIVIDADE"){
                            echo "<span data-feather=\"alert-triangle\"></span></td>";
                        }
                 echo  "<td><a href=\"?cmd=estacoes&act=cad&param=".$value->idtb_estacoes."\">Editar</a> - 
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
        
        $idtb_estacoes = $_POST['idtb_estacoes'];
        $idtb_om_apoiadas = $_POST['idtb_om_apoiadas'];
        $fabricante = strtoupper($_POST['fabricante']);
        $modelo = strtoupper($_POST['modelo']);
        $idtb_proc_modelo = $_POST['idtb_proc_modelo'];
        $clock_proc = $_POST['clock_proc'];
        $memoria = strtoupper($_POST['memoria']);
        $armazenamento = strtoupper($_POST['armazenamento']);
        $end_ip = $_POST['end_ip'];
        $end_mac = $_POST['end_mac'];
        $idtb_sor = $_POST['idtb_sor'];
        $localizacao = strtoupper($_POST['localizacao']);
        $data_aquisicao = $_POST['data_aquisicao'];
        $data_garantia = $_POST['data_garantia'];
        $req_minimos = $_POST['req_minimos'];
        $status = $_POST['status'];

        /* Opta pelo Método Update */
        if ($idtb_estacoes){

            $sql = "UPDATE db_clti.tb_estacoes SET 
                idtb_om_apoiadas='$idtb_om_apoiadas', fabricante='$fabricante', modelo='$modelo', 
                idtb_proc_modelo='$idtb_proc_modelo', clock_proc='$clock_proc', memoria='$memoria', 
                armazenamento='$armazenamento', end_ip='$end_ip', end_mac='$end_mac', idtb_sor='$idtb_sor', 
                localizacao='$localizacao', data_aquisicao='$data_aquisicao', data_garantia='$data_garantia', 
                req_minimos='$req_minimos', status='$status'
            WHERE idtb_estacoes='$idtb_estacoes'";
    
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

        /* Opta pelo Método Insert */
        else{

            $checa_ip = $pg->getRow("SELECT end_ip FROM db_clti.tb_conectividade WHERE end_ip = '$end_ip'");
            $checa_ip = $pg->getRow("SELECT end_ip FROM db_clti.tb_estacoes WHERE end_ip = '$end_ip'");
            $checa_ip = $pg->getRow("SELECT end_ip FROM db_clti.tb_servidores WHERE end_ip = '$end_ip'");

            if ($checa_ip){
                echo "<h5>Endereço IP informado já está em uso, 
                        por favor verifique!</h5>
                    <meta http-equiv=\"refresh\" content=\"5;url=?cmd=estacoes\">";
            }

            else{

                $sql = "INSERT INTO db_clti.tb_estacoes(
                    idtb_om_apoiadas, fabricante, modelo, idtb_proc_modelo, clock_proc, memoria, armazenamento, 
                    end_ip, end_mac, idtb_sor, localizacao, data_aquisicao, data_garantia, req_minimos, status)
                VALUES ('$idtb_om_apoiadas', '$fabricante', '$modelo', '$idtb_proc_modelo', '$clock_proc', '$memoria', 
                    '$armazenamento', '$end_ip', '$end_mac', '$idtb_sor', '$localizacao', '$data_aquisicao', 
                    '$data_garantia', '$req_minimos', '$status')";
            
                $pg->exec($sql);
            
                foreach ($pg as $key => $value) {
                    if ($value != '0') {
                        echo "<h5>Resgistros incluídos no banco de dados.</h5>
                        <meta http-equiv=\"refresh\" content=\"1;url=?cmd=estacoes\">";
                    }
            
                    else {
                        echo "<h5>Ocorreu algum erro, tente novamente.</h5>
                        ";
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