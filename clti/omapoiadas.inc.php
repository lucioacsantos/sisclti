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
$omap = new OMAPoiadas();
$cfg = new Config();

/* Recupera informações */
$row = $omap->SelectAllOMTable();

/* Checa se há OM cadastradas */
if (($row == NULL) AND ($act == NULL)) {
	echo "<h5>Não há OM Apoiadas cadastradas neste CLTI,<br />
		 clique <a href=\"?cmd=omapoiadas&act=cad\">aqui</a> para fazê-lo.</h5>";
}

/* Carrega form para cadastro de OM */
if ($act == 'cad') {
    if ($param){
        $omap->idtb_om_apoiadas = $param;
        $om = $omap->SelectIdOMTable();
        $omap->estado = $om->idtb_estado;
        $estado = $omap->SelectIdEstado();
        $omap->cidade = $om->idtb_cidade;
        $cidade = $omap->SelectIdCidade();
    }
    else{
        $row = $cfg->SelectEstado();
        $ESTADO = $row->valor;
        $row = $cfg->SelectCidade();
        $CIDADE = $row->valor;
        $om = (object)['idtb_om_apoiadas'=>'','cod_om'=>'','nome'=>'','sigla'=>'','indicativo'=>''];
        $estado = (object)['uf'=>$ESTADO];
        $cidade = (object)['nome'=>$CIDADE];
    }
    
	echo "
	<div class=\"container-fluid\">
        <div class=\"row\">
            <main>
                <div id=\"form-cadastro\">
                    <form id=\"insertom\" action=\"?cmd=omapoiadas&act=insert\" method=\"post\" enctype=\"multipart/form-data\">
                        <fieldset>
                            <legend>OM Apoiadas pelo CLTI - Cadastro</legend>

                            <div class=\"form-group\">
                                <label for=\"estado\">Selecione o Estado:</label>
                                <select id=\"estado\" class=\"form-control\" name=\"estado\" value=\"$estado->uf\"></select>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"cidade\">Selecione a Cidade:</label>
                                <select id=\"cidade\" class=\"form-control\" name=\"cidade\" value=\"$cidade->nome\"></select>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"cod_om\">Código da OM:</label>
                                <input id=\"cod_om\" class=\"form-control\" type=\"number\" name=\"cod_om\"
                                       placeholder=\"Código da OM\" maxlength=\"8\" required=\"true\" 
                                       value=\"$om->cod_om\" autocomplete=\"off\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"nome\">Nome da OM:</label>
                                <input id=\"nome\" class=\"form-control\" type=\"text\" name=\"nome\"
                                       style=\"text-transform:uppercase\" placeholder=\"Nome da OM\" 
                                       minlength=\"2\" required=\"true\" value=\"$om->nome\" autocomplete=\"off\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"sigla\">Sigla da OM:</label>
                                <input id=\"sigla\" class=\"form-control\" type=\"text\" name=\"sigla\"
                                       style=\"text-transform:uppercase\" placeholder=\"Sigla da OM\" 
                                       minlength=\"2\" required=\"true\" value=\"$om->sigla\" autocomplete=\"off\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"indicativo\">Indicativo Naval da OM:</label>
                                <input id=\"indicativo\" class=\"form-control\" type=\"text\" name=\"indicativo\"
                                       style=\"text-transform:uppercase\" placeholder=\"Indicativo Naval da OM\" 
                                       maxlength=\"6\" required=\"true\" value=\"$om->indicativo\" autocomplete=\"off\">
                            </div>

                        </fieldset>
                        <input id=\"idtb_om_apoiadas\" type=\"hidden\" name=\"idtb_om_apoiadas\" value=\"$om->idtb_om_apoiadas\">
                        <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Salvar\">
                    </form>
                </div>
            </main>
        </div>
    </div>";
}

