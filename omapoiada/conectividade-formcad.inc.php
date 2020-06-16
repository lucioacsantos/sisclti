<?php

echo "
	<div class=\"container-fluid\">
        <div class=\"row\">
            <main>
                <div id=\"form-cadastro\">
                <form id=\"form\" action=\"?cmd=conectividade&act=insert\" method=\"post\" enctype=\"multipart/form-data\">
                <fieldset>
                    <legend>Equipamentos de Conectividade - Cadastro</legend>

                    <input type=\"hidden\" name=\"idtb_om_apoiadas\" value=\"$idtb_om_apoiadas\">

                    <div class=\"form-group\">
                        <label for=\"fabricante\">Fabricante:</label>
                        <input id=\"fabricante\" class=\"form-control\" type=\"text\" name=\"fabricante\"
                              placeholder=\"ex. CISCO\" style=\"text-transform:uppercase\"
                              value=\"$conectividade->fabricante\" required=\"true\">
                    </div>

                    <div class=\"form-group\">
                        <label for=\"modelo\">Modelo:</label>
                        <input id=\"modelo\" class=\"form-control\" type=\"text\" name=\"modelo\"
                              placeholder=\"ex. C3750-48PS-S\" style=\"text-transform:uppercase\"
                              value=\"$conectividade->modelo\" required=\"true\">
                    </div>

                    <div class=\"form-group\">
                        <label for=\"end_ip\">Endereço IP:</label>
                        <input id=\"end_ip\" class=\"form-control\" type=\"text\" name=\"end_ip\"
                               placeholder=\"ex. 192.168.1.1\" style=\"text-transform:uppercase\"
                               value=\"$conectividade->end_ip\">
                    </div>

                    <div class=\"form-group\">
                        <label for=\"localizacao\">Localização:</label>
                        <input id=\"localizacao\" class=\"form-control\" type=\"text\" name=\"localizacao\"
                            placeholder=\"ex. Sala de Servidores\"style=\"text-transform:uppercase\"
                            value=\"$conectividade->localizacao\" required=\"true\">
                    </div>

                    <div class=\"form-group\">
                        <label for=\"data_aquisicao\">Data de Aquisição:</label>
                        <input id=\"data_aquisicao\" class=\"form-control\" type=\"date\" name=\"data_aquisicao\"
                            style=\"text-transform:uppercase\" value=\"$conectividade->data_aquisicao\"
                            required=\"true\">
                    </div>

                    <div class=\"form-group\">
                        <label for=\"data_garantia\">Final da Garantia/Suporte:</label>
                        <input id=\"data_garantia\" class=\"form-control\" type=\"date\" name=\"data_garantia\"
                            style=\"text-transform:uppercase\"value=\"$conectividade->data_garantia\"
                            required=\"true\">
                    </div>

                </fieldset>
                <input id=\"idtb_conectividade\" type=\"hidden\" name=\"idtb_conectividade\" 
                            value=\"$conectividade->idtb_conectividade\">
                <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Salvar\">
            </form>
                </div>
            </main>
        </div>
    </div>";

?>