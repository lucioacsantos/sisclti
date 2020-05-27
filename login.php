<?php
/**
 * Login
 * Form para login dos administradores de OM
 * login.php
 * 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/* Classe de interação com o PostgreSQL */
require_once "class/pgsql.class.php";
$pg = new PgSql();

/* URL Recuperada do Banco de Dados */
$url = $pg->getCol("SELECT valor FROM db_clti.tb_config WHERE parametro='URL'");

/* Carrega Estrutura das Páginas */
include "head.php";

//include "nav.php";

@$act = $_GET['act'];

echo "
        <main role=\"main\" class=\"col-md-9 ml-sm-auto col-lg-10 px-4\">
          <div class=\"d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom\">
            <h1 class=\"h2\">SisCLTI - Login do Usuário</h1><a href=\"login_clti.php\">Clique aqui pata Téc. CLTI</a>
            <div class=\"btn-toolbar mb-2 mb-md-0\">
              <div class=\"btn-group mr-2\">
                <!--
                <a href=\"?cmd=tipoclti\"><button class=\"btn btn-sm btn-outline-secondary\">Tipo do CLTI</button></a>
                <a href=\"?cmd=gerclti\"><button class=\"btn btn-sm btn-outline-secondary\">Gerenciamento do CLTI</button></a>
                -->
              </div>
            </div>
          </div>
          <div class=\"container-fluid\">
            <div class=\"row\">
                <main>
                    <div id=\"form-login\">
                        <form id=\"login\" role=\"form\" action=\"?act=acesso\" 
                            method=\"post\" enctype=\"multipart/form-data\">
                            <fieldset>
                                <legend>Login de Usuário</legend>

                                <div class=\"form-group\">
                                    <label for=\"usuario\" class=\"control-label\">Login do Admin:</label>
                                    <input id=\"usuario\" class=\"form-control\" type=\"text\" name=\"usuario\"
                                            style=\"text-transform:uppercase\" placeholder=\"NIP ou CPF\" 
                                            required=\"true\" autofocus=\"autofocus\">
                                    <div class=\"help-block with-errors\"></div>
                                </div>

                                <div class=\"form-group\">
                                    <label for=\"senha\" class=\"control-label\">Senha:</label>
                                    <input id=\"senha\" class=\"form-control\" type=\"password\" name=\"senha\"
                                            placeholder=\"Senha Segura\" required=\"true\">
                                    <div class=\"help-block with-errors\"></div>
                                </div>
                            </fieldset>
                            <input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Entrar\">
                        </form>
                    </div>
		        </main>
            </div>
        </div>";

//include "foot.php";

/* Método Login */
if ($act == 'acesso') {
  $usuario = $_POST['usuario'];
  $senha = $_POST['senha'];
  
  $hash = sha1(md5($senha));
  $salt = sha1(md5($usuario));
  $senha = $salt.$hash;

  $sql = "SELECT * FROM db_clti.tb_admin WHERE nip = '$usuario' AND senha = '$senha'
    OR cpf = '$usuario' AND senha = '$senha'";
  
  $row = $pg->getRow($sql);
  
	if ($row != NULL) {
        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = $row->idtb_admin;
        $_SESSION['user_name'] = $row->nome_guerra;
        $_SESSION['perfil'] = $row->perfil;
        $_SESSION['status'] = $row->status;

        $row = $pg->getRow("SELECT * FROM db_clti.tb_om_apoiadas WHERE idtb_om_apoiadas  = '$row->id_om' ");
        
        $_SESSION['id_om_apoiada'] = $row->idtb_om_apoiada;
        $_SESSION['om_apoiada'] = $row->sigla;
        
        header('Location: index.php');
	}

	else {
		echo "<h5>Ocorreu algum erro, tente novamente.</h5>";
        echo(pg_result_error($pg) . "<br />\n");
	}
}

?>