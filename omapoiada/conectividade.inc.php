<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/* Classe de interação com o PostgreSQL */
require_once "../class/queries.class.php";
$cns = new ConsultaSQL();

$omapoiada = $_SESSION['id_om_apoiada'];

$conectividade = $cns->select($tb_conectividade,'','');

@$act = $_GET['act'];

/* Checa se o tipo de CLTI está cadastrado */
if ((!$conectividade) AND ($act == NULL)) {
	echo "<h5>Não há equipamentos de conectividade cadastrados,<br />
		 clique <a href=\"?cmd=conectividade&act=cad\">aqui</a> para fazê-lo.</h5>";
}

/* Carrega form para cadastro do tipo de CLTI */
if ($act == 'cad') {
    @$param = $_GET['param'];
    if ($param){
        $condicoes = "idtb_conectividade = '$param'";
        $ordenacao = "idtb_conectividade ASC";
        $conectividade = $cns->select($vw_conectividade,$condicoes,$ordenacao);
    }
    else{
        $conectividade = (object)['idtb_conectividade'=>'','idtb_om_apoiadas'=>'','modelo'=>'','end_ip'=>'','data_aquisicao'=>'',
            'data_garantia'=>'','fabricante'=>'','idtb_om_setores'=>'','sigla_setor'=>'','idtb_om_apoiadas'=>'','sigla'=>'',
            'compartimento'=>'',];
    }
    $ordenacao = "nome_setor ASC";
    $local = $cns->selectMulti($vw_setores,'',$ordenacao);

	include "conectividade-formcad.inc.php";
}

/* Monta quadro com equipamentos de conectividade */
if (($conectividade) AND ($act == NULL)) {

    $omapoiada = $_SESSION['id_om_apoiada'];
    if ($omapoiada != ''){
        $condicoes = "idtb_om_apoiadas = '$omapoiada'";
        $conectividade = $cns->selectMulti($vw_conectividade,$condicoes,'');
    }
    else{
        $condicoes = "idtb_om_apoiadas = '$omapoiada'";
        $ordenacao = "ASC";
        $conectividade = $cns->selectMulti($vw_conectividade,$condicoes,$ordenacao);
    }

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
        $idtb_om_setores = strtoupper($_POST['idtb_om_setores']);
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
                    idtb_om_setores='$idtb_om_setores', data_aquisicao='$data_aquisicao', data_garantia='$data_garantia'
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
                    idtb_om_apoiadas, fabricante, modelo, end_ip, idtb_om_setores, data_aquisicao, data_garantia)
                VALUES ('$idtb_om_apoiadas', '$fabricante', '$modelo', '$end_ip', '$idtb_om_setores', '$data_aquisicao', '$data_garantia')";
        
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