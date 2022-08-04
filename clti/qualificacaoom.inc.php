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
$qti = new PessoalTI();

/* Monta quadro */
if ($act == NULL) {

    $qti->ordena = "ORDER BY idtb_posto_grad, tipo, nome_curso, data_conclusao ASC";
    $qualiti = $qti->SelectAllQualif();

    echo"<div class=\"table-responsive\">
            <table class=\"table table-hover\">
                <thead>
                    <tr>
                        <th scope=\"col\">Posto/Grad./Esp.</th>
                        <th scope=\"col\">NIP</th>
                        <th scope=\"col\">Nome de Guerra</th>
                        <th scope=\"col\">OM</th>
                        <th scope=\"col\">Curso</th>
                        <th scope=\"col\">Situação</th>
                    </tr>
                </thead>";

    foreach ($qualiti as $key => $value) {

        #Seleciona NIP caso seja militar da MB
        if ($value->nip != NULL) {
            $identificacao = $qti->FormatNIP($value->nip);
        }
        else{
            $identificacao = $qti->FormatCPF($value->cpf);
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
            echo"       <td>$identificacao</td>
                        <td>$value->nome_guerra</td>
                        <td>$value->sigla_om</td>
                        <td>$value->tipo $value->nome_curso</td>
                        <td>$value->situacao</td>                        
                    </tr>";
    }
    echo"
                </tbody>
            </table>
            </div>";
}

?>