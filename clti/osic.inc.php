<?php
/**
 * OSIC
 * Operações relacionadas aos OSIC
 * osci.class.php
 * 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/* Classe de interação com o PostgreSQL */
require_once "../class/pgsql.class.php";
$pg = new PgSql();

/* Recupera informações dos OSIC */
$sql = "SELECT * FROM db_clti.tb_osic";

$row = $pg->getRow($sql);

@$act = $_GET['act'];

/* Checa se há OSIC cadastrado */
if (($row == '0') AND ($act == NULL)) {
	echo "<h5>Não há OSIC cadastrados, clique <a href=\"?cmd=osic&act=cad\">aqui</a> para fazê-lo.</h5>";
}

/* Carrega form para cadastro de OSIC */
if ($act == 'cad') {
	$omapoiada = "SELECT * FROM db_clti.tb_om_apoiadas ORDER BY sigla ASC";
    $omapoiada = $pg->getRows($omapoiada);
    $postograd = "SELECT * FROM db_clti.tb_posto_grad";
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
                    <form id=\"insereusuario\" role=\"form\" action=\"?cmd=osic&act=insert\" 
                        method=\"post\" enctype=\"multipart/form-data\">
                        <fieldset>
                            <legend>OSIC - Cadastro</legend>

                            <div class=\"form-group\">
                                <label for=\"omapoiada\">OM Apoiada:</label>
                                <select id=\"omapoiada\" class=\"form-control\" name=\"omapoiada\">";
                                    foreach ($omapoiada as $key => $value) {
                                        echo"<option value=\"".$value->idtb_om_apoiadas."\">
                                            ".$value->sigla."</option>";
                                    };
                                echo "</select>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"postograd\">Posto/Graduação:</label>
                                <select id=\"postograd\" class=\"form-control\" name=\"postograd\">";
                                    foreach ($postograd as $key => $value) {
                                        echo"<option value=\"".$value->idtb_posto_grad."\">
                                            ".$value->nome."</option>";
                                    };
                                echo "</select>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"corpoquadro\">Corpo/Quadro:</label>
                                <select id=\"corpoquadro\" class=\"form-control\" name=\"corpoquadro\">";
                                    foreach ($corpoquadro as $key => $value) {
                                        echo"<option value=\"".$value->idtb_corpo_quadro."\">
                                            ".$value->nome."</option>";
                                    };
                                echo "</select>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"especialidade\">Especialidade:</label>
                                <select id=\"especialidade\" class=\"form-control\" name=\"especialidade\">";
                                    foreach ($especialidade as $key => $value) {
                                        echo"<option value=\"".$value->idtb_especialidade."\">
                                            ".$value->nome."</option>";
                                    };
                                echo "</select>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"nip\">NIP:</label>
                                <input id=\"nip\" class=\"form-control\" type=\"text\" name=\"nip\"
                                       placeholder=\"NIP\" maxlength=\"8\" required=\"required\">
                            </div>
                            <div class=\"form-group\">
                                <label for=\"cpf\">CPF (Servidores Civis):</label>
                                <input id=\"cpf\" class=\"form-control\" type=\"text\" name=\"cpf\"
                                       placeholder=\"CPF (Servidores Civis)\" maxlength=\"11\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"nome\">Nome Completo:</label>
                                <input id=\"nome\" class=\"form-control\" type=\"text\" name=\"nome\"
                                       placeholder=\"Nome Completo\" minlength=\"2\" 
                                       style=\"text-transform:uppercase\" required=\"required\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"nomeguerra\">Nome de Guerra:</label>
                                <input id=\"nomeguerra\" class=\"form-control\" type=\"text\" name=\"nomeguerra\"
                                       placeholder=\"Nome de Guerra\" minlength=\"2\"
                                       style=\"text-transform:uppercase\" required=\"required\">
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

                        </fieldset>
                        <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Salvar\">
                    </form>
                </div>
            </main>
        </div>
    </div>";
}

/* Monta quadro de OSIC */
if (($row) AND ($act == NULL)) {

	$osic = "SELECT * FROM db_clti.tb_osic ORDER BY id_posto_grad DESC";
    $osic = $pg->getRows($osic);

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

    foreach ($osic as $key => $value) {

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
                        <td>Editar - Excluir</td>
                    </tr>";
    }
    echo"
                </tbody>
            </table>
            </div>";
}

/* Método INSERT */
if ($act == 'insert') {
	$omapoiada = $_POST['omapoiada'];
    $postograd = $_POST['postograd'];
    $corpoquadro = $_POST['corpoquadro'];
    $especialidade = $_POST['especialidade'];
    $nip = $_POST['nip'];
    $cpf = $_POST['cpf'];
    $nome = strtoupper($_POST['nome']);
    $nomeguerra = strtoupper($_POST['nomeguerra']);
    $senha = $_POST['senha'];

    if ($nip == NULL) {
        $usuario = $cpf;
    }
    else {
        $usuario = $nip;
    }
    
    /* Checa se há OSIC com mesmo login cadastrado */

    $sql = "SELECT * FROM db_clti.tb_osic WHERE nip = '$usuario' OR cpf = '$usuario' ";
    $row = $pg->getRow($sql);
    
    if ($row) {
        echo "<h5>Já existe um Admin cadastrado com esse NIP/CPF.</h5>";
    }

    else {

        $hash = sha1(md5($senha));
        $salt = sha1(md5($usuario));
        $senha = $salt.$hash;
        $senha = sha1(md5($senha));

        $sql = "INSERT INTO db_clti.tb_osic(
            id_om,id_posto_grad, id_corpo_quadro, id_especialidade, 
            nip, cpf, nome, nome_guerra, senha, perfil, status)
            VALUES ('$omapoiada', '$postograd', '$corpoquadro', '$especialidade',
            '$nip', '$cpf', '$nome', '$nomeguerra', '$senha', 'OSIC_OM', 'ATIVO')";

        $pg->exec($sql);

        if ($pg) {
            echo "<h5>Resgistros incluídos no banco de dados.</h5>";
        }

        else {
            echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
            echo(pg_result_error($pg) . "<br />\n");
        }

    }

}

?>