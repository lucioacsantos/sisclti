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

/* Carrega form para cadastro Estações de Trabalho */
if ($act == 'cad') {
    @$param = $_GET['param'];
    if ($param){
        $estacoes = $pg->getRow("SELECT * FROM db_clti.vw_estacoes WHERE idtb_estacoes = '$param'");
    }
    else{
        $estacoes = (object)['idtb_estacoes'=>'','idtb_om_apoiadas'=>'','sigla'=>'','fabricante'=>'','modelo'=>'',
            'idtb_proc_modelo'=>'','proc_modelo'=>'','proc_fab'=>'','clock_proc'=>'','idtb_memorias'=>'','tipo_mem'=>'',
            'modelo_mem'=>'','clock_mem'=>'','memoria'=>'','armazenamento'=>'',
            'idtb_sor'=>'','descricao'=>'','versao'=>'','end_ip'=>'','end_mac'=>'','data_aquisicao'=>'NULL',
            'data_garantia'=>'NULL','localizacao'=>'','req_minimos'=>'','situacao'=>''];
    }
    $omapoiada = $_SESSION['id_om_apoiada'];
    $so = $pg->getRows("SELECT * FROM db_clti.tb_sor ORDER BY desenvolvedor,versao ASC");
    $proc = $pg->getRows("SELECT * FROM db_clti.vw_processadores ORDER BY fabricante ASC");
    $mem = $pg->getRows("SELECT * FROM db_clti.tb_memorias ORDER BY tipo DESC");
    
    include "estacoes-formcad.inc.php";
}

/* Monta quadro com Estações de Trabalho */
if (($row) AND ($act == NULL)) {

    $omapoiada = $_SESSION['id_om_apoiada'];
    if ($omapoiada != ''){
        $estacoes = $pg->getRows("SELECT * FROM db_clti.vw_estacoes WHERE idtb_om_apoiadas = $omapoiada");
    }
    else{
        $estacoes = $pg->getRows("SELECT * FROM db_clti.vw_estacoes ORDER BY idtb_om_apoiadas ASC");
    }

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
                        <td>".$value->proc_fab." ".$value->proc_modelo." ".$value->clock_proc." GHz -  
                            ".$value->memoria." GB ".$value->tipo_mem." ".$value->modelo_mem." ".$value->clock_mem." GHz - 
                            ".$value->armazenamento." GB/HD</td>
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
        $idtb_memorias = $_POST['idtb_memorias'];
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
                idtb_proc_modelo='$idtb_proc_modelo', clock_proc='$clock_proc', idtb_memorias='$idtb_memorias',
                memoria='$memoria', armazenamento='$armazenamento', end_ip='$end_ip', end_mac='$end_mac', 
                idtb_sor='$idtb_sor', localizacao='$localizacao', data_aquisicao='$data_aquisicao', 
                data_garantia='$data_garantia', req_minimos='$req_minimos', status='$status'
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
                    idtb_om_apoiadas, fabricante, modelo, idtb_proc_modelo, clock_proc, idtb_memorias, memoria, armazenamento, 
                    end_ip, end_mac, idtb_sor, localizacao, data_aquisicao, data_garantia, req_minimos, status)
                VALUES ('$idtb_om_apoiadas', '$fabricante', '$modelo', '$idtb_proc_modelo', '$clock_proc','$idtb_memorias',
                    '$memoria', '$armazenamento', '$end_ip', '$end_mac', '$idtb_sor', '$localizacao', '$data_aquisicao', 
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