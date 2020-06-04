<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/* Classe de interação com o PostgreSQL */
require_once "../class/pgsql.class.php";
$pg = new PgSql();

/* Recupera informações dos Admin */
$sql = "SELECT * FROM db_clti.vw_pessoal_ti WHERE funcao!='OSIC' AND funcao!='ADMIN' ";

$row = $pg->getRow($sql);

@$act = $_GET['act'];

/* Checa se há Admin cadastrado */
if (($row == '0') AND ($act == NULL)) {
	echo "<h5>Não há Pessoal de TI cadastrado,<br />
		 clique <a href=\"?cmd=pessoalti&act=cad\">aqui</a> para fazê-lo.</h5>";
}

/* Carrega form para cadastro de Admin */
if ($act == 'cad') {
    @$param = $_GET['param'];
    @$senha = $_GET['senha'];
    if ($param){
        $pessti = $pg->getRow("SELECT * FROM db_clti.vw_pessoal_ti WHERE idtb_pessoal_ti = '$param'");
    }
    else{
        $pessti = (object)['idtb_pessoal_ti'=>'','nip'=>'','cpf'=>'','nome'=>'','nome_guerra'=>'',
            'idtb_om_apoiadas'=>'','sigla_om'=>'','idtb_posto_grad'=>'8','sigla_posto_grad'=>'Primeiro Tenente',
            'idtb_corpo_quadro'=>'','sigla_corpo_quadro'=>'','idtb_especialidade'=>'','sigla_espec'=>''];
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
                    <form id=\"insereusuario\" role=\"form\" action=\"?cmd=pessoalti&act=insert\" 
                        method=\"post\" enctype=\"multipart/form-data\">
                        <fieldset>";
                            #Prepara formulário para atualização de dados
                            if ($param){
                                #Em caso de troca de senha
                                if ($senha){
                                    echo"
                                    <legend>Administradores de Rede - Troca de Senha</legend>
                                    <input id=\"omapoiada\" class=\"form-control\" name=\"omapoiada\"
                                        value=\"$pessti->idtb_om_apoiadas\" hidden=\"true\">
                                    <input id=\"postograd\" class=\"form-control\" name=\"postograd\"
                                        value=\"$pessti->idtb_posto_grad\" hidden=\"true\">
                                    <input id=\"corpoquadro\" class=\"form-control\" name=\"corpoquadro\"
                                        value=\"$pessti->idtb_corpo_quadro\" hidden=\"true\">
                                    <input id=\"especialidade\" class=\"form-control\" name=\"especialidade\"
                                        value=\"$pessti->idtb_especialidade\" hidden=\"true\">
                                    <input id=\"nome\" class=\"form-control\" type=\"text\" name=\"nome\"
                                        hidden=\"required\" value=\"$pessti->nome\">
                                    <input id=\"nomeguerra\" class=\"form-control\" type=\"text\" name=\"nomeguerra\"
                                        hidden=\"required\" value=\"$pessti->nome_guerra\">
                                    <input id=\"correio_eletronico\" class=\"form-control\" type=\"text\" name=\"correio_eletronico\"
                                        hidden=\"required\" value=\"$pessti->correio_eletronico\">
                                    <input id=\"funcaoti\" class=\"form-control\" type=\"text\" name=\"funcaoti\"
                                        hidden=\"required\" value=\"$pessti->funcao\">

                                    <div class=\"form-group\">
                                        <label for=\"nip\">NIP:</label>
                                        <input id=\"nip\" class=\"form-control\" type=\"text\" name=\"nip\" readonly=\"true\"
                                            placeholder=\"NIP\" maxlength=\"8\" required=\"true\" value=\"$pessti->nip\">
                                    </div>

                                    <div class=\"form-group\">
                                        <label for=\"cpf\">CPF (Servidores Civis):</label>
                                        <input id=\"cpf\" class=\"form-control\" type=\"text\" name=\"cpf\" readonly=\"true\"
                                            placeholder=\"CPF (Servidores Civis)\" maxlength=\"11\" value=\"$pessti->cpf\">
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
                                        value=\"$pessti->status\" hidden=\"true\">";
                                }
                                #Em caso de alteração de outros dados
                                else{
                                    echo"
                                    <legend>Administradores de Rede - Alteração</legend>

                                    <div class=\"form-group\">
                                        <label for=\"omapoiada\">OM Apoiada:</label>
                                        <select id=\"omapoiada\" class=\"form-control\" name=\"omapoiada\">
                                            <option value=\"$pessti->idtb_om_apoiadas\" selected=\"true\">
                                                $pessti->sigla_om</option>";
                                            foreach ($omapoiada as $key => $value) {
                                                echo"<option value=\"".$value->idtb_om_apoiadas."\">
                                                    ".$value->sigla."</option>";
                                            };
                                        echo "</select>
                                    </div>

                                    <div class=\"form-group\">
                                        <label for=\"postograd\">Posto/Graduação:</label>
                                        <select id=\"postograd\" class=\"form-control\" name=\"postograd\">
                                            <option value=\"$pessti->idtb_posto_grad\" selected=\"true\">
                                                $pessti->sigla_posto_grad</option>";
                                            foreach ($postograd as $key => $value) {
                                                echo"<option value=\"".$value->idtb_posto_grad."\">
                                                    ".$value->nome."</option>";
                                            };
                                        echo "</select>
                                    </div>

                                    <div class=\"form-group\">
                                        <label for=\"corpoquadro\">Corpo/Quadro:</label>
                                        <select id=\"corpoquadro\" class=\"form-control\" name=\"corpoquadro\">
                                            <option value=\"$pessti->idtb_corpo_quadro\" selected=\"true\">
                                                $pessti->sigla_corpo_quadro</option>";
                                            foreach ($corpoquadro as $key => $value) {
                                                echo"<option value=\"".$value->idtb_corpo_quadro."\">
                                                    ".$value->nome."</option>";
                                            };
                                        echo "</select>
                                    </div>

                                    <div class=\"form-group\">
                                        <label for=\"especialidade\">Especialidade:</label>
                                        <select id=\"especialidade\" class=\"form-control\" name=\"especialidade\">
                                            <option value=\"$pessti->idtb_especialidade\" selected=\"true\">
                                                $pessti->sigla_espec</option>";
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
                                            style=\"text-transform:uppercase\" required=\"true\" value=\"$pessti->nome\">
                                    </div>

                                    <div class=\"form-group\">
                                        <label for=\"nomeguerra\">Nome de Guerra:</label>
                                        <input id=\"nomeguerra\" class=\"form-control\" type=\"text\" name=\"nomeguerra\"
                                            placeholder=\"Nome de Guerra\" minlength=\"2\"
                                            style=\"text-transform:uppercase\" required=\"true\" value=\"$pessti->nome_guerra\">
                                    </div>
                                    <div class=\"form-group\">
                                        <label for=\"nip\">NIP:</label>
                                        <input id=\"nip\" class=\"form-control\" type=\"text\" name=\"nip\" readonly=\"true\"
                                            placeholder=\"NIP\" maxlength=\"8\" required=\"true\" value=\"$pessti->nip\">
                                    </div>

                                    <div class=\"form-group\">
                                        <label for=\"cpf\">CPF (Servidores Civis):</label>
                                        <input id=\"cpf\" class=\"form-control\" type=\"text\" name=\"cpf\" readonly=\"true\"
                                            placeholder=\"CPF (Servidores Civis)\" maxlength=\"11\" value=\"$pessti->cpf\">
                                    </div>

                                    <div class=\"form-group\">
                                        <label for=\"correio_eletronico\">Correio Eletrônico:</label>
                                        <input id=\"correio_eletronico\" class=\"form-control\" type=\"email\" 
                                            name=\"correio_eletronico\" placeholder=\"Preferencialmente Zimbra\" 
                                            minlength=\"2\" style=\"text-transform:uppercase\" required=\"true\" 
                                            value=\"$pessti->correio_eletronico\">
                                    </div>

                                    <div class=\"form-group\">
                                        <label for=\"funcaoti\">Função de TI:</label>
                                        <input id=\"funcaoti\" class=\"form-control\" type=\"text\" name=\"funcaoti\"
                                            placeholder=\"ex. Suporte ao Usuário\" minlength=\"2\" 
                                            style=\"text-transform:uppercase\" required=\"true\" value=\"$pessti->funcao\">
                                    </div>

                                    <input id=\"senha\" class=\"form-control\" type=\"password\" name=\"senha\"
                                            value=\"senha\" hidden=\"true\">
                                    <input id=\"confirmasenha\" class=\"form-control\" type=\"password\" name=\"confirmasenha\"
                                        value=\"confirmasenha\" hidden=\"true\">

                                    <div class=\"form-group\">
                                        <label for=\"ativo\" class=\"control-label\">Situação:</label>
                                        <select id=\"ativo\" class=\"form-control\" name=\"ativo\">
                                            <option value=\"$pessti->status\" selected=\"true\">$pessti->status</option>
                                            <option value=\"ATIVO\">ATIVO</option>
                                            <option value=\"INATIVO\">INATIVO</option>
                                        <div class=\"help-block with-errors\"></div>
                                    </div>";
                                }
                            }
                            #Prepara formulário para inclusão
                            else{
                            echo"
                            <legend>Administradores de Rede - Cadastro</legend>
                            <div class=\"form-group\">
                                <label for=\"omapoiada\">OM Apoiada:</label>
                                <select id=\"omapoiada\" class=\"form-control\" name=\"omapoiada\">
                                    <option value=\"$pessti->idtb_om_apoiadas\" selected=\"true\">
                                        $pessti->sigla_om</option>";
                                    foreach ($omapoiada as $key => $value) {
                                        echo"<option value=\"".$value->idtb_om_apoiadas."\">
                                            ".$value->sigla."</option>";
                                    };
                                echo "</select>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"postograd\">Posto/Graduação:</label>
                                <select id=\"postograd\" class=\"form-control\" name=\"postograd\">
                                    <option value=\"$pessti->idtb_posto_grad\" selected=\"true\">
                                        $pessti->sigla_posto_grad</option>";
                                    foreach ($postograd as $key => $value) {
                                        echo"<option value=\"".$value->idtb_posto_grad."\">
                                            ".$value->nome."</option>";
                                    };
                                echo "</select>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"corpoquadro\">Corpo/Quadro:</label>
                                <select id=\"corpoquadro\" class=\"form-control\" name=\"corpoquadro\">
                                    <option value=\"$pessti->idtb_corpo_quadro\" selected=\"true\">
                                        $pessti->sigla_corpo_quadro</option>";
                                    foreach ($corpoquadro as $key => $value) {
                                        echo"<option value=\"".$value->idtb_corpo_quadro."\">
                                            ".$value->nome."</option>";
                                    };
                                echo "</select>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"especialidade\">Especialidade:</label>
                                <select id=\"especialidade\" class=\"form-control\" name=\"especialidade\">
                                    <option value=\"$pessti->idtb_especialidade\" selected=\"true\">
                                        $pessti->sigla_espec</option>";
                                    foreach ($especialidade as $key => $value) {
                                        echo"<option value=\"".$value->idtb_especialidade."\">
                                            ".$value->nome."</option>";
                                    };
                                echo "</select>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"nip\">NIP:</label>
                                <input id=\"nip\" class=\"form-control\" type=\"text\" name=\"nip\" 
                                       placeholder=\"NIP\" maxlength=\"8\" required=\"true\" value=\"$pessti->nip\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"cpf\">CPF (Servidores Civis):</label>
                                <input id=\"cpf\" class=\"form-control\" type=\"text\" name=\"cpf\" 
                                       placeholder=\"CPF (Servidores Civis)\" maxlength=\"11\" value=\"$pessti->cpf\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"nome\">Nome Completo:</label>
                                <input id=\"nome\" class=\"form-control\" type=\"text\" name=\"nome\"
                                    placeholder=\"Nome Completo\" minlength=\"2\" 
                                    style=\"text-transform:uppercase\" required=\"true\" value=\"$pessti->nome\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"nomeguerra\">Nome de Guerra:</label>
                                <input id=\"nomeguerra\" class=\"form-control\" type=\"text\" name=\"nomeguerra\"
                                    placeholder=\"Nome de Guerra\" minlength=\"2\"
                                    style=\"text-transform:uppercase\" required=\"true\" value=\"$pessti->nome_guerra\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"correio_eletronico\">Correio Eletrônico:</label>
                                <input id=\"correio_eletronico\" class=\"form-control\" type=\"email\" name=\"correio_eletronico\"
                                    placeholder=\"Preferencialmente Zimbra\" minlength=\"2\"
                                    required=\"true\" value=\"$pessti->correio_eletronico\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"funcaoti\">Função de TI:</label>
                                <input id=\"funcaoti\" class=\"form-control\" type=\"text\" name=\"funcaoti\"
                                    placeholder=\"ex. Suporte ao Usuário\" minlength=\"2\"
                                    style=\"text-transform:uppercase\" required=\"true\" value=\"$pessti->funcao\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"senha\" class=\"control-label\">Senha:</label>
                                <input id=\"senha\" class=\"form-control\" type=\"password\" name=\"senha\"
                                       placeholder=\"Senha Segura\" minlength=\"8\"
                                       maxlength=\"25\" required=\"true\">
                                <div class=\"help-block with-errors\"></div>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"confirmasenha\" class=\"control-label\">Confirme a Senha:</label>
                                <input id=\"confirmasenha\" class=\"form-control\" type=\"password\" name=\"confirmasenha\"
                                    placeholder=\"Confirmação da Senha\" minlength=\"8\"
                                    maxlength=\"25\" required=\"true\">
                                <div class=\"help-block with-errors\"></div>
                            </div>
                            <input id=\"ativo\" type=\"hidden\" name=\"ativo\" value=\"ATIVO\">";
                            }
                        echo"
                        </fieldset>
                        <input id=\"idtb_pessoal_ti\" type=\"hidden\" name=\"idtb_pessoal_ti\" value=\"$pessti->idtb_pessoal_ti\">
                        <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Salvar\">
                    </form>
                </div>
            </main>
        </div>
    </div>";
}

/* Monta quadro de administradores */
if (($row) AND ($act == NULL)) {

	$pesti = "SELECT * FROM db_clti.vw_pessoal_ti WHERE funcao!='OSIC' AND funcao!='ADMIN' 
        ORDER BY idtb_posto_grad DESC";
    $pesti = $pg->getRows($pesti);

    echo"<div class=\"table-responsive\">
            <table class=\"table table-hover\">
                <thead>
                    <tr>
                        <th scope=\"col\">Posto/Grad./Esp.</th>
                        <th scope=\"col\">NIP/CPF</th>
                        <th scope=\"col\">Nome</th>
                        <th scope=\"col\">Nome de Guerra</th>
                        <th scope=\"col\">Função de TI</th>
                        <th scope=\"col\">Ações</th>
                    </tr>
                </thead>";

    foreach ($pesti as $key => $value) {

        #Seleciona NIP caso seja militar da MB
        if ($value->nip != NULL) {
            $identificacao = $value->nip;
        }
        else{
            $identificacao = $value->cpf;
        }

        echo"       <tr>
                        <th scope=\"row\">".$value->sigla_posto_grad." ".$value->sigla_corpo_quadro." 
                            ".$value->sigla_espec."</th>
                        <td>".$identificacao."</td>
                        <td>".$value->nome."</td>
                        <td>".$value->nome_guerra."</td>
                        <td>".$value->funcao."</td>
                        <td><a href=\"?cmd=pessoalti&act=cad&param=".$value->idtb_pessoal_ti."\">Editar</a> - 
                            <a href=\"?cmd=pessoalti&act=cad&param=".$value->idtb_pessoal_ti."&senha=troca\">Senha</a> - 
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
        $idtb_pessoal_ti = $_POST['idtb_pessoal_ti'];
        $omapoiada = $_POST['omapoiada'];
        $postograd = $_POST['postograd'];
        $corpoquadro = $_POST['corpoquadro'];
        $especialidade = $_POST['especialidade'];
        $nip = $_POST['nip'];
        $cpf = $_POST['cpf'];
        $nome = strtoupper($_POST['nome']);
        $nomeguerra = strtoupper($_POST['nomeguerra']);
        $correio_eletronico = strtolower($_POST['correio_eletronico']);
        $funcao = strtoupper($_POST['funcaoti']);
        $ativo = strtoupper($_POST['ativo']);

        if ($nip == NULL) {
            $usuario = $cpf;
        }
        else {
            $usuario = $nip;
        }

        /* Opta pelo Método Update */
        if ($idtb_pessoal_ti){
            $senha = $_POST['senha'];

            if($senha==NULL){
                $sql = "UPDATE db_clti.tb_pessoal_ti SET
                idtb_om_apoiadas='$omapoiada',idtb_posto_grad='$postograd', idtb_corpo_quadro='$corpoquadro', 
                idtb_especialidade='$especialidade', nip='$nip', cpf='$cpf', nome='$nome', 
                nome_guerra='$nomeguerra', correio_eletronico='$correio_eletronico',
                funcao='$funcao', status='$ativo'
                WHERE idtb_pessoal_ti='$idtb_pessoal_ti'";
            }

            else{
                
                $hash = sha1(md5($senha));
                $salt = sha1(md5($usuario));
                $senha = $salt.$hash;

                $sql = "UPDATE db_clti.tb_pessoal_ti SET
                    idtb_om_apoiadas='$omapoiada',idtb_posto_grad='$postograd', idtb_corpo_quadro='$corpoquadro', 
                    idtb_especialidade='$especialidade', nip='$nip', cpf='$cpf', nome='$nome', 
                    nome_guerra='$nomeguerra', senha='$senha', correio_eletronico='$correio_eletronico',
                    funcao='$funcao', status='$ativo'
                    WHERE idtb_pessoal_ti='$idtb_pessoal_ti'";
            }


            $pg->exec($sql);

            if ($pg) {
                echo "<h5>Resgistros incluídos no banco de dados.</h5>
                <meta http-equiv=\"refresh\" content=\"1;?cmd=pessoalti \">";
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

                $sql = "INSERT INTO db_clti.tb_pessoal_ti(
                    idtb_om_apoiadas,idtb_posto_grad, idtb_corpo_quadro, idtb_especialidade, nip, 
                    cpf, nome, nome_guerra, senha, correio_eletronico, funcao, status)
                    VALUES ('$omapoiada', '$postograd', '$corpoquadro', '$especialidade',
                    '$nip', '$cpf', '$nome', '$nomeguerra', '$senha', '$correio_eletronico',
                    '$funcao', 'ATIVO')";

                $pg->exec($sql);

                if ($pg) {
                    echo "<h5>Resgistros incluídos no banco de dados.</h5>
                    <meta http-equiv=\"refresh\" content=\"1;?cmd=pessoalti\">";
                }

                else {
                    echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
                    echo(pg_result_error($pg) . "<br />\n");
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