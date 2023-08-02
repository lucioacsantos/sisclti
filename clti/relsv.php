<?php

/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/** Leitura de parâmetros */
$oa = $cmd = $param = $param2 = $act = $senha = null;
if (isset($_GET['oa'])){ $oa = $_GET['oa']; }
if (isset($_GET['cmd'])){ $cmd = $_GET['cmd']; }
if (isset($_GET['act'])){ $act = $_GET['act']; }
if (isset($_GET['param'])){ $param = $_GET['param']; }
if (isset($_GET['param2'])){ $param2 = $_GET['param2']; }
if (isset($_GET['senha'])){ $senha = $_GET['senha']; }

/** Formata Posto/Esp/Grad */
function postoGrad($pessclti){
    if (($pessclti->exibir_espec == 'NÃO') AND ($pessclti->exibir_corpo_quadro == 'NÃO')){
        $postograd = $pessclti->sigla_posto_grad;
    }
    elseif (($pessclti->exibir_espec == 'NÃO') AND ($pessclti->exibir_corpo_quadro != 'NÃO')){
        $postograd = $pessclti->sigla_posto_grad ."-". $pessclti->sigla_corpo_quadro;
    }
    elseif (($pessclti->exibir_espec != 'NÃO') AND ($pessclti->exibir_corpo_quadro == 'NÃO')){
        $postograd = $pessclti->sigla_posto_grad ."-". $pessclti->sigla_espec;
    }
    else {
        $postograd = $pessclti->sigla_posto_grad ."-". $pessclti->sigla_corpo_quadro ."-". $pessclti->sigla_espec;
    }
    return $postograd;
}

/* Classe de interação com o PostgreSQL */
require_once "../class/constantes.inc.php";


/* URL Recuperada do Banco de Dados */
$config = new Config();
$url = $config->SelectURL();

include_once "../head.php";

include_once "../nav.php";

echo "
            <main role=\"main\" class=\"col-md-9 ml-sm-auto col-lg-10 px-4\">
              <div class=\"d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom\">
                <h1 class=\"h2\">Gerenciamento - Tipos de CLTI</h1>
                <div class=\"btn-toolbar mb-2 mb-md-0\">
                  <div class=\"btn-group mr-2\">
                    <a href=\"?cmd=gerclti\"><button class=\"btn btn-sm btn-outline-secondary\">Gerenciamento do CLTI</button></a>
                  </div>
                </div>
              </div>
              
              <div class=\"table-responsive\">
              <table class=\"table table-hover\">
                  <thead>
                      <tr>
                          <th scope=\"col\">Número</th>
                          <th scope=\"col\">Serviço do dia:</th>
                          <th scope=\"col\">Para o dia:</th>
                          <th scope=\"col\">Sup. que sai:</th>
                          <th scope=\"col\">Sup. que entra:</th>
                          <th scope=\"col\">Ações</th>
                      </tr>
                  </thead>";

/** Incluindo TCPDF */
require_once "../tcpdf/tcpdf.php";

$rel_svc = new RelServico();
$pess_clti = new PessoalCLTI();

$rel_andamento = $rel_svc->SelectEmAndamento();

$titulos = $rel_svc->SelectTitulos();

$itens = $rel_svc->SelectItens();
$configrel = $rel_svc->SelectConfigRel();

foreach ($rel_andamento as $key => $value) {
    $pess_clti->idtb_lotacao_clti = $value->sup_sai_servico;
    $sup_sai = $pess_clti->SelectId();
    $pess_clti->idtb_lotacao_clti = $value->sup_entra_servico;
    $sup_entra = $pess_clti->SelectId();
    $rel_svc->num_rel = $value->num_rel;
    $ocorrencias = $rel_svc->SelectOcorrenciaNumRel();
    echo"       <tr>
                    <th scope=\"row\">".$value->num_rel."</th>
                    <td>".date('d-m-Y',strtotime($value->data_entra_servico))."</td>
                    <td>".date('d-m-Y',strtotime($value->data_sai_servico))."</td>
                    <td>".$sup_sai->sigla_posto_grad." - ".$sup_sai->nome_guerra."</td>
                    <td>".$sup_entra->sigla_posto_grad." - ".$sup_entra->nome_guerra."</td>
                    <td>".@$value->num_midia_bakcup."</td>
                    <td><a href=\"?cmd=relservicov2&act=cad&param=".$value->num_rel."\">Editar</a><br/>
                        <a href=\"?cmd=relservicov2&act=reg_ocorrencia&param=".$value->num_rel."\">Registrar ocorrência</a><br/>
                        <a href=\"?cmd=relservicov2&act=ocorrencias&param=".$value->num_rel."\">Ocorrências</a><br/>
                        <a href=\"?cmd=relservicov2&act=encerrar&param=".$value->num_rel."\">Encerrar relatório</a><br />
                        <a href=\"relpdf.php?param=".$value->num_rel."\" target=\"_blanck\">Gerar PDF</a>
                    </td>
                </tr>";
}

foreach ($titulos as $key => $value){
    $subtitulos = $rel_svc->SelectSubtitulos($value->idtb_titulos_rel_sv_v2);
    echo "$value->titulo<br />";
    foreach ($subtitulos as $key1 => $value1){
        echo "$value1->subtitulo<br />";
    }
}

include_once "../foot.php";