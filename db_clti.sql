-- db_clti.tb_clti definition

-- Drop table

-- DROP TABLE db_clti.tb_clti;

CREATE TABLE db_clti.tb_clti (
	idtb_clti serial NOT NULL DEFAULT nextval('db_clti.tb_clti_idtb_clti_seq'::regclass),
	efetivo_oficiais int4 NULL,
	efetivo_pracas int4 NULL,
	nome varchar(255) NOT NULL,
	sigla varchar(45) NOT NULL,
	indicativo varchar(6) NOT NULL,
	data_ativacao date NOT NULL,
	CONSTRAINT tb_clti_pkey PRIMARY KEY (idtb_clti)
);


-- db_clti.tb_config definition

-- Drop table

-- DROP TABLE db_clti.tb_config;

CREATE TABLE db_clti.tb_config (
	idtb_config serial NOT NULL DEFAULT nextval('db_clti.tb_config_idtb_config_seq'::regclass),
	parametro varchar(255) NULL,
	valor varchar(255) NULL,
	CONSTRAINT tb_config_pkey PRIMARY KEY (idtb_config)
);


-- db_clti.tb_corpo_quadro definition

-- Drop table

-- DROP TABLE db_clti.tb_corpo_quadro;

CREATE TABLE db_clti.tb_corpo_quadro (
	idtb_corpo_quadro serial NOT NULL DEFAULT nextval('db_clti.tb_corpo_quadro_idtb_corpo_quadro_seq'::regclass),
	nome varchar(45) NOT NULL,
	sigla varchar(45) NOT NULL,
	CONSTRAINT tb_corpo_quadro_pkey PRIMARY KEY (idtb_corpo_quadro)
);


-- db_clti.tb_especialidade definition

-- Drop table

-- DROP TABLE db_clti.tb_especialidade;

CREATE TABLE db_clti.tb_especialidade (
	idtb_especialidade serial NOT NULL DEFAULT nextval('db_clti.tb_especialidade_idtb_especialidade_seq'::regclass),
	nome varchar(45) NOT NULL,
	sigla varchar(45) NOT NULL,
	CONSTRAINT tb_especialidade_pkey PRIMARY KEY (idtb_especialidade)
);


-- db_clti.tb_funcoes_ti definition

-- Drop table

-- DROP TABLE db_clti.tb_funcoes_ti;

CREATE TABLE db_clti.tb_funcoes_ti (
	idtb_funcoes_ti serial NOT NULL DEFAULT nextval('db_clti.tb_funcoes_ti_idtb_funcoes_ti_seq'::regclass),
	descricao varchar(255) NOT NULL,
	sigla varchar(45) NOT NULL,
	CONSTRAINT tb_funcao_ti_pkey PRIMARY KEY (idtb_funcoes_ti)
);


-- db_clti.tb_memorias definition

-- Drop table

-- DROP TABLE db_clti.tb_memorias;

CREATE TABLE db_clti.tb_memorias (
	idtb_memorias serial NOT NULL DEFAULT nextval('db_clti.tb_memorias_idtb_memorias_seq'::regclass),
	tipo varchar(255) NOT NULL,
	modelo varchar(255) NOT NULL,
	clock int4 NOT NULL,
	CONSTRAINT tb_memorias_pkey PRIMARY KEY (idtb_memorias)
);


-- db_clti.tb_om_setores definition

-- Drop table

-- DROP TABLE db_clti.tb_om_setores;

CREATE TABLE db_clti.tb_om_setores (
	idtb_om_setores serial NOT NULL DEFAULT nextval('db_clti.tb_om_setores_idtb_om_setores_seq'::regclass),
	idtb_om_apoiadas int4 NOT NULL,
	nome_setor varchar(255) NOT NULL,
	sigla_setor varchar(255) NOT NULL,
	cod_funcional varchar(45) NOT NULL,
	compartimento varchar(255) NOT NULL,
	CONSTRAINT tb_om_setores_pk PRIMARY KEY (idtb_om_setores)
);
CREATE UNIQUE INDEX tb_om_setores_idtb_om_setores_idx ON db_clti.tb_om_setores USING btree (idtb_om_setores);


