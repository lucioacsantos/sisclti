<?php

set_time_limit(1800);

include '../class/Cezpdf.php';
$om = 'COMANDO DO 3º DISTRITO NAVAL';
$cidade = 'Natal';
$estado = 'RN';
$postograd = 'CB-FN-ET';
$nip_cpf = '99.2429.91';
$nome = 'LÚCIO ALEXANDRE CORREIA DOS SANTOS';

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
TERMO DE RESPONSABILIDADE INDIVIDUAL\n",
 12, ['justification' => 'center', 'spacing' => 1.0]);

$pdf->ezText("$cidade/$estado, _____ de ___________ de _______.", 12, ['justification' => 'right', 'spacing' => 1.5]);

$pdf->ezText("          Pelo presente instrumento, eu, $postograd $nip_cpf $nome, perante a Marinha do Brasil, doravante denominada MB, na qualidade de usuário do ambiente computacional de propriedade daquela Instituição, declaro estar ciente das normas de segurança das informações digitais da OM, segundo as quais devo:",
12, ['justification' => 'full', 'spacing' => 1.5]);
$pdf->ezText("a) tratar a informação digital como patrimônio da MB e como um recurso que deva ter seu sigilo preservado, em consonância com a legislação vigente;",
12, ['justification' => 'full', 'spacing' => 1.5]);
$pdf->ezText("b) utilizar as informações disponíveis e os sistemas e produtos computacionais, dos quais a MB é proprietária ou possui o direito de uso, exclusivamente para o interesse do serviço;",
12, ['justification' => 'full', 'spacing' => 1.5]);
$pdf->ezText("c) preservar o conteúdo das informações sigilosas a que tiver acesso, sem divulgá-las para pessoas não autorizadas;",
12, ['justification' => 'full', 'spacing' => 1.5]);
$pdf->ezText("d) não tentar obter acesso à informação cujo grau de sigilo não seja compatível com a minha Credencial de Segurança (CREDSEG) ou que eu não tenha autorização ou necessidade de conhecer;",
12, ['justification' => 'full', 'spacing' => 1.5]);
$pdf->ezText("e) não compartilhar o uso de senha com outros usuários;",
12, ['justification' => 'full', 'spacing' => 1.5]);
$pdf->ezText("f) não me fazer passar por outro usuário usando a sua identificação de acesso e senha;",
12, ['justification' => 'full', 'spacing' => 1.5]);
$pdf->ezText("g) não alterar o endereço de rede ou qualquer outro dado de identificação do microcomputador de meu uso;",
12, ['justification' => 'full', 'spacing' => 1.5]);
$pdf->ezText("h) instalar e utilizar em meu microcomputador somente programas homologados para uso na MB e que esta possua as respectivas licenças de uso ou, no caso de programas de domínio público, mediante autorização formal do Oficial de Segurança de Informações e Comunicações (OSIC) da OM;",
12, ['justification' => 'full', 'spacing' => 1.5]);
$pdf->ezText("i) no caso de exoneração, demissão, licenciamento, término de prestação de serviço ou qualquer tipo de afastamento, preservar o conteúdo das informações e documentos sigilosos a que tive acesso e não divulgá-los para pessoas não autorizadas;",
12, ['justification' => 'full', 'spacing' => 1.5]);
$pdf->ezText("j) guardar segredo das minhas autenticações de acesso (senhas) utilizadas no ambiente computacional da OM, não cedendo, não transferindo, não divulgando e não permitindo o seu conhecimento por terceiros;",
12, ['justification' => 'full', 'spacing' => 1.5]);
$pdf->ezText("k) não utilizar senha com seqüência fácil ou óbvia de caracteres que facilite a sua descoberta e não escrever a senha em lugares visíveis ou de fácil acesso;",
12, ['justification' => 'full', 'spacing' => 1.5]);
$pdf->ezText("l) utilizar, ao me afastar momentaneamente da minha estação de trabalho, descanso de tela (“screen saver”) protegido por senha, a fim de evitar que alguém possa ver as informações que estejam disponíveis na tela do computador;",
12, ['justification' => 'full', 'spacing' => 1.5]);
$pdf->ezText("m) ao me ausentar do local de trabalho, momentaneamente ou ao término de minhas atividades diárias, certificar-me de que a sessão aberta no ambiente computacional com minha identificação foi fechada e as informações que exigem sigilo foram adequadamente salvaguardadas;",
12, ['justification' => 'full', 'spacing' => 1.5]);
$pdf->ezText("n) seguir as orientações da área de informática da OM relativas à instalação, à manutenção e ao uso adequado dos equipamentos, dos sistemas e dos programas do ambiente computacional;",
12, ['justification' => 'full', 'spacing' => 1.5]);
$pdf->ezText("o) comunicar imediatamente ao meu superior hierárquico e ao Oficial de Segurança das Informações e Comunicações (OSIC) da OM a ocorrência de qualquer evento que implique ameaça ou impedimento de cumprir os procedimentos de segurança estabelecidos;",
12, ['justification' => 'full', 'spacing' => 1.5]);
$pdf->ezText("p) responder, perante a MB, as auditorias e o Oficial de Segurança das Informações e Comunicações (OSIC) da OM, por acessos, tentativas de acessos ou uso indevido da informação digital realizados com a minha identificação ou autenticação;",
12, ['justification' => 'full', 'spacing' => 1.5]);
$pdf->ezText("q) não praticar quaisquer atos que possam afetar o sigilo ou a integridade da informação;",
12, ['justification' => 'full', 'spacing' => 1.5]);
$pdf->ezText("r) estar ciente de que toda informação digital armazenada e processada no ambiente computacional da OM pode ser auditada, como no caso de páginas informativas (“sites”) visitadas por mim;",
12, ['justification' => 'full', 'spacing' => 1.5]);
$pdf->ezText("s) não transmitir, copiar ou reter arquivos contendo textos, fotos, filmes ou quaisquer outros registros que contrariem a moral, os bons costumes e a legislação vigente;",
12, ['justification' => 'full', 'spacing' => 1.5]);
$pdf->ezText("t) não transferir qualquer tipo de arquivo que pertença à MB para outro local, seja por meio magnético ou não, exceto no interesse do serviço e mediante autorização da autoridade competente;",
12, ['justification' => 'full', 'spacing' => 1.5]);
$pdf->ezText("u) estar ciente de que o processamento, o trâmite e o armazenamento de arquivos que não sejam de interesse do serviço são expressamente proibidos no ambiente computacional da OM;",
12, ['justification' => 'full', 'spacing' => 1.5]);
$pdf->ezText("v) estar ciente de que a MB poderá auditar os arquivos em trâmite ou armazenados nos equipamentos do ambiente computacional da OM sob meu uso ou responsabilidade;",
12, ['justification' => 'full', 'spacing' => 1.5]);
$pdf->ezText("w) estar ciente de que o correio eletrônico é de uso exclusivo para o interesse do serviço e qualquer correspondência eletrônica originada ou retransmitida no ambiente computacional da OM deve obedecer a este preceito; e",
12, ['justification' => 'full', 'spacing' => 1.5]);
$pdf->ezText("x) estar ciente de que a MB poderá auditar as correspondências eletrônicas originadas ou retransmitidas por mim no ambiente computacional da OM. Desta forma, estou ciente da minha responsabilidade pelas conseqüências decorrentes da não observância do acima exposto e da legislação vigente.",
12, ['justification' => 'full', 'spacing' => 1.5]);

$pdf->ezText("\n\n$nome
$postograd $nip_cpf", 12, ['justification' => 'center', 'spacing' => 1.5]);



if (isset($_GET['d']) && $_GET['d']) {
    echo $pdf->ezOutput(true);
} else {
    $pdf->ezStream(['compress' => 0]);
}