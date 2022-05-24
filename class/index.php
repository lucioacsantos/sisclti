<?php

/* Classe de interação com o PostgreSQL */
require_once "constantes.inc.php";
require_once "seguranca.inc.php";
$config = new Config();
$seg = new Seguranca();
$url = $config->SelectURL();
$tags = $config->SelectTags();
$sigla = $config->SelectSigla();
$versao = $config->SelectVersao();

$ipaddress = $_SERVER['REMOTE_ADDR'];

?>

<!doctype html>
<html lang="pt_BR">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php
  foreach ($tags as $key => $value){
    echo "
    <meta name=\"$value->parametro\" content=\"$value->valor\">";
  }
  echo "
    <meta http-equiv=\"Cache-Control\" content=\"no-cache, no-store, must-revalidate\" />
    <meta http-equiv=\"Pragma\" content=\"no-cache\" />
    <meta http-equiv=\"Expires\" content=\"0\" />

    <!--<meta http-equiv=\"refresh\" content=\"5;url=$url\">-->

    <link rel=\"apple-touch-icon\" sizes=\"180x180\" href=\"$url/img/apple-touch-icon.png\">
    <link rel=\"icon\" type=\"image/png\" sizes=\"32x32\" href=\"$url/img/favicon-32x32.png\">
    <link rel=\"icon\" type=\"image/png\" sizes=\"16x16\" href=\"$url/img/favicon-16x16.png\">
    <link rel=\"manifest\" href=\"$url/img/site.webmanifest\">

    <title>...::: ".$config->SelectTitulo()." :::...</title>

    <!-- Bootstrap core CSS -->
    <link href=\"$url/css/bootstrap.min.css\" rel=\"stylesheet\">

    <!-- Dashboard CSS  -->
    <link href=\"$url/css/dashboard.css\" rel=\"stylesheet\">

    <!-- ForValidation CSS  -->
    <link href=\"$url/css/form-validation.css\" rel=\"stylesheet\">

    <!-- Stylesheet CSS -->
    <link href=\"$url/css/stylesheet.css\" rel=\"stylesheet\">
    ";
  ?>

  </head>

  <body>
    <div class="container">
        <div class="text-center">
            <p><h3>Ocorreu algum erro, por favor aguarde!<?php echo $ipaddress; ?></h3></p>
        </div>
        <div class="text-center">
            <img src="../img/loading.gif" class="img-fluid" height="64px" width="64px" />
        </div>
    </div>