-- db_clti.tb_pais definition

-- Drop table

-- DROP TABLE db_clti.tb_pais;

CREATE TABLE db_clti.tb_pais (
	id serial NOT NULL DEFAULT nextval('db_clti.tb_pais_id_seq'::regclass),
	nome varchar(60) NOT NULL,
	sigla varchar(10) NOT NULL,
	CONSTRAINT pais_pkey PRIMARY KEY (id)
);


-- db_clti.tb_posto_grad definition

-- Drop table

-- DROP TABLE db_clti.tb_posto_grad;

CREATE TABLE db_clti.tb_posto_grad (
	idtb_posto_grad serial NOT NULL DEFAULT nextval('db_clti.tb_posto_grad_idtb_posto_grad_seq'::regclass),
	nome varchar(45) NOT NULL,
	sigla varchar(45) NOT NULL,
	CONSTRAINT tb_posto_grad_pkey PRIMARY KEY (idtb_posto_grad)
);


-- db_clti.tb_proc_fab definition

-- Drop table

-- DROP TABLE db_clti.tb_proc_fab;

CREATE TABLE db_clti.tb_proc_fab (
	idtb_proc_fab serial NOT NULL DEFAULT nextval('db_clti.tb_proc_fab_idtb_proc_fab_seq'::regclass),
	nome varchar(255) NOT NULL,
	CONSTRAINT tb_proc_fab_nome_key UNIQUE (nome),
	CONSTRAINT tb_proc_fab_pkey PRIMARY KEY (idtb_proc_fab)
);


-- db_clti.tb_registro_log definition

-- Drop table

-- DROP TABLE db_clti.tb_registro_log;

CREATE TABLE db_clti.tb_registro_log (
	idtb_registro_log serial NOT NULL DEFAULT nextval('db_clti.tb_registro_log_idtb_registro_log_seq'::regclass),
	data_acao date NOT NULL,
	acao varchar(255) NOT NULL,
	nip_cps_resp int4 NOT NULL,
	CONSTRAINT tb_registro_log_pkey PRIMARY KEY (idtb_registro_log)
);


-- db_clti.tb_sor definition

-- Drop table

-- DROP TABLE db_clti.tb_sor;

CREATE TABLE db_clti.tb_sor (
	idtb_sor serial NOT NULL DEFAULT nextval('db_clti.tb_sor_idtb_sor_seq'::regclass),
	desenvolvedor varchar(512) NOT NULL,
	descricao varchar(255) NOT NULL,
	versao varchar(45) NOT NULL,
	situacao varchar(45) NOT NULL,
	CONSTRAINT tb_sor_pkey PRIMARY KEY (idtb_sor)
);


-- db_clti.tb_tipos_clti definition

-- Drop table

-- DROP TABLE db_clti.tb_tipos_clti;

CREATE TABLE db_clti.tb_tipos_clti (
	idtb_tipos_clti serial NOT NULL DEFAULT nextval('db_clti.tb_tipos_clti_idtb_tipos_clti_seq'::regclass),
	norma_atual varchar(45) NOT NULL,
	data_norma date NOT NULL,
	lotacao_oficiais int2 NOT NULL,
	lotacao_pracas int2 NOT NULL,
	tipo_clti varchar(45) NOT NULL,
	CONSTRAINT tb_tipos_clti_pkey PRIMARY KEY (idtb_tipos_clti)
);


-- db_clti.tb_estado definition

-- Drop table

-- DROP TABLE db_clti.tb_estado;

CREATE TABLE db_clti.tb_estado (
	id serial NOT NULL DEFAULT nextval('db_clti.tb_estado_id_seq'::regclass),
	nome varchar(75) NOT NULL,
	uf varchar(5) NOT NULL,
	pais int4 NOT NULL,
	CONSTRAINT estado_pkey PRIMARY KEY (id),
	CONSTRAINT tb_estado_pais_fkey FOREIGN KEY (pais) REFERENCES db_clti.tb_pais(id)
);


-- db_clti.tb_lotacao_clti definition

-- Drop table

-- DROP TABLE db_clti.tb_lotacao_clti;

