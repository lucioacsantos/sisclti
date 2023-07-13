<?php

/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/** Leitura de parâmetros */
$cmd = $param = $param2 = $act = $senha = null;

if (isset($_GET['cmd'])){
  $cmd = $_GET['cmd'];
}

if (isset($_GET['act'])){
  $act = $_GET['act'];
}

if (isset($_GET['param'])){
  $param = $_GET['param'];
}

/* Classe de interação com o PostgreSQL */
require_once "../class/constantes.inc.php";

$rel_svc = new RelServico();
$pess_clti = new PessoalCLTI();

$pess_clti->idtb_lotacao_clti = $_SESSION['user_id'];
$aprovrel = $pess_clti->SelectTarefa();
$svc_sai = $pess_clti->SelectId();
$svc_entra = $pess_clti->SelectEscalaSV();
$pess_clti->ordena = 'ORDER BY idtb_posto_grad ASC';
$num_rel = $rel_svc->NumRel();

/* Carrega form para Novo Relatório */
if ($act == 'configrel') {
    echo "
	<div class=\"container-fluid\">
        <div class=\"row\">
            <main>
                <div id=\"form-cadastro\">
                    <form id=\"novotitulo\" action=\"?cmd=relservicov2&act=novotitulo\" method=\"post\"
                    enctype=\"multipart/form-data\">
                        <fieldset>
                            <legend>Novo Título para o Relatório</legend>
                            <div class=\"form-group\">
                                <label for=\"titulo\">Título:</label>
                                <input id=\"titulo\" class=\"form-control\" name=\"titulo\"
                                type=\"text\" value=\"\">
                            </div>
                            <div class=\"form-group\">
                                <label for=\"descricao\">Descrição:</label>
                                <input id=\"descricao\" class=\"form-control\" name=\"descricao\" type=\"text\"
                                    value=\"\">
                            </div>
                        <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Salvar\">
                    </form>
                </div>
            </main>
        </div>
    </div>";
}

if ($act == 'novotitulo'){
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $insert = $rel_svc->NovoTitulo($titulo,$descricao);
    if ($insert){ print("Registro incluído com sucesso"); }
}