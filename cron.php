<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/* Classe de interação com o PostgreSQL */
require_once "class/constantes.inc.php";
$usr = new Usuario();
$rel_sv = new RelServico();

/** Subtrai 1 Dia do Vencimento de Senha */
$row = $usr->DiasVenc();
$row = $usr->DiasVencCLTI();

/** Gera Relatório de Serviço Diário */
$rel_sv->data = date("Y-m-d");
$rel_sv->condicao = "data_entra_servico";
$sup_sai = $rel_sv->SelectDataDetSv();
$rel_sv->condicao = "data_entra_servico";
$rel_sv->data = $sup_sai->data_sai_servico;
$sup_entra = $rel_sv->SelectDataDetSv();

$rel_sv->sup_sai_servico = $sup_sai->idtb_lotacao_clti;
$rel_sv->sup_entra_servico = $sup_entra->idtb_lotacao_clti;
$rel_sv->num_rel = $rel_sv->NumRel();
$rel_sv->data_entra_servico = $sup_sai->data_entra_servico;
$rel_sv->data_sai_servico = $sup_sai->data_sai_servico;
$rel_sv->cel_funcional = "Funcionando normalmente";
$rel_sv->sit_servidores = "Operando normalmente";
$rel_sv->sit_backup = "Executado normalmente";
$rel_sv->status = "Em andamento";

$rel_sv->Insert();
$rel_sv->NewRel();

echo "Supervisor que sai: ".$sup_sai->idtb_lotacao_clti."\n";
echo "Supervisor que entra: ".$sup_entra->idtb_lotacao_clti."\n";



?>