CREATE TABLE db_clti.tb_lotacao_clti (
	idtb_lotacao_clti serial NOT NULL DEFAULT nextval('db_clti.tb_lotacao_clti_idtb_lotacao_clti_seq'::regclass),
	idtb_posto_grad int4 NOT NULL,
	idtb_corpo_quadro int4 NULL,
	idtb_especialidade int4 NULL,
	nip varchar(8) NULL,
	cpf varchar(11) NULL DEFAULT NULL::character varying,
	nome varchar(255) NOT NULL,
	nome_guerra varchar(45) NOT NULL,
	status varchar(45) NOT NULL DEFAULT '1'::character varying,
	senha varchar(255) NULL,
	perfil varchar(45) NULL,
	correio_eletronico varchar(255) NULL,
	CONSTRAINT tb_tripulacao_clti_pkey PRIMARY KEY (idtb_lotacao_clti),
	CONSTRAINT unico_nip_cpf UNIQUE (nip, cpf),
	CONSTRAINT tb_lotacao_clti_idtb_corpo_quadro_fkey FOREIGN KEY (idtb_corpo_quadro) REFERENCES db_clti.tb_corpo_quadro(idtb_corpo_quadro),
	CONSTRAINT tb_lotacao_clti_idtb_especialidade_fkey FOREIGN KEY (idtb_especialidade) REFERENCES db_clti.tb_especialidade(idtb_especialidade),
	CONSTRAINT tb_lotacao_clti_idtb_posto_grad_fkey FOREIGN KEY (idtb_posto_grad) REFERENCES db_clti.tb_posto_grad(idtb_posto_grad)
);
CREATE INDEX fki_id_corpo_quadro ON db_clti.tb_lotacao_clti USING btree (idtb_corpo_quadro);
CREATE INDEX fki_id_especialidade ON db_clti.tb_lotacao_clti USING btree (idtb_especialidade);
CREATE INDEX fki_id_posto_grad ON db_clti.tb_lotacao_clti USING btree (idtb_posto_grad);


-- db_clti.tb_proc_modelo definition

-- Drop table

-- DROP TABLE db_clti.tb_proc_modelo;

CREATE TABLE db_clti.tb_proc_modelo (
	idtb_proc_modelo serial NOT NULL DEFAULT nextval('db_clti.tb_proc_modelo_idtb_proc_modelo_seq'::regclass),
	idtb_proc_fab int4 NOT NULL,
	modelo varchar(255) NOT NULL,
	CONSTRAINT tb_proc_modelo_modelo_key UNIQUE (modelo),
	CONSTRAINT tb_proc_modelo_pkey PRIMARY KEY (idtb_proc_modelo),
	CONSTRAINT tb_proc_modelo_idtb_proc_fab_fkey FOREIGN KEY (idtb_proc_fab) REFERENCES db_clti.tb_proc_fab(idtb_proc_fab)
);


-- db_clti.tb_qualificacao_clti definition

-- Drop table

-- DROP TABLE db_clti.tb_qualificacao_clti;

CREATE TABLE db_clti.tb_qualificacao_clti (
	idtb_qualificacao_clti serial NOT NULL DEFAULT nextval('db_clti.tb_qualificacao_clti_idtb_qualificacao_clti_seq'::regclass),
	nome_curso varchar(255) NOT NULL,
	instituicao varchar(255) NOT NULL,
	data_conclusao date NULL,
	carga_horaria int4 NOT NULL,
	tipo varchar(255) NOT NULL,
	custo money NULL,
	meio varchar(255) NOT NULL,
	situacao varchar(45) NOT NULL,
	idtb_lotacao_clti int4 NOT NULL,
	CONSTRAINT tb_qualificacao_clti_pkey PRIMARY KEY (idtb_qualificacao_clti),
	CONSTRAINT tb_qualificacao_clti_idtb_lotacao_clti_fkey FOREIGN KEY (idtb_lotacao_clti) REFERENCES db_clti.tb_lotacao_clti(idtb_lotacao_clti)
);


-- db_clti.tb_cidade definition

-- Drop table

