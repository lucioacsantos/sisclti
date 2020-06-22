<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/* Classe de interação com o PostgreSQL */
require_once "../class/queries.class.php";
$cns = new ConsultaSQL();

$omapoiada = $_SESSION['id_om_apoiada'];

$estacoes = $cns->select($tb_estacoes,'','');

@$act = $_GET['act'];

/* Checa se o tipo de CLTI está cadastrado */
if ((!$estacoes) AND ($act == NULL)) {
	echo "<h5>Não há estações cadastradas,<br />
		 clique <a href=\"?cmd=estacoes&act=cad\">aqui</a> para fazê-lo.</h5>";
}

/* Carrega form para cadastro Estações de Trabalho */
if ($act == 'cad') {
    @$param = $_GET['param'];
    if ($param){
        $condicoes = "idtb_estacoes = '$param'";
        $ordenacao = "idtb_estacoes ASC";
        $estacoes = $cns->select($vw_estacoes,$condicoes,$ordenacao);
    }
    else{
        $estacoes = (object)['idtb_estacoes'=>'','idtb_om_apoiadas'=>'','sigla'=>'','fabricante'=>'','modelo'=>'',
            'idtb_proc_modelo'=>'','proc_modelo'=>'','proc_fab'=>'','clock_proc'=>'','idtb_memorias'=>'','tipo_mem'=>'',
            'modelo_mem'=>'','clock_mem'=>'','memoria'=>'','armazenamento'=>'','idtb_om_setores'=>'','sigla_setor'=>'',
            'idtb_sor'=>'','descricao'=>'','versao'=>'','end_ip'=>'','end_mac'=>'','data_aquisicao'=>'NULL',
            'compartimento'=>'','data_garantia'=>'NULL','localizacao'=>'','req_minimos'=>'','situacao'=>''];
    }
    $ordenacao = "desenvolvedor,versao ASC";
    $so = $cns->selectMulti($tb_sor,'',$ordenacao);
    $ordenacao = "fabricante ASC";
    $proc = $cns->selectMulti($vw_processadores,'',$ordenacao);
    $ordenacao = "tipo DESC";
    $mem = $cns->selectMulti($tb_memorias,'',$ordenacao);
    $ordenacao = "nome_setor ASC";
    $local = $cns->selectMulti($vw_setores,'',$ordenacao);
    
    include "estacoes-formcad.inc.php";
}

/* Monta quadro com Estações de Trabalho */
if (($estacoes) AND ($act == NULL)) {

    
    if ($omapoiada != ''){
        $condicoes = "idtb_om_apoiadas = $omapoiada";
        $estacoes = $cns->selectMulti($vw_estacoes,$condicoes,'');
    }
    else{
        $ordenacao = "ORDER BY idtb_om_apoiadas ASC";
        $estacoes = $cns->selectMulti($vw_estacoes,'',$ordenacao);
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
        $idtb_om_setores = $_POST['idtb_om_setores'];
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
                idtb_sor='$idtb_sor', idtb_om_setores='$idtb_om_setores', data_aquisicao='$data_aquisicao', 
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

            $condicoes = "end_ip = '$end_ip'";
            $checa_ip = $cns->select($tb_conectividade,$condicoes,'');
            $checa_ip = $cns->select($tb_estacoes,$condicoes,'');
            $checa_ip = $cns->select($tb_servidores,$condicoes,'');

            if ($checa_ip){
                echo "<h5>Endereço IP informado já está em uso, 
                        por favor verifique!</h5>
                    <meta http-equiv=\"refresh\" content=\"5;url=?cmd=estacoes\">";
            }

            else{

                $sql = "INSERT INTO db_clti.tb_estacoes(
                    idtb_om_apoiadas, fabricante, modelo, idtb_proc_modelo, clock_proc, idtb_memorias, memoria, armazenamento, 
                    end_ip, end_mac, idtb_sor, idtb_om_setores, data_aquisicao, data_garantia, req_minimos, status)
                VALUES ('$idtb_om_apoiadas', '$fabricante', '$modelo', '$idtb_proc_modelo', '$clock_proc','$idtb_memorias',
                    '$memoria', '$armazenamento', '$end_ip', '$end_mac', '$idtb_sor', '$idtb_om_setores', '$data_aquisicao', 
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