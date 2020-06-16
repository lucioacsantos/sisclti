<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/* Classe de interação com o PostgreSQL */
require_once "class/pgsql.class.php";
$pg = new PgSql();

echo "Executando atualização...";

$sql = "ALTER TABLE db_clti.tb_estacoes ADD idtb_memorias int4 NOT NULL";
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

$sql = "UPDATE db_clti.tb_estacoes SET idtb_memorias = 1";
$pg->exec($sql);

?>