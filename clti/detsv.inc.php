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
$pesclti = new PessoalCLTI();
$relsv = new RelServico();

/* Recupera informações */
$row = $pesclti->SelectALL();

/* Carrega form para Novo Relatório */
if ($act == 'cad') {
    @$param = $_GET['param'];
    if ($param){
        //idtb_det_serv sup_servico data_entra_servico data_sai_servico status
        $relsv->idtb_det_serv = $param;
        $servico = $relsv->SelectIdDetSv();
    }
    else{
        $relatorio = (object)['idtb_det_serv'=>'','sup_servico'=>'','data_entra_servico'=>'',
            'data_sai_servico'=>'','status'=>'PROGRAMADO'];
    }
    
	echo "
	<div class=\"container-fluid\">
        <div class=\"row\">
            <main>
                <div id=\"form-cadastro\">
                    <form id=\"insertom\" action=\"?cmd=relservico&act=insert\" method=\"post\" enctype=\"multipart/form-data\">
                        <fieldset>
                            <legend>Relatório de Serviço Nº $num_rel - Supervisor de Serviço: $svc_sai->sigla_posto_grad $svc_sai->nome_guerra</legend>
                            <div class=\"form-group\">
                                <label for=\"data_entra_servico\">Serviço do dia:</label>
                                <input id=\"data_entra_servico\" class=\"form-control\" name=\"data_entra_servico\" type=\"date\" 
                                    value=\"$relatorio->data_entra_servico\">
                            </div>
                            <div class=\"form-group\">
                                <label for=\"data_sai_servico\">Para o dia:</label>
                                <input id=\"data_sai_servico\" class=\"form-control\" name=\"data_sai_servico\" type=\"date\"
                                    value=\"$relatorio->data_sai_servico\">
                            </div>
                            <div class=\"form-group\">
                                <label for=\"sup_entra_servico\">Supervisor que entra:</label>
                                <select id=\"sup_entra_servico\" class=\"form-control\" name=\"sup_entra_servico\">
                                        <option value=\"$relatorio->sup_entra_servico\" selected>
                                            ".$svc_atual->sigla_posto_grad." - ".$svc_atual->nome_guerra."</option>";
                                            foreach ($svc_entra as $key => $value) {
                                                echo"<option value=\"".$value->idtb_lotacao_clti."\">
                                                    ".$value->sigla_posto_grad." - ".$value->nome_guerra."</option>";
                                            };
                                        echo "</select>
                            </div>
                            <div class=\"form-group\">
                                <label for=\"sit_servidores\">Situação dos servidores:</label>
                                <select id=\"sit_servidores\" class=\"form-control\" name=\"sit_servidores\">
                                    <option value=\"Operando normalmente\">Operando normalmente</option>
                                    <option value=\"Com observações\">Com observações</option>
                                </select>
                            </div>
                            <div class=\"form-group\">
                                <label for=\"sit_backup\">Rotina de backup:</label>
                                <select id=\"sit_backup\" class=\"form-control\" name=\"sit_backup\">
                                    <option value=\"Executado normalmente\">Executado normalmente</option>
                                    <option value=\"Com observações\">Com observações</option>
                                </select>
                            </div>
                            <div class=\"form-group\">
                                <label for=\"cel_funcional\">Celular funcional:</label>
                                <select id=\"cel_funcional\" class=\"form-control\" name=\"cel_funcional\">
                                    <option value=\"Funcionando normalmente\">Funcionando normalmente</option>
                                    <option value=\"Com observações\">Com observações</option>
                                </select>
                            </div>
                        </fieldset>
                        <input id=\"sup_sai_servico\" name=\"sup_sai_servico\" value=\"$svc_sai->idtb_lotacao_clti\" type=\"hidden\">
                        <input id=\"idtb_rel_servico\" name=\"idtb_rel_servico\" value=\"$relatorio->idtb_rel_servico\" type=\"hidden\">
                        <input id=\"num_rel\" name=\"num_rel\" value=\"$num_rel\" type=\"hidden\">
                        <input id=\"status\" name=\"status\" value=\"Em andamento\" type=\"hidden\">
                        <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Salvar\">
                    </form>
                </div>
            </main>
        </div>
    </div>";
}




?>