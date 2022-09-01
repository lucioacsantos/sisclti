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

print_r($data);
print "\n\nDados processados...\n\n";


// $act = $data['act'];


// if ($act == "select_setores"){

//   $om->cod_om = $data['cod_om'];
//   $om->chave_acesso = $data['chave'];
//   $row = $om->SelectCodOMTable();
//   if ($row){
//     $om->idtb_om_apoiadas = $row;
//     $om->ordena = "ORDER BY nome_setor ASC";
//     $local = $om->SelectAllSetoresView();
//     if ($local){
//       foreach ($local as $key => $value){
//         echo " $value->idtb_om_setores   - $value->sigla_setor - $value->compartimento\n";
//       }
//       print "Setores/Compartimentos localizados. Informe a seguir o setor desejado...\n\n";
//     }
//     else {
//       print "Não foram localizados setores, é necessário cadastrá-los pelo SiGTI!\n\n";
//       print "Erro 1\n\n";
//       exit(1);
//     }
//   }
//   else{
//     print "Código da OM ou Cahve de Acesso inválidos...\n\n";
//     print "Erro 1\n\n";
//     exit(1);
//   }  
// }

// if ($act == "cad_et"){

//   $om->cod_om = $data['cod_om'];
//   $om->chave_acesso = $data['chave'];
//   $row = $om->SelectCodOMTable();
//   if ($row){
    
//     // "distro": "'"$distro"'",
// 		// "versao": "'"$versao"'",
// 		// "proc_fab": "'"$proc_fab"'",
// 		// "proc_modelo": "'"$proc_modelo"'",
// 		// "clock": "'"$clock"'",
// 		// "memoria": "'"$memoria"'",
//     // "tipo_memoria": "'"$tipo_momoria"'",
// 		// "velocidade": "'"$velocidade"'",
// 		// "end_ip": "'"$end_ip"'",
// 		// "end_mac": "'"$end_mac"'",


    
    
//     $om->idtb_om_apoiadas = $row;

//     $et->idtb_om_apoiadas = $row;
//     $et->fabricante = mb_strtoupper($data['fabricante']);
//     $et->modelo = mb_strtoupper($data['modelo']);
//     $et->nome = mb_strtoupper($data['hostame']);

//     $et->idtb_proc_modelo = $_POST['idtb_proc_modelo'];
//     $et->clock_proc = $_POST['clock_proc'];
//     $et->idtb_memorias = $_POST['idtb_memorias'];
//     $et->memoria = $_POST['memoria'];

//     $et->armazenamento = $data['hd'];
//     $et->end_ip = $data['end_ip'];
//     $ip->end_ip = $data['end_ip'];
//     $et->end_mac = $data['end_mac'];

//     $et->idtb_sor = $_POST['idtb_sor'];

//     $et->idtb_om_setores = $data['cod_setor'];
//     $et->data_aquisicao = $data['data'];
//     $et->data_garantia = $data['data'];

//     $et->req_minimos = $_POST['req_minimos'];
    
//     $et->status = $_POST['status'];
    

		



//     if ($local){
//       foreach ($local as $key => $value){
//         echo " $value->idtb_om_setores   - $value->sigla_setor - $value->compartimento\n";
//       }
//       print "Setores/Compartimentos localizados. Informe a seguir o setor desejado...\n\n";
//     }
//     else {
//       print "Não foram localizados setores, é necessário cadastrá-los pelo SiGTI!\n\n";
//       print "Erro 1\n\n";
//       exit(1);
//     }

//     $checa_ip = $ip->SearchIP();
//     $checa_nome = $et->SelectNomeETView();
//     if ($checa_ip){
//         echo "<h5>Endereço IP in formado já está em uso, 
//                 por favor verifique!</h5>
//             <meta http-equiv=\"refresh\" content=\"5;url=?cmd=estacoes\">";
//     }
//     elseif ($checa_nome){
//         echo "<h5>Nome informado já está em uso, 
//                 por favor verifique!</h5>
//             <meta http-equiv=\"refresh\" content=\"5;url=?cmd=estacoes\">";
//     }
//     else{
//         $row = $et->InsertET();            
//         if ($row) {
//             echo "<h5>Resgistros incluídos no banco de dados.</h5>
//             <meta http-equiv=\"refresh\" content=\"1;url=?cmd=estacoes\">";
//         }
//         else {
//             echo "<h5>Ocorreu algum erro, tente novamente.</h5>
//             ";
//         }
//     }


//   }
//   else{
//     print "Código da OM ou Cahve de Acesso inválidos...\n\n";
//     print "Erro 1\n\n";
//     exit(1);
//   }
// }

// else {

//   print_r($data);
//   print "\n\nDados processados...\n\n";
//   print "Verifique/Corrija os dados de aquisição e garantia da ET no SiGTI!\n\n";

// }



?>