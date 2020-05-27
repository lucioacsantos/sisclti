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
    echo "<h5>Não há OSIC cadastrados, <br />
        clique <a href=\"?cmd=osic&act=cad\">aqui</a> para fazê-lo.</h5>";
}

/* Carrega form para cadastro de OSIC */
if ($act == 'cad') {
    @$param = $_GET['param'];
    @$senha = $_GET['senha'];
    if ($param){
        $osic = $pg->getRow("SELECT * FROM db_clti.tb_osic WHERE idtb_osic = '$param'");
        $osic_om = $pg->getRow("SELECT idtb_om_apoiadas,sigla FROM db_clti.tb_om_apoiadas 
            WHERE idtb_om_apoiadas = '$osic->id_om'");
        $osic_posto_grad = $pg->getRow("SELECT idtb_posto_grad,sigla FROM db_clti.tb_posto_grad 
            WHERE idtb_posto_grad = '$osic->id_posto_grad'");
        $osic_corpo_quadro = $pg->getRow("SELECT idtb_corpo_quadro,sigla FROM db_clti.tb_corpo_quadro 
            WHERE idtb_corpo_quadro = '$osic->id_corpo_quadro'");
        $osic_especialidade = $pg->getRow("SELECT idtb_especialidade,sigla FROM db_clti.tb_especialidade 
            WHERE idtb_especialidade = '$osic->id_especialidade'");
    }
    else{
        $osic = (object)['idtb_osic'=>'','nip'=>'','cpf'=>'','nome'=>'','nome_guerra'=>''];
        $osic_om = (object)['idtb_om_apoiadas'=>'','sigla'=>''];
        $osic_posto_grad = (object)['idtb_posto_grad'=>'8','sigla'=>'1ºTen'];
        $osic_corpo_quadro = (object)['idtb_corpo_quadro'=>'','sigla'=>''];
        $osic_especialidade = (object)['idtb_especialidade'=>'','sigla'=>''];
    }

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
                        <fieldset>";
                            #Prepara formulário para atualização de dados
                            if ($param){
                                if ($senha){
                                    echo"
                                    <legend>OSIC - Troca de Senha</legend>
                                    <input id=\"omapoiada\" class=\"form-control\" name=\"omapoiada\"
                                        value=\"$osic_om->idtb_om_apoiadas\" hidden=\"true\">
                                    <input id=\"postograd\" class=\"form-control\" name=\"postograd\"
                                        value=\"$osic_posto_grad->idtb_posto_grad\" hidden=\"true\">
                                    <input id=\"corpoquadro\" class=\"form-control\" name=\"corpoquadro\"
                                        value=\"$osic_corpo_quadro->idtb_corpo_quadro\" hidden=\"true\">
                                    <input id=\"especialidade\" class=\"form-control\" name=\"especialidade\"
                                        value=\"$osic_especialidade->idtb_especialidade\" hidden=\"true\">
                                    <input id=\"nome\" class=\"form-control\" type=\"text\" name=\"nome\"
                                        hidden=\"required\" value=\"$osic->nome\">
                                    <input id=\"nomeguerra\" class=\"form-control\" type=\"text\" name=\"nomeguerra\"
                                        hidden=\"required\" value=\"$osic->nome_guerra\">
                                    <input id=\"nomeguerra\" class=\"form-control\" type=\"text\" name=\"nomeguerra\"
                                        hidden=\"required\" value=\"$admin->correio_eletronico\">
                                    
                                    <div class=\"form-group\">
                                        <label for=\"nip\">NIP:</label>
                                        <input id=\"nip\" class=\"form-control\" type=\"text\" name=\"nip\" readonly=\"true\"
                                            placeholder=\"NIP\" maxlength=\"8\" required=\"true\" value=\"$osic->nip\">
                                    </div>

                                    <div class=\"form-group\">
                                        <label for=\"cpf\">CPF (Servidores Civis):</label>
                                        <input id=\"cpf\" class=\"form-control\" type=\"text\" name=\"cpf\" readonly=\"true\"
                                            placeholder=\"CPF (Servidores Civis)\" maxlength=\"11\" value=\"$osic->cpf\">
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
                                #Em caso de alteração de outros dados
                                else{
                                    echo"
                                    <legend>OSIC - Modificação</legend>

                                    <div class=\"form-group\">
                                        <label for=\"omapoiada\">OM Apoiada:</label>
                                        <select id=\"omapoiada\" class=\"form-control\" name=\"omapoiada\">
                                            <option value=\"$osic_om->idtb_om_apoiadas\" selected=\"true\">
                                                $osic_om->sigla</option>";
                                            foreach ($omapoiada as $key => $value) {
                                                echo"<option value=\"".$value->idtb_om_apoiadas."\">
                                                    ".$value->sigla."</option>";
                                            };
                                        echo "</select>
                                    </div>

                                    <div class=\"form-group\">
                                        <label for=\"postograd\">Posto/Graduação:</label>
                                        <select id=\"postograd\" class=\"form-control\" name=\"postograd\">
                                            <option value=\"$osic_posto_grad->idtb_posto_grad\" selected=\"true\">
                                                $osic_posto_grad->sigla</option>";
                                            foreach ($postograd as $key => $value) {
                                                echo"<option value=\"".$value->idtb_posto_grad."\">
                                                    ".$value->nome."</option>";
                                            };
                                        echo "</select>
                                    </div>

                                    <div class=\"form-group\">
                                        <label for=\"corpoquadro\">Corpo/Quadro:</label>
                                        <select id=\"corpoquadro\" class=\"form-control\" name=\"corpoquadro\">
                                            <option value=\"$osic_corpo_quadro->idtb_corpo_quadro\" selected=\"true\">
                                                $osic_corpo_quadro->sigla</option>";
                                            foreach ($corpoquadro as $key => $value) {
                                                echo"<option value=\"".$value->idtb_corpo_quadro."\">
                                                    ".$value->nome."</option>";
                                            };
                                        echo "</select>
                                    </div>

                                    <div class=\"form-group\">
                                        <label for=\"especialidade\">Especialidade:</label>
                                        <select id=\"especialidade\" class=\"form-control\" name=\"especialidade\">
                                            <option value=\"$osic_especialidade->idtb_especialidade\" selected=\"true\">
                                                $osic_especialidade->sigla</option>";
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
                                            style=\"text-transform:uppercase\" required=\"true\" value=\"$osic->nome\">
                                    </div>

                                    <div class=\"form-group\">
                                        <label for=\"nomeguerra\">Nome de Guerra:</label>
                                        <input id=\"nomeguerra\" class=\"form-control\" type=\"text\" name=\"nomeguerra\"
                                            placeholder=\"Nome de Guerra\" minlength=\"2\"
                                            style=\"text-transform:uppercase\" required=\"true\" value=\"$osic->nome_guerra\">
                                    </div>

                                    <div class=\"form-group\">
                                        <label for=\"correioeletronico\">Correio Eletrônico:</label>
                                        <input id=\"correioeletronico\" class=\"form-control\" type=\"email\" 
                                            name=\"correioeletronico\" placeholder=\"Preferencialmente Zimbra\" 
                                            minlength=\"2\" style=\"text-transform:uppercase\" required=\"true\" 
                                            value=\"$osic->correio_eletronico\">
                                    </div>
                                    
                                    <div class=\"form-group\">
                                        <label for=\"nip\">NIP:</label>
                                        <input id=\"nip\" class=\"form-control\" type=\"text\" name=\"nip\" readonly=\"true\"
                                            placeholder=\"NIP\" maxlength=\"8\" required=\"true\" value=\"$osic->nip\">
                                    </div>

                                    <div class=\"form-group\">
                                        <label for=\"cpf\">CPF (Servidores Civis):</label>
                                        <input id=\"cpf\" class=\"form-control\" type=\"text\" name=\"cpf\" readonly=\"true\"
                                            placeholder=\"CPF (Servidores Civis)\" maxlength=\"11\" value=\"$osic->cpf\">
                                    </div>



                                    <input id=\"senha\" class=\"form-control\" type=\"password\" name=\"senha\"
                                        value=\"\" hidden=\"true\">
                                    <input id=\"confirmasenha\" class=\"form-control\" type=\"password\" name=\"confirmasenha\"
                                        value=\"\" hidden=\"true\">

                                    <div class=\"form-group\">
                                        <label for=\"ativo\" class=\"control-label\">Situação:</label>
                                            <select id=\"ativo\" class=\"form-control\" name=\"ativo\">
                                                <option value=\"$osic->status\" selected=\"true\">$osic->status</option>
                                                <option value=\"ATIVO\">ATIVO</option>
                                                <option value=\"INATIVO\">INATIVO</option>
                                            <div class=\"help-block with-errors\"></div>
                                    </div>";
                                }
                            }
                            #Prepara formulário para inclusão
                            else{
                            echo"
                            <div class=\"form-group\">
                                <label for=\"omapoiada\">OM Apoiada:</label>
                                <select id=\"omapoiada\" class=\"form-control\" name=\"omapoiada\">
                                    <option value=\"$osic_om->idtb_om_apoiadas\" selected=\"true\">
                                        $osic_om->sigla</option>";
                                    foreach ($omapoiada as $key => $value) {
                                        echo"<option value=\"".$value->idtb_om_apoiadas."\">
                                            ".$value->sigla."</option>";
                                    };
                                echo "</select>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"postograd\">Posto/Graduação:</label>
                                <select id=\"postograd\" class=\"form-control\" name=\"postograd\">
                                    <option value=\"$osic_posto_grad->idtb_posto_grad\" selected=\"true\">
                                        $osic_posto_grad->sigla</option>";
                                    foreach ($postograd as $key => $value) {
                                        echo"<option value=\"".$value->idtb_posto_grad."\">
                                            ".$value->nome."</option>";
                                    };
                                echo "</select>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"corpoquadro\">Corpo/Quadro:</label>
                                <select id=\"corpoquadro\" class=\"form-control\" name=\"corpoquadro\">
                                    <option value=\"$osic_corpo_quadro->idtb_corpo_quadro\" selected=\"true\">
                                        $osic_corpo_quadro->sigla</option>";
                                    foreach ($corpoquadro as $key => $value) {
                                        echo"<option value=\"".$value->idtb_corpo_quadro."\">
                                            ".$value->nome."</option>";
                                    };
                                echo "</select>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"especialidade\">Especialidade:</label>
                                <select id=\"especialidade\" class=\"form-control\" name=\"especialidade\">
                                    <option value=\"$osic_especialidade->idtb_especialidade\" selected=\"true\">
                                        $osic_especialidade->sigla</option>";
                                    foreach ($especialidade as $key => $value) {
                                        echo"<option value=\"".$value->idtb_especialidade."\">
                                            ".$value->nome."</option>";
                                    };
                                echo "</select>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"nip\">NIP:</label>
                                <input id=\"nip\" class=\"form-control\" type=\"text\" name=\"nip\" 
                                       placeholder=\"NIP\" maxlength=\"8\" required=\"true\" value=\"$osic->nip\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"cpf\">CPF (Servidores Civis):</label>
                                <input id=\"cpf\" class=\"form-control\" type=\"text\" name=\"cpf\" 
                                       placeholder=\"CPF (Servidores Civis)\" maxlength=\"11\" value=\"$osic->cpf\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"nome\">Nome Completo:</label>
                                <input id=\"nome\" class=\"form-control\" type=\"text\" name=\"nome\"
                                    placeholder=\"Nome Completo\" minlength=\"2\" 
                                    style=\"text-transform:uppercase\" required=\"true\" value=\"$osic->nome\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"nomeguerra\">Nome de Guerra:</label>
                                <input id=\"nomeguerra\" class=\"form-control\" type=\"text\" name=\"nomeguerra\"
                                    placeholder=\"Nome de Guerra\" minlength=\"2\"
                                    style=\"text-transform:uppercase\" required=\"true\" value=\"$osic->nome_guerra\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"correioe_letronico\">Correio Eletrônico:</label>
                                <input id=\"correioel_etronico\" class=\"form-control\" type=\"email\" name=\"correioel_etronico\"
                                    placeholder=\"Preferencialmente Zimbra\" minlength=\"2\"
                                    style=\"text-transform:uppercase\" required=\"true\" value=\"$admin->correio_eletronico\">
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
                        <input id=\"idtb_osic\" type=\"hidden\" name=\"idtb_osic\" value=\"$osic->idtb_osic\">
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
                        <td><a href=\"?cmd=osic&act=cad&param=".$value->idtb_osic."\">Editar</a> - 
                            <a href=\"?cmd=osic&act=cad&param=".$value->idtb_osic."&senha=troca\">Senha</a> - 
                            Excluir</td>
                    </tr>";
    }
    echo"
                </tbody>
            </table>
            </div>";
}

/* Método INSERT / UPDATE */
if ($act == 'insert') {
    if (isset($_SESSION['status'])){
        $idtb_osic = $_POST['idtb_osic'];
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
        if ($idtb_osic){
            $senha = $_POST['senha'];

            if($senha==NULL){
                $sql = "UPDATE db_clti.tb_osic SET
                id_om='$omapoiada',id_posto_grad='$postograd', id_corpo_quadro='$corpoquadro', 
                id_especialidade='$especialidade', nip='$nip', cpf='$cpf', nome='$nome', 
                nome_guerra='$nomeguerra', status='$ativo'
                WHERE idtb_osic='$idtb_osic'";
            }

            else{
                
                $hash = sha1(md5($senha));
                $salt = sha1(md5($usuario));
                $senha = $salt.$hash;

                $sql = "UPDATE db_clti.tb_osic SET
                    id_om='$omapoiada',id_posto_grad='$postograd', id_corpo_quadro='$corpoquadro', 
                    id_especialidade='$especialidade', nip='$nip', cpf='$cpf', nome='$nome', nome_guerra='$nomeguerra', 
                    senha='$senha', status='$ativo'
                    WHERE idtb_osic='$idtb_osic'";
            }

            $pg->exec($sql);

            if ($pg) {
                echo "<h5>Resgistros incluídos no banco de dados.</h5>
                <meta http-equiv=\"refresh\" content=\"1;url=?cmd=osic\">";
            }

            else {
                echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
                echo(pg_result_error($pg) . "<br />\n");
            }
        }

        /* Opta pelo Método Insert */
        else{
            /* Checa se há OSIC com mesmo login cadastrado */

            $sql = "SELECT * FROM db_clti.tb_osic WHERE nip = '$usuario' OR cpf = '$usuario' ";
            $row = $pg->getRow($sql);
            
            if ($row) {
                echo "<h5>Já existe um Admin cadastrado com esse NIP/CPF.</h5>";
            }

            else {

                $senha = $_POST['senha'];
                $hash = sha1(md5($senha));
                $salt = sha1(md5($usuario));
                $senha = $salt.$hash;

                $sql = "INSERT INTO db_clti.tb_osic(
                    id_om,id_posto_grad, id_corpo_quadro, id_especialidade, 
                    nip, cpf, nome, nome_guerra, senha, perfil, status)
                    VALUES ('$omapoiada', '$postograd', '$corpoquadro', '$especialidade',
                    '$nip', '$cpf', '$nome', '$nomeguerra', '$senha', 'OSIC_OM', 'ATIVO')";

                $pg->exec($sql);

                if ($pg) {
                    echo "<h5>Resgistros incluídos no banco de dados.</h5>
                    <meta http-equiv=\"refresh\" content=\"1;url=?cmd=osic\">";
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