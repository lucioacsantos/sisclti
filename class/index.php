<?php 

/** Registra tentativa de acesso suspeito */
include "acesso_suspeito.inc.php"; 
$msg = AcessoSuspeito("Ocorreu algum erro, por favor aguarde!"); 
Mensagens($msg); 

?>