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
$et = new Estacoes();
$om = new OMApoiadas();
$ip = new IP();
$sor = new SO();
$hw = new Hardware();

$data = json_decode(file_get_contents('php://input'), true);

$act = $data['act'];

if ($act == "select_setores"){

  $om->cod_om = $data['cod_om'];
  $om->chave_acesso = $data['chave'];
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
    print "Código da OM ou Chave de Acesso inválidos...\n\n";
    print "Erro 1\n\n";
    exit(1);
  }  
}

if ($act == "cad_et"){

  $om->cod_om = $data['cod_om'];
  $om->chave_acesso = $data['chave'];
  $row = $om->SelectCodOMTable();
  if ($row){
    
     # Parâmtros de busca no banco de dados
    $hw->search = $data['proc_modelo'];
    $hw->tipo = $data['tipo_memoria'];
    $hw->clock = $data['velocidade'];
    $sor->descricao = $data['distro'];
    $sor->versao = $data['versao'];
    $om->idtb_om_apoiadas = $row;

    # Preparando dados para inserção da ET
    $et->idtb_om_apoiadas = $row;
    $et->fabricante = mb_strtoupper($data['fabricante']);
    $et->modelo = mb_strtoupper($data['modelo']);
    $et->nome = mb_strtoupper($data['hostame']);
    $et->idtb_proc_modelo = $hw->SearchProc();
    $et->clock_proc = ($data['clock'])/1000;
    $et->idtb_memorias = $hw->SearchdMem();
    $et->memoria = $data['memoria'];
    $et->armazenamento = $data['hd'];
    $et->end_ip = $data['end_ip'];
    $ip->end_ip = $data['end_ip'];
    $et->end_mac = $data['end_mac'];
    $et->idtb_sor = $sor->SearchSO();
    $et->idtb_om_setores = $data['cod_setor'];
    $et->data_aquisicao = $data['data'];
    $et->data_garantia = $data['data'];
    $et->status = "EM PRODUÇÃO";

    /** Verificação de Requisitos Mínimos
     * Memória: 8GB DDR4 2400
     * Processador: 3.1GHz 4 Núcleos 4 Threads
     * Processador de referência: i3-8100T (8ª Geração)
     */
    
    if (($data['tipo_memoria'] == 'DDR4') && ($data['velocidade'] >= '2400') && ($data['memoria'] >= '8') 
      && ($data['clock'] >= '3100') && ($data['cores'] >= '4') && ($data['threads'] >= '4')){
      $et->req_minimos = "SIM";
    }
    else{
      $et->req_minimos = "NÃO";
    }
        
    $checa_ip = $ip->SearchIP();
    $checa_nome = $et->SelectNomeETView();
    if ($checa_ip){
        echo "<h5>Endereço IP in formado já está em uso, 
                por favor verifique!</h5>
            <meta http-equiv=\"refresh\" content=\"5;url=?cmd=estacoes\">";
    }
    elseif ($checa_nome){
        echo "<h5>Nome informado já está em uso, 
                por favor verifique!</h5>
            <meta http-equiv=\"refresh\" content=\"5;url=?cmd=estacoes\">";
    }
    else{
        $row = $et->InsertET();            
        if ($row) {
            echo "<h5>Resgistros incluídos no banco de dados.</h5>
            <meta http-equiv=\"refresh\" content=\"1;url=?cmd=estacoes\">";
        }
        else {
            echo "<h5>Ocorreu algum erro, tente novamente.</h5>
            ";
        }
    }
  }
  else{
    print "Código da OM ou Cahve de Acesso inválidos...\n\n";
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