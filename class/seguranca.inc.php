<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/**
 *  
 * Classe Segurança - Contém ações para garantir a segurança geral do sistema
 * 
 * */
class Seguranca
{
    public $idtb_clti;
    public $idtb_config;
    public $valor;
    public $nome;
    public $sigla;
    public $indicativo;
    public $data_ativacao;
    public $publicacao;
    public $datapublicacao;
    public $tipoclti;
    public $lotacaooficiais;
    public $lotacaopracas;
    public $ordena;

    /** 
     * Função para recuperar a URL do sistema a partir do banco
     * Utilizado na construção do html
     */
    function RegAcessoSuspeito()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getCol("SELECT valor FROM db_clti.tb_config WHERE parametro='URL'");
        return $row;
    }
    function GetMACAdd()
    {
        ob_start();
        system('getmac');
        $Content = ob_get_contents();
        ob_clean();
        return substr($Content, strpos($Content,'\\')-20, 17);
    }
}