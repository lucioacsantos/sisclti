<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/* Classe de interação com o PostgreSQL */
require_once "../class/constantes.inc.php";
$om = new OMAPoiadas();
$pom = new PessoalOM();
$et = new Estacoes();
$fs = new FuncSiGDEM();
$config = new Config();
$mil = new Militar();

/* Recupera informações */
$row = $pom->SelectAllPesOM();

@$act = $_GET['act'];

/* Checa Informações */
if (($row == NULL) AND ($act == NULL)) {
	echo "<h5>Não há Pessoal cadastrado,<br />
		 clique <a href=\"?cmd=pessoalom&act=cad\">aqui</a> para fazê-lo.</h5>";
}

/* Carrega form para cadastro de Admin */
if ($act == 'cad') {
    @$param = $_GET['param'];
    if ($param){
        $pom->idtb_pessoal_om = $param;
        $pessom = $pom->SelectIdPesOM();
    }
    else{
        $pessom = (object)['idtb_pessoal_om'=>'','nip'=>'','cpf'=>'','nome'=>'','nome_guerra'=>'',
            'idtb_om_apoiadas'=>'','sigla_om'=>'','idtb_posto_grad'=>'8','sigla_posto_grad'=>'Primeiro Tenente',
            'idtb_corpo_quadro'=>'','sigla_corpo_quadro'=>'','idtb_especialidade'=>'','sigla_espec'=>'',
            'correio_eletronico'=>''];
    }
    $om->ordena = "ORDER BY sigla ASC";
	$omapoiada = $om->SelectAllOMTable();
    $postograd = $mil->SelectAllPostoGrad();
    $corpoquadro = $mil->SelectAllCorpoQuadro();
    $especialidade = $mil->SelectAllEspec();
    $idtb_om_apoiadas = $_SESSION['id_om_apoiada'];
    $et->idtb_om_apoiadas = $idtb_om_apoiadas;
    $estacoes = $et->SelectIdOMETView();
    $fs->idtb_om_apoiadas = $idtb_om_apoiadas;
    $funcsigdem = $fs->SelectOMAll();

    echo "
	<div class=\"container-fluid\">
        <div class=\"row\">
            <main>
                <div id=\"form-cadastro\">
                    <form id=\"insereusuario\" role=\"form\" action=\"?cmd=pessoalom&act=insert\" 
                        method=\"post\" enctype=\"multipart/form-data\">
                        <fieldset>";

                            #Prepara formulário para atualização de dados
                            if ($param){
                                echo"
                                <legend>Pessoal da OM - Alteração</legend>

                                <input type=\"hidden\" name=\"idtb_om_apoiadas\" value=\"$idtb_om_apoiadas\">

                                <div class=\"form-group\">
                                    <label for=\"postograd\">Posto/Graduação:</label>
                                    <select id=\"postograd\" class=\"form-control\" name=\"postograd\">
                                        <option value=\"$pessom->idtb_posto_grad\" selected=\"true\">
                                            $pessom->sigla_posto_grad</option>";
                                        foreach ($postograd as $key => $value) {
                                            echo"<option value=\"".$value->idtb_posto_grad."\">
                                                ".$value->nome."</option>";
                                        };
                                    echo "</select>
                                </div>

                                <div class=\"form-group\">
                                    <label for=\"corpoquadro\">Corpo/Quadro:</label>
                                    <select id=\"corpoquadro\" class=\"form-control\" name=\"corpoquadro\">
                                        <option value=\"$pessom->idtb_corpo_quadro\" selected=\"true\">
                                            $pessom->sigla_corpo_quadro</option>";
                                        foreach ($corpoquadro as $key => $value) {
                                            echo"<option value=\"".$value->idtb_corpo_quadro."\">
                                                ".$value->nome."</option>";
                                        };
                                    echo "</select>
                                </div>

                                <div class=\"form-group\">
                                    <label for=\"especialidade\">Especialidade:</label>
                                    <select id=\"especialidade\" class=\"form-control\" name=\"especialidade\">
                                        <option value=\"$pessom->idtb_especialidade\" selected=\"true\">
                                            $pessom->sigla_espec</option>";
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
                                        style=\"text-transform:uppercase\" required=\"true\" value=\"$pessom->nome\">
                                </div>

                                <div class=\"form-group\">
                                    <label for=\"nomeguerra\">Nome de Guerra:</label>
                                    <input id=\"nomeguerra\" class=\"form-control\" type=\"text\" name=\"nomeguerra\"
                                        placeholder=\"Nome de Guerra\" minlength=\"2\" autocomplete=\"off\"
                                        style=\"text-transform:uppercase\" required=\"true\" value=\"$pessom->nome_guerra\">
                                </div>
                                <div class=\"form-group\">
                                    <label for=\"nip\">NIP:</label>
                                    <input id=\"nip\" class=\"form-control\" type=\"text\" name=\"nip\" readonly=\"true\"
                                        placeholder=\"NIP\" maxlength=\"8\" required=\"true\" value=\"$pessom->nip\" autocomplete=\"off\">
                                </div>

                                <div class=\"form-group\">
                                    <label for=\"cpf\">CPF (Servidores Civis):</label>
                                    <input id=\"cpf\" class=\"form-control\" type=\"text\" name=\"cpf\" readonly=\"true\"
                                        placeholder=\"CPF (Servidores Civis)\" maxlength=\"11\" value=\"$pessom->cpf\" autocomplete=\"off\">
                                </div>

                                <div class=\"form-group\">
                                    <label for=\"correio_eletronico\">Correio Eletrônico:</label>
                                    <input id=\"correio_eletronico\" class=\"form-control\" type=\"email\" autocomplete=\"off\"
                                        name=\"correio_eletronico\" placeholder=\"Preferencialmente Zimbra\" 
                                        minlength=\"2\" style=\"text-transform:uppercase\" required=\"true\" 
                                        value=\"$pessom->correio_eletronico\">
                                </div>

                                <div class=\"form-group\">
                                    <label for=\"idtb_funcoes_sigdem\">Função no SiGDEM:</label>
                                    <select id=\"idtb_funcoes_sigdem\" class=\"form-control\" name=\"idtb_funcoes_sigdem\">
                                        <option value=\"$pessom->idtb_funcoes_sigdem\" selected=\"true\">
                                            $pessom->idtb_funcoes_sigdem</option>";
                                        foreach ($funcsigdem as $key => $value) {
                                            echo"<option value=\"".$value->idtb_funcoes_sigdem."\">
                                                ".$value->sigla."</option>";
                                        };
                                    echo "</select>
                                </div>

                                <div class=\"form-group\">
                                    <label for=\"idtb_estacoes\">Estação de Trabalho:</label>
                                    <select id=\"idtb_estacoes\" class=\"form-control\" name=\"idtb_estacoes\">
                                        <option value=\"$pessom->idtb_estacoes\" selected=\"true\">
                                            $pessom->idtb_estacoes</option>";
                                        foreach ($estacoes as $key => $value) {
                                            echo"<option value=\"".$value->idtb_estacoes."\">
                                                ".$value->sigla."</option>";
                                        };
                                    echo "</select>
                                </div>

                                <div class=\"form-group\">
                                    <label for=\"ativo\" class=\"control-label\">Situação:</label>
                                    <select id=\"ativo\" class=\"form-control\" name=\"ativo\">
                                        <option value=\"$pessom->status\" selected=\"true\">$pessom->status</option>
                                        <option value=\"ATIVO\">ATIVO</option>
                                        <option value=\"INATIVO\">INATIVO</option>
                                    <div class=\"help-block with-errors\"></div>
                                </div>";
                            }
                            #Prepara formulário para inclusão
                            else{
                            echo"
                            <legend>Pessoal da OM - Cadastro</legend>
                            
                            <input type=\"hidden\" name=\"idtb_om_apoiadas\" value=\"$idtb_om_apoiadas\">

                            <div class=\"form-group\">
                                <label for=\"postograd\">Posto/Graduação:</label>
                                <select id=\"postograd\" class=\"form-control\" name=\"postograd\">
                                    <option value=\"$pessom->idtb_posto_grad\" selected=\"true\">
                                        $pessom->sigla_posto_grad</option>";
                                    foreach ($postograd as $key => $value) {
                                        echo"<option value=\"".$value->idtb_posto_grad."\">
                                            ".$value->nome."</option>";
                                    };
                                echo "</select>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"corpoquadro\">Corpo/Quadro:</label>
                                <select id=\"corpoquadro\" class=\"form-control\" name=\"corpoquadro\">
                                    <option value=\"$pessom->idtb_corpo_quadro\" selected=\"true\">
                                        $pessom->sigla_corpo_quadro</option>";
                                    foreach ($corpoquadro as $key => $value) {
                                        echo"<option value=\"".$value->idtb_corpo_quadro."\">
                                            ".$value->nome."</option>";
                                    };
                                echo "</select>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"especialidade\">Especialidade:</label>
                                <select id=\"especialidade\" class=\"form-control\" name=\"especialidade\">
                                    <option value=\"$pessom->idtb_especialidade\" selected=\"true\">
                                        $pessom->sigla_espec</option>";
                                    foreach ($especialidade as $key => $value) {
                                        echo"<option value=\"".$value->idtb_especialidade."\">
                                            ".$value->nome."</option>";
                                    };
                                echo "</select>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"nip\">NIP:</label>
                                <input id=\"nip\" class=\"form-control\" type=\"text\" name=\"nip\" autocomplete=\"off\"
                                       placeholder=\"NIP\" maxlength=\"8\" required=\"true\" value=\"$pessom->nip\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"cpf\">CPF (Servidores Civis):</label>
                                <input id=\"cpf\" class=\"form-control\" type=\"text\" name=\"cpf\" autocomplete=\"off\"
                                       placeholder=\"CPF (Servidores Civis)\" maxlength=\"11\" value=\"$pessom->cpf\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"nome\">Nome Completo:</label>
                                <input id=\"nome\" class=\"form-control\" type=\"text\" name=\"nome\"
                                    placeholder=\"Nome Completo\" minlength=\"2\" autocomplete=\"off\"
                                    style=\"text-transform:uppercase\" required=\"true\" value=\"$pessom->nome\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"nomeguerra\">Nome de Guerra:</label>
                                <input id=\"nomeguerra\" class=\"form-control\" type=\"text\" name=\"nomeguerra\"
                                    placeholder=\"Nome de Guerra\" minlength=\"2\" autocomplete=\"off\"
                                    style=\"text-transform:uppercase\" required=\"true\" value=\"$pessom->nome_guerra\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"correio_eletronico\">Correio Eletrônico:</label>
                                <input id=\"correio_eletronico\" class=\"form-control\" type=\"email\" name=\"correio_eletronico\"
                                    placeholder=\"Preferencialmente Zimbra\" minlength=\"2\" autocomplete=\"off\"
                                    required=\"true\" value=\"$pessom->correio_eletronico\">
                            </div>

                            <input id=\"ativo\" type=\"hidden\" name=\"ativo\" value=\"ATIVO\">";
                            }
                        echo"
                        </fieldset>
                        <input id=\"idtb_pessoal_om\" type=\"hidden\" name=\"idtb_pessoal_om\" value=\"$pessom->idtb_pessoal_om\">
                        <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Salvar\">
                    </form>
                </div>
            </main>
        </div>
    </div>";
}

