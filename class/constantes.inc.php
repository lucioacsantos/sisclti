<?php
/**
*** 99242991 | Lúcio ALEXANDRE Correia dos Santos
**/

/* Inicializa Sessão */
session_start();

/* Função para Verificar Login */
function isLoggedIn(){
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true){
        return false;
    }
    return true;
}

/** Classe Configurações */
class Config
{
    public $idtb_clti;
    public $idtb_config;
    public $valor;
    public $nome;
    public $sigla;
    public $indicativo;
    public $data_ativacao;
    public $publicacao;
    public $datapublicacao;
    public $tipoclti;
    public $lotacaooficiais;
    public $lotacaopracas;
    public $ordena;

    function SelectAll()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRows("SELECT * FROM db_clti.tb_config");
        return $row;
    }
    function SelectURL()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getCol("SELECT valor FROM db_clti.tb_config WHERE parametro='URL'");
        return $row;
    }
    function SelectVersao()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getCol("SELECT valor FROM db_clti.tb_config WHERE parametro='VERSAO'");
        return $row;
    }
    function SelectEstado()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRow("SELECT * FROM db_clti.tb_config WHERE parametro='ESTADO'");
        return $row;
    }
    function SelectCidade()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRow("SELECT * FROM db_clti.tb_config WHERE parametro='CIDADE'");
        return $row;
    }
    function UpdateConfig()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->exec("UPDATE db_clti.tb_config SET valor = '$this->valor' WHERE idtb_config = '$this->idtb_config'");
        return $row;
    }
    function SelectSigla()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getCol("SELECT sigla FROM db_clti.tb_clti");
        return $row;
    }

    function SelectAllCLTI()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRow("SELECT * FROM db_clti.tb_clti");
        return $row;
    }
    function SelectIdCLTI()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRow("SELECT * FROM db_clti.tb_clti WHERE idtb_clti='$this->idtb_clti'");
        return $row;
    }
    function UpdateCLTI()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "UPDATE db_clti.tb_clti SET (nome,sigla,indicativo,data_ativacao) = ('$this->nome',
            '$this->sigla','$this->indicativo','$this->data_ativacao') WHERE idtb_clti='$this->idtb_clti'";
        $row = $pg->exec($sql);
        return $row;
    }
    function InsertCLTI()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "INSERT INTO db_clti.tb_clti (nome,sigla,indicativo,data_ativacao) VALUES ('$this->nome',
            '$this->sigla','$this->indicativo','$this->data_ativacao')";
        $row = $pg->exec($sql);
        return $row;
    }
    function SelectAllTiposCLTI()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "SELECT * FROM db_clti.tb_tipos_clti";
        $row = $pg->getRows($sql);
        return $row;
    }
    function InsertTiposCLTI()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "INSERT INTO db_clti.tb_tipos_clti(norma_atual, data_norma, tipo_clti, lotacao_oficiais, lotacao_pracas)
            VALUES ('$this->publicacao','$this->datapublicacao','$this->tipoclti','$this->lotacaooficiais',
            '$this->lotacaopracas')";
        $row = $pg->exec($sql);
        return $row;
    }
    function CountLotacaoCLTI()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "SELECT lotacao_oficiais+lotacao_pracas FROM db_clti.tb_tipos_clti";
        $row = $pg->exec($sql);
        return $row;
    }
    function CountLotOficiaisCLTI()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "SELECT lotacao_oficiais FROM db_clti.tb_tipos_clti";
        $row = $pg->exec($sql);
        return $row;
    }
    function CountLotPracasCLTI()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "SELECT lotacao_pracas FROM db_clti.tb_tipos_clti";
        $row = $pg->exec($sql);
        return $row;
    }
}

/* Classe Usuário */
class Usuario
{
    public $usuario;
    public $senha;
    public $iduser;
    public $ordena;

    /* Verificação de Login/Perfil Usuários da OM */
    public function LoginOM()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRow("SELECT * FROM db_clti.tb_pessoal_ti WHERE nip = '$this->usuario' 
            AND senha = '$this->senha' OR cpf = '$this->usuario' AND senha = '$this->senha'");
        return $row;
    }

    public function perfilOM()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRow("SELECT * FROM db_clti.vw_pessoal_ti WHERE idtb_pessoal_ti = $this->iduser");
        return $row;
    }

    /* Verificação de Login/Perfil Usuários do CLTI */
    public function LoginCLTI()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRow("SELECT * FROM db_clti.tb_lotacao_clti WHERE nip = '$this->usuario' 
            AND senha = '$this->senha' OR cpf = '$this->usuario' AND senha = '$this->senha'");
        return $row;
    }

    public function perfilCLTI()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRow("SELECT * FROM db_clti.vw_pessoal_clti WHERE idtb_lotacao_clti = $this->iduser");
        return $row;
    }
}

