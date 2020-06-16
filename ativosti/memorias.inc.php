<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/* Classe de interação com o PostgreSQL */
require_once "../class/pgsql.class.php";
$pg = new PgSql();

/* Recupera informações dos Admin */
$sql = "SELECT * FROM db_clti.tb_memorias";

$row = $pg->getRow($sql);

@$act = $_GET['act'];

/* Checa se há SO cadastrado */
if (($row == '0') AND ($act == NULL)) {
	echo "<h5>Não há Memórias cadastradas,<br />
		 clique <a href=\"?cmd=memorias&act=cad\">aqui</a> para fazê-lo.</h5>";
}

/* Carrega form para cadastro de Fabricante */
if ($act == 'cad') {
    @$param = $_GET['param'];
    if ($param){
        $memorias = $pg->getRow("SELECT * FROM db_clti.tb_memorias WHERE idtb_memorias = '$param'");
    }
    else{
        $memorias = (object)['idtb_memorias'=>'','tipo'=>'', 'modelo'=>'','clock'=>''];
    }
    echo "
	<div class=\"container-fluid\">
        <div class=\"row\">
            <main>
                <div id=\"form-cadastro\">
                    <form id=\"memorias\" role=\"form\" action=\"?cmd=memorias&act=insert\" 
                        method=\"post\" enctype=\"multipart/form-data\">
                        <fieldset>
                            <legend>Memórias - Cadastro</legend>

                            <div class=\"form-group\">
                                <label for=\"tipo\">Tipo:</label>
                                <input id=\"tipo\" class=\"form-control\" type=\"text\" name=\"tipo\"
                                       placeholder=\"ex. DDR3\" style=\"text-transform:uppercase\" 
                                       required=\"true\" value=\"$memorias->tipo\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"modelo\">Modelo:</label>
                                <input id=\"modelo\" class=\"form-control\" type=\"text\" name=\"modelo\"
                                       placeholder=\"ex. PC4200\" style=\"text-transform:uppercase\" 
                                       required=\"true\" value=\"$memorias->modelo\">
                            </div>

                            <div class=\"form-group\">
                                <label for=\"clock\">Clock Mhz:</label>
                                <input id=\"clock\" class=\"form-control\" type=\"number\" name=\"clock\"
                                       placeholder=\"ex. 533\" required=\"true\" value=\"$memorias->clock\">
                            </div>

                        </fieldset>
                        <input type=\"hidden\" name=\"idtb_memorias\" value=\"$memorias->idtb_memorias\">
                        <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Salvar\">
                    </form>
                </div>
            </main>
        </div>
    </div>";
}

/* Monta quadro de memórias */
if (($row) AND ($act == NULL)) {

    echo"<div class=\"table-responsive\">
            <table class=\"table table-hover\">
                <thead>
                    <tr>
                        <th scope=\"col\">Tipo</th>
                        <th scope=\"col\">Modelo</th>
                        <th scope=\"col\">Clock</th>
                        <th scope=\"col\">Ações</th>
                    </tr>
                </thead>";

    $proc = "SELECT * FROM db_clti.tb_memorias ";
    $proc = $pg->getRows($proc);
    foreach ($proc as $key => $value) {
        echo"       <tr>
                        <th scope=\"row\">".$value->tipo."</th>
                        <td>".$value->modelo."</td>
                        <td>".$value->clock."</td>
                        <td><a href=\"?cmd=memorias&act=cad&param=".$value->idtb_memorias."\">
                                Editar</a>
                        </td>
                    </tr>";
    };
    echo"
                </tbody>
            </table>
            </div>";
}

/* Método INSERT/UPDATE Memória */
if ($act == 'insert') {
    if (isset($_SESSION['status'])){
        $idtb_memorias = $_POST['idtb_memorias'];
        $modelo = strtoupper($_POST['modelo']);
        $tipo = strtoupper($_POST['tipo']);
        $clock = $_POST['clock'];
        
        if ($idtb_memorias){
            $sql = "UPDATE db_clti.tb_memorias SET modelo='$modelo', tipo='$tipo' , clock='$clock'
                WHERE idtb_memorias='$idtb_memorias' ";
            
            $pg->exec($sql);
    
            if ($pg) {
                echo "<h5>Resgistros incluídos no banco de dados.</h5>
                <meta http-equiv=\"refresh\" content=\"1;url=?cmd=memorias\">";
            }
    
            else {
                echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
                echo(pg_result_error($pg) . "<br />\n");
            }
        }

        else{
            $sql = "INSERT INTO db_clti.tb_memorias(modelo,tipo,clock)
                VALUES ('$modelo', '$tipo', '$clock')";
            
            $pg->exec($sql);
    
            if ($pg) {
                echo "<h5>Resgistros incluídos no banco de dados.</h5>
                <meta http-equiv=\"refresh\" content=\"1;url=?cmd=memorias\">";
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