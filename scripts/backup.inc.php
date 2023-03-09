<?php

/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/** Leitura de parâmetros */
$act = NULL;
if (isset($_GET['act'])){
  $act = $_GET['act'];
}

/* Classe de interação com o PostgreSQL */
require_once "../class/constantes.inc.php";
$om = new OMApoiadas();
$bkp = new Backup();
$srv = new Servidores();

$data = json_decode(file_get_contents('php://input'), true);

$act = $data['act'];

if ($act == "select_srv_backup"){

  $om->cod_om = $data['cod_om'];
  $om->chave_acesso = $data['chave'];
  $row = $om->SelectCodOMTable();
  if ($row){
    $om->idtb_om_apoiadas = $row;
    $om->ordena = "ORDER BY nome_setor ASC";
    $local = $om->SelectAllSetoresView();
    if ($local){
      foreach ($local as $key => $value){
        print " $value->idtb_om_setores   - $value->sigla_setor - $value->compartimento\n";
      }
      print "\n\nSetores/Compartimentos localizados. Informe a seguir o setor desejado...\n\n";
    }
    else {
      print "Não foram localizados setores, é necessário cadastrá-los pelo SiGTI!\n\n";
      print "Erro 1\n\n";
      exit(1);
    }
  }
  else {
    print "Código da OM ou Chave de Acesso inválidos...\n\n";
    print "Erro 1\n\n";
    exit(1);
  }
}

?>