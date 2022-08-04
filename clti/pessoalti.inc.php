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
$om = new OMAPoiadas();
$pesti = new PessoalTI();
$mil = new Militar();
$usr = new Usuario();

/* Recupera informações dos OSIC */
$row = $pesti->SelectAllPesTI();

/* Checa se há OSIC cadastrado */
if (($row == NULL) AND ($act == NULL)) {
    echo "<h5>Não há Pessoal de TI cadastrado.</h5>";
}

/* Monta quadro do Pessoal de TI */
if (($row) AND ($act == NULL)) {

	$pesti->ordena = "ORDER BY sigla_om ASC";
    $osic = $pesti->SelectAllPesTI();

    echo"<div class=\"table-responsive\">
            <table class=\"table table-hover\">
                <thead>
                    <tr>
                        <th scope=\"col\">OM Apoiada</th>
                        <th scope=\"col\">Posto/Grad./Esp.</th>
                        <th scope=\"col\">NIP/CPF</th>
                        <th scope=\"col\">Nome (Enviar e-mail)</th>
                        <th scope=\"col\">Nome de Guerra</th>
                        <th scope=\"col\">Função</th>
                    </tr>
                </thead>";

    foreach ($osic as $key => $value) {        

        #Seleciona NIP caso seja militar da MB
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
                        <td>".$value->nome."</td>
                        <td>".$value->nome_guerra."</td>
                        <td>".$value->sigla_funcao."</td>
                    </tr>";
    }
    echo"
                </tbody>
            </table>
            </div>";
}
?>