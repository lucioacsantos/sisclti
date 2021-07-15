<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/* Classe de interação com o PostgreSQL */
require_once "../class/constantes.inc.php";

$rel_svc = new RelServico();
$pess_clti = new PessoalCLTI();

$pess_clti->idtb_lotacao_clti = $_SESSION['user_id'];
$svc_sai = $pess_clti->SelectId();
$svc_entra = $pess_clti->SelectALL();
$num_rel = $rel_svc->NumRel();

@$act = $_GET['act'];

/* Carrega form para Novo Relatório */
if ($act == 'cad') {
    @$param = $_GET['param'];
    if ($param){
        $rel_svc->idtb_rel_servico = $param;
        $svc_atual = $pess_clti->SelectId();
        $relatorio = $rel_svc->SelectId();
        $num_rel = $relatorio->num_rel;
    }
    else{
        $relatorio = (object)['idtb_rel_servico'=>'','sup_sai_servico'=>'','sup_entra_servico'=>'','data_entra_servico'=>'',
            'data_sai_servico'=>'','cel_funcional'=>'','sit_backup'=>'','status'=>'Em andamento'];
        $svc_atual = (object)['sigla_posto_grad'=>'','nome_guerra'=>''];
        $num_rel = $rel_svc->NumRel();
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

/* Monta quadro de Relatórios em Andamento */
if ($act == NULL) {

    echo"<div class=\"table-responsive\">
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

    $rel_andamento = $rel_svc->SelectEmAndamento();

    foreach ($rel_andamento as $key => $value) {
        $pess_clti->idtb_lotacao_clti = $value->sup_sai_servico;
        $sup_sai = $pess_clti->SelectId();
        $pess_clti->idtb_lotacao_clti = $value->sup_entra_servico;
        $sup_entra = $pess_clti->SelectId();
        echo"       <tr>
                        <th scope=\"row\">".$value->num_rel."</th>
                        <td>".$value->data_entra_servico."</td>
                        <td>".$value->data_sai_servico."</td>
                        <td>".$sup_sai->sigla_posto_grad." - ".$sup_sai->nome_guerra."</td>
                        <td>".$sup_entra->sigla_posto_grad." - ".$sup_entra->nome_guerra."</td>
                        <td><a href=\"?cmd=relservico&act=cad&param=".$value->idtb_rel_servico."\">Editar</a> - 
                            <a href=\"?cmd=relservico&act=reg_ocorrencia&param=".$value->idtb_rel_servico."\">Registrar ocorrência</a> - 
                            <a href=\"?cmd=relservico&act=ocorrencias&param=".$value->num_rel."\">Ocorrências</a> - 
                            <a href=\"?cmd=relservico&act=encerrar&param=".$value->idtb_rel_servico."\">Encerrar relatório</a></td>
                    </tr>";
    };
    echo"
                </tbody>
            </table>
            </div>";
}

/* Monta quadro de Relatórios Encerrados */
if ($act == 'encerrados') {

    echo"<div class=\"table-responsive\">
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

    $rel_encerrados = $rel_svc->SelectEncerrados();

    foreach ($rel_encerrados as $key => $value) {
        $pess_clti->idtb_lotacao_clti = $value->sup_sai_servico;
        $sup_sai = $pess_clti->SelectId();
        $pess_clti->idtb_lotacao_clti = $value->sup_entra_servico;
        $sup_entra = $pess_clti->SelectId();
        echo"       <tr>
                        <th scope=\"row\">".$value->num_rel."</th>
                        <td>".$value->data_entra_servico."</td>
                        <td>".$value->data_sai_servico."</td>
                        <td>".$sup_sai->sigla_posto_grad." - ".$sup_sai->nome_guerra."</td>
                        <td>".$sup_entra->sigla_posto_grad." - ".$sup_entra->nome_guerra."</td>
                        <td><a href=\"?cmd=relservico&act=ocorrencias&param=".$value->num_rel."\">Ocorrências</a></td>
                    </tr>";
    };
    echo"
                </tbody>
            </table>
            </div>";
}

/* Método INSERT / UPDATE */
if ($act == 'insert') {
    if (isset($_SESSION['status'])){
        $idtb_rel_servico = $_POST['idtb_rel_servico'];
        $rel_svc->idtb_rel_servico = $_POST['idtb_rel_servico'];
        $rel_svc->sup_sai_servico = $_POST['sup_sai_servico'];
        $rel_svc->sup_entra_servico = $_POST['sup_entra_servico'];
        $rel_svc->num_rel = $_POST['num_rel'];
        $rel_svc->data_entra_servico = $_POST['data_entra_servico'];
        $rel_svc->data_sai_servico = $_POST['data_sai_servico'];
        $rel_svc->cel_funcional = $_POST['cel_funcional'];
        $rel_svc->sit_servidores = $_POST['sit_servidores'];
        $rel_svc->sit_backup = $_POST['sit_backup'];
        $rel_svc->status = $_POST['status'];

        # Opta pelo método UPDATE
        if ($idtb_rel_servico){
            $row = $rel_svc->Update();
            if ($row) {
                echo "<h5>Resgistros incluídos no banco de dados.</h5>
                    <meta http-equiv=\"refresh\" content=\"1;url=?cmd=relservico\">";
            }    
            else {
                echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
                echo(pg_result_error($row) . "<br />\n");
            }
        }
        # Opta pelo método INSERT
        else{
            $row = $rel_svc->SelectEmAndamento();
            if ($row){
                echo "<h5>Existem relatórios com status 'Em andamento'. É necessário Fechá-lo!</h5>
                        <div class=\"table-responsive\">
                        <table class=\"table table-hover\">
                        <thead>
                            <tr>
                                <th scope=\"col\">Número</th>
                                <th scope=\"col\">Serviço do dia:</th>
                                <th scope=\"col\">Para o dia:</th>
                                <th scope=\"col\">Sup. que sai:</th>
                                <th scope=\"col\">Sup. que entra:</th>
                            </tr>
                        </thead>";
                foreach ($row as $key => $value) {
                    $pess_clti->idtb_lotacao_clti = $value->sup_sai_servico;
                    $sup_sai = $pess_clti->SelectId();
                    $pess_clti->idtb_lotacao_clti = $value->sup_entra_servico;
                    $sup_entra = $pess_clti->SelectId();
                    echo"   <tr>
                                <th scope=\"row\">".$value->num_rel."</th>
                                <td>".$value->data_entra_servico."</td>
                                <td>".$value->data_sai_servico."</td>
                                <td>".$sup_sai->sigla_posto_grad." - ".$sup_sai->nome_guerra."</td>
                                <td>".$sup_entra->sigla_posto_grad." - ".$sup_sai->nome_guerra."</td>
                            </tr>";
                    };
                    echo"
                        </tbody>
                    </table>
                    </div>";
            }
            else{
                $row = $rel_svc->Insert();
                if ($row) {
                    echo "<h5>Resgistros incluídos no banco de dados.</h5>
                        <meta http-equiv=\"refresh\" content=\"1;url=?cmd=relservico\">";
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

/** Form Registrar Ocorrência */
if ($act == 'reg_ocorrencia') {
    if (isset($_SESSION['status'])){
        @$idtb_rel_servico = $_GET['param'];
        @$idtb_rel_servico_ocorrencias = $_GET['param2'];
        if ($idtb_rel_servico_ocorrencias){
            $rel_svc->idtb_rel_servico_ocorrencias = $idtb_rel_servico_ocorrencias;
            $ocorrencia = $rel_svc->SelectOcorrenciaId();
        }
        else {
            $rel_svc->idtb_rel_servico = $idtb_rel_servico;
            $ocorrencia = $rel_svc->SelectId();
        }
        
        echo "
        <div class=\"container-fluid\">
            <div class=\"row\">
                <main>
                    <div id=\"form-cadastro\">
                        <form id=\"insertom\" action=\"?cmd=relservico&act=insert_ocorrencia\" method=\"post\" enctype=\"multipart/form-data\">
                            <fieldset>
                                <legend>Relatório de Serviço nº $ocorrencia->num_rel - Registro de Ocorrências</legend>
                                <div class=\"form-group\">
                                    <label for=\"num_rel\">Número do Relatório:</label>
                                    <input id=\"num_rel\" class=\"form-control\" name=\"num_rel\" value=\"$ocorrencia->num_rel\" readonly>
                                </div>
                                <div class=\"form-group\">
                                    <label for=\"ocorrencia\">Ocorrência:</label>
                                </div>
                                <div class=\"form-group\">
                                    <textarea id=\"ocorrencia\" name=\"ocorrencia\" rows=\"10\" cols=\"60\">".@$ocorrencia->ocorrencia."</textarea>
                                </div>
                            </fieldset>
                            <input id=\"status\" name=\"status\" value=\"$ocorrencia->status\" type=\"hidden\">
                            <input id=\"idtb_rel_servico_ocorrencias\" name=\"idtb_rel_servico_ocorrencias\" value=\"$idtb_rel_servico_ocorrencias\" 
                                type=\"hidden\">
                            <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Salvar\">
                        </form>
                    </div>
                </main>
            </div>
        </div>";
    }
}

/* Monta quadro de Ocorrências em Andamento */
if ($act == 'ocorrencias') {

    echo"<div class=\"table-responsive\">
            <table class=\"table table-hover\">
                <thead>
                    <tr>
                        <th scope=\"col\">Número do Relatório</th>
                        <th scope=\"col\">Ocorrência:</th>
                        <th scope=\"col\">Situação:</th>
                        <th scope=\"col\">Ações</th>
                    </tr>
                </thead>";

    $num_rel = $_GET['param'];
    $rel_svc->num_rel = $num_rel;
    $ocorrencias = $rel_svc->SelectOcorrenciaNumRel();

    foreach ($ocorrencias as $key => $value) {
        echo"       <tr>
                        <th scope=\"row\">".$value->num_rel."</th>
                        <td>".$value->ocorrencia."</td>
                        <td>".$value->status."</td>";
                    if ($value->status == 'Encerrado'){
                        echo "<td></td>";
                    }
                    else{
                        echo"<td><a href=\"?cmd=relservico&act=reg_ocorrencia&param2=".$value->idtb_rel_servico_ocorrencias."\">Editar</a></td>";
                    }
                    echo"</tr>";
    };
    echo"
                </tbody>
            </table>
            </div>";
}

/** Inserir/Atualizar Ocorrencia */
if ($act == 'insert_ocorrencia') {
    if (isset($_SESSION['status'])){
        $idtb_rel_servico_ocorrencias = $_POST['idtb_rel_servico_ocorrencias'];
        $rel_svc->idtb_rel_servico_ocorrencias = $_POST['idtb_rel_servico_ocorrencias'];
        $rel_svc->num_rel = $_POST['num_rel'];
        $rel_svc->ocorrencia = $_POST['ocorrencia'];
        $rel_svc->status = $_POST['status'];

        # Opta pelo método UPDATE
        if ($idtb_rel_servico_ocorrencias){
            $row = $rel_svc->UpdateOcorrencia();
            if ($row) {
                echo "<h5>Resgistros incluídos no banco de dados.</h5>
                    <meta http-equiv=\"refresh\" content=\"1;url=?cmd=relservico\">";
            }    
            else {
                echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
                echo(pg_result_error($row) . "<br />\n");
            }
        }
        # Opta pelo método INSERT
        else{
            $row = $rel_svc->InsertOcorrencia();
            if ($row) {
                echo "<h5>Resgistros incluídos no banco de dados.</h5>
                    <meta http-equiv=\"refresh\" content=\"1;url=?cmd=relservico\">";
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

/** Finalizar Relatório */
if ($act == 'encerrar') {
    if (isset($_SESSION['status'])){
        $rel_svc->idtb_rel_servico = $_GET['param'];
        $rel_svc->status = 'Encerrado';
        $num_rel = $rel_svc->SelectId();
        $rel_svc->num_rel = $num_rel->num_rel;

        $row = $rel_svc->AtualizaStatus();
        if ($row) {
            echo "<h5>Resgistros incluídos no banco de dados.</h5>
                <meta http-equiv=\"refresh\" content=\"1;url=?cmd=relservico\">";
        }    
        else {
            echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
            echo(pg_result_error($row) . "<br />\n");
        }
    }
    else{
        echo "<h5>Ocorreu algum erro, usuário não autenticado.</h5>
            <meta http-equiv=\"refresh\" content=\"1;$url\">";
    }
}

?>