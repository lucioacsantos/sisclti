<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/* Classe de interação com o PostgreSQL */
require_once "class/pgsql.class.php";
$pg = new PgSql();
$url = $pg->getCol("SELECT valor FROM db_clti.tb_config WHERE parametro='URL'");

echo"

<!doctype html>
<html lang=\"pt_BR\">
  <head>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
    <meta name=\"description\" content=\"Sistema Integrado para Centros Locais de Tecnologia da Informação\">
    <meta name=\"author\" content=\"99242991 Lúcio ALEXANDRE Correia dos Santos\">

    <title>...::: SisCLTI :::...</title>

    <link href=\"url/css/bootstrap.min.css\" rel=\"stylesheet\">

    <!-- Dashboard CSS  -->
    <link href=\"url/css/dashboard.css\" rel=\"stylesheet\">

    <!-- ForValidation CSS  -->
    <link href=\"url/css/form-validation.css\" rel=\"stylesheet\">

    <!-- Stylesheet CSS -->
    <link href=\"url/css/stylesheet.css\" rel=\"stylesheet\">

  </head>

  <body>
  <p><h5>Executando atualização...</h5></p>";

$versao = $pg->getCol("SELECT valor FROM db_clti.tb_config WHERE parametro='VERSAO' ");

if ($versao == '1.0'){
	$pg->exec("CREATE TABLE db_clti.tb_om_setores (
		idtb_om_setores serial NOT NULL,
		idtb_om_apoiadas int4 NOT NULL,
		nome_setor varchar(255) NOT NULL,
		sigla_setor varchar(255) NULL,
		cod_funcional varchar(45) NULL,
		compartimento varchar(255) NULL,
		CONSTRAINT tb_om_setores_fk FOREIGN KEY (idtb_om_apoiadas) REFERENCES db_clti.tb_om_apoiadas(idtb_om_apoiadas)
	);
	CREATE INDEX tb_om_setores_idtb_om_setores_idx ON db_clti.tb_om_setores USING btree (idtb_om_setores);");

	$pg->exec("UPDATE db_clti.tb_config SET (valor) = ('1.1') WHERE parametro='VERSAO' ");
	
	echo "<p><h5>Atualização finalizada, Versão 1.1.</h5></p>
	<meta http-equiv=\"refresh\" content=\"5;url=$url\">";
}