/** Classe OM Apoiadas */
class OMAPoiadas
{
    public $idtb_om_apoiadas;
    public $estado;
    public $cidade;
    public $cod_om;
    public $nome;
    public $sigla;
    public $indicativo;
    public $idtb_om_setores;
    public $nome_setor;
    public $sigla_setor;
    public $cod_funcional;
    public $compart;
    public $ordena;

    /** OM */
    public function SelectAllOMTable()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRows("SELECT * FROM db_clti.tb_om_apoiadas $this->ordena");
        return $row;
    }
    public function SelectIdOMTable()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRow("SELECT * FROM db_clti.tb_om_apoiadas WHERE idtb_om_apoiadas='$this->idtb_om_apoiadas'");
        return $row;
    }
    public function UpdateOM()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "UPDATE db_clti.tb_om_apoiadas SET (idtb_estado,idtb_cidade,cod_om,nome, sigla, indicativo) 
            = ('$this->estado','$this->cidade','$this->cod_om','$this->nome','$this->sigla','$this->indicativo') 
            WHERE idtb_om_apoiadas=$this->idtb_om_apoiadas";
        $row = $pg->exec($sql);
        return $row;
    }
    public function InsertOM()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "INSERT INTO db_clti.tb_om_apoiadas (idtb_estado,idtb_cidade,cod_om,nome, sigla, indicativo) 
            VALUES ('$this->estado','$this->cidade','$this->cod_om','$this->nome','$this->sigla','$this->indicativo')";
        $row = $pg->exec($sql);
        return $row;
    }
    public function SelectAllSetoresView()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRows("SELECT * FROM db_clti.vw_setores WHERE idtb_om_apoiadas=$this->idtb_om_apoiadas $this->ordena");
        return $row;
    }
    public function SelectIdSetoresView()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRow("SELECT * FROM db_clti.vw_setores WHERE idtb_om_setores=$this->idtb_om_setores");
        return $row;
    }
    public function InsertSetores()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "INSERT INTO db_clti.tb_om_setores (idtb_om_apoiadas,nome_setor,sigla_setor,cod_funcional,compartimento) 
            VALUES ('$this->idtb_om_apoiadas','$this->nome_setor','$this->sigla_setor','$this->cod_funcional',
            '$this->compart')";
        $row = $pg->exec($sql);
        return $row;
    }
    public function UpdateSetores()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "UPDATE db_clti.tb_om_setores SET (idtb_om_apoiadas,nome_setor,sigla_setor,cod_funcional,compartimento) 
            = ('$this->idtb_om_apoiadas','$this->nome_setor','$this->sigla_setor','$this->cod_funcional',
            '$this->compart') WHERE idtb_om_setores='$this->idtb_om_setores'";
        $row = $pg->exec($sql);
        return $row;
    }
    public function CountOMApoiadas()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getCol("SELECT COUNT(idtb_om_apoiadas) FROM db_clti.tb_om_apoiadas");
        return $row;
    }
    public function SelectAllEstado()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRows("SELECT * FROM db_clti.tb_estado");
        return $row;
    }
    public function SelectIdEstado()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRow("SELECT * FROM db_clti.tb_estado WHERE id='$this->estado'");
        return $row;
    }
    public function SelectUfEstado()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getCol("SELECT id FROM db_clti.tb_estado WHERE uf='$this->estado'");
        return $row;
    }
    public function SelectAllCidade()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRows("SELECT * FROM db_clti.tb_cidade");
        return $row;
    }
    public function SelectIdCidade()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRow("SELECT * FROM db_clti.tb_cidade WHERE id='$this->cidade'");
        return $row;
    }
    public function SelectNomeCidade()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getCol("SELECT id FROM db_clti.tb_cidade WHERE nome='$this->cidade'");
        return $row;
    }
}

/** Classe Pessoal TI */
class PessoalTI
{
    public $idtb_pessoal_ti;
    public $idtb_om_apoiadas;
    public $idtb_posto_grad;
    public $idtb_corpo_quadro;
    public $idtb_especialidade;
    public $nip;
    public $cpf;
    public $nip_cpf;
    public $usuario;
    public $nome;
    public $nome_guerra;
    public $correio_eletronico;
    public $status;
    public $senha;
    public $idtb_funcoes_ti;
    public $descricao;
    public $sigla;
    public $idtb_qualificacao_ti;
    public $nome_curso;
    public $instituicao;
    public $data_conclusao;
    public $carga_horaria;
    public $tipo;
    public $custo;
    public $meio;
    public $situacao;
    public $ordena;

