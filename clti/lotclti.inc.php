<?php
/**
 * LotCLTI
 * Operações relacionadas à Lotação do CLTI
 * lotclti.class.php
 * 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/* Classe de interação com o PostgreSQL */
require_once "../class/pgsql.class.php";
$pg = new PgSql();

/* Recupera informações do tipo da Lotação do CLTI */
$sql = "SELECT * FROM db_clti.tb_lotacao_clti";

$row = $pg->getRow($sql);

@$act = $_GET['act'];

/* Checa se há técnicos cadastrados */
if (($row == '0') AND ($act == NULL)) {
	echo "<h5>Não há técnicos cadastrados neste CLTI,<br />
		 clique <a href=\"?cmd=lotclti&act=cad\">aqui</a> para fazê-lo.</h5>";
}

/* Carrega form para cadastro de técnicos */
if ($act == 'cad') {
    @$param = $_GET['param'];
    @$senha = $_GET['senha'];
    if ($param){
        $clti = $pg->getRow("SELECT * FROM db_clti.tb_lotacao_clti WHERE idtripulacao_clti = '$param'");
        $clti_posto_grad = $pg->getRow("SELECT idtb_posto_grad,sigla FROM db_clti.tb_posto_grad 
            WHERE idtb_posto_grad = '$clti->id_posto_grad'");
        $clti_corpo_quadro = $pg->getRow("SELECT idtb_corpo_quadro,sigla FROM db_clti.tb_corpo_quadro 
            WHERE idtb_corpo_quadro = '$clti->id_corpo_quadro'");
        $clti_especialidade = $pg->getRow("SELECT idtb_especialidade,sigla FROM db_clti.tb_especialidade 
            WHERE idtb_especialidade = '$clti->id_especialidade'");
    }
    else{
        $clti = (object)['idtripulacao_clti'=>'','nip'=>'','cpf'=>'','nome'=>'','nome_guerra'=>''];
        $clti_om = (object)['idtb_om_apoiadas'=>'','sigla'=>''];
        $clti_posto_grad = (object)['idtb_posto_grad'=>'8','sigla'=>'1ºTen'];
        $clti_corpo_quadro = (object)['idtb_corpo_quadro'=>'','sigla'=>''];
        $clti_especialidade = (object)['idtb_especialidade'=>'','sigla'=>''];
    }
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
                    <form id=\"insereusuario\" action=\"?cmd=lotclti&act=insert\" method=\"post\" enctype=\"multipart/form-data\">
                        <fieldset>";
                            
                            if ($param){
                                if ($senha){
                                    echo"
                                    <legend>Lotação do CLTI - Troca de Senha</legend>
                                    <input id=\"postograd\" class=\"form-control\" name=\"postograd\"
                                        value=\"$clti_posto_grad->idtb_posto_grad\" hidden=\"true\">
                                    <input id=\"corpoquadro\" class=\"form-control\" name=\"corpoquadro\"
                                        value=\"$clti_corpo_quadro->idtb_corpo_quadro\" hidden=\"true\">
                                    <input id=\"especialidade\" class=\"form-control\" name=\"especialidade\"
                                        value=\"$clti_especialidade->idtb_especialidade\" hidden=\"true\">
                                    <input id=\"nome\" class=\"form-control\" type=\"text\" name=\"nome\"
                                        hidden=\"true\" value=\"$clti->nome\">
                                    <input id=\"nomeguerra\" class=\"form-control\" type=\"text\" name=\"nomeguerra\"
                                        hidden=\"true\" value=\"$clti->nome_guerra\">
                                    <div class=\"form-group\">
                                        <label for=\"nip\">NIP:</label>
                                        <input id=\"nip\" class=\"form-control\" type=\"text\" name=\"nip\" readonly=\"true\"
                                            placeholder=\"NIP\" maxlength=\"8\" required=\"required\" value=\"$clti->nip\">
                                    </div>

                                    <div class=\"form-group\">
                                        <label for=\"cpf\">CPF (Servidores Civis):</label>
                                        <input id=\"cpf\" class=\"form-control\" type=\"text\" name=\"cpf\" readonly=\"true\"
                                            placeholder=\"CPF (Servidores Civis)\" maxlength=\"11\" value=\"$clti->cpf\">
                                    </div>

                                    <div class=\"form-group\">
                                        <label for=\"ativo\" class=\"control-label\">Situação:</label>
                                        <input id=\"ativo\" class=\"form-control\" type=\"text\" name=\"ativo\" readonly=\"true\"
                                            value=\"$clti->status\">
                                    </div>

                                    <div class=\"form-group\">
                                        <label for=\"senha\" class=\"control-label\">Trocar Senha:</label>
                                        <input id=\"senha\" class=\"form-control\" type=\"password\" name=\"senha\"
                                            placeholder=\"Senha Segura\" maxlength=\"25\">
                                        <div class=\"help-block with-errors\"></div>
                                    </div>

                                    <div class=\"form-group\">
                                        <label for=\"confirmasenha\" class=\"control-label\">Confirme a Senha:</label>
                                        <input id=\"confirmasenha\" class=\"form-control\" type=\"password\" name=\"confirmasenha\"
                                            placeholder=\"Confirmação da Senha\" maxlength=\"25\">
                                        <div class=\"help-block with-errors\"></div>
                                    </div>";
                                }
                                else{
                                    echo"
                                    <legend>Lotação do CLTI - Alteração</legend>
                                    <div class=\"form-group\">
                                        <label for=\"postograd\">Posto/Graduação:</label>
                                        <select id=\"postograd\" class=\"form-control\" name=\"postograd\">
                                            <option value=\"$clti_posto_grad->idtb_posto_grad\" selected=\"true\">
                                                $clti_posto_grad->sigla</option>";
                                            foreach ($postograd as $key => $value) {
                                                echo"<option value=\"".$value->idtb_posto_grad."\">
                                                    ".$value->nome."</option>";
                                            };
                                        echo "</select>
                                    </div>

                                    <div class=\"form-group\">
                                        <label for=\"corpoquadro\">Corpo/Quadro:</label>
                                        <select id=\"corpoquadro\" class=\"form-control\" name=\"corpoquadro\">
                                            <option value=\"$clti_corpo_quadro->idtb_corpo_quadro\" selected=\"true\">
                                                $clti_corpo_quadro->sigla</option>";
                                            foreach ($corpoquadro as $key => $value) {
                                                echo"<option value=\"".$value->idtb_corpo_quadro."\">
                                                    ".$value->nome."</option>";
                                            };
                                        echo "</select>
                                    </div>

                                    <div class=\"form-group\">
                                        <label for=\"especialidade\">Especialidade:</label>
                                        <select id=\"especialidade\" class=\"form-control\" name=\"especialidade\">
                                            <option value=\"$clti_especialidade->idtb_especialidade\" selected=\"true\">
                                                $clti_especialidade->sigla</option>";
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
                                            style=\"text-transform:uppercase\" required=\"required\" value=\"$clti->nome\">
                                    </div>

                                    <div class=\"form-group\">
                                        <label for=\"nomeguerra\">Nome de Guerra:</label>
                                        <input id=\"nomeguerra\" class=\"form-control\" type=\"text\" name=\"nomeguerra\"
                                            placeholder=\"Nome de Guerra\" minlength=\"2\"
                                            style=\"text-transform:uppercase\" required=\"required\" value=\"$clti->nome_guerra\">
                                    </div>
                                    <div class=\"form-group\">
                                        <label for=\"nip\">NIP:</label>
                                        <input id=\"nip\" class=\"form-control\" type=\"text\" name=\"nip\" readonly=\"true\"
                                            placeholder=\"NIP\" maxlength=\"8\" required=\"required\" value=\"$clti->nip\">
                                    </div>

                                    <div class=\"form-group\">
                                        <label for=\"cpf\">CPF (Servidores Civis):</label>
                                        <input id=\"cpf\" class=\"form-control\" type=\"text\" name=\"cpf\" readonly=\"true\"
                                            placeholder=\"CPF (Servidores Civis)\" maxlength=\"11\" value=\"$clti->cpf\">
                                    </div>

                                    <div class=\"form-group\">
                                        <label for=\"ativo\" class=\"control-label\">Situação:</label>
                                        <select id=\"ativo\" class=\"form-control\" name=\"ativo\">
                                            <option value=\"$clti->status\" selected=\"true\">$clti->status</option>
                                            <option value=\"ATIVO\">ATIVO</option>
                                            <option value=\"INATIVO\">INATIVO</option>
                                    </div>
                                    <input id=\"senha\" type=\"hidden\" name=\"senha\" value=\"\">";
                                }
                            }
                            
                            else{
                            echo"
                            <legend>Lotação do CLTI - Cadastro</legend>
                            <div class=\"form-group\">
                                <label for=\"postograd\">Posto/Graduação:</label>
                                <select id=\"postograd\" class=\"form-control\" name=\"postograd\">
                                    <option value=\"$clti_posto_grad->idtb_posto_grad\" selected=\"true\">
                                        $clti_posto_grad->sigla</option>";
                                    foreach ($postograd as $key => $value) {
                                        echo"<option value=\"".$value->idtb_posto_grad."\">
                                            ".$value->nome."</option>";
                                    };
                                echo "</select>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"corpoquadro\">Corpo/Quadro:</label>
                                <select id=\"corpoquadro\" class=\"form-control\" name=\"corpoquadro\">
                                    <option value=\"$clti_corpo_quadro->idtb_corpo_quadro\" selected=\"true\">
                                        $clti_corpo_quadro->sigla</option>";
                                    foreach ($corpoquadro as $key => $value) {
                                        echo"<option value=\"".$value->idtb_corpo_quadro."\">
                                            ".$value->nome."</option>";
                                    };
                                echo "</select>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"especialidade\">Especialidade:</label>
                                <select id=\"especialidade\" class=\"form-control\" name=\"especialidade\">
                                    <option value=\"$clti_especialidade->idtb_especialidade\" selected=\"true\">
                                        $clti_especialidade->sigla</option>";
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
                                       style=\"text-transform:uppercase\" required=\"required\" value=\"$clti->nome\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"nomeguerra\">Nome de Guerra:</label>
                                <input id=\"nomeguerra\" class=\"form-control\" type=\"text\" name=\"nomeguerra\"
                                       placeholder=\"Nome de Guerra\" minlength=\"2\"
                                       style=\"text-transform:uppercase\" required=\"required\" value=\"$clti->nome_guerra\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"nip\">NIP:</label>
                                <input id=\"nip\" class=\"form-control\" type=\"text\" name=\"nip\" 
                                       placeholder=\"NIP\" maxlength=\"8\" required=\"required\" value=\"$clti->nip\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"cpf\">CPF (Servidores Civis):</label>
                                <input id=\"cpf\" class=\"form-control\" type=\"text\" name=\"cpf\" 
                                       placeholder=\"CPF (Servidores Civis)\" maxlength=\"11\" value=\"$clti->cpf\">
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
                        <input id=\"idtb_lotacao_clti\" type=\"hidden\" name=\"idtb_lotacao_clti\" 
                            value=\"$clti->idtripulacao_clti\">
                        <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Salvar\">
                    </form>
                </div>
            </main>
        </div>
    </div>";
}

/* Monta quadro com lotação/efetivo */
if (($row) AND ($act == NULL)) {

    $clti = "SELECT * FROM db_clti.tb_lotacao_clti ORDER BY id_posto_grad DESC";
    $clti = $pg->getRows($clti);

    echo"<div class=\"table-responsive\">
        <table class=\"table table-hover\">
            <thead>
                <tr>
                    <th scope=\"col\">Pessoal do CLTI</th>
                    <th scope=\"col\">Lotação</th>
                    <th scope=\"col\">Efetivo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope=\"row\">#</th>
                    <td>".$pg->getCol("SELECT lotacao_oficiais+lotacao_pracas
                        FROM db_clti.tb_tipos_clti;")."</td>
                    <td>".$pg->getCol("SELECT COUNT(nip) AS qtde 
                        FROM db_clti.tb_lotacao_clti;")."</td>
                </tr>
                <tr>
                    <th scope=\"row\">Oficiais</th>
                    <td>".$pg->getCol("SELECT lotacao_oficiais AS qtde 
                        FROM db_clti.tb_tipos_clti;")."</td>
                    <td>".$pg->getCol("SELECT COUNT(nip) AS qtde 
                        FROM db_clti.tb_lotacao_clti WHERE id_posto_grad < '10';")."</td>
                </tr>
                <tr>
                    <th scope=\"row\">Praças</th>
                    <td> ".$pg->getCol("SELECT lotacao_pracas AS qtde 
                        FROM db_clti.tb_tipos_clti;")."</td>
                    <td> ".$pg->getCol("SELECT COUNT(nip) AS qtde 
                        FROM db_clti.tb_lotacao_clti WHERE id_posto_grad > '9' AND id_posto_grad < '21';")."</td>
                </tr>
                <tr>
                    <th scope=\"row\">Servidores Civis</th>
                    <td> 0</td>
                    <td> ".$pg->getCol("SELECT COUNT(nip) AS qtde 
                        FROM db_clti.tb_lotacao_clti WHERE id_posto_grad = '21';")."</td>
                </tr>
            </tbody>
        </table>
        </div>
        <p></p>
        <p><h2>Equipe do CLTI</h2></p>";

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

    foreach ($clti as $key => $value) {

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
                        <td><a href=\"?cmd=lotclti&act=cad&param=".$value->idtripulacao_clti."\">Editar</a> - 
                            <a href=\"?cmd=lotclti&act=cad&param=".$value->idtripulacao_clti."&senha=troca\">Senha</a> -
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
    $idtb_lotacao_clti = $_POST['idtb_lotacao_clti'];
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
    if ($idtb_lotacao_clti){
        $senha = $_POST['senha'];

        if($senha==NULL){
            $sql = "UPDATE db_clti.tb_lotacao_clti SET
            id_posto_grad='$postograd', id_corpo_quadro='$corpoquadro', 
            id_especialidade='$especialidade', nip='$nip', cpf='$cpf', nome='$nome', 
            nome_guerra='$nomeguerra', status='$ativo'
            WHERE idtripulacao_clti='$idtb_lotacao_clti'";
        }

        else{
            
            $hash = sha1(md5($senha));
            $salt = sha1(md5($usuario));
            $senha = $salt.$hash;

            $sql = "UPDATE db_clti.tb_lotacao_clti SET
                id_posto_grad='$postograd', id_corpo_quadro='$corpoquadro', 
                id_especialidade='$especialidade', nip='$nip', cpf='$cpf', nome='$nome', 
                nome_guerra='$nomeguerra', senha='$senha', status='$ativo'
                WHERE idtripulacao_clti='$idtb_lotacao_clti'";
        }

        $pg->exec($sql);

        if ($pg) {
            echo "<h5>Resgistros incluídos no banco de dados.</h5>
            <meta http-equiv=\"refresh\" content=\"1;url=?cmd=lotclti\">";
        }

        else {
            echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
            echo(pg_result_error($pg) . "<br />\n");
        }
    }

    /* Opta pelo Método Insert */
    else{

        $sql = "SELECT * FROM db_clti.tb_lotacao_clti WHERE nip = '$usuario' OR cpf = '$usuario' ";
        $row = $pg->getRow($sql);

        if ($row) {
            echo "<h5>Já existe um cadastro com esse NIP/CPF.</h5>
                $sql";
        }

        else {

            $senha = $_POST['senha'];
            $hash = sha1(md5($senha));
            $salt = sha1(md5($usuario));
            $senha = $salt.$hash;

            $sql = "INSERT INTO db_clti.tb_lotacao_clti(
                    id_posto_grad, id_corpo_quadro, id_especialidade, 
                    nip, cpf, nome, nome_guerra, senha, status, perfil)
                VALUES ('$postograd', '$corpoquadro', '$especialidade', 
                    '$nip', '$cpf', '$nome', '$nomeguerra', '$senha', 'ATIVO', 'TEC_CLTI')";


            $pg->exec($sql);

            if ($pg) {
                echo "<h5>Resgistros incluídos no banco de dados.</h5>
                <meta http-equiv=\"refresh\" content=\"1;url=?cmd=lotclti\">";
            }

            else {
                echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
                echo(pg_result_error($pg) . "<br />\n");
            }
        }
    }
}

?>