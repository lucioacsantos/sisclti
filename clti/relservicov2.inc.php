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

/* Monta quadro de Relatórios em Andamento */
if ($act == null) {

    echo"
        <div class=\"table-responsive\">
            <table class=\"table table-hover\">
                <thead>
                    <tr>
                        <th scope=\"col\">Número</th>
                        <th scope=\"col\">Serviço do dia:</th>
                        <th scope=\"col\">Para o dia:</th>
                        <th scope=\"col\">Sup. que sai:</th>
                        <th scope=\"col\">Sup. que entra:</th>
                        <th scope=\"row\">Mídia de Backup Nº</th>
                        <th scope=\"col\">Ações</th>
                    </tr>
                </thead>";

    $rel_andamento = $rel_svc->SelectEmAndamento();

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
    echo"
                </tbody>
            </table>
        </div>";
}

/* Carrega form para Configurações do Relatório */
if ($act == 'configrel') {
    $configrel = $rel_svc->SelectConfigRel();
    $titulos = $rel_svc->SelectTitulos();
    $subtitulos = $rel_svc->SelectAllSubtitulos();
    $itens = $rel_svc->SelectItens();
    echo "
	<div class=\"container-fluid\">
        <div class=\"row\">
            <div class=\"col-3\">
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
            <div class=\"col\">
                <main>
                    <div class=\"table-responsive\">
                        <table class=\"table table-hover\">
                            <thead>
                                <tr>
                                    <th scope=\"col\">Título</th>
                                    <th scope=\"col\">Descrição</th>
                                    <th scope=\"col\">Ações</th>
                                </tr>
                            </thead>";
                    
                            foreach ($titulos as $key => $value) {
                                echo"
                                <tr>
                                    <td>$value->titulo</td>
                                    <td>$value->descricao</td>
                                    <td><a href=\"?cmd=relservicov2&act=edittitulo&param=".$value->idtb_titulos_rel_sv_v2."\">Editar</a></td>
                                </tr>";
                            }
                        echo"
                        </table>
                    </div>
                </main>
            </div>
        </div>
    </div>";

    echo "
	<div class=\"container-fluid\">
        <div class=\"row\">
            <div class=\"col-3\">
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
            <div class=\"col\">
                <main>
                    <div class=\"table-responsive\">
                        <table class=\"table table-hover\">
                            <thead>
                                <tr>
                                    <th scope=\"col\">Subtítulo</th>
                                    <th scope=\"col\">Descrição</th>
                                    <th scope=\"col\">Ações</th>
                                </tr>
                            </thead>";
                    
                            foreach ($subtitulos as $key => $value) {
                                echo"
                                <tr>
                                    <td>$value->subtitulo</td>
                                    <td>$value->descricao</td>
                                    <td><a href=\"?cmd=relservicov2&act=editsubtitulo&param=".$value->idtb_subtitulos_rel_sv_v2."\">Editar</a></td>
                                </tr>";
                            }
                        echo"
                        </table>
                    </div>
                </main>
            </div>
        </div>
    </div>";

    echo "
	<div class=\"container-fluid\">
        <div class=\"row\">
            <div class=\"col-3\">
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
                                <div class=\"form-group\">
                                    <label for=\"valores\">Valores:</label>
                                    <input id=\"valores\" class=\"form-control\" name=\"valores\" type=\"text\"
                                        value=\"\">
                                </div>
                            <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Salvar\">
                        </form>
                    </div>
                </main>
            </div>
            <div class=\"col\">
                <main>
                    <div class=\"table-responsive\">
                        <table class=\"table table-hover\">
                            <thead>
                                <tr>
                                    <th scope=\"col\">Item</th>
                                    <th scope=\"col\">Descrição</th>
                                    <th scope=\"col\">Valores</th>
                                    <th scope=\"col\">Ações</th>
                                </tr>
                            </thead>";
                    
                            foreach ($itens as $key => $value) {
                                echo"
                                <tr>
                                    <td>$value->item</td>
                                    <td>$value->descricao</td>
                                    <td>$value->valores</td>
                                    <td><a href=\"?cmd=relservicov2&act=edititem&param=".$value->idtb_itens_rel_sv_v2."\">Editar</a></td>
                                </tr>";
                            }
                        echo"
                        </table>
                    </div>
                </main>
            </div>
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

if ($act == 'novoitem'){
    $item = $_POST['item'];
    $descricao = $_POST['descricao'];
    $valores = $_POST['valores'];
    $idtb_subtitulos_rel_sv_v2 = $_POST['idtb_subtitulos_rel_sv_v2'];
    $insert = $rel_svc->NovoItem($idtb_subtitulos_rel_sv_v2,$item,$descricao,$valores);
    if ($insert){ print "Registro incluído com sucesso"; echo "<meta http-equiv=\"refresh\" content=\"1;url=?cmd=relservicov2&act=configrel\">"; }
}