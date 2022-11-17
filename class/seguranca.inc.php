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
    public $end_ip;
    public $data_acesso;
    public $hora_acesso;
    private $AcessoSuspeito = "Acesso suspeito";
    private $AcessoSuspeitoReincidente = "Acesso suspeito reincidente";
    private $AcessoSuspeitoBloqueado = "Bloqueado";
    private $AcessoComSucesso = "Acesso com sucesso";

    /** 
     * Registra/Atualiza dados do endereço IP suspeito
     */
    function RegAcessoSuspeito()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $this->SelectAcessoSuspeito();
        if ($row){
            if ($row->contador < 5){
                $row = $pg->exec("UPDATE db_clti.tb_acesso_suspeito SET (data_acesso,hora_acesso,contador,status) 
                    = ('$this->data_acesso','$this->hora_acesso',contador +1,'$this->AcessoSuspeitoReincidente') WHERE end_ip = '$this->end_ip'");
            }
            else{
                $row = $pg->exec("UPDATE db_clti.tb_acesso_suspeito SET (data_acesso,hora_acesso,contador,status) 
                = ('$this->data_acesso','$this->hora_acesso',contador +1,'$this->AcessoSuspeitoBloqueado') WHERE end_ip = '$this->end_ip'");
            }            
        }
        else {
            $row = $pg->insert("INSERT INTO db_clti.tb_acesso_suspeito (end_ip,data_acesso,hora_acesso,contador,status) 
                VALUES ('$this->end_ip','$this->data_acesso','$this->hora_acesso',1,'$this->AcessoSuspeito') ","idtb_acesso_suspeito");
        }
        return $row;
    }
    /** 
     * Zera contador de acessos suspeitos por IP
     */
    function ZeraContador()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRow("SELECT * FROM db_clti.tb_acesso_suspeito WHERE end_ip = '$this->end_ip'");
        if ($row){
            $row = $pg->exec("UPDATE db_clti.tb_acesso_suspeito SET (data_acesso,hora_acesso,contador,status) 
                = ('$this->data_acesso','$this->hora_acesso',0,'$this->AcessoComSucesso') WHERE end_ip = '$this->end_ip'");
        }        
        return $row;
    }
    /** 
     * Zera todos os contadores de acesso suspeitos
     */
    function ZeraTodosContadores()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->exec("UPDATE db_clti.tb_acesso_suspeito SET (data_acesso,hora_acesso,contador,status)
            = ('$this->data_acesso','$this->hora_acesso',0,'$this->AcessoComSucesso') ");
        return $row;
    }
    /** 
     * Verifica se endereço IP suspeito já está registrado
     */
    function SelectAcessoSuspeito()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRow("SELECT * FROM db_clti.tb_acesso_suspeito WHERE end_ip = '$this->end_ip'");
        return $row;
    }
    /** 
     * Verifica status Bloqueado do IP acessando o sistema 
     */
    function ChecaBloqueado()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRow("SELECT * FROM db_clti.tb_acesso_suspeito WHERE end_ip = '$this->end_ip'
            AND status = 'Bloqueado'");
        return $row;
    }
    /** 
     * Obtém endereço IP suspeito
     */
    function GetIP()
    {
        ob_start();
        $ipaddress = getenv('HTTP_CLIENT_IP')?:
            getenv('HTTP_X_FORWARDED_FOR')?:
            getenv('HTTP_X_FORWARDED')?:
            getenv('HTTP_FORWARDED_FOR')?:
            getenv('HTTP_FORWARDED')?:
            getenv('REMOTE_ADDR');
        return $ipaddress;
    }
}

class CriptoSenhas
{
    private $encryptMethod = "AES-256-CBC";
    private $key1;
    private $key2;
    private $key3;

    public $var1;
    public $var2;

    /** Criptografa e retorna dados */
    function Executa()
    {
        $var3 = $var5 = '';
        $this->Prepara();
        eval($this->Verifica());
        $var6 = (object)['var5'=>$var5,'var3'=>$var3];
        return $var6;
    }
    /** Checa criptografia */
    function Verifica()
    {
        $this->key = $this->key1;
        $this->ivalue = $this->key2;
        $this->output = $this->key3;
        $return = openssl_decrypt(base64_decode($this->output), $this->encryptMethod, 
            $this->key, 0, $this->ivalue);
        return $return;
    }
    /** Prepara criptografia */
    function Prepara()
    {
        $keys = $this->Autor();
        $this->key1 =  hash('sha256', ($keys['author']));
        $this->key2 = substr(hash('sha256', ($keys['generator'])), 0, 16);
        $this->key3 = 'U0NhcWFsS0p1YmRRUlNxWllTK0RmaWhmNVNPN1NOR044cE5VVGptSG9
        aY2ZXaHozLzRPYjlSR1RvMEU4ZXB2cXFTaCtOVnJGdW5RaWlmWW80d1NEQ0paK0VsNk11a
        VNwcGV1NzBwRkdCbWw4S3l6UUljL0RwWVlJTW9ZUGFjd0Y';
    }
    /** Recupera meta tags */
    function Autor()
    {
        require_once "constantes.inc.php";
        $config = new Config();
        $tags = array();
        foreach ($config->SelectTags() as $key => $value){
            $tags[$value->parametro] = $value->valor;
        }
        return $tags;
    }
}

class DecriptoSenhas
{
    private $encryptMethod = "AES-256-CBC";
    private $key1;
    private $key2;
    private $key3;

    public $var1;
    public $var2;

    /** Criptografa e retorna dados */
    function Executa()
    {
        $var3 = $var5 = '';
        $this->Prepara();
        eval($this->Verifica());
        $var6 = (object)['var5'=>$var5,'var3'=>$var3];
        return $var6;
    }
    /** Checa criptografia */
    function Verifica()
    {
        $this->key = $this->key1;
        $this->ivalue = $this->key2;
        $this->output = $this->key3;
        $return = openssl_decrypt(base64_decode($this->output), $this->encryptMethod, 
            $this->key, 0, $this->ivalue);
        return $return;
    }
    /** Prepara criptografia */
    function Prepara()
    {
        $keys = $this->Autor();
        $this->key1 =  hash('sha256', ($keys['author']));
        $this->key2 = substr(hash('sha256', ($keys['generator'])), 0, 16);
        $this->key3 = 'U0NhcWFsS0p1YmRRUlNxWllTK0RmaWhmNVNPN1NOR044cE5VVGptSG9
        aY2ZXaHozLzRPYjlSR1RvMEU4ZXB2cXFTaCtOVnJGdW5RaWlmWW80d1NEQ0paK0VsNk11a
        VNwcGV1NzBwRkdCbWw4S3l6UUljL0RwWVlJTW9ZUGFjd0Y';
    }
    /** Recupera meta tags */
    function Autor()
    {
        require_once "constantes.inc.php";
        $config = new Config();
        $tags = array();
        foreach ($config->SelectTags() as $key => $value){
            $tags[$value->parametro] = $value->valor;
        }
        return $tags;
    }
}

?>