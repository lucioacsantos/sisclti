<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/* Classe PgSQL */
class ConsultaSQL
{
    public function insert($tabela,$campos,$valores) 
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $query = $pg->exec("INSERT INTO $tabela ($campos) VALUES ($valores)");
        return $query;
    }

    public function update($tabela,$campos,$valores,$condicoes) 
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $query = $pg->exec("UPDATE $tabela SET ($campos) = ($valores) WHERE $condicoes");
        return $query;
    }

    public function select($tabela,$condicoes,$ordenacao)
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $query = $pg->getRow("SELECT * FROM $tabela WHERE $condicoes ORDER BY $ordenacao");
        return $query;
    }

    public function omapoiadas($coluna,$valor)
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();

        if ($coluna){
            $query = $pg->getRows("SELECT * FROM db_clti.tb_om_apoiadas WHERE $coluna='$valor' ORDER BY cod_om ASC");
        }
        else{
            $query = $pg->getRows("SELECT * FROM db_clti.tb_om_apoiadas ORDER BY cod_om ASC");
        }
        if (pg_last_error()) exit(pg_last_error());
        return $query;
    }

    public function setores($coluna,$valor)
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();

        if ($coluna){
            $query = $pg->getRows("SELECT * FROM db_clti.tb_om_setores WHERE $coluna='$valor' ORDER BY idtb_om_apoiadas ASC");
        }
        else{
            $query = $pg->getRows("SELECT * FROM db_clti.tb_om_setores ORDER BY idtb_om_apoiadas ASC");
        }
        if (pg_last_error()) exit(pg_last_error());
        return $query;
    }

}
/*
    SELECT * FROM db_clti.vw_conectividade WHERE idtb_conectividade = '$param'
    SELECT end_ip FROM db_clti.tb_conectividade WHERE end_ip = '$end_ip'
    
    SELECT * FROM db_clti.vw_estacoes WHERE idtb_estacoes = '$param'
    SELECT * FROM db_clti.vw_estacoes ORDER BY idtb_om_apoiadas ASC
    SELECT end_ip FROM db_clti.tb_estacoes WHERE end_ip = '$end_ip'
    SELECT * FROM db_clti.tb_estacoes
    
    SELECT end_ip FROM db_clti.tb_servidores WHERE end_ip = '$end_ip'
    SELECT * FROM db_clti.vw_servidores ORDER BY idtb_om_apoiadas ASC
    SELECT * FROM db_clti.tb_servidores
    SELECT * FROM db_clti.vw_servidores WHERE idtb_servidores = '$param'
    
    SELECT * FROM db_clti.tb_sor ORDER BY desenvolvedor,versao ASC
    
    SELECT * FROM db_clti.vw_processadores ORDER BY fabricante ASC
    SELECT * FROM db_clti.vw_processadores ORDER BY fabricante ASC
    SELECT * FROM db_clti.tb_proc_modelo
    SELECT * FROM db_clti.tb_proc_fab WHERE idtb_proc_fab = '$param'
    SELECT * FROM db_clti.vw_processadores WHERE idtb_proc_modelo = '$param'
    SELECT * FROM db_clti.vw_processadores ORDER BY fabricante,modelo ASC
    
    SELECT * FROM db_clti.tb_memorias ORDER BY tipo DESC
    SELECT * FROM db_clti.tb_memorias
    SELECT * FROM db_clti.tb_memorias WHERE idtb_memorias = '$param'
    SELECT * FROM db_clti.tb_memorias
*/
    
?>