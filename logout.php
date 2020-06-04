<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/
 
// inicia a sessão
session_start();
 
// muda o valor de logged_in para false
$_SESSION['logged_in'] = false;
 
// finaliza a sessão
session_destroy();
 
// retorna para a index.php
header('Location: index.php');