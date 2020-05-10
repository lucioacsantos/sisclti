<?php
/**
 * PostgreSQL Class Config
 * Classe para Parâmetros do Banco de Dados
 * config.php
 * 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

require_once "class/pgsql.class.php";
$pg = new PgSql();

/*@$act = $_GET['act'];

/*$metodo = isset($_GET['metodo']);

if ($metodo == 'select') {

	$opcao = $_GET['opcao'];
	$db = $_GET['db'];
	$sql = "SELECT * FROM $db.$opcao";

	foreach ($pg->getRows($sql) as $row) {
		echo "<td>".$row."</td>";
		echo "</tr>";
	}

}

else {

	$sql = "SELECT * FROM pg_catalog.pg_tables WHERE schemaname != 'pg_catalog' 
		AND schemaname != 'information_schema' ORDER BY tablename";

	foreach($pg->getRows($sql) as $row) {
	    echo $row->schemaname." - ";
	    echo "<a href=?db=".$row->schemaname."&opcao=".$row->tablename."&metodo=select>".$row->tablename."</a>";
	    echo "<br>";
	}
	echo "<br>";

}*/

$sql = "SELECT * FROM db_clti.tb_clti";

$row = $pg->getRow($sql);
if ($row){
  echo $row->norma_atual;
  echo $row->data_norma;
  echo $row->tipo_clti;
  echo $row->lotacao_oficiais;
  echo $row->lotacao_pracas;
}

else {
  echo "Não há registros!";
}

?>