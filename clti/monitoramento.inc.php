<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/** Leitura de parâmetros */
$oa = $cmd = $param = $act = $senha = NULL;
if (isset($_GET['oa'])){
  $oa = $_GET['oa'];
}

if (isset($_GET['cmd'])){
  $cmd = $_GET['cmd'];
}

if (isset($_GET['act'])){
  $act = $_GET['act'];
}

if (isset($_GET['param'])){
  $param = $_GET['param'];
}

if (isset($_GET['senha'])){
    $senha = $_GET['senha'];
}

/* Clasee de interação com o PostgreSQL */
require_once "../class/constantes.inc.php";
$config = new Config();
$ativos = new Monitoramento();


/* Recupera informações de Servidores */
$srv = $ativos->SelectSrv();

/** Gateway das OM Apoiadas */


foreach ($srv as $key => $value){
    $row = $ativos->PingAtivo($value->end_ip);
    if ( preg_match("/bytes from/",$row) ) {
        echo "$value->nome ONLINE\n";
    }
    else {
        echo "$value->nome OFFLINE\n";
    }
    $row = $ativos->PortaSrv($value->end_ip,'80');
    if ($row){
        echo "$value->nome HTTP ONLINE\n";
    }
    else {
        echo "$value->nome HTTP OFFLINE\n";
    }
}

?>