-- DROP TABLE db_clti.tb_cidade;

CREATE TABLE db_clti.tb_cidade (
	id serial NOT NULL DEFAULT nextval('db_clti.tb_cidade_id_seq'::regclass),
	nome varchar(120) NOT NULL,
	estado int4 NOT NULL,
	CONSTRAINT cidade_pkey PRIMARY KEY (id),
	CONSTRAINT tb_cidade_estado_fkey FOREIGN KEY (estado) REFERENCES db_clti.tb_estado(id)
);


-- db_clti.tb_om_apoiadas definition

-- Drop table

-- DROP TABLE db_clti.tb_om_apoiadas;

CREATE TABLE db_clti.tb_om_apoiadas (
	idtb_om_apoiadas serial NOT NULL DEFAULT nextval('db_clti.tb_om_apoiadas_idtb_om_apoiadas_seq'::regclass),
	cod_om int4 NOT NULL,
	nome varchar(255) NOT NULL,
	sigla varchar(45) NOT NULL,
	indicativo varchar(6) NOT NULL,
	idtb_estado int4 NOT NULL,
	idtb_cidade int4 NOT NULL,
	CONSTRAINT tb_om_apoiadas_cod_om_nome_sigla_indicativo_key UNIQUE (cod_om, nome, sigla, indicativo),
	CONSTRAINT tb_om_apoiadas_pkey PRIMARY KEY (idtb_om_apoiadas),
	CONSTRAINT tb_om_apoiadas_id_cidade_fkey FOREIGN KEY (idtb_cidade) REFERENCES db_clti.tb_cidade(id),
	CONSTRAINT tb_om_apoiadas_id_estado_fkey FOREIGN KEY (idtb_estado) REFERENCES db_clti.tb_estado(id)
);


-- db_clti.tb_osic definition

-- Drop table

-- DROP TABLE db_clti.tb_osic;

CREATE TABLE db_clti.tb_osic (
	idtb_osic serial NOT NULL DEFAULT nextval('db_clti.tb_osic_idtb_osic_seq'::regclass),
	idtb_om_apoiadas int4 NULL,
	idtb_posto_grad int4 NULL,
	idtb_corpo_quadro int4 NULL,
	idtb_especialidade int4 NULL,
	nip varchar(8) NULL,
	cpf varchar(11) NULL,
	nome varchar(255) NULL,
	nome_guerra varchar(45) NULL,
	perfil varchar(45) NULL,
	senha varchar(255) NULL,
	status varchar(45) NULL,
	correio_eletronico varchar(255) NOT NULL,
	CONSTRAINT tb_osic_pkey PRIMARY KEY (idtb_osic),
	CONSTRAINT tb_osic_idtb_corpo_quadro_fkey FOREIGN KEY (idtb_corpo_quadro) REFERENCES db_clti.tb_corpo_quadro(idtb_corpo_quadro),
	CONSTRAINT tb_osic_idtb_especialidade_fkey FOREIGN KEY (idtb_especialidade) REFERENCES db_clti.tb_especialidade(idtb_especialidade),
	CONSTRAINT tb_osic_idtb_om_apoiadas_fkey FOREIGN KEY (idtb_om_apoiadas) REFERENCES db_clti.tb_om_apoiadas(idtb_om_apoiadas),
	CONSTRAINT tb_osic_idtb_posto_grad_fkey FOREIGN KEY (idtb_posto_grad) REFERENCES db_clti.tb_posto_grad(idtb_posto_grad)
);


-- db_clti.tb_pessoal_ti definition

-- Drop table

-- DROP TABLE db_clti.tb_pessoal_ti;

