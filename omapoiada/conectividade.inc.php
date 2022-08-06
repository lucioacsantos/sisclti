<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/** Leitura de parâmetros */
$oa = $cmd = $param = $act = $senha = NULL;
if (isset($_GET['oa'])){
  $oa = $_GET['oa'];
}

if (isset($_GET['cmd'])){
  $cmd = $_GET['cmd'];
}

if (isset($_GET['act'])){
  $act = $_GET['act'];
}

if (isset($_GET['param'])){
  $param = $_GET['param'];
}

if (isset($_GET['senha'])){
    $senha = $_GET['senha'];
}

/* Classe de interação com o PostgreSQL */
require_once "../class/constantes.inc.php";
$conect = new Conectividade();
$mapainfra = new MapaInfra();
$omap = new OMAPoiadas();
$ip = new IP();

$omapoiada = $_SESSION['id_om_apoiada'];
$omap->idtb_om_apoiadas = $omapoiada;
$conectividade = $conect->SelectAllConectView();

/* Checa se há item cadastrado */
if (($conectividade == NULL) AND ($act == NULL)) {
	echo "<h5>Não há equipamentos de conectividade cadastrados,<br />
		 clique <a href=\"?cmd=conectividade&act=cad\">aqui</a> para fazê-lo.</h5>";
}

/* Carrega form para cadastro */
if ($act == 'cad') {
    if ($param){
        $conect->idtb_conectividade = $param;
        $conectividade = $conect->SelectIdConectView();
    }
    else{
        $conectividade = (object)['idtb_conectividade'=>'','idtb_om_apoiadas'=>'','modelo'=>'','nome'=>'','end_ip'=>'',
            'data_aquisicao'=>'','data_garantia'=>'','fabricante'=>'','qtde_portas'=>'','idtb_om_setores'=>'',
            'sigla_setor'=>'','idtb_om_apoiadas'=>'','sigla'=>'','compartimento'=>'',];
    }
    $conect->ordena = "ORDER BY nome_setor ASC";
    $local = $omap->SelectAllSetoresView();

	include "conectividade-formcad.inc.php";
}

/* Monta quadro com equipamento de conectividade para exclusão */
if ($act == 'del') {

    $conect->idtb_conectividade = $param;
    $conect->idtb_om_apoiadas = $omapoiada;
    $conectividade = $conect->SelectIdConectView();

    echo"<div class=\"table-responsive\">
        <div class=\"alert alert-danger\" role=\"alert\">Atenção, todos os registros deste Equipamento,
            bem como dados relacionados, serão excluídos!</div>
            <table class=\"table table-hover\">
                <thead>
                    <tr>
                        <th scope=\"col\">OM Apoiada</th>
                        <th scope=\"col\">Localização</th>
                        <th scope=\"col\">Fabricante</th>
                        <th scope=\"col\">Modelo</th>
                        <th scope=\"col\">Nome</th>
                        <th scope=\"col\">Qtde. Portas</th>
                        <th scope=\"col\">Endereço IP</th>
                        <th scope=\"col\">Ações</th>
                    </tr>
                </thead>
                    <tr>
                        <th scope=\"row\">".$conectividade->sigla."</th>
                        <td>".$conectividade->compartimento."</td>
                        <td>".$conectividade->fabricante."</td>
                        <td>".$conectividade->modelo."</td>
                        <td>".$conectividade->nome."</td>
                        <td>".$conectividade->qtde_portas."</td>
                        <td>".$conectividade->end_ip."</td>
                        <td><a href=\"?cmd=conectividade&act=conf_del&param=".$conectividade->idtb_conectividade."
                            $oa=".$conectividade->idtb_om_apoiadas."\">Confirmar Exclusão</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>";
}

/** Excluir Definitivamente Equipamento de Conectividade */
if ($act == 'conf_del') {
    $conect->idtb_estacoes = $param;
    $conect->idtb_om_apoiadas = $oa;
    $conect->data_del = date('d-m-Y');
    $conect->hora_del = date('H:i');
    $conectividade = $conect->DeleteConect();
    if ($estacoes) {
        echo "<h5>Resgistros excluídos do banco de dados.</h5>
        <meta http-equiv=\"refresh\" content=\"1;url=?cmd=conectividade\">";
    }
    else {
        echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
    }
}

/* Monta quadro com equipamentos de conectividade */
if (($conectividade) AND ($act == NULL)) {

    $omapoiada = $_SESSION['id_om_apoiada'];
    if ($omapoiada != ''){
        $conect->idtb_om_apoiadas = $omapoiada;
        $conectividade = $conect->SelectAllOMConectView();
    }
    else{
        $conectividade = $conect->SelectAllConectView();
    }

    echo"<div class=\"table-responsive\">
            <table class=\"table table-hover\">
                <thead>
                    <tr>
                        <th scope=\"col\">OM Apoiada</th>
                        <th scope=\"col\">Localização</th>
                        <th scope=\"col\">Fabricante</th>
                        <th scope=\"col\">Modelo</th>
                        <th scope=\"col\">Nome</th>
                        <th scope=\"col\">Qtde. Portas</th>
                        <th scope=\"col\">Endereço IP</th>
                        <th scope=\"col\">Ações</th>
                    </tr>
                </thead>";

    foreach ($conectividade as $key => $value) {
        echo"       <tr>
                        <th scope=\"row\">".$value->sigla."</th>
                        <td>".$value->compartimento."</td>
                        <td>".$value->fabricante."</td>
                        <td>".$value->modelo."</td>
                        <td>".$value->nome."</td>
                        <td>".$value->qtde_portas."</td>
                        <td>".$value->end_ip."</td>
                        <td><a href=\"?cmd=conectividade&act=cad&param=".$value->idtb_conectividade."\">Editar</a> - 
                            <a href=\"?cmd=conectividade&act=del&param=".$value->idtb_conectividade."\">Excluir</a>
                        </td>
                    </tr>";
    }
    echo"
                </tbody>
            </table>
            </div>";
}

/* Método INSERT/UPDATE */
if ($act == 'insert') {
    if (isset($_SESSION['status'])){
        $idtb_conectividade = $_POST['idtb_conectividade'];
        $conect->idtb_conectividade = $idtb_conectividade;
        $conect->idtb_om_apoiadas = $_POST['idtb_om_apoiadas'];
        $conect->fabricante = mb_strtoupper($_POST['fabricante'],'UTF-8');
        $conect->modelo = mb_strtoupper($_POST['modelo'],'UTF-8');
        $conect->nome = mb_strtoupper($_POST['nome'],'UTF-8');
        $conect->qtde_portas = $_POST['qtde_portas'];
        $conect->end_ip = $_POST['end_ip'];
        $ip->end_ip = $_POST['end_ip'];
        $conect->idtb_om_setores = mb_strtoupper($_POST['idtb_om_setores'],'UTF-8');
        $conect->data_aquisicao = $_POST['data_aquisicao'];
        $conect->data_garantia = $_POST['data_garantia'];
        $conect->status = $_POST['status'];

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