    public function ChecaNIPCPF()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRow("SELECT * FROM db_clti.vw_pessoal_ti WHERE nip = '$this->usuario' OR cpf = '$this->usuario'");
        return $row;
    }
    public function ChecaCorreio()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRow("SELECT * FROM db_clti.tb_pessoal_ti WHERE correio_eletronico = '$this->correio_eletronico'");
        return $row;
    }
    public function SelectALLAdmin()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRows("SELECT * FROM db_clti.vw_pessoal_ti WHERE sigla_funcao='ADMIN' AND status='ATIVO' $this->ordena");
        return $row;
    }
    public function SelectIdPesTI()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRow("SELECT * FROM db_clti.vw_pessoal_ti WHERE idtb_pessoal_ti = '$this->idtb_pessoal_ti'");
        return $row;
    }
    public function InsertPesTI()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "INSERT INTO db_clti.tb_pessoal_ti(idtb_om_apoiadas,idtb_posto_grad,idtb_corpo_quadro,
            idtb_especialidade,nip,cpf,nome,nome_guerra,correio_eletronico,status,senha,idtb_funcoes_ti)
            VALUES ('$this->idtb_om_apoiadas','$this->idtb_posto_grad','$this->idtb_corpo_quadro',
            '$this->idtb_especialidade','$this->nip','$this->cpf','$this->nome','$this->nome_guerra',
            '$this->correio_eletronico','$this->status','$this->senha','$this->idtb_funcoes_ti')";
        $row = $pg->exec($sql);
        return $row;
    }
    public function UpdatePesTI()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "UPDATE db_clti.tb_pessoal_ti SET (idtb_om_apoiadas,idtb_posto_grad,idtb_corpo_quadro,
            idtb_especialidade,nip,cpf,nome,nome_guerra,correio_eletronico,status,idtb_funcoes_ti)
            = ('$this->idtb_om_apoiadas','$this->idtb_posto_grad','$this->idtb_corpo_quadro','$this->idtb_especialidade',
            '$this->nip','$this->cpf','$this->nome','$this->nome_guerra','$this->correio_eletronico','$this->status',
            '$this->idtb_funcoes_ti') WHERE idtb_pessoal_ti='$this->idtb_pessoal_ti' ";
        $row = $pg->exec($sql);
        return $row;
    }
    public function UpdateSenhaPesti()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "UPDATE db_clti.tb_pessoal_ti SET senha='$this->senha' WHERE idtb_pessoal_ti='$this->idtb_pessoal_ti'";
        $row = $pg->exec($sql);
        return $row;
    }
    public function SelectAllOSIC()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRows("SELECT * FROM db_clti.vw_pessoal_ti WHERE sigla_funcao='OSIC' AND status='ATIVO' $this->ordena");
        return $row;
    }
    public function SelectAllPesTI()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRows("SELECT * FROM db_clti.vw_pessoal_ti WHERE sigla_funcao!='ADMIN' AND sigla_funcao!='OSIC' 
            AND status='ATIVO' $this->ordena");
        return $row;
    }
    public function SelectAllFuncoesTI()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRows("SELECT * FROM db_clti.tb_funcoes_ti");
        return $row;
    }
    public function SelectOutrasFuncoesTI()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRows("SELECT * FROM db_clti.tb_funcoes_ti WHERE sigla != 'ADMIN' AND sigla != 'OSIC' ");
        return $row;
    }
    public function SelectIdFuncoesTI()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRow("SELECT * FROM db_clti.tb_funcoes_ti WHERE idtb_funcoes_ti='$this->idtb_funcoes_ti'");
        return $row;
    }
    public function UpdateFuncoesTI()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "UPDATE db_clti.tb_funcoes_ti SET (descricao,sigla)=('$this->descricao','$this->sigla')
            WHERE idtb_funcoes_ti='$this->idtb_funcoes_ti'";
        $row = $pg->exec($sql);
        return $row;
    }
    public function InsertFuncoesTI()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "INSERT INTO db_clti.tb_funcoes_ti (descricao,sigla) VALUES ('$this->descricao','$this->sigla')";
        $row = $pg->exec($sql);
        return $row;
    }
    public function SelectAllQualif()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRows("SELECT * FROM db_clti.vw_qualificacao_pesti $this->ordena");
        return $row;
    }
    public function SelectIdQualif()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRow("SELECT * FROM db_clti.vw_qualificacao_pesti 
            WHERE idtb_qualificacao_ti='$this->idtb_qualificacao_ti'");
        return $row;
    }
    public function InsertQualif()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "INSERT INTO db_clti.tb_qualificacao_ti(idtb_pessoal_ti, instituicao, tipo, nome_curso, 
            meio, situacao, data_conclusao, carga_horaria, custo) VALUES ('$this->idtb_pessoal_ti', 
            '$this->instituicao', '$this->tipo', '$this->nome_curso','$this->meio', '$this->situacao', 
            '$this->data_conclusao', '$this->carga_horaria', '$this->custo')";
        $row = $pg->exec($sql);
        return $row;
    }
    public function UpdateQualif()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "UPDATE db_clti.tb_qualificacao_ti SET (idtb_pessoal_ti, instituicao, tipo, nome_curso, 
            meio, situacao, data_conclusao, carga_horaria, custo) = ('$this->idtb_pessoal_ti', 
            '$this->instituicao', '$this->tipo', '$this->nome_curso','$this->meio', '$this->situacao', 
            '$this->data_conclusao', '$this->carga_horaria', '$this->custo')";
        $row = $pg->exec($sql);
        return $row;
    }
    public function CountAdmin()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "SELECT COUNT(idtb_pessoal_ti) AS qtde FROM db_clti.vw_pessoal_ti GROUP BY idtb_funcoes_ti 
            HAVING idtb_funcoes_ti=1 ";
        $row = $pg->exec($sql);
        return $row;
    }
    public function CountOSIC()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "SELECT COUNT(idtb_pessoal_ti) AS qtde FROM db_clti.vw_pessoal_ti GROUP BY idtb_funcoes_ti 
            HAVING idtb_funcoes_ti=2 ";
        $row = $pg->exec($sql);
        return $row;
    }
    public function CountPesTI()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "SELECT COUNT(idtb_pessoal_ti) AS qtde FROM db_clti.vw_pessoal_ti GROUP BY idtb_funcoes_ti 
            HAVING idtb_funcoes_ti!=1 AND idtb_funcoes_ti!=2 ";
        $row = $pg->exec($sql);
        return $row;
    }
}

