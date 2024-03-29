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
$om = new OMAPoiadas();

$omapoiada = $_SESSION['id_om_apoiada'];
$om->idtb_om_apoiadas = $omapoiada;
$om->ordena = "ORDER BY cod_funcional ASC";
$setores = $om->SelectAllSetoresView();

/* Checa se há item cadastrado */
if (($setores == NULL) AND ($act == NULL)) {
	echo "<h5>Não há setores/seções/divisões cadastrados,<br />
		 clique <a href=\"?cmd=setores&act=cad\">aqui</a> para fazê-lo.</h5>";
}

/* Carrega form para cadastro de setores */
if ($act == 'cad') {
    if ($param){
        $om->idtb_om_setores = $param;
        $setores = $om->SelectIdSetoresView();
    }
    else{
        $setores = (object)['idtb_om_setores'=>'','nome_setor'=>'','sigla_setor'=>'',
            'cod_funcional'=>'','compartimento'=>''];
    }    
    include "setores-formcad.inc.php";
}
/* Monta quadro de setores por OM */
if (($setores) AND ($act == NULL)) {
    echo"<div class=\"table-responsive\">
            <table class=\"table table-hover\">
                <thead>
                    <tr>
                        <th scope=\"col\">OM</th>
                        <th scope=\"col\">Cód.Elem.Funcional</th>
                        <th scope=\"col\">Nome</th>
                        <th scope=\"col\">Sigla</th>
                        <th scope=\"col\">Compartimento</th>
                        <th scope=\"col\">Ações</th>
                    </tr>
                </thead>";
    $ordena = "idtb_om_setores ASC";
    $setores = $om->SelectAllSetoresView();    
    foreach ($setores as $key => $value) {
        echo"       <tr>
                        <th scope=\"row\">".$value->sigla_om."</th>
                        <td>".$value->cod_funcional."</td>
                        <td>".$value->nome_setor."</td>
                        <td>".$value->sigla_setor."</td>
                        <td>".$value->compartimento."</td>
                        <td>
                            <a href=\"?cmd=setores&act=cad&param=".$value->idtb_om_setores."\">Editar</a>
                        </td>
                    </tr>";
    };
    echo"
                </tbody>
            </table>
            </div>";
}

/* Método INSERT/UPDATE */
if ($act == 'insert') {
    if (isset($_SESSION['status'])){
        $idtb_om_setores = $_POST['idtb_om_setores'];
        $om->idtb_om_setores = $idtb_om_setores;
        $om->nome_setor = mb_strtoupper($_POST['nome_setor'],'UTF-8');
        $om->sigla_setor = mb_strtoupper($_POST['sigla_setor'],'UTF-8');
        $om->cod_funcional = mb_strtoupper($_POST['cod_funcional'],'UTF-8');
        $om->compart = mb_strtoupper($_POST['compart'],'UTF-8');
        $om->idtb_om_apoiadas = $_SESSION['id_om_apoiada'];

        /* Opta pelo Método Update */
        if ($idtb_om_setores){
            $update = $om->UpdateSetores();
            if ($update) {
                echo "<h5>Resgistros incluídos no banco de dados.</h5>
                <meta http-equiv=\"refresh\" content=\"1;url=?cmd=setores\">";
            }
            else {
                echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
            }
        }
        /* Opta pelo Método Insert */
        else{
            $insert = $om->InsertSetores();
            if ($insert) {
                echo "<h5>Resgistros incluídos no banco de dados.</h5>
                <meta http-equiv=\"refresh\" content=\"1;url=?cmd=setores\">";
            }
            else {
                echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
            }
        }
    }
    else{
        echo "<h5>Ocorreu algum erro, usuário não autenticado.</h5>
            <meta http-equiv=\"refresh\" content=\"1;$url\">";
    }
}
?>