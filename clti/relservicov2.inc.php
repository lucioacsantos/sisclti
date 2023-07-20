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
    $configrel = $rel_svc->SelectConfigRel();
    $titulos = $rel_svc->SelectTitulos();
    $subtitulos = $rel_svc->SelectSubtitulos();
    $itens = $rel_svc->SelectItens();
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

    echo "
	<div class=\"container-fluid\">
        <div class=\"row\">
            <main>
                <div id=\"form-cadastro\">
                    <form id=\"novosubtitulo\" action=\"?cmd=relservicov2&act=novosubtitulo\" method=\"post\"
                    enctype=\"multipart/form-data\">
                        <fieldset>
                            <legend>Novo Subtítulo para o Relatório</legend>
                            <div class=\"form-group\">
                                <label for=\"idtb_titulos_rel_sv_v2\">Título:</label>
                                <select id=\"idtb_titulos_rel_sv_v2\" class=\"form-control\" name=\"idtb_titulos_rel_sv_v2\">";
                                            foreach ($titulos as $key => $value) {
                                                echo"<option value=\"".$value->idtb_titulos_rel_sv_v2."\">
                                                    ".$value->titulo."</option>";
                                            }
                                        echo "</select>
                            </div>
                            <div class=\"form-group\">
                                <label for=\"subtitulo\">Subtítulo:</label>
                                <input id=\"subtitulo\" class=\"form-control\" name=\"subtitulo\"
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

    echo "
	<div class=\"container-fluid\">
        <div class=\"row\">
            <main>
                <div id=\"form-cadastro\">
                    <form id=\"novoitem\" action=\"?cmd=relservicov2&act=novoitem\" method=\"post\"
                    enctype=\"multipart/form-data\">
                        <fieldset>
                            <legend>Novo Item para o Relatório</legend>
                            <div class=\"form-group\">
                                <label for=\"idtb_subtitulos_rel_sv_v2\">Subtítulo:</label>
                                <select id=\"idtb_subtitulos_rel_sv_v2\" class=\"form-control\" name=\"idtb_subtitulos_rel_sv_v2\">";
                                            foreach ($subtitulos as $key => $value) {
                                                echo"<option value=\"".$value->idtb_subtitulos_rel_sv_v2."\">
                                                    ".$value->subtitulo."</option>";
                                            }
                                        echo "</select>
                            </div>
                            <div class=\"form-group\">
                                <label for=\"item\">Item:</label>
                                <input id=\"item\" class=\"form-control\" name=\"item\"
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
    if ($insert){ print "Registro incluído com sucesso"; echo "<meta http-equiv=\"refresh\" content=\"1;url=?cmd=relservicov2&act=configrel\">"; }
}

if ($act == 'novosubtitulo'){
    $subtitulo = $_POST['subtitulo'];
    $descricao = $_POST['descricao'];
    $idtb_titulos_rel_sv_v2 = $_POST['idtb_titulos_rel_sv_v2'];
    $insert = $rel_svc->NovoSubtitulo($idtb_titulos_rel_sv_v2,$subtitulo,$descricao);
    if ($insert){ print "Registro incluído com sucesso"; echo "<meta http-equiv=\"refresh\" content=\"1;url=?cmd=relservicov2&act=configrel\">"; }
}