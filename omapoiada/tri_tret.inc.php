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
$om = new OMApoiadas();
$pessom = new PessoalOM();
$et = new Estacoes();
$omapoiada = $_SESSION['id_om_apoiada'];
$om->idtb_om_apoiadas = $omapoiada;
$et->idtb_om_apoiadas = $omapoiada;
$et->ordena = "ORDER BY nome ASC";
$etom = $et->SelectIdOMETView();

/* Formulário para NIP/CPF */
if ($act == NULL) {
    echo "
    <div class=\"container-fluid\">
        <div class=\"row\">
            <main>
                <div id=\"form-cadastro\">
                    <form id=\"nip_cpf\" role=\"form\" action=\"?cmd=tri_tret&act=cad\" 
                    method=\"post\" enctype=\"multipart/form-data\">
                        <fieldset>
                        <legend>TRI/TRET</legend>
                            <div class=\"form-group\">
                                <label for=\"nip_cpf\">Informe o NIP/CPF:</label>
                                <input id=\"nip_cpf\" class=\"form-control\" type=\"num\" name=\"nip_cpf\" 
                                    placeholder=\"NIP/CPF\" maxlength=\"11\" autofocus=\"true\" required=\"true\" 
                                    autocomplete=\"off\">
                            </div>
                        </fieldset>
                        <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Localizar\">
                    </form>
                </div>
            </main>
        </div>
    </div>";
}

/* Carrega form */
if ($act == 'cad') {
    $pessom->usuario = $_POST['nip_cpf'];
    $tri_tret = $pessom->ChecaNIPCPF();
    echo"
    <div class=\"table-responsive\">
        <table class=\"table table-hover\">
            <thead>
                <tr>
                    <th scope=\"col\">Posto/Grad</th>
                    <th scope=\"col\">NIP/CPF</th>
                    <th scope=\"col\">Nome</th>
                </tr>
            </thead>";
    if ($tri_tret->nip != NULL) {
        $identificacao = $pessom->FormatNIP($tri_tret->nip);
    }
    else{
        $identificacao = $pessom->FormatCPF($tri_tret->cpf);
    }
    echo"       <tr>";
    if (($tri_tret->exibir_espec == 'NÃO') AND ($tri_tret->exibir_corpo_quadro == 'NÃO')){
        echo"       <th scope=\"row\">".$tri_tret->posto_grad."</th>";
    }
    elseif (($tri_tret->exibir_espec == 'NÃO') AND ($tri_tret->exibir_corpo_quadro != 'NÃO')){
        echo"       <th scope=\"row\">".$tri_tret->posto_grad." ".$tri_tret->corpo_quadro."</th>";
    }
    elseif (($tri_tret->exibir_espec != 'NÃO') AND ($tri_tret->exibir_corpo_quadro == 'NÃO')){
        echo"       <th scope=\"row\">".$tri_tret->posto_grad." ".$tri_tret->espec."</th>";
    }
    else {
        echo"       <th scope=\"row\">".$tri_tret->posto_grad." ".$tri_tret->corpo_quadro." 
                        ".$tri_tret->espec."</th>";
    }
        echo"       <td>".$identificacao."</td>
                    <td>".$tri_tret->nome."</td>
                    <td>
                        <a href=\"tri.inc.php?param=".$tri_tret->idtb_pessoal_om."\" target=\"_blanck\">
                            | Emitir TRI |</a>
                    </td>
                </tr>";
    
    echo"
            </tbody>
        </table>
    </div>
    <div class=\"container-fluid\">
        <div class=\"row\">
            <main>
                <div id=\"form-cadastro\">
                <form id=\"form\" action=\"tret.inc.php\" method=\"post\" 
                target=\"_blanck\" enctype=\"multipart/form-data\">
                <fieldset>
                    <legend>TRET - Selecione uma ET</legend>
                    <div class=\"form-group\">
                        <select id=\"idtb_estacoes\" class=\"form-control\" name=\"idtb_estacoes\">";
                                foreach ($etom as $key => $value) {
                                    echo"<option value=\"".$value->idtb_estacoes."\">
                                        ".$value->nome." - ".$value->end_ip."</option>";
                                };
                            echo "</select>
                    </div>
                </fieldset>
                <input type=\"hidden\" name=\"idtb_pessoal_om\" value=\"$tri_tret->idtb_pessoal_om\">
                <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Emitir TRET\">
                </form>
                </div>
            </main>
        </div>
    </div>";
    
}

?>