/** Classe Pessoal CLTI */
class PessoalCLTI
{
    public $idtb_lotacao_clti;
    public $idtb_posto_grad;
    public $idtb_corpo_quadro;
    public $idtb_especialidade;
    public $nip;
    public $cpf;
    public $usuario;
    public $nome;
    public $nome_guerra;
    public $correio_eletronico;
    public $status;
    public $senha;
    public $perfil;
    public $idtb_qualificacao_clti;
    public $nome_curso;
    public $instituicao;
    public $data_conclusao;
    public $carga_horaria;
    public $tipo;
    public $custo;
    public $meio;
    public $situacao;
    public $ordena;

    public function ChecaNIPCPF()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRow("SELECT * FROM db_clti.vw_pessoal_clti WHERE nip = '$this->usuario' OR cpf = '$this->usuario'");
        return $row;
    }
    public function ChecaCorreio()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRow("SELECT * FROM db_clti.tb_lotacao_clti WHERE correio_eletronico = '$this->correio_eletronico'");
        return $row;
    }
    public function SelectALL()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRows("SELECT * FROM db_clti.vw_pessoal_clti WHERE status='ATIVO' $this->ordena");
        return $row;
    }
    public function SelectId()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRow("SELECT * FROM db_clti.vw_pessoal_clti WHERE idtb_lotacao_clti = '$this->idtb_lotacao_clti'");
        return $row;
    }
    public function Insert()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "INSERT INTO db_clti.tb_lotacao_clti(idtb_posto_grad,idtb_corpo_quadro,
            idtb_especialidade,nip,cpf,nome,nome_guerra,correio_eletronico,status,senha,perfil)
            VALUES ('$this->idtb_posto_grad','$this->idtb_corpo_quadro',
            '$this->idtb_especialidade','$this->nip','$this->cpf','$this->nome','$this->nome_guerra',
            '$this->correio_eletronico','$this->status','$this->senha','$this->perfil')";
        $row = $pg->exec($sql);
        return $row;
    }
    public function Update()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "UPDATE db_clti.tb_lotacao_clti SET (idtb_posto_grad,idtb_corpo_quadro,
        idtb_especialidade,nip,cpf,nome,nome_guerra,correio_eletronico,status,perfil)
        = ('$this->idtb_posto_grad','$this->idtb_corpo_quadro','$this->idtb_especialidade',
        '$this->nip','$this->cpf','$this->nome','$this->nome_guerra','$this->correio_eletronico','$this->status',
        '$this->perfil') WHERE idtb_lotacao_clti='$this->idtb_lotacao_clti'";
        $row = $pg->exec($sql);
        return $row;
    }
    public function UpdateSenha()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "UPDATE db_clti.tb_lotacao_clti SET senha= '$this->senha' 
            WHERE idtb_lotacao_clti='$this->idtb_lotacao_clti'";
        $row = $pg->exec($sql);
        return $row;
    }
    public function SelectAllQualif()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRows("SELECT * FROM db_clti.vw_qualificacao_clti $this->ordena");
        return $row;
    }
    public function SelectIdQualif()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRow("SELECT * FROM db_clti.vw_qualificacao_clti WHERE 
            idtb_qualificacao_clti='$this->idtb_qualificacao_clti' OR nip='$this->idtb_qualificacao_clti'
            OR cpf='$this->idtb_qualificacao_clti'");
        return $row;
    }
    public function InsertQualif()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "INSERT INTO db_clti.tb_qualificacao_clti(idtb_lotacao_clti, instituicao, tipo, nome_curso, 
            meio, situacao, data_conclusao, carga_horaria, custo) VALUES ('$this->idtb_lotacao_clti', 
            '$this->instituicao', '$this->tipo', '$this->nome_curso','$this->meio', '$this->situacao', 
            '$this->data_conclusao', '$this->carga_horaria', '$this->custo')";
        $row = $pg->exec($sql);
        return $row;
    }
    public function UpdateQualif()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "UPDATE db_clti.tb_qualificacao_clti SET (idtb_lotacao_clti, instituicao, tipo, nome_curso, 
            meio, situacao, data_conclusao, carga_horaria, custo) = ('$this->idtb_lotacao_clti', 
            '$this->instituicao', '$this->tipo', '$this->nome_curso','$this->meio', '$this->situacao', 
            '$this->data_conclusao', '$this->carga_horaria', '$this->custo')";
        $row = $pg->exec($sql);
        return $row;
    }
    public function CountOficiais()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "SELECT COUNT(nip) AS qtde FROM db_clti.tb_lotacao_clti WHERE idtb_posto_grad < '10' AND nip != '12345678' ";
        $row = $pg->exec($sql);
        return $row;
    }
    public function CountPracas()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "SELECT COUNT(nip) AS qtde FROM db_clti.tb_lotacao_clti WHERE idtb_posto_grad > '9' AND idtb_posto_grad < '21' 
            AND nip != '12345678' ";
        $row = $pg->exec($sql);
        return $row;
    }
    public function CountFCivil()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "SELECT COUNT(nip) AS qtde FROM db_clti.tb_lotacao_clti WHERE idtb_posto_grad = '21' AND nip != '12345678' ";
        $row = $pg->exec($sql);
        return $row;
    }
}

