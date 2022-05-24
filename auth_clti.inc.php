<?php
echo "        
<form class=\"form-signin\" id=\"login\" role=\"form\" action=\"?act=auth\" 
  method=\"post\" enctype=\"multipart/form-data\">
  <h1 class=\"h3 mb-3 font-weight-normal\">Autenticação</h1>
  <label for=\"codigo\" class=\"sr-only\">Digite o código</label>
  <input type=\"text\" id=\"codigo\" name=\"codigo\" class=\"form-control\" placeholder=\"Código de autenticação\" 
    autocomplete=\"off\" required autofocus>
  <input type=\"hidden\" id=\"iduser\" name=\"iduser\" value=\"$row->idtb_lotacao_clti\" />
  <button class=\"btn btn-lg btn-primary btn-block\" type=\"submit\">Entrar</button>
</form>";
?>