<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/* Classe de interação com o PostgreSQL */
require_once "../class/constantes.inc.php";
$conect = new Conectividade();
$omap = new OMAPoiadas();
$ip = new IP();

$omapoiada = $_SESSION['id_om_apoiada'];

$conectividade = $conect->SelectAllConectView();

@$act = $_GET['act'];

/* Checa se o tipo de CLTI está cadastrado */
if (($conectividade == NULL) AND ($act == NULL)) {
	echo "<h5>Não há equipamentos de conectividade cadastrados,<br />
		 clique <a href=\"?cmd=conectividade&act=cad\">aqui</a> para fazê-lo.</h5>";
}

/* Carrega form para cadastro do tipo de CLTI */
if ($act == 'cad') {
    @$param = $_GET['param'];
    if ($param){
        $$conect->ordena = "ORDER BY idtb_conectividade ASC";
        $conectividade = $conect->SelectAllConectView();
    }
    else{
        $conectividade = (object)['idtb_conectividade'=>'','idtb_om_apoiadas'=>'','modelo'=>'','end_ip'=>'','data_aquisicao'=>'',
            'data_garantia'=>'','fabricante'=>'','idtb_om_setores'=>'','sigla_setor'=>'','idtb_om_apoiadas'=>'','sigla'=>'',
            'compartimento'=>'',];
    }
    $conect->ordena = "ORDER BY nome_setor ASC";
    $local = $omap->SelectAllSetoresView();

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
        $conect->idtb_om_apoiadas = $omapoiada;
        $conectividade = $conect->SelectAllOMConectView();
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
        $conect->idtb_conectividade = $idtb_conectividade;
        $conect->idtb_om_apoiadas = $_POST['idtb_om_apoiadas'];
        $conect->fabricante = strtoupper($_POST['fabricante']);
        $conect->modelo = strtoupper($_POST['modelo']);
        $conect->end_ip = $_POST['end_ip'];
        $conect->idtb_om_setores = strtoupper($_POST['idtb_om_setores']);
        $conect->data_aquisicao = $_POST['data_aquisicao'];
        $conect->data_garantia = $_POST['data_garantia'];

        /* Opta pelo Método Update */
        if ($idtb_conectividade){

            $checa_ip = $ip->SearchIP();
            if ($checa_ip){
                echo "<h5>Endereço IP informado já está em uso, 
                    por favor verifique!</h5>
                    <meta http-equiv=\"refresh\" content=\"5;url=?cmd=conectividade\">";
            }
            else{
                $row = $conect->UpdateConect();
                if ($row) {
                    echo "<h5>Resgistros incluídos no banco de dados.</h5>
                    <meta http-equiv=\"refresh\" content=\"1;url=?cmd=conectividade\">";
                }
                else {
                    echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
                }
            }
        }
        /* Opta pelo Método Insert */
        else {

            $checa_ip = $ip->SearchIP();            
            if ($checa_ip){
                echo "<h5>Endereço IP informado já está em uso, 
                    por favor verifique!</h5>
                    <meta http-equiv=\"refresh\" content=\"5;url=?cmd=conectividade\">";
            }
            else{
                $row = $conect->InsertConect();
                if ($row) {
                    echo "<h5>Resgistros incluídos no banco de dados.</h5>
                    <meta http-equiv=\"refresh\" content=\"1;url=?cmd=conectividade\">";
                }        
                else {
                    echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
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