/** Classe Militar */
class Militar
{
    public $idtb_corpo_quadro;
    public $idtb_posto_grad;
    public $idtb_especialidade;
    public $ordena;

    public function SelectAllPostoGrad()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRows("SELECT * FROM db_clti.tb_posto_grad ORDER BY idtb_posto_grad DESC");
        return $row;
    }
    public function SelectAllCorpoQuadro()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRows("SELECT * FROM db_clti.tb_corpo_quadro");
        return $row;
    }
    public function SelectAllEspec()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRows("SELECT * FROM db_clti.tb_especialidade ORDER BY nome");
        return $row;
    }
}

/* Classe Eq. Conectividade  */
class Conectividade
{
    public $idtb_conectividade;
    public $ordena;
    public $idtb_om_apoiadas;
    public $fabricante;
    public $modelo;
    public $end_ip;
    public $idtb_om_setores;
    public $data_aquisicao;
    public $data_garantia;

    public function SelectAllConectTable()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRows("SELECT * FROM db_clti.tb_conectividade");
        return $row;
    }
    public function UpdateConect()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "UPDATE db_clti.tb_conectividade SET (idtb_om_apoiadas, fabricante, modelo, end_ip, idtb_om_setores, 
            data_aquisicao, data_garantia) = ('$this->idtb_om_apoiadas', '$this->fabricante', '$this->modelo', 
            '$this->end_ip', '$this->idtb_om_setores', '$this->data_aquisicao', '$this->data_garantia') 
            WHERE idtb_conectividade='$this->idtb_conectividade'";
        $row = $pg->exec($sql);
        return $row;
    }
    public function InsertConect()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "INSERT INTO db_clti.tb_conectividade(idtb_om_apoiadas, fabricante, modelo, end_ip, idtb_om_setores, 
            data_aquisicao, data_garantia) VALUES ('$this->idtb_om_apoiadas', '$this->fabricante', '$this->modelo', 
            '$this->end_ip', '$this->idtb_om_setores', '$this->data_aquisicao', '$this->data_garantia')";
        $row = $pg->exec($sql);
        return $row;
    }
    public function SelectAllConectView()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRows("SELECT * FROM db_clti.vw_conectividade");
        return $row;
    }
    public function SelectIdConectView()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRow("SELECT * FROM db_clti.vw_conectividade WHERE idtb_conectividade = $this->idtb_conectividade");
        return $row;
    }
    public function SelectAllOMConectView()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRows("SELECT * FROM db_clti.vw_conectividade WHERE idtb_om_apoiadas = $this->idtb_om_apoiadas");
        return $row;
    }
    public function CountConect()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "SELECT COUNT(idtb_conectividade) FROM db_clti.tb_conectividade";
        $row = $pg->exec($sql);
        return $row;
    }
}

