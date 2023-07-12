<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/** Verificação de segurança */
require_once "class/seguranca.inc.php";
$seg = new Seguranca();
$seg->end_ip = $seg->GetIP();
$bloqueado = $seg->ChecaBloqueado();

if ($bloqueado){
    require_once "class/acesso_suspeito.inc.php";
    $msg = "Acesso bloqueado, contate o suporte!"; 
    Mensagens($msg);
    die();
}

$act = NULL;
if (isset($_GET['act'])){
  $act = $_GET['act'];
}

/* Classe de interação com o PostgreSQL */
require_once "class/constantes.inc.php";
$config = new Config();
$usr = new Usuario();
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

if ($act == NULL){
  include_once("login.inc.php");
}

/* Método Login */
if ($act == 'acesso') {
  
  include_once("class/queries.inc.php");
  $acesso = new Principal();
  
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

	if ($row) {
    if ($row->secret == 'Não ativado'){
      $usr->iduser = $row->idtb_pessoal_ti;
      $venc_senha = $usr->GetVencSenha();
      $row = $usr->perfilOM();

      if ($row) {
        $seg->data_acesso = date("Y-m-d");
        $seg->hora_acesso = date("H:i:s");
        $seg->ZeraContador();
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
      } else {
        $_SESSION ['msg'] = "Ocorreu algum erro!";
        $msg = $_SESSION ['msg'];
        include_once("login.inc.php");
      }
    }
    else {
      include_once("auth.inc.php");
    }
    
    /** Verificar falhas de login do usuário comum */
    /*if ($venc_senha < 1){
      $_SESSION ['msg'] = "Sua senha venceu! Entre em contato com o CLTI!";
      $msg = $_SESSION ['msg'];
      $_SESSION['logged_in'] = false;
      include_once("login.inc.php");
    }
    else{*/
      
    //}
	}
	else {
    include "class/acesso_suspeito.inc.php"; 
    $msg = AcessoSuspeito("Usuário ou senha incorretos, por favor aguarde!"); 
    Mensagens($msg);
    $usr->BloqueioOM();
	}
}

if ($act == 'auth'){
  require_once "class/authenticator.inc.php";
  $authenticator = new GoogleAuthenticator();
  $codigo = $_POST['codigo'];
  $iduser = $_POST['iduser'];
  $usr->iduser = $iduser;
  $venc_senha = $usr->GetVencSenha();
  $row = $usr->perfilOM();
  $secret = $usr->getSecret();
  $checkResult = $authenticator->verifyCode($secret, $codigo, 2);    // 2 = 2*30sec clock tolerance

  if ($checkResult) {
    $seg->data_acesso = date("Y-m-d");
    $seg->hora_acesso = date("H:i:s");
    $seg->ZeraContador();
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
  } else {
    $msg = AcessoSuspeito("Erro na autenticação em dois fatores, por favor aguarde!"); 
    Mensagens($msg);
  }
}

?>