/* Monta quadro */
if (($row) AND ($act == NULL)) {
    $pom->ordena = "ORDER BY idtb_posto_grad DESC";
    $pom->idtb_om_apoiadas = $_SESSION['id_om_apoiada'];
    $pessom = $pom->SelectIdOMPesOM();
    echo"<div class=\"table-responsive\">
            <table class=\"table table-hover\">
                <thead>
                    <tr>
                        <th scope=\"col\">Posto/Grad./Esp.</th>
                        <th scope=\"col\">NIP/CPF</th>
                        <th scope=\"col\">Nome</th>
                        <th scope=\"col\">Nome de Guerra</th>
                        <th scope=\"col\">Ações</th>
                    </tr>
                </thead>";
    foreach ($pessom as $key => $value) {
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
                        <td><a href=\"?cmd=pessoalti&act=cad&param=".$value->idtb_pessoal_om."\">Editar</a></td>
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
        $idtb_pessoal_om = $_POST['idtb_pessoal_om'];
        $pom->idtb_pessoal_om = $idtb_pessoal_om;
        $pom->idtb_om_apoiadas = $_POST['idtb_om_apoiadas'];
        $pom->idtb_posto_grad = $_POST['postograd'];
        $pom->idtb_corpo_quadro = $_POST['corpoquadro'];
        $pom->idtb_especialidade = $_POST['especialidade'];
        $pom->nip = $_POST['nip'];
        $pom->cpf = $_POST['cpf'];
        $pom->nome = mb_strtoupper($_POST['nome'],'UTF-8');
        $pom->nome_guerra = mb_strtoupper($_POST['nomeguerra'],'UTF-8');
        $pom->correio_eletronico = mb_strtoupper($_POST['correio_eletronico'],'UTF-8');
        $pom->status = mb_strtoupper($_POST['ativo'],'UTF-8');
        if ($nip == NULL) {
            $usuario = $cpf;
        }
        else {
            $usuario = $nip;
        }
        $pom->usuario = $usuario;

        /* Opta pelo Método Update */
        if ($idtb_pessoal_om){
            $row = $pom->UpdatePesOM();
            if ($row) {
                echo "<h5>Resgistros incluídos no banco de dados.</h5>
                <meta http-equiv=\"refresh\" content=\"1;?cmd=pessoalom \">";
            }    
            else {
                echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
                echo(pg_result_error($row) . "<br />\n");
            }
        }        
        else{
            /* Checa se há Usuário com mesmo NIP/CPF cadastrado */
            $row = $pom->ChecaNIPCPF();
            if ($row) {
                echo "<h5>Já existe um Usuário cadastrado com esse NIP/CPF.</h5>";
            }
            $row = $pom->ChecaCorreio();
            if ($row) {
                echo "<h5>Já existe um Admin cadastrado com esse Correio Eletrônico.</h5>";
            }
            else {
                $row = $pom->InsertPesOM();
                if ($row) {
                    echo "<h5>Resgistros incluídos no banco de dados.</h5>
                    <meta http-equiv=\"refresh\" content=\"1;?cmd=pessoalom\">";
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
?>