/** Classe Estações de Trabalho */
class Estacoes
{
    public $idtb_estacoes;
    public $ordena;
    public $idtb_om_apoiadas;
    public $fabricante;
    public $modelo;
    public $end_ip;
    public $idtb_om_setores;
    public $data_aquisicao;
    public $data_garantia;
    public $idtb_proc_modelo;
    public $clock_proc;
    public $idtb_memorias;
    public $memoria;
    public $armazenamento;
    public $end_mac;
    public $idtb_sor;
    public $req_minimos;
    public $idtb_manutencao_et;
    public $data_entrada;
    public $data_saida;
    public $diagnostico;
    public $custo_manutencao;
    public $situacao;
    public $status;

    public function SelectAllETTable()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRows("SELECT * FROM db_clti.tb_estacoes");
        return $row;
    }
    public function UpdateET()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "UPDATE db_clti.tb_estacoes SET
            (idtb_om_apoiadas, fabricante, modelo, end_ip, idtb_om_setores, data_aquisicao, data_garantia,
            idtb_proc_modelo, clock_proc, idtb_memorias,memoria, armazenamento, end_mac, idtb_sor,
            req_minimos, status) = 
            ('$this->idtb_om_apoiadas', '$this->fabricante', '$this->modelo', '$this->end_ip', '$this->idtb_om_setores', 
            '$this->data_aquisicao', '$this->data_garantia', '$this->idtb_proc_modelo', '$this->clock_proc', 
            '$this->idtb_memorias', '$this->memoria', '$this->armazenamento', '$this->end_mac', '$this->idtb_sor',
            '$this->req_minimos', '$this->status') WHERE idtb_estacoes='$this->idtb_estacoes'";
        $row = $pg->exec($sql);
        return $row;
    }
    public function InsertET()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "INSERT INTO db_clti.tb_estacoes
            (idtb_om_apoiadas, fabricante, modelo, end_ip, idtb_om_setores, data_aquisicao, data_garantia,
            idtb_proc_modelo, clock_proc, idtb_memorias,memoria, armazenamento, end_mac, idtb_sor,
            req_minimos, status) VALUES 
            ('$this->idtb_om_apoiadas', '$this->fabricante', '$this->modelo', '$this->end_ip', '$this->idtb_om_setores', 
            '$this->data_aquisicao', '$this->data_garantia', '$this->idtb_proc_modelo', '$this->clock_proc', 
            '$this->idtb_memorias', '$this->memoria', '$this->armazenamento', '$this->end_mac', '$this->idtb_sor',
            '$this->req_minimos', '$this->status')";
        $row = $pg->exec($sql);
        return $row;
    }
    public function SelectAllETView()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRows("SELECT * FROM db_clti.vw_estacoes");
        return $row;
    }
    public function SelectIdETView()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRow("SELECT * FROM db_clti.vw_estacoes WHERE idtb_estacoes = $this->idtb_estacoes");
        return $row;
    }
    public function SelectIdOMETView()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRow("SELECT * FROM db_clti.vw_estacoes WHERE idtb_om_apoiadas = $this->idtb_om_apoiadas");
        return $row;
    }
    public function SelectMntAbertoET(){
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRows("SELECT * FROM db_clti.tb_manutencao_et WHERE idtb_om_apoiadas = $this->idtb_om_apoiadas");
        return $row;
    }
    public function SelectIdMntET(){
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRow("SELECT * FROM db_clti.tb_manutencao_et 
            WHERE idtb_manutencao_et = $this->idtb_manutencao_et");
        return $row;
    }
    public function InsertMntET(){
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "INSERT INTO db_clti.tb_manutencao_et (idtb_estacoes,idtb_om_apoiadas,data_entrada,diagnostico,
            custo_manutencao,situacao) VALUES ('$this->idtb_estacoes','$this->idtb_om_apoiadas','$this->data_entrada',
            '$this->diagnostico','$this->custo_manutencao','$this->situacao')";
        $row = $pg->exec($sql);
        return $row;
    }
    public function UpdateMntET(){
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "UPDATE db_clti.tb_manutencao_et SET (data_saida,diagnostico,custo_manutencao,
            situacao) = ($this->data_saida,'$this->diagnostico','$this->custo_manutencao','$this->situacao') 
            WHERE idtb_manutencao_et='$this->idtb_manutencao_et'";
        $row = $pg->exec($sql);
        return $row;
    }
    public function CountET()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "SELECT COUNT(idtb_estacoes) FROM db_clti.tb_estacoes";
        $row = $pg->exec($sql);
        return $row;
    }
}

