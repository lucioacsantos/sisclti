<?php
/**
 * OMApoiadas
 * Operações relacionadas às OM Apoiadas
 * omapoiadas.class.php
 * 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/* Classe de interação com o PostgreSQL */
require_once "../class/pgsql.class.php";
$pg = new PgSql();

/* Recupera informações do tipo das OM Apoiadas */
$sql = "SELECT * FROM db_clti.tb_om_apoiadas";

$row = $pg->getRow($sql);

@$act = $_GET['act'];

/* Checa se há OM cadastradas */
if (($row == '0') AND ($act == NULL)) {
	echo "<h5>Não há OM Apoiadas cadastradas neste CLTI,<br />
		 clique <a href=\"?cmd=omapoiadas&act=cad\">aqui</a> para fazê-lo.</h5>";
}

/* Carrega form para cadastro de OM */
if ($act == 'cad') {
    @$param = $_GET['param'];
    if ($param){
        $om = $pg->getRow("SELECT * FROM db_clti.tb_om_apoiadas WHERE idtb_om_apoiadas = '$param'");
        $estado = $pg->getRow("SELECT * FROM db_clti.tb_estado WHERE id = '$om->id_estado'");
        $cidade = $pg->getRow("SELECT * FROM db_clti.tb_cidade WHERE id = '$om->id_cidade'");
    }
    else{
        $ESTADO = $pg->getCol("SELECT valor FROM db_clti.tb_config WHERE parametro='ESTADO'");
        $CIDADE = $pg->getCol("SELECT valor FROM db_clti.tb_config WHERE parametro='CIDADE'");
        $om = (object)['idtb_om_apoiadas'=>'','cod_om'=>'','nome'=>'','sigla'=>'','indicativo'=>''];
        $estado = (object)['uf'=>$ESTADO];
        $cidade = (object)['nome'=>$CIDADE];
    }
    
	echo "
	<div class=\"container-fluid\">
        <div class=\"row\">
            <main>
                <div id=\"form-cadastro\">
                    <form id=\"insertom\" action=\"?cmd=omapoiadas&act=insert\" method=\"post\" enctype=\"multipart/form-data\">
                        <fieldset>
                            <legend>OM Apoiadas pelo CLTI - Cadastro</legend>

                            <div class=\"form-group\">
                                <label for=\"estado\">Selecione o Estado:</label>
                                <select id=\"estado\" class=\"form-control\" name=\"estado\" value=\"$estado->uf\"></select>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"cidade\">Selecione a Cidade:</label>
                                <select id=\"cidade\" class=\"form-control\" name=\"cidade\" value=\"$cidade->nome\"></select>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"cod_om\">Código da OM:</label>
                                <input id=\"cod_om\" class=\"form-control\" type=\"number\" name=\"cod_om\"
                                       placeholder=\"Código da OM\" maxlength=\"8\" required=\"required\" 
                                       value=\"$om->cod_om\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"nome\">Nome da OM:</label>
                                <input id=\"nome\" class=\"form-control\" type=\"text\" name=\"nome\"
                                       style=\"text-transform:uppercase\" placeholder=\"Nome da OM\" 
                                       minlength=\"2\" required=\"required\" value=\"$om->nome\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"sigla\">Sigla da OM:</label>
                                <input id=\"sigla\" class=\"form-control\" type=\"text\" name=\"sigla\"
                                       style=\"text-transform:uppercase\" placeholder=\"Sigla da OM\" 
                                       minlength=\"2\" required=\"required\" value=\"$om->sigla\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"indicativo\">Indicativo Naval da OM:</label>
                                <input id=\"indicativo\" class=\"form-control\" type=\"text\" name=\"indicativo\"
                                       style=\"text-transform:uppercase\" placeholder=\"Indicativo Naval da OM\" 
                                       maxlength=\"6\" required=\"required\" value=\"$om->indicativo\">
                            </div>

                        </fieldset>
                        <input id=\"idtb_om_apoiadas\" type=\"hidden\" name=\"idtb_om_apoiadas\" value=\"$om->idtb_om_apoiadas\">
                        <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Salvar\">
                    </form>
                </div>
            </main>
        </div>
    </div>";
}

/* Monta quadro de OM */
if (($row) AND ($act == NULL)) {

    echo"<div class=\"table-responsive\">
            <table class=\"table table-hover\">
                <thead>
                    <tr>
                        <th scope=\"col\">Código</th>
                        <th scope=\"col\">Nome</th>
                        <th scope=\"col\">Sigla</th>
                        <th scope=\"col\">Ind. Naval</th>
                        <th scope=\"col\">Ações</th>
                    </tr>
                </thead>";

    $om = "SELECT * FROM db_clti.tb_om_apoiadas ORDER BY cod_om ASC";
    $om = $pg->getRows($om);    

	echo "<!--<p>Distribuição de OM por  ".$pg->getCol("SELECT COUNT(id_estado) 
    	    FROM (SELECT id_estado FROM db_clti.tb_om_apoiadas 
            GROUP BY id_estado) AS vw;;")." Estados </p>-->";
    foreach ($om as $key => $value) {
        echo"       <tr>
                        <th scope=\"row\">".$value->cod_om."</th>
                        <td>".$value->nome."</td>
                        <td>".$value->sigla."</td>
                        <td>".$value->indicativo."</td>
                        <td><a href=\"?cmd=omapoiadas&act=cad&param=".$value->idtb_om_apoiadas."\">Editar</a> - 
                            Excluir</td>
                    </tr>";
    };
    echo"
                </tbody>
            </table>
            </div>";
}

/* Método INSERT / UPDATE */
if ($act == 'insert') {
    $idtb_om_apoiadas = $_POST['idtb_om_apoiadas'];
	$estado = $_POST['estado'];
	$cidade = $_POST['cidade'];
	$cod_om = $_POST['cod_om'];
	$nome = strtoupper($_POST['nome']);
    $sigla = strtoupper($_POST['sigla']);
    $indicativo = strtoupper($_POST['indicativo']);

    $sql = "SELECT id FROM db_clti.tb_estado WHERE uf = '$estado' ";
    $estado = $pg->getCol($sql);

    $sql = "SELECT id FROM db_clti.tb_cidade WHERE nome = '$cidade' ";
    $cidade = $pg->getCol($sql);

    # Opta pelo método UPDATE
    if ($idtb_om_apoiadas){
        $sql = "UPDATE db_clti.tb_om_apoiadas SET 
                id_estado=$estado, id_cidade=$cidade, cod_om=$cod_om, nome='$nome', 
                sigla='$sigla', indicativo='$indicativo'
            WHERE idtb_om_apoiadas=$idtb_om_apoiadas";
    }

    # Opta pelo método INSERT
    else{
        $sql = "INSERT INTO db_clti.tb_om_apoiadas(
                id_estado, id_cidade, cod_om, 
                nome, sigla, indicativo)
    	    VALUES ('$estado', '$cidade', '$cod_om', 
	    	    '$nome', '$sigla', '$indicativo')";
    }
    
	$pg->exec($sql);

	if ($pg) {
		echo "<h5>Resgistros incluídos no banco de dados.</h5>
            <meta http-equiv=\"refresh\" content=\"1;url=?cmd=omapoiadas\">";
	}

	else {
		echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
        echo(pg_result_error($pg) . "<br />\n");
	}
}

?>