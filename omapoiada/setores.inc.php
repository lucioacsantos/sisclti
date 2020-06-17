<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/* Classe de interação com o PostgreSQL */
require_once "../class/queries.class.php";
$cns = new ConsultaSQL();
$setores = $cns->setores('','');

@$act = $_GET['act'];

/* Checa se há SO cadastrado */
if ((!$setores) AND ($act == NULL)) {
	echo "<h5>Não há setores/seções/divisões cadastrados,<br />
		 clique <a href=\"?cmd=setores&act=cad\">aqui</a> para fazê-lo.</h5>";
}

/* Carrega form para cadastro de setores */
if ($act == 'cad') {
    @$param = $_GET['param'];

    if ($param){
        $tabela = "db_clti.tb_om_setores";
        $condicoes = "idtb_om_setores = '$param'";
        $ordenacao = "idtb_om_setores ASC";

        $setores = $cns->select($tabela,$condicoes,$ordenacao);
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
                        <th scope=\"col\">Cód.Elem.Funcional</th>
                        <th scope=\"col\">Nome</th>
                        <th scope=\"col\">Sigla</th>
                        <th scope=\"col\">Compartimento</th>
                        <th scope=\"col\">Ações</th>
                    </tr>
                </thead>";

    $setores = $cns->setores('','');
    echo "<p>Setores da OM: </p>";
    foreach ($setores as $key => $value) {
        echo"       <tr>
                        <th scope=\"row\">".$value->cod_funcional."</th>
                        <td>".$value->nome_setor."</td>
                        <td>".$value->sigla_setor."</td>
                        <td>".$value->compartimento."</td>
                        <td><a href=\"?cmd=setores&act=cad&param=".$value->idtb_om_setores."\">Editar</a> - 
                            Excluir</td>
                    </tr>";
    };
    echo"
                </tbody>
            </table>
            </div>";
}

/* Método INSERT */
if ($act == 'insert') {
    if (isset($_SESSION['status'])){
        $idtb_om_setores = $_POST['idtb_om_setores'];
        $nome_setor = strtoupper($_POST['nome_setor']);
        $sigla_setor = strtoupper($_POST['sigla_setor']);
        $cod_funcional = strtoupper($_POST['cod_funcional']);
        $compart = strtoupper($_POST['compart']);
        $idtb_om_apoiadas = $_SESSION['id_om_apoiada'];

        /* Opta pelo Método Update */
        if ($idtb_om_setores){

            $tabela = "db_clti.tb_om_setores";
            $campos = "idtb_om_apoiadas, nome_setor, sigla_setor, cod_funcional, compartimento";
            $valores = ("'$idtb_om_apoiadas','$nome_setor','$sigla_setor','$cod_funcional','$compart'");
            $condicoes = "idtb_om_setores = '$idtb_om_setores'";

            $update = $cns->update($tabela,$campos,$valores,$condicoes);
        
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

            $tabela = "db_clti.tb_om_setores";
            $campos = "idtb_om_apoiadas, nome_setor, sigla_setor, cod_funcional, compartimento";
            $valores = ("'$idtb_om_apoiadas','$nome_setor','$sigla_setor','$cod_funcional','$compart'");

            $insert = $cns->insert($tabela,$campos,$valores);
        
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