/** Classe Servidores */
class Servidores
{
    public $idtb_servidores;
    public $ordena;
    public $idtb_om_apoiadas;
    public $fabricante;
    public $modelo;
    public $end_ip;
    public $localizacao;
    public $data_aquisicao;
    public $data_garantia;
    public $idtb_proc_modelo;
    public $qtde_proc;
    public $clock_proc;
    public $idtb_memorias;
    public $memoria;
    public $armazenamento;
    public $end_mac;
    public $finalidade;
    public $idtb_sor;
    public $idtb_om_setores;
    public $status;

    public function SelectAllSrvTable()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRows("SELECT * FROM db_clti.tb_servidores");
        return $row;
    }
    public function UpdateSrv()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "UPDATE db_clti.tb_servidores SET 
            idtb_om_apoiadas='$this->idtb_om_apoiadas', fabricante='$this->fabricante', modelo='$this->modelo', 
            idtb_proc_modelo='$this->idtb_proc_modelo', clock_proc='$this->clock_proc', qtde_proc='$this->qtde_proc', 
            memoria='$this->memoria', armazenamento='$this->armazenamento', end_ip='$this->end_ip', 
            end_mac='$this->end_mac', idtb_sor='$this->idtb_sor', finalidade='$this->finalidade', 
            data_aquisicao='$this->data_aquisicao', data_garantia='$this->data_garantia', 
            idtb_om_setores='$this->idtb_om_setores', status='$this->status'
            WHERE idtb_servidores='$this->idtb_servidores'";
        $row = $pg->exec($sql);
        return $row;
    }
    public function InsertSrv()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "INSERT INTO db_clti.tb_servidores(
            idtb_om_apoiadas, fabricante, modelo, idtb_proc_modelo, clock_proc, 
            qtde_proc, memoria, armazenamento, end_ip, end_mac, idtb_sor, 
            finalidade, data_aquisicao, data_garantia, idtb_om_setores, status)
            VALUES ('$this->idtb_om_apoiadas', '$this->fabricante', '$this->modelo', '$this->idtb_proc_modelo', 
            '$this->clock_proc','$this->qtde_proc', '$this->memoria', '$this->armazenamento','$this->end_ip', 
            '$this->end_mac', '$this->idtb_sor', '$this->finalidade','$this->data_aquisicao', 
            '$this->data_garantia', '$this->idtb_om_setores', '$this->status')";
        $row = $pg->exec($sql);
        return $row;
    }
    public function SelectAllSrvView()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRows("SELECT * FROM db_clti.vw_servidores");
        return $row;
    }
    public function SelectIdSrvView()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRow("SELECT * FROM db_clti.vw_servidores WHERE idtb_servidores = $this->idtb_servidores");
        return $row;
    }
    public function SelectIdOMSrvView()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRows("SELECT * FROM db_clti.vw_servidores WHERE idtb_om_apoiadas = $this->idtb_om_apoiadas");
        return $row;
    }
    public function CountSrv()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = "SELECT COUNT(idtb_servidores) FROM db_clti.tb_servidores";
        $row = $pg->exec($sql);
        return $row;
    }
}

/** Classe Verifica IP */
class IP
{
    public $end_ip;
    
    public function SearchIP()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRows("SELECT * FROM db_clti.tb_conectividade WHERE end_ip = '$this->end_ip'");
        $row = $pg->getRows("SELECT * FROM db_clti.tb_estacoes WHERE end_ip = '$this->end_ip'");
        $row = $pg->getRows("SELECT * FROM db_clti.tb_servidores WHERE end_ip = '$this->end_ip'");
        return $row;
    }
}

