<?php 

/** Registra tentativa de acesso suspeito */
include "../../class/acesso_suspeito.inc.php"; 
$msg = AcessoSuspeito("Ocorreu algum erro, por favor aguarde!"); 
Mensagens($msg); 

?>