CREATE TABLE db_clti.tb_pessoal_ti (
	idtb_pessoal_ti serial NOT NULL DEFAULT nextval('db_clti.tb_pessoal_ti_idtb_pessoal_ti_seq'::regclass),
	idtb_om_apoiadas int4 NOT NULL,
	idtb_posto_grad int4 NOT NULL,
	idtb_corpo_quadro int4 NOT NULL,
	idtb_especialidade int4 NOT NULL,
	nip varchar(8) NOT NULL,
	cpf varchar(11) NOT NULL,
	nome varchar(255) NOT NULL,
	nome_guerra varchar(255) NOT NULL,
	correio_eletronico varchar(255) NOT NULL,
	status varchar(255) NOT NULL,
	senha varchar(255) NOT NULL,
	idtb_funcoes_ti int4 NOT NULL,
	CONSTRAINT tb_pessoal_ti_pkey PRIMARY KEY (idtb_pessoal_ti),
	CONSTRAINT tb_pessoal_ti_idtb_corpo_quadro_fkey FOREIGN KEY (idtb_corpo_quadro) REFERENCES db_clti.tb_corpo_quadro(idtb_corpo_quadro),
	CONSTRAINT tb_pessoal_ti_idtb_especialidade_fkey FOREIGN KEY (idtb_especialidade) REFERENCES db_clti.tb_especialidade(idtb_especialidade),
	CONSTRAINT tb_pessoal_ti_idtb_funcoes_ti_fkey FOREIGN KEY (idtb_funcoes_ti) REFERENCES db_clti.tb_funcoes_ti(idtb_funcoes_ti),
	CONSTRAINT tb_pessoal_ti_idtb_om_apoiada_fkey FOREIGN KEY (idtb_om_apoiadas) REFERENCES db_clti.tb_om_apoiadas(idtb_om_apoiadas),
	CONSTRAINT tb_pessoal_ti_idtb_posto_grad_fkey FOREIGN KEY (idtb_posto_grad) REFERENCES db_clti.tb_posto_grad(idtb_posto_grad)
);


-- db_clti.tb_qualificacao_ti definition

-- Drop table

-- DROP TABLE db_clti.tb_qualificacao_ti;

CREATE TABLE db_clti.tb_qualificacao_ti (
	idtb_qualificacao_ti serial NOT NULL DEFAULT nextval('db_clti.tb_qualificacao_ti_idtb_qualificacao_ti_seq'::regclass),
	nome_curso varchar(255) NOT NULL,
	instituicao varchar(255) NOT NULL,
	data_conclusao date NULL,
	carga_horaria int4 NOT NULL,
	tipo varchar(255) NOT NULL,
	custo money NULL,
	meio varchar(255) NOT NULL,
	situacao varchar(45) NOT NULL,
	idtb_pessoal_ti int4 NOT NULL,
	CONSTRAINT tb_qualificacao_ti_pkey PRIMARY KEY (idtb_qualificacao_ti),
	CONSTRAINT tb_qualificacao_ti_idtb_pessoal_ti_fkey FOREIGN KEY (idtb_pessoal_ti) REFERENCES db_clti.tb_pessoal_ti(idtb_pessoal_ti)
);


-- db_clti.tb_servidores definition

-- Drop table

-- DROP TABLE db_clti.tb_servidores;

CREATE TABLE db_clti.tb_servidores (
	idtb_servidores serial NOT NULL DEFAULT nextval('db_clti.tb_servidores_idtb_servidores_seq'::regclass),
	idtb_om_apoiadas int4 NOT NULL,
	fabricante varchar(255) NOT NULL,
	modelo varchar(255) NOT NULL,
	idtb_proc_modelo int4 NOT NULL,
	clock_proc float4 NOT NULL,
	qtde_proc int4 NOT NULL,
	memoria int4 NULL,
	armazenamento int4 NULL,
	end_ip varchar(255) NULL,
	end_mac varchar(255) NULL,
	idtb_sor int4 NOT NULL,
	finalidade varchar(255) NOT NULL,
	data_aquisicao date NULL,
	data_garantia date NULL,
	status varchar(255) NOT NULL,
	idtb_om_setores int4 NULL,
	nome varchar(50) NULL,
	CONSTRAINT tb_servidores_pkey PRIMARY KEY (idtb_servidores),
	CONSTRAINT tb_servidores_un UNIQUE (nome),
	CONSTRAINT tb_servidores_fk FOREIGN KEY (idtb_om_setores) REFERENCES db_clti.tb_om_setores(idtb_om_setores),
	CONSTRAINT tb_servidores_idtb_om_apoiadas_fkey FOREIGN KEY (idtb_om_apoiadas) REFERENCES db_clti.tb_om_apoiadas(idtb_om_apoiadas),
	CONSTRAINT tb_servidores_idtb_proc_modelo_fkey FOREIGN KEY (idtb_proc_modelo) REFERENCES db_clti.tb_proc_modelo(idtb_proc_modelo),
	CONSTRAINT tb_servidores_idtb_sor_fkey FOREIGN KEY (idtb_sor) REFERENCES db_clti.tb_sor(idtb_sor)
);


