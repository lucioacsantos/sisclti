<?php
/**
 * Admin
 * Gerenciamento de Admin
 * admin.class.php
 * 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/* Classe de interação com o PostgreSQL */
require_once "../class/pgsql.class.php";
$pg = new PgSql();

/* Recupera informações dos Admin */
$sql = "SELECT * FROM db_clti.tb_qualificacao_ti";

$row = $pg->getRow($sql);

@$act = $_GET['act'];

/* Formulário para NIP/CPF */
if (($row == '0') AND ($act == NULL)) {
    echo "
    <div class=\"container-fluid\">
        <div class=\"row\">
            <main>
                <div id=\"form-cadastro\">
                    <form id=\"nip_cpf\" role=\"form\" action=\"?cmd=cursosti&act=cad\" 
                    method=\"post\" enctype=\"multipart/form-data\">
                        <fieldset>
                        <legend>Qualificação em TI - Cadastro</legend>
                            <div class=\"form-group\">
                                <label for=\"nip_cpf\">Informe o NIP/CPF:</label>
                                <input id=\"nip_cpf\" class=\"form-control\" type=\"num\" name=\"nip_cpf\" 
                                    placeholder=\"NIP/CPF\" maxlength=\"11\" autofocus=\"true\" required=\"true\">
                            </div>
                        </fieldset>
                        <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Localizar\">
                    </form>
                </div>
            </main>
        </div>
    </div>";
}

/* Carrega form para cadastro de Admin */
if ($act == 'cad') {
    $nip_cpf = $_POST['nip_cpf'];
    @$param = $_GET['param'];

    if ($param){
        $qualiti = $pg->getRow("SELECT * FROM db_clti.vw_qualificacao_pesti WHERE idtb_qualificacao_ti = '$param' ");
    }
    else{
        $qualiti = $pg->getRow("SELECT * FROM db_clti.vw_pessoal_ti WHERE nip = '$nip_cpf' OR cpf = '$nip_cpf' ");
        if ($qualiti){
            $qualiti = (object)['idtb_pessoal_ti'=>$qualiti->idtb_pessoal_ti,'idtb_qualificacao_ti'=>'',
                'sigla_om'=>$qualiti->sigla_om,'sigla_posto_grad'=>$qualiti->sigla_posto_grad,
                'nome_guerra'=>$qualiti->nome_guerra,'instituicao'=>'','tipo'=>'','nome_curso'=>'','meio'=>'',
                'situacao'=>'','data_conclusao'=>NULL,'carga_horaria'=>'','custo'=>''];
         }
        else{
            echo "<h5>Não foi encontrado pessoal de TI com este NIP/CPF.</h5>
                <meta http-equiv=\"refresh\" content=\"3;?cmd=cursosti \">";
        }
    }

    echo "
	<div class=\"container-fluid\">
        <div class=\"row\">
            <main>
                <div id=\"form-cadastro\">
                    <form id=\"insereusuario\" role=\"form\" action=\"?cmd=cursosti&act=insert\" 
                        method=\"post\" enctype=\"multipart/form-data\">
                        <fieldset>";

                            echo"
                            <legend>Qualificação na Área de TI ($qualiti->sigla_posto_grad - $qualiti->nome_guerra - 
                                $qualiti->sigla_om)</legend>

                            <input id=\"idtb_pessoal_ti\" type=\"hidden\" name=\"idtb_pessoal_ti\" 
                                value=\"$qualiti->idtb_pessoal_ti\">
                            
                            <div class=\"form-group\">
                                <label for=\"instituicao\">Instituição de Ensino:</label>
                                <input id=\"instituicao\" class=\"form-control\" type=\"text\" name=\"instituicao\"
                                    placeholder=\"ex. Universidade Federal do RN\" minlength=\"2\" 
                                    style=\"text-transform:uppercase\" required=\"true\" autofocus=\"true\"
                                    value=\"$qualiti->instituicao\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"tipo\">Tipo do Curso:</label>
                                <select id=\"tipo\" class=\"form-control\" name=\"tipo\">
                                    <option value=\"$qualiti->tipo\" selected=\"true\">$qualiti->tipo</option>
                                    <option value=\"GRADUAÇÃO\">GRADUAÇÃO</option>
                                    <option value=\"BACHARELADO\">BACHARELADO</option>
                                    <option value=\"POSGRAD\">PÓS GRADUAÇÃO</option>
                                    <option value=\"MESTRADO\">MESTRADO</option>
                                    <option value=\"DOUTORADO\">DOUTORADO</option>
                                    <option value=\"TÉCNICO\">TÉCNICO</option>
                                    <option value=\"LIVRE\">LIVRE</option>
                                </select>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"nome_curso\">Nome do Curso:</label>
                                <input id=\"nome_curso\" class=\"form-control\" type=\"text\" name=\"nome_curso\"
                                    placeholder=\"ex. Análise de Sistemas\" minlength=\"2\"
                                    style=\"text-transform:uppercase\" required=\"true\" value=\"$qualiti->nome_curso\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"meio\">Modo do Curso:</label>
                                <select id=\"meio\" class=\"form-control\" name=\"meio\">
                                    <option value=\"$qualiti->meio\" selected=\"true\">$qualiti->meio</option>
                                    <option value=\"PRESENCIAL\">PRESENCIAL</option>
                                    <option value=\"SEMIPRESENCIAL\">SEMIPRESENCIAL</option>
                                    <option value=\"EAD\">EAD</option>
                                </select>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"situacao\">Situação:</label>
                                <select id=\"situacao\" class=\"form-control\" name=\"situacao\">
                                    <option value=\"$qualiti->situacao\" selected=\"true\">$qualiti->situacao</option>
                                    <option value=\"CONCLUIÍDO\">CONCLUÍDO</option>
                                    <option value=\"EM ANDAMENTO\">EM ANDAMENTO</option>
                                </select>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"data_conclusao\">Data de Conclusão:</label>
                                <input id=\"data_conclusao\" class=\"form-control\" type=\"date\" name=\"data_conclusao\" 
                                    value=\"$qualiti->data_conclusao\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"carga_horaria\" class=\"control-label\">Carga Horária:</label>
                                <input id=\"carga_horaria\" class=\"form-control\" type=\"number\" name=\"carga_horaria\"
                                    required=\"true\" value=\"$qualiti->carga_horaria\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"custo\" class=\"control-label\">Custo (Obrigatório se custeado pela OM):</label>
                                <input id=\"custo\" class=\"form-control\" type=\"number\" name=\"custo\"
                                    value=\"$qualiti->custo\">
                            </div>
                        </fieldset>
                        <input id=\"idtb_qualificacao_ti\" type=\"hidden\" name=\"idtb_qualificacao_ti\" 
                            value=\"$qualiti->idtb_qualificacao_ti\">
                        <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Salvar\">
                    </form>
                </div>
            </main>
        </div>
    </div>";
}

