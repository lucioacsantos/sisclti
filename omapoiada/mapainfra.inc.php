<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/* Classe de interação com o PostgreSQL */
require_once "../class/constantes.inc.php";
$mapainfra = new MapaInfra();
$estacoes = new Estacoes();
$servidores = new Servidores();
$conect = new Conectividade;

$omapoiada = $_SESSION['id_om_apoiada'];
$mapainfra->idtb_om_apoiadas = $omapoiada;
$estacoes->idtb_om_apoiadas = $omapoiada;
$conexoes = $mapainfra->SelectAllOMMapaView();
$conectividade = $conect->SelectAllConectView();
$etom = $estacoes->SelectIdOMETView();

@$act = $_GET['act'];

/* Checa se o tipo de CLTI está cadastrado */
if (($conectividade == NULL) AND ($act == NULL)) {
	echo "<h5>Não há equipamentos de conectividade cadastrados,<br />
        clique <a href=\"?cmd=conectividade&act=cad\">aqui</a> para fazê-lo.</h5>";
}

/* Carrega form para cadastro */
if ($act == 'cad') {
    @$param = $_GET['param'];
    $conect->idtb_conectividade = $param;
    $conectividade = $conect->SelectIdConectView();
    echo "<h5>Configurando ativo ".$conectividade->fabricante." - ".$conectividade->modelo."
         - ".$conectividade->qtde_portas." Portas,<br>
        selecione acima a qual tipo de equipamento conectá-lo.</h5>";
}
/* Carrega form para cadastro de ET */
if ($act == 'et') {
    @$param = $_GET['param'];
    @$idtb_mapainfra = $_GET['id'];
    if ($idtb_mapainfra){
        $mapainfra->idtb_mapainfra = $idtb_mapainfra;
        $conexoes = $mapainfra->SelectIdMapaView();
    }
    elseif ($param){
        $conexoes = (object)['idtb_mapainfra'=>'','idtb_conectividade_orig'=>$param,'idtb_conectividade_dest'=>'',
            'idtb_servidores_dest'=>'','idtb_estacoes_dest'=>'','porta_orig'=>'','porta_dest'=>'','idtb_om_apoiadas'=>''];
    }
    else{
        $conexoes = (object)['idtb_mapainfra'=>'','idtb_conectividade_orig'=>'','idtb_conectividade_dest'=>'',
            'idtb_servidores_dest'=>'','idtb_estacoes_dest'=>'','porta_orig'=>'','porta_dest'=>'','idtb_om_apoiadas'=>''];
    }

	include "mapainfra-et.inc.php";
}
/* Carrega form para cadastro de Servidor */
if ($act == 'srv') {
    @$param = $_GET['param'];
    if ($param){
        $mapainfra->idtb_mapainfra = $param;
        $conexoes = $mapainfra->SelectIdMapaView();
    }
    else{
        $conexoes = (object)['idtb_mapainfra'=>'','idtb_conectividade_orig'=>'','idtb_conectividade_dest'=>'',
            'idtb_servidores_dest'=>'','idtb_estacoes_dest'=>'','porta_orig'=>'','porta_dest'=>'','idtb_om_apoiadas'=>''];
    }

	include "mapainfra-srv.inc.php";
}
/* Carrega form para cadastro de Cascateamento */
if ($act == 'conec') {
    @$param = $_GET['param'];
    if ($param){
        $mapainfra->idtb_mapainfra = $param;
        $conexoes = $mapainfra->SelectIdMapaView();
    }
    else{
        $conexoes = (object)['idtb_mapainfra'=>'','idtb_conectividade_orig'=>'','idtb_conectividade_dest'=>'',
            'idtb_servidores_dest'=>'','idtb_estacoes_dest'=>'','porta_orig'=>'','porta_dest'=>'','idtb_om_apoiadas'=>''];
    }

	include "mapainfra-conec.inc.php";
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
                        <th scope=\"col\">Cód.</th>
                        <th scope=\"col\">Fabricante</th>
                        <th scope=\"col\">Modelo</th>
                        <th scope=\"col\">Nome</th>
                        <th scope=\"col\">Qtde. Portas</th>
                        <th scope=\"col\">Portas Ocupadas</th>
                        <th scope=\"col\">Ações</th>
                    </tr>
                </thead>";

    foreach ($conectividade as $key => $value) {

        $mapainfra->idtb_conectividade_orig = $value->idtb_conectividade;
        $portas_ocupadas = $mapainfra->CountPortasOcupadas();
        
        echo"       <tr>
                        <th scope=\"row\">".$value->sigla."</th>
                        <td>".$value->idtb_conectividade."</td>
                        <td>".$value->fabricante."</td>
                        <td>".$value->modelo."</td>
                        <td>".$value->nome."</td>
                        <td>".$value->qtde_portas."</td>
                        <td>".$portas_ocupadas."</td>
                        <td><a href=\"?cmd=mapainfra&act=cad&param=".$value->idtb_conectividade."\">Cadastrar</td>
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
        $conect->qtde_portas = $_POST['qtde_portas'];
        $conect->end_ip = $_POST['end_ip'];
        $ip->end_ip = $_POST['end_ip'];
        $conect->idtb_om_setores = strtoupper($_POST['idtb_om_setores']);
        $conect->data_aquisicao = $_POST['data_aquisicao'];
        $conect->data_garantia = $_POST['data_garantia'];

        /* Opta pelo Método Update */
        if ($idtb_mapainfra){

            $checa_ip = $ip->SearchIP();
            if ($checa_ip){
                echo "<h5>Endereço IP informado já está em uso, 
                    por favor verifique!</h5>
                    <meta http-equiv=\"refresh\" content=\"5;url=?cmd=mapainfra\">";
            }
            else{
                $row = $conect->UpdateConect();
                if ($row) {
                    echo "<h5>Resgistros incluídos no banco de dados.</h5>
                    <meta http-equiv=\"refresh\" content=\"1;url=?cmd=mapainfra\">";
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
                    <meta http-equiv=\"refresh\" content=\"5;url=?cmd=mapainfra\">";
            }
            else{
                $row = $conect->InsertConect();
                if ($row) {
                    echo "<h5>Resgistros incluídos no banco de dados.</h5>
                    <meta http-equiv=\"refresh\" content=\"1;url=?cmd=mapainfra\">";
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