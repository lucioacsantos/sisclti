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

?>