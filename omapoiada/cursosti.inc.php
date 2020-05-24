<?php
/**
 * Admin
 * Gerenciamento de Admin
 * admin.class.php
 * 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/* Classe de interação com o PostgreSQL */
require_once "../class/pgsql.class.php";
$pg = new PgSql();

/* Recupera informações dos Admin */
$sql = "SELECT * FROM db_clti.tb_admin";

$row = $pg->getRow($sql);

@$act = $_GET['act'];

/* Checa se há Admin cadastrado */
if (($row == '0') AND ($act == NULL)) {
	echo "<h5>Não há Cursos cadastrados,<br />
		 clique <a href=\"?cmd=cursosti&act=cad\">aqui</a> para fazê-lo.</h5>";
}

/* Carrega form para cadastro de Admin */
if ($act == 'cad') {
    @$param = $_GET['param'];
    $nip = $_POST['nip'];
    if ($param){
        $pesti = $pg->getRow("SELECT * FROM db_clti.tb_admin WHERE idtb_admin = '$param'");
        $admin_om = $pg->getRow("SELECT idtb_om_apoiadas,sigla FROM db_clti.tb_om_apoiadas 
            WHERE idtb_om_apoiadas = '$admin->id_om'");
        $admin_posto_grad = $pg->getRow("SELECT idtb_posto_grad,sigla FROM db_clti.tb_posto_grad 
            WHERE idtb_posto_grad = '$admin->id_posto_grad'");
        $admin_corpo_quadro = $pg->getRow("SELECT idtb_corpo_quadro,sigla FROM db_clti.tb_corpo_quadro 
            WHERE idtb_corpo_quadro = '$admin->id_corpo_quadro'");
        $admin_especialidade = $pg->getRow("SELECT idtb_especialidade,sigla FROM db_clti.tb_especialidade 
            WHERE idtb_especialidade = '$admin->id_especialidade'");
    }
    else{
        $admin = (object)['idtb_admin'=>'','nip'=>'','cpf'=>'','nome'=>'','nome_guerra'=>''];
        $admin_om = (object)['idtb_om_apoiadas'=>'','sigla'=>''];
        $admin_posto_grad = (object)['idtb_posto_grad'=>'8','sigla'=>'1ºTen'];
        $admin_corpo_quadro = (object)['idtb_corpo_quadro'=>'','sigla'=>''];
        $admin_especialidade = (object)['idtb_especialidade'=>'','sigla'=>''];
    }
	$omapoiada = "SELECT * FROM db_clti.tb_om_apoiadas ORDER BY sigla ASC";
    $omapoiada = $pg->getRows($omapoiada);
    $postograd = "SELECT * FROM db_clti.tb_posto_grad ORDER BY idtb_posto_grad 	DESC";
    $postograd = $pg->getRows($postograd);
    $corpoquadro = "SELECT * FROM db_clti.tb_corpo_quadro";
    $corpoquadro = $pg->getRows($corpoquadro);
    $especialidade = "SELECT * FROM db_clti.tb_especialidade ORDER BY nome ASC";
    $especialidade = $pg->getRows($especialidade);
    echo "
	<div class=\"container-fluid\">
        <div class=\"row\">
            <main>
                <div id=\"form-cadastro\">
                    <form id=\"insereusuario\" role=\"form\" action=\"?cmd=admin&act=insert\" 
                        method=\"post\" enctype=\"multipart/form-data\">
                        <fieldset>";

                            if ($param == 'NOVO'){
                                $
                                                                    echo"
                                    <legend>Administradores de Rede - Troca de Senha</legend>
                                    <input id=\"omapoiada\" class=\"form-control\" name=\"omapoiada\"
                                        value=\"$admin_om->idtb_om_apoiadas\" hidden=\"true\">
                                    <input id=\"postograd\" class=\"form-control\" name=\"postograd\"
                                        value=\"$admin_posto_grad->idtb_posto_grad\" hidden=\"true\">
                                    <input id=\"corpoquadro\" class=\"form-control\" name=\"corpoquadro\"
                                        value=\"$admin_corpo_quadro->idtb_corpo_quadro\" hidden=\"true\">
                                    <input id=\"especialidade\" class=\"form-control\" name=\"especialidade\"
                                        value=\"$admin_especialidade->idtb_especialidade\" hidden=\"true\">
                                    <input id=\"nome\" class=\"form-control\" type=\"text\" name=\"nome\"
                                        hidden=\"required\" value=\"$admin->nome\">
                                    <input id=\"nomeguerra\" class=\"form-control\" type=\"text\" name=\"nomeguerra\"
                                        hidden=\"required\" value=\"$admin->nome_guerra\">

                                    <div class=\"form-group\">
                                        <label for=\"nip\">NIP:</label>
                                        <input id=\"nip\" class=\"form-control\" type=\"text\" name=\"nip\" readonly=\"true\"
                                            placeholder=\"NIP\" maxlength=\"8\" required=\"required\" value=\"$admin->nip\">
                                    </div>

                                    <div class=\"form-group\">
                                        <label for=\"cpf\">CPF (Servidores Civis):</label>
                                        <input id=\"cpf\" class=\"form-control\" type=\"text\" name=\"cpf\" readonly=\"true\"
                                            placeholder=\"CPF (Servidores Civis)\" maxlength=\"11\" value=\"$admin->cpf\">
                                    </div>

                                    <div class=\"form-group\">
                                        <label for=\"senha\" class=\"control-label\">Trocar Senha:</label>
                                        <input id=\"senha\" class=\"form-control\" type=\"password\" name=\"senha\"
                                            placeholder=\"Senha Segura\" minlength=\"8\" maxlength=\"25\">
                                    </div>

                                    <div class=\"form-group\">
                                        <label for=\"confirmasenha\" class=\"control-label\">Confirme a Senha:</label>
                                        <input id=\"confirmasenha\" class=\"form-control\" type=\"password\" name=\"confirmasenha\"
                                            placeholder=\"Confirmação da Senha\" minlength=\"8\" maxlength=\"25\">
                                    </div>

                                    <input id=\"ativo\" class=\"form-control\" name=\"ativo\"
                                        value=\"$admin->status\" hidden=\"true\">";
                                }
                                else{
                                    echo"
                                    <legend>Administradores de Rede - Alteração</legend>

                                    <div class=\"form-group\">
                                        <label for=\"omapoiada\">OM Apoiada:</label>
                                        <select id=\"omapoiada\" class=\"form-control\" name=\"omapoiada\">
                                            <option value=\"$admin_om->idtb_om_apoiadas\" selected=\"true\">
                                                $admin_om->sigla</option>";
                                            foreach ($omapoiada as $key => $value) {
                                                echo"<option value=\"".$value->idtb_om_apoiadas."\">
                                                    ".$value->sigla."</option>";
                                            };
                                        echo "</select>
                                    </div>

                                    <div class=\"form-group\">
                                        <label for=\"postograd\">Posto/Graduação:</label>
                                        <select id=\"postograd\" class=\"form-control\" name=\"postograd\">
                                            <option value=\"$admin_posto_grad->idtb_posto_grad\" selected=\"true\">
                                                $admin_posto_grad->sigla</option>";
                                            foreach ($postograd as $key => $value) {
                                                echo"<option value=\"".$value->idtb_posto_grad."\">
                                                    ".$value->nome."</option>";
                                            };
                                        echo "</select>
                                    </div>

                                    <div class=\"form-group\">
                                        <label for=\"corpoquadro\">Corpo/Quadro:</label>
                                        <select id=\"corpoquadro\" class=\"form-control\" name=\"corpoquadro\">
                                            <option value=\"$admin_corpo_quadro->idtb_corpo_quadro\" selected=\"true\">
                                                $admin_corpo_quadro->sigla</option>";
                                            foreach ($corpoquadro as $key => $value) {
                                                echo"<option value=\"".$value->idtb_corpo_quadro."\">
                                                    ".$value->nome."</option>";
                                            };
                                        echo "</select>
                                    </div>

                                    <div class=\"form-group\">
                                        <label for=\"especialidade\">Especialidade:</label>
                                        <select id=\"especialidade\" class=\"form-control\" name=\"especialidade\">
                                            <option value=\"$admin_especialidade->idtb_especialidade\" selected=\"true\">
                                                $admin_especialidade->sigla</option>";
                                            foreach ($especialidade as $key => $value) {
                                                echo"<option value=\"".$value->idtb_especialidade."\">
                                                    ".$value->nome."</option>";
                                            };
                                        echo "</select>
                                    </div>
                                    <div class=\"form-group\">
                                        <label for=\"nome\">Nome Completo:</label>
                                        <input id=\"nome\" class=\"form-control\" type=\"text\" name=\"nome\"
                                            placeholder=\"Nome Completo\" minlength=\"2\" 
                                            style=\"text-transform:uppercase\" required=\"required\" value=\"$admin->nome\">
                                    </div>

                                    <div class=\"form-group\">
                                        <label for=\"nomeguerra\">Nome de Guerra:</label>
                                        <input id=\"nomeguerra\" class=\"form-control\" type=\"text\" name=\"nomeguerra\"
                                            placeholder=\"Nome de Guerra\" minlength=\"2\"
                                            style=\"text-transform:uppercase\" required=\"required\" value=\"$admin->nome_guerra\">
                                    </div>
                                    <div class=\"form-group\">
                                        <label for=\"nip\">NIP:</label>
                                        <input id=\"nip\" class=\"form-control\" type=\"text\" name=\"nip\" readonly=\"true\"
                                            placeholder=\"NIP\" maxlength=\"8\" required=\"required\" value=\"$admin->nip\">
                                    </div>

                                    <div class=\"form-group\">
                                        <label for=\"cpf\">CPF (Servidores Civis):</label>
                                        <input id=\"cpf\" class=\"form-control\" type=\"text\" name=\"cpf\" readonly=\"true\"
                                            placeholder=\"CPF (Servidores Civis)\" maxlength=\"11\" value=\"$admin->cpf\">
                                    </div>

                                    <input id=\"senha\" class=\"form-control\" type=\"password\" name=\"senha\"
                                            value=\"senha\" hidden=\"true\">
                                    <input id=\"confirmasenha\" class=\"form-control\" type=\"password\" name=\"confirmasenha\"
                                        value=\"confirmasenha\" hidden=\"true\">

                                    <div class=\"form-group\">
                                    <label for=\"ativo\" class=\"control-label\">Situação:</label>
                                    <select id=\"ativo\" class=\"form-control\" name=\"ativo\">
                                        <option value=\"$admin->status\" selected=\"true\">$admin->status</option>
                                        <option value=\"ATIVO\">ATIVO</option>
                                        <option value=\"INATIVO\">INATIVO</option>
                                    <div class=\"help-block with-errors\"></div>
                                    </div>";
                                }
                            }
                            else{
                            echo"
                            <legend>Administradores de Rede - Cadastro</legend>
                            <div class=\"form-group\">
                                <label for=\"omapoiada\">OM Apoiada:</label>
                                <select id=\"omapoiada\" class=\"form-control\" name=\"omapoiada\">
                                    <option value=\"$admin_om->idtb_om_apoiadas\" selected=\"true\">
                                        $admin_om->sigla</option>";
                                    foreach ($omapoiada as $key => $value) {
                                        echo"<option value=\"".$value->idtb_om_apoiadas."\">
                                            ".$value->sigla."</option>";
                                    };
                                echo "</select>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"postograd\">Posto/Graduação:</label>
                                <select id=\"postograd\" class=\"form-control\" name=\"postograd\">
                                    <option value=\"$admin_posto_grad->idtb_posto_grad\" selected=\"true\">
                                        $admin_posto_grad->sigla</option>";
                                    foreach ($postograd as $key => $value) {
                                        echo"<option value=\"".$value->idtb_posto_grad."\">
                                            ".$value->nome."</option>";
                                    };
                                echo "</select>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"corpoquadro\">Corpo/Quadro:</label>
                                <select id=\"corpoquadro\" class=\"form-control\" name=\"corpoquadro\">
                                    <option value=\"$admin_corpo_quadro->idtb_corpo_quadro\" selected=\"true\">
                                        $admin_corpo_quadro->sigla</option>";
                                    foreach ($corpoquadro as $key => $value) {
                                        echo"<option value=\"".$value->idtb_corpo_quadro."\">
                                            ".$value->nome."</option>";
                                    };
                                echo "</select>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"especialidade\">Especialidade:</label>
                                <select id=\"especialidade\" class=\"form-control\" name=\"especialidade\">
                                    <option value=\"$admin_especialidade->idtb_especialidade\" selected=\"true\">
                                        $admin_especialidade->sigla</option>";
                                    foreach ($especialidade as $key => $value) {
                                        echo"<option value=\"".$value->idtb_especialidade."\">
                                            ".$value->nome."</option>";
                                    };
                                echo "</select>
                            </div>
                            <div class=\"form-group\">
                                <label for=\"nome\">Nome Completo:</label>
                                <input id=\"nome\" class=\"form-control\" type=\"text\" name=\"nome\"
                                    placeholder=\"Nome Completo\" minlength=\"2\" 
                                    style=\"text-transform:uppercase\" required=\"required\" value=\"$admin->nome\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"nomeguerra\">Nome de Guerra:</label>
                                <input id=\"nomeguerra\" class=\"form-control\" type=\"text\" name=\"nomeguerra\"
                                    placeholder=\"Nome de Guerra\" minlength=\"2\"
                                    style=\"text-transform:uppercase\" required=\"required\" value=\"$admin->nome_guerra\">
                            </div>
                            <div class=\"form-group\">
                                <label for=\"nip\">NIP:</label>
                                <input id=\"nip\" class=\"form-control\" type=\"text\" name=\"nip\" 
                                       placeholder=\"NIP\" maxlength=\"8\" required=\"required\" value=\"$admin->nip\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"cpf\">CPF (Servidores Civis):</label>
                                <input id=\"cpf\" class=\"form-control\" type=\"text\" name=\"cpf\" 
                                       placeholder=\"CPF (Servidores Civis)\" maxlength=\"11\" value=\"$admin->cpf\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"senha\" class=\"control-label\">Senha:</label>
                                <input id=\"senha\" class=\"form-control\" type=\"password\" name=\"senha\"
                                       placeholder=\"Senha Segura\" minlength=\"8\"
                                       maxlength=\"25\" required=\"required\">
                                <div class=\"help-block with-errors\"></div>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"confirmasenha\" class=\"control-label\">Confirme a Senha:</label>
                                <input id=\"confirmasenha\" class=\"form-control\" type=\"password\" name=\"confirmasenha\"
                                    placeholder=\"Confirmação da Senha\" minlength=\"8\"
                                    maxlength=\"25\" required=\"required\">
                                <div class=\"help-block with-errors\"></div>
                            </div>
                            <input id=\"ativo\" type=\"hidden\" name=\"ativo\" value=\"ATIVO\">";
                            }
                        echo"
                        </fieldset>
                        <input id=\"idtb_admin\" type=\"hidden\" name=\"idtb_admin\" value=\"$admin->idtb_admin\">
                        <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Salvar\">
                    </form>
                </div>
            </main>
        </div>
    </div>";
}

/* Monta quadro de administradores */
if (($row) AND ($act == NULL)) {

	$admin = "SELECT * FROM db_clti.tb_admin ORDER BY id_posto_grad DESC";
    $admin = $pg->getRows($admin);

    echo"<div class=\"table-responsive\">
            <table class=\"table table-hover\">
                <thead>
                    <tr>
                        <th scope=\"col\">Posto/Grad./Esp.</th>
                        <th scope=\"col\">NIP</th>
                        <th scope=\"col\">Nome</th>
                        <th scope=\"col\">Nome de Guerra</th>
                        <th scope=\"col\">Ações</th>
                    </tr>
                </thead>";

    foreach ($admin as $key => $value) {

        #Seleciona Sigla do Posto/Graduação
        $postograd = $pg->getCol("SELECT sigla FROM db_clti.tb_posto_grad WHERE idtb_posto_grad = $value->id_posto_grad");
        
        #Selectiona Sigla do Corpo/Quadro
        if ($value->id_corpo_quadro != 11){
            $corpoquadro = $pg->getCol("SELECT sigla FROM db_clti.tb_corpo_quadro 
                WHERE idtb_corpo_quadro = $value->id_corpo_quadro");
        }
        else{
            $corpoquadro = "";
        }
        
        #Seleciona Sigla da Especialidade
        if ($value->id_especialidade != 12 AND $value->id_especialidade != 13) {
            $especialidade = $pg->getCol("SELECT sigla FROM db_clti.tb_especialidade 
                WHERE idtb_especialidade = $value->id_especialidade");
        }
        else{
            $especialidade = "";
        }

        #Seleciona NIP caso seja militar da MB
        if ($value->nip != NULL) {
            $identificacao = $value->nip;
        }
        else{
            $identificacao = "";
        }

        echo"       <tr>
                        <th scope=\"row\">".$postograd." ".$corpoquadro." ".$especialidade."</th>
                        <td>".$identificacao."</td>
                        <td>".$value->nome."</td>
                        <td>".$value->nome_guerra."</td>
                        <td><a href=\"?cmd=admin&act=cad&param=".$value->idtb_admin."\">Editar</a> - 
                            <a href=\"?cmd=admin&act=cad&param=".$value->idtb_admin."&senha=troca\">Senha</a> - 
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
    $idtb_admin = $_POST['idtb_admin'];
	$omapoiada = $_POST['omapoiada'];
    $postograd = $_POST['postograd'];
    $corpoquadro = $_POST['corpoquadro'];
    $especialidade = $_POST['especialidade'];
    $nip = $_POST['nip'];
    $cpf = $_POST['cpf'];
    $nome = strtoupper($_POST['nome']);
    $nomeguerra = strtoupper($_POST['nomeguerra']);
    $ativo = strtoupper($_POST['ativo']);

    if ($nip == NULL) {
        $usuario = $cpf;
    }
    else {
        $usuario = $nip;
    }

    /* Opta pelo Método Update */
    if ($idtb_admin){
        $senha = $_POST['senha'];

        if($senha==NULL){
            $sql = "UPDATE db_clti.tb_admin SET
            id_om='$omapoiada',id_posto_grad='$postograd', id_corpo_quadro='$corpoquadro', 
            id_especialidade='$especialidade', nip='$nip', cpf='$cpf', nome='$nome', 
            nome_guerra='$nomeguerra', status='$ativo'
            WHERE idtb_admin='$idtb_admin'";
        }

        else{
            
            $hash = sha1(md5($senha));
            $salt = sha1(md5($usuario));
            $senha = $salt.$hash;

            $sql = "UPDATE db_clti.tb_admin SET
                id_om='$omapoiada',id_posto_grad='$postograd', id_corpo_quadro='$corpoquadro', 
                id_especialidade='$especialidade', nip='$nip', cpf='$cpf', nome='$nome', nome_guerra='$nomeguerra', 
                senha='$senha', status='$ativo'
                WHERE idtb_admin='$idtb_admin'";
        }


        $pg->exec($sql);

        if ($pg) {
            echo "<h5>Resgistros incluídos no banco de dados.</h5>
            <meta http-equiv=\"refresh\" content=\"1;url=?cmd=admin\">";
        }

        else {
            echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
            echo(pg_result_error($pg) . "<br />\n");
        }
    }

    /* Opta pelo Método Insert */
    else{

        /* Checa se há Admin com mesmo login cadastrado */

        $sql = "SELECT * FROM db_clti.tb_admin WHERE nip = '$usuario' OR cpf = '$usuario' ";
        $row = $pg->getRow($sql);

        if ($row) {
            echo "<h5>Já existe um Admin cadastrado com esse NIP/CPF.</h5>";
        }

        else {

            $senha = $_POST['senha'];

            $hash = sha1(md5($senha));
            $salt = sha1(md5($usuario));
            $senha = $salt.$hash;

            $sql = "INSERT INTO db_clti.tb_admin(
                id_om,id_posto_grad, id_corpo_quadro, id_especialidade, 
                nip, cpf, nome, nome_guerra, senha, perfil, status)
                VALUES ('$omapoiada', '$postograd', '$corpoquadro', '$especialidade',
                '$nip', '$cpf', '$nome', '$nomeguerra', '$senha', 'ADMIN_OM', 'ATIVO')";

            $pg->exec($sql);

            if ($pg) {
                echo "<h5>Resgistros incluídos no banco de dados.</h5>
                <meta http-equiv=\"refresh\" content=\"1;url=?cmd=admin\">";
            }

            else {
                echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
                echo(pg_result_error($pg) . "<br />\n");
            }

        }
    }
}

?>