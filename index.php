<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/* Clasee de interação com o PostgreSQL */
require_once "class/pgsql.class.php";
$pg = new PgSql();

/* Verifica Sessão de Login Ativa */
if (!isLoggedIn()){
    header('Location: login.php');
}

/* Recupera Configurações do Sistema a partir do Banco de Dados */
$url = $pg->getCol("SELECT valor FROM db_clti.tb_config WHERE parametro='URL'");

/* Carrega Estrutura das Páginas */
include "head.php";

include "nav.php";

include "main.php";

include "foot.php";

?>