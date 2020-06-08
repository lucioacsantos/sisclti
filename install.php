<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/* Classe de interação com o PostgreSQL */
require_once "class/pgsql.class.php";
$pg = new PgSql();

/* Recupera Configurações do Sistema a partir do Banco de Dados */
$url = $pg->getCol("SELECT valor FROM db_clti.tb_config WHERE parametro='URL'");

@$act = $_GET['act'];

include "head.php";

/* Formulário Configurações */

echo "
<main role=\"main\" class=\"col-md-9 ml-sm-auto col-lg-10 px-4\">
    <div class=\"d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom\">
        <div class=\"container-fluid\">
            <div class=\"row\">
                <main>
                    <div id=\"form-cadastro\">
                        <form id=\"urlip\" role=\"form\" action=\"?cmd=install\" 
                        method=\"post\" enctype=\"multipart/form-data\">
                            <fieldset>
                            <legend>Configurações Iniciais</legend>
                                <div class=\"form-group\">
                                    <label for=\"urlip\">Informe a URL ou IP do SisCLTI:</label>
                                    <input id=\"urlip\" class=\"form-control\" type=\"num\" name=\"urlip\" 
                                        placeholder=\"URL/IP (SEM HTTP://)\" autofocus=\"true\" required=\"true\">
                                </div>
                            </fieldset>
                            <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Salvar\">
                        </form>
                    </div>
                </main>
            </div>
        </div>
    </div>
</main>";

if ($act == 'install') {

    $urlip = strtlower($_POST['urlip']);

    $sql = file_get_contents('db_clti.sql');

    $row = $pg->exec($sql);

    if ($row) {

        $sql = file_get_contents('dados_iniciais.sql');

        $row = $pg->exec($sql);

        if ($row){

            $sql = "UPDATE db_clti.tb_config SET valor='http://".$urlip."/sisclti' WHERE parametro='URL'";

            $row = $pg->exec($sql);

            echo "<h5>Resgistros incluídos no banco de dados.</h5>
                    <meta http-equiv=\"refresh\" content=\"1;url=login_clti.php\">";
        }

        else {

            echo "<h5>Ocorreu algum erro, tente novamente.</h5>";

        }
    }

    else {

        echo "<h5>Ocorreu algum erro, tente novamente.</h5>";

    }

}

include "foot.php";

?>