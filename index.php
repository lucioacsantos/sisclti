<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/
/*ini_set("display_errors",1);
ini_set("display_startup_erros",1);
error_reporting(E_ALL);*/

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

/* Classe de interação com o PostgreSQL */
require_once "class/constantes.inc.php";
$config = new Config();
$url = $config->SelectURL();
$sigla = $config->SelectSigla();
$versao = $config->SelectVersao();

/* Verifica Sessão de Login Ativa */
if (!isLoggedIn()){
    header("Location: login.php");
}

/* Carrega Estrutura das Páginas */
include "head.php";

include "nav.php";

include "main.php";

include "foot.php";

?>