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
    
     # Parâmetros de busca no banco de dados
    $hw->search = strtoupper($data['proc_modelo']);
    $hw->tipo = $data['tipo_memoria'];
    $hw->clock = $data['velocidade'];
    $sor->descricao = strtoupper($data['distro']);
    $sor->versao = $data['versao'];
    $om->idtb_om_apoiadas = $row;

    # Valida/Formata data
    $date = $data['data'];
    // $data_valida = $et->validaData($date);
    // $et->data_aquisicao = $data_valida;
    // $et->data_garantia = $data_valida;
    
    $data_valida = $et->validaData($date);
    if ($data_valida){
      $et->data_aquisicao = $date;
      $et->data_garantia = $date;
    }
    else{
      $date = explode("/",$date);
      $arr = array("$date[1]","$date[0]","$date[2]");
      $date = implode("/", $arr);
      $et->data_aquisicao = $date;
      $et->data_garantia = $date;
    }
    // if ($data_valida){
    //   $et->data_aquisicao = $date;
    //   $et->data_garantia = $date; 
    // }
    // else{
    //   $date = $data['data'];
    //   $data_valida = $et->formatarData($date);
    //   $et->data_aquisicao = $data_valida;
    //   $et->data_garantia = $data_valida; 
    // }
    
    # Seleciona Sistema Operacional
    $et->idtb_sor = $sor->SearchSO();

    # Seleciona/Cadastra Memória/Processador
    $proc = $hw->SearchProc();
    $mem = $hw->SearchdMem();
    if ($proc){
      $et->idtb_proc_modelo = $proc;
    }
    else{
      $hw->search = strtoupper($data['proc_fab']);
      $hw->idtb_proc_fab = $hw->SearchFab();
      $hw->modelo = (strtoupper($data['proc_familia'])) . ' ' . (strtoupper($data['proc_modelo']));
      $proc = $hw->InsertProcModelo();
      if ($proc){
        $et->idtb_proc_modelo = $row;
      }
      else{
        print "Erro ao inserir processador...\n\n";
        print "Erro 1\n\n";
        exit(1);
      }
    }
    if ($mem){
      $et->idtb_memorias = $mem;
    }
    else{
      $hw->tipo = strtoupper($data['tipo_memoria']);
      $hw->clock = $data['velocidade'];
      $clock = $data['velocidade'];
      $hw->modelo = "PC"."$hw->ClockMem($clock)";
      $mem = $hw->InsertMem();
      if ($mem){
        $et->idtb_proc_modelo = $mem;
      }
      else{
        print "Erro ao inserir memória...\n\n";
        print "Erro 1\n\n";
        exit(1);
      }
    }

    # Preparando dados para inserção da ET
    $et->idtb_om_apoiadas = $om->idtb_om_apoiadas;
    $et->fabricante = mb_strtoupper($data['fabricante']);
    $et->modelo = mb_strtoupper($data['modelo']);
    $et->nome = mb_strtoupper($data['hostname']);
    $et->clock_proc = ($data['clock'])/1000;
    $et->memoria = $data['memoria'];
    $et->armazenamento = $data['hd'];
    $et->end_ip = $data['end_ip'];
    $ip->end_ip = $data['end_ip'];
    $et->end_mac = $data['end_mac'];
    $et->idtb_sor = $sor->SearchSO();
    $et->idtb_om_setores = $data['cod_setor'];
    $et->status = "EM PRODUÇÃO";

    /** Verificação de Requisitos Mínimos
     * Memória: 8GB DDR4 2400
     * Processador: 3.1GHz 4 Núcleos 4 Threads
     * Processador de referência: i3-8100T (8ª Geração)
     * TODO: Adicionar configurações ET Padrão ao Sistema
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
        print "Endereço IP in formado já está em uso, por favor verifique!\n\n";
    }
    elseif ($checa_nome){
        print "Nome informado já está em uso, por favor verifique!\n\n";
    }
    else{
        $row = $et->InsertET();            
        if ($row) {
            print "\nDados processados.\n\n";
            print "Confirme/Corrija os dados pelo SiGTI!\n\n";
        }
        else {
            print "Ocorreu algum erro, tente novamente.\n\n";
        }
    }
  }
  else{
    print "Código da OM ou Cahve de Acesso inválidos...\n\n";
    print "Erro 1\n\n";
    exit(1);
  }
}

?>