/* Monta quadro de administradores */
if (($row) AND ($act == NULL)) {

	$qualiti = "SELECT * FROM db_clti.vw_qualificacao_pesti ORDER BY idtb_pessoal_ti ASC";
    $qualiti = $pg->getRows($qualiti);

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
                        <th scope=\"col\">Ações</th>
                    </tr>
                </thead>";

    foreach ($qualiti as $key => $value) {

        #Seleciona NIP caso seja militar da MB
        if ($value->nip != NULL) {
            $identificacao = $value->nip;
        }
        else{
            $identificacao = $value->cpf;
        }

        echo"       <tr>
                        <th scope=\"row\">$value->sigla_posto_grad</th>
                        <td>$identificacao</td>
                        <td>$value->nome_guerra</td>
                        <td>$value->sigla_om</td>
                        <td>$value->tipo $value->nome_curso</td>
                        <td>$value->situacao</td>
                        <td><a href=\"?cmd=admin&act=cad&param=".$value->idtb_qualificacao_ti."\">Editar</a> - 
                            Excluir</td>
                    </tr>";
    }
    echo"
                </tbody>
            </table>
            </div>";
}

/* Método INSERT */
if ($act == 'insert') {
    if (isset($_SESSION['status'])){
        $idtb_qualificacao_ti = $_POST['idtb_qualificacao_ti'];
        $idtb_pessoal_ti = $_POST['idtb_pessoal_ti'];
        $instituicao = strtoupper($_POST['instituicao']);
        $tipo = strtoupper($_POST['tipo']);
        $nome_curso = strtoupper($_POST['nome_curso']);
        $meio = strtoupper($_POST['meio']);
        $situacao = strtoupper($_POST['situacao']);
        $data_conclusao = $_POST['data_conclusao'];
        $carga_horaria = $_POST['carga_horaria'];
        $custo = $_POST['custo'];

        if ($data_conclusao == NULL) {
            $data_conclusao = 'NULL';
        }

        /* Opta pelo Método Update */
        if ($idtb_qualificacao_ti){

            $sql = "UPDATE db_clti.tb_qualificacao_ti SET
                idtb_pessoal_ti='$idtb_pessoal_ti',instituicao='$instituicao', tipo='$tipo', nome_curso='$nome_curso', 
                meio='$meio', situacao='$situacao', data_conclusao='$data_conclusao', 
                carga_horaria='$carga_horaria', custo='$custo'
                WHERE idtb_qualificacao_ti='$idtb_qualificacao_ti'";

            $pg->exec($sql);

            if ($pg) {
                echo "<h5>Resgistros incluídos no banco de dados.</h5>
                <meta http-equiv=\"refresh\" content=\"1;?cmd=cursosti\">";
            }

            else {
                echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
                echo(pg_result_error($pg) . "<br />\n");
            }
        }

        /* Opta pelo Método Insert */
        else{

            $sql = "INSERT INTO db_clti.tb_qualificacao_ti(
                    idtb_pessoal_ti, instituicao, tipo, nome_curso, meio, situacao, 
                    data_conclusao, carga_horaria, custo)
                VALUES ('$idtb_pessoal_ti', '$instituicao', '$tipo', '$nome_curso',
                    '$meio', '$situacao', $data_conclusao, '$carga_horaria', '$custo')";
            print $sql;
            $pg->exec($sql);

            if ($pg) {
                echo "<h5>Resgistros incluídos no banco de dados.</h5>
                <meta http-equiv=\"refresh\" content=\"1;?cmd=cursosti\">";
            }

            else {
                echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
                echo(pg_result_error($pg) . "<br />\n");
            }
        }
    }
    else{
        echo "<h5>Ocorreu algum erro, usuário não autenticado.</h5>
            <meta http-equiv=\"refresh\" content=\"1;$url\">";
    }
    
}

?>