elseif ($versao == '1.1'){

	$pg->exec("DROP VIEW db_clti.vw_setores");

	$pg->exec("DROP TABLE db_clti.tb_om_setores");

	$pg->exec("CREATE TABLE db_clti.tb_om_setores (
		idtb_om_setores serial NOT NULL,
		idtb_om_apoiadas int4 NOT NULL,
		nome_setor varchar(255) NOT NULL,
		sigla_setor varchar(255) NOT NULL,
		cod_funcional varchar(45) NOT NULL,
		compartimento varchar(255) NOT NULL,
		CONSTRAINT tb_om_setores_pk PRIMARY KEY (idtb_om_setores)
		)");

	$pg->exec("CREATE UNIQUE INDEX tb_om_setores_idtb_om_setores_idx ON db_clti.tb_om_setores USING btree (idtb_om_setores)");

	$pg->exec("DROP VIEW db_clti.vw_estacoes");

	$pg->exec("ALTER TABLE db_clti.tb_estacoes DROP COLUMN localizacao");

	$pg->exec("ALTER TABLE db_clti.tb_estacoes ADD COLUMN idtb_om_setores INT NOT NULL");

	$pg->exec("ALTER TABLE db_clti.tb_estacoes ADD CONSTRAINT tb_estacoes_fk_4 FOREIGN KEY (idtb_om_setores) 
		REFERENCES db_clti.tb_om_setores(idtb_om_setores)");

	$pg->exec("CREATE OR REPLACE VIEW db_clti.vw_estacoes
		AS SELECT et.idtb_estacoes,et.idtb_om_apoiadas,et.idtb_proc_modelo,et.clock_proc,
			et.fabricante,et.modelo,et.memoria,mem.tipo AS tipo_mem,mem.modelo AS modelo_mem,
			mem.clock AS clock_mem,et.armazenamento,et.idtb_sor,et.end_ip,et.end_mac,
			et.data_aquisicao,et.data_garantia,et.idtb_om_setores,setores.sigla_setor,
			setores.compartimento,et.req_minimos,et.status,om.sigla,fab.idtb_proc_fab,
			fab.nome AS proc_fab,modelo.modelo AS proc_modelo,sor.descricao,sor.versao,sor.situacao
		FROM db_clti.tb_estacoes et,
			db_clti.tb_proc_fab fab,
			db_clti.tb_proc_modelo modelo,
			db_clti.tb_om_apoiadas om,
			db_clti.tb_sor sor,
			db_clti.tb_om_setores setores,
			db_clti.tb_memorias mem
		WHERE et.idtb_proc_modelo = modelo.idtb_proc_modelo AND et.idtb_om_apoiadas = om.idtb_om_apoiadas 
			AND et.idtb_sor = sor.idtb_sor AND modelo.idtb_proc_fab = fab.idtb_proc_fab 
			AND et.idtb_memorias = mem.idtb_memorias AND et.idtb_om_setores = setores.idtb_om_setores");
	
	$pg->exec("CREATE OR REPLACE VIEW db_clti.vw_setores
		AS SELECT setores.idtb_om_setores,
			setores.idtb_om_apoiadas,
			setores.nome_setor,
			setores.sigla_setor,
			setores.cod_funcional,
			setores.compartimento,
			om.sigla AS sigla_om,
			om.indicativo AS indicativo_om
		FROM db_clti.tb_om_setores setores,
			db_clti.tb_om_apoiadas om
		WHERE setores.idtb_om_apoiadas = om.idtb_om_apoiadas");
	
	$pg->exec("UPDATE db_clti.tb_config SET valor = '1.2' WHERE parametro='VERSAO' ");
		
	echo "<p><h5>Atualização finalizada, Versão 1.2.</h5></p>
	<meta http-equiv=\"refresh\" content=\"5;url=$url\">";
}

elseif ($versao == '1.2'){
	echo "<p><h5>Seu sistema está atualizado, Versão 1.2.</h5></p>
	<meta http-equiv=\"refresh\" content=\"5;url=$url\">";
}

else{
	$sql = "CREATE TABLE db_clti.tb_memorias (
		idtb_memorias serial NOT NULL,
		tipo varchar(255) NOT NULL,
		modelo varchar(255) NOT NULL,
		clock int4 NOT NULL,
		CONSTRAINT tb_memorias_pkey PRIMARY KEY (idtb_memorias)
	);";
	$pg->exec($sql);
	
	$sql = "INSERT INTO db_clti.tb_memorias(tipo,modelo,clock) values ('DDR', 'PC-1600',	200),
	('DDR', 'PC-2100',	266),('DDR', 'PC-2400', 300),('DDR', 'PC-2700', 333),('DDR', 'PC-3000', 370),
	('DDR', 'PC-3200', 400),('DDR', 'PC-3700', 466),('DDR', 'PC-4000', 500),('DDR2', 'PC2-4200', 533),
	('DDR2', 'PC2-5300', 667),('DDR2', 'PC2-6400', 800),('DDR2', 'PC2-7400', 933),('DDR2', 'PC2-8500', 1066),
	('DDR2', 'PC2-9600', 1200),('DDR2', 'PC2-1066', 1333),('DDR3', 'PC3-6400', 800),('DDR3', 'PC3-8500', 1066),
	('DDR3', 'PC3-10600', 1333),('DDR3', 'PC3-12800', 1600),('DDR3', 'PC3-14900', 1866),('DDR3', 'PC3-16000', 2000),
	('DDR3', 'PC3-17000', 2133),('DDR3', 'PC3-19200', 2400),('DDR3', 'PC3-20800', 2600),('DDR3', 'PC3-22400', 2800),
	('DDR4', 'PC4-12800', 1600),('DDR4', 'PC4-14900', 1866),('DDR4', 'PC4-17000', 2133),('DDR4', 'PC4-19200', 2400),
	('DDR4', 'PC4-21300', 2666),('DDR4', 'PC4-25600', 3200),('DDR4', 'PC4-27700', 3466),('DDR4', 'PC4-28000', 3600),
	('DDR4', 'PC4-32000', 4000);";
	$pg->exec($sql);
	
	$sql = "ALTER TABLE db_clti.tb_estacoes ADD idtb_memorias int4 NULL";
	$pg->exec($sql);
	
	$sql = "UPDATE db_clti.tb_estacoes SET idtb_memorias = 1";
	$pg->exec($sql);
	
	$sql = "ALTER TABLE db_clti.tb_estacoes ADD CONSTRAINT tb_estacoes_fk FOREIGN KEY (idtb_memorias) 
		REFERENCES db_clti.tb_memorias(idtb_memorias)";
	$pg->exec($sql);
	
	$sql = "ALTER TABLE db_clti.tb_estacoes ADD CONSTRAINT tb_estacoes_fk_1 FOREIGN KEY (idtb_om_apoiadas) 
		REFERENCES db_clti.tb_om_apoiadas(idtb_om_apoiadas)";
	$pg->exec($sql);
	
	$sql = "ALTER TABLE db_clti.tb_estacoes ADD CONSTRAINT tb_estacoes_fk_2 FOREIGN KEY (idtb_proc_modelo) 
		REFERENCES db_clti.tb_proc_modelo(idtb_proc_modelo)";
	$pg->exec($sql);
	
	$sql = "ALTER TABLE db_clti.tb_estacoes ADD CONSTRAINT tb_estacoes_fk_3 FOREIGN KEY (idtb_sor) 
		REFERENCES db_clti.tb_sor(idtb_sor)";
	$pg->exec($sql);
	
	$sql = "ALTER TABLE db_clti.tb_memorias ALTER COLUMN clock SET NOT NULL;";
	$pg->exec($sql);
	
	$sql = "INSERT INTO db_clti.tb_config (parametro,valor) VALUES ('VERSAO','1.0')";
	$pg->exec($sql);
	
	$sql = "CREATE OR REPLACE VIEW db_clti.vw_estacoes
	AS SELECT et.idtb_estacoes, et.idtb_om_apoiadas, et.idtb_proc_modelo, et.clock_proc,
		et.fabricante, et.modelo, et.memoria, mem.tipo AS tipo_mem, mem.modelo AS modelo_mem,
		mem.clock AS clock_mem, et.armazenamento, et.idtb_sor, et.end_ip, et.end_mac,
		et.data_aquisicao, et.data_garantia, et.localizacao, et.req_minimos, et.status,
		om.sigla, fab.idtb_proc_fab, fab.nome AS proc_fab, modelo.modelo AS proc_modelo,
		sor.descricao, sor.versao, sor.situacao
	   FROM db_clti.tb_estacoes et, db_clti.tb_proc_fab fab, db_clti.tb_proc_modelo modelo,
		db_clti.tb_om_apoiadas om, db_clti.tb_sor sor, db_clti.tb_memorias mem
	  WHERE et.idtb_proc_modelo = modelo.idtb_proc_modelo AND et.idtb_om_apoiadas = om.idtb_om_apoiadas 
		  AND et.idtb_sor = sor.idtb_sor AND modelo.idtb_proc_fab = fab.idtb_proc_fab 
		  AND et.idtb_memorias = mem.idtb_memorias;";
	$pg->exec($sql);
	
	echo "<p><h5>Atualização finalizada, Versão 1.0, acesse o sistema novamente.</h5></p>";
}



?>