-- db_clti.tb_conectividade definition

-- Drop table

-- DROP TABLE db_clti.tb_conectividade;

CREATE TABLE db_clti.tb_conectividade (
	idtb_conectividade serial NOT NULL DEFAULT nextval('db_clti.tb_conectividade_idtb_conectividade_seq'::regclass),
	idtb_om_apoiadas int4 NOT NULL,
	fabricante varchar(255) NOT NULL,
	modelo varchar(255) NOT NULL,
	end_ip varchar(255) NULL,
	data_aquisicao date NOT NULL,
	data_garantia date NULL,
	idtb_om_setores int4 NULL,
	qtde_portas int4 NULL,
	nome varchar(50) NULL,
	CONSTRAINT tb_conectividade_end_ip_key UNIQUE (end_ip),
	CONSTRAINT tb_conectividade_pkey PRIMARY KEY (idtb_conectividade),
	CONSTRAINT tb_conectividade_un UNIQUE (nome),
	CONSTRAINT tb_conectividade_fk FOREIGN KEY (idtb_om_setores) REFERENCES db_clti.tb_om_setores(idtb_om_setores),
	CONSTRAINT tb_conectividade_idtb_om_apoiadas_fkey FOREIGN KEY (idtb_om_apoiadas) REFERENCES db_clti.tb_om_apoiadas(idtb_om_apoiadas)
);


-- db_clti.tb_estacoes definition

-- Drop table

-- DROP TABLE db_clti.tb_estacoes;

CREATE TABLE db_clti.tb_estacoes (
	idtb_estacoes serial NOT NULL DEFAULT nextval('db_clti.tb_estacoes_idtb_estacoes_seq'::regclass),
	idtb_om_apoiadas int4 NOT NULL,
	idtb_proc_modelo int4 NOT NULL,
	clock_proc float4 NOT NULL,
	fabricante varchar(255) NOT NULL,
	modelo varchar(255) NOT NULL,
	memoria varchar(255) NOT NULL,
	armazenamento varchar(255) NOT NULL,
	idtb_sor int4 NOT NULL,
	end_ip varchar(255) NULL,
	end_mac varchar(255) NULL,
	data_aquisicao date NULL,
	data_garantia date NULL,
	req_minimos varchar(45) NOT NULL,
	status varchar(255) NOT NULL,
	idtb_memorias int4 NULL,
	idtb_om_setores int4 NOT NULL DEFAULT 1,
	nome varchar(50) NULL,
	CONSTRAINT tb_estacoes_pkey PRIMARY KEY (idtb_estacoes),
	CONSTRAINT tb_estacoes_un UNIQUE (nome),
	CONSTRAINT tb_estacoes_fk FOREIGN KEY (idtb_memorias) REFERENCES db_clti.tb_memorias(idtb_memorias),
	CONSTRAINT tb_estacoes_fk_1 FOREIGN KEY (idtb_om_apoiadas) REFERENCES db_clti.tb_om_apoiadas(idtb_om_apoiadas),
	CONSTRAINT tb_estacoes_fk_2 FOREIGN KEY (idtb_proc_modelo) REFERENCES db_clti.tb_proc_modelo(idtb_proc_modelo),
	CONSTRAINT tb_estacoes_fk_3 FOREIGN KEY (idtb_sor) REFERENCES db_clti.tb_sor(idtb_sor),
	CONSTRAINT tb_estacoes_fk_4 FOREIGN KEY (idtb_om_setores) REFERENCES db_clti.tb_om_setores(idtb_om_setores)
);


-- db_clti.tb_manutencao_et definition

-- Drop table

