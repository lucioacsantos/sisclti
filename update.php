<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/* Classe de interação com o PostgreSQL */
require_once "class/pgsql.class.php";
require_once "class/constantes.inc.php";
$pg = new PgSql();
$url = $pg->getCol("SELECT valor FROM db_clti.tb_config WHERE parametro='URL'");

/* Verifica Sessão de Login Ativa */
if (!isLoggedIn()){
    header("Location: login_clti.php");
}

if (isset($_SESSION['user_name'])){
	$perfil = $_SESSION['perfil']; 
	if ($perfil == 'TEC_CLTI'){

echo"

<!doctype html>
<html lang=\"pt_BR\">
  <head>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
    <meta name=\"description\" content=\"Sistema Integrado para Centros Locais de Tecnologia da Informação\">
    <meta name=\"author\" content=\"99242991 Lúcio ALEXANDRE Correia dos Santos\">

    <title>...::: SisCLTI :::...</title>

    <link href=\"$url/css/bootstrap.min.css\" rel=\"stylesheet\">

    <!-- Dashboard CSS  -->
    <link href=\"$url/css/dashboard.css\" rel=\"stylesheet\">

    <!-- ForValidation CSS  -->
    <link href=\"$url/css/form-validation.css\" rel=\"stylesheet\">

    <!-- Stylesheet CSS -->
    <link href=\"$url/css/stylesheet.css\" rel=\"stylesheet\">

  </head>

  <body>
  <div class=\"alert alert-primary\" role=\"alert\">Executando atualização...</div>";

$versao = $pg->getCol("SELECT valor FROM db_clti.tb_config WHERE parametro='VERSAO' ");

if ($versao == '1.5.1'){

	echo "<div class=\"alert alert-primary\" role=\"alert\">Atualizando Eq. Conectividade. Aguarde...</div>";
	$pg->exec("ALTER TABLE db_clti.tb_conectividade ADD status varchar NULL;");
	$pg->exec("DROP VIEW db_clti.vw_conectividade;");
	$pg->exec("CREATE OR REPLACE VIEW db_clti.vw_conectividade
	AS SELECT conec.idtb_conectividade,
		conec.idtb_om_apoiadas,
		conec.fabricante,
		conec.modelo,
		conec.nome,
		conec.qtde_portas,
		conec.idtb_om_setores,
		conec.end_ip,
		conec.data_aquisicao,
		conec.data_garantia,
		conec.status,
		om.sigla,
		setores.sigla_setor,
		setores.compartimento
	   FROM db_clti.tb_conectividade conec,
		db_clti.tb_om_setores setores,
		db_clti.tb_om_apoiadas om
	  WHERE conec.idtb_om_apoiadas = om.idtb_om_apoiadas AND conec.idtb_om_setores = setores.idtb_om_setores;");

	echo "<div class=\"alert alert-primary\" role=\"alert\">Atualizando Controle de Internet. Aguarde...</div>";
	$pg->exec("ALTER TABLE db_clti.tb_controle_internet ADD status varchar NULL;");

	echo "<div class=\"alert alert-primary\" role=\"alert\">Atualizando Controle de USB Habilitado. Aguarde...</div>";		
	$pg->exec("ALTER TABLE db_clti.tb_controle_usb ADD status varchar NULL;");

	echo "<div class=\"alert alert-primary\" role=\"alert\">Atualizando Controle de Funções do SiGDEM. Aguarde...</div>";
	$pg->exec("ALTER TABLE db_clti.tb_funcoes_sigdem ADD status varchar NULL;");

	echo "<div class=\"alert alert-primary\" role=\"alert\">Registrando nova versão. Aguarde...</div>";
	$pg->exec("UPDATE db_clti.tb_config SET (valor) = ('1.5.2') WHERE parametro='VERSAO' ");
	
	echo "<div class=\"alert alert-success\" role=\"alert\">Seu sistema foi atualizado, Versão 1.5.2. Aguarde...</div>
	<meta http-equiv=\"refresh\" content=\"5\">";
}

elseif ($versao == '1.5.2'){

	echo "<div class=\"alert alert-primary\" role=\"alert\">Atualizando Usuários da OM. Aguarde...</div>";
	$pg->exec("ALTER TABLE db_clti.tb_pessoal_om ADD foradaareati varchar NULL;");

	echo "<div class=\"alert alert-primary\" role=\"alert\">Atualizando Permissões de Administrador. Aguarde...</div>";
	$pg->exec("CREATE TABLE db_clti.tb_permissoes_admin (
		idtb_permissoes_admin serial NOT NULL,
		idtb_om_apoiadas int4 NOT NULL,
		idtb_estacoes int4 NOT NULL,
		autorizacao varchar(255) NOT NULL,
		CONSTRAINT tb_permissoes_admin_pkey PRIMARY KEY (idtb_permissoes_admin),
		CONSTRAINT tb_permissoes_admin_fk FOREIGN KEY (idtb_estacoes) REFERENCES db_clti.tb_estacoes(idtb_estacoes),
		CONSTRAINT tb_permissoes_admin_fk1 FOREIGN KEY (idtb_om_apoiadas) REFERENCES db_clti.tb_om_apoiadas(idtb_om_apoiadas)
	);
	COMMENT ON TABLE db_clti.tb_permissoes_admin IS 'Tabela contendo ET com Permissões de Administrador';");

	echo "<div class=\"alert alert-primary\" role=\"alert\">Atualizando Aplicativos não Padronizados. Aguarde...</div>";
	$pg->exec("CREATE TABLE db_clti.tb_nao_padronizados (
		idtb_nao_padronizados serial NOT NULL,
		idtb_om_apoiadas int4 NOT NULL,
		idtb_estacoes int4 NOT NULL,
		autorizacao varchar(255) NOT NULL,
		CONSTRAINT tb_nao_padronizados_pkey PRIMARY KEY (idtb_nao_padronizados),
		CONSTRAINT tb_nao_padronizados_fk FOREIGN KEY (idtb_estacoes) REFERENCES db_clti.tb_estacoes(idtb_estacoes),
		CONSTRAINT tb_nao_padronizados_fk1 FOREIGN KEY (idtb_om_apoiadas) REFERENCES db_clti.tb_om_apoiadas(idtb_om_apoiadas)
	);
	COMMENT ON TABLE db_clti.tb_nao_padronizados IS 'Tabela contendo ET com Aplicativos não Padronizados';");
	
	echo "<div class=\"alert alert-success\" role=\"alert\">Seu sistema está atualizado, Versão 1.5.3.</div>
	<meta http-equiv=\"refresh\" content=\"5\">";
}

elseif ($versao == '1.5.3'){

	echo "<div class=\"alert alert-primary\" role=\"alert\">Atualizando PAD SIC/TIC. Aguarde...</div>";
	$pg->exec("CREATE TABLE db_clti.tb_pad_sic_tic (
		idtb_pad_sic_tic serial NOT NULL,
		idtb_om_apoiadas int4 NOT NULL,
		ano_base int4 NOT NULL,
		data_assinatura date NOT NULL,
		data_revisao date NULL,
		status VARCHAR NOT NULL,
		CONSTRAINT tb_pad_sic_tic_pkey PRIMARY KEY (idtb_pad_sic_tic),
		CONSTRAINT tb_pad_sic_tic_fk1 FOREIGN KEY (idtb_om_apoiadas) REFERENCES db_clti.tb_om_apoiadas(idtb_om_apoiadas)
	);
	COMMENT ON TABLE db_clti.tb_pad_sic_tic IS 'Tabela contendo PAD SIC/TIC';");

	$pg->exec("CREATE TABLE db_clti.tb_temas_pad_sic_tic (
		idtb_temas_pad_sic_tic serial NOT NULL,
		idtb_pad_sic_tic int4 NOT NULL,
		tema VARCHAR NOT NULL,
		status VARCHAR NOT NULL,
		justificativa VARCHAR NULL,
		CONSTRAINT tb_temas_pad_sic_tic_pkey PRIMARY KEY (idtb_temas_pad_sic_tic),
		CONSTRAINT tb_temas_pad_sic_tic_fk1 FOREIGN KEY (idtb_pad_sic_tic) REFERENCES db_clti.tb_pad_sic_tic(idtb_pad_sic_tic)
	);
	COMMENT ON TABLE db_clti.tb_pad_sic_tic IS 'Tabela contendo Temas do PAD SIC/TIC';");

	$pg->exec("CREATE TABLE db_clti.tb_ade_pad_sic_tic (
		idtb_ade_pad_sic_tic serial NOT NULL,
		idtb_pad_sic_tic int4 NOT NULL,
		idtb_pessoal_om int4 NOT NULL,
		CONSTRAINT tb_ade_pad_sic_tic_pkey PRIMARY KEY (idtb_ade_pad_sic_tic),
		CONSTRAINT tb_ade_pad_sic_tic_fk1 FOREIGN KEY (idtb_pad_sic_tic) REFERENCES db_clti.tb_pad_sic_tic(idtb_pad_sic_tic),
		CONSTRAINT tb_ade_pad_sic_tic_fk2 FOREIGN KEY (idtb_pessoal_om) REFERENCES db_clti.tb_pessoal_om(idtb_pessoal_om)
	);
	COMMENT ON TABLE db_clti.tb_pad_sic_tic IS 'Tabela contendo Participantes dos Adestramentos do PAD SIC/TIC';");

	echo "<div class=\"alert alert-primary\" role=\"alert\">Registrando nova versão. Aguarde...</div>";
	$pg->exec("UPDATE db_clti.tb_config SET (valor) = ('1.5.4') WHERE parametro='VERSAO' ");

	echo "<div class=\"alert alert-success\" role=\"alert\">Seu sistema está atualizado, Versão 1.5.4.</div>
	<meta http-equiv=\"refresh\" content=\"5;url=$url\">";
}

elseif ($versao == '1.5.4'){

	echo "<div class=\"alert alert-success\" role=\"alert\">Seu sistema está atualizado, Versão 1.5.4.</div>
	<meta http-equiv=\"refresh\" content=\"5;url=$url\">";
}

else{
	echo "<div class=\"alert alert-primary\" role=\"alert\">Verifique sua instalação!</div>";
}

/** Encerrando Verifica Sessão de Login Ativa */
	}
}

?>