/* Monta quadro de OM */
if (($row) AND ($act == NULL)) {

    echo"<div class=\"table-responsive\">
            <table class=\"table table-hover\">
                <thead>
                    <tr>
                        <th scope=\"col\">Código</th>
                        <th scope=\"col\">Nome</th>
                        <th scope=\"col\">Sigla</th>
                        <th scope=\"col\">Ind. Naval</th>
                        <th scope=\"col\">
                            <span data-feather=\"edit\"></span> Editar</br>
                            <span data-feather=\"alert-triangle\"></span> Nova Chave</br>
                            <span data-feather=\"file-text\"></span> Detalhar
                        </th>
                    </tr>
                </thead>";

    $omap->ordena = "ORDER BY cod_om ASC";
    $om = $omap->SelectAllOMTable();

    foreach ($om as $key => $value) {
        echo"       <tr>
                        <th scope=\"row\">".$value->cod_om."</th>
                        <td>".$value->nome."</td>
                        <td>".$value->sigla."</td>
                        <td>".$value->indicativo."</td>
                        <td>
                            <a href=\"?cmd=omapoiadas&act=cad&param=".$value->idtb_om_apoiadas."\"><span data-feather=\"edit\"></span></a> - 
                            <a href=\"?cmd=omapoiadas&act=chave_acesso&param=".$value->idtb_om_apoiadas."\"><span data-feather=\"alert-triangle\"></span></a> - 
                            <a href=\"?cmd=omapoiadas&act=detalhar&param=".$value->idtb_om_apoiadas."\"><span data-feather=\"file-text\"></span></a>
                        </td>
                    </tr>";
    };
    echo"
                </tbody>
            </table>
            </div>";
}

/* Registra chave de acesso da OM */
if ($act == 'chave_acesso') {

    require_once "../class/authenticator.inc.php";

    $authenticator = new GoogleAuthenticator();
    $secret = $authenticator->createSecret();
    $omap->idtb_om_apoiadas = $param;
    $row = $omap->ChaveAcessoOM($secret);
    if ($row) {
        echo "<h5>Chave de acesso $secret registrada no banco de dados.</h5>";
    }    
    else {
        echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
        echo(pg_result_error($row) . "<br />\n");
    }
    
}

/** Detalhar OM */
if ($act == 'detalhar'){
    $gw = new Monitoramento();
    $omap->idtb_om_apoiadas = $param;
    $gw->idtb_om_apoiadas = $param;
    $om = $omap->SelectIdOMTable();
    $ip_gw = $gw->SelectGwIdOM();

    echo"<div class=\"table-responsive\">
            <table class=\"table table-hover\">
                <thead>
                    <tr>
                        <th scope=\"col\">Código</th>
                        <th scope=\"col\">Nome</th>
                        <th scope=\"col\">Sigla</th>
                        <th scope=\"col\">Ind. Naval</th>
                        <th scope=\"col\">End.IP</th>
                    </tr>
                </thead>
                    <tr>
                        <th scope=\"row\">".$om->cod_om."</th>
                        <td>".$om->nome."</td>
                        <td>".$om->sigla."</td>
                        <td>".$om->indicativo."</td>
                        <td>".$ip_gw."</td>
                    </tr>
                </tbody>
            </table>
            </div>";

}

/* Método INSERT / UPDATE */
if ($act == 'insert') {
    if (isset($_SESSION['status'])){
        $idtb_om_apoiadas = $_POST['idtb_om_apoiadas'];
        $omap->idtb_om_apoiadas = $idtb_om_apoiadas;
        $omap->estado = $_POST['estado'];
        $omap->cidade = $_POST['cidade'];
        $omap->cod_om = $_POST['cod_om'];
        $omap->nome = mb_strtoupper($_POST['nome'],'UTF-8');
        $omap->sigla = mb_strtoupper($_POST['sigla'],'UTF-8');
        $omap->indicativo = mb_strtoupper($_POST['indicativo'],'UTF-8');
        $omap->estado = $omap->SelectUfEstado();
        $omap->cidade = $omap->SelectNomeCidade();

        # Opta pelo método UPDATE
        if ($idtb_om_apoiadas){
            $row = $omap->UpdateOM();
            if ($row) {
                echo "<h5>Resgistros incluídos no banco de dados.</h5>
                    <meta http-equiv=\"refresh\" content=\"1;url=?cmd=omapoiadas\">";
            }    
            else {
                echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
                echo(pg_result_error($row) . "<br />\n");
            }
        }

        # Opta pelo método INSERT
        else{
            $row = $omap->InsertOM();
            if ($row) {
                echo "<h5>Resgistros incluídos no banco de dados.</h5>
                    <meta http-equiv=\"refresh\" content=\"1;url=?cmd=omapoiadas\">";
            }
    
            else {
                echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
                echo(pg_result_error($row) . "<br />\n");
            }
        }
    }
    else{
        echo "<h5>Ocorreu algum erro, usuário não autenticado.</h5>
            <meta http-equiv=\"refresh\" content=\"1;$url\">";
    }
}

?>