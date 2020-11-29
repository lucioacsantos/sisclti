<?php

$idtb_estacoes = $conexoes->idtb_estacoes_dest;
if ($idtb_estacoes){
    $estacoes->idtb_estacoes = $conexoes->idtb_estacoes_dest;
    $etid = $estacoes->SelectIdETView();
}
else{
    $etid = (object)['nome'=>'','ip'=>''];
}

echo "
	<div class=\"container-fluid\">
        <div class=\"row\">
            <main>
                <div id=\"form-cadastro\">
                <form id=\"form\" action=\"?cmd=mapainfra&act=insert\" method=\"post\" enctype=\"multipart/form-data\">
                <fieldset>
                    <legend>Estação de Trabalho - Cadastro</legend>

                    <div class=\"form-group\">
                        <label for=\"idtb_estacoes_dest\">ET de Destino::</label>
                        <select id=\"idtb_estacoes_dest\" class=\"form-control\" name=\"idtb_estacoes_dest\">
                            <option value=\"$conexoes->idtb_estacoes_dest\" selected=\"true\">
                                    ".$etid->nome." - ".$etid->ip."</option>";
                                foreach ($etom as $key => $value) {
                                    echo"<option value=\"".$value->idtb_estacoes."\">
                                        ".$value->nome." - ".$value->ip."</option>";
                                };
                            echo "</select>
                    </div>

                    <div class=\"form-group\">
                        <label for=\"porta_orig\">Porta de Origem:</label>
                        <input id=\"porta_orig\" class=\"form-control\" type=\"number\" min=\"1\" name=\"porta_orig\"
                            value=\"$conexoes->porta_orig\" required=\"true\" autocomplete=\"off\">
                    </div>

                </fieldset>
                <input type=\"hidden\" name=\"idtb_om_apoiadas\" value=\"$omapoiada\">
                <input type=\"hidden\" name=\"idtb_conectividade_orig\" value=\"$conexoes->idtb_conectividade_orig\">
                <input type=\"hidden\" name=\"idtb_conectividade_dest\" value=\"$conexoes->idtb_conectividade_dest\">
                <input type=\"hidden\" name=\"idtb_servidores_dest\" value=\"$conexoes->idtb_servidores_dest\">
                <input type=\"hidden\" name=\"idtb_conexoes\" value=\"$conexoes->idtb_mapainfra\">
                <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Salvar\">
            </form>
                </div>
            </main>
        </div>
    </div>";

?>