-- DROP TABLE db_clti.tb_manutencao_et;

CREATE TABLE db_clti.tb_manutencao_et (
	idtb_manutencao_et serial NOT NULL DEFAULT nextval('db_clti.tb_manutencao_et_idtb_manutencao_et_seq'::regclass),
	idtb_estacoes int4 NOT NULL,
	idtb_om_apoiadas int4 NOT NULL,
	data_entrada date NOT NULL,
	data_saida date NULL,
	diagnostico bpchar(255) NULL,
	custo_manutencao float4 NULL,
	situacao varchar(255) NOT NULL,
	CONSTRAINT tb_manutencao_et_pk PRIMARY KEY (idtb_manutencao_et),
	CONSTRAINT tb_manutencao_et_fk FOREIGN KEY (idtb_estacoes) REFERENCES db_clti.tb_estacoes(idtb_estacoes),
	CONSTRAINT tb_manutencao_et_fk_1 FOREIGN KEY (idtb_om_apoiadas) REFERENCES db_clti.tb_om_apoiadas(idtb_om_apoiadas)
);
CREATE INDEX tb_manutencao_et_idtb_manutencao_et_idx ON db_clti.tb_manutencao_et USING btree (idtb_manutencao_et);


-- db_clti.tb_mapainfra definition

-- Drop table

-- DROP TABLE db_clti.tb_mapainfra;

CREATE TABLE db_clti.tb_mapainfra (
	idtb_mapainfra serial NOT NULL DEFAULT nextval('db_clti.tb_mapainfra_idtb_mapainfra_seq'::regclass),
	idtb_conectividade_orig int4 NOT NULL,
	idtb_conectividade_dest int4 NULL,
	idtb_servidores_dest int4 NULL,
	idtb_estacoes_dest int4 NULL,
	porta_orig int4 NOT NULL,
	porta_dest int4 NULL,
	idtb_om_apoiadas int4 NOT NULL,
	CONSTRAINT tb_mapainfra_pk PRIMARY KEY (idtb_mapainfra),
	CONSTRAINT tb_mapainfra_fk_1 FOREIGN KEY (idtb_estacoes_dest) REFERENCES db_clti.tb_estacoes(idtb_estacoes),
	CONSTRAINT tb_mapainfra_fk_2 FOREIGN KEY (idtb_servidores_dest) REFERENCES db_clti.tb_servidores(idtb_servidores),
	CONSTRAINT tb_mapainfra_fk_3 FOREIGN KEY (idtb_conectividade_orig) REFERENCES db_clti.tb_conectividade(idtb_conectividade),
	CONSTRAINT tb_mapainfra_fk_4 FOREIGN KEY (idtb_om_apoiadas) REFERENCES db_clti.tb_om_apoiadas(idtb_om_apoiadas),
	CONSTRAINT tb_mapainfra_fk_5 FOREIGN KEY (idtb_conectividade_dest) REFERENCES db_clti.tb_conectividade(idtb_conectividade)
);


-- db_clti.tb_nec_aquisicao definition

-- Drop table

-- DROP TABLE db_clti.tb_nec_aquisicao;

CREATE TABLE db_clti.tb_nec_aquisicao (
	idtb_nec_aquisicao serial NOT NULL DEFAULT nextval('db_clti.tb_nec_aquisicao_idtb_nec_aquisicao_seq'::regclass),
	idtb_manutencao_et int4 NOT NULL,
	desc_nec_aquisicao varchar(255) NULL,
	preco_cotado float4 NULL,
	previsao_aquisicao date NULL,
	situacao varchar(255) NULL,
	motivo_cancelamento varchar(255) NULL,
	CONSTRAINT tb_nec_aquisicao_pk PRIMARY KEY (idtb_nec_aquisicao),
	CONSTRAINT tb_nec_aquisicao_fk FOREIGN KEY (idtb_manutencao_et) REFERENCES db_clti.tb_manutencao_et(idtb_manutencao_et)
);
CREATE INDEX tb_nec_aquisicao_idtb_nec_aquisicao_idx ON db_clti.tb_nec_aquisicao USING btree (idtb_nec_aquisicao);


