<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/* Classe de interação com o PostgreSQL */
require_once "class/constantes.inc.php";
$config = new Config();
$user = new Usuario();
$url = $config->SelectURL();

if ($_SESSION['logged_in'] = true){
    if ($_SESSION['perfil'] = 'TEC_CLTI'){
        $idtb_lotacao_clti = $_SESSION['user_id'];
        $user->iduser = $idtb_lotacao_clti;
        $usuario = $user->perfilCLTI();
        if ($usuario->nip != NULL){
            $nip_cpf = $usuario->nip;
        }
        else{
            $nip_cpf = $usuario->cpf;
        }
    }
    else{
        $idtb_pessoal_ti = $_SESSION['user_id'];
        $user->iduser = $idtb_pessoal_ti;
        $usuario = $user->perfilOM();
        if ($usuario->nip != NULL){
            $nip_cpf = $usuario->nip;
        }
        else{
            $nip_cpf = $usuario->cpf;
        }
    }
}
    

?>

<!doctype html>
<html lang="pt_BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema Integrado para Centros Locais de Tecnologia da Informação">
    <meta name="author" content="99242991 Lúcio ALEXANDRE Correia dos Santos">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <?php echo "<link rel=\"icon\" href=\"$url/favicon.ico\">"; ?>

    <title>...::: SisCLTI :::...</title>

    <?php
    /* Carrega CSS a partir da $url */
    echo"
    <!-- Bootstrap core CSS -->
    <link href=\"$url/css/bootstrap.min.css\" rel=\"stylesheet\">

    <!-- Stylesheet CSS -->
    <link href=\"$url/css/signin.css\" rel=\"stylesheet\">";

    ?>

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

  </head>

  <body>

<?php
@$act = $_GET['act'];

if ($act == NULL){
  echo "<form class=\"form-signin\" id=\"login\" role=\"form\" action=\"?act=alterar\" 
                method=\"post\" enctype=\"multipart/form-data\">
            <h1 class=\"h3 mb-3 font-weight-normal\">Alteração de Senha</h1>
            <label for=\"usuario\" class=\"sr-only\">NIP ou CPF</label>
            <input type=\"text\" name=\"usuario\" id=\"usuario\" class=\"form-control\" placeholder=\"$nip_cpf\" 
                required readonly>
            <label for=\"senha\" class=\"sr-only\">Senha</label>
            <input type=\"password\" name=\"senha\" id=\"senha\" class=\"form-control\" placeholder=\"Senha\" required>
            <div class=\"help-block with-errors\"></div>
            <label for=\"confirmasenha\" class=\"sr-only\">Repita a Senha</label>
            <input type=\"password\" name=\"confirmasenha\" id=\"confirmasenha\" class=\"form-control\" 
                placeholder=\"Repita a Senha\" required>
            <div class=\"help-block with-errors\"></div>   
            <button class=\"btn btn-lg btn-primary btn-block\" type=\"submit\">Trocar</button>
     </form>";
}

/* Método Login */
if ($act == 'alterar') {
    $usr->usuario = $_POST['usuario'];
    $hash = sha1(md5($_POST['senha']));
    $salt = sha1(md5($usr->usuario));
    $senha = $salt.$hash;
    if ($_SESSION['perfil'] = 'TEC_CLTI'){
        $clti = new PessoalCLTI();
        $clti->idtb_lotacao_clti = $_SESSION['user_id'];
        $row = $clti->UpdateSenha;
        if ($row){
            $pwd = $user->SetVencSenha;
            // muda o valor de logged_in para false
            $_SESSION['logged_in'] = false;
            // finaliza a sessão
            session_destroy();
            echo "<h5>Senha alterada.</h5>
            <meta http-equiv=\"refresh\" content=\"5;url=?index.php\">";
        }
        else {
            echo "<h5>Ocorreu algum erro, tente novamente.</h5>
            <meta http-equiv=\"refresh\" content=\"1;url=?index.php\">";
        }
    }
    else{
        $ti = new PessoalTI();
        $ti->idtb_pessoal_ti = $_SESSION['user_id'];
        $row = $ti->UpdateSenhaPesti;
        if ($row){
            $pwd = $user->SetVencSenha;
            $pwd = $user->SetVencSenha;
            // muda o valor de logged_in para false
            $_SESSION['logged_in'] = false;
            // finaliza a sessão
            session_destroy();
            echo "<h5>Senha alterada.</h5>
            <meta http-equiv=\"refresh\" content=\"5;url=?index.php\">";
        }
        else {
            echo "<h5>Ocorreu algum erro, tente novamente.</h5>
            <meta http-equiv=\"refresh\" content=\"1;url=?index.php\">";
        }
    }
}

/* Carrega JS a partir da $url */
    echo "
    <script src=\"$url/js/jquery-3.3.1.slim.min.js\"></script>
    <script>window.jQuery || document.write('<script src=\"$url/js/jquery-slim.min.js\"><\/script>')</script>
    <script src=\"$url/js/popper.min.js\"></script>
    <script src=\"$url/js/bootstrap.min.js\"></script>
    <script src=\"$url/js/holder.min.js\"></script>
    <script src=\"$url/js/jquery.validate.min.js\"></script>

    <!-- Icons -->
    <script src=\"$url/js/feather.min.js\"></script>
    <script>
      feather.replace()
    </script>

    <!-- Graphs -->
    <script src=\"$url/js/Chart.min.js\"></script>
    <script src=\"$url/js/utils.js\"></script>

    <!-- Cidades | Estados -->
    <script src=\"$url/js/cidades-estados-utf8.js\"></script>";
?>

    <!-- Validação com Jquery -->
    <script type="text/javascript">
		//$.validator.setDefaults( {
			//submitHandler: function () {
				//alert( "submitted!" );
			//}
		//} );
		$( document ).ready( function () {
            $( "#insereusuario" ).validate( {
                rules: {
                    senha: {
                        required: true,
                        minlength: 8
                    },
                    confirmasenha: {
                        required: true,
                        minlength: 8,
                        equalTo: "#senha"
            },
            },
                messages: {
                    senha: {
                        required: "Por favor informe a senha",
                        minlength: "A Senha deve possuir acima de 8 caracteres"
                    },
                    confirmasenha: {
                        required: "Por favor informe a senha",
                        minlength: "A Senha deve possuir acima de 8 caracteres",
                        equalTo: "As Senhas estão diferentes"
                    },
                },
            } );
		} );
	</script>
    <!-- JavaScript desabilita form submit quando existirem campos inválidos -->
    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                /* Verifica todos os forms para aplicar avalidação do Bootstrap */
                var forms = document.getElementsByClassName('needs-validation');
                /* Loop para prevenir o submit */
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                    form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>