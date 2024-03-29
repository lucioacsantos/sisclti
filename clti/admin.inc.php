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
    $status = $_GET['status'];
  }

if (isset($_GET['senha'])){
  $senha = $_GET['senha'];
}

/* Classe de interação com o PostgreSQL */
require_once "../class/constantes.inc.php";
$om = new OMAPoiadas();
$pesti = new PessoalTI();
$mil = new Militar();
$usr = new Usuario();

/* Recupera informações */
$row = $pesti->SelectALLAdmin();

/* Checa se há Admin cadastrado */
if (($row == NULL) AND ($act == NULL)) {
	echo "<h5>Não há Administradores cadastrados,<br />
		 clique <a href=\"?cmd=admin&act=cad\">aqui</a> para fazê-lo.</h5>";
}

/* Carrega form para cadastro/atleração de Admin com objeto do banco ou vazio*/
if ($act == 'cad') {
    if ($param){
        $pesti->idtb_pessoal_ti = $param;
        $pesti->idtb_om_apoiadas = $oa;
        $admin = $pesti->SelectIdPesTI($status);
    }
    else{
        $admin = (object)['idtb_pessoal_ti'=>'','nip'=>'','cpf'=>'','nome'=>'','nome_guerra'=>'',
            'idtb_om_apoiadas'=>'','sigla_om'=>'','idtb_posto_grad'=>'8','sigla_posto_grad'=>'Primeiro Tenente',
            'idtb_corpo_quadro'=>'','sigla_corpo_quadro'=>'','idtb_especialidade'=>'','sigla_espec'=>'',
            'correio_eletronico'=>''];
    }
    $om->ordena = "ORDER BY sigla ASC";
	$omapoiada = $om->SelectAllOMTable();
    $postograd = $mil->SelectAllPostoGrad();
    $corpoquadro = $mil->SelectAllCorpoQuadro();
    $mil->ordena = "ORDER BY sigla ASC";
    $especialidade = $mil->SelectAllEspec();
    echo "
	<div class=\"container-fluid\">
        <div class=\"row\">
            <main>
                <div id=\"form-cadastro\">
                    <form id=\"insereusuario\" role=\"form\" action=\"?cmd=admin&act=insert\" 
                        method=\"post\" enctype=\"multipart/form-data\">
                        <fieldset>";
                            /** Prepara formulário para troca de senhas */
                            if ($param){
                                if ($senha){
                                    echo"
                                    <legend>Administradores de Rede - Troca de Senha</legend>
                                    <input id=\"omapoiada\" class=\"form-control\" name=\"omapoiada\"
                                        value=\"$admin->idtb_om_apoiadas\" hidden=\"true\">
                                    <input id=\"postograd\" class=\"form-control\" name=\"postograd\"
                                        value=\"$admin->idtb_posto_grad\" hidden=\"true\">
                                    <input id=\"corpoquadro\" class=\"form-control\" name=\"corpoquadro\"
                                        value=\"$admin->idtb_corpo_quadro\" hidden=\"true\">
                                    <input id=\"especialidade\" class=\"form-control\" name=\"especialidade\"
                                        value=\"$admin->idtb_especialidade\" hidden=\"true\">
                                    <input id=\"nome\" class=\"form-control\" type=\"text\" name=\"nome\"
                                        hidden=\"required\" value=\"$admin->nome\">
                                    <input id=\"nomeguerra\" class=\"form-control\" type=\"text\" name=\"nomeguerra\"
                                        hidden=\"required\" value=\"$admin->nome_guerra\">
                                    <input id=\"correio_eletronico\" class=\"form-control\" type=\"text\" 
                                        name=\"correio_eletronico\" hidden=\"required\" value=\"$admin->correio_eletronico\">
                                    <div class=\"form-group\">
                                        <label for=\"nip\">NIP:</label>
                                        <input id=\"nip\" class=\"form-control\" type=\"text\" name=\"nip\" readonly=\"true\"
                                            placeholder=\"NIP\" maxlength=\"8\" required=\"true\" value=\"$admin->nip\" autocomplete=\"off\">
                                    </div>
                                    <div class=\"form-group\">
                                        <label for=\"cpf\">CPF (Servidores Civis):</label>
                                        <input id=\"cpf\" class=\"form-control\" type=\"text\" name=\"cpf\" readonly=\"true\"
                                            placeholder=\"CPF (Servidores Civis)\" maxlength=\"11\" value=\"$admin->cpf\" autocomplete=\"off\">
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
                                /** Em caso de alteração de outros dados */
                                else{
                                    echo"
                                    <legend>Administradores de Rede - Alteração</legend>
                                    <div class=\"form-group\">
                                        <label for=\"omapoiada\">OM Apoiada:</label>
                                        <select id=\"omapoiada\" class=\"form-control\" name=\"omapoiada\">
                                            <option value=\"$admin->idtb_om_apoiadas\" selected=\"true\">
                                                $admin->sigla_om</option>";
                                            foreach ($omapoiada as $key => $value) {
                                                echo"<option value=\"".$value->idtb_om_apoiadas."\">
                                                    ".$value->sigla."</option>";
                                            };
                                    echo"</select>
                                    </div>
                                    <div class=\"form-group\">
                                        <label for=\"postograd\">Posto/Graduação:</label>
                                        <select id=\"postograd\" class=\"form-control\" name=\"postograd\">
                                            <option value=\"$admin->idtb_posto_grad\" selected=\"true\">
                                                $admin->sigla_posto_grad</option>";
                                            foreach ($postograd as $key => $value) {
                                                echo"<option value=\"".$value->idtb_posto_grad."\">
                                                    ".$value->nome."</option>";
                                            };
                                    echo"</select>
                                    </div>
                                    <div class=\"form-group\">
                                        <label for=\"corpoquadro\">Corpo/Quadro:</label>
                                        <select id=\"corpoquadro\" class=\"form-control\" name=\"corpoquadro\">
                                            <option value=\"$admin->idtb_corpo_quadro\" selected=\"true\">
                                                $admin->sigla_corpo_quadro</option>";
                                            foreach ($corpoquadro as $key => $value) {
                                                echo"<option value=\"".$value->idtb_corpo_quadro."\">
                                                    ".$value->nome."</option>";
                                            };
                                    echo"</select>
                                    </div>
                                    <div class=\"form-group\">
                                        <label for=\"especialidade\">Especialidade:</label>
                                        <select id=\"especialidade\" class=\"form-control\" name=\"especialidade\">
                                            <option value=\"$admin->idtb_especialidade\" selected=\"true\">
                                                $admin->sigla_espec</option>";
                                            foreach ($especialidade as $key => $value) {
                                                echo"<option value=\"".$value->idtb_especialidade."\">
                                                    ".$value->nome."</option>";
                                            };
                                    echo"</select>
                                    </div>
                                    <div class=\"form-group\">
                                        <label for=\"nome\">Nome Completo:</label>
                                        <input id=\"nome\" class=\"form-control\" type=\"text\" name=\"nome\"
                                            placeholder=\"Nome Completo\" minlength=\"2\" autocomplete=\"off\"
                                            style=\"text-transform:uppercase\" required=\"true\" value=\"$admin->nome\">
                                    </div>
                                    <div class=\"form-group\">
                                        <label for=\"nomeguerra\">Nome de Guerra:</label>
                                        <input id=\"nomeguerra\" class=\"form-control\" type=\"text\" name=\"nomeguerra\"
                                            placeholder=\"Nome de Guerra\" minlength=\"2\" autocomplete=\"off\"
                                            style=\"text-transform:uppercase\" required=\"true\" value=\"$admin->nome_guerra\">
                                    </div>
                                    <div class=\"form-group\">
                                        <label for=\"correio_eletronico\">Correio Eletrônico:</label>
                                        <input id=\"correio_eletronico\" class=\"form-control\" type=\"email\" 
                                            name=\"correio_eletronico\" placeholder=\"Preferencialmente Zimbra\" 
                                            minlength=\"2\" style=\"text-transform:uppercase\" required=\"true\" 
                                            value=\"$admin->correio_eletronico\" autocomplete=\"off\">
                                    </div>
                                    <div class=\"form-group\">
                                        <label for=\"tel_contato\">Telefone de Contato:</label>
                                        <input id=\"tel_contato\" class=\"form-control\" name=\"tel_contato\"
                                            placeholder=\"(xx) xxxxx-xxxx\" minlength=\"2\" autocomplete=\"off\"
                                            required=\"true\" value=\"$admin->tel_contato\">
                                    </div>
                                    <div class=\"form-group\">
                                        <label for=\"retelma\">RETELMA:</label>
                                        <input id=\"retelma\" class=\"form-control\" name=\"retelma\"
                                            placeholder=\"xxxx-xxxx\" minlength=\"2\" autocomplete=\"off\"
                                            required=\"true\" value=\"$admin->retelma\">
                                    </div>
                                    <div class=\"form-group\">
                                        <label for=\"nip\">NIP:</label>
                                        <input id=\"nip\" class=\"form-control\" type=\"text\" name=\"nip\" readonly=\"true\"
                                            placeholder=\"NIP\" maxlength=\"8\" required=\"true\" value=\"$admin->nip\" autocomplete=\"off\">
                                    </div>
                                    <div class=\"form-group\">
                                        <label for=\"cpf\">CPF (Servidores Civis):</label>
                                        <input id=\"cpf\" class=\"form-control\" type=\"text\" name=\"cpf\" readonly=\"true\"
                                            placeholder=\"CPF (Servidores Civis)\" maxlength=\"11\" value=\"$admin->cpf\" autocomplete=\"off\">
                                    </div>
                                    <input id=\"senha\" class=\"form-control\" type=\"password\" name=\"senha\"
                                            value=\"\" hidden=\"true\">
                                    <input id=\"confirmasenha\" class=\"form-control\" type=\"password\" name=\"confirmasenha\"
                                        value=\"\" hidden=\"true\">
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
                            /** Prepara formulário para inclusão */
                            else{
                            echo"
                            <legend>Administradores de Rede - Cadastro</legend>
                            <div class=\"form-group\">
                                <label for=\"omapoiada\">OM Apoiada:</label>
                                <select id=\"omapoiada\" class=\"form-control\" name=\"omapoiada\">
                                    <option value=\"$admin->idtb_om_apoiadas\" selected=\"true\">
                                        $admin->sigla_om</option>";
                                    foreach ($omapoiada as $key => $value) {
                                        echo"<option value=\"".$value->idtb_om_apoiadas."\">
                                            ".$value->sigla."</option>";
                                    };
                            echo"</select>
                            </div>
                            <div class=\"form-group\">
                                <label for=\"postograd\">Posto/Graduação:</label>
                                <select id=\"postograd\" class=\"form-control\" name=\"postograd\">
                                    <option value=\"$admin->idtb_posto_grad\" selected=\"true\">
                                        $admin->sigla_posto_grad</option>";
                                    foreach ($postograd as $key => $value) {
                                        echo"<option value=\"".$value->idtb_posto_grad."\">
                                            ".$value->nome."</option>";
                                    };
                            echo"</select>
                            </div>
                            <div class=\"form-group\">
                                <label for=\"corpoquadro\">Corpo/Quadro:</label>
                                <select id=\"corpoquadro\" class=\"form-control\" name=\"corpoquadro\">
                                    <option value=\"$admin->idtb_corpo_quadro\" selected=\"true\">
                                        $admin->sigla_corpo_quadro</option>";
                                    foreach ($corpoquadro as $key => $value) {
                                        echo"<option value=\"".$value->idtb_corpo_quadro."\">
                                            ".$value->nome."</option>";
                                    };
                            echo"</select>
                            </div>
                            <div class=\"form-group\">
                                <label for=\"especialidade\">Especialidade:</label>
                                <select id=\"especialidade\" class=\"form-control\" name=\"especialidade\">
                                    <option value=\"$admin->idtb_especialidade\" selected=\"true\">
                                        $admin->sigla_espec</option>";
                                    foreach ($especialidade as $key => $value) {
                                        echo"<option value=\"".$value->idtb_especialidade."\">
                                            ".$value->nome."</option>";
                                    };
                            echo"</select>
                            </div>
                            <div class=\"form-group\">
                                <label for=\"nip\">NIP:</label>
                                <input id=\"nip\" class=\"form-control\" type=\"text\" name=\"nip\" autocomplete=\"off\"
                                       placeholder=\"NIP\" maxlength=\"8\" value=\"$admin->nip\">
                            </div>
                            <div class=\"form-group\">
                                <label for=\"cpf\">CPF (Servidores Civis):</label>
                                <input id=\"cpf\" class=\"form-control\" type=\"text\" name=\"cpf\" autocomplete=\"off\"
                                       placeholder=\"CPF (Servidores Civis)\" maxlength=\"11\" value=\"$admin->cpf\">
                            </div>
                            <div class=\"form-group\">
                                <label for=\"nome\">Nome Completo:</label>
                                <input id=\"nome\" class=\"form-control\" type=\"text\" name=\"nome\"
                                    placeholder=\"Nome Completo\" minlength=\"2\" autocomplete=\"off\"
                                    style=\"text-transform:uppercase\" required=\"true\" value=\"$admin->nome\">
                            </div>
                            <div class=\"form-group\">
                                <label for=\"nomeguerra\">Nome de Guerra:</label>
                                <input id=\"nomeguerra\" class=\"form-control\" type=\"text\" name=\"nomeguerra\"
                                    placeholder=\"Nome de Guerra\" minlength=\"2\" autocomplete=\"off\"
                                    style=\"text-transform:uppercase\" required=\"true\" value=\"$admin->nome_guerra\">
                            </div>
                            <div class=\"form-group\">
                                <label for=\"correio_eletronico\">Correio Eletrônico:</label>
                                <input id=\"correio_eletronico\" class=\"form-control\" type=\"email\" name=\"correio_eletronico\"
                                    placeholder=\"Preferencialmente Zimbra\" minlength=\"2\" autocomplete=\"off\"
                                    style=\"text-transform:uppercase\" required=\"true\" value=\"$admin->correio_eletronico\">
                            </div>
                            <div class=\"form-group\">
                                <label for=\"tel_contato\">Telefone de Contato:</label>
                                <input id=\"tel_contato\" class=\"form-control\" name=\"tel_contato\"
                                    placeholder=\"(xx) xxxxx-xxxx\" minlength=\"2\" autocomplete=\"off\"
                                    required=\"true\" value=\"$admin->tel_contato\">
                            </div>
                            <div class=\"form-group\">
                                <label for=\"retelma\">RETELMA:</label>
                                <input id=\"retelma\" class=\"form-control\" name=\"retelma\"
                                    placeholder=\"xxxx-xxxx\" minlength=\"2\" autocomplete=\"off\"
                                    required=\"true\" value=\"$admin->retelma\">
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
                        <input id=\"idtb_admin\" type=\"hidden\" name=\"idtb_admin\" value=\"$admin->idtb_pessoal_ti\">
                        <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Salvar\">
                    </form>
                </div>
            </main>
        </div>
    </div>";
}

/* Monta quadro de administradores */
if (($row != NULL) AND ($act == NULL)) {

	$pesti->ordena = "ORDER BY sigla_om ASC";
    $admin = $pesti->SelectALLAdmin();

    echo"<div class=\"table-responsive\">
            <table class=\"table table-hover\">
                <thead>
                    <tr>
                        <th scope=\"col\">OM Apoiada</th>
                        <th scope=\"col\">Posto/Grad./Esp.</th>
                        <th scope=\"col\">NIP/CPF</th>
                        <th scope=\"col\">Nome (Enviar e-mail)</th>
                        <th scope=\"col\">Nome de Guerra</th>
                        <th scope=\"col\">Tel.Contato</th>
                        <th scope=\"col\">RETELMA</th>
                        <th scope=\"col\">Ações</th>
                    </tr>
                </thead>";

    foreach ($admin as $key => $value) {

        /** Seleciona NIP caso seja militar da MB */
        if ($value->nip != NULL) {
            $identificacao = $pesti->FormatNIP($value->nip);
        }
        else{
            $identificacao = $pesti->FormatCPF($value->cpf);
        }
        echo"       <tr>
                        <td>".$value->sigla_om."</td>";
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
                        <td><a onClick=\"javascript:window.open('mailto:".$value->correio_eletronico."', 'mail');event.preventDefault()\" 
                            href=\"mailto:".$value->correio_eletronico."\">".$value->nome."</a></td>
                        <td>".$value->nome_guerra."</td>
                        <td>".$value->tel_contato."</td>
                        <td>".$value->retelma."</td>
                        <td>
                            <a href=\"?cmd=admin&act=cad&param=".$value->idtb_pessoal_ti."&oa=".$value->idtb_om_apoiadas."\">Editar</a> - 
                            <a href=\"?cmd=admin&act=cad&param=".$value->idtb_pessoal_ti."&oa=".$value->idtb_om_apoiadas."&senha=troca\">Senha</a> - 
                            <a href=\"?cmd=admin&act=del&param=".$value->idtb_pessoal_ti."&oa=".$value->idtb_om_apoiadas."\">Excluir</a>
                        </td>
                    </tr>";
    }
    echo"
                </tbody>
            </table>
            </div>";
}

/* Monta quadro de Pessoal de TI para exclusão */
if ($act == 'del') {

	$pesti->idtb_pessoal_ti = $param;
    $pesti->idtb_om_apoiadas = $oa;
    $pessti = $pesti->SelectIdPesTI($status);

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
            $identificacao = $pesti->FormatNIP($pessti->nip);
        }
        else{
            $identificacao = $pesti->FormatCPF($pessti->cpf);
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
                        <td><a href=\"?cmd=admin&act=conf_del&param=".$pessti->idtb_pessoal_ti."&oa=".$pessti->idtb_om_apoiadas."\">Confirmar Exclusão</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>";
}

/** Excluir Definitivamente Pessoal de TI */
if ($act == 'conf_del') {
    $pesti->idtb_om_apoiadas = $oa;
    $pesti->idtb_pessoal_ti = $param;
    $row = $pesti->DeletePesTI();
    if ($row) {
        echo "<h5>Resgistros excluídos do banco de dados.</h5>
        <meta http-equiv=\"refresh\" content=\"1;url=?cmd=admin\">";
    }
    else {
        echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
    }
}

/* Monta quadro de administradores inativos */
if ($act == 'inativos') {

	$pesti->ordena = "ORDER BY sigla_om ASC";
    $admin = $pesti->SelectAdminInativos();

    echo"<div class=\"table-responsive\">
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

    foreach ($admin as $key => $value) {

        /** Seleciona NIP caso seja militar da MB */
        if ($value->nip != NULL) {
            $identificacao = $value->nip;
        }
        else{
            $identificacao = $value->cpf;
        }
        echo"       <tr>
                        <td>".$value->sigla_om."</td>";
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
                        <td>
                            <a href=\"?cmd=admin&act=ativar&param=".$value->idtb_pessoal_ti."&oa=".$value->idtb_om_apoiadas."\">Reativar</a> - 
                            <a href=\"?cmd=admin&act=del&param=".$value->idtb_pessoal_ti."&oa=".$value->idtb_om_apoiadas."&status=".$value->status."\">Excluir</a>
                        </td>
                    </tr>";
    }
    echo"
                </tbody>
            </table>
            </div>";
}

/* Monta quadro de administradores bloqueados */
if ($act == 'bloqueados') {

	$pesti->ordena = "ORDER BY sigla_om ASC";
    $admin = $pesti->SelectPesTIBloqueados();

    echo"<div class=\"table-responsive\">
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

    foreach ($admin as $key => $value) {

        /** Seleciona NIP caso seja militar da MB */
        if ($value->nip != NULL) {
            $identificacao = $value->nip;
        }
        else{
            $identificacao = $value->cpf;
        }
        echo"       <tr>
                        <td>".$value->sigla_om."</td>";
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
                        <td><a href=\"?cmd=admin&act=cad&param=".$value->idtb_pessoal_ti."\">Editar</a> - 
                            <a href=\"?cmd=admin&act=ativar&param=".$value->idtb_pessoal_ti."&oa=".$value->idtb_om_apoiadas."\">Reativar</a>
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
        $idtb_pessoal_ti = $_POST['idtb_admin'];
        $pesti->idtb_pessoal_ti = $_POST['idtb_admin'];
        $pesti->idtb_om_apoiadas = $_POST['omapoiada'];
        $pesti->idtb_posto_grad = $_POST['postograd'];
        $pesti->idtb_corpo_quadro = $_POST['corpoquadro'];
        $pesti->idtb_especialidade = $_POST['especialidade'];
        $nip = $_POST['nip'];
        $pesti->nip = $nip;
        $cpf = $_POST['cpf'];
        $pesti->cpf = $cpf;
        $pesti->nome = mb_strtoupper($_POST['nome'],'UTF-8');
        $pesti->nome_guerra = mb_strtoupper($_POST['nomeguerra'],'UTF-8');
        $pesti->correio_eletronico = mb_strtoupper($_POST['correio_eletronico'],'UTF-8');
        $pesti->tel_contato = $_POST['tel_contato'];
        $pesti->retelma = $_POST['retelma'];
        $pesti->status = mb_strtoupper($_POST['ativo'],'UTF-8');
        $pesti->idtb_funcoes_ti = '1';
        if ($nip == NULL && $cpf == NULL){
            echo "<h5>NIP e CPF em branco, um dos itens deve ser preenchido!</h5>
            <meta http-equiv=\"refresh\" content=\"5;url=?cmd=admin\">";
        }
        if ($nip == NULL) {
            $usuario = $cpf;
        }
        else {
            $usuario = $nip;
        }
        $pesti->usuario = $usuario;
        /* Opta pelo Método Update */
        if ($idtb_pessoal_ti){
            $senha = $_POST['senha'];
            if($senha==NULL){
                $row = $pesti->UpdatePesTI();
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
                $hash = sha1(md5($senha));
                $salt = sha1(md5($usuario));
                $pesti->senha = $salt.$hash;
                $row = $pesti->UpdateSenhaPesti();
                if ($row) {
                    $usr->iduser = $idtb_pessoal_ti;
                    $pwd = $usr->SetVencSenha(5);
                    echo "<h5>Resgistros incluídos no banco de dados.</h5>
                    <meta http-equiv=\"refresh\" content=\"1;url=?cmd=admin\">";
                }
                else {
                    echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
                    echo(pg_result_error($row) . "<br />\n");
                }
            }            
        }
        /* Opta pelo Método Insert */
        else{
            /* Checa se há Admin com mesmo login cadastrado */
            $nip_cpf = $pesti->ChecaNIPCPF();
            $correio = $pesti->ChecaCorreio();
            if ($nip_cpf != NULL) {
                echo "<h5>Já existe um Admin cadastrado com esse NIP/CPF.</h5>";
            }
            elseif ($correio != NULL){
                echo "<h5>Já existe um Admin cadastrado com esse Correio Eletrônico.</h5>";
            }
            else {
                $senha = $_POST['senha'];
                $hash = sha1(md5($senha));
                $salt = sha1(md5($usuario));
                $pesti->senha = $salt.$hash;
                $row = $pesti->InsertPesTI();
                if ($row) {
                    $usr->iduser = $row;
                    $pwd = $usr->SetVencSenha(5);
                    echo "<h5>Resgistros incluídos no banco de dados.</h5>
                    <meta http-equiv=\"refresh\" content=\"1;url=?cmd=admin\">";
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

/** Reativar Usuário */
if ($act == 'ativar') {
    if (isset($_SESSION['status'])){
        $pesti->idtb_pessoal_ti = $param;
        $pesti->idtb_om_apoiadas = $oa;
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

/** Desativar Usuário */
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