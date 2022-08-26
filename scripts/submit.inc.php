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

/* Classe de interação com o PostgreSQL */
require_once "../class/constantes.inc.php";
$et = new Estacoes();
$om = new OMApoiadas();
$ip = new IP();
$sor = new SO();
$hw = new Hardware();

$data = json_decode(file_get_contents('php://input'), true);

$act = $data['act'];

if ($act == "select_setores"){

  $om->cod_om = $data['cod_om'];
  $row = $om->SelectCodOMTable();
  if ($row){
    $om->idtb_om_apoiadas = $row;
    $om->ordena = "ORDER BY nome_setor ASC";
    $local = $om->SelectAllSetoresView();
    if ($local){
      foreach ($local as $key => $value){
        echo " $value->idtb_om_setores   - $value->sigla_setor - $value->compartimento\n";
      }
      print "Setores/Compartimentos localizados. Informe a seguir o setor desejado...\n\n";
    }
    else {
      print "Não foram localizados setores, é necessário cadastrá-los pelo SiGTI!\n\n";
      print "Erro 1\n\n";
      exit(1);
    }
  }
  else{
    print "Código da OM inválido...\n\n";
    print "Erro 1\n\n";
    exit(1);
  }  
}

else {

  print_r($data);
  print "\n\nDados processados...\n\n";
  print "Verifique/Corrija os dados de aquisição e garantia da ET no SiGTI!\n\n";

}



?>