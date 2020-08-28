<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/* Classe de interação com o PostgreSQL */
require_once "../class/queries.class.php";
$cns = new ConsultaSQL();

$omapoiada = $_SESSION['id_om_apoiada'];

$campos = "*";
$manutencaoet = $cns->select($campos,$tb_manutencao_et,'','');

@$act = $_GET['act'];

/* Checa se o tipo de CLTI está cadastrado */
if ((!$manutencaoet) AND ($act == NULL)) {
	echo "<h5>Não há ET em manutenção cadastradas.</h5>";
}

/* Carrega form para cadastro */
if ($act == 'cad') {
    @$param = $_GET['param'];
    if ($param){
        $condicoes = "idtb_estacoes = $param";
        $estacoes = $cns->select($campos,$vw_estacoes,$condicoes,'');
        $manutencaoet = (object)['idtb_manutencao_et'=>'','idtb_estacoes'=>$estacoes->idtb_estacoes,
            'idtb_om_apoiadas'=>$estacoes->idtb_om_apoiadas,'data_entrada'=>'','data_saida'=>'',
            'diagnostico'=>'','custo_manutencao'=>'','situacao'=>'Em Manutenção'];
    }
    else{
        $manutencaoet = (object)['idtb_manutencao_et'=>'','idtb_estacoes'=>'','idtb_om_apoiadas'=>'','data_entrada'=>'',
            'data_saida'=>'','diagnostico'=>'','custo_manutencao'=>'','situacao'=>''];
    }

	include "manutencaoet-formcad.inc.php";
}

/* Monta quadro de manutenção */
if (($manutencaoet) AND ($act == NULL)) {

    $condicoes = "idtb_om_apoiadas = '$omapoiada'";
    $ordenacao = "idtb_manutencao_et ASC";
    $manutencaoet = $cns->selectMulti($campos,$tb_manutencao_et,$condicoes,$ordenacao);

    echo"<div class=\"table-responsive\">
            <table class=\"table table-hover\">
                <thead>
                    <tr>
                        <th scope=\"col\">Cód. Mnt.</th>
                        <th scope=\"col\">Cód. ET</th>
                        <th scope=\"col\">Entrada</th>
                        <th scope=\"col\">Saída</th>
                        <th scope=\"col\">Custo R$</th>
                        <th scope=\"col\">Situação</th>
                    </tr>
                </thead>";

    foreach ($manutencaoet as $key => $value) {

        #Seleciona Sigla da OM Apoiada
        
        echo"       <tr>
                        <th scope=\"row\">".$value->idtb_manutencao_et."</th>
                        <td>".$value->idtb_estacoes."</td>
                        <td>".$value->data_entrada."</td>
                        <td>".$value->data_saida."</td>
                        <td>".$value->custo_manutencao."</td>
                        <td>".$value->situacao."</td>
                        <td><a href=\"?cmd=conectividade&act=cad&param=".$value->idtb_manutencao_et."\">Editar</a></td>
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
        $idtb_manutencao_et = $_POST['idtb_manutencao_et'];
        $idtb_estacoes = $_POST['idtb_estacoes'];
        $idtb_om_apoiadas = $_POST['idtb_om_apoiadas'];
        $data_entrada = $_POST['data_entrada'];
        $data_saida = $_POST['data_saida'];
        $diagnostico = strtoupper($_POST['diagnostico']);
        $custo_manutencao = $_POST['custo_manutencao'];
        $situacao = strtoupper($_POST['situacao']);

        /* Opta pelo Método Update */
        if ($idtb_manutencao_et){

            $campos_valores = "idtb_manutencao_et='$idtb_manutencao_et', idtb_estacoes='$idtb_estacoes', 
                idtb_om_apoiadas='$idtb_om_apoiadas', data_entrada='$data_entrada', data_saida='$data_saida', 
                diagnostico='$diagnostico', custo_manutencao='$custo_manutencao', situacao='$situacao'";
            $condicoes = "idtb_manutencao_et='$idtb_manutencao_et'";
    
            $pg = $cns->update($tb_manutencao_et,$campos_valores,$condicoes);
        
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
        
        /* Opta pelo Método Insert */
        else {

            $campos = "idtb_estacoes,idtb_om_apoiadas,data_entrada,data_saida,diagnostico,custo_manutencao,situacao";
            $valores = "'$idtb_estacoes','$idtb_om_apoiadas',$data_entrada,'$data_saida','$diagnostico',
                '$custo_manutencao','$situacao'";
            $pg = $cns->insert($tb_manutencao_et,$campos,$valores);
        
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
    else{
        echo "<h5>Ocorreu algum erro, usuário não autenticado.</h5>
            <meta http-equiv=\"refresh\" content=\"1;$url\">";
    }
}

?>