/** Classe Sistemas Operacionais */
class SO
{
    public $idtb_sor;
    public $desenvolvedor;
    public $descricao;
    public $versao;
    public $situacao;
    public $ordena;
    
    public function SelectAllSO()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRows("SELECT * FROM db_clti.tb_sor $this->ordena");
        return $row;
    }
    public function SelectIdSO()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRow("SELECT * FROM db_clti.tb_sor WHERE idtb_sor='$this->idtb_sor'");
        return $row;
    }
    public function SelectSOAtivo()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRows("SELECT * FROM db_clti.tb_sor WHERE situacao = 'ATIVO'");
        return $row;
    }
    public function UpdateSO()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = ("UPDATE db_clti.tb_sor SET desenvolvedor='$this->desenvolvedor',descricao='$this->descricao',
            versao='$this->versao',situacao='$this->situacao' WHERE idtb_sor='$this->idtb_sor'");
        $row = $pg->exec($sql);
        return $row;
    }
    public function InsertSO()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = ("INSERT INTO db_clti.tb_sor(desenvolvedor,descricao,versao,situacao) 
            VALUES ('$this->desenvolvedor','$this->descricao','$this->versao','$this->situacao'");
        $row = $pg->exec($sql);
        return $row;
    }
}

/** Classe Hardware */
class Hardware
{
    public $idtb_proc_fab;
    public $idtb_proc_modelo;
    public $idtb_memorias;
    public $nome;
    public $modelo;
    public $tipo;
    public $clock;
    public $ordena;
    
    /** Processadores */
    public function SelectAllProcFab()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRows("SELECT * FROM db_clti.tb_proc_fab $this->ordena");
        return $row;
    }
    public function SelectIdProcFab()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRow("SELECT * FROM db_clti.tb_proc_fab WHERE idtb_proc_fab='$this->idtb_proc_fab'");
        return $row;
    }
    public function SelectAllProcModelo()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRows("SELECT * FROM db_clti.tb_proc_modelo $this->ordena");
        return $row;
    }
    public function SelectIdProcModelo()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRow("SELECT * FROM db_clti.tb_proc_modelo WHERE idtb_proc_modelo='$this->idtb_proc_modelo'");
        return $row;
    }
    public function SelectAllProcView()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRows("SELECT * FROM db_clti.vw_processadores $this->ordena");
        return $row;
    }
    public function SelectIdProcView()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRow("SELECT * FROM db_clti.vw_processadores WHERE idtb_proc_modelo='$this->idtb_proc_modelo'");
        return $row;
    }
    public function UpdateProcFab()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = ("UPDATE db_clti.tb_proc_fab SET nome='$this->nome' WHERE idtb_proc_fab='$this->idtb_proc_fab'");
        $row = $pg->exec($sql);
        return $row;
    }
    public function InsertProcFab()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = ("INSERT INTO db_clti.tb_proc_fab(nome) VALUES ('$this->nome'");
        $row = $pg->exec($sql);
        return $row;
    }
    public function UpdateProcModelo()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = ("UPDATE db_clti.tb_proc_modelo SET idtb_proc_fab='$this->idtb_proc_fab',modelo='$this->modelo'
            WHERE idtb_proc_modelo='$this->idtb_proc_modelo'");
        $row = $pg->exec($sql);
        return $row;
    }
    public function InsertProcModelo()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = ("INSERT INTO db_clti.tb_proc_modelo(idtb_proc_fab,modelo) 
            VALUES ('$this->idtb_proc_fab','$this->modelo'");
        $row = $pg->exec($sql);
        return $row;
    }
    /** Memórias */
    public function SelectAllMem()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRows("SELECT * FROM db_clti.tb_memorias $this->ordena");
        return $row;
    }
    public function SelectIdMem()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $row = $pg->getRow("SELECT * FROM db_clti.tb_memorias WHERE idtb_memorias='$this->idtb_memorias'");
        return $row;
    }
    public function UpdateMem()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = ("UPDATE db_clti.tb_memorias SET tipo='$this->tipo',modelo='$this->modelo',clock='$this->clock'
            WHERE idtb_memorias='$this->idtb_memorias'");
        $row = $pg->exec($sql);
        return $row;
    }
    public function InsertMem()
    {
        require_once "pgsql.class.php";
        $pg = new PgSql();
        $sql = ("INSERT INTO db_clti.tb_memorias(tipo,modelo,clock) 
            VALUES ('$this->tipo','$this->modelo','$this->clock'");
        $row = $pg->exec($sql);
        return $row;
    }
}