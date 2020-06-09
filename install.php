<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/* Classe de interação com o PostgreSQL */
require_once "class/pgsql.class.php";
$pg = new PgSql();

echo"

<!doctype html>
<html lang=\"pt_BR\">
  <head>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
    <meta name=\"description\" content=\"Sistema Integrado para Centros Locais de Tecnologia da Informação\">
    <meta name=\"author\" content=\"99242991 Lúcio ALEXANDRE Correia dos Santos\">

    <title>...::: SisCLTI :::...</title>

    <link href=\"url/css/bootstrap.min.css\" rel=\"stylesheet\">

    <!-- Dashboard CSS  -->
    <link href=\"url/css/dashboard.css\" rel=\"stylesheet\">

    <!-- ForValidation CSS  -->
    <link href=\"url/css/form-validation.css\" rel=\"stylesheet\">

    <!-- Stylesheet CSS -->
    <link href=\"url/css/stylesheet.css\" rel=\"stylesheet\">

  </head>

  <body>";
    $sql = file_get_contents('db_clti.sql');
    $pg->exec($sql);
    foreach ($pg as $key => $value) {
        if ($value != '0') {
        $sql = file_get_contents('db_clti_dados.sql');
        $pg->exec($sql);
            foreach ($pg as $key => $value) {
                if ($value != '0') {
                $sql = "UPDATE db_clti.tb_config SET valor='http://192.168.0.200/sisclti' WHERE parametro='URL'";
                $pg->exec($sql);
                    foreach ($pg as $key => $value) {
                        if ($value != '0') {
                        $sql = file_get_contents('db_clti_views.sql');
                        $pg->exec($sql);
                            foreach ($pg as $key => $value) {
                                if ($value != '0') {
                                    echo "<h5>Resgistros incluídos no banco de dados.</h5>";
                                }
                                else{
                                    echo "<h5>Ocorreu algum erro ao importar as visões, tente novamente.</h5>";
                                }
                            }
                        }
                        else{
                            echo "<h5>Ocorreu algum erro ao configurar a URL, tente novamente.</h5>";
                        }
                    }
                }
                else {
                    echo "<h5>Ocorreu algum erro ao importar os dados iniciais, tente novamente.</h5>";
                }
            }
        }
        else {
            echo "<h5>Ocorreu algum erro ao importar as tabelas, tente novamente.</h5>";
        }
    }
?>