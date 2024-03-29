<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/** Leitura de parâmetros */
$oa = $cmd = $param = $act = $senha = NULL;
$status = 'ATIVO';

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

if (isset($_GET['status'])){
    $param = $_GET['status'];
  }

if (isset($_GET['senha'])){
  $senha = $_GET['senha'];
}

/* Classe de interação com o PostgreSQL */
require_once "../class/constantes.inc.php";
include_once("../class/queries.inc.php");
$acesso = new Principal();
$om = new OMAPoiadas();
$pti = new PessoalTI();
$config = new Config();
$mil = new Militar();

/* Recupera informações dos Admin */
$row = $pti->SelectAllPesTI();

/* Checa Informações */
if (($row == NULL) AND ($act == NULL)) {
	echo "<h5>Não há Pessoal de TI cadastrado,<br />
		 clique <a href=\"?cmd=pessoalti&act=cad\">aqui</a> para fazê-lo.</h5>";
}

/* Carrega form para cadastro */
if ($act == 'cad') {
    if ($param){
        $pti->idtb_pessoal_ti = $param;
        $pti->idtb_om_apoiadas = $oa;
        $pessti = $pti->SelectIdPesTI($status);
    }
    else{
        $pessti = (object)['idtb_pessoal_ti'=>'','nip'=>'','cpf'=>'','nome'=>'','nome_guerra'=>'',
            'idtb_om_apoiadas'=>'','sigla_om'=>'','idtb_posto_grad'=>'8','sigla_posto_grad'=>'Primeiro Tenente',
            'idtb_corpo_quadro'=>'','sigla_corpo_quadro'=>'','idtb_especialidade'=>'','sigla_espec'=>'',
            'idtb_funcoes_ti'=>'','sigla_funcao'=>'','correio_eletronico'=>''];
    }
    $om->ordena = "ORDER BY sigla ASC";
	$omapoiada = $om->SelectAllOMTable();
    $postograd = $mil->SelectAllPostoGrad();
    $corpoquadro = $mil->SelectAllCorpoQuadro();
    $especialidade = $mil->SelectAllEspec();
    $funcoesti = $pti->SelectOutrasFuncoesTI();
    $idtb_om_apoiadas = $_SESSION['id_om_apoiada'];

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
                                    <legend>Pessoal de TI - Troca de Senha</legend>
                                    <input id=\"idtb_om_apoiadas\" class=\"form-control\" name=\"idtb_om_apoiadas\"
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
                                        hidden=\"required\" value=\"$pessti->idtb_funcoes_ti\" autocomplete=\"off\">
                                    <div class=\"form-group\">
                                        <label for=\"nip\">NIP:</label>
                                        <input id=\"nip\" class=\"form-control\" type=\"text\" name=\"nip\" readonly=\"true\"
                                            placeholder=\"NIP\" maxlength=\"8\" required=\"true\" value=\"$pessti->nip\" autocomplete=\"off\">
                                    </div>
                                    <div class=\"form-group\">
                                        <label for=\"cpf\">CPF (Servidores Civis):</label>
                                        <input id=\"cpf\" class=\"form-control\" type=\"text\" name=\"cpf\" readonly=\"true\"
                                            placeholder=\"CPF (Servidores Civis)\" maxlength=\"11\" value=\"$pessti->cpf\" autocomplete=\"off\">
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
                                    <legend>Pessoal de TI - Alteração</legend>
                                    <input type=\"hidden\" name=\"idtb_om_apoiadas\" value=\"$idtb_om_apoiadas\">
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
                                            placeholder=\"Nome Completo\" minlength=\"2\" autocomplete=\"off\"
                                            style=\"text-transform:uppercase\" required=\"true\" value=\"$pessti->nome\">
                                    </div>
                                    <div class=\"form-group\">
                                        <label for=\"nomeguerra\">Nome de Guerra:</label>
                                        <input id=\"nomeguerra\" class=\"form-control\" type=\"text\" name=\"nomeguerra\"
                                            placeholder=\"Nome de Guerra\" minlength=\"2\" autocomplete=\"off\"
                                            style=\"text-transform:uppercase\" required=\"true\" value=\"$pessti->nome_guerra\">
                                    </div>
                                    <div class=\"form-group\">
                                        <label for=\"nip\">NIP:</label>
                                        <input id=\"nip\" class=\"form-control\" type=\"text\" name=\"nip\" readonly=\"true\"
                                            placeholder=\"NIP\" maxlength=\"8\" required=\"true\" value=\"$pessti->nip\" autocomplete=\"off\">
                                    </div>
                                    <div class=\"form-group\">
                                        <label for=\"cpf\">CPF (Servidores Civis):</label>
                                        <input id=\"cpf\" class=\"form-control\" type=\"text\" name=\"cpf\" readonly=\"true\"
                                            placeholder=\"CPF (Servidores Civis)\" maxlength=\"11\" value=\"$pessti->cpf\" autocomplete=\"off\">
                                    </div>
                                    <div class=\"form-group\">
                                        <label for=\"correio_eletronico\">Correio Eletrônico:</label>
                                        <input id=\"correio_eletronico\" class=\"form-control\" type=\"email\" autocomplete=\"off\"
                                            name=\"correio_eletronico\" placeholder=\"Preferencialmente Zimbra\" 
                                            minlength=\"2\" style=\"text-transform:uppercase\" required=\"true\" 
                                            value=\"$pessti->correio_eletronico\">
                                    </div>
                                    <div class=\"form-group\">
                                        <label for=\"funcaoti\">Função de TI:</label>
                                        <select id=\"funcaoti\" class=\"form-control\" name=\"funcaoti\">
                                            <option value=\"$pessti->idtb_funcoes_ti\" selected=\"true\">
                                                $pessti->desc_funcao</option>";
                                            foreach ($funcoesti as $key => $value) {
                                                echo"<option value=\"".$value->idtb_funcoes_ti."\">
                                                    ".$value->descricao."</option>";
                                            };
                                        echo "</select>
                                    </div>
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
                            <legend>Pessoal de TI - Cadastro</legend>
                            
                            <input type=\"hidden\" name=\"idtb_om_apoiadas\" value=\"$idtb_om_apoiadas\">

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
                                <input id=\"nip\" class=\"form-control\" type=\"text\" name=\"nip\" autocomplete=\"off\"
                                       placeholder=\"NIP\" maxlength=\"8\" required=\"true\" value=\"$pessti->nip\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"cpf\">CPF (Servidores Civis):</label>
                                <input id=\"cpf\" class=\"form-control\" type=\"text\" name=\"cpf\" autocomplete=\"off\"
                                       placeholder=\"CPF (Servidores Civis)\" maxlength=\"11\" value=\"$pessti->cpf\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"nome\">Nome Completo:</label>
                                <input id=\"nome\" class=\"form-control\" type=\"text\" name=\"nome\"
                                    placeholder=\"Nome Completo\" minlength=\"2\" autocomplete=\"off\"
                                    style=\"text-transform:uppercase\" required=\"true\" value=\"$pessti->nome\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"nomeguerra\">Nome de Guerra:</label>
                                <input id=\"nomeguerra\" class=\"form-control\" type=\"text\" name=\"nomeguerra\"
                                    placeholder=\"Nome de Guerra\" minlength=\"2\" autocomplete=\"off\"
                                    style=\"text-transform:uppercase\" required=\"true\" value=\"$pessti->nome_guerra\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"correio_eletronico\">Correio Eletrônico:</label>
                                <input id=\"correio_eletronico\" class=\"form-control\" type=\"email\" name=\"correio_eletronico\"
                                    placeholder=\"Preferencialmente Zimbra\" minlength=\"2\" autocomplete=\"off\"
                                    required=\"true\" value=\"$pessti->correio_eletronico\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"funcaoti\">Função de TI:</label>
                                <select id=\"funcaoti\" class=\"form-control\" name=\"funcaoti\">
                                    <option value=\"$pessti->idtb_funcoes_ti\" selected=\"true\">
                                        $pessti->sigla_funcao</option>";
                                    foreach ($funcoesti as $key => $value) {
                                        echo"<option value=\"".$value->idtb_funcoes_ti."\">
                                            ".$value->descricao."</option>";
                                    };
                                echo "</select>
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

/* Monta quadro */
if (($row) AND ($act == NULL)) {
    $pti->ordena = "ORDER BY idtb_posto_grad ASC";
    $pti->idtb_om_apoiadas = $_SESSION['id_om_apoiada'];
    $pessti = $pti->SelectIdOMPesTI();
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
    foreach ($pessti as $key => $value) {
        #Seleciona NIP caso seja militar da MB
        if ($value->nip != NULL) {
            $identificacao = $pti->FormatNIP($value->nip);
        }
        else{
            $identificacao = $pti->FormatCPF($value->cpf);
        }
        echo"       <tr>";
        if (($value->exibir_espec == 'NÃO') AND ($value->exibir_corpo_quadro == 'NÃO')){
            echo"       <th scope=\"row\">".$value->sigla_posto_grad."</th>";
        }
        elseif (($value->exibir_espec == 'NÃO') AND ($value->exibir_corpo_quadro != 'NÃO')){
            echo"       <th scope=\"row\">".$value->sigla_posto_grad." ".$value->sigla_corpo_quadro."</th>";
        }
        elseif (($value->exibir_espec != 'NÃO') AND ($value->exibir_corpo_quadro == 'NÃO')){
            echo"       <th scope=\"row\">".$value->sigla_posto_grad." ".$value->sigla_espec."</th>";
        }
        else {
            echo"       <th scope=\"row\">".$value->sigla_posto_grad." ".$value->sigla_corpo_quadro." 
                            ".$value->sigla_espec."</th>";
        }
            echo"
                        <td>".$identificacao."</td>
                        <td>".$value->nome."</td>
                        <td>".$value->nome_guerra."</td>
                        <td>".$value->sigla_funcao."</td>
                        <td><a href=\"?cmd=pessoalti&act=qrcode&param=".$value->idtb_pessoal_ti."\">2FA</a> - 
                            <a href=\"?cmd=pessoalti&act=cad&param=".$value->idtb_pessoal_ti."&oa=".$value->idtb_om_apoiadas."\">Editar</a> - 
                            <a href=\"?cmd=pessoalti&act=cad&param=".$value->idtb_pessoal_ti."&oa=".$value->idtb_om_apoiadas."&senha=troca\">Senha</a> ";
                        if (($value->sigla_funcao != 'OSIC') && ($value->sigla_funcao != 'ADMIN')){
                            echo " - <a href=\"?cmd=pessoalti&act=del&param=".$value->idtb_pessoal_ti."&oa=".$value->idtb_om_apoiadas."\">Excluir</a>";
                        }
                    echo"        
                    </tr>";
    }
            echo"
                </tbody>
            </table>
            </div>";
}

/* Monta quadro de Pessoal de TI para exclusão */
if ($act == 'del') {

	$pti->idtb_pessoal_ti = $param;
    $pti->idtb_om_apoiadas = $oa;
    $pessti = $pti->SelectIdPesTI($status);

    echo"<div class=\"table-responsive\">
        <div class=\"alert alert-danger\" role=\"alert\">Atenção, todos os registros deste Usuário,
            bem como dados relacionados, serão excluídos!</div>
            <table class=\"table table-hover\">
                <thead>
                    <tr>
                        <th scope=\"col\">OM Apoiada</th>
                        <th scope=\"col\">Posto/Grad./Esp.</th>
                        <th scope=\"col\">NIP/CPF</th>
                        <th scope=\"col\">Nome</th>
                        <th scope=\"col\">Nome de Guerra</th>
                        <th scope=\"col\">Ações</th>
                    </tr>
                </thead>";

        #Seleciona NIP caso seja militar da MB
        if ($pessti->nip != NULL) {
            $identificacao = $pti->FormatNIP($pessti->nip);
        }
        else{
            $identificacao = $pti->FormatCPF($pessti->cpf);
        }
        echo"       <tr>
                        <td>".$pessti->sigla_om."</td>";
        if (($pessti->exibir_espec == 'NÃO') AND ($pessti->exibir_corpo_quadro == 'NÃO')){
            echo"       <th scope=\"row\">".$pessti->sigla_posto_grad."</th>";
        }
        elseif (($pessti->exibir_espec == 'NÃO') AND ($pessti->exibir_corpo_quadro != 'NÃO')){
            echo"       <th scope=\"row\">".$pessti->sigla_posto_grad." ".$pessti->sigla_corpo_quadro."</th>";
        }
        elseif (($pessti->exibir_espec != 'NÃO') AND ($pessti->exibir_corpo_quadro == 'NÃO')){
            echo"       <th scope=\"row\">".$pessti->sigla_posto_grad." ".$pessti->sigla_espec."</th>";
        }
        else {
            echo"       <th scope=\"row\">".$pessti->sigla_posto_grad." ".$pessti->sigla_corpo_quadro." 
                            ".$pessti->sigla_espec."</th>";
        }
            echo"
                        <td>".$identificacao."</td>
                        <td>".$pessti->nome."</td>
                        <td>".$pessti->nome_guerra."</td>
                        <td><a href=\"?cmd=pessoalti&act=conf_del&param=".$pessti->idtb_pessoal_ti."&oa=".$pessti->idtb_om_apoiadas."\">Confirmar Exclusão</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>";
}

/** Excluir Definitivamente Pessoal de TI */
if ($act == 'conf_del') {
    $pti->idtb_om_apoiadas = $oa;
    $pti->idtb_pessoal_ti = $param;
    $row = $pti->DeletePesTI();
    if ($row) {
        echo "<h5>Resgistros excluídos do banco de dados.</h5>
        <meta http-equiv=\"refresh\" content=\"1;url=?cmd=pessoalti\">";
    }
    else {
        echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
    }
}

/* Método INSERT/UPDATE */
if ($act == 'insert') {
    if (isset($_SESSION['status'])){
        $idtb_pessoal_ti = $_POST['idtb_pessoal_ti'];
        $pti->idtb_pessoal_ti = $idtb_pessoal_ti;
        $pti->idtb_om_apoiadas = $_POST['idtb_om_apoiadas'];
        $pti->idtb_posto_grad = $_POST['postograd'];
        $pti->idtb_corpo_quadro = $_POST['corpoquadro'];
        $pti->idtb_especialidade = $_POST['especialidade'];
        $nip = $_POST['nip'];
        $pti->nip = $_POST['nip'];
        $pti->cpf = $_POST['cpf'];
        $cpf = $_POST['cpf'];
        $pti->nome = mb_strtoupper($_POST['nome'],'UTF-8');
        $pti->nome_guerra = mb_strtoupper($_POST['nomeguerra'],'UTF-8');
        $pti->correio_eletronico = mb_strtoupper($_POST['correio_eletronico'],'UTF-8');
        $pti->idtb_funcoes_ti = mb_strtoupper($_POST['funcaoti'],'UTF-8');
        $pti->status = mb_strtoupper($_POST['ativo'],'UTF-8');
        if ($nip == NULL) {
            $usuario = $cpf;
        }
        else {
            $usuario = $nip;
        }
        $pti->usuario = $usuario;

        /* Opta pelo Método Update */
        if ($idtb_pessoal_ti){
            if (isset($_POST['senha'])){
                $senha = $_POST['senha'];
            }            
            if($senha==NULL){
                $row = $pti->UpdatePesTI();
                if ($row) {
                    echo "<h5>Resgistros incluídos no banco de dados.</h5>
                    <meta http-equiv=\"refresh\" content=\"1;?cmd=pessoalti \">";
                }    
                else {
                    echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
                    echo(pg_result_error($row) . "<br />\n");
                }
            }
            else{
                $acesso->var1 = $usuario;
                $acesso->var2 = $senha;
                $var = $acesso->Executa();
                if ($var){
                    $pti->senha = $var->var5;
                }
                $row = $pti->UpdateSenhaPesti();
                if ($row) {
                    $user = new Usuario();
                    $user->iduser = $row;
                    $pwd = $user->SetVencSenha(5);
                    echo "<h5>Resgistros incluídos no banco de dados.</h5>
                    <meta http-equiv=\"refresh\" content=\"1;?cmd=pessoalti \">";
                }    
                else {
                    echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
                    echo(pg_result_error($row) . "<br />\n");
                }
            }
        }        
        else{
            /* Checa se há Admin com mesmo login cadastrado */
            $row = $pti->ChecaNIPCPF();
            if ($row) {
                echo "<h5>Já existe um Admin cadastrado com esse NIP/CPF.</h5>";
            }
            $row = $pti->ChecaCorreio();
            if ($row) {
                echo "<h5>Já existe um Admin cadastrado com esse Correio Eletrônico.</h5>";
            }
            else {
                $senha = $_POST['senha'];
                $acesso->var1 = $usuario;
                $acesso->var2 = $senha;
                $var = $acesso->Executa();
                if ($var){
                    $pti->senha = $var->var5;
                }
                $row = $pti->InsertPesTI();
                if ($row) {
                    $user = new Usuario();
                    $user->iduser = $row;
                    $pwd = $user->SetVencSenha(5);
                    echo "<h5>Resgistros incluídos no banco de dados.</h5>
                    <meta http-equiv=\"refresh\" content=\"1;?cmd=pessoalti\">";
                }
                else {
                    echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
                    echo(pg_result_error($row) . "<br />\n");
                }
            }
        }
    }
    else{
        echo "<h5>Ocorreu algum erro, usuário não autenticado.</h5>
            <meta http-equiv=\"refresh\" content=\"1;$url\">";
    }
}

if ($act == 'qrcode') {
    if (isset($_SESSION['status'])){        
        require_once "../class/authenticator.inc.php";
        require_once "../phpqrcode/qrlib.php";

        $authenticator = new GoogleAuthenticator();
        $secret = $authenticator->createSecret();

        $pti->idtb_pessoal_ti = $param;
        $pti->secret = $secret;
        $usuario = $pti->SelectIdPesTI($status);
                
        $sistema = 'SiGTI';
        $nip = $usuario->nip;
        $cpf = $usuario->cpf;
        if ($nip){
            $usuario= $usuario->nip;
        }
        elseif ($cpf){
            $usuario= $usuario->cpf;
        }
        

        $data = "otpauth://totp/$usuario?secret=$secret&issuer=$sistema";
        $file = "../tmp/$secret.png";

        QRcode::png($data,$file);

        $row = $pti->PesTIQRCode();
            if ($row) {
                echo "\n\n
                <img src=\"../tmp/$secret.png\" alt=\"QR Code\" />\n\n
                <h4>Use o QR Code acima no Authenticator.</h3>\n\n
                <h3>Guarde esta chave em local seguro: $secret </h3>";
                #unlink($file);
            }
            else {
                echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
                echo(pg_result_error($row) . "<br />\n");
            }
    }
    else{
        echo "<h5>Ocorreu algum erro, usuário não autenticado.</h5>
            <meta http-equiv=\"refresh\" content=\"1;$url\">";
    }
}

if ($act == 'ativar') {
    if (isset($_SESSION['status'])){
        $pesti->idtb_pessoal_ti = $param;
        $row = $pesti->PesTIAtivar();
            if ($row) {
                echo "<h5>Resgistros incluídos no banco de dados.</h5>
                <meta http-equiv=\"refresh\" content=\"1;url=?cmd=admin\">";
            }
            else {
                echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
                echo(pg_result_error($row) . "<br />\n");
            }
    }
    else{
        echo "<h5>Ocorreu algum erro, usuário não autenticado.</h5>
            <meta http-equiv=\"refresh\" content=\"1;$url\">";
    }
}

if ($act == 'desativar') {
    if (isset($_SESSION['status'])){
        $pesti->idtb_pessoal_ti = $param;
        $row = $pesti->PesTIDesativar();
            if ($row) {
                echo "<h5>Resgistros incluídos no banco de dados.</h5>
                <meta http-equiv=\"refresh\" content=\"1;url=?cmd=admin\">";
            }
            else {
                echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
                echo(pg_result_error($row) . "<br />\n");
            }
    }
    else{
        echo "<h5>Ocorreu algum erro, usuário não autenticado.</h5>
            <meta http-equiv=\"refresh\" content=\"1;$url\">";
    }
}

?>