<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/* Classe de interação com o PostgreSQL */
require_once "class/constantes.inc.php";
$config = new Config();
$url = $config->SelectURL();
$tags = $config->SelectTags();
$sigla = $config->SelectSigla();
$versao = $config->SelectVersao();
$_SESSION ['msg'] = "";
$msg = $_SESSION ['msg'];

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

      <link rel=\"apple-touch-icon\" sizes=\"180x180\" href=\"$url/img/apple-touch-icon.png\">
      <link rel=\"icon\" type=\"image/png\" sizes=\"32x32\" href=\"$url/img/favicon-32x32.png\">
      <link rel=\"icon\" type=\"image/png\" sizes=\"16x16\" href=\"$url/img/favicon-16x16.png\">
      <link rel=\"manifest\" href=\"$url/img/site.webmanifest\">

      <title>...::: ".$config->SelectTitulo()." :::...</title>

      <!-- Bootstrap core CSS -->
      <link href=\"$url/css/bootstrap.min.css\" rel=\"stylesheet\">

      <!-- Stylesheet CSS -->
      <link href=\"$url/css/signin.css\" rel=\"stylesheet\">
      ";
    ?>

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

  </head>

  <body>

<?php
@$act = $_GET['act'];

if ($act == NULL){
  include_once("login.inc.php");
}

/* Método Login */
if ($act == 'acesso') {
  
  include_once("class/queries.inc.php");
  $acesso = new Principal();
  $usr = new Usuario();
  
  $usuario = $_POST['usuario'];
  $usr->usuario = $usuario;
  $acesso->var1 = $_POST['usuario'];
  $acesso->var2 = $_POST['senha'];
  $var = $acesso->Executa();
  if ($var){
    $usr->senha = $var->var5;
  }
  else{
    $_SESSION ['msg'] = "Ocorreu algum erro!";
    $msg = $_SESSION ['msg'];
    include_once("login.inc.php");
  }

  $row = $usr->LoginOM();
    
	if ($row != NULL) {

    $usr->iduser = $row->idtb_pessoal_ti;
    $venc_senha = $usr->GetVencSenha();
    $row = $usr->perfilOM();
    /** Verificar falhas de login do usuário comum */
    /*if ($venc_senha < 1){
      $_SESSION ['msg'] = "Sua senha venceu! Entre em contato com o CLTI!";
      $msg = $_SESSION ['msg'];
      $_SESSION['logged_in'] = false;
      include_once("login.inc.php");
    }
    else{*/
      $_SESSION['logged_in'] = true;
      $_SESSION['user_id'] = $row->idtb_pessoal_ti;
      $_SESSION['venc_senha'] = $usr->GetVencSenha();
      $_SESSION['usuario'] = $usr->usuario;
      $_SESSION['posto_grad'] = $row->sigla_posto_grad;
      $_SESSION['user_name'] = $row->nome_guerra;
      $_SESSION['perfil'] = $row->sigla_funcao;
      $_SESSION['status'] = $row->status;
      $_SESSION['id_om_apoiada'] = $row->idtb_om_apoiadas;
      $_SESSION['om_apoiada'] = $row->sigla_om;
      
      header('Location: index.php');
    //}
	}
	else {
    $_SESSION ['msg'] = "Usuário ou senha incorretos!";
    $msg = $_SESSION ['msg'];
    include_once("login.inc.php");
	}
}

?>