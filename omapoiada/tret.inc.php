<?php

set_time_limit(1800);

include '../class/Cezpdf.php';
$om = 'COMANDO DO 3º DISTRITO NAVAL';
$cidade = 'Natal';
$estado = 'RN';
$postograd = 'CB-FN-ET';
$nip_cpf = '99.2429.91';
$nome = 'LÚCIO ALEXANDRE CORREIA DOS SANTOS';
$ip = '172.23.116.52';
$mac = 'FF-FF-FF-FF-FF-FF';
$nome_et = 'COM3DN-01632';
$soft = 'SOFT PADRONIZADOS';
$naopad = 'PHOTOSHOP, CORELDRAW';

class Creport extends Cezpdf
{
    public function Creport($p, $o)
    {
        $this->__construct($p, $o, 'none', []);
    }
}
$pdf = new Creport('a4', 'portrait');
$pdf->ezSetMargins(20, 20, 60, 60);
$pdf->selectFont('Times-Roman');

$pdf->ezText("MARINHA DO BRASIL
$om
TERMO DE RECEBIMENTO DE ESTAÇÃO DE TRABALHO\n", 12, ['justification' => 'center', 'spacing' => 1.0]);

$pdf->ezText("$cidade/$estado, _____ de ___________ de _______.", 12, ['justification' => 'right', 'spacing' => 1.5]);

$pdf->ezText("          Pelo presente instrumento, eu, $postograd $nip_cpf $nome, perante a Marinha do Brasil, doravante denominada MB, na qualidade de usuário do ambiente computacional de propriedade daquela Instituição, declaro ter recebido desta desta OM uma estação de trabalho com as seguintes configurações:\n",
    12, ['justification' => 'full', 'spacing' => 1.5]);

$pdf->ezText("I – de identificação:\n
    a) endereço IP: $ip;\n
    b) endereço físico de rede: $mac; e\n
    c) identificação da máquina: $nome_et.\n", 
    12, ['justification'=>'left', 'spacing' => 1.0]);

$pdf->ezText("II – de instalação de programas:\n
    a) Softwares Padronizados: $soft;\n
    b) Softwares não Padronizados: $naopad.\n", 
    12, ['justification'=>'left', 'spacing' => 1.0]);

$pdf->ezText("III – de senha de acesso à máquina (“boot”), inicialmente estabelecida pelo Administrador da Rede Local (ADMIN) da OM e por mim alterada, sendo agora de meu conhecimento exclusivo; e\n", 
    12, ['justification' => 'full', 'spacing' => 1.5]);

$pdf->ezText("IV – de senha de configuração (“setup”), de conhecimento exclusivo do ADMIN e à qual não devo tomar conhecimento.\n",
    12, ['justification' => 'full', 'spacing' => 1.5]);

$pdf->ezText("          Assim, quaisquer alterações ou inclusões nos dados acima são de minha inteira responsabilidade e devem ser previamente autorizadas pelo Oficial de Segurança das Informações e Comunicações (OSIC), conforme previsto nas normas de Segurança das Informações Digitais da OM.",
    12, ['justification' => 'full', 'spacing' => 1.5]);
    
$pdf->ezText("          Estou ciente que o ADMIN (executou / não executou) a “formatação” prévia dos discos rígidos da referida estação de trabalho e sua correspondente reconfiguração e que, a qualquer momento e sempre que julgar necessário, poderei solicitar ao ADMIN auxílio para a realização dessa “formatação”, de modo a garantir a configuração padronizada da OM e a inexistência de arquivos ou programas irregulares.",
    12, ['justification' => 'full', 'spacing' => 1.5]);

$pdf->ezText("\n\n$nome
$postograd $nip_cpf", 12, ['justification' => 'center', 'spacing' => 1.5]);



if (isset($_GET['d']) && $_GET['d']) {
    echo $pdf->ezOutput(true);
} else {
    $pdf->ezStream(['compress' => 0]);
}