<?php

echo "
	<div class=\"container-fluid\">
        <div class=\"row\">
            <main>
                <div id=\"form-cadastro\">
                <form id=\"form\" action=\"?cmd=mapainfra&act=insert\" method=\"post\" enctype=\"multipart/form-data\">
                <fieldset>
                    <legend>Estação de Trabalho - Cadastro</legend>

                    <input type=\"hidden\" name=\"idtb_om_apoiadas\" value=\"$omapoiada\">

                    <div class=\"form-group\">
                        <label for=\"idtb_conectividade_orig\">Eq. Conect. de Origem:</label>
                        <input id=\"idtb_conectividade_orig\" class=\"form-control\" type=\"text\" 
                            name=\"idtb_conectividade_orig\" placeholder=\"ex. CISCO\" style=\"text-transform:uppercase\" 
                            autocomplete=\"off\" value=\"$conexoes->idtb_conectividade_orig\" required=\"true\">
                    </div>

                    <div class=\"form-group\">
                        <label for=\"idtb_conectividade_dest\">Eq. Conect. de Destino::</label>
                        <input id=\"idtb_conectividade_dest\" class=\"form-control\" type=\"text\" 
                            name=\"idtb_conectividade_dest\" placeholder=\"ex. C3750-48PS-S\" style=\"text-transform:uppercase\" 
                            autocomplete=\"off\" value=\"$conexoes->idtb_conectividade_dest\" required=\"true\">
                    </div>

                    <div class=\"form-group\">
                        <label for=\"idtb_servidores_dest\">Eq. Servidor de Destino::</label>
                        <input id=\"idtb_servidores_dest\" class=\"form-control\" type=\"number\" name=\"idtb_servidores_dest\"
                            placeholder=\"Qtde. Portas\" value=\"$conexoes->idtb_servidores_dest\" required=\"true\">
                    </div>

                    <div class=\"form-group\">
                        <label for=\"idtb_estacoes_dest\">ET de Destino::</label>
                        <input id=\"idtb_estacoes_dest\" class=\"form-control\" type=\"text\" name=\"idtb_estacoes_dest\"
                            placeholder=\"ex. 192.168.1.1\" style=\"text-transform:uppercase\" autocomplete=\"off\"
                            value=\"$conexoes->idtb_estacoes_dest\">
                    </div>

                    <div class=\"form-group\">
                        <label for=\"porta_orig\">Porta de Origem:</label>
                        <input id=\"porta_orig\" class=\"form-control\" type=\"number\" min=\"1\" name=\"porta_orig\"
                            style=\"text-transform:uppercase\" value=\"$conexoes->porta_orig\" 
                            required=\"true\" autocomplete=\"off\">
                    </div>

                    <div class=\"form-group\">
                        <label for=\"porta_dest\">Posta de Destino:</label>
                        <input id=\"porta_dest\" class=\"form-control\" type=\"number\" min=\"1\" name=\"porta_dest\"
                            style=\"text-transform:uppercase\"value=\"$conexoes->porta_dest\"
                            required=\"true\" autocomplete=\"off\">
                    </div>

                </fieldset>
                <input id=\"idtb_conexoes\" type=\"hidden\" name=\"idtb_conexoes\" value=\"$conexoes->idtb_mapainfra\">
                <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Salvar\">
            </form>
                </div>
            </main>
        </div>
    </div>";

?>