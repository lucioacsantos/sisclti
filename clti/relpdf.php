<?php

/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/** Incluindo TCPDF */
require_once "../tcpdf/tcpdf.php";

/** Inicia Configurações do PDF */

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('SiGTI');
$pdf->SetTitle('Relatório de Serviço');
$pdf->SetSubject('Relatório de Serviço');
$pdf->SetKeywords('relatório, serviço, clti');

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_BOTTOM, PDF_MARGIN_RIGHT);

$pdf->SetAutoPageBreak(TRUE, 10);

$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

/** Prepara cabeçalho do relatório */

$pdf->SetFont('times', '', 10);

$pdf->AddPage();

$txt = <<<EOD
MARINHA DO BRASIL
COMANDO DO 3º DISTRITO NAVAL
CENTRO LOCAL DE TECNOLOGIA DA INFORMAÇÃO\n

EOD;

$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

$pdf->SetFont('times', 'B', 10);

$txt = <<<EOD
RELATÓRIO DE PASSAGEM DE SERVIÇO DO SUPERVISOR DO CLTI\n

EOD;

$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

$pdf->SetFont('times', '', 10);

$txt = <<<EOD
Nº 001/2023\n

EOD;

$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

/** Início dos dados do relatório */

$txt = <<<EOD
1) Supervisor de serviço que sai: CB-FN-ET 99.2429.91 ALEXANDRE

2) Supervisor de serviço que entra: CB-FN-ET 99.2429.91 ALEXANDRE

3) Equipamentos:\n

EOD;

$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);

$tbl = <<<EOD
<table cellspacing="0" cellpadding="5" border="1">
    <tr>
        <td>Equipamento <br /></td>
        <td>Situação</td>
        <td>Observações</td>
    </tr>
    <tr>
        <td>3.1) Rádio Enlace <br /></td>
        <td> </td>
        <td> </td>
    </tr>
    <tr>
        <td>3.2) Backbone <br /></td>
        <td> </td>
        <td> </td>
    </tr>
    <tr>
        <td>3.3) MPLS <br /></td>
        <td> </td>
        <td> </td>
    </tr>
    <tr>
        <td>3.4) Internet Distrital <br /></td>
        <td> </td>
        <td> </td>
    </tr>
    <tr>
        <td>3.5) Roteador <br /></td>
        <td> </td>
        <td> </td>
    </tr>
    <tr>
        <td>3.6) Câmeras <br /></td>
        <td> </td>
        <td> </td>
    </tr>
    <tr>
        <td>3.7) Refrigeração <br /></td>
        <td> </td>
        <td> </td>
    </tr>
    <tr>
        <td>3.8) Celular Funcional <br /></td>
        <td> </td>
        <td> </td>
    </tr>

</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

$txt = <<<EOD
4) Situação dos Servidores:\n

EOD;

$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);

$tbl = <<<EOD
<table cellspacing="0" cellpadding="5" border="1">
    <tr>
        <td>Servidor <br /></td>
        <td>Situação</td>
        <td>Observações</td>
    </tr>
    <tr>
        <td>4.1) SiGDEM <br /></td>
        <td> </td>
        <td> </td>
    </tr>
    <tr>
        <td>4.2) Correio Eletrônico <br /></td>
        <td> </td>
        <td> </td>
    </tr>
    <tr>
        <td>4.3) Páginas <br /></td>
        <td> </td>
        <td> </td>
    </tr>
    <tr>
        <td>4.4) SAMBA <br /></td>
        <td> </td>
        <td> </td>
    </tr>

</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

$pdf->AddPage();

$txt = <<<EOD
<p>5) Rotina de backup: <b>Mídia Nº 01</b><br/></p>

EOD;

//$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
$pdf->writeHTML($txt, true, false, false, false, '');

$tbl = <<<EOD
<table cellspacing="0" cellpadding="5" border="1">
    <tr>
        <td>Serviço <br /></td>
        <td>Data/Hora Início</td>
        <td>Tamanho Total (GB)</td>
    </tr>
    <tr>
        <td>5.1) SiGDEM <br /></td>
        <td> </td>
        <td> </td>
    </tr>
    <tr>
        <td>5.2) Correio Eletrônico <br /></td>
        <td> </td>
        <td> </td>
    </tr>
    <tr>
        <td>5.3) Páginas <br /></td>
        <td> </td>
        <td> </td>
    </tr>
    <tr>
        <td>5.4) SAMBA <br /></td>
        <td> </td>
        <td> </td>
    </tr>

</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

$txt = <<<EOD
6) Chamados:\n

EOD;

$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);

$tbl = <<<EOD
<table cellspacing="0" cellpadding="5" border="1">
    <tr>
        <td>Sistema <br /></td>
        <td>Aberto</td>
        <td>Pendente</td>
        <td>Solucionados</td>
    </tr>
    <tr>
        <td>6.1) CSRECIM <br /></td>
        <td> </td>
        <td> </td>
        <td> </td>
    </tr>
    <tr>
        <td>6.2) Claro <br /></td>
        <td> </td>
        <td> </td>
        <td> </td>
    </tr>
    <tr>
        <td>6.3) RNP <br /></td>
        <td> </td>
        <td> </td>
        <td> </td>
    </tr>
    <tr>
        <td colspan="4">6.5) Resumo dos Chamados: <br/></td>
    </tr>

</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

$txt = <<<EOD
7) Compartimentos:\n

EOD;

$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);

$tbl = <<<EOD
<table cellspacing="0" cellpadding="5" border="1">
    <tr>
        <td>Compartimento <br /></td>
        <td>Situação</td>
        <td>Observações</td>
    </tr>
    <tr>
        <td>7.1) Sala do CLTI <br /></td>
        <td> </td>
        <td> </td>
    </tr>
    <tr>
        <td>7.2) Sala dos Transmissores <br />(Rádio Marinha)</td>
        <td> </td>
        <td> </td>
    </tr>
    <tr>
        <td>7.3) Sala dos Servidores <br /> (BNN)</td>
        <td> </td>
        <td> </td>
    </tr>
    <tr>
        <td>7.4) Paiol de Fibra <br />(BNN)</td>
        <td> </td>
        <td> </td>
    </tr>

</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

$pdf->AddPage();

$txt = <<<EOD
8) Conectividade das OM Apoiadas:\n

EOD;

$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);

$tbl = <<<EOD
<table cellspacing="0" cellpadding="5" border="1">
    <tr>
        <td>OM <br /></td>
        <td>Situação</td>
        <td>Observações</td>
    </tr>
    <tr>
        <td><br /></td>
        <td> </td>
        <td> </td>
    </tr>

</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

$tbl = <<<EOD
<table cellspacing="0" cellpadding="1" border="0">
    <tr>
        <td colspan="2"></td>
    </tr>
    <tr>
        <td colspan="2"></td>
    </tr>
    <tr>
        <td colspan="2"></td>
    </tr>
    <tr>
        <td align="center">LEONARDO AZEVEDO EDUARDO<br />CAPITÃO DE CORVETA (T)<br /> Encarregado do CLTI</td>
        <td align="center">LÚCIO ALEXANDRE CORREIA DOS SANTOS<br />CABO (FN-ET)<br />Supervisor de Serviço</td>
    </tr>

</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

//Fechar e apresentar saída do Relatório PDF
$pdf->Output('RelSv_13-02-2023.pdf', 'I');