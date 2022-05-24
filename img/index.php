<?php

/* Classe de interação com o PostgreSQL */
require_once "../class/constantes.inc.php";
$config = new Config();
$url = $config->SelectURL();

echo "<meta http-equiv=\"refresh\" content=\"1;url=$url\">";

?>