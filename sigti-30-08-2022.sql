--
-- PostgreSQL database dump
--

-- Dumped from database version 9.2.24
-- Dumped by pg_dump version 9.2.24
-- Started on 2022-08-30 00:15:01 -03

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- TOC entry 7 (class 2615 OID 18210)
-- Name: db_clti; Type: SCHEMA; Schema: -; Owner: -
--

CREATE SCHEMA db_clti;


--
-- TOC entry 1 (class 3079 OID 12652)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 3675 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: -
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = db_clti, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 288 (class 1259 OID 19158)
-- Name: tb_acesso_suspeito; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_acesso_suspeito (
    idtb_acesso_suspeito integer NOT NULL,
    end_ip character varying(15) NOT NULL,
    data_acesso date NOT NULL,
    hora_acesso time without time zone NOT NULL,
    contador integer NOT NULL,
    status character varying(255)
);


--
-- TOC entry 3676 (class 0 OID 0)
-- Dependencies: 288
-- Name: TABLE tb_acesso_suspeito; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_acesso_suspeito IS 'Tabela contendo Acessos Suspeitos ao Sistema';


--
-- TOC entry 287 (class 1259 OID 19156)
-- Name: tb_acesso_suspeito_idtb_acesso_suspeito_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_acesso_suspeito_idtb_acesso_suspeito_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3677 (class 0 OID 0)
-- Dependencies: 287
-- Name: tb_acesso_suspeito_idtb_acesso_suspeito_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_acesso_suspeito_idtb_acesso_suspeito_seq OWNED BY tb_acesso_suspeito.idtb_acesso_suspeito;


--
-- TOC entry 170 (class 1259 OID 18211)
-- Name: tb_ade_pad_sic_tic; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_ade_pad_sic_tic (
    idtb_ade_pad_sic_tic integer NOT NULL,
    idtb_temas_pad_sic_tic integer NOT NULL,
    idtb_pessoal_om integer NOT NULL
);


--
-- TOC entry 171 (class 1259 OID 18214)
-- Name: tb_ade_pad_sic_tic_idtb_ade_pad_sic_tic_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_ade_pad_sic_tic_idtb_ade_pad_sic_tic_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3678 (class 0 OID 0)
-- Dependencies: 171
-- Name: tb_ade_pad_sic_tic_idtb_ade_pad_sic_tic_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_ade_pad_sic_tic_idtb_ade_pad_sic_tic_seq OWNED BY tb_ade_pad_sic_tic.idtb_ade_pad_sic_tic;


--
-- TOC entry 172 (class 1259 OID 18216)
-- Name: tb_cidade; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_cidade (
    id integer NOT NULL,
    nome character varying(120) NOT NULL,
    estado integer NOT NULL
);


--
-- TOC entry 3679 (class 0 OID 0)
-- Dependencies: 172
-- Name: TABLE tb_cidade; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_cidade IS 'Tabela contendo Cidades.';


--
-- TOC entry 173 (class 1259 OID 18219)
-- Name: tb_cidade_id_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_cidade_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3681 (class 0 OID 0)
-- Dependencies: 173
-- Name: tb_cidade_id_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_cidade_id_seq OWNED BY tb_cidade.id;


--
-- TOC entry 174 (class 1259 OID 18221)
-- Name: tb_clti; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_clti (
    idtb_clti integer NOT NULL,
    efetivo_oficiais integer,
    efetivo_pracas integer,
    nome character varying(255) NOT NULL,
    sigla character varying(45) NOT NULL,
    indicativo character varying(6) NOT NULL,
    data_ativacao date NOT NULL
);


--
-- TOC entry 3682 (class 0 OID 0)
-- Dependencies: 174
-- Name: TABLE tb_clti; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_clti IS 'Tabela contendo Informações do CLTI.';


--
-- TOC entry 175 (class 1259 OID 18224)
-- Name: tb_clti_idtb_clti_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_clti_idtb_clti_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3684 (class 0 OID 0)
-- Dependencies: 175
-- Name: tb_clti_idtb_clti_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_clti_idtb_clti_seq OWNED BY tb_clti.idtb_clti;


--
-- TOC entry 176 (class 1259 OID 18226)
-- Name: tb_conectividade; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_conectividade (
    idtb_conectividade integer NOT NULL,
    idtb_om_apoiadas integer NOT NULL,
    fabricante character varying(255) NOT NULL,
    modelo character varying(255) NOT NULL,
    end_ip character varying(255),
    data_aquisicao date NOT NULL,
    data_garantia date,
    idtb_om_setores integer,
    qtde_portas integer,
    nome character varying(50),
    status character varying
);


--
-- TOC entry 3685 (class 0 OID 0)
-- Dependencies: 176
-- Name: TABLE tb_conectividade; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_conectividade IS 'Tabela contendo Equipamentos de Conectividade.';


--
-- TOC entry 3686 (class 0 OID 0)
-- Dependencies: 176
-- Name: COLUMN tb_conectividade.qtde_portas; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON COLUMN tb_conectividade.qtde_portas IS 'Quantidade de portas do ativo de rede';


--
-- TOC entry 294 (class 1259 OID 19225)
-- Name: tb_conectividade_excluidos; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_conectividade_excluidos (
    idtb_conectividade_excluidos integer NOT NULL,
    idtb_om_apoiadas integer NOT NULL,
    fabricante character varying(255) NOT NULL,
    modelo character varying(255) NOT NULL,
    end_ip character varying(255),
    data_del date NOT NULL,
    hora_del time without time zone NOT NULL
);


--
-- TOC entry 3688 (class 0 OID 0)
-- Dependencies: 294
-- Name: TABLE tb_conectividade_excluidos; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_conectividade_excluidos IS 'Equipamentos de conectividade excluídos';


--
-- TOC entry 293 (class 1259 OID 19223)
-- Name: tb_conectividade_excluidos_idtb_conectividade_excluidos_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_conectividade_excluidos_idtb_conectividade_excluidos_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3689 (class 0 OID 0)
-- Dependencies: 293
-- Name: tb_conectividade_excluidos_idtb_conectividade_excluidos_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_conectividade_excluidos_idtb_conectividade_excluidos_seq OWNED BY tb_conectividade_excluidos.idtb_conectividade_excluidos;


--
-- TOC entry 177 (class 1259 OID 18232)
-- Name: tb_conectividade_idtb_conectividade_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_conectividade_idtb_conectividade_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3690 (class 0 OID 0)
-- Dependencies: 177
-- Name: tb_conectividade_idtb_conectividade_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_conectividade_idtb_conectividade_seq OWNED BY tb_conectividade.idtb_conectividade;


--
-- TOC entry 178 (class 1259 OID 18234)
-- Name: tb_config; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_config (
    idtb_config integer NOT NULL,
    parametro character varying(255),
    valor character varying(255)
);


--
-- TOC entry 3691 (class 0 OID 0)
-- Dependencies: 178
-- Name: TABLE tb_config; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_config IS 'Tabela contendo Configurações do Sistema.';


--
-- TOC entry 179 (class 1259 OID 18240)
-- Name: tb_config_idtb_config_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_config_idtb_config_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3693 (class 0 OID 0)
-- Dependencies: 179
-- Name: tb_config_idtb_config_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_config_idtb_config_seq OWNED BY tb_config.idtb_config;


--
-- TOC entry 180 (class 1259 OID 18242)
-- Name: tb_controle_internet; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_controle_internet (
    idtb_controle_internet integer NOT NULL,
    idtb_om_apoiadas integer NOT NULL,
    idtb_pessoal_om integer NOT NULL,
    perfis character varying(255) NOT NULL,
    status character varying
);


--
-- TOC entry 3694 (class 0 OID 0)
-- Dependencies: 180
-- Name: TABLE tb_controle_internet; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_controle_internet IS 'Tabela contendo Controle dos Perfis de Internet';


--
-- TOC entry 181 (class 1259 OID 18248)
-- Name: tb_controle_internet_idtb_controle_internet_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_controle_internet_idtb_controle_internet_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3696 (class 0 OID 0)
-- Dependencies: 181
-- Name: tb_controle_internet_idtb_controle_internet_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_controle_internet_idtb_controle_internet_seq OWNED BY tb_controle_internet.idtb_controle_internet;


--
-- TOC entry 182 (class 1259 OID 18250)
-- Name: tb_controle_usb; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_controle_usb (
    idtb_controle_usb integer NOT NULL,
    idtb_om_apoiadas integer NOT NULL,
    idtb_estacoes integer NOT NULL,
    autorizacao character varying(255) NOT NULL,
    status character varying
);


--
-- TOC entry 3697 (class 0 OID 0)
-- Dependencies: 182
-- Name: TABLE tb_controle_usb; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_controle_usb IS 'Tabela contendo Controle de Permissões de Uso USB';


--
-- TOC entry 183 (class 1259 OID 18256)
-- Name: tb_controle_usb_idtb_controle_usb_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_controle_usb_idtb_controle_usb_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3699 (class 0 OID 0)
-- Dependencies: 183
-- Name: tb_controle_usb_idtb_controle_usb_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_controle_usb_idtb_controle_usb_seq OWNED BY tb_controle_usb.idtb_controle_usb;


--
-- TOC entry 184 (class 1259 OID 18258)
-- Name: tb_corpo_quadro; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_corpo_quadro (
    idtb_corpo_quadro integer NOT NULL,
    nome character varying(45) NOT NULL,
    sigla character varying(45) NOT NULL,
    exibir character varying(45)
);


--
-- TOC entry 3700 (class 0 OID 0)
-- Dependencies: 184
-- Name: TABLE tb_corpo_quadro; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_corpo_quadro IS 'Tabela contendo Corpos e Quadros.';


--
-- TOC entry 185 (class 1259 OID 18261)
-- Name: tb_corpo_quadro_idtb_corpo_quadro_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_corpo_quadro_idtb_corpo_quadro_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3702 (class 0 OID 0)
-- Dependencies: 185
-- Name: tb_corpo_quadro_idtb_corpo_quadro_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_corpo_quadro_idtb_corpo_quadro_seq OWNED BY tb_corpo_quadro.idtb_corpo_quadro;


--
-- TOC entry 186 (class 1259 OID 18263)
-- Name: tb_det_serv; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_det_serv (
    idtb_det_serv integer NOT NULL,
    idtb_lotacao_clti integer NOT NULL,
    data_entra_servico date NOT NULL,
    data_sai_servico date NOT NULL,
    status character varying(255)
);


--
-- TOC entry 3703 (class 0 OID 0)
-- Dependencies: 186
-- Name: TABLE tb_det_serv; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_det_serv IS 'Tabela contendo Detalhe de Serviço do CLTI Versão 2';


--
-- TOC entry 187 (class 1259 OID 18266)
-- Name: tb_det_serv_idtb_det_serv_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_det_serv_idtb_det_serv_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3704 (class 0 OID 0)
-- Dependencies: 187
-- Name: tb_det_serv_idtb_det_serv_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_det_serv_idtb_det_serv_seq OWNED BY tb_det_serv.idtb_det_serv;


--
-- TOC entry 188 (class 1259 OID 18268)
-- Name: tb_dias_troca; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_dias_troca (
    idtb_dias_troca integer NOT NULL,
    id_usuario integer NOT NULL,
    dias_troca integer NOT NULL
);


--
-- TOC entry 3705 (class 0 OID 0)
-- Dependencies: 188
-- Name: TABLE tb_dias_troca; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_dias_troca IS 'Tabela contendo Dias para Troca de Senha do CLTI';


--
-- TOC entry 189 (class 1259 OID 18271)
-- Name: tb_dias_troca_clti; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_dias_troca_clti (
    idtb_dias_troca_clti integer NOT NULL,
    id_usuario integer NOT NULL,
    dias_troca integer NOT NULL
);


--
-- TOC entry 190 (class 1259 OID 18274)
-- Name: tb_dias_troca_clti_idtb_dias_troca_clti_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_dias_troca_clti_idtb_dias_troca_clti_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3706 (class 0 OID 0)
-- Dependencies: 190
-- Name: tb_dias_troca_clti_idtb_dias_troca_clti_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_dias_troca_clti_idtb_dias_troca_clti_seq OWNED BY tb_dias_troca_clti.idtb_dias_troca_clti;


--
-- TOC entry 191 (class 1259 OID 18276)
-- Name: tb_dias_troca_idtb_dias_troca_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_dias_troca_idtb_dias_troca_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3707 (class 0 OID 0)
-- Dependencies: 191
-- Name: tb_dias_troca_idtb_dias_troca_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_dias_troca_idtb_dias_troca_seq OWNED BY tb_dias_troca.idtb_dias_troca;


--
-- TOC entry 192 (class 1259 OID 18278)
-- Name: tb_especialidade; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_especialidade (
    idtb_especialidade integer NOT NULL,
    nome character varying(45) NOT NULL,
    sigla character varying(45) NOT NULL,
    exibir character varying
);


--
-- TOC entry 3708 (class 0 OID 0)
-- Dependencies: 192
-- Name: TABLE tb_especialidade; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_especialidade IS 'Tabela contendo Especialidades.';


--
-- TOC entry 193 (class 1259 OID 18284)
-- Name: tb_especialidade_idtb_especialidade_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_especialidade_idtb_especialidade_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3710 (class 0 OID 0)
-- Dependencies: 193
-- Name: tb_especialidade_idtb_especialidade_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_especialidade_idtb_especialidade_seq OWNED BY tb_especialidade.idtb_especialidade;


--
-- TOC entry 194 (class 1259 OID 18286)
-- Name: tb_estacoes; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_estacoes (
    idtb_estacoes integer NOT NULL,
    idtb_om_apoiadas integer NOT NULL,
    idtb_proc_modelo integer NOT NULL,
    clock_proc real NOT NULL,
    fabricante character varying(255) NOT NULL,
    modelo character varying(255) NOT NULL,
    memoria character varying(255) NOT NULL,
    armazenamento character varying(255) NOT NULL,
    idtb_sor integer NOT NULL,
    end_ip character varying(255),
    end_mac character varying(255),
    data_aquisicao date,
    data_garantia date,
    req_minimos character varying(45) NOT NULL,
    status character varying(255) NOT NULL,
    idtb_memorias integer,
    idtb_om_setores integer DEFAULT 1 NOT NULL,
    nome character varying(50)
);


--
-- TOC entry 3711 (class 0 OID 0)
-- Dependencies: 194
-- Name: TABLE tb_estacoes; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_estacoes IS 'Tabela contendo Estações de Trabalho.';


--
-- TOC entry 292 (class 1259 OID 19214)
-- Name: tb_estacoes_excluidas; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_estacoes_excluidas (
    idtb_estacoes_excluidas integer NOT NULL,
    idtb_om_apoiadas integer NOT NULL,
    fabricante character varying(255) NOT NULL,
    modelo character varying(255) NOT NULL,
    nome character varying(255) NOT NULL,
    end_ip character varying(255) NOT NULL,
    end_mac character varying(255) NOT NULL,
    data_del date NOT NULL,
    hora_del time without time zone NOT NULL
);


--
-- TOC entry 3713 (class 0 OID 0)
-- Dependencies: 292
-- Name: TABLE tb_estacoes_excluidas; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_estacoes_excluidas IS 'Estações de trabalho excluídas';


--
-- TOC entry 291 (class 1259 OID 19212)
-- Name: tb_estacoes_excluidas_idtb_estacoes_excluidas_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_estacoes_excluidas_idtb_estacoes_excluidas_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3714 (class 0 OID 0)
-- Dependencies: 291
-- Name: tb_estacoes_excluidas_idtb_estacoes_excluidas_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_estacoes_excluidas_idtb_estacoes_excluidas_seq OWNED BY tb_estacoes_excluidas.idtb_estacoes_excluidas;


--
-- TOC entry 195 (class 1259 OID 18293)
-- Name: tb_estacoes_idtb_estacoes_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_estacoes_idtb_estacoes_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3715 (class 0 OID 0)
-- Dependencies: 195
-- Name: tb_estacoes_idtb_estacoes_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_estacoes_idtb_estacoes_seq OWNED BY tb_estacoes.idtb_estacoes;


--
-- TOC entry 196 (class 1259 OID 18295)
-- Name: tb_estado; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_estado (
    id integer NOT NULL,
    nome character varying(75) NOT NULL,
    uf character varying(5) NOT NULL,
    pais integer NOT NULL
);


--
-- TOC entry 3716 (class 0 OID 0)
-- Dependencies: 196
-- Name: TABLE tb_estado; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_estado IS 'Tabela contendo Estados.';


--
-- TOC entry 197 (class 1259 OID 18298)
-- Name: tb_estado_id_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_estado_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3718 (class 0 OID 0)
-- Dependencies: 197
-- Name: tb_estado_id_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_estado_id_seq OWNED BY tb_estado.id;


--
-- TOC entry 198 (class 1259 OID 18300)
-- Name: tb_funcoes_clti; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_funcoes_clti (
    idtb_funcoes_clti integer NOT NULL,
    sigla character varying(255) NOT NULL,
    descricao character varying(255) NOT NULL,
    requerida character varying(3)
);


--
-- TOC entry 3719 (class 0 OID 0)
-- Dependencies: 198
-- Name: TABLE tb_funcoes_clti; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_funcoes_clti IS 'Tabela contendo Funções do CLTI';


--
-- TOC entry 199 (class 1259 OID 18306)
-- Name: tb_funcoes_clti_idtb_funcoes_clti_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_funcoes_clti_idtb_funcoes_clti_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3720 (class 0 OID 0)
-- Dependencies: 199
-- Name: tb_funcoes_clti_idtb_funcoes_clti_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_funcoes_clti_idtb_funcoes_clti_seq OWNED BY tb_funcoes_clti.idtb_funcoes_clti;


--
-- TOC entry 200 (class 1259 OID 18308)
-- Name: tb_funcoes_sigdem; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_funcoes_sigdem (
    idtb_funcoes_sigdem integer NOT NULL,
    idtb_om_apoiadas integer,
    descricao character varying(255) NOT NULL,
    sigla character varying(45) NOT NULL,
    idtb_pessoal_om integer,
    status character varying
);


--
-- TOC entry 3721 (class 0 OID 0)
-- Dependencies: 200
-- Name: TABLE tb_funcoes_sigdem; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_funcoes_sigdem IS 'Tabela contendo Funções do SiGDEM';


--
-- TOC entry 201 (class 1259 OID 18314)
-- Name: tb_funcoes_sigdem_idtb_funcoes_sigdem_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_funcoes_sigdem_idtb_funcoes_sigdem_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3723 (class 0 OID 0)
-- Dependencies: 201
-- Name: tb_funcoes_sigdem_idtb_funcoes_sigdem_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_funcoes_sigdem_idtb_funcoes_sigdem_seq OWNED BY tb_funcoes_sigdem.idtb_funcoes_sigdem;


--
-- TOC entry 202 (class 1259 OID 18316)
-- Name: tb_funcoes_ti; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_funcoes_ti (
    idtb_funcoes_ti integer NOT NULL,
    descricao character varying(255) NOT NULL,
    sigla character varying(45) NOT NULL
);


--
-- TOC entry 3724 (class 0 OID 0)
-- Dependencies: 202
-- Name: TABLE tb_funcoes_ti; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_funcoes_ti IS 'Tabela contendo Funções de TI.';


--
-- TOC entry 203 (class 1259 OID 18319)
-- Name: tb_funcoes_ti_idtb_funcoes_ti_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_funcoes_ti_idtb_funcoes_ti_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3726 (class 0 OID 0)
-- Dependencies: 203
-- Name: tb_funcoes_ti_idtb_funcoes_ti_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_funcoes_ti_idtb_funcoes_ti_seq OWNED BY tb_funcoes_ti.idtb_funcoes_ti;


--
-- TOC entry 204 (class 1259 OID 18321)
-- Name: tb_gw_om; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_gw_om (
    idtb_gw_om integer NOT NULL,
    idtb_om_apoiadas integer NOT NULL,
    ip_gw character varying(15) NOT NULL,
    status character varying(255),
    qtde_vrf integer
);


--
-- TOC entry 3727 (class 0 OID 0)
-- Dependencies: 204
-- Name: TABLE tb_gw_om; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_gw_om IS 'Tabela contendo status do Gateway das OM Apoiadas';


--
-- TOC entry 205 (class 1259 OID 18324)
-- Name: tb_gw_om_idtb_gw_om_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_gw_om_idtb_gw_om_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3728 (class 0 OID 0)
-- Dependencies: 205
-- Name: tb_gw_om_idtb_gw_om_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_gw_om_idtb_gw_om_seq OWNED BY tb_gw_om.idtb_gw_om;


--
-- TOC entry 206 (class 1259 OID 18326)
-- Name: tb_lotacao_clti; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_lotacao_clti (
    idtb_lotacao_clti integer NOT NULL,
    idtb_posto_grad integer NOT NULL,
    idtb_corpo_quadro integer,
    idtb_especialidade integer,
    nip character varying(8),
    cpf character varying(11) DEFAULT NULL::character varying,
    nome character varying(255) NOT NULL,
    nome_guerra character varying(45) NOT NULL,
    status character varying(45) DEFAULT '1'::character varying NOT NULL,
    senha character varying(255),
    perfil character varying(45),
    correio_eletronico character varying(255),
    idtb_funcoes_clti integer,
    tarefa character varying(25),
    secret character varying(16) DEFAULT 'Não ativado'::character varying NOT NULL,
    ip_acesso character varying(15) DEFAULT '0.0.0.0'::character varying NOT NULL,
    cont_erro integer DEFAULT 0 NOT NULL
);


--
-- TOC entry 3729 (class 0 OID 0)
-- Dependencies: 206
-- Name: TABLE tb_lotacao_clti; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_lotacao_clti IS 'Tabela contendo Lotação do CLTI.';


--
-- TOC entry 207 (class 1259 OID 18334)
-- Name: tb_lotacao_clti_idtb_lotacao_clti_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_lotacao_clti_idtb_lotacao_clti_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3731 (class 0 OID 0)
-- Dependencies: 207
-- Name: tb_lotacao_clti_idtb_lotacao_clti_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_lotacao_clti_idtb_lotacao_clti_seq OWNED BY tb_lotacao_clti.idtb_lotacao_clti;


--
-- TOC entry 208 (class 1259 OID 18336)
-- Name: tb_manutencao_et; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_manutencao_et (
    idtb_manutencao_et integer NOT NULL,
    idtb_estacoes integer NOT NULL,
    idtb_om_apoiadas integer NOT NULL,
    data_entrada date NOT NULL,
    data_saida date,
    diagnostico character(255),
    custo_manutencao real,
    situacao character varying(255) NOT NULL
);


--
-- TOC entry 3732 (class 0 OID 0)
-- Dependencies: 208
-- Name: TABLE tb_manutencao_et; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_manutencao_et IS 'Tabela contendo Controle de Manutenção das ET.';


--
-- TOC entry 209 (class 1259 OID 18342)
-- Name: tb_manutencao_et_idtb_manutencao_et_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_manutencao_et_idtb_manutencao_et_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3734 (class 0 OID 0)
-- Dependencies: 209
-- Name: tb_manutencao_et_idtb_manutencao_et_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_manutencao_et_idtb_manutencao_et_seq OWNED BY tb_manutencao_et.idtb_manutencao_et;


--
-- TOC entry 210 (class 1259 OID 18344)
-- Name: tb_mapainfra; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_mapainfra (
    idtb_mapainfra integer NOT NULL,
    idtb_conectividade_orig integer NOT NULL,
    idtb_conectividade_dest integer,
    idtb_servidores_dest integer,
    idtb_estacoes_dest integer,
    porta_orig integer NOT NULL,
    porta_dest integer,
    idtb_om_apoiadas integer NOT NULL
);


--
-- TOC entry 3735 (class 0 OID 0)
-- Dependencies: 210
-- Name: TABLE tb_mapainfra; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_mapainfra IS 'Mapeamentos dos pontos de rede da infraestrutura,';


--
-- TOC entry 211 (class 1259 OID 18347)
-- Name: tb_mapainfra_idtb_mapainfra_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_mapainfra_idtb_mapainfra_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3737 (class 0 OID 0)
-- Dependencies: 211
-- Name: tb_mapainfra_idtb_mapainfra_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_mapainfra_idtb_mapainfra_seq OWNED BY tb_mapainfra.idtb_mapainfra;


--
-- TOC entry 212 (class 1259 OID 18349)
-- Name: tb_memorias; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_memorias (
    idtb_memorias integer NOT NULL,
    tipo character varying(255) NOT NULL,
    modelo character varying(255) NOT NULL,
    clock integer NOT NULL
);


--
-- TOC entry 3738 (class 0 OID 0)
-- Dependencies: 212
-- Name: TABLE tb_memorias; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_memorias IS 'Tabela contendo Modelos de Memórias RAM.';


--
-- TOC entry 213 (class 1259 OID 18355)
-- Name: tb_memorias_idtb_memorias_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_memorias_idtb_memorias_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3740 (class 0 OID 0)
-- Dependencies: 213
-- Name: tb_memorias_idtb_memorias_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_memorias_idtb_memorias_seq OWNED BY tb_memorias.idtb_memorias;


--
-- TOC entry 214 (class 1259 OID 18357)
-- Name: tb_nao_padronizados; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_nao_padronizados (
    idtb_nao_padronizados integer NOT NULL,
    idtb_om_apoiadas integer NOT NULL,
    idtb_estacoes integer NOT NULL,
    autorizacao character varying(255) NOT NULL,
    soft_autorizados character varying
);


--
-- TOC entry 3741 (class 0 OID 0)
-- Dependencies: 214
-- Name: TABLE tb_nao_padronizados; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_nao_padronizados IS 'Tabela contendo ET com Aplicativos não Padronizados';


--
-- TOC entry 215 (class 1259 OID 18363)
-- Name: tb_nao_padronizados_idtb_nao_padronizados_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_nao_padronizados_idtb_nao_padronizados_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3742 (class 0 OID 0)
-- Dependencies: 215
-- Name: tb_nao_padronizados_idtb_nao_padronizados_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_nao_padronizados_idtb_nao_padronizados_seq OWNED BY tb_nao_padronizados.idtb_nao_padronizados;


--
-- TOC entry 216 (class 1259 OID 18365)
-- Name: tb_nec_aquisicao; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_nec_aquisicao (
    idtb_nec_aquisicao integer NOT NULL,
    idtb_manutencao_et integer NOT NULL,
    desc_nec_aquisicao character varying(255),
    preco_cotado real,
    previsao_aquisicao date,
    situacao character varying(255),
    motivo_cancelamento character varying(255)
);


--
-- TOC entry 3743 (class 0 OID 0)
-- Dependencies: 216
-- Name: TABLE tb_nec_aquisicao; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_nec_aquisicao IS 'Tabela contendo Necessidades de Aquisição de Material de TI para reparos de ET.';


--
-- TOC entry 217 (class 1259 OID 18371)
-- Name: tb_nec_aquisicao_idtb_nec_aquisicao_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_nec_aquisicao_idtb_nec_aquisicao_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3745 (class 0 OID 0)
-- Dependencies: 217
-- Name: tb_nec_aquisicao_idtb_nec_aquisicao_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_nec_aquisicao_idtb_nec_aquisicao_seq OWNED BY tb_nec_aquisicao.idtb_nec_aquisicao;


--
-- TOC entry 218 (class 1259 OID 18373)
-- Name: tb_numerador; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_numerador (
    idtb_numerador integer NOT NULL,
    parametro character varying(255) NOT NULL,
    prox_num integer NOT NULL
);


--
-- TOC entry 219 (class 1259 OID 18376)
-- Name: tb_numerador_idtb_numerador_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_numerador_idtb_numerador_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3746 (class 0 OID 0)
-- Dependencies: 219
-- Name: tb_numerador_idtb_numerador_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_numerador_idtb_numerador_seq OWNED BY tb_numerador.idtb_numerador;


--
-- TOC entry 220 (class 1259 OID 18378)
-- Name: tb_om_apoiadas; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_om_apoiadas (
    idtb_om_apoiadas integer NOT NULL,
    cod_om integer NOT NULL,
    nome character varying(255) NOT NULL,
    sigla character varying(45) NOT NULL,
    indicativo character varying(6) NOT NULL,
    idtb_estado integer NOT NULL,
    idtb_cidade integer NOT NULL
);


--
-- TOC entry 3747 (class 0 OID 0)
-- Dependencies: 220
-- Name: TABLE tb_om_apoiadas; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_om_apoiadas IS 'Tabela contendo OM Apoiadas pelo CLTI.';


--
-- TOC entry 221 (class 1259 OID 18381)
-- Name: tb_om_apoiadas_idtb_om_apoiadas_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_om_apoiadas_idtb_om_apoiadas_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3749 (class 0 OID 0)
-- Dependencies: 221
-- Name: tb_om_apoiadas_idtb_om_apoiadas_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_om_apoiadas_idtb_om_apoiadas_seq OWNED BY tb_om_apoiadas.idtb_om_apoiadas;


--
-- TOC entry 222 (class 1259 OID 18383)
-- Name: tb_om_setores; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_om_setores (
    idtb_om_setores integer NOT NULL,
    idtb_om_apoiadas integer NOT NULL,
    nome_setor character varying(255) NOT NULL,
    sigla_setor character varying(255) NOT NULL,
    cod_funcional character varying(45) NOT NULL,
    compartimento character varying(255) NOT NULL
);


--
-- TOC entry 3750 (class 0 OID 0)
-- Dependencies: 222
-- Name: TABLE tb_om_setores; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_om_setores IS 'Tabela contendo Setores das OM Apoiadas.';


--
-- TOC entry 223 (class 1259 OID 18389)
-- Name: tb_om_setores_idtb_om_setores_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_om_setores_idtb_om_setores_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3752 (class 0 OID 0)
-- Dependencies: 223
-- Name: tb_om_setores_idtb_om_setores_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_om_setores_idtb_om_setores_seq OWNED BY tb_om_setores.idtb_om_setores;


--
-- TOC entry 224 (class 1259 OID 18391)
-- Name: tb_osic; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_osic (
    idtb_osic integer NOT NULL,
    idtb_om_apoiadas integer,
    idtb_posto_grad integer,
    idtb_corpo_quadro integer,
    idtb_especialidade integer,
    nip character varying(8),
    cpf character varying(11),
    nome character varying(255),
    nome_guerra character varying(45),
    perfil character varying(45),
    senha character varying(255),
    status character varying(45),
    correio_eletronico character varying(255) NOT NULL
);


--
-- TOC entry 3753 (class 0 OID 0)
-- Dependencies: 224
-- Name: TABLE tb_osic; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_osic IS 'Tabela contendo OSIC das OM.';


--
-- TOC entry 225 (class 1259 OID 18397)
-- Name: tb_osic_idtb_osic_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_osic_idtb_osic_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3755 (class 0 OID 0)
-- Dependencies: 225
-- Name: tb_osic_idtb_osic_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_osic_idtb_osic_seq OWNED BY tb_osic.idtb_osic;


--
-- TOC entry 226 (class 1259 OID 18399)
-- Name: tb_pad_sic_tic; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_pad_sic_tic (
    idtb_pad_sic_tic integer NOT NULL,
    idtb_om_apoiadas integer NOT NULL,
    ano_base integer NOT NULL,
    data_assinatura date NOT NULL,
    data_revisao date,
    status character varying NOT NULL
);


--
-- TOC entry 3756 (class 0 OID 0)
-- Dependencies: 226
-- Name: TABLE tb_pad_sic_tic; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_pad_sic_tic IS 'Tabela contendo Participantes dos Adestramentos do PAD SIC/TIC';


--
-- TOC entry 227 (class 1259 OID 18405)
-- Name: tb_pad_sic_tic_idtb_pad_sic_tic_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_pad_sic_tic_idtb_pad_sic_tic_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3757 (class 0 OID 0)
-- Dependencies: 227
-- Name: tb_pad_sic_tic_idtb_pad_sic_tic_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_pad_sic_tic_idtb_pad_sic_tic_seq OWNED BY tb_pad_sic_tic.idtb_pad_sic_tic;


--
-- TOC entry 228 (class 1259 OID 18407)
-- Name: tb_pais; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_pais (
    id integer NOT NULL,
    nome character varying(60) NOT NULL,
    sigla character varying(10) NOT NULL
);


--
-- TOC entry 3758 (class 0 OID 0)
-- Dependencies: 228
-- Name: TABLE tb_pais; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_pais IS 'Tabela contendo País.';


--
-- TOC entry 229 (class 1259 OID 18410)
-- Name: tb_pais_id_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_pais_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3760 (class 0 OID 0)
-- Dependencies: 229
-- Name: tb_pais_id_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_pais_id_seq OWNED BY tb_pais.id;


--
-- TOC entry 230 (class 1259 OID 18412)
-- Name: tb_perfil_internet; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_perfil_internet (
    idtb_perfil_internet integer NOT NULL,
    nome character varying(255) NOT NULL,
    status character varying(45) NOT NULL
);


--
-- TOC entry 3761 (class 0 OID 0)
-- Dependencies: 230
-- Name: TABLE tb_perfil_internet; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_perfil_internet IS 'Tabela contendo Perfis da Internet';


--
-- TOC entry 231 (class 1259 OID 18415)
-- Name: tb_perfil_internet_idtb_perfil_internet_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_perfil_internet_idtb_perfil_internet_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3763 (class 0 OID 0)
-- Dependencies: 231
-- Name: tb_perfil_internet_idtb_perfil_internet_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_perfil_internet_idtb_perfil_internet_seq OWNED BY tb_perfil_internet.idtb_perfil_internet;


--
-- TOC entry 232 (class 1259 OID 18417)
-- Name: tb_permissoes_admin; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_permissoes_admin (
    idtb_permissoes_admin integer NOT NULL,
    idtb_om_apoiadas integer NOT NULL,
    idtb_estacoes integer NOT NULL,
    autorizacao character varying(255) NOT NULL
);


--
-- TOC entry 3764 (class 0 OID 0)
-- Dependencies: 232
-- Name: TABLE tb_permissoes_admin; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_permissoes_admin IS 'Tabela contendo ET com Permissões de Administrador';


--
-- TOC entry 233 (class 1259 OID 18420)
-- Name: tb_permissoes_admin_idtb_permissoes_admin_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_permissoes_admin_idtb_permissoes_admin_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3765 (class 0 OID 0)
-- Dependencies: 233
-- Name: tb_permissoes_admin_idtb_permissoes_admin_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_permissoes_admin_idtb_permissoes_admin_seq OWNED BY tb_permissoes_admin.idtb_permissoes_admin;


--
-- TOC entry 298 (class 1259 OID 19247)
-- Name: tb_pessoal_excluido; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_pessoal_excluido (
    idtb_pessoal_excluido integer NOT NULL,
    idtb_om_apoiadas integer NOT NULL,
    nip character varying(8) NOT NULL,
    cpf character varying(11) NOT NULL,
    nome character varying(255) NOT NULL,
    nome_guerra character varying(255) NOT NULL,
    funcao character varying(255) NOT NULL,
    data_del date NOT NULL,
    hora_del time without time zone NOT NULL
);


--
-- TOC entry 3766 (class 0 OID 0)
-- Dependencies: 298
-- Name: TABLE tb_pessoal_excluido; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_pessoal_excluido IS 'Pessoal de TI excluído';


--
-- TOC entry 297 (class 1259 OID 19245)
-- Name: tb_pessoal_excluido_idtb_pessoal_excluido_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_pessoal_excluido_idtb_pessoal_excluido_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3767 (class 0 OID 0)
-- Dependencies: 297
-- Name: tb_pessoal_excluido_idtb_pessoal_excluido_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_pessoal_excluido_idtb_pessoal_excluido_seq OWNED BY tb_pessoal_excluido.idtb_pessoal_excluido;


--
-- TOC entry 234 (class 1259 OID 18422)
-- Name: tb_pessoal_om; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_pessoal_om (
    idtb_pessoal_om integer NOT NULL,
    idtb_om_apoiadas integer NOT NULL,
    idtb_posto_grad integer NOT NULL,
    idtb_corpo_quadro integer NOT NULL,
    idtb_especialidade integer NOT NULL,
    nip character varying(8) NOT NULL,
    cpf character varying(11) NOT NULL,
    nome character varying(255) NOT NULL,
    nome_guerra character varying(255) NOT NULL,
    correio_eletronico character varying(255) NOT NULL,
    status character varying(255) NOT NULL,
    foradaareati character varying
);


--
-- TOC entry 3768 (class 0 OID 0)
-- Dependencies: 234
-- Name: TABLE tb_pessoal_om; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_pessoal_om IS 'Tabela contendo Pessoal (Usuários) da OM';


--
-- TOC entry 235 (class 1259 OID 18428)
-- Name: tb_pessoal_om_idtb_pessoal_om_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_pessoal_om_idtb_pessoal_om_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3770 (class 0 OID 0)
-- Dependencies: 235
-- Name: tb_pessoal_om_idtb_pessoal_om_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_pessoal_om_idtb_pessoal_om_seq OWNED BY tb_pessoal_om.idtb_pessoal_om;


--
-- TOC entry 236 (class 1259 OID 18430)
-- Name: tb_pessoal_ti; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_pessoal_ti (
    idtb_pessoal_ti integer NOT NULL,
    idtb_om_apoiadas integer NOT NULL,
    idtb_posto_grad integer NOT NULL,
    idtb_corpo_quadro integer NOT NULL,
    idtb_especialidade integer NOT NULL,
    nip character varying(8) NOT NULL,
    cpf character varying(11) NOT NULL,
    nome character varying(255) NOT NULL,
    nome_guerra character varying(255) NOT NULL,
    correio_eletronico character varying(255) NOT NULL,
    status character varying(255) NOT NULL,
    senha character varying(255) NOT NULL,
    idtb_funcoes_ti integer NOT NULL,
    secret character varying(16) DEFAULT 'Não ativado'::character varying NOT NULL,
    ip_acesso character varying(15) DEFAULT '0.0.0.0'::character varying NOT NULL,
    cont_erro integer DEFAULT 0 NOT NULL
);


--
-- TOC entry 3771 (class 0 OID 0)
-- Dependencies: 236
-- Name: TABLE tb_pessoal_ti; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_pessoal_ti IS 'Tabela contendo Pessoal de TI das OM.';


--
-- TOC entry 237 (class 1259 OID 18436)
-- Name: tb_pessoal_ti_idtb_pessoal_ti_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_pessoal_ti_idtb_pessoal_ti_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3773 (class 0 OID 0)
-- Dependencies: 237
-- Name: tb_pessoal_ti_idtb_pessoal_ti_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_pessoal_ti_idtb_pessoal_ti_seq OWNED BY tb_pessoal_ti.idtb_pessoal_ti;


--
-- TOC entry 238 (class 1259 OID 18438)
-- Name: tb_posto_grad; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_posto_grad (
    idtb_posto_grad integer NOT NULL,
    nome character varying(45) NOT NULL,
    sigla character varying(45) NOT NULL
);


--
-- TOC entry 3774 (class 0 OID 0)
-- Dependencies: 238
-- Name: TABLE tb_posto_grad; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_posto_grad IS 'Tabela contendo Postros e Graduações.';


--
-- TOC entry 239 (class 1259 OID 18441)
-- Name: tb_posto_grad_idtb_posto_grad_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_posto_grad_idtb_posto_grad_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3776 (class 0 OID 0)
-- Dependencies: 239
-- Name: tb_posto_grad_idtb_posto_grad_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_posto_grad_idtb_posto_grad_seq OWNED BY tb_posto_grad.idtb_posto_grad;


--
-- TOC entry 240 (class 1259 OID 18443)
-- Name: tb_proc_fab; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_proc_fab (
    idtb_proc_fab integer NOT NULL,
    nome character varying(255) NOT NULL
);


--
-- TOC entry 3777 (class 0 OID 0)
-- Dependencies: 240
-- Name: TABLE tb_proc_fab; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_proc_fab IS 'Tabela contendo Fabricantes de Processadores.';


--
-- TOC entry 241 (class 1259 OID 18446)
-- Name: tb_proc_fab_idtb_proc_fab_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_proc_fab_idtb_proc_fab_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3779 (class 0 OID 0)
-- Dependencies: 241
-- Name: tb_proc_fab_idtb_proc_fab_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_proc_fab_idtb_proc_fab_seq OWNED BY tb_proc_fab.idtb_proc_fab;


--
-- TOC entry 242 (class 1259 OID 18448)
-- Name: tb_proc_modelo; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_proc_modelo (
    idtb_proc_modelo integer NOT NULL,
    idtb_proc_fab integer NOT NULL,
    modelo character varying(255) NOT NULL
);


--
-- TOC entry 3780 (class 0 OID 0)
-- Dependencies: 242
-- Name: TABLE tb_proc_modelo; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_proc_modelo IS 'Tabela contendo Modelos de Processadores.';


--
-- TOC entry 243 (class 1259 OID 18451)
-- Name: tb_proc_modelo_idtb_proc_modelo_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_proc_modelo_idtb_proc_modelo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3782 (class 0 OID 0)
-- Dependencies: 243
-- Name: tb_proc_modelo_idtb_proc_modelo_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_proc_modelo_idtb_proc_modelo_seq OWNED BY tb_proc_modelo.idtb_proc_modelo;


--
-- TOC entry 244 (class 1259 OID 18453)
-- Name: tb_qualificacao_clti; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_qualificacao_clti (
    idtb_qualificacao_clti integer NOT NULL,
    nome_curso character varying(255) NOT NULL,
    instituicao character varying(255) NOT NULL,
    data_conclusao date,
    carga_horaria integer NOT NULL,
    tipo character varying(255) NOT NULL,
    custo money,
    meio character varying(255) NOT NULL,
    situacao character varying(45) NOT NULL,
    idtb_lotacao_clti integer NOT NULL
);


--
-- TOC entry 3783 (class 0 OID 0)
-- Dependencies: 244
-- Name: TABLE tb_qualificacao_clti; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_qualificacao_clti IS 'Tabela contendo Qualificação do Pessoal do CLTI.';


--
-- TOC entry 245 (class 1259 OID 18459)
-- Name: tb_qualificacao_clti_idtb_qualificacao_clti_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_qualificacao_clti_idtb_qualificacao_clti_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3785 (class 0 OID 0)
-- Dependencies: 245
-- Name: tb_qualificacao_clti_idtb_qualificacao_clti_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_qualificacao_clti_idtb_qualificacao_clti_seq OWNED BY tb_qualificacao_clti.idtb_qualificacao_clti;


--
-- TOC entry 246 (class 1259 OID 18461)
-- Name: tb_qualificacao_ti; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_qualificacao_ti (
    idtb_qualificacao_ti integer NOT NULL,
    nome_curso character varying(255) NOT NULL,
    instituicao character varying(255) NOT NULL,
    data_conclusao date,
    carga_horaria integer NOT NULL,
    tipo character varying(255) NOT NULL,
    custo money,
    meio character varying(255) NOT NULL,
    situacao character varying(45) NOT NULL,
    idtb_pessoal_ti integer NOT NULL
);


--
-- TOC entry 3786 (class 0 OID 0)
-- Dependencies: 246
-- Name: TABLE tb_qualificacao_ti; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_qualificacao_ti IS 'Tabela contendo Qualificação do Pessoal de TI das OM.';


--
-- TOC entry 247 (class 1259 OID 18467)
-- Name: tb_qualificacao_ti_idtb_qualificacao_ti_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_qualificacao_ti_idtb_qualificacao_ti_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3788 (class 0 OID 0)
-- Dependencies: 247
-- Name: tb_qualificacao_ti_idtb_qualificacao_ti_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_qualificacao_ti_idtb_qualificacao_ti_seq OWNED BY tb_qualificacao_ti.idtb_qualificacao_ti;


--
-- TOC entry 290 (class 1259 OID 19166)
-- Name: tb_range_ip; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_range_ip (
    idtb_range_ip integer NOT NULL,
    idtb_om_apoiadas integer NOT NULL,
    sub_rede character varying(15) NOT NULL,
    mascara integer NOT NULL
);


--
-- TOC entry 3789 (class 0 OID 0)
-- Dependencies: 290
-- Name: TABLE tb_range_ip; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_range_ip IS 'Faixas de IP das OM Apoiadas';


--
-- TOC entry 289 (class 1259 OID 19164)
-- Name: tb_range_ip_idtb_range_ip_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_range_ip_idtb_range_ip_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3790 (class 0 OID 0)
-- Dependencies: 289
-- Name: tb_range_ip_idtb_range_ip_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_range_ip_idtb_range_ip_seq OWNED BY tb_range_ip.idtb_range_ip;


--
-- TOC entry 248 (class 1259 OID 18469)
-- Name: tb_registro_log; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_registro_log (
    idtb_registro_log integer NOT NULL,
    data_acao date NOT NULL,
    acao character varying(255) NOT NULL,
    nip_cps_resp integer NOT NULL
);


--
-- TOC entry 3791 (class 0 OID 0)
-- Dependencies: 248
-- Name: TABLE tb_registro_log; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_registro_log IS 'Tabela contendo Registros de LOG.';


--
-- TOC entry 249 (class 1259 OID 18472)
-- Name: tb_registro_log_idtb_registro_log_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_registro_log_idtb_registro_log_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3793 (class 0 OID 0)
-- Dependencies: 249
-- Name: tb_registro_log_idtb_registro_log_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_registro_log_idtb_registro_log_seq OWNED BY tb_registro_log.idtb_registro_log;


--
-- TOC entry 250 (class 1259 OID 18474)
-- Name: tb_rel_servico; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_rel_servico (
    idtb_rel_servico integer NOT NULL,
    sup_sai_servico integer NOT NULL,
    sup_entra_servico integer NOT NULL,
    num_rel integer NOT NULL,
    data_entra_servico date NOT NULL,
    data_sai_servico date NOT NULL,
    cel_funcional character varying(255),
    sit_servidores character varying(255),
    sit_backup character varying(255),
    status character varying(255)
);


--
-- TOC entry 3794 (class 0 OID 0)
-- Dependencies: 250
-- Name: TABLE tb_rel_servico; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_rel_servico IS 'Tabela contendo Relatórios de Serviço do CLTI';


--
-- TOC entry 251 (class 1259 OID 18480)
-- Name: tb_rel_servico_idtb_rel_servico_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_rel_servico_idtb_rel_servico_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3795 (class 0 OID 0)
-- Dependencies: 251
-- Name: tb_rel_servico_idtb_rel_servico_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_rel_servico_idtb_rel_servico_seq OWNED BY tb_rel_servico.idtb_rel_servico;


--
-- TOC entry 252 (class 1259 OID 18482)
-- Name: tb_rel_servico_log; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_rel_servico_log (
    idtb_rel_servico_log integer NOT NULL,
    idtb_lotacao_clti integer NOT NULL,
    num_rel integer NOT NULL,
    cod_aut character varying(256) NOT NULL,
    data_hora timestamp without time zone NOT NULL
);


--
-- TOC entry 3796 (class 0 OID 0)
-- Dependencies: 252
-- Name: TABLE tb_rel_servico_log; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_rel_servico_log IS 'Tabela contendo Log de Aprovação do Relatório de Serviço';


--
-- TOC entry 253 (class 1259 OID 18485)
-- Name: tb_rel_servico_log_idtb_rel_servico_log_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_rel_servico_log_idtb_rel_servico_log_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3797 (class 0 OID 0)
-- Dependencies: 253
-- Name: tb_rel_servico_log_idtb_rel_servico_log_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_rel_servico_log_idtb_rel_servico_log_seq OWNED BY tb_rel_servico_log.idtb_rel_servico_log;


--
-- TOC entry 254 (class 1259 OID 18487)
-- Name: tb_rel_servico_ocorrencias; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_rel_servico_ocorrencias (
    idtb_rel_servico_ocorrencias integer NOT NULL,
    num_rel integer NOT NULL,
    ocorrencia text NOT NULL,
    status character varying(255)
);


--
-- TOC entry 3798 (class 0 OID 0)
-- Dependencies: 254
-- Name: TABLE tb_rel_servico_ocorrencias; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_rel_servico_ocorrencias IS 'Tabela contendo Ocorrências do Serviço do CLTI';


--
-- TOC entry 255 (class 1259 OID 18493)
-- Name: tb_rel_servico_ocorrencias_idtb_rel_servico_ocorrencias_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_rel_servico_ocorrencias_idtb_rel_servico_ocorrencias_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3799 (class 0 OID 0)
-- Dependencies: 255
-- Name: tb_rel_servico_ocorrencias_idtb_rel_servico_ocorrencias_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_rel_servico_ocorrencias_idtb_rel_servico_ocorrencias_seq OWNED BY tb_rel_servico_ocorrencias.idtb_rel_servico_ocorrencias;


--
-- TOC entry 256 (class 1259 OID 18495)
-- Name: tb_rel_sv_v2; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_rel_sv_v2 (
    idtb_rel_servico integer NOT NULL,
    sup_sai_servico integer NOT NULL,
    sup_entra_servico integer NOT NULL,
    num_rel integer NOT NULL,
    data_entra_servico date NOT NULL,
    data_sai_servico date NOT NULL,
    cel_funcional character varying(255),
    sit_servidores character varying(255),
    sit_backup character varying(255),
    status character varying(255)
);


--
-- TOC entry 3800 (class 0 OID 0)
-- Dependencies: 256
-- Name: TABLE tb_rel_sv_v2; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_rel_sv_v2 IS 'Tabela contendo Relatórios de Serviço do CLTI Versão 2';


--
-- TOC entry 257 (class 1259 OID 18501)
-- Name: tb_rel_sv_v2_idtb_rel_servico_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_rel_sv_v2_idtb_rel_servico_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3801 (class 0 OID 0)
-- Dependencies: 257
-- Name: tb_rel_sv_v2_idtb_rel_servico_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_rel_sv_v2_idtb_rel_servico_seq OWNED BY tb_rel_sv_v2.idtb_rel_servico;


--
-- TOC entry 258 (class 1259 OID 18503)
-- Name: tb_rel_sv_v2_ocorrencias; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_rel_sv_v2_ocorrencias (
    idtb_rel_servico_ocorrencias integer NOT NULL,
    num_rel integer NOT NULL,
    ocorrencia text NOT NULL
);


--
-- TOC entry 3802 (class 0 OID 0)
-- Dependencies: 258
-- Name: TABLE tb_rel_sv_v2_ocorrencias; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_rel_sv_v2_ocorrencias IS 'Tabela contendo Ocorrências do Serviço do CLTI';


--
-- TOC entry 259 (class 1259 OID 18509)
-- Name: tb_rel_sv_v2_ocorrencias_idtb_rel_servico_ocorrencias_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_rel_sv_v2_ocorrencias_idtb_rel_servico_ocorrencias_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3803 (class 0 OID 0)
-- Dependencies: 259
-- Name: tb_rel_sv_v2_ocorrencias_idtb_rel_servico_ocorrencias_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_rel_sv_v2_ocorrencias_idtb_rel_servico_ocorrencias_seq OWNED BY tb_rel_sv_v2_ocorrencias.idtb_rel_servico_ocorrencias;


--
-- TOC entry 260 (class 1259 OID 18511)
-- Name: tb_servidores; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_servidores (
    idtb_servidores integer NOT NULL,
    idtb_om_apoiadas integer NOT NULL,
    fabricante character varying(255) NOT NULL,
    modelo character varying(255) NOT NULL,
    idtb_proc_modelo integer NOT NULL,
    clock_proc real NOT NULL,
    qtde_proc integer NOT NULL,
    memoria integer,
    armazenamento integer,
    end_ip character varying(255),
    end_mac character varying(255),
    idtb_sor integer NOT NULL,
    finalidade character varying(255) NOT NULL,
    data_aquisicao date,
    data_garantia date,
    status character varying(255) NOT NULL,
    idtb_om_setores integer,
    nome character varying(50)
);


--
-- TOC entry 3804 (class 0 OID 0)
-- Dependencies: 260
-- Name: TABLE tb_servidores; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_servidores IS 'Tabela contendo Servidores.';


--
-- TOC entry 296 (class 1259 OID 19236)
-- Name: tb_servidores_excluidos; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_servidores_excluidos (
    idtb_servidores_excluidos integer NOT NULL,
    idtb_om_apoiadas integer NOT NULL,
    fabricante character varying(255) NOT NULL,
    modelo character varying(255) NOT NULL,
    end_ip character varying(255),
    end_mac character varying(255),
    data_del date,
    hora_del time without time zone
);


--
-- TOC entry 3806 (class 0 OID 0)
-- Dependencies: 296
-- Name: TABLE tb_servidores_excluidos; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_servidores_excluidos IS 'Servidores excluídos';


--
-- TOC entry 295 (class 1259 OID 19234)
-- Name: tb_servidores_excluidos_idtb_servidores_excluidos_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_servidores_excluidos_idtb_servidores_excluidos_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3807 (class 0 OID 0)
-- Dependencies: 295
-- Name: tb_servidores_excluidos_idtb_servidores_excluidos_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_servidores_excluidos_idtb_servidores_excluidos_seq OWNED BY tb_servidores_excluidos.idtb_servidores_excluidos;


--
-- TOC entry 261 (class 1259 OID 18517)
-- Name: tb_servidores_idtb_servidores_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_servidores_idtb_servidores_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3808 (class 0 OID 0)
-- Dependencies: 261
-- Name: tb_servidores_idtb_servidores_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_servidores_idtb_servidores_seq OWNED BY tb_servidores.idtb_servidores;


--
-- TOC entry 262 (class 1259 OID 18519)
-- Name: tb_soft_padronizados; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_soft_padronizados (
    idtb_soft_padronizados integer NOT NULL,
    categoria character varying(255) NOT NULL,
    software character varying(255) NOT NULL,
    status character varying(255) NOT NULL
);


--
-- TOC entry 3809 (class 0 OID 0)
-- Dependencies: 262
-- Name: TABLE tb_soft_padronizados; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_soft_padronizados IS 'Tabela contendo Softwares Padronizados';


--
-- TOC entry 263 (class 1259 OID 18525)
-- Name: tb_soft_padronizados_idtb_soft_padronizados_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_soft_padronizados_idtb_soft_padronizados_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3810 (class 0 OID 0)
-- Dependencies: 263
-- Name: tb_soft_padronizados_idtb_soft_padronizados_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_soft_padronizados_idtb_soft_padronizados_seq OWNED BY tb_soft_padronizados.idtb_soft_padronizados;


--
-- TOC entry 264 (class 1259 OID 18527)
-- Name: tb_sor; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_sor (
    idtb_sor integer NOT NULL,
    desenvolvedor character varying(512) NOT NULL,
    descricao character varying(255) NOT NULL,
    versao character varying(45) NOT NULL,
    situacao character varying(45) NOT NULL
);


--
-- TOC entry 3811 (class 0 OID 0)
-- Dependencies: 264
-- Name: TABLE tb_sor; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_sor IS 'Tabela contendo Sisteamas Operacionais.';


--
-- TOC entry 265 (class 1259 OID 18533)
-- Name: tb_sor_idtb_sor_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_sor_idtb_sor_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3813 (class 0 OID 0)
-- Dependencies: 265
-- Name: tb_sor_idtb_sor_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_sor_idtb_sor_seq OWNED BY tb_sor.idtb_sor;


--
-- TOC entry 266 (class 1259 OID 18535)
-- Name: tb_temas_pad_sic_tic; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_temas_pad_sic_tic (
    idtb_temas_pad_sic_tic integer NOT NULL,
    idtb_pad_sic_tic integer NOT NULL,
    tema character varying NOT NULL,
    status character varying NOT NULL,
    justificativa character varying,
    data_ade date
);


--
-- TOC entry 267 (class 1259 OID 18541)
-- Name: tb_temas_pad_sic_tic_idtb_temas_pad_sic_tic_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_temas_pad_sic_tic_idtb_temas_pad_sic_tic_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3814 (class 0 OID 0)
-- Dependencies: 267
-- Name: tb_temas_pad_sic_tic_idtb_temas_pad_sic_tic_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_temas_pad_sic_tic_idtb_temas_pad_sic_tic_seq OWNED BY tb_temas_pad_sic_tic.idtb_temas_pad_sic_tic;


--
-- TOC entry 268 (class 1259 OID 18543)
-- Name: tb_tipos_clti; Type: TABLE; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE TABLE tb_tipos_clti (
    idtb_tipos_clti integer NOT NULL,
    norma_atual character varying(45) NOT NULL,
    data_norma date NOT NULL,
    lotacao_oficiais smallint NOT NULL,
    lotacao_pracas smallint NOT NULL,
    tipo_clti character varying(45) NOT NULL
);


--
-- TOC entry 3815 (class 0 OID 0)
-- Dependencies: 268
-- Name: TABLE tb_tipos_clti; Type: COMMENT; Schema: db_clti; Owner: -
--

COMMENT ON TABLE tb_tipos_clti IS 'Tabela contendo Tipo do CLTI.';


--
-- TOC entry 269 (class 1259 OID 18546)
-- Name: tb_tipos_clti_idtb_tipos_clti_seq; Type: SEQUENCE; Schema: db_clti; Owner: -
--

CREATE SEQUENCE tb_tipos_clti_idtb_tipos_clti_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3817 (class 0 OID 0)
-- Dependencies: 269
-- Name: tb_tipos_clti_idtb_tipos_clti_seq; Type: SEQUENCE OWNED BY; Schema: db_clti; Owner: -
--

ALTER SEQUENCE tb_tipos_clti_idtb_tipos_clti_seq OWNED BY tb_tipos_clti.idtb_tipos_clti;


--
-- TOC entry 270 (class 1259 OID 18548)
-- Name: vw_conectividade; Type: VIEW; Schema: db_clti; Owner: -
--

CREATE VIEW vw_conectividade AS
    SELECT conec.idtb_conectividade, conec.idtb_om_apoiadas, conec.fabricante, conec.modelo, conec.nome, conec.qtde_portas, conec.idtb_om_setores, conec.end_ip, conec.data_aquisicao, conec.data_garantia, conec.status, om.sigla, setores.sigla_setor, setores.compartimento FROM tb_conectividade conec, tb_om_setores setores, tb_om_apoiadas om WHERE ((conec.idtb_om_apoiadas = om.idtb_om_apoiadas) AND (conec.idtb_om_setores = setores.idtb_om_setores));


--
-- TOC entry 271 (class 1259 OID 18552)
-- Name: vw_pessoal_om; Type: VIEW; Schema: db_clti; Owner: -
--

CREATE VIEW vw_pessoal_om AS
    SELECT pesom.idtb_pessoal_om, pesom.idtb_posto_grad, posto.sigla AS posto_grad, pesom.idtb_corpo_quadro, corpo.sigla AS corpo_quadro, corpo.exibir AS exibir_corpo_quadro, pesom.idtb_especialidade, espec.sigla AS espec, espec.exibir AS exibir_espec, pesom.idtb_om_apoiadas, om.sigla AS sigla_om, pesom.nip, pesom.cpf, pesom.nome, pesom.nome_guerra, pesom.correio_eletronico, pesom.foradaareati, pesom.status FROM tb_pessoal_om pesom, tb_posto_grad posto, tb_corpo_quadro corpo, tb_especialidade espec, tb_om_apoiadas om WHERE ((((pesom.idtb_posto_grad = posto.idtb_posto_grad) AND (pesom.idtb_corpo_quadro = corpo.idtb_corpo_quadro)) AND (pesom.idtb_especialidade = espec.idtb_especialidade)) AND (pesom.idtb_om_apoiadas = om.idtb_om_apoiadas));


--
-- TOC entry 272 (class 1259 OID 18557)
-- Name: vw_controle_internet; Type: VIEW; Schema: db_clti; Owner: -
--

CREATE VIEW vw_controle_internet AS
    SELECT internet.idtb_controle_internet, internet.idtb_om_apoiadas, om.sigla, internet.idtb_pessoal_om, pesom.posto_grad, pesom.corpo_quadro, pesom.exibir_corpo_quadro, pesom.espec, pesom.exibir_espec, pesom.nip, pesom.nome, pesom.nome_guerra, internet.perfis FROM tb_controle_internet internet, vw_pessoal_om pesom, tb_om_apoiadas om WHERE ((internet.idtb_pessoal_om = pesom.idtb_pessoal_om) AND (internet.idtb_om_apoiadas = om.idtb_om_apoiadas));


--
-- TOC entry 273 (class 1259 OID 18561)
-- Name: vw_controle_usb; Type: VIEW; Schema: db_clti; Owner: -
--

CREATE VIEW vw_controle_usb AS
    SELECT usb.idtb_controle_usb, usb.idtb_om_apoiadas, om.sigla, usb.idtb_estacoes, et.nome, usb.autorizacao FROM tb_controle_usb usb, tb_estacoes et, tb_om_apoiadas om WHERE ((usb.idtb_estacoes = et.idtb_estacoes) AND (usb.idtb_om_apoiadas = om.idtb_om_apoiadas));


--
-- TOC entry 274 (class 1259 OID 18565)
-- Name: vw_estacoes; Type: VIEW; Schema: db_clti; Owner: -
--

CREATE VIEW vw_estacoes AS
    SELECT et.idtb_estacoes, et.idtb_om_apoiadas, et.idtb_proc_modelo, et.clock_proc, et.fabricante, et.modelo, et.nome, et.idtb_memorias, et.memoria, mem.tipo AS tipo_mem, mem.modelo AS modelo_mem, mem.clock AS clock_mem, et.armazenamento, et.idtb_sor, et.end_ip, et.end_mac, et.data_aquisicao, et.data_garantia, et.idtb_om_setores, setores.sigla_setor, setores.compartimento, et.req_minimos, et.status, om.sigla, fab.idtb_proc_fab, fab.nome AS proc_fab, modelo.modelo AS proc_modelo, sor.descricao, sor.versao, sor.situacao FROM tb_estacoes et, tb_proc_fab fab, tb_proc_modelo modelo, tb_om_apoiadas om, tb_sor sor, tb_om_setores setores, tb_memorias mem WHERE ((((((et.idtb_proc_modelo = modelo.idtb_proc_modelo) AND (et.idtb_om_apoiadas = om.idtb_om_apoiadas)) AND (et.idtb_sor = sor.idtb_sor)) AND (modelo.idtb_proc_fab = fab.idtb_proc_fab)) AND (et.idtb_memorias = mem.idtb_memorias)) AND (et.idtb_om_setores = setores.idtb_om_setores));


--
-- TOC entry 275 (class 1259 OID 18570)
-- Name: vw_funcoes_sigdem; Type: VIEW; Schema: db_clti; Owner: -
--

CREATE VIEW vw_funcoes_sigdem AS
    SELECT funcsigdem.idtb_funcoes_sigdem, funcsigdem.idtb_om_apoiadas, om.sigla AS sigla_om, funcsigdem.descricao, funcsigdem.sigla, funcsigdem.idtb_pessoal_om, posto_grad.sigla AS posto_grad, corpo_quadro.sigla AS corpo_quadro, corpo_quadro.exibir AS exibir_corpo_quadro, espec.sigla AS espec, espec.exibir AS exibir_espec, pesom.nome_guerra FROM tb_funcoes_sigdem funcsigdem, tb_pessoal_om pesom, tb_posto_grad posto_grad, tb_corpo_quadro corpo_quadro, tb_especialidade espec, tb_om_apoiadas om WHERE (((((funcsigdem.idtb_om_apoiadas = om.idtb_om_apoiadas) AND (funcsigdem.idtb_pessoal_om = pesom.idtb_pessoal_om)) AND (pesom.idtb_posto_grad = posto_grad.idtb_posto_grad)) AND (pesom.idtb_corpo_quadro = corpo_quadro.idtb_corpo_quadro)) AND (pesom.idtb_especialidade = espec.idtb_especialidade));


--
-- TOC entry 276 (class 1259 OID 18574)
-- Name: vw_mapainfra; Type: VIEW; Schema: db_clti; Owner: -
--

CREATE VIEW vw_mapainfra AS
    SELECT mapa.idtb_mapainfra, mapa.idtb_conectividade_orig, conec.fabricante AS fab_orig, conec.modelo AS modelo_orig, conec.nome AS nome_orig, mapa.idtb_conectividade_dest, mapa.idtb_servidores_dest, mapa.idtb_estacoes_dest, mapa.porta_orig, mapa.porta_dest, mapa.idtb_om_apoiadas, om.sigla FROM tb_mapainfra mapa, tb_conectividade conec, tb_om_apoiadas om WHERE ((mapa.idtb_conectividade_orig = conec.idtb_conectividade) AND (mapa.idtb_om_apoiadas = om.idtb_om_apoiadas));


--
-- TOC entry 277 (class 1259 OID 18578)
-- Name: vw_nao_padronizados; Type: VIEW; Schema: db_clti; Owner: -
--

CREATE VIEW vw_nao_padronizados AS
    SELECT naopad.idtb_nao_padronizados, naopad.idtb_om_apoiadas, om.sigla, naopad.idtb_estacoes, et.nome, naopad.autorizacao, naopad.soft_autorizados FROM tb_nao_padronizados naopad, tb_estacoes et, tb_om_apoiadas om WHERE ((naopad.idtb_estacoes = et.idtb_estacoes) AND (naopad.idtb_om_apoiadas = om.idtb_om_apoiadas));


--
-- TOC entry 278 (class 1259 OID 18582)
-- Name: vw_osic; Type: VIEW; Schema: db_clti; Owner: -
--

CREATE VIEW vw_osic AS
    SELECT osic.idtb_osic, osic.idtb_posto_grad, posto.sigla AS sigla_posto_grad, osic.idtb_corpo_quadro, corpo.sigla AS sigla_corpo_quadro, corpo.exibir AS exibir_corpo_quadro, osic.idtb_especialidade, espec.sigla AS sigla_espec, espec.exibir AS exibir_espec, osic.idtb_om_apoiadas, om.sigla AS sigla_om, osic.nip, osic.cpf, osic.nome, osic.nome_guerra, osic.correio_eletronico, osic.perfil, osic.status FROM tb_osic osic, tb_posto_grad posto, tb_corpo_quadro corpo, tb_especialidade espec, tb_om_apoiadas om WHERE ((((osic.idtb_posto_grad = posto.idtb_posto_grad) AND (osic.idtb_corpo_quadro = corpo.idtb_corpo_quadro)) AND (osic.idtb_especialidade = espec.idtb_especialidade)) AND (osic.idtb_om_apoiadas = om.idtb_om_apoiadas));


--
-- TOC entry 279 (class 1259 OID 18587)
-- Name: vw_permissoes_admin; Type: VIEW; Schema: db_clti; Owner: -
--

CREATE VIEW vw_permissoes_admin AS
    SELECT adm.idtb_permissoes_admin, adm.idtb_om_apoiadas, om.sigla, adm.idtb_estacoes, et.nome, adm.autorizacao FROM tb_permissoes_admin adm, tb_estacoes et, tb_om_apoiadas om WHERE ((adm.idtb_estacoes = et.idtb_estacoes) AND (adm.idtb_om_apoiadas = om.idtb_om_apoiadas));


--
-- TOC entry 280 (class 1259 OID 18591)
-- Name: vw_pessoal_clti; Type: VIEW; Schema: db_clti; Owner: -
--

CREATE VIEW vw_pessoal_clti AS
    SELECT clti.idtb_lotacao_clti, clti.idtb_posto_grad, posto.sigla AS sigla_posto_grad, clti.idtb_corpo_quadro, corpo.sigla AS sigla_corpo_quadro, corpo.exibir AS exibir_corpo_quadro, clti.idtb_especialidade, espec.sigla AS sigla_espec, espec.exibir AS exibir_espec, clti.nip, clti.cpf, clti.nome, clti.nome_guerra, clti.correio_eletronico, clti.perfil, clti.tarefa, clti.status FROM tb_lotacao_clti clti, tb_posto_grad posto, tb_corpo_quadro corpo, tb_especialidade espec WHERE (((clti.idtb_posto_grad = posto.idtb_posto_grad) AND (clti.idtb_corpo_quadro = corpo.idtb_corpo_quadro)) AND (clti.idtb_especialidade = espec.idtb_especialidade));


--
-- TOC entry 281 (class 1259 OID 18595)
-- Name: vw_pessoal_ti; Type: VIEW; Schema: db_clti; Owner: -
--

CREATE VIEW vw_pessoal_ti AS
    SELECT pesti.idtb_pessoal_ti, pesti.idtb_posto_grad, posto.sigla AS sigla_posto_grad, pesti.idtb_corpo_quadro, corpo.sigla AS sigla_corpo_quadro, corpo.exibir AS exibir_corpo_quadro, pesti.idtb_especialidade, espec.sigla AS sigla_espec, espec.exibir AS exibir_espec, pesti.idtb_om_apoiadas, om.sigla AS sigla_om, pesti.nip, pesti.cpf, pesti.nome, pesti.nome_guerra, pesti.correio_eletronico, pesti.idtb_funcoes_ti, funcao.descricao AS desc_funcao, funcao.sigla AS sigla_funcao, pesti.status FROM tb_pessoal_ti pesti, tb_posto_grad posto, tb_corpo_quadro corpo, tb_especialidade espec, tb_om_apoiadas om, tb_funcoes_ti funcao WHERE (((((pesti.idtb_posto_grad = posto.idtb_posto_grad) AND (pesti.idtb_corpo_quadro = corpo.idtb_corpo_quadro)) AND (pesti.idtb_especialidade = espec.idtb_especialidade)) AND (pesti.idtb_om_apoiadas = om.idtb_om_apoiadas)) AND (pesti.idtb_funcoes_ti = funcao.idtb_funcoes_ti));


--
-- TOC entry 282 (class 1259 OID 18600)
-- Name: vw_processadores; Type: VIEW; Schema: db_clti; Owner: -
--

CREATE VIEW vw_processadores AS
    SELECT fab.idtb_proc_fab, fab.nome AS fabricante, modelo.idtb_proc_modelo, modelo.modelo FROM tb_proc_fab fab, tb_proc_modelo modelo WHERE (modelo.idtb_proc_fab = fab.idtb_proc_fab);


--
-- TOC entry 283 (class 1259 OID 18604)
-- Name: vw_qualificacao_clti; Type: VIEW; Schema: db_clti; Owner: -
--

CREATE VIEW vw_qualificacao_clti AS
    SELECT quali.idtb_qualificacao_clti, quali.idtb_lotacao_clti, pesti.idtb_posto_grad, posto.sigla AS sigla_posto_grad, pesti.idtb_corpo_quadro, corpo.sigla AS sigla_corpo_quadro, corpo.exibir AS exibir_corpo_quadro, pesti.idtb_especialidade, espec.sigla AS sigla_espec, espec.exibir AS exibir_espec, pesti.nome_guerra, pesti.nip, pesti.cpf, quali.instituicao, quali.tipo, quali.nome_curso, quali.meio, quali.situacao, quali.data_conclusao, quali.carga_horaria, quali.custo FROM tb_qualificacao_clti quali, tb_lotacao_clti pesti, tb_posto_grad posto, tb_corpo_quadro corpo, tb_especialidade espec WHERE (((((quali.idtb_lotacao_clti = pesti.idtb_lotacao_clti) AND (pesti.idtb_posto_grad = posto.idtb_posto_grad)) AND (pesti.idtb_corpo_quadro = corpo.idtb_corpo_quadro)) AND (pesti.idtb_especialidade = espec.idtb_especialidade)) AND ((pesti.status)::text = 'ATIVO'::text));


--
-- TOC entry 284 (class 1259 OID 18609)
-- Name: vw_qualificacao_pesti; Type: VIEW; Schema: db_clti; Owner: -
--

CREATE VIEW vw_qualificacao_pesti AS
    SELECT quali.idtb_qualificacao_ti, quali.idtb_pessoal_ti, pesti.idtb_posto_grad, posto.sigla AS sigla_posto_grad, pesti.idtb_corpo_quadro, corpo.sigla AS sigla_corpo_quadro, corpo.exibir AS exibir_corpo_quadro, pesti.idtb_especialidade, espec.sigla AS sigla_espec, espec.exibir AS exibir_espec, pesti.idtb_om_apoiadas, om.sigla AS sigla_om, pesti.nome_guerra, pesti.nip, pesti.cpf, quali.instituicao, quali.tipo, quali.nome_curso, quali.meio, quali.situacao, quali.data_conclusao, quali.carga_horaria, quali.custo FROM tb_qualificacao_ti quali, tb_pessoal_ti pesti, tb_posto_grad posto, tb_corpo_quadro corpo, tb_especialidade espec, tb_om_apoiadas om WHERE ((((((quali.idtb_pessoal_ti = pesti.idtb_pessoal_ti) AND (pesti.idtb_posto_grad = posto.idtb_posto_grad)) AND (pesti.idtb_corpo_quadro = corpo.idtb_corpo_quadro)) AND (pesti.idtb_especialidade = espec.idtb_especialidade)) AND (pesti.idtb_om_apoiadas = om.idtb_om_apoiadas)) AND ((pesti.status)::text = 'ATIVO'::text));


--
-- TOC entry 285 (class 1259 OID 18614)
-- Name: vw_servidores; Type: VIEW; Schema: db_clti; Owner: -
--

CREATE VIEW vw_servidores AS
    SELECT srv.idtb_servidores, srv.idtb_om_apoiadas, srv.fabricante, srv.modelo, srv.nome, srv.idtb_proc_modelo, srv.clock_proc, srv.qtde_proc, srv.memoria, srv.armazenamento, srv.end_ip, srv.end_mac, srv.idtb_sor, srv.finalidade, srv.data_aquisicao, srv.data_garantia, srv.idtb_om_setores, srv.status, om.sigla, fab.idtb_proc_fab, fab.nome AS proc_fab, modelo.modelo AS proc_modelo, sor.descricao, sor.versao, sor.situacao, setores.sigla_setor, setores.compartimento FROM tb_servidores srv, tb_proc_fab fab, tb_proc_modelo modelo, tb_om_apoiadas om, tb_om_setores setores, tb_sor sor WHERE (((((srv.idtb_proc_modelo = modelo.idtb_proc_modelo) AND (srv.idtb_om_apoiadas = om.idtb_om_apoiadas)) AND (srv.idtb_sor = sor.idtb_sor)) AND (modelo.idtb_proc_fab = fab.idtb_proc_fab)) AND (srv.idtb_om_setores = setores.idtb_om_setores));


--
-- TOC entry 286 (class 1259 OID 18619)
-- Name: vw_setores; Type: VIEW; Schema: db_clti; Owner: -
--

CREATE VIEW vw_setores AS
    SELECT setores.idtb_om_setores, setores.idtb_om_apoiadas, setores.nome_setor, setores.sigla_setor, setores.cod_funcional, setores.compartimento, om.sigla AS sigla_om, om.indicativo AS indicativo_om FROM tb_om_setores setores, tb_om_apoiadas om WHERE (setores.idtb_om_apoiadas = om.idtb_om_apoiadas);


--
-- TOC entry 3223 (class 2604 OID 19161)
-- Name: idtb_acesso_suspeito; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_acesso_suspeito ALTER COLUMN idtb_acesso_suspeito SET DEFAULT nextval('tb_acesso_suspeito_idtb_acesso_suspeito_seq'::regclass);


--
-- TOC entry 3164 (class 2604 OID 18623)
-- Name: idtb_ade_pad_sic_tic; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_ade_pad_sic_tic ALTER COLUMN idtb_ade_pad_sic_tic SET DEFAULT nextval('tb_ade_pad_sic_tic_idtb_ade_pad_sic_tic_seq'::regclass);


--
-- TOC entry 3165 (class 2604 OID 18624)
-- Name: id; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_cidade ALTER COLUMN id SET DEFAULT nextval('tb_cidade_id_seq'::regclass);


--
-- TOC entry 3166 (class 2604 OID 18625)
-- Name: idtb_clti; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_clti ALTER COLUMN idtb_clti SET DEFAULT nextval('tb_clti_idtb_clti_seq'::regclass);


--
-- TOC entry 3167 (class 2604 OID 18626)
-- Name: idtb_conectividade; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_conectividade ALTER COLUMN idtb_conectividade SET DEFAULT nextval('tb_conectividade_idtb_conectividade_seq'::regclass);


--
-- TOC entry 3226 (class 2604 OID 19228)
-- Name: idtb_conectividade_excluidos; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_conectividade_excluidos ALTER COLUMN idtb_conectividade_excluidos SET DEFAULT nextval('tb_conectividade_excluidos_idtb_conectividade_excluidos_seq'::regclass);


--
-- TOC entry 3168 (class 2604 OID 18627)
-- Name: idtb_config; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_config ALTER COLUMN idtb_config SET DEFAULT nextval('tb_config_idtb_config_seq'::regclass);


--
-- TOC entry 3169 (class 2604 OID 18628)
-- Name: idtb_controle_internet; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_controle_internet ALTER COLUMN idtb_controle_internet SET DEFAULT nextval('tb_controle_internet_idtb_controle_internet_seq'::regclass);


--
-- TOC entry 3170 (class 2604 OID 18629)
-- Name: idtb_controle_usb; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_controle_usb ALTER COLUMN idtb_controle_usb SET DEFAULT nextval('tb_controle_usb_idtb_controle_usb_seq'::regclass);


--
-- TOC entry 3171 (class 2604 OID 18630)
-- Name: idtb_corpo_quadro; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_corpo_quadro ALTER COLUMN idtb_corpo_quadro SET DEFAULT nextval('tb_corpo_quadro_idtb_corpo_quadro_seq'::regclass);


--
-- TOC entry 3172 (class 2604 OID 18631)
-- Name: idtb_det_serv; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_det_serv ALTER COLUMN idtb_det_serv SET DEFAULT nextval('tb_det_serv_idtb_det_serv_seq'::regclass);


--
-- TOC entry 3173 (class 2604 OID 18632)
-- Name: idtb_dias_troca; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_dias_troca ALTER COLUMN idtb_dias_troca SET DEFAULT nextval('tb_dias_troca_idtb_dias_troca_seq'::regclass);


--
-- TOC entry 3174 (class 2604 OID 18633)
-- Name: idtb_dias_troca_clti; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_dias_troca_clti ALTER COLUMN idtb_dias_troca_clti SET DEFAULT nextval('tb_dias_troca_clti_idtb_dias_troca_clti_seq'::regclass);


--
-- TOC entry 3175 (class 2604 OID 18634)
-- Name: idtb_especialidade; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_especialidade ALTER COLUMN idtb_especialidade SET DEFAULT nextval('tb_especialidade_idtb_especialidade_seq'::regclass);


--
-- TOC entry 3177 (class 2604 OID 18635)
-- Name: idtb_estacoes; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_estacoes ALTER COLUMN idtb_estacoes SET DEFAULT nextval('tb_estacoes_idtb_estacoes_seq'::regclass);


--
-- TOC entry 3225 (class 2604 OID 19217)
-- Name: idtb_estacoes_excluidas; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_estacoes_excluidas ALTER COLUMN idtb_estacoes_excluidas SET DEFAULT nextval('tb_estacoes_excluidas_idtb_estacoes_excluidas_seq'::regclass);


--
-- TOC entry 3178 (class 2604 OID 18636)
-- Name: id; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_estado ALTER COLUMN id SET DEFAULT nextval('tb_estado_id_seq'::regclass);


--
-- TOC entry 3179 (class 2604 OID 18637)
-- Name: idtb_funcoes_clti; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_funcoes_clti ALTER COLUMN idtb_funcoes_clti SET DEFAULT nextval('tb_funcoes_clti_idtb_funcoes_clti_seq'::regclass);


--
-- TOC entry 3180 (class 2604 OID 18638)
-- Name: idtb_funcoes_sigdem; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_funcoes_sigdem ALTER COLUMN idtb_funcoes_sigdem SET DEFAULT nextval('tb_funcoes_sigdem_idtb_funcoes_sigdem_seq'::regclass);


--
-- TOC entry 3181 (class 2604 OID 18639)
-- Name: idtb_funcoes_ti; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_funcoes_ti ALTER COLUMN idtb_funcoes_ti SET DEFAULT nextval('tb_funcoes_ti_idtb_funcoes_ti_seq'::regclass);


--
-- TOC entry 3182 (class 2604 OID 18640)
-- Name: idtb_gw_om; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_gw_om ALTER COLUMN idtb_gw_om SET DEFAULT nextval('tb_gw_om_idtb_gw_om_seq'::regclass);


--
-- TOC entry 3185 (class 2604 OID 18641)
-- Name: idtb_lotacao_clti; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_lotacao_clti ALTER COLUMN idtb_lotacao_clti SET DEFAULT nextval('tb_lotacao_clti_idtb_lotacao_clti_seq'::regclass);


--
-- TOC entry 3189 (class 2604 OID 18642)
-- Name: idtb_manutencao_et; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_manutencao_et ALTER COLUMN idtb_manutencao_et SET DEFAULT nextval('tb_manutencao_et_idtb_manutencao_et_seq'::regclass);


--
-- TOC entry 3190 (class 2604 OID 18643)
-- Name: idtb_mapainfra; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_mapainfra ALTER COLUMN idtb_mapainfra SET DEFAULT nextval('tb_mapainfra_idtb_mapainfra_seq'::regclass);


--
-- TOC entry 3191 (class 2604 OID 18644)
-- Name: idtb_memorias; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_memorias ALTER COLUMN idtb_memorias SET DEFAULT nextval('tb_memorias_idtb_memorias_seq'::regclass);


--
-- TOC entry 3192 (class 2604 OID 18645)
-- Name: idtb_nao_padronizados; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_nao_padronizados ALTER COLUMN idtb_nao_padronizados SET DEFAULT nextval('tb_nao_padronizados_idtb_nao_padronizados_seq'::regclass);


--
-- TOC entry 3193 (class 2604 OID 18646)
-- Name: idtb_nec_aquisicao; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_nec_aquisicao ALTER COLUMN idtb_nec_aquisicao SET DEFAULT nextval('tb_nec_aquisicao_idtb_nec_aquisicao_seq'::regclass);


--
-- TOC entry 3194 (class 2604 OID 18647)
-- Name: idtb_numerador; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_numerador ALTER COLUMN idtb_numerador SET DEFAULT nextval('tb_numerador_idtb_numerador_seq'::regclass);


--
-- TOC entry 3195 (class 2604 OID 18648)
-- Name: idtb_om_apoiadas; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_om_apoiadas ALTER COLUMN idtb_om_apoiadas SET DEFAULT nextval('tb_om_apoiadas_idtb_om_apoiadas_seq'::regclass);


--
-- TOC entry 3196 (class 2604 OID 18649)
-- Name: idtb_om_setores; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_om_setores ALTER COLUMN idtb_om_setores SET DEFAULT nextval('tb_om_setores_idtb_om_setores_seq'::regclass);


--
-- TOC entry 3197 (class 2604 OID 18650)
-- Name: idtb_osic; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_osic ALTER COLUMN idtb_osic SET DEFAULT nextval('tb_osic_idtb_osic_seq'::regclass);


--
-- TOC entry 3198 (class 2604 OID 18651)
-- Name: idtb_pad_sic_tic; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_pad_sic_tic ALTER COLUMN idtb_pad_sic_tic SET DEFAULT nextval('tb_pad_sic_tic_idtb_pad_sic_tic_seq'::regclass);


--
-- TOC entry 3199 (class 2604 OID 18652)
-- Name: id; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_pais ALTER COLUMN id SET DEFAULT nextval('tb_pais_id_seq'::regclass);


--
-- TOC entry 3200 (class 2604 OID 18653)
-- Name: idtb_perfil_internet; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_perfil_internet ALTER COLUMN idtb_perfil_internet SET DEFAULT nextval('tb_perfil_internet_idtb_perfil_internet_seq'::regclass);


--
-- TOC entry 3201 (class 2604 OID 18654)
-- Name: idtb_permissoes_admin; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_permissoes_admin ALTER COLUMN idtb_permissoes_admin SET DEFAULT nextval('tb_permissoes_admin_idtb_permissoes_admin_seq'::regclass);


--
-- TOC entry 3228 (class 2604 OID 19250)
-- Name: idtb_pessoal_excluido; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_pessoal_excluido ALTER COLUMN idtb_pessoal_excluido SET DEFAULT nextval('tb_pessoal_excluido_idtb_pessoal_excluido_seq'::regclass);


--
-- TOC entry 3202 (class 2604 OID 18655)
-- Name: idtb_pessoal_om; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_pessoal_om ALTER COLUMN idtb_pessoal_om SET DEFAULT nextval('tb_pessoal_om_idtb_pessoal_om_seq'::regclass);


--
-- TOC entry 3203 (class 2604 OID 18656)
-- Name: idtb_pessoal_ti; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_pessoal_ti ALTER COLUMN idtb_pessoal_ti SET DEFAULT nextval('tb_pessoal_ti_idtb_pessoal_ti_seq'::regclass);


--
-- TOC entry 3207 (class 2604 OID 18657)
-- Name: idtb_posto_grad; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_posto_grad ALTER COLUMN idtb_posto_grad SET DEFAULT nextval('tb_posto_grad_idtb_posto_grad_seq'::regclass);


--
-- TOC entry 3208 (class 2604 OID 18658)
-- Name: idtb_proc_fab; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_proc_fab ALTER COLUMN idtb_proc_fab SET DEFAULT nextval('tb_proc_fab_idtb_proc_fab_seq'::regclass);


--
-- TOC entry 3209 (class 2604 OID 18659)
-- Name: idtb_proc_modelo; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_proc_modelo ALTER COLUMN idtb_proc_modelo SET DEFAULT nextval('tb_proc_modelo_idtb_proc_modelo_seq'::regclass);


--
-- TOC entry 3210 (class 2604 OID 18660)
-- Name: idtb_qualificacao_clti; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_qualificacao_clti ALTER COLUMN idtb_qualificacao_clti SET DEFAULT nextval('tb_qualificacao_clti_idtb_qualificacao_clti_seq'::regclass);


--
-- TOC entry 3211 (class 2604 OID 18661)
-- Name: idtb_qualificacao_ti; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_qualificacao_ti ALTER COLUMN idtb_qualificacao_ti SET DEFAULT nextval('tb_qualificacao_ti_idtb_qualificacao_ti_seq'::regclass);


--
-- TOC entry 3224 (class 2604 OID 19169)
-- Name: idtb_range_ip; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_range_ip ALTER COLUMN idtb_range_ip SET DEFAULT nextval('tb_range_ip_idtb_range_ip_seq'::regclass);


--
-- TOC entry 3212 (class 2604 OID 18662)
-- Name: idtb_registro_log; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_registro_log ALTER COLUMN idtb_registro_log SET DEFAULT nextval('tb_registro_log_idtb_registro_log_seq'::regclass);


--
-- TOC entry 3213 (class 2604 OID 18663)
-- Name: idtb_rel_servico; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_rel_servico ALTER COLUMN idtb_rel_servico SET DEFAULT nextval('tb_rel_servico_idtb_rel_servico_seq'::regclass);


--
-- TOC entry 3214 (class 2604 OID 18664)
-- Name: idtb_rel_servico_log; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_rel_servico_log ALTER COLUMN idtb_rel_servico_log SET DEFAULT nextval('tb_rel_servico_log_idtb_rel_servico_log_seq'::regclass);


--
-- TOC entry 3215 (class 2604 OID 18665)
-- Name: idtb_rel_servico_ocorrencias; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_rel_servico_ocorrencias ALTER COLUMN idtb_rel_servico_ocorrencias SET DEFAULT nextval('tb_rel_servico_ocorrencias_idtb_rel_servico_ocorrencias_seq'::regclass);


--
-- TOC entry 3216 (class 2604 OID 18666)
-- Name: idtb_rel_servico; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_rel_sv_v2 ALTER COLUMN idtb_rel_servico SET DEFAULT nextval('tb_rel_sv_v2_idtb_rel_servico_seq'::regclass);


--
-- TOC entry 3217 (class 2604 OID 18667)
-- Name: idtb_rel_servico_ocorrencias; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_rel_sv_v2_ocorrencias ALTER COLUMN idtb_rel_servico_ocorrencias SET DEFAULT nextval('tb_rel_sv_v2_ocorrencias_idtb_rel_servico_ocorrencias_seq'::regclass);


--
-- TOC entry 3218 (class 2604 OID 18668)
-- Name: idtb_servidores; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_servidores ALTER COLUMN idtb_servidores SET DEFAULT nextval('tb_servidores_idtb_servidores_seq'::regclass);


--
-- TOC entry 3227 (class 2604 OID 19239)
-- Name: idtb_servidores_excluidos; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_servidores_excluidos ALTER COLUMN idtb_servidores_excluidos SET DEFAULT nextval('tb_servidores_excluidos_idtb_servidores_excluidos_seq'::regclass);


--
-- TOC entry 3219 (class 2604 OID 18669)
-- Name: idtb_soft_padronizados; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_soft_padronizados ALTER COLUMN idtb_soft_padronizados SET DEFAULT nextval('tb_soft_padronizados_idtb_soft_padronizados_seq'::regclass);


--
-- TOC entry 3220 (class 2604 OID 18670)
-- Name: idtb_sor; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_sor ALTER COLUMN idtb_sor SET DEFAULT nextval('tb_sor_idtb_sor_seq'::regclass);


--
-- TOC entry 3221 (class 2604 OID 18671)
-- Name: idtb_temas_pad_sic_tic; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_temas_pad_sic_tic ALTER COLUMN idtb_temas_pad_sic_tic SET DEFAULT nextval('tb_temas_pad_sic_tic_idtb_temas_pad_sic_tic_seq'::regclass);


--
-- TOC entry 3222 (class 2604 OID 18672)
-- Name: idtb_tipos_clti; Type: DEFAULT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_tipos_clti ALTER COLUMN idtb_tipos_clti SET DEFAULT nextval('tb_tipos_clti_idtb_tipos_clti_seq'::regclass);


--
-- TOC entry 3657 (class 0 OID 19158)
-- Dependencies: 288
-- Data for Name: tb_acesso_suspeito; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_acesso_suspeito (idtb_acesso_suspeito, end_ip, data_acesso, hora_acesso, contador, status) FROM stdin;
3	172.23.119.61	2022-08-12	12:44:58	1	Acesso suspeito
2	172.23.119.150	2022-08-12	12:46:43	4	Acesso suspeito reincidente
1	172.23.119.13	2022-08-18	13:40:25	3	Acesso suspeito reincidente
4	172.23.119.139	2022-08-24	13:15:10	1	Acesso suspeito
\.


--
-- TOC entry 3826 (class 0 OID 0)
-- Dependencies: 287
-- Name: tb_acesso_suspeito_idtb_acesso_suspeito_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_acesso_suspeito_idtb_acesso_suspeito_seq', 4, true);


--
-- TOC entry 3556 (class 0 OID 18211)
-- Dependencies: 170
-- Data for Name: tb_ade_pad_sic_tic; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_ade_pad_sic_tic (idtb_ade_pad_sic_tic, idtb_temas_pad_sic_tic, idtb_pessoal_om) FROM stdin;
1	1	1
\.


--
-- TOC entry 3827 (class 0 OID 0)
-- Dependencies: 171
-- Name: tb_ade_pad_sic_tic_idtb_ade_pad_sic_tic_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_ade_pad_sic_tic_idtb_ade_pad_sic_tic_seq', 1, true);


--
-- TOC entry 3558 (class 0 OID 18216)
-- Dependencies: 172
-- Data for Name: tb_cidade; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_cidade (id, nome, estado) FROM stdin;
1	Afonso Cláudio	8
2	Água Doce do Norte	8
3	Águia Branca	8
4	Alegre	8
5	Alfredo Chaves	8
6	Alto Rio Novo	8
7	Anchieta	8
8	Apiacá	8
9	Aracruz	8
10	Atilio Vivacqua	8
11	Baixo Guandu	8
12	Barra de São Francisco	8
13	Boa Esperança	8
14	Bom Jesus do Norte	8
15	Brejetuba	8
16	Cachoeiro de Itapemirim	8
17	Cariacica	8
18	Castelo	8
19	Colatina	8
20	Conceição da Barra	8
21	Conceição do Castelo	8
22	Divino de São Lourenço	8
23	Domingos Martins	8
24	Dores do Rio Preto	8
25	Ecoporanga	8
26	Fundão	8
27	Governador Lindenberg	8
28	Guaçuí	8
29	Guarapari	8
30	Ibatiba	8
31	Ibiraçu	8
32	Ibitirama	8
33	Iconha	8
34	Irupi	8
35	Itaguaçu	8
36	Itapemirim	8
37	Itarana	8
38	Iúna	8
39	Jaguaré	8
40	Jerônimo Monteiro	8
41	João Neiva	8
42	Laranja da Terra	8
43	Linhares	8
44	Mantenópolis	8
45	Marataízes	8
46	Marechal Floriano	8
47	Marilândia	8
48	Mimoso do Sul	8
49	Montanha	8
50	Mucurici	8
51	Muniz Freire	8
52	Muqui	8
53	Nova Venécia	8
54	Pancas	8
55	Pedro Canário	8
56	Pinheiros	8
57	Piúma	8
58	Ponto Belo	8
59	Presidente Kennedy	8
60	Rio Bananal	8
61	Rio Novo do Sul	8
62	Santa Leopoldina	8
63	Santa Maria de Jetibá	8
64	Santa Teresa	8
65	São Domingos do Norte	8
66	São Gabriel da Palha	8
67	São José do Calçado	8
68	São Mateus	8
69	São Roque do Canaã	8
70	Serra	8
71	Sooretama	8
72	Vargem Alta	8
73	Venda Nova do Imigrante	8
74	Viana	8
75	Vila Pavão	8
76	Vila Valério	8
77	Vila Velha	8
78	Vitória	8
79	Acrelândia	1
80	Assis Brasil	1
81	Brasiléia	1
82	Bujari	1
83	Capixaba	1
84	Cruzeiro do Sul	1
85	Epitaciolândia	1
86	Feijó	1
87	Jordão	1
88	Mâncio Lima	1
89	Manoel Urbano	1
90	Marechal Thaumaturgo	1
91	Plácido de Castro	1
92	Porto Acre	1
93	Porto Walter	1
94	Rio Branco	1
95	Rodrigues Alves	1
96	Santa Rosa do Purus	1
97	Sena Madureira	1
98	Senador Guiomard	1
99	Tarauacá	1
100	Xapuri	1
101	Água Branca	2
102	Anadia	2
103	Arapiraca	2
104	Atalaia	2
105	Barra de Santo Antônio	2
106	Barra de São Miguel	2
107	Batalha	2
108	Belém	2
109	Belo Monte	2
110	Boca da Mata	2
111	Branquinha	2
112	Cacimbinhas	2
113	Cajueiro	2
114	Campestre	2
115	Campo Alegre	2
116	Campo Grande	2
117	Canapi	2
118	Capela	2
119	Carneiros	2
120	Chã Preta	2
121	Coité do Nóia	2
122	Colônia Leopoldina	2
123	Coqueiro Seco	2
124	Coruripe	2
125	Craíbas	2
126	Delmiro Gouveia	2
127	Dois Riachos	2
128	Estrela de Alagoas	2
129	Feira Grande	2
130	Feliz Deserto	2
131	Flexeiras	2
132	Girau do Ponciano	2
133	Ibateguara	2
134	Igaci	2
135	Igreja Nova	2
136	Inhapi	2
137	Jacaré dos Homens	2
138	Jacuípe	2
139	Japaratinga	2
140	Jaramataia	2
141	Jequiá da Praia	2
142	Joaquim Gomes	2
143	Jundiá	2
144	Junqueiro	2
145	Lagoa da Canoa	2
146	Limoeiro de Anadia	2
147	Maceió	2
148	Major Isidoro	2
149	Mar Vermelho	2
150	Maragogi	2
151	Maravilha	2
152	Marechal Deodoro	2
153	Maribondo	2
154	Mata Grande	2
155	Matriz de Camaragibe	2
156	Messias	2
157	Minador do Negrão	2
158	Monteirópolis	2
159	Murici	2
160	Novo Lino	2
161	Olho d"Água das Flores	2
162	Olho d"Água do Casado	2
163	Olho d"Água Grande	2
164	Olivença	2
165	Ouro Branco	2
166	Palestina	2
167	Palmeira dos Índios	2
168	Pão de Açúcar	2
169	Pariconha	2
170	Paripueira	2
171	Passo de Camaragibe	2
172	Paulo Jacinto	2
173	Penedo	2
174	Piaçabuçu	2
175	Pilar	2
176	Pindoba	2
177	Piranhas	2
178	Poço das Trincheiras	2
179	Porto Calvo	2
180	Porto de Pedras	2
181	Porto Real do Colégio	2
182	Quebrangulo	2
183	Rio Largo	2
184	Roteiro	2
185	Santa Luzia do Norte	2
186	Santana do Ipanema	2
187	Santana do Mundaú	2
188	São Brás	2
189	São José da Laje	2
190	São José da Tapera	2
191	São Luís do Quitunde	2
192	São Miguel dos Campos	2
193	São Miguel dos Milagres	2
194	São Sebastião	2
195	Satuba	2
196	Senador Rui Palmeira	2
197	Tanque d"Arca	2
198	Taquarana	2
199	Teotônio Vilela	2
200	Traipu	2
201	União dos Palmares	2
202	Viçosa	2
203	Amapá	4
204	Calçoene	4
205	Cutias	4
206	Ferreira Gomes	4
207	Itaubal	4
208	Laranjal do Jari	4
209	Macapá	4
210	Mazagão	4
211	Oiapoque	4
212	Pedra Branca do Amaparí	4
213	Porto Grande	4
214	Pracuúba	4
215	Santana	4
216	Serra do Navio	4
217	Tartarugalzinho	4
218	Vitória do Jari	4
219	Alvarães	3
220	Amaturá	3
221	Anamã	3
222	Anori	3
223	Apuí	3
224	Atalaia do Norte	3
225	Autazes	3
226	Barcelos	3
227	Barreirinha	3
228	Benjamin Constant	3
229	Beruri	3
230	Boa Vista do Ramos	3
231	Boca do Acre	3
232	Borba	3
233	Caapiranga	3
234	Canutama	3
235	Carauari	3
236	Careiro	3
237	Careiro da Várzea	3
238	Coari	3
239	Codajás	3
240	Eirunepé	3
241	Envira	3
242	Fonte Boa	3
243	Guajará	3
244	Humaitá	3
245	Ipixuna	3
246	Iranduba	3
247	Itacoatiara	3
248	Itamarati	3
249	Itapiranga	3
250	Japurá	3
251	Juruá	3
252	Jutaí	3
253	Lábrea	3
254	Manacapuru	3
255	Manaquiri	3
256	Manaus	3
257	Manicoré	3
258	Maraã	3
259	Maués	3
260	Nhamundá	3
261	Nova Olinda do Norte	3
262	Novo Airão	3
263	Novo Aripuanã	3
264	Parintins	3
265	Pauini	3
266	Presidente Figueiredo	3
267	Rio Preto da Eva	3
268	Santa Isabel do Rio Negro	3
269	Santo Antônio do Içá	3
270	São Gabriel da Cachoeira	3
271	São Paulo de Olivença	3
272	São Sebastião do Uatumã	3
273	Silves	3
274	Tabatinga	3
275	Tapauá	3
276	Tefé	3
277	Tonantins	3
278	Uarini	3
279	Urucará	3
280	Urucurituba	3
281	Abaíra	5
282	Abaré	5
283	Acajutiba	5
284	Adustina	5
285	Água Fria	5
286	Aiquara	5
287	Alagoinhas	5
288	Alcobaça	5
289	Almadina	5
290	Amargosa	5
291	Amélia Rodrigues	5
292	América Dourada	5
293	Anagé	5
294	Andaraí	5
295	Andorinha	5
296	Angical	5
297	Anguera	5
298	Antas	5
299	Antônio Cardoso	5
300	Antônio Gonçalves	5
301	Aporá	5
302	Apuarema	5
303	Araças	5
304	Aracatu	5
305	Araci	5
306	Aramari	5
307	Arataca	5
308	Aratuípe	5
309	Aurelino Leal	5
310	Baianópolis	5
311	Baixa Grande	5
312	Banzaê	5
313	Barra	5
314	Barra da Estiva	5
315	Barra do Choça	5
316	Barra do Mendes	5
317	Barra do Rocha	5
318	Barreiras	5
319	Barro Alto	5
320	Barro Preto (antigo Gov. Lomanto Jr.)	5
321	Barrocas	5
322	Belmonte	5
323	Belo Campo	5
324	Biritinga	5
325	Boa Nova	5
326	Boa Vista do Tupim	5
327	Bom Jesus da Lapa	5
328	Bom Jesus da Serra	5
329	Boninal	5
330	Bonito	5
331	Boquira	5
332	Botuporã	5
333	Brejões	5
334	Brejolândia	5
335	Brotas de Macaúbas	5
336	Brumado	5
337	Buerarema	5
338	Buritirama	5
339	Caatiba	5
340	Cabaceiras do Paraguaçu	5
341	Cachoeira	5
342	Caculé	5
343	Caém	5
344	Caetanos	5
345	Caetité	5
346	Cafarnaum	5
347	Cairu	5
348	Caldeirão Grande	5
349	Camacan	5
350	Camaçari	5
351	Camamu	5
352	Campo Alegre de Lourdes	5
353	Campo Formoso	5
354	Canápolis	5
355	Canarana	5
356	Canavieiras	5
357	Candeal	5
358	Candeias	5
359	Candiba	5
360	Cândido Sales	5
361	Cansanção	5
362	Canudos	5
363	Capela do Alto Alegre	5
364	Capim Grosso	5
365	Caraíbas	5
366	Caravelas	5
367	Cardeal da Silva	5
368	Carinhanha	5
369	Casa Nova	5
370	Castro Alves	5
371	Catolândia	5
372	Catu	5
373	Caturama	5
374	Central	5
375	Chorrochó	5
376	Cícero Dantas	5
377	Cipó	5
378	Coaraci	5
379	Cocos	5
380	Conceição da Feira	5
381	Conceição do Almeida	5
382	Conceição do Coité	5
383	Conceição do Jacuípe	5
384	Conde	5
385	Condeúba	5
386	Contendas do Sincorá	5
387	Coração de Maria	5
388	Cordeiros	5
389	Coribe	5
390	Coronel João Sá	5
391	Correntina	5
392	Cotegipe	5
393	Cravolândia	5
394	Crisópolis	5
395	Cristópolis	5
396	Cruz das Almas	5
397	Curaçá	5
398	Dário Meira	5
399	Dias d"Ávila	5
400	Dom Basílio	5
401	Dom Macedo Costa	5
402	Elísio Medrado	5
403	Encruzilhada	5
404	Entre Rios	5
405	Érico Cardoso	5
406	Esplanada	5
407	Euclides da Cunha	5
408	Eunápolis	5
409	Fátima	5
410	Feira da Mata	5
411	Feira de Santana	5
412	Filadélfia	5
413	Firmino Alves	5
414	Floresta Azul	5
415	Formosa do Rio Preto	5
416	Gandu	5
417	Gavião	5
418	Gentio do Ouro	5
419	Glória	5
420	Gongogi	5
421	Governador Mangabeira	5
422	Guajeru	5
423	Guanambi	5
424	Guaratinga	5
425	Heliópolis	5
426	Iaçu	5
427	Ibiassucê	5
428	Ibicaraí	5
429	Ibicoara	5
430	Ibicuí	5
431	Ibipeba	5
432	Ibipitanga	5
433	Ibiquera	5
434	Ibirapitanga	5
435	Ibirapuã	5
436	Ibirataia	5
437	Ibitiara	5
438	Ibititá	5
439	Ibotirama	5
440	Ichu	5
441	Igaporã	5
442	Igrapiúna	5
443	Iguaí	5
444	Ilhéus	5
445	Inhambupe	5
446	Ipecaetá	5
447	Ipiaú	5
448	Ipirá	5
449	Ipupiara	5
450	Irajuba	5
451	Iramaia	5
452	Iraquara	5
453	Irará	5
454	Irecê	5
455	Itabela	5
456	Itaberaba	5
457	Itabuna	5
458	Itacaré	5
459	Itaeté	5
460	Itagi	5
461	Itagibá	5
462	Itagimirim	5
463	Itaguaçu da Bahia	5
464	Itaju do Colônia	5
465	Itajuípe	5
466	Itamaraju	5
467	Itamari	5
468	Itambé	5
469	Itanagra	5
470	Itanhém	5
471	Itaparica	5
472	Itapé	5
473	Itapebi	5
474	Itapetinga	5
475	Itapicuru	5
476	Itapitanga	5
477	Itaquara	5
478	Itarantim	5
479	Itatim	5
480	Itiruçu	5
481	Itiúba	5
482	Itororó	5
483	Ituaçu	5
484	Ituberá	5
485	Iuiú	5
486	Jaborandi	5
487	Jacaraci	5
488	Jacobina	5
489	Jaguaquara	5
490	Jaguarari	5
491	Jaguaripe	5
492	Jandaíra	5
493	Jequié	5
494	Jeremoabo	5
495	Jiquiriçá	5
496	Jitaúna	5
497	João Dourado	5
498	Juazeiro	5
499	Jucuruçu	5
500	Jussara	5
501	Jussari	5
502	Jussiape	5
503	Lafaiete Coutinho	5
504	Lagoa Real	5
505	Laje	5
506	Lajedão	5
507	Lajedinho	5
508	Lajedo do Tabocal	5
509	Lamarão	5
510	Lapão	5
511	Lauro de Freitas	5
512	Lençóis	5
513	Licínio de Almeida	5
514	Livramento de Nossa Senhora	5
515	Luís Eduardo Magalhães	5
516	Macajuba	5
517	Macarani	5
518	Macaúbas	5
519	Macururé	5
520	Madre de Deus	5
521	Maetinga	5
522	Maiquinique	5
523	Mairi	5
524	Malhada	5
525	Malhada de Pedras	5
526	Manoel Vitorino	5
527	Mansidão	5
528	Maracás	5
529	Maragogipe	5
530	Maraú	5
531	Marcionílio Souza	5
532	Mascote	5
533	Mata de São João	5
534	Matina	5
535	Medeiros Neto	5
536	Miguel Calmon	5
537	Milagres	5
538	Mirangaba	5
539	Mirante	5
540	Monte Santo	5
541	Morpará	5
542	Morro do Chapéu	5
543	Mortugaba	5
544	Mucugê	5
545	Mucuri	5
546	Mulungu do Morro	5
547	Mundo Novo	5
548	Muniz Ferreira	5
549	Muquém de São Francisco	5
550	Muritiba	5
551	Mutuípe	5
552	Nazaré	5
553	Nilo Peçanha	5
554	Nordestina	5
555	Nova Canaã	5
556	Nova Fátima	5
557	Nova Ibiá	5
558	Nova Itarana	5
559	Nova Redenção	5
560	Nova Soure	5
561	Nova Viçosa	5
562	Novo Horizonte	5
563	Novo Triunfo	5
564	Olindina	5
565	Oliveira dos Brejinhos	5
566	Ouriçangas	5
567	Ourolândia	5
568	Palmas de Monte Alto	5
569	Palmeiras	5
570	Paramirim	5
571	Paratinga	5
572	Paripiranga	5
573	Pau Brasil	5
574	Paulo Afonso	5
575	Pé de Serra	5
576	Pedrão	5
577	Pedro Alexandre	5
578	Piatã	5
579	Pilão Arcado	5
580	Pindaí	5
581	Pindobaçu	5
582	Pintadas	5
583	Piraí do Norte	5
584	Piripá	5
585	Piritiba	5
586	Planaltino	5
587	Planalto	5
588	Poções	5
589	Pojuca	5
590	Ponto Novo	5
591	Porto Seguro	5
592	Potiraguá	5
593	Prado	5
594	Presidente Dutra	5
595	Presidente Jânio Quadros	5
596	Presidente Tancredo Neves	5
597	Queimadas	5
598	Quijingue	5
599	Quixabeira	5
600	Rafael Jambeiro	5
601	Remanso	5
602	Retirolândia	5
603	Riachão das Neves	5
604	Riachão do Jacuípe	5
605	Riacho de Santana	5
606	Ribeira do Amparo	5
607	Ribeira do Pombal	5
608	Ribeirão do Largo	5
609	Rio de Contas	5
610	Rio do Antônio	5
611	Rio do Pires	5
612	Rio Real	5
613	Rodelas	5
614	Ruy Barbosa	5
615	Salinas da Margarida	5
616	Salvador	5
617	Santa Bárbara	5
618	Santa Brígida	5
619	Santa Cruz Cabrália	5
620	Santa Cruz da Vitória	5
621	Santa Inês	5
622	Santa Luzia	5
623	Santa Maria da Vitória	5
624	Santa Rita de Cássia	5
625	Santa Teresinha	5
626	Santaluz	5
627	Santana	5
628	Santanópolis	5
629	Santo Amaro	5
630	Santo Antônio de Jesus	5
631	Santo Estêvão	5
632	São Desidério	5
633	São Domingos	5
634	São Felipe	5
635	São Félix	5
636	São Félix do Coribe	5
637	São Francisco do Conde	5
638	São Gabriel	5
639	São Gonçalo dos Campos	5
640	São José da Vitória	5
641	São José do Jacuípe	5
642	São Miguel das Matas	5
643	São Sebastião do Passé	5
644	Sapeaçu	5
645	Sátiro Dias	5
646	Saubara	5
647	Saúde	5
648	Seabra	5
649	Sebastião Laranjeiras	5
650	Senhor do Bonfim	5
651	Sento Sé	5
652	Serra do Ramalho	5
653	Serra Dourada	5
654	Serra Preta	5
655	Serrinha	5
656	Serrolândia	5
657	Simões Filho	5
658	Sítio do Mato	5
659	Sítio do Quinto	5
660	Sobradinho	5
661	Souto Soares	5
662	Tabocas do Brejo Velho	5
663	Tanhaçu	5
664	Tanque Novo	5
665	Tanquinho	5
666	Taperoá	5
667	Tapiramutá	5
668	Teixeira de Freitas	5
669	Teodoro Sampaio	5
670	Teofilândia	5
671	Teolândia	5
672	Terra Nova	5
673	Tremedal	5
674	Tucano	5
675	Uauá	5
676	Ubaíra	5
677	Ubaitaba	5
678	Ubatã	5
679	Uibaí	5
680	Umburanas	5
681	Una	5
682	Urandi	5
683	Uruçuca	5
684	Utinga	5
685	Valença	5
686	Valente	5
687	Várzea da Roça	5
688	Várzea do Poço	5
689	Várzea Nova	5
690	Varzedo	5
691	Vera Cruz	5
692	Vereda	5
693	Vitória da Conquista	5
694	Wagner	5
695	Wanderley	5
696	Wenceslau Guimarães	5
697	Xique-Xique	5
698	Abaiara	6
699	Acarape	6
700	Acaraú	6
701	Acopiara	6
702	Aiuaba	6
703	Alcântaras	6
704	Altaneira	6
705	Alto Santo	6
706	Amontada	6
707	Antonina do Norte	6
708	Apuiarés	6
709	Aquiraz	6
710	Aracati	6
711	Aracoiaba	6
712	Ararendá	6
713	Araripe	6
714	Aratuba	6
715	Arneiroz	6
716	Assaré	6
717	Aurora	6
718	Baixio	6
719	Banabuiú	6
720	Barbalha	6
721	Barreira	6
722	Barro	6
723	Barroquinha	6
724	Baturité	6
725	Beberibe	6
726	Bela Cruz	6
727	Boa Viagem	6
728	Brejo Santo	6
729	Camocim	6
730	Campos Sales	6
731	Canindé	6
732	Capistrano	6
733	Caridade	6
734	Cariré	6
735	Caririaçu	6
736	Cariús	6
737	Carnaubal	6
738	Cascavel	6
739	Catarina	6
740	Catunda	6
741	Caucaia	6
742	Cedro	6
743	Chaval	6
744	Choró	6
745	Chorozinho	6
746	Coreaú	6
747	Crateús	6
748	Crato	6
749	Croatá	6
750	Cruz	6
751	Deputado Irapuan Pinheiro	6
752	Ererê	6
753	Eusébio	6
754	Farias Brito	6
755	Forquilha	6
756	Fortaleza	6
757	Fortim	6
758	Frecheirinha	6
759	General Sampaio	6
760	Graça	6
761	Granja	6
762	Granjeiro	6
763	Groaíras	6
764	Guaiúba	6
765	Guaraciaba do Norte	6
766	Guaramiranga	6
767	Hidrolândia	6
768	Horizonte	6
769	Ibaretama	6
770	Ibiapina	6
771	Ibicuitinga	6
772	Icapuí	6
773	Icó	6
774	Iguatu	6
775	Independência	6
776	Ipaporanga	6
777	Ipaumirim	6
778	Ipu	6
779	Ipueiras	6
780	Iracema	6
781	Irauçuba	6
782	Itaiçaba	6
783	Itaitinga	6
784	Itapagé	6
785	Itapipoca	6
786	Itapiúna	6
787	Itarema	6
788	Itatira	6
789	Jaguaretama	6
790	Jaguaribara	6
791	Jaguaribe	6
792	Jaguaruana	6
793	Jardim	6
794	Jati	6
795	Jijoca de Jericoacoara	6
796	Juazeiro do Norte	6
797	Jucás	6
798	Lavras da Mangabeira	6
799	Limoeiro do Norte	6
800	Madalena	6
801	Maracanaú	6
802	Maranguape	6
803	Marco	6
804	Martinópole	6
805	Massapê	6
806	Mauriti	6
807	Meruoca	6
808	Milagres	6
809	Milhã	6
810	Miraíma	6
811	Missão Velha	6
812	Mombaça	6
813	Monsenhor Tabosa	6
814	Morada Nova	6
815	Moraújo	6
816	Morrinhos	6
817	Mucambo	6
818	Mulungu	6
819	Nova Olinda	6
820	Nova Russas	6
821	Novo Oriente	6
822	Ocara	6
823	Orós	6
824	Pacajus	6
825	Pacatuba	6
826	Pacoti	6
827	Pacujá	6
828	Palhano	6
829	Palmácia	6
830	Paracuru	6
831	Paraipaba	6
832	Parambu	6
833	Paramoti	6
834	Pedra Branca	6
835	Penaforte	6
836	Pentecoste	6
837	Pereiro	6
838	Pindoretama	6
839	Piquet Carneiro	6
840	Pires Ferreira	6
841	Poranga	6
842	Porteiras	6
843	Potengi	6
844	Potiretama	6
845	Quiterianópolis	6
846	Quixadá	6
847	Quixelô	6
848	Quixeramobim	6
849	Quixeré	6
850	Redenção	6
851	Reriutaba	6
852	Russas	6
853	Saboeiro	6
854	Salitre	6
855	Santa Quitéria	6
856	Santana do Acaraú	6
857	Santana do Cariri	6
858	São Benedito	6
859	São Gonçalo do Amarante	6
860	São João do Jaguaribe	6
861	São Luís do Curu	6
862	Senador Pompeu	6
863	Senador Sá	6
864	Sobral	6
865	Solonópole	6
866	Tabuleiro do Norte	6
867	Tamboril	6
868	Tarrafas	6
869	Tauá	6
870	Tejuçuoca	6
871	Tianguá	6
872	Trairi	6
873	Tururu	6
874	Ubajara	6
875	Umari	6
876	Umirim	6
877	Uruburetama	6
878	Uruoca	6
879	Varjota	6
880	Várzea Alegre	6
881	Viçosa do Ceará	6
882	Brasília	7
883	Abadia de Goiás	9
884	Abadiânia	9
885	Acreúna	9
886	Adelândia	9
887	Água Fria de Goiás	9
888	Água Limpa	9
889	Águas Lindas de Goiás	9
890	Alexânia	9
891	Aloândia	9
892	Alto Horizonte	9
893	Alto Paraíso de Goiás	9
894	Alvorada do Norte	9
895	Amaralina	9
896	Americano do Brasil	9
897	Amorinópolis	9
898	Anápolis	9
899	Anhanguera	9
900	Anicuns	9
901	Aparecida de Goiânia	9
902	Aparecida do Rio Doce	9
903	Aporé	9
904	Araçu	9
905	Aragarças	9
906	Aragoiânia	9
907	Araguapaz	9
908	Arenópolis	9
909	Aruanã	9
910	Aurilândia	9
911	Avelinópolis	9
912	Baliza	9
913	Barro Alto	9
914	Bela Vista de Goiás	9
915	Bom Jardim de Goiás	9
916	Bom Jesus de Goiás	9
917	Bonfinópolis	9
918	Bonópolis	9
919	Brazabrantes	9
920	Britânia	9
921	Buriti Alegre	9
922	Buriti de Goiás	9
923	Buritinópolis	9
924	Cabeceiras	9
925	Cachoeira Alta	9
926	Cachoeira de Goiás	9
927	Cachoeira Dourada	9
928	Caçu	9
929	Caiapônia	9
930	Caldas Novas	9
931	Caldazinha	9
932	Campestre de Goiás	9
933	Campinaçu	9
934	Campinorte	9
935	Campo Alegre de Goiás	9
936	Campo Limpo de Goiás	9
937	Campos Belos	9
938	Campos Verdes	9
939	Carmo do Rio Verde	9
940	Castelândia	9
941	Catalão	9
942	Caturaí	9
943	Cavalcante	9
944	Ceres	9
945	Cezarina	9
946	Chapadão do Céu	9
947	Cidade Ocidental	9
948	Cocalzinho de Goiás	9
949	Colinas do Sul	9
950	Córrego do Ouro	9
951	Corumbá de Goiás	9
952	Corumbaíba	9
953	Cristalina	9
954	Cristianópolis	9
955	Crixás	9
956	Cromínia	9
957	Cumari	9
958	Damianópolis	9
959	Damolândia	9
960	Davinópolis	9
961	Diorama	9
962	Divinópolis de Goiás	9
963	Doverlândia	9
964	Edealina	9
965	Edéia	9
966	Estrela do Norte	9
967	Faina	9
968	Fazenda Nova	9
969	Firminópolis	9
970	Flores de Goiás	9
971	Formosa	9
972	Formoso	9
973	Gameleira de Goiás	9
974	Goianápolis	9
975	Goiandira	9
976	Goianésia	9
977	Goiânia	9
978	Goianira	9
979	Goiás	9
980	Goiatuba	9
981	Gouvelândia	9
982	Guapó	9
983	Guaraíta	9
984	Guarani de Goiás	9
985	Guarinos	9
986	Heitoraí	9
987	Hidrolândia	9
988	Hidrolina	9
989	Iaciara	9
990	Inaciolândia	9
991	Indiara	9
992	Inhumas	9
993	Ipameri	9
994	Ipiranga de Goiás	9
995	Iporá	9
996	Israelândia	9
997	Itaberaí	9
998	Itaguari	9
999	Itaguaru	9
1000	Itajá	9
1001	Itapaci	9
1002	Itapirapuã	9
1003	Itapuranga	9
1004	Itarumã	9
1005	Itauçu	9
1006	Itumbiara	9
1007	Ivolândia	9
1008	Jandaia	9
1009	Jaraguá	9
1010	Jataí	9
1011	Jaupaci	9
1012	Jesúpolis	9
1013	Joviânia	9
1014	Jussara	9
1015	Lagoa Santa	9
1016	Leopoldo de Bulhões	9
1017	Luziânia	9
1018	Mairipotaba	9
1019	Mambaí	9
1020	Mara Rosa	9
1021	Marzagão	9
1022	Matrinchã	9
1023	Maurilândia	9
1024	Mimoso de Goiás	9
1025	Minaçu	9
1026	Mineiros	9
1027	Moiporá	9
1028	Monte Alegre de Goiás	9
1029	Montes Claros de Goiás	9
1030	Montividiu	9
1031	Montividiu do Norte	9
1032	Morrinhos	9
1033	Morro Agudo de Goiás	9
1034	Mossâmedes	9
1035	Mozarlândia	9
1036	Mundo Novo	9
1037	Mutunópolis	9
1038	Nazário	9
1039	Nerópolis	9
1040	Niquelândia	9
1041	Nova América	9
1042	Nova Aurora	9
1043	Nova Crixás	9
1044	Nova Glória	9
1045	Nova Iguaçu de Goiás	9
1046	Nova Roma	9
1047	Nova Veneza	9
1048	Novo Brasil	9
1049	Novo Gama	9
1050	Novo Planalto	9
1051	Orizona	9
1052	Ouro Verde de Goiás	9
1053	Ouvidor	9
1054	Padre Bernardo	9
1055	Palestina de Goiás	9
1056	Palmeiras de Goiás	9
1057	Palmelo	9
1058	Palminópolis	9
1059	Panamá	9
1060	Paranaiguara	9
1061	Paraúna	9
1062	Perolândia	9
1063	Petrolina de Goiás	9
1064	Pilar de Goiás	9
1065	Piracanjuba	9
1066	Piranhas	9
1067	Pirenópolis	9
1068	Pires do Rio	9
1069	Planaltina	9
1070	Pontalina	9
1071	Porangatu	9
1072	Porteirão	9
1073	Portelândia	9
1074	Posse	9
1075	Professor Jamil	9
1076	Quirinópolis	9
1077	Rialma	9
1078	Rianápolis	9
1079	Rio Quente	9
1080	Rio Verde	9
1081	Rubiataba	9
1082	Sanclerlândia	9
1083	Santa Bárbara de Goiás	9
1084	Santa Cruz de Goiás	9
1085	Santa Fé de Goiás	9
1086	Santa Helena de Goiás	9
1087	Santa Isabel	9
1088	Santa Rita do Araguaia	9
1089	Santa Rita do Novo Destino	9
1090	Santa Rosa de Goiás	9
1091	Santa Tereza de Goiás	9
1092	Santa Terezinha de Goiás	9
1093	Santo Antônio da Barra	9
1094	Santo Antônio de Goiás	9
1095	Santo Antônio do Descoberto	9
1096	São Domingos	9
1097	São Francisco de Goiás	9
1098	São João d"Aliança	9
1099	São João da Paraúna	9
1100	São Luís de Montes Belos	9
1101	São Luíz do Norte	9
1102	São Miguel do Araguaia	9
1103	São Miguel do Passa Quatro	9
1104	São Patrício	9
1105	São Simão	9
1106	Senador Canedo	9
1107	Serranópolis	9
1108	Silvânia	9
1109	Simolândia	9
1110	Sítio d"Abadia	9
1111	Taquaral de Goiás	9
1112	Teresina de Goiás	9
1113	Terezópolis de Goiás	9
1114	Três Ranchos	9
1115	Trindade	9
1116	Trombas	9
1117	Turvânia	9
1118	Turvelândia	9
1119	Uirapuru	9
1120	Uruaçu	9
1121	Uruana	9
1122	Urutaí	9
1123	Valparaíso de Goiás	9
1124	Varjão	9
1125	Vianópolis	9
1126	Vicentinópolis	9
1127	Vila Boa	9
1128	Vila Propício	9
1129	Açailândia	10
1130	Afonso Cunha	10
1131	Água Doce do Maranhão	10
1132	Alcântara	10
1133	Aldeias Altas	10
1134	Altamira do Maranhão	10
1135	Alto Alegre do Maranhão	10
1136	Alto Alegre do Pindaré	10
1137	Alto Parnaíba	10
1138	Amapá do Maranhão	10
1139	Amarante do Maranhão	10
1140	Anajatuba	10
1141	Anapurus	10
1142	Apicum-Açu	10
1143	Araguanã	10
1144	Araioses	10
1145	Arame	10
1146	Arari	10
1147	Axixá	10
1148	Bacabal	10
1149	Bacabeira	10
1150	Bacuri	10
1151	Bacurituba	10
1152	Balsas	10
1153	Barão de Grajaú	10
1154	Barra do Corda	10
1155	Barreirinhas	10
1156	Bela Vista do Maranhão	10
1157	Belágua	10
1158	Benedito Leite	10
1159	Bequimão	10
1160	Bernardo do Mearim	10
1161	Boa Vista do Gurupi	10
1162	Bom Jardim	10
1163	Bom Jesus das Selvas	10
1164	Bom Lugar	10
1165	Brejo	10
1166	Brejo de Areia	10
1167	Buriti	10
1168	Buriti Bravo	10
1169	Buriticupu	10
1170	Buritirana	10
1171	Cachoeira Grande	10
1172	Cajapió	10
1173	Cajari	10
1174	Campestre do Maranhão	10
1175	Cândido Mendes	10
1176	Cantanhede	10
1177	Capinzal do Norte	10
1178	Carolina	10
1179	Carutapera	10
1180	Caxias	10
1181	Cedral	10
1182	Central do Maranhão	10
1183	Centro do Guilherme	10
1184	Centro Novo do Maranhão	10
1185	Chapadinha	10
1186	Cidelândia	10
1187	Codó	10
1188	Coelho Neto	10
1189	Colinas	10
1190	Conceição do Lago-Açu	10
1191	Coroatá	10
1192	Cururupu	10
1193	Davinópolis	10
1194	Dom Pedro	10
1195	Duque Bacelar	10
1196	Esperantinópolis	10
1197	Estreito	10
1198	Feira Nova do Maranhão	10
1199	Fernando Falcão	10
1200	Formosa da Serra Negra	10
1201	Fortaleza dos Nogueiras	10
1202	Fortuna	10
1203	Godofredo Viana	10
1204	Gonçalves Dias	10
1205	Governador Archer	10
1206	Governador Edison Lobão	10
1207	Governador Eugênio Barros	10
1208	Governador Luiz Rocha	10
1209	Governador Newton Bello	10
1210	Governador Nunes Freire	10
1211	Graça Aranha	10
1212	Grajaú	10
1213	Guimarães	10
1214	Humberto de Campos	10
1215	Icatu	10
1216	Igarapé do Meio	10
1217	Igarapé Grande	10
1218	Imperatriz	10
1219	Itaipava do Grajaú	10
1220	Itapecuru Mirim	10
1221	Itinga do Maranhão	10
1222	Jatobá	10
1223	Jenipapo dos Vieiras	10
1224	João Lisboa	10
1225	Joselândia	10
1226	Junco do Maranhão	10
1227	Lago da Pedra	10
1228	Lago do Junco	10
1229	Lago dos Rodrigues	10
1230	Lago Verde	10
1231	Lagoa do Mato	10
1232	Lagoa Grande do Maranhão	10
1233	Lajeado Novo	10
1234	Lima Campos	10
1235	Loreto	10
1236	Luís Domingues	10
1237	Magalhães de Almeida	10
1238	Maracaçumé	10
1239	Marajá do Sena	10
1240	Maranhãozinho	10
1241	Mata Roma	10
1242	Matinha	10
1243	Matões	10
1244	Matões do Norte	10
1245	Milagres do Maranhão	10
1246	Mirador	10
1247	Miranda do Norte	10
1248	Mirinzal	10
1249	Monção	10
1250	Montes Altos	10
1251	Morros	10
1252	Nina Rodrigues	10
1253	Nova Colinas	10
1254	Nova Iorque	10
1255	Nova Olinda do Maranhão	10
1256	Olho d"Água das Cunhãs	10
1257	Olinda Nova do Maranhão	10
1258	Paço do Lumiar	10
1259	Palmeirândia	10
1260	Paraibano	10
1261	Parnarama	10
1262	Passagem Franca	10
1263	Pastos Bons	10
1264	Paulino Neves	10
1265	Paulo Ramos	10
1266	Pedreiras	10
1267	Pedro do Rosário	10
1268	Penalva	10
1269	Peri Mirim	10
1270	Peritoró	10
1271	Pindaré-Mirim	10
1272	Pinheiro	10
1273	Pio XII	10
1274	Pirapemas	10
1275	Poção de Pedras	10
1276	Porto Franco	10
1277	Porto Rico do Maranhão	10
1278	Presidente Dutra	10
1279	Presidente Juscelino	10
1280	Presidente Médici	10
1281	Presidente Sarney	10
1282	Presidente Vargas	10
1283	Primeira Cruz	10
1284	Raposa	10
1285	Riachão	10
1286	Ribamar Fiquene	10
1287	Rosário	10
1288	Sambaíba	10
1289	Santa Filomena do Maranhão	10
1290	Santa Helena	10
1291	Santa Inês	10
1292	Santa Luzia	10
1293	Santa Luzia do Paruá	10
1294	Santa Quitéria do Maranhão	10
1295	Santa Rita	10
1296	Santana do Maranhão	10
1297	Santo Amaro do Maranhão	10
1298	Santo Antônio dos Lopes	10
1299	São Benedito do Rio Preto	10
1300	São Bento	10
1301	São Bernardo	10
1302	São Domingos do Azeitão	10
1303	São Domingos do Maranhão	10
1304	São Félix de Balsas	10
1305	São Francisco do Brejão	10
1306	São Francisco do Maranhão	10
1307	São João Batista	10
1308	São João do Carú	10
1309	São João do Paraíso	10
1310	São João do Soter	10
1311	São João dos Patos	10
1312	São José de Ribamar	10
1313	São José dos Basílios	10
1314	São Luís	10
1315	São Luís Gonzaga do Maranhão	10
1316	São Mateus do Maranhão	10
1317	São Pedro da Água Branca	10
1318	São Pedro dos Crentes	10
1319	São Raimundo das Mangabeiras	10
1320	São Raimundo do Doca Bezerra	10
1321	São Roberto	10
1322	São Vicente Ferrer	10
1323	Satubinha	10
1324	Senador Alexandre Costa	10
1325	Senador La Rocque	10
1326	Serrano do Maranhão	10
1327	Sítio Novo	10
1328	Sucupira do Norte	10
1329	Sucupira do Riachão	10
1330	Tasso Fragoso	10
1331	Timbiras	10
1332	Timon	10
1333	Trizidela do Vale	10
1334	Tufilândia	10
1335	Tuntum	10
1336	Turiaçu	10
1337	Turilândia	10
1338	Tutóia	10
1339	Urbano Santos	10
1340	Vargem Grande	10
1341	Viana	10
1342	Vila Nova dos Martírios	10
1343	Vitória do Mearim	10
1344	Vitorino Freire	10
1345	Zé Doca	10
1346	Acorizal	13
1347	Água Boa	13
1348	Alta Floresta	13
1349	Alto Araguaia	13
1350	Alto Boa Vista	13
1351	Alto Garças	13
1352	Alto Paraguai	13
1353	Alto Taquari	13
1354	Apiacás	13
1355	Araguaiana	13
1356	Araguainha	13
1357	Araputanga	13
1358	Arenápolis	13
1359	Aripuanã	13
1360	Barão de Melgaço	13
1361	Barra do Bugres	13
1362	Barra do Garças	13
1363	Bom Jesus do Araguaia	13
1364	Brasnorte	13
1365	Cáceres	13
1366	Campinápolis	13
1367	Campo Novo do Parecis	13
1368	Campo Verde	13
1369	Campos de Júlio	13
1370	Canabrava do Norte	13
1371	Canarana	13
1372	Carlinda	13
1373	Castanheira	13
1374	Chapada dos Guimarães	13
1375	Cláudia	13
1376	Cocalinho	13
1377	Colíder	13
1378	Colniza	13
1379	Comodoro	13
1380	Confresa	13
1381	Conquista d"Oeste	13
1382	Cotriguaçu	13
1383	Cuiabá	13
1384	Curvelândia	13
1385	Curvelândia	13
1386	Denise	13
1387	Diamantino	13
1388	Dom Aquino	13
1389	Feliz Natal	13
1390	Figueirópolis d"Oeste	13
1391	Gaúcha do Norte	13
1392	General Carneiro	13
1393	Glória d"Oeste	13
1394	Guarantã do Norte	13
1395	Guiratinga	13
1396	Indiavaí	13
1397	Ipiranga do Norte	13
1398	Itanhangá	13
1399	Itaúba	13
1400	Itiquira	13
1401	Jaciara	13
1402	Jangada	13
1403	Jauru	13
1404	Juara	13
1405	Juína	13
1406	Juruena	13
1407	Juscimeira	13
1408	Lambari d"Oeste	13
1409	Lucas do Rio Verde	13
1410	Luciára	13
1411	Marcelândia	13
1412	Matupá	13
1413	Mirassol d"Oeste	13
1414	Nobres	13
1415	Nortelândia	13
1416	Nossa Senhora do Livramento	13
1417	Nova Bandeirantes	13
1418	Nova Brasilândia	13
1419	Nova Canaã do Norte	13
1420	Nova Guarita	13
1421	Nova Lacerda	13
1422	Nova Marilândia	13
1423	Nova Maringá	13
1424	Nova Monte verde	13
1425	Nova Mutum	13
1426	Nova Olímpia	13
1427	Nova Santa Helena	13
1428	Nova Ubiratã	13
1429	Nova Xavantina	13
1430	Novo Horizonte do Norte	13
1431	Novo Mundo	13
1432	Novo Santo Antônio	13
1433	Novo São Joaquim	13
1434	Paranaíta	13
1435	Paranatinga	13
1436	Pedra Preta	13
1437	Peixoto de Azevedo	13
1438	Planalto da Serra	13
1439	Poconé	13
1440	Pontal do Araguaia	13
1441	Ponte Branca	13
1442	Pontes e Lacerda	13
1443	Porto Alegre do Norte	13
1444	Porto dos Gaúchos	13
1445	Porto Esperidião	13
1446	Porto Estrela	13
1447	Poxoréo	13
1448	Primavera do Leste	13
1449	Querência	13
1450	Reserva do Cabaçal	13
1451	Ribeirão Cascalheira	13
1452	Ribeirãozinho	13
1453	Rio Branco	13
1454	Rondolândia	13
1455	Rondonópolis	13
1456	Rosário Oeste	13
1457	Salto do Céu	13
1458	Santa Carmem	13
1459	Santa Cruz do Xingu	13
1460	Santa Rita do Trivelato	13
1461	Santa Terezinha	13
1462	Santo Afonso	13
1463	Santo Antônio do Leste	13
1464	Santo Antônio do Leverger	13
1465	São Félix do Araguaia	13
1466	São José do Povo	13
1467	São José do Rio Claro	13
1468	São José do Xingu	13
1469	São José dos Quatro Marcos	13
1470	São Pedro da Cipa	13
1471	Sapezal	13
1472	Serra Nova Dourada	13
1473	Sinop	13
1474	Sorriso	13
1475	Tabaporã	13
1476	Tangará da Serra	13
1477	Tapurah	13
1478	Terra Nova do Norte	13
1479	Tesouro	13
1480	Torixoréu	13
1481	União do Sul	13
1482	Vale de São Domingos	13
1483	Várzea Grande	13
1484	Vera	13
1485	Vila Bela da Santíssima Trindade	13
1486	Vila Rica	13
1487	Água Clara	12
1488	Alcinópolis	12
1489	Amambaí	12
1490	Anastácio	12
1491	Anaurilândia	12
1492	Angélica	12
1493	Antônio João	12
1494	Aparecida do Taboado	12
1495	Aquidauana	12
1496	Aral Moreira	12
1497	Bandeirantes	12
1498	Bataguassu	12
1499	Bataiporã	12
1500	Bela Vista	12
1501	Bodoquena	12
1502	Bonito	12
1503	Brasilândia	12
1504	Caarapó	12
1505	Camapuã	12
1506	Campo Grande	12
1507	Caracol	12
1508	Cassilândia	12
1509	Chapadão do Sul	12
1510	Corguinho	12
1511	Coronel Sapucaia	12
1512	Corumbá	12
1513	Costa Rica	12
1514	Coxim	12
1515	Deodápolis	12
1516	Dois Irmãos do Buriti	12
1517	Douradina	12
1518	Dourados	12
1519	Eldorado	12
1520	Fátima do Sul	12
1521	Figueirão	12
1522	Glória de Dourados	12
1523	Guia Lopes da Laguna	12
1524	Iguatemi	12
1525	Inocência	12
1526	Itaporã	12
1527	Itaquiraí	12
1528	Ivinhema	12
1529	Japorã	12
1530	Jaraguari	12
1531	Jardim	12
1532	Jateí	12
1533	Juti	12
1534	Ladário	12
1535	Laguna Carapã	12
1536	Maracaju	12
1537	Miranda	12
1538	Mundo Novo	12
1539	Naviraí	12
1540	Nioaque	12
1541	Nova Alvorada do Sul	12
1542	Nova Andradina	12
1543	Novo Horizonte do Sul	12
1544	Paranaíba	12
1545	Paranhos	12
1546	Pedro Gomes	12
1547	Ponta Porã	12
1548	Porto Murtinho	12
1549	Ribas do Rio Pardo	12
1550	Rio Brilhante	12
1551	Rio Negro	12
1552	Rio Verde de Mato Grosso	12
1553	Rochedo	12
1554	Santa Rita do Pardo	12
1555	São Gabriel do Oeste	12
1556	Selvíria	12
1557	Sete Quedas	12
1558	Sidrolândia	12
1559	Sonora	12
1560	Tacuru	12
1561	Taquarussu	12
1562	Terenos	12
1563	Três Lagoas	12
1564	Vicentina	12
1565	Abadia dos Dourados	11
1566	Abaeté	11
1567	Abre Campo	11
1568	Acaiaca	11
1569	Açucena	11
1570	Água Boa	11
1571	Água Comprida	11
1572	Aguanil	11
1573	Águas Formosas	11
1574	Águas Vermelhas	11
1575	Aimorés	11
1576	Aiuruoca	11
1577	Alagoa	11
1578	Albertina	11
1579	Além Paraíba	11
1580	Alfenas	11
1581	Alfredo Vasconcelos	11
1582	Almenara	11
1583	Alpercata	11
1584	Alpinópolis	11
1585	Alterosa	11
1586	Alto Caparaó	11
1587	Alto Jequitibá	11
1588	Alto Rio Doce	11
1589	Alvarenga	11
1590	Alvinópolis	11
1591	Alvorada de Minas	11
1592	Amparo do Serra	11
1593	Andradas	11
1594	Andrelândia	11
1595	Angelândia	11
1596	Antônio Carlos	11
1597	Antônio Dias	11
1598	Antônio Prado de Minas	11
1599	Araçaí	11
1600	Aracitaba	11
1601	Araçuaí	11
1602	Araguari	11
1603	Arantina	11
1604	Araponga	11
1605	Araporã	11
1606	Arapuá	11
1607	Araújos	11
1608	Araxá	11
1609	Arceburgo	11
1610	Arcos	11
1611	Areado	11
1612	Argirita	11
1613	Aricanduva	11
1614	Arinos	11
1615	Astolfo Dutra	11
1616	Ataléia	11
1617	Augusto de Lima	11
1618	Baependi	11
1619	Baldim	11
1620	Bambuí	11
1621	Bandeira	11
1622	Bandeira do Sul	11
1623	Barão de Cocais	11
1624	Barão de Monte Alto	11
1625	Barbacena	11
1626	Barra Longa	11
1627	Barroso	11
1628	Bela Vista de Minas	11
1629	Belmiro Braga	11
1630	Belo Horizonte	11
1631	Belo Oriente	11
1632	Belo Vale	11
1633	Berilo	11
1634	Berizal	11
1635	Bertópolis	11
1636	Betim	11
1637	Bias Fortes	11
1638	Bicas	11
1639	Biquinhas	11
1640	Boa Esperança	11
1641	Bocaina de Minas	11
1642	Bocaiúva	11
1643	Bom Despacho	11
1644	Bom Jardim de Minas	11
1645	Bom Jesus da Penha	11
1646	Bom Jesus do Amparo	11
1647	Bom Jesus do Galho	11
1648	Bom Repouso	11
1649	Bom Sucesso	11
1650	Bonfim	11
1651	Bonfinópolis de Minas	11
1652	Bonito de Minas	11
1653	Borda da Mata	11
1654	Botelhos	11
1655	Botumirim	11
1656	Brás Pires	11
1657	Brasilândia de Minas	11
1658	Brasília de Minas	11
1659	Brasópolis	11
1660	Braúnas	11
1661	Brumadinho	11
1662	Bueno Brandão	11
1663	Buenópolis	11
1664	Bugre	11
1665	Buritis	11
1666	Buritizeiro	11
1667	Cabeceira Grande	11
1668	Cabo Verde	11
1669	Cachoeira da Prata	11
1670	Cachoeira de Minas	11
1671	Cachoeira de Pajeú	11
1672	Cachoeira Dourada	11
1673	Caetanópolis	11
1674	Caeté	11
1675	Caiana	11
1676	Cajuri	11
1677	Caldas	11
1678	Camacho	11
1679	Camanducaia	11
1680	Cambuí	11
1681	Cambuquira	11
1682	Campanário	11
1683	Campanha	11
1684	Campestre	11
1685	Campina Verde	11
1686	Campo Azul	11
1687	Campo Belo	11
1688	Campo do Meio	11
1689	Campo Florido	11
1690	Campos Altos	11
1691	Campos Gerais	11
1692	Cana Verde	11
1693	Canaã	11
1694	Canápolis	11
1695	Candeias	11
1696	Cantagalo	11
1697	Caparaó	11
1698	Capela Nova	11
1699	Capelinha	11
1700	Capetinga	11
1701	Capim Branco	11
1702	Capinópolis	11
1703	Capitão Andrade	11
1704	Capitão Enéas	11
1705	Capitólio	11
1706	Caputira	11
1707	Caraí	11
1708	Caranaíba	11
1709	Carandaí	11
1710	Carangola	11
1711	Caratinga	11
1712	Carbonita	11
1713	Careaçu	11
1714	Carlos Chagas	11
1715	Carmésia	11
1716	Carmo da Cachoeira	11
1717	Carmo da Mata	11
1718	Carmo de Minas	11
1719	Carmo do Cajuru	11
1720	Carmo do Paranaíba	11
1721	Carmo do Rio Claro	11
1722	Carmópolis de Minas	11
1723	Carneirinho	11
1724	Carrancas	11
1725	Carvalhópolis	11
1726	Carvalhos	11
1727	Casa Grande	11
1728	Cascalho Rico	11
1729	Cássia	11
1730	Cataguases	11
1731	Catas Altas	11
1732	Catas Altas da Noruega	11
1733	Catuji	11
1734	Catuti	11
1735	Caxambu	11
1736	Cedro do Abaeté	11
1737	Central de Minas	11
1738	Centralina	11
1739	Chácara	11
1740	Chalé	11
1741	Chapada do Norte	11
1742	Chapada Gaúcha	11
1743	Chiador	11
1744	Cipotânea	11
1745	Claraval	11
1746	Claro dos Poções	11
1747	Cláudio	11
1748	Coimbra	11
1749	Coluna	11
1750	Comendador Gomes	11
1751	Comercinho	11
1752	Conceição da Aparecida	11
1753	Conceição da Barra de Minas	11
1754	Conceição das Alagoas	11
1755	Conceição das Pedras	11
1756	Conceição de Ipanema	11
1757	Conceição do Mato Dentro	11
1758	Conceição do Pará	11
1759	Conceição do Rio Verde	11
1760	Conceição dos Ouros	11
1761	Cônego Marinho	11
1762	Confins	11
1763	Congonhal	11
1764	Congonhas	11
1765	Congonhas do Norte	11
1766	Conquista	11
1767	Conselheiro Lafaiete	11
1768	Conselheiro Pena	11
1769	Consolação	11
1770	Contagem	11
1771	Coqueiral	11
1772	Coração de Jesus	11
1773	Cordisburgo	11
1774	Cordislândia	11
1775	Corinto	11
1776	Coroaci	11
1777	Coromandel	11
1778	Coronel Fabriciano	11
1779	Coronel Murta	11
1780	Coronel Pacheco	11
1781	Coronel Xavier Chaves	11
1782	Córrego Danta	11
1783	Córrego do Bom Jesus	11
1784	Córrego Fundo	11
1785	Córrego Novo	11
1786	Couto de Magalhães de Minas	11
1787	Crisólita	11
1788	Cristais	11
1789	Cristália	11
1790	Cristiano Otoni	11
1791	Cristina	11
1792	Crucilândia	11
1793	Cruzeiro da Fortaleza	11
1794	Cruzília	11
1795	Cuparaque	11
1796	Curral de Dentro	11
1797	Curvelo	11
1798	Datas	11
1799	Delfim Moreira	11
1800	Delfinópolis	11
1801	Delta	11
1802	Descoberto	11
1803	Desterro de Entre Rios	11
1804	Desterro do Melo	11
1805	Diamantina	11
1806	Diogo de Vasconcelos	11
1807	Dionísio	11
1808	Divinésia	11
1809	Divino	11
1810	Divino das Laranjeiras	11
1811	Divinolândia de Minas	11
1812	Divinópolis	11
1813	Divisa Alegre	11
1814	Divisa Nova	11
1815	Divisópolis	11
1816	Dom Bosco	11
1817	Dom Cavati	11
1818	Dom Joaquim	11
1819	Dom Silvério	11
1820	Dom Viçoso	11
1821	Dona Eusébia	11
1822	Dores de Campos	11
1823	Dores de Guanhães	11
1824	Dores do Indaiá	11
1825	Dores do Turvo	11
1826	Doresópolis	11
1827	Douradoquara	11
1828	Durandé	11
1829	Elói Mendes	11
1830	Engenheiro Caldas	11
1831	Engenheiro Navarro	11
1832	Entre Folhas	11
1833	Entre Rios de Minas	11
1834	Ervália	11
1835	Esmeraldas	11
1836	Espera Feliz	11
1837	Espinosa	11
1838	Espírito Santo do Dourado	11
1839	Estiva	11
1840	Estrela Dalva	11
1841	Estrela do Indaiá	11
1842	Estrela do Sul	11
1843	Eugenópolis	11
1844	Ewbank da Câmara	11
1845	Extrema	11
1846	Fama	11
1847	Faria Lemos	11
1848	Felício dos Santos	11
1849	Felisburgo	11
1850	Felixlândia	11
1851	Fernandes Tourinho	11
1852	Ferros	11
1853	Fervedouro	11
1854	Florestal	11
1855	Formiga	11
1856	Formoso	11
1857	Fortaleza de Minas	11
1858	Fortuna de Minas	11
1859	Francisco Badaró	11
1860	Francisco Dumont	11
1861	Francisco Sá	11
1862	Franciscópolis	11
1863	Frei Gaspar	11
1864	Frei Inocêncio	11
1865	Frei Lagonegro	11
1866	Fronteira	11
1867	Fronteira dos Vales	11
1868	Fruta de Leite	11
1869	Frutal	11
1870	Funilândia	11
1871	Galiléia	11
1872	Gameleiras	11
1873	Glaucilândia	11
1874	Goiabeira	11
1875	Goianá	11
1876	Gonçalves	11
1877	Gonzaga	11
1878	Gouveia	11
1879	Governador Valadares	11
1880	Grão Mogol	11
1881	Grupiara	11
1882	Guanhães	11
1883	Guapé	11
1884	Guaraciaba	11
1885	Guaraciama	11
1886	Guaranésia	11
1887	Guarani	11
1888	Guarará	11
1889	Guarda-Mor	11
1890	Guaxupé	11
1891	Guidoval	11
1892	Guimarânia	11
1893	Guiricema	11
1894	Gurinhatã	11
1895	Heliodora	11
1896	Iapu	11
1897	Ibertioga	11
1898	Ibiá	11
1899	Ibiaí	11
1900	Ibiracatu	11
1901	Ibiraci	11
1902	Ibirité	11
1903	Ibitiúra de Minas	11
1904	Ibituruna	11
1905	Icaraí de Minas	11
1906	Igarapé	11
1907	Igaratinga	11
1908	Iguatama	11
1909	Ijaci	11
1910	Ilicínea	11
1911	Imbé de Minas	11
1912	Inconfidentes	11
1913	Indaiabira	11
1914	Indianópolis	11
1915	Ingaí	11
1916	Inhapim	11
1917	Inhaúma	11
1918	Inimutaba	11
1919	Ipaba	11
1920	Ipanema	11
1921	Ipatinga	11
1922	Ipiaçu	11
1923	Ipuiúna	11
1924	Iraí de Minas	11
1925	Itabira	11
1926	Itabirinha de Mantena	11
1927	Itabirito	11
1928	Itacambira	11
1929	Itacarambi	11
1930	Itaguara	11
1931	Itaipé	11
1932	Itajubá	11
1933	Itamarandiba	11
1934	Itamarati de Minas	11
1935	Itambacuri	11
1936	Itambé do Mato Dentro	11
1937	Itamogi	11
1938	Itamonte	11
1939	Itanhandu	11
1940	Itanhomi	11
1941	Itaobim	11
1942	Itapagipe	11
1943	Itapecerica	11
1944	Itapeva	11
1945	Itatiaiuçu	11
1946	Itaú de Minas	11
1947	Itaúna	11
1948	Itaverava	11
1949	Itinga	11
1950	Itueta	11
1951	Ituiutaba	11
1952	Itumirim	11
1953	Iturama	11
1954	Itutinga	11
1955	Jaboticatubas	11
1956	Jacinto	11
1957	Jacuí	11
1958	Jacutinga	11
1959	Jaguaraçu	11
1960	Jaíba	11
1961	Jampruca	11
1962	Janaúba	11
1963	Januária	11
1964	Japaraíba	11
1965	Japonvar	11
1966	Jeceaba	11
1967	Jenipapo de Minas	11
1968	Jequeri	11
1969	Jequitaí	11
1970	Jequitibá	11
1971	Jequitinhonha	11
1972	Jesuânia	11
1973	Joaíma	11
1974	Joanésia	11
1975	João Monlevade	11
1976	João Pinheiro	11
1977	Joaquim Felício	11
1978	Jordânia	11
1979	José Gonçalves de Minas	11
1980	José Raydan	11
1981	Josenópolis	11
1982	Juatuba	11
1983	Juiz de Fora	11
1984	Juramento	11
1985	Juruaia	11
1986	Juvenília	11
1987	Ladainha	11
1988	Lagamar	11
1989	Lagoa da Prata	11
1990	Lagoa dos Patos	11
1991	Lagoa Dourada	11
1992	Lagoa Formosa	11
1993	Lagoa Grande	11
1994	Lagoa Santa	11
1995	Lajinha	11
1996	Lambari	11
1997	Lamim	11
1998	Laranjal	11
1999	Lassance	11
2000	Lavras	11
2001	Leandro Ferreira	11
2002	Leme do Prado	11
2003	Leopoldina	11
2004	Liberdade	11
2005	Lima Duarte	11
2006	Limeira do Oeste	11
2007	Lontra	11
2008	Luisburgo	11
2009	Luislândia	11
2010	Luminárias	11
2011	Luz	11
2012	Machacalis	11
2013	Machado	11
2014	Madre de Deus de Minas	11
2015	Malacacheta	11
2016	Mamonas	11
2017	Manga	11
2018	Manhuaçu	11
2019	Manhumirim	11
2020	Mantena	11
2021	Mar de Espanha	11
2022	Maravilhas	11
2023	Maria da Fé	11
2024	Mariana	11
2025	Marilac	11
2026	Mário Campos	11
2027	Maripá de Minas	11
2028	Marliéria	11
2029	Marmelópolis	11
2030	Martinho Campos	11
2031	Martins Soares	11
2032	Mata Verde	11
2033	Materlândia	11
2034	Mateus Leme	11
2035	Mathias Lobato	11
2036	Matias Barbosa	11
2037	Matias Cardoso	11
2038	Matipó	11
2039	Mato Verde	11
2040	Matozinhos	11
2041	Matutina	11
2042	Medeiros	11
2043	Medina	11
2044	Mendes Pimentel	11
2045	Mercês	11
2046	Mesquita	11
2047	Minas Novas	11
2048	Minduri	11
2049	Mirabela	11
2050	Miradouro	11
2051	Miraí	11
2052	Miravânia	11
2053	Moeda	11
2054	Moema	11
2055	Monjolos	11
2056	Monsenhor Paulo	11
2057	Montalvânia	11
2058	Monte Alegre de Minas	11
2059	Monte Azul	11
2060	Monte Belo	11
2061	Monte Carmelo	11
2062	Monte Formoso	11
2063	Monte Santo de Minas	11
2064	Monte Sião	11
2065	Montes Claros	11
2066	Montezuma	11
2067	Morada Nova de Minas	11
2068	Morro da Garça	11
2069	Morro do Pilar	11
2070	Munhoz	11
2071	Muriaé	11
2072	Mutum	11
2073	Muzambinho	11
2074	Nacip Raydan	11
2075	Nanuque	11
2076	Naque	11
2077	Natalândia	11
2078	Natércia	11
2079	Nazareno	11
2080	Nepomuceno	11
2081	Ninheira	11
2082	Nova Belém	11
2083	Nova Era	11
2084	Nova Lima	11
2085	Nova Módica	11
2086	Nova Ponte	11
2087	Nova Porteirinha	11
2088	Nova Resende	11
2089	Nova Serrana	11
2090	Nova União	11
2091	Novo Cruzeiro	11
2092	Novo Oriente de Minas	11
2093	Novorizonte	11
2094	Olaria	11
2095	Olhos-d"Água	11
2096	Olímpio Noronha	11
2097	Oliveira	11
2098	Oliveira Fortes	11
2099	Onça de Pitangui	11
2100	Oratórios	11
2101	Orizânia	11
2102	Ouro Branco	11
2103	Ouro Fino	11
2104	Ouro Preto	11
2105	Ouro Verde de Minas	11
2106	Padre Carvalho	11
2107	Padre Paraíso	11
2108	Pai Pedro	11
2109	Paineiras	11
2110	Pains	11
2111	Paiva	11
2112	Palma	11
2113	Palmópolis	11
2114	Papagaios	11
2115	Pará de Minas	11
2116	Paracatu	11
2117	Paraguaçu	11
2118	Paraisópolis	11
2119	Paraopeba	11
2120	Passa Quatro	11
2121	Passa Tempo	11
2122	Passabém	11
2123	Passa-Vinte	11
2124	Passos	11
2125	Patis	11
2126	Patos de Minas	11
2127	Patrocínio	11
2128	Patrocínio do Muriaé	11
2129	Paula Cândido	11
2130	Paulistas	11
2131	Pavão	11
2132	Peçanha	11
2133	Pedra Azul	11
2134	Pedra Bonita	11
2135	Pedra do Anta	11
2136	Pedra do Indaiá	11
2137	Pedra Dourada	11
2138	Pedralva	11
2139	Pedras de Maria da Cruz	11
2140	Pedrinópolis	11
2141	Pedro Leopoldo	11
2142	Pedro Teixeira	11
2143	Pequeri	11
2144	Pequi	11
2145	Perdigão	11
2146	Perdizes	11
2147	Perdões	11
2148	Periquito	11
2149	Pescador	11
2150	Piau	11
2151	Piedade de Caratinga	11
2152	Piedade de Ponte Nova	11
2153	Piedade do Rio Grande	11
2154	Piedade dos Gerais	11
2155	Pimenta	11
2156	Pingo-d"Água	11
2157	Pintópolis	11
2158	Piracema	11
2159	Pirajuba	11
2160	Piranga	11
2161	Piranguçu	11
2162	Piranguinho	11
2163	Pirapetinga	11
2164	Pirapora	11
2165	Piraúba	11
2166	Pitangui	11
2167	Piumhi	11
2168	Planura	11
2169	Poço Fundo	11
2170	Poços de Caldas	11
2171	Pocrane	11
2172	Pompéu	11
2173	Ponte Nova	11
2174	Ponto Chique	11
2175	Ponto dos Volantes	11
2176	Porteirinha	11
2177	Porto Firme	11
2178	Poté	11
2179	Pouso Alegre	11
2180	Pouso Alto	11
2181	Prados	11
2182	Prata	11
2183	Pratápolis	11
2184	Pratinha	11
2185	Presidente Bernardes	11
2186	Presidente Juscelino	11
2187	Presidente Kubitschek	11
2188	Presidente Olegário	11
2189	Prudente de Morais	11
2190	Quartel Geral	11
2191	Queluzito	11
2192	Raposos	11
2193	Raul Soares	11
2194	Recreio	11
2195	Reduto	11
2196	Resende Costa	11
2197	Resplendor	11
2198	Ressaquinha	11
2199	Riachinho	11
2200	Riacho dos Machados	11
2201	Ribeirão das Neves	11
2202	Ribeirão Vermelho	11
2203	Rio Acima	11
2204	Rio Casca	11
2205	Rio do Prado	11
2206	Rio Doce	11
2207	Rio Espera	11
2208	Rio Manso	11
2209	Rio Novo	11
2210	Rio Paranaíba	11
2211	Rio Pardo de Minas	11
2212	Rio Piracicaba	11
2213	Rio Pomba	11
2214	Rio Preto	11
2215	Rio Vermelho	11
2216	Ritápolis	11
2217	Rochedo de Minas	11
2218	Rodeiro	11
2219	Romaria	11
2220	Rosário da Limeira	11
2221	Rubelita	11
2222	Rubim	11
2223	Sabará	11
2224	Sabinópolis	11
2225	Sacramento	11
2226	Salinas	11
2227	Salto da Divisa	11
2228	Santa Bárbara	11
2229	Santa Bárbara do Leste	11
2230	Santa Bárbara do Monte Verde	11
2231	Santa Bárbara do Tugúrio	11
2232	Santa Cruz de Minas	11
2233	Santa Cruz de Salinas	11
2234	Santa Cruz do Escalvado	11
2235	Santa Efigênia de Minas	11
2236	Santa Fé de Minas	11
2237	Santa Helena de Minas	11
2238	Santa Juliana	11
2239	Santa Luzia	11
2240	Santa Margarida	11
2241	Santa Maria de Itabira	11
2242	Santa Maria do Salto	11
2243	Santa Maria do Suaçuí	11
2244	Santa Rita de Caldas	11
2245	Santa Rita de Ibitipoca	11
2246	Santa Rita de Jacutinga	11
2247	Santa Rita de Minas	11
2248	Santa Rita do Itueto	11
2249	Santa Rita do Sapucaí	11
2250	Santa Rosa da Serra	11
2251	Santa Vitória	11
2252	Santana da Vargem	11
2253	Santana de Cataguases	11
2254	Santana de Pirapama	11
2255	Santana do Deserto	11
2256	Santana do Garambéu	11
2257	Santana do Jacaré	11
2258	Santana do Manhuaçu	11
2259	Santana do Paraíso	11
2260	Santana do Riacho	11
2261	Santana dos Montes	11
2262	Santo Antônio do Amparo	11
2263	Santo Antônio do Aventureiro	11
2264	Santo Antônio do Grama	11
2265	Santo Antônio do Itambé	11
2266	Santo Antônio do Jacinto	11
2267	Santo Antônio do Monte	11
2268	Santo Antônio do Retiro	11
2269	Santo Antônio do Rio Abaixo	11
2270	Santo Hipólito	11
2271	Santos Dumont	11
2272	São Bento Abade	11
2273	São Brás do Suaçuí	11
2274	São Domingos das Dores	11
2275	São Domingos do Prata	11
2276	São Félix de Minas	11
2277	São Francisco	11
2278	São Francisco de Paula	11
2279	São Francisco de Sales	11
2280	São Francisco do Glória	11
2281	São Geraldo	11
2282	São Geraldo da Piedade	11
2283	São Geraldo do Baixio	11
2284	São Gonçalo do Abaeté	11
2285	São Gonçalo do Pará	11
2286	São Gonçalo do Rio Abaixo	11
2287	São Gonçalo do Rio Preto	11
2288	São Gonçalo do Sapucaí	11
2289	São Gotardo	11
2290	São João Batista do Glória	11
2291	São João da Lagoa	11
2292	São João da Mata	11
2293	São João da Ponte	11
2294	São João das Missões	11
2295	São João del Rei	11
2296	São João do Manhuaçu	11
2297	São João do Manteninha	11
2298	São João do Oriente	11
2299	São João do Pacuí	11
2300	São João do Paraíso	11
2301	São João Evangelista	11
2302	São João Nepomuceno	11
2303	São Joaquim de Bicas	11
2304	São José da Barra	11
2305	São José da Lapa	11
2306	São José da Safira	11
2307	São José da Varginha	11
2308	São José do Alegre	11
2309	São José do Divino	11
2310	São José do Goiabal	11
2311	São José do Jacuri	11
2312	São José do Mantimento	11
2313	São Lourenço	11
2314	São Miguel do Anta	11
2315	São Pedro da União	11
2316	São Pedro do Suaçuí	11
2317	São Pedro dos Ferros	11
2318	São Romão	11
2319	São Roque de Minas	11
2320	São Sebastião da Bela Vista	11
2321	São Sebastião da Vargem Alegre	11
2322	São Sebastião do Anta	11
2323	São Sebastião do Maranhão	11
2324	São Sebastião do Oeste	11
2325	São Sebastião do Paraíso	11
2326	São Sebastião do Rio Preto	11
2327	São Sebastião do Rio Verde	11
2328	São Thomé das Letras	11
2329	São Tiago	11
2330	São Tomás de Aquino	11
2331	São Vicente de Minas	11
2332	Sapucaí-Mirim	11
2333	Sardoá	11
2334	Sarzedo	11
2335	Sem-Peixe	11
2336	Senador Amaral	11
2337	Senador Cortes	11
2338	Senador Firmino	11
2339	Senador José Bento	11
2340	Senador Modestino Gonçalves	11
2341	Senhora de Oliveira	11
2342	Senhora do Porto	11
2343	Senhora dos Remédios	11
2344	Sericita	11
2345	Seritinga	11
2346	Serra Azul de Minas	11
2347	Serra da Saudade	11
2348	Serra do Salitre	11
2349	Serra dos Aimorés	11
2350	Serrania	11
2351	Serranópolis de Minas	11
2352	Serranos	11
2353	Serro	11
2354	Sete Lagoas	11
2355	Setubinha	11
2356	Silveirânia	11
2357	Silvianópolis	11
2358	Simão Pereira	11
2359	Simonésia	11
2360	Sobrália	11
2361	Soledade de Minas	11
2362	Tabuleiro	11
2363	Taiobeiras	11
2364	Taparuba	11
2365	Tapira	11
2366	Tapiraí	11
2367	Taquaraçu de Minas	11
2368	Tarumirim	11
2369	Teixeiras	11
2370	Teófilo Otoni	11
2371	Timóteo	11
2372	Tiradentes	11
2373	Tiros	11
2374	Tocantins	11
2375	Tocos do Moji	11
2376	Toledo	11
2377	Tombos	11
2378	Três Corações	11
2379	Três Marias	11
2380	Três Pontas	11
2381	Tumiritinga	11
2382	Tupaciguara	11
2383	Turmalina	11
2384	Turvolândia	11
2385	Ubá	11
2386	Ubaí	11
2387	Ubaporanga	11
2388	Uberaba	11
2389	Uberlândia	11
2390	Umburatiba	11
2391	Unaí	11
2392	União de Minas	11
2393	Uruana de Minas	11
2394	Urucânia	11
2395	Urucuia	11
2396	Vargem Alegre	11
2397	Vargem Bonita	11
2398	Vargem Grande do Rio Pardo	11
2399	Varginha	11
2400	Varjão de Minas	11
2401	Várzea da Palma	11
2402	Varzelândia	11
2403	Vazante	11
2404	Verdelândia	11
2405	Veredinha	11
2406	Veríssimo	11
2407	Vermelho Novo	11
2408	Vespasiano	11
2409	Viçosa	11
2410	Vieiras	11
2411	Virgem da Lapa	11
2412	Virgínia	11
2413	Virginópolis	11
2414	Virgolândia	11
2415	Visconde do Rio Branco	11
2416	Volta Grande	11
2417	Wenceslau Braz	11
2418	Abaetetuba	14
2419	Abel Figueiredo	14
2420	Acará	14
2421	Afuá	14
2422	Água Azul do Norte	14
2423	Alenquer	14
2424	Almeirim	14
2425	Altamira	14
2426	Anajás	14
2427	Ananindeua	14
2428	Anapu	14
2429	Augusto Corrêa	14
2430	Aurora do Pará	14
2431	Aveiro	14
2432	Bagre	14
2433	Baião	14
2434	Bannach	14
2435	Barcarena	14
2436	Belém	14
2437	Belterra	14
2438	Benevides	14
2439	Bom Jesus do Tocantins	14
2440	Bonito	14
2441	Bragança	14
2442	Brasil Novo	14
2443	Brejo Grande do Araguaia	14
2444	Breu Branco	14
2445	Breves	14
2446	Bujaru	14
2447	Cachoeira do Arari	14
2448	Cachoeira do Piriá	14
2449	Cametá	14
2450	Canaã dos Carajás	14
2451	Capanema	14
2452	Capitão Poço	14
2453	Castanhal	14
2454	Chaves	14
2455	Colares	14
2456	Conceição do Araguaia	14
2457	Concórdia do Pará	14
2458	Cumaru do Norte	14
2459	Curionópolis	14
2460	Curralinho	14
2461	Curuá	14
2462	Curuçá	14
2463	Dom Eliseu	14
2464	Eldorado dos Carajás	14
2465	Faro	14
2466	Floresta do Araguaia	14
2467	Garrafão do Norte	14
2468	Goianésia do Pará	14
2469	Gurupá	14
2470	Igarapé-Açu	14
2471	Igarapé-Miri	14
2472	Inhangapi	14
2473	Ipixuna do Pará	14
2474	Irituia	14
2475	Itaituba	14
2476	Itupiranga	14
2477	Jacareacanga	14
2478	Jacundá	14
2479	Juruti	14
2480	Limoeiro do Ajuru	14
2481	Mãe do Rio	14
2482	Magalhães Barata	14
2483	Marabá	14
2484	Maracanã	14
2485	Marapanim	14
2486	Marituba	14
2487	Medicilândia	14
2488	Melgaço	14
2489	Mocajuba	14
2490	Moju	14
2491	Monte Alegre	14
2492	Muaná	14
2493	Nova Esperança do Piriá	14
2494	Nova Ipixuna	14
2495	Nova Timboteua	14
2496	Novo Progresso	14
2497	Novo Repartimento	14
2498	Óbidos	14
2499	Oeiras do Pará	14
2500	Oriximiná	14
2501	Ourém	14
2502	Ourilândia do Norte	14
2503	Pacajá	14
2504	Palestina do Pará	14
2505	Paragominas	14
2506	Parauapebas	14
2507	Pau d"Arco	14
2508	Peixe-Boi	14
2509	Piçarra	14
2510	Placas	14
2511	Ponta de Pedras	14
2512	Portel	14
2513	Porto de Moz	14
2514	Prainha	14
2515	Primavera	14
2516	Quatipuru	14
2517	Redenção	14
2518	Rio Maria	14
2519	Rondon do Pará	14
2520	Rurópolis	14
2521	Salinópolis	14
2522	Salvaterra	14
2523	Santa Bárbara do Pará	14
2524	Santa Cruz do Arari	14
2525	Santa Isabel do Pará	14
2526	Santa Luzia do Pará	14
2527	Santa Maria das Barreiras	14
2528	Santa Maria do Pará	14
2529	Santana do Araguaia	14
2530	Santarém	14
2531	Santarém Novo	14
2532	Santo Antônio do Tauá	14
2533	São Caetano de Odivelas	14
2534	São Domingos do Araguaia	14
2535	São Domingos do Capim	14
2536	São Félix do Xingu	14
2537	São Francisco do Pará	14
2538	São Geraldo do Araguaia	14
2539	São João da Ponta	14
2540	São João de Pirabas	14
2541	São João do Araguaia	14
2542	São Miguel do Guamá	14
2543	São Sebastião da Boa Vista	14
2544	Sapucaia	14
2545	Senador José Porfírio	14
2546	Soure	14
2547	Tailândia	14
2548	Terra Alta	14
2549	Terra Santa	14
2550	Tomé-Açu	14
2551	Tracuateua	14
2552	Trairão	14
2553	Tucumã	14
2554	Tucuruí	14
2555	Ulianópolis	14
2556	Uruará	14
2557	Vigia	14
2558	Viseu	14
2559	Vitória do Xingu	14
2560	Xinguara	14
2561	Água Branca	15
2562	Aguiar	15
2563	Alagoa Grande	15
2564	Alagoa Nova	15
2565	Alagoinha	15
2566	Alcantil	15
2567	Algodão de Jandaíra	15
2568	Alhandra	15
2569	Amparo	15
2570	Aparecida	15
2571	Araçagi	15
2572	Arara	15
2573	Araruna	15
2574	Areia	15
2575	Areia de Baraúnas	15
2576	Areial	15
2577	Aroeiras	15
2578	Assunção	15
2579	Baía da Traição	15
2580	Bananeiras	15
2581	Baraúna	15
2582	Barra de Santa Rosa	15
2583	Barra de Santana	15
2584	Barra de São Miguel	15
2585	Bayeux	15
2586	Belém	15
2587	Belém do Brejo do Cruz	15
2588	Bernardino Batista	15
2589	Boa Ventura	15
2590	Boa Vista	15
2591	Bom Jesus	15
2592	Bom Sucesso	15
2593	Bonito de Santa Fé	15
2594	Boqueirão	15
2595	Borborema	15
2596	Brejo do Cruz	15
2597	Brejo dos Santos	15
2598	Caaporã	15
2599	Cabaceiras	15
2600	Cabedelo	15
2601	Cachoeira dos Índios	15
2602	Cacimba de Areia	15
2603	Cacimba de Dentro	15
2604	Cacimbas	15
2605	Caiçara	15
2606	Cajazeiras	15
2607	Cajazeirinhas	15
2608	Caldas Brandão	15
2609	Camalaú	15
2610	Campina Grande	15
2611	Campo de Santana	15
2612	Capim	15
2613	Caraúbas	15
2614	Carrapateira	15
2615	Casserengue	15
2616	Catingueira	15
2617	Catolé do Rocha	15
2618	Caturité	15
2619	Conceição	15
2620	Condado	15
2621	Conde	15
2622	Congo	15
2623	Coremas	15
2624	Coxixola	15
2625	Cruz do Espírito Santo	15
2626	Cubati	15
2627	Cuité	15
2628	Cuité de Mamanguape	15
2629	Cuitegi	15
2630	Curral de Cima	15
2631	Curral Velho	15
2632	Damião	15
2633	Desterro	15
2634	Diamante	15
2635	Dona Inês	15
2636	Duas Estradas	15
2637	Emas	15
2638	Esperança	15
2639	Fagundes	15
2640	Frei Martinho	15
2641	Gado Bravo	15
2642	Guarabira	15
2643	Gurinhém	15
2644	Gurjão	15
2645	Ibiara	15
2646	Igaracy	15
2647	Imaculada	15
2648	Ingá	15
2649	Itabaiana	15
2650	Itaporanga	15
2651	Itapororoca	15
2652	Itatuba	15
2653	Jacaraú	15
2654	Jericó	15
2655	João Pessoa	15
2656	Juarez Távora	15
2657	Juazeirinho	15
2658	Junco do Seridó	15
2659	Juripiranga	15
2660	Juru	15
2661	Lagoa	15
2662	Lagoa de Dentro	15
2663	Lagoa Seca	15
2664	Lastro	15
2665	Livramento	15
2666	Logradouro	15
2667	Lucena	15
2668	Mãe d"Água	15
2669	Malta	15
2670	Mamanguape	15
2671	Manaíra	15
2672	Marcação	15
2673	Mari	15
2674	Marizópolis	15
2675	Massaranduba	15
2676	Mataraca	15
2677	Matinhas	15
2678	Mato Grosso	15
2679	Maturéia	15
2680	Mogeiro	15
2681	Montadas	15
2682	Monte Horebe	15
2683	Monteiro	15
2684	Mulungu	15
2685	Natuba	15
2686	Nazarezinho	15
2687	Nova Floresta	15
2688	Nova Olinda	15
2689	Nova Palmeira	15
2690	Olho d"Água	15
2691	Olivedos	15
2692	Ouro Velho	15
2693	Parari	15
2694	Passagem	15
2695	Patos	15
2696	Paulista	15
2697	Pedra Branca	15
2698	Pedra Lavrada	15
2699	Pedras de Fogo	15
2700	Pedro Régis	15
2701	Piancó	15
2702	Picuí	15
2703	Pilar	15
2704	Pilões	15
2705	Pilõezinhos	15
2706	Pirpirituba	15
2707	Pitimbu	15
2708	Pocinhos	15
2709	Poço Dantas	15
2710	Poço de José de Moura	15
2711	Pombal	15
2712	Prata	15
2713	Princesa Isabel	15
2714	Puxinanã	15
2715	Queimadas	15
2716	Quixabá	15
2717	Remígio	15
2718	Riachão	15
2719	Riachão do Bacamarte	15
2720	Riachão do Poço	15
2721	Riacho de Santo Antônio	15
2722	Riacho dos Cavalos	15
2723	Rio Tinto	15
2724	Salgadinho	15
2725	Salgado de São Félix	15
2726	Santa Cecília	15
2727	Santa Cruz	15
2728	Santa Helena	15
2729	Santa Inês	15
2730	Santa Luzia	15
2731	Santa Rita	15
2732	Santa Teresinha	15
2733	Santana de Mangueira	15
2734	Santana dos Garrotes	15
2735	Santarém	15
2736	Santo André	15
2737	São Bentinho	15
2738	São Bento	15
2739	São Domingos de Pombal	15
2740	São Domingos do Cariri	15
2741	São Francisco	15
2742	São João do Cariri	15
2743	São João do Rio do Peixe	15
2744	São João do Tigre	15
2745	São José da Lagoa Tapada	15
2746	São José de Caiana	15
2747	São José de Espinharas	15
2748	São José de Piranhas	15
2749	São José de Princesa	15
2750	São José do Bonfim	15
2751	São José do Brejo do Cruz	15
2752	São José do Sabugi	15
2753	São José dos Cordeiros	15
2754	São José dos Ramos	15
2755	São Mamede	15
2756	São Miguel de Taipu	15
2757	São Sebastião de Lagoa de Roça	15
2758	São Sebastião do Umbuzeiro	15
2759	Sapé	15
2760	Seridó	15
2761	Serra Branca	15
2762	Serra da Raiz	15
2763	Serra Grande	15
2764	Serra Redonda	15
2765	Serraria	15
2766	Sertãozinho	15
2767	Sobrado	15
2768	Solânea	15
2769	Soledade	15
2770	Sossêgo	15
2771	Sousa	15
2772	Sumé	15
2773	Taperoá	15
2774	Tavares	15
2775	Teixeira	15
2776	Tenório	15
2777	Triunfo	15
2778	Uiraúna	15
2779	Umbuzeiro	15
2780	Várzea	15
2781	Vieirópolis	15
2782	Vista Serrana	15
2783	Zabelê	15
2784	Abatiá	18
2785	Adrianópolis	18
2786	Agudos do Sul	18
2787	Almirante Tamandaré	18
2788	Altamira do Paraná	18
2789	Alto Paraíso	18
2790	Alto Paraná	18
2791	Alto Piquiri	18
2792	Altônia	18
2793	Alvorada do Sul	18
2794	Amaporã	18
2795	Ampére	18
2796	Anahy	18
2797	Andirá	18
2798	Ângulo	18
2799	Antonina	18
2800	Antônio Olinto	18
2801	Apucarana	18
2802	Arapongas	18
2803	Arapoti	18
2804	Arapuã	18
2805	Araruna	18
2806	Araucária	18
2807	Ariranha do Ivaí	18
2808	Assaí	18
2809	Assis Chateaubriand	18
2810	Astorga	18
2811	Atalaia	18
2812	Balsa Nova	18
2813	Bandeirantes	18
2814	Barbosa Ferraz	18
2815	Barra do Jacaré	18
2816	Barracão	18
2817	Bela Vista da Caroba	18
2818	Bela Vista do Paraíso	18
2819	Bituruna	18
2820	Boa Esperança	18
2821	Boa Esperança do Iguaçu	18
2822	Boa Ventura de São Roque	18
2823	Boa Vista da Aparecida	18
2824	Bocaiúva do Sul	18
2825	Bom Jesus do Sul	18
2826	Bom Sucesso	18
2827	Bom Sucesso do Sul	18
2828	Borrazópolis	18
2829	Braganey	18
2830	Brasilândia do Sul	18
2831	Cafeara	18
2832	Cafelândia	18
2833	Cafezal do Sul	18
2834	Califórnia	18
2835	Cambará	18
2836	Cambé	18
2837	Cambira	18
2838	Campina da Lagoa	18
2839	Campina do Simão	18
2840	Campina Grande do Sul	18
2841	Campo Bonito	18
2842	Campo do Tenente	18
2843	Campo Largo	18
2844	Campo Magro	18
2845	Campo Mourão	18
2846	Cândido de Abreu	18
2847	Candói	18
2848	Cantagalo	18
2849	Capanema	18
2850	Capitão Leônidas Marques	18
2851	Carambeí	18
2852	Carlópolis	18
2853	Cascavel	18
2854	Castro	18
2855	Catanduvas	18
2856	Centenário do Sul	18
2857	Cerro Azul	18
2858	Céu Azul	18
2859	Chopinzinho	18
2860	Cianorte	18
2861	Cidade Gaúcha	18
2862	Clevelândia	18
2863	Colombo	18
2864	Colorado	18
2865	Congonhinhas	18
2866	Conselheiro Mairinck	18
2867	Contenda	18
2868	Corbélia	18
2869	Cornélio Procópio	18
2870	Coronel Domingos Soares	18
2871	Coronel Vivida	18
2872	Corumbataí do Sul	18
2873	Cruz Machado	18
2874	Cruzeiro do Iguaçu	18
2875	Cruzeiro do Oeste	18
2876	Cruzeiro do Sul	18
2877	Cruzmaltina	18
2878	Curitiba	18
2879	Curiúva	18
2880	Diamante d"Oeste	18
2881	Diamante do Norte	18
2882	Diamante do Sul	18
2883	Dois Vizinhos	18
2884	Douradina	18
2885	Doutor Camargo	18
2886	Doutor Ulysses	18
2887	Enéas Marques	18
2888	Engenheiro Beltrão	18
2889	Entre Rios do Oeste	18
2890	Esperança Nova	18
2891	Espigão Alto do Iguaçu	18
2892	Farol	18
2893	Faxinal	18
2894	Fazenda Rio Grande	18
2895	Fênix	18
2896	Fernandes Pinheiro	18
2897	Figueira	18
2898	Flor da Serra do Sul	18
2899	Floraí	18
2900	Floresta	18
2901	Florestópolis	18
2902	Flórida	18
2903	Formosa do Oeste	18
2904	Foz do Iguaçu	18
2905	Foz do Jordão	18
2906	Francisco Alves	18
2907	Francisco Beltrão	18
2908	General Carneiro	18
2909	Godoy Moreira	18
2910	Goioerê	18
2911	Goioxim	18
2912	Grandes Rios	18
2913	Guaíra	18
2914	Guairaçá	18
2915	Guamiranga	18
2916	Guapirama	18
2917	Guaporema	18
2918	Guaraci	18
2919	Guaraniaçu	18
2920	Guarapuava	18
2921	Guaraqueçaba	18
2922	Guaratuba	18
2923	Honório Serpa	18
2924	Ibaiti	18
2925	Ibema	18
2926	Ibiporã	18
2927	Icaraíma	18
2928	Iguaraçu	18
2929	Iguatu	18
2930	Imbaú	18
2931	Imbituva	18
2932	Inácio Martins	18
2933	Inajá	18
2934	Indianópolis	18
2935	Ipiranga	18
2936	Iporã	18
2937	Iracema do Oeste	18
2938	Irati	18
2939	Iretama	18
2940	Itaguajé	18
2941	Itaipulândia	18
2942	Itambaracá	18
2943	Itambé	18
2944	Itapejara d"Oeste	18
2945	Itaperuçu	18
2946	Itaúna do Sul	18
2947	Ivaí	18
2948	Ivaiporã	18
2949	Ivaté	18
2950	Ivatuba	18
2951	Jaboti	18
2952	Jacarezinho	18
2953	Jaguapitã	18
2954	Jaguariaíva	18
2955	Jandaia do Sul	18
2956	Janiópolis	18
2957	Japira	18
2958	Japurá	18
2959	Jardim Alegre	18
2960	Jardim Olinda	18
2961	Jataizinho	18
2962	Jesuítas	18
2963	Joaquim Távora	18
2964	Jundiaí do Sul	18
2965	Juranda	18
2966	Jussara	18
2967	Kaloré	18
2968	Lapa	18
2969	Laranjal	18
2970	Laranjeiras do Sul	18
2971	Leópolis	18
2972	Lidianópolis	18
2973	Lindoeste	18
2974	Loanda	18
2975	Lobato	18
2976	Londrina	18
2977	Luiziana	18
2978	Lunardelli	18
2979	Lupionópolis	18
2980	Mallet	18
2981	Mamborê	18
2982	Mandaguaçu	18
2983	Mandaguari	18
2984	Mandirituba	18
2985	Manfrinópolis	18
2986	Mangueirinha	18
2987	Manoel Ribas	18
2988	Marechal Cândido Rondon	18
2989	Maria Helena	18
2990	Marialva	18
2991	Marilândia do Sul	18
2992	Marilena	18
2993	Mariluz	18
2994	Maringá	18
2995	Mariópolis	18
2996	Maripá	18
2997	Marmeleiro	18
2998	Marquinho	18
2999	Marumbi	18
3000	Matelândia	18
3001	Matinhos	18
3002	Mato Rico	18
3003	Mauá da Serra	18
3004	Medianeira	18
3005	Mercedes	18
3006	Mirador	18
3007	Miraselva	18
3008	Missal	18
3009	Moreira Sales	18
3010	Morretes	18
3011	Munhoz de Melo	18
3012	Nossa Senhora das Graças	18
3013	Nova Aliança do Ivaí	18
3014	Nova América da Colina	18
3015	Nova Aurora	18
3016	Nova Cantu	18
3017	Nova Esperança	18
3018	Nova Esperança do Sudoeste	18
3019	Nova Fátima	18
3020	Nova Laranjeiras	18
3021	Nova Londrina	18
3022	Nova Olímpia	18
3023	Nova Prata do Iguaçu	18
3024	Nova Santa Bárbara	18
3025	Nova Santa Rosa	18
3026	Nova Tebas	18
3027	Novo Itacolomi	18
3028	Ortigueira	18
3029	Ourizona	18
3030	Ouro Verde do Oeste	18
3031	Paiçandu	18
3032	Palmas	18
3033	Palmeira	18
3034	Palmital	18
3035	Palotina	18
3036	Paraíso do Norte	18
3037	Paranacity	18
3038	Paranaguá	18
3039	Paranapoema	18
3040	Paranavaí	18
3041	Pato Bragado	18
3042	Pato Branco	18
3043	Paula Freitas	18
3044	Paulo Frontin	18
3045	Peabiru	18
3046	Perobal	18
3047	Pérola	18
3048	Pérola d"Oeste	18
3049	Piên	18
3050	Pinhais	18
3051	Pinhal de São Bento	18
3052	Pinhalão	18
3053	Pinhão	18
3054	Piraí do Sul	18
3055	Piraquara	18
3056	Pitanga	18
3057	Pitangueiras	18
3058	Planaltina do Paraná	18
3059	Planalto	18
3060	Ponta Grossa	18
3061	Pontal do Paraná	18
3062	Porecatu	18
3063	Porto Amazonas	18
3064	Porto Barreiro	18
3065	Porto Rico	18
3066	Porto Vitória	18
3067	Prado Ferreira	18
3068	Pranchita	18
3069	Presidente Castelo Branco	18
3070	Primeiro de Maio	18
3071	Prudentópolis	18
3072	Quarto Centenário	18
3073	Quatiguá	18
3074	Quatro Barras	18
3075	Quatro Pontes	18
3076	Quedas do Iguaçu	18
3077	Querência do Norte	18
3078	Quinta do Sol	18
3079	Quitandinha	18
3080	Ramilândia	18
3081	Rancho Alegre	18
3082	Rancho Alegre d"Oeste	18
3083	Realeza	18
3084	Rebouças	18
3085	Renascença	18
3086	Reserva	18
3087	Reserva do Iguaçu	18
3088	Ribeirão Claro	18
3089	Ribeirão do Pinhal	18
3090	Rio Azul	18
3091	Rio Bom	18
3092	Rio Bonito do Iguaçu	18
3093	Rio Branco do Ivaí	18
3094	Rio Branco do Sul	18
3095	Rio Negro	18
3096	Rolândia	18
3097	Roncador	18
3098	Rondon	18
3099	Rosário do Ivaí	18
3100	Sabáudia	18
3101	Salgado Filho	18
3102	Salto do Itararé	18
3103	Salto do Lontra	18
3104	Santa Amélia	18
3105	Santa Cecília do Pavão	18
3106	Santa Cruz de Monte Castelo	18
3107	Santa Fé	18
3108	Santa Helena	18
3109	Santa Inês	18
3110	Santa Isabel do Ivaí	18
3111	Santa Izabel do Oeste	18
3112	Santa Lúcia	18
3113	Santa Maria do Oeste	18
3114	Santa Mariana	18
3115	Santa Mônica	18
3116	Santa Tereza do Oeste	18
3117	Santa Terezinha de Itaipu	18
3118	Santana do Itararé	18
3119	Santo Antônio da Platina	18
3120	Santo Antônio do Caiuá	18
3121	Santo Antônio do Paraíso	18
3122	Santo Antônio do Sudoeste	18
3123	Santo Inácio	18
3124	São Carlos do Ivaí	18
3125	São Jerônimo da Serra	18
3126	São João	18
3127	São João do Caiuá	18
3128	São João do Ivaí	18
3129	São João do Triunfo	18
3130	São Jorge d"Oeste	18
3131	São Jorge do Ivaí	18
3132	São Jorge do Patrocínio	18
3133	São José da Boa Vista	18
3134	São José das Palmeiras	18
3135	São José dos Pinhais	18
3136	São Manoel do Paraná	18
3137	São Mateus do Sul	18
3138	São Miguel do Iguaçu	18
3139	São Pedro do Iguaçu	18
3140	São Pedro do Ivaí	18
3141	São Pedro do Paraná	18
3142	São Sebastião da Amoreira	18
3143	São Tomé	18
3144	Sapopema	18
3145	Sarandi	18
3146	Saudade do Iguaçu	18
3147	Sengés	18
3148	Serranópolis do Iguaçu	18
3149	Sertaneja	18
3150	Sertanópolis	18
3151	Siqueira Campos	18
3152	Sulina	18
3153	Tamarana	18
3154	Tamboara	18
3155	Tapejara	18
3156	Tapira	18
3157	Teixeira Soares	18
3158	Telêmaco Borba	18
3159	Terra Boa	18
3160	Terra Rica	18
3161	Terra Roxa	18
3162	Tibagi	18
3163	Tijucas do Sul	18
3164	Toledo	18
3165	Tomazina	18
3166	Três Barras do Paraná	18
3167	Tunas do Paraná	18
3168	Tuneiras do Oeste	18
3169	Tupãssi	18
3170	Turvo	18
3171	Ubiratã	18
3172	Umuarama	18
3173	União da Vitória	18
3174	Uniflor	18
3175	Uraí	18
3176	Ventania	18
3177	Vera Cruz do Oeste	18
3178	Verê	18
3179	Virmond	18
3180	Vitorino	18
3181	Wenceslau Braz	18
3182	Xambrê	18
3183	Abreu e Lima	16
3184	Afogados da Ingazeira	16
3185	Afrânio	16
3186	Agrestina	16
3187	Água Preta	16
3188	Águas Belas	16
3189	Alagoinha	16
3190	Aliança	16
3191	Altinho	16
3192	Amaraji	16
3193	Angelim	16
3194	Araçoiaba	16
3195	Araripina	16
3196	Arcoverde	16
3197	Barra de Guabiraba	16
3198	Barreiros	16
3199	Belém de Maria	16
3200	Belém de São Francisco	16
3201	Belo Jardim	16
3202	Betânia	16
3203	Bezerros	16
3204	Bodocó	16
3205	Bom Conselho	16
3206	Bom Jardim	16
3207	Bonito	16
3208	Brejão	16
3209	Brejinho	16
3210	Brejo da Madre de Deus	16
3211	Buenos Aires	16
3212	Buíque	16
3213	Cabo de Santo Agostinho	16
3214	Cabrobó	16
3215	Cachoeirinha	16
3216	Caetés	16
3217	Calçado	16
3218	Calumbi	16
3219	Camaragibe	16
3220	Camocim de São Félix	16
3221	Camutanga	16
3222	Canhotinho	16
3223	Capoeiras	16
3224	Carnaíba	16
3225	Carnaubeira da Penha	16
3226	Carpina	16
3227	Caruaru	16
3228	Casinhas	16
3229	Catende	16
3230	Cedro	16
3231	Chã de Alegria	16
3232	Chã Grande	16
3233	Condado	16
3234	Correntes	16
3235	Cortês	16
3236	Cumaru	16
3237	Cupira	16
3238	Custódia	16
3239	Dormentes	16
3240	Escada	16
3241	Exu	16
3242	Feira Nova	16
3243	Fernando de Noronha	16
3244	Ferreiros	16
3245	Flores	16
3246	Floresta	16
3247	Frei Miguelinho	16
3248	Gameleira	16
3249	Garanhuns	16
3250	Glória do Goitá	16
3251	Goiana	16
3252	Granito	16
3253	Gravatá	16
3254	Iati	16
3255	Ibimirim	16
3256	Ibirajuba	16
3257	Igarassu	16
3258	Iguaraci	16
3259	Ilha de Itamaracá	16
3260	Inajá	16
3261	Ingazeira	16
3262	Ipojuca	16
3263	Ipubi	16
3264	Itacuruba	16
3265	Itaíba	16
3266	Itambé	16
3267	Itapetim	16
3268	Itapissuma	16
3269	Itaquitinga	16
3270	Jaboatão dos Guararapes	16
3271	Jaqueira	16
3272	Jataúba	16
3273	Jatobá	16
3274	João Alfredo	16
3275	Joaquim Nabuco	16
3276	Jucati	16
3277	Jupi	16
3278	Jurema	16
3279	Lagoa do Carro	16
3280	Lagoa do Itaenga	16
3281	Lagoa do Ouro	16
3282	Lagoa dos Gatos	16
3283	Lagoa Grande	16
3284	Lajedo	16
3285	Limoeiro	16
3286	Macaparana	16
3287	Machados	16
3288	Manari	16
3289	Maraial	16
3290	Mirandiba	16
3291	Moreilândia	16
3292	Moreno	16
3293	Nazaré da Mata	16
3294	Olinda	16
3295	Orobó	16
3296	Orocó	16
3297	Ouricuri	16
3298	Palmares	16
3299	Palmeirina	16
3300	Panelas	16
3301	Paranatama	16
3302	Parnamirim	16
3303	Passira	16
3304	Paudalho	16
3305	Paulista	16
3306	Pedra	16
3307	Pesqueira	16
3308	Petrolândia	16
3309	Petrolina	16
3310	Poção	16
3311	Pombos	16
3312	Primavera	16
3313	Quipapá	16
3314	Quixaba	16
3315	Recife	16
3316	Riacho das Almas	16
3317	Ribeirão	16
3318	Rio Formoso	16
3319	Sairé	16
3320	Salgadinho	16
3321	Salgueiro	16
3322	Saloá	16
3323	Sanharó	16
3324	Santa Cruz	16
3325	Santa Cruz da Baixa Verde	16
3326	Santa Cruz do Capibaribe	16
3327	Santa Filomena	16
3328	Santa Maria da Boa Vista	16
3329	Santa Maria do Cambucá	16
3330	Santa Terezinha	16
3331	São Benedito do Sul	16
3332	São Bento do Una	16
3333	São Caitano	16
3334	São João	16
3335	São Joaquim do Monte	16
3336	São José da Coroa Grande	16
3337	São José do Belmonte	16
3338	São José do Egito	16
3339	São Lourenço da Mata	16
3340	São Vicente Ferrer	16
3341	Serra Talhada	16
3342	Serrita	16
3343	Sertânia	16
3344	Sirinhaém	16
3345	Solidão	16
3346	Surubim	16
3347	Tabira	16
3348	Tacaimbó	16
3349	Tacaratu	16
3350	Tamandaré	16
3351	Taquaritinga do Norte	16
3352	Terezinha	16
3353	Terra Nova	16
3354	Timbaúba	16
3355	Toritama	16
3356	Tracunhaém	16
3357	Trindade	16
3358	Triunfo	16
3359	Tupanatinga	16
3360	Tuparetama	16
3361	Venturosa	16
3362	Verdejante	16
3363	Vertente do Lério	16
3364	Vertentes	16
3365	Vicência	16
3366	Vitória de Santo Antão	16
3367	Xexéu	16
3368	Acauã	17
3369	Agricolândia	17
3370	Água Branca	17
3371	Alagoinha do Piauí	17
3372	Alegrete do Piauí	17
3373	Alto Longá	17
3374	Altos	17
3375	Alvorada do Gurguéia	17
3376	Amarante	17
3377	Angical do Piauí	17
3378	Anísio de Abreu	17
3379	Antônio Almeida	17
3380	Aroazes	17
3381	Aroeiras do Itaim	17
3382	Arraial	17
3383	Assunção do Piauí	17
3384	Avelino Lopes	17
3385	Baixa Grande do Ribeiro	17
3386	Barra d"Alcântara	17
3387	Barras	17
3388	Barreiras do Piauí	17
3389	Barro Duro	17
3390	Batalha	17
3391	Bela Vista do Piauí	17
3392	Belém do Piauí	17
3393	Beneditinos	17
3394	Bertolínia	17
3395	Betânia do Piauí	17
3396	Boa Hora	17
3397	Bocaina	17
3398	Bom Jesus	17
3399	Bom Princípio do Piauí	17
3400	Bonfim do Piauí	17
3401	Boqueirão do Piauí	17
3402	Brasileira	17
3403	Brejo do Piauí	17
3404	Buriti dos Lopes	17
3405	Buriti dos Montes	17
3406	Cabeceiras do Piauí	17
3407	Cajazeiras do Piauí	17
3408	Cajueiro da Praia	17
3409	Caldeirão Grande do Piauí	17
3410	Campinas do Piauí	17
3411	Campo Alegre do Fidalgo	17
3412	Campo Grande do Piauí	17
3413	Campo Largo do Piauí	17
3414	Campo Maior	17
3415	Canavieira	17
3416	Canto do Buriti	17
3417	Capitão de Campos	17
3418	Capitão Gervásio Oliveira	17
3419	Caracol	17
3420	Caraúbas do Piauí	17
3421	Caridade do Piauí	17
3422	Castelo do Piauí	17
3423	Caxingó	17
3424	Cocal	17
3425	Cocal de Telha	17
3426	Cocal dos Alves	17
3427	Coivaras	17
3428	Colônia do Gurguéia	17
3429	Colônia do Piauí	17
3430	Conceição do Canindé	17
3431	Coronel José Dias	17
3432	Corrente	17
3433	Cristalândia do Piauí	17
3434	Cristino Castro	17
3435	Curimatá	17
3436	Currais	17
3437	Curral Novo do Piauí	17
3438	Curralinhos	17
3439	Demerval Lobão	17
3440	Dirceu Arcoverde	17
3441	Dom Expedito Lopes	17
3442	Dom Inocêncio	17
3443	Domingos Mourão	17
3444	Elesbão Veloso	17
3445	Eliseu Martins	17
3446	Esperantina	17
3447	Fartura do Piauí	17
3448	Flores do Piauí	17
3449	Floresta do Piauí	17
3450	Floriano	17
3451	Francinópolis	17
3452	Francisco Ayres	17
3453	Francisco Macedo	17
3454	Francisco Santos	17
3455	Fronteiras	17
3456	Geminiano	17
3457	Gilbués	17
3458	Guadalupe	17
3459	Guaribas	17
3460	Hugo Napoleão	17
3461	Ilha Grande	17
3462	Inhuma	17
3463	Ipiranga do Piauí	17
3464	Isaías Coelho	17
3465	Itainópolis	17
3466	Itaueira	17
3467	Jacobina do Piauí	17
3468	Jaicós	17
3469	Jardim do Mulato	17
3470	Jatobá do Piauí	17
3471	Jerumenha	17
3472	João Costa	17
3473	Joaquim Pires	17
3474	Joca Marques	17
3475	José de Freitas	17
3476	Juazeiro do Piauí	17
3477	Júlio Borges	17
3478	Jurema	17
3479	Lagoa Alegre	17
3480	Lagoa de São Francisco	17
3481	Lagoa do Barro do Piauí	17
3482	Lagoa do Piauí	17
3483	Lagoa do Sítio	17
3484	Lagoinha do Piauí	17
3485	Landri Sales	17
3486	Luís Correia	17
3487	Luzilândia	17
3488	Madeiro	17
3489	Manoel Emídio	17
3490	Marcolândia	17
3491	Marcos Parente	17
3492	Massapê do Piauí	17
3493	Matias Olímpio	17
3494	Miguel Alves	17
3495	Miguel Leão	17
3496	Milton Brandão	17
3497	Monsenhor Gil	17
3498	Monsenhor Hipólito	17
3499	Monte Alegre do Piauí	17
3500	Morro Cabeça no Tempo	17
3501	Morro do Chapéu do Piauí	17
3502	Murici dos Portelas	17
3503	Nazaré do Piauí	17
3504	Nossa Senhora de Nazaré	17
3505	Nossa Senhora dos Remédios	17
3506	Nova Santa Rita	17
3507	Novo Oriente do Piauí	17
3508	Novo Santo Antônio	17
3509	Oeiras	17
3510	Olho d"Água do Piauí	17
3511	Padre Marcos	17
3512	Paes Landim	17
3513	Pajeú do Piauí	17
3514	Palmeira do Piauí	17
3515	Palmeirais	17
3516	Paquetá	17
3517	Parnaguá	17
3518	Parnaíba	17
3519	Passagem Franca do Piauí	17
3520	Patos do Piauí	17
3521	Pau d"Arco do Piauí	17
3522	Paulistana	17
3523	Pavussu	17
3524	Pedro II	17
3525	Pedro Laurentino	17
3526	Picos	17
3527	Pimenteiras	17
3528	Pio IX	17
3529	Piracuruca	17
3530	Piripiri	17
3531	Porto	17
3532	Porto Alegre do Piauí	17
3533	Prata do Piauí	17
3534	Queimada Nova	17
3535	Redenção do Gurguéia	17
3536	Regeneração	17
3537	Riacho Frio	17
3538	Ribeira do Piauí	17
3539	Ribeiro Gonçalves	17
3540	Rio Grande do Piauí	17
3541	Santa Cruz do Piauí	17
3542	Santa Cruz dos Milagres	17
3543	Santa Filomena	17
3544	Santa Luz	17
3545	Santa Rosa do Piauí	17
3546	Santana do Piauí	17
3547	Santo Antônio de Lisboa	17
3548	Santo Antônio dos Milagres	17
3549	Santo Inácio do Piauí	17
3550	São Braz do Piauí	17
3551	São Félix do Piauí	17
3552	São Francisco de Assis do Piauí	17
3553	São Francisco do Piauí	17
3554	São Gonçalo do Gurguéia	17
3555	São Gonçalo do Piauí	17
3556	São João da Canabrava	17
3557	São João da Fronteira	17
3558	São João da Serra	17
3559	São João da Varjota	17
3560	São João do Arraial	17
3561	São João do Piauí	17
3562	São José do Divino	17
3563	São José do Peixe	17
3564	São José do Piauí	17
3565	São Julião	17
3566	São Lourenço do Piauí	17
3567	São Luis do Piauí	17
3568	São Miguel da Baixa Grande	17
3569	São Miguel do Fidalgo	17
3570	São Miguel do Tapuio	17
3571	São Pedro do Piauí	17
3572	São Raimundo Nonato	17
3573	Sebastião Barros	17
3574	Sebastião Leal	17
3575	Sigefredo Pacheco	17
3576	Simões	17
3577	Simplício Mendes	17
3578	Socorro do Piauí	17
3579	Sussuapara	17
3580	Tamboril do Piauí	17
3581	Tanque do Piauí	17
3582	Teresina	17
3583	União	17
3584	Uruçuí	17
3585	Valença do Piauí	17
3586	Várzea Branca	17
3587	Várzea Grande	17
3588	Vera Mendes	17
3589	Vila Nova do Piauí	17
3590	Wall Ferraz	17
3591	Angra dos Reis	19
3592	Aperibé	19
3593	Araruama	19
3594	Areal	19
3595	Armação dos Búzios	19
3596	Arraial do Cabo	19
3597	Barra do Piraí	19
3598	Barra Mansa	19
3599	Belford Roxo	19
3600	Bom Jardim	19
3601	Bom Jesus do Itabapoana	19
3602	Cabo Frio	19
3603	Cachoeiras de Macacu	19
3604	Cambuci	19
3605	Campos dos Goytacazes	19
3606	Cantagalo	19
3607	Carapebus	19
3608	Cardoso Moreira	19
3609	Carmo	19
3610	Casimiro de Abreu	19
3611	Comendador Levy Gasparian	19
3612	Conceição de Macabu	19
3613	Cordeiro	19
3614	Duas Barras	19
3615	Duque de Caxias	19
3616	Engenheiro Paulo de Frontin	19
3617	Guapimirim	19
3618	Iguaba Grande	19
3619	Itaboraí	19
3620	Itaguaí	19
3621	Italva	19
3622	Itaocara	19
3623	Itaperuna	19
3624	Itatiaia	19
3625	Japeri	19
3626	Laje do Muriaé	19
3627	Macaé	19
3628	Macuco	19
3629	Magé	19
3630	Mangaratiba	19
3631	Maricá	19
3632	Mendes	19
3633	Mesquita	19
3634	Miguel Pereira	19
3635	Miracema	19
3636	Natividade	19
3637	Nilópolis	19
3638	Niterói	19
3639	Nova Friburgo	19
3640	Nova Iguaçu	19
3641	Paracambi	19
3642	Paraíba do Sul	19
3643	Parati	19
3644	Paty do Alferes	19
3645	Petrópolis	19
3646	Pinheiral	19
3647	Piraí	19
3648	Porciúncula	19
3649	Porto Real	19
3650	Quatis	19
3651	Queimados	19
3652	Quissamã	19
3653	Resende	19
3654	Rio Bonito	19
3655	Rio Claro	19
3656	Rio das Flores	19
3657	Rio das Ostras	19
3658	Rio de Janeiro	19
3659	Santa Maria Madalena	19
3660	Santo Antônio de Pádua	19
3661	São Fidélis	19
3662	São Francisco de Itabapoana	19
3663	São Gonçalo	19
3664	São João da Barra	19
3665	São João de Meriti	19
3666	São José de Ubá	19
3667	São José do Vale do Rio Pret	19
3668	São Pedro da Aldeia	19
3669	São Sebastião do Alto	19
3670	Sapucaia	19
3671	Saquarema	19
3672	Seropédica	19
3673	Silva Jardim	19
3674	Sumidouro	19
3675	Tanguá	19
3676	Teresópolis	19
3677	Trajano de Morais	19
3678	Três Rios	19
3679	Valença	19
3680	Varre-Sai	19
3681	Vassouras	19
3682	Volta Redonda	19
3683	Acari	20
3684	Açu	20
3685	Afonso Bezerra	20
3686	Água Nova	20
3687	Alexandria	20
3688	Almino Afonso	20
3689	Alto do Rodrigues	20
3690	Angicos	20
3691	Antônio Martins	20
3692	Apodi	20
3693	Areia Branca	20
3694	Arês	20
3695	Augusto Severo	20
3696	Baía Formosa	20
3697	Baraúna	20
3698	Barcelona	20
3699	Bento Fernandes	20
3700	Bodó	20
3701	Bom Jesus	20
3702	Brejinho	20
3703	Caiçara do Norte	20
3704	Caiçara do Rio do Vento	20
3705	Caicó	20
3706	Campo Redondo	20
3707	Canguaretama	20
3708	Caraúbas	20
3709	Carnaúba dos Dantas	20
3710	Carnaubais	20
3711	Ceará-Mirim	20
3712	Cerro Corá	20
3713	Coronel Ezequiel	20
3714	Coronel João Pessoa	20
3715	Cruzeta	20
3716	Currais Novos	20
3717	Doutor Severiano	20
3718	Encanto	20
3719	Equador	20
3720	Espírito Santo	20
3721	Extremoz	20
3722	Felipe Guerra	20
3723	Fernando Pedroza	20
3724	Florânia	20
3725	Francisco Dantas	20
3726	Frutuoso Gomes	20
3727	Galinhos	20
3728	Goianinha	20
3729	Governador Dix-Sept Rosado	20
3730	Grossos	20
3731	Guamaré	20
3732	Ielmo Marinho	20
3733	Ipanguaçu	20
3734	Ipueira	20
3735	Itajá	20
3736	Itaú	20
3737	Jaçanã	20
3738	Jandaíra	20
3739	Janduís	20
3740	Januário Cicco	20
3741	Japi	20
3742	Jardim de Angicos	20
3743	Jardim de Piranhas	20
3744	Jardim do Seridó	20
3745	João Câmara	20
3746	João Dias	20
3747	José da Penha	20
3748	Jucurutu	20
3749	Jundiá	20
3750	Lagoa d"Anta	20
3751	Lagoa de Pedras	20
3752	Lagoa de Velhos	20
3753	Lagoa Nova	20
3754	Lagoa Salgada	20
3755	Lajes	20
3756	Lajes Pintadas	20
3757	Lucrécia	20
3758	Luís Gomes	20
3759	Macaíba	20
3760	Macau	20
3761	Major Sales	20
3762	Marcelino Vieira	20
3763	Martins	20
3764	Maxaranguape	20
3765	Messias Targino	20
3766	Montanhas	20
3767	Monte Alegre	20
3768	Monte das Gameleiras	20
3769	Mossoró	20
3770	Natal	20
3771	Nísia Floresta	20
3772	Nova Cruz	20
3773	Olho-d"Água do Borges	20
3774	Ouro Branco	20
3775	Paraná	20
3776	Paraú	20
3777	Parazinho	20
3778	Parelhas	20
3779	Parnamirim	20
3780	Passa e Fica	20
3781	Passagem	20
3782	Patu	20
3783	Pau dos Ferros	20
3784	Pedra Grande	20
3785	Pedra Preta	20
3786	Pedro Avelino	20
3787	Pedro Velho	20
3788	Pendências	20
3789	Pilões	20
3790	Poço Branco	20
3791	Portalegre	20
3792	Porto do Mangue	20
3793	Presidente Juscelino	20
3794	Pureza	20
3795	Rafael Fernandes	20
3796	Rafael Godeiro	20
3797	Riacho da Cruz	20
3798	Riacho de Santana	20
3799	Riachuelo	20
3800	Rio do Fogo	20
3801	Rodolfo Fernandes	20
3802	Ruy Barbosa	20
3803	Santa Cruz	20
3804	Santa Maria	20
3805	Santana do Matos	20
3806	Santana do Seridó	20
3807	Santo Antônio	20
3808	São Bento do Norte	20
3809	São Bento do Trairí	20
3810	São Fernando	20
3811	São Francisco do Oeste	20
3812	São Gonçalo do Amarante	20
3813	São João do Sabugi	20
3814	São José de Mipibu	20
3815	São José do Campestre	20
3816	São José do Seridó	20
3817	São Miguel	20
3818	São Miguel do Gostoso	20
3819	São Paulo do Potengi	20
3820	São Pedro	20
3821	São Rafael	20
3822	São Tomé	20
3823	São Vicente	20
3824	Senador Elói de Souza	20
3825	Senador Georgino Avelino	20
3826	Serra de São Bento	20
3827	Serra do Mel	20
3828	Serra Negra do Norte	20
3829	Serrinha	20
3830	Serrinha dos Pintos	20
3831	Severiano Melo	20
3832	Sítio Novo	20
3833	Taboleiro Grande	20
3834	Taipu	20
3835	Tangará	20
3836	Tenente Ananias	20
3837	Tenente Laurentino Cruz	20
3838	Tibau	20
3839	Tibau do Sul	20
3840	Timbaúba dos Batistas	20
3841	Touros	20
3842	Triunfo Potiguar	20
3843	Umarizal	20
3844	Upanema	20
3845	Várzea	20
3846	Venha-Ver	20
3847	Vera Cruz	20
3848	Viçosa	20
3849	Vila Flor	20
3850	Aceguá	23
3851	Água Santa	23
3852	Agudo	23
3853	Ajuricaba	23
3854	Alecrim	23
3855	Alegrete	23
3856	Alegria	23
3857	Almirante Tamandaré do Sul	23
3858	Alpestre	23
3859	Alto Alegre	23
3860	Alto Feliz	23
3861	Alvorada	23
3862	Amaral Ferrador	23
3863	Ametista do Sul	23
3864	André da Rocha	23
3865	Anta Gorda	23
3866	Antônio Prado	23
3867	Arambaré	23
3868	Araricá	23
3869	Aratiba	23
3870	Arroio do Meio	23
3871	Arroio do Padre	23
3872	Arroio do Sal	23
3873	Arroio do Tigre	23
3874	Arroio dos Ratos	23
3875	Arroio Grande	23
3876	Arvorezinha	23
3877	Augusto Pestana	23
3878	Áurea	23
3879	Bagé	23
3880	Balneário Pinhal	23
3881	Barão	23
3882	Barão de Cotegipe	23
3883	Barão do Triunfo	23
3884	Barra do Guarita	23
3885	Barra do Quaraí	23
3886	Barra do Ribeiro	23
3887	Barra do Rio Azul	23
3888	Barra Funda	23
3889	Barracão	23
3890	Barros Cassal	23
3891	Benjamin Constant do Sul	23
3892	Bento Gonçalves	23
3893	Boa Vista das Missões	23
3894	Boa Vista do Buricá	23
3895	Boa Vista do Cadeado	23
3896	Boa Vista do Incra	23
3897	Boa Vista do Sul	23
3898	Bom Jesus	23
3899	Bom Princípio	23
3900	Bom Progresso	23
3901	Bom Retiro do Sul	23
3902	Boqueirão do Leão	23
3903	Bossoroca	23
3904	Bozano	23
3905	Braga	23
3906	Brochier	23
3907	Butiá	23
3908	Caçapava do Sul	23
3909	Cacequi	23
3910	Cachoeira do Sul	23
3911	Cachoeirinha	23
3912	Cacique Doble	23
3913	Caibaté	23
3914	Caiçara	23
3915	Camaquã	23
3916	Camargo	23
3917	Cambará do Sul	23
3918	Campestre da Serra	23
3919	Campina das Missões	23
3920	Campinas do Sul	23
3921	Campo Bom	23
3922	Campo Novo	23
3923	Campos Borges	23
3924	Candelária	23
3925	Cândido Godói	23
3926	Candiota	23
3927	Canela	23
3928	Canguçu	23
3929	Canoas	23
3930	Canudos do Vale	23
3931	Capão Bonito do Sul	23
3932	Capão da Canoa	23
3933	Capão do Cipó	23
3934	Capão do Leão	23
3935	Capela de Santana	23
3936	Capitão	23
3937	Capivari do Sul	23
3938	Caraá	23
3939	Carazinho	23
3940	Carlos Barbosa	23
3941	Carlos Gomes	23
3942	Casca	23
3943	Caseiros	23
3944	Catuípe	23
3945	Caxias do Sul	23
3946	Centenário	23
3947	Cerrito	23
3948	Cerro Branco	23
3949	Cerro Grande	23
3950	Cerro Grande do Sul	23
3951	Cerro Largo	23
3952	Chapada	23
3953	Charqueadas	23
3954	Charrua	23
3955	Chiapeta	23
3956	Chuí	23
3957	Chuvisca	23
3958	Cidreira	23
3959	Ciríaco	23
3960	Colinas	23
3961	Colorado	23
3962	Condor	23
3963	Constantina	23
3964	Coqueiro Baixo	23
3965	Coqueiros do Sul	23
3966	Coronel Barros	23
3967	Coronel Bicaco	23
3968	Coronel Pilar	23
3969	Cotiporã	23
3970	Coxilha	23
3971	Crissiumal	23
3972	Cristal	23
3973	Cristal do Sul	23
3974	Cruz Alta	23
3975	Cruzaltense	23
3976	Cruzeiro do Sul	23
3977	David Canabarro	23
3978	Derrubadas	23
3979	Dezesseis de Novembro	23
3980	Dilermando de Aguiar	23
3981	Dois Irmãos	23
3982	Dois Irmãos das Missões	23
3983	Dois Lajeados	23
3984	Dom Feliciano	23
3985	Dom Pedrito	23
3986	Dom Pedro de Alcântara	23
3987	Dona Francisca	23
3988	Doutor Maurício Cardoso	23
3989	Doutor Ricardo	23
3990	Eldorado do Sul	23
3991	Encantado	23
3992	Encruzilhada do Sul	23
3993	Engenho Velho	23
3994	Entre Rios do Sul	23
3995	Entre-Ijuís	23
3996	Erebango	23
3997	Erechim	23
3998	Ernestina	23
3999	Erval Grande	23
4000	Erval Seco	23
4001	Esmeralda	23
4002	Esperança do Sul	23
4003	Espumoso	23
4004	Estação	23
4005	Estância Velha	23
4006	Esteio	23
4007	Estrela	23
4008	Estrela Velha	23
4009	Eugênio de Castro	23
4010	Fagundes Varela	23
4011	Farroupilha	23
4012	Faxinal do Soturno	23
4013	Faxinalzinho	23
4014	Fazenda Vilanova	23
4015	Feliz	23
4016	Flores da Cunha	23
4017	Floriano Peixoto	23
4018	Fontoura Xavier	23
4019	Formigueiro	23
4020	Forquetinha	23
4021	Fortaleza dos Valos	23
4022	Frederico Westphalen	23
4023	Garibaldi	23
4024	Garruchos	23
4025	Gaurama	23
4026	General Câmara	23
4027	Gentil	23
4028	Getúlio Vargas	23
4029	Giruá	23
4030	Glorinha	23
4031	Gramado	23
4032	Gramado dos Loureiros	23
4033	Gramado Xavier	23
4034	Gravataí	23
4035	Guabiju	23
4036	Guaíba	23
4037	Guaporé	23
4038	Guarani das Missões	23
4039	Harmonia	23
4040	Herval	23
4041	Herveiras	23
4042	Horizontina	23
4043	Hulha Negra	23
4044	Humaitá	23
4045	Ibarama	23
4046	Ibiaçá	23
4047	Ibiraiaras	23
4048	Ibirapuitã	23
4049	Ibirubá	23
4050	Igrejinha	23
4051	Ijuí	23
4052	Ilópolis	23
4053	Imbé	23
4054	Imigrante	23
4055	Independência	23
4056	Inhacorá	23
4057	Ipê	23
4058	Ipiranga do Sul	23
4059	Iraí	23
4060	Itaara	23
4061	Itacurubi	23
4062	Itapuca	23
4063	Itaqui	23
4064	Itati	23
4065	Itatiba do Sul	23
4066	Ivorá	23
4067	Ivoti	23
4068	Jaboticaba	23
4069	Jacuizinho	23
4070	Jacutinga	23
4071	Jaguarão	23
4072	Jaguari	23
4073	Jaquirana	23
4074	Jari	23
4075	Jóia	23
4076	Júlio de Castilhos	23
4077	Lagoa Bonita do Sul	23
4078	Lagoa dos Três Cantos	23
4079	Lagoa Vermelha	23
4080	Lagoão	23
4081	Lajeado	23
4082	Lajeado do Bugre	23
4083	Lavras do Sul	23
4084	Liberato Salzano	23
4085	Lindolfo Collor	23
4086	Linha Nova	23
4087	Maçambara	23
4088	Machadinho	23
4089	Mampituba	23
4090	Manoel Viana	23
4091	Maquiné	23
4092	Maratá	23
4093	Marau	23
4094	Marcelino Ramos	23
4095	Mariana Pimentel	23
4096	Mariano Moro	23
4097	Marques de Souza	23
4098	Mata	23
4099	Mato Castelhano	23
4100	Mato Leitão	23
4101	Mato Queimado	23
4102	Maximiliano de Almeida	23
4103	Minas do Leão	23
4104	Miraguaí	23
4105	Montauri	23
4106	Monte Alegre dos Campos	23
4107	Monte Belo do Sul	23
4108	Montenegro	23
4109	Mormaço	23
4110	Morrinhos do Sul	23
4111	Morro Redondo	23
4112	Morro Reuter	23
4113	Mostardas	23
4114	Muçum	23
4115	Muitos Capões	23
4116	Muliterno	23
4117	Não-Me-Toque	23
4118	Nicolau Vergueiro	23
4119	Nonoai	23
4120	Nova Alvorada	23
4121	Nova Araçá	23
4122	Nova Bassano	23
4123	Nova Boa Vista	23
4124	Nova Bréscia	23
4125	Nova Candelária	23
4126	Nova Esperança do Sul	23
4127	Nova Hartz	23
4128	Nova Pádua	23
4129	Nova Palma	23
4130	Nova Petrópolis	23
4131	Nova Prata	23
4132	Nova Ramada	23
4133	Nova Roma do Sul	23
4134	Nova Santa Rita	23
4135	Novo Barreiro	23
4136	Novo Cabrais	23
4137	Novo Hamburgo	23
4138	Novo Machado	23
4139	Novo Tiradentes	23
4140	Novo Xingu	23
4141	Osório	23
4142	Paim Filho	23
4143	Palmares do Sul	23
4144	Palmeira das Missões	23
4145	Palmitinho	23
4146	Panambi	23
4147	Pantano Grande	23
4148	Paraí	23
4149	Paraíso do Sul	23
4150	Pareci Novo	23
4151	Parobé	23
4152	Passa Sete	23
4153	Passo do Sobrado	23
4154	Passo Fundo	23
4155	Paulo Bento	23
4156	Paverama	23
4157	Pedras Altas	23
4158	Pedro Osório	23
4159	Pejuçara	23
4160	Pelotas	23
4161	Picada Café	23
4162	Pinhal	23
4163	Pinhal da Serra	23
4164	Pinhal Grande	23
4165	Pinheirinho do Vale	23
4166	Pinheiro Machado	23
4167	Pirapó	23
4168	Piratini	23
4169	Planalto	23
4170	Poço das Antas	23
4171	Pontão	23
4172	Ponte Preta	23
4173	Portão	23
4174	Porto Alegre	23
4175	Porto Lucena	23
4176	Porto Mauá	23
4177	Porto Vera Cruz	23
4178	Porto Xavier	23
4179	Pouso Novo	23
4180	Presidente Lucena	23
4181	Progresso	23
4182	Protásio Alves	23
4183	Putinga	23
4184	Quaraí	23
4185	Quatro Irmãos	23
4186	Quevedos	23
4187	Quinze de Novembro	23
4188	Redentora	23
4189	Relvado	23
4190	Restinga Seca	23
4191	Rio dos Índios	23
4192	Rio Grande	23
4193	Rio Pardo	23
4194	Riozinho	23
4195	Roca Sales	23
4196	Rodeio Bonito	23
4197	Rolador	23
4198	Rolante	23
4199	Ronda Alta	23
4200	Rondinha	23
4201	Roque Gonzales	23
4202	Rosário do Sul	23
4203	Sagrada Família	23
4204	Saldanha Marinho	23
4205	Salto do Jacuí	23
4206	Salvador das Missões	23
4207	Salvador do Sul	23
4208	Sananduva	23
4209	Santa Bárbara do Sul	23
4210	Santa Cecília do Sul	23
4211	Santa Clara do Sul	23
4212	Santa Cruz do Sul	23
4213	Santa Margarida do Sul	23
4214	Santa Maria	23
4215	Santa Maria do Herval	23
4216	Santa Rosa	23
4217	Santa Tereza	23
4218	Santa Vitória do Palmar	23
4219	Santana da Boa Vista	23
4220	Santana do Livramento	23
4221	Santiago	23
4222	Santo Ângelo	23
4223	Santo Antônio da Patrulha	23
4224	Santo Antônio das Missões	23
4225	Santo Antônio do Palma	23
4226	Santo Antônio do Planalto	23
4227	Santo Augusto	23
4228	Santo Cristo	23
4229	Santo Expedito do Sul	23
4230	São Borja	23
4231	São Domingos do Sul	23
4232	São Francisco de Assis	23
4233	São Francisco de Paula	23
4234	São Gabriel	23
4235	São Jerônimo	23
4236	São João da Urtiga	23
4237	São João do Polêsine	23
4238	São Jorge	23
4239	São José das Missões	23
4240	São José do Herval	23
4241	São José do Hortêncio	23
4242	São José do Inhacorá	23
4243	São José do Norte	23
4244	São José do Ouro	23
4245	São José do Sul	23
4246	São José dos Ausentes	23
4247	São Leopoldo	23
4248	São Lourenço do Sul	23
4249	São Luiz Gonzaga	23
4250	São Marcos	23
4251	São Martinho	23
4252	São Martinho da Serra	23
4253	São Miguel das Missões	23
4254	São Nicolau	23
4255	São Paulo das Missões	23
4256	São Pedro da Serra	23
4257	São Pedro das Missões	23
4258	São Pedro do Butiá	23
4259	São Pedro do Sul	23
4260	São Sebastião do Caí	23
4261	São Sepé	23
4262	São Valentim	23
4263	São Valentim do Sul	23
4264	São Valério do Sul	23
4265	São Vendelino	23
4266	São Vicente do Sul	23
4267	Sapiranga	23
4268	Sapucaia do Sul	23
4269	Sarandi	23
4270	Seberi	23
4271	Sede Nova	23
4272	Segredo	23
4273	Selbach	23
4274	Senador Salgado Filho	23
4275	Sentinela do Sul	23
4276	Serafina Corrêa	23
4277	Sério	23
4278	Sertão	23
4279	Sertão Santana	23
4280	Sete de Setembro	23
4281	Severiano de Almeida	23
4282	Silveira Martins	23
4283	Sinimbu	23
4284	Sobradinho	23
4285	Soledade	23
4286	Tabaí	23
4287	Tapejara	23
4288	Tapera	23
4289	Tapes	23
4290	Taquara	23
4291	Taquari	23
4292	Taquaruçu do Sul	23
4293	Tavares	23
4294	Tenente Portela	23
4295	Terra de Areia	23
4296	Teutônia	23
4297	Tio Hugo	23
4298	Tiradentes do Sul	23
4299	Toropi	23
4300	Torres	23
4301	Tramandaí	23
4302	Travesseiro	23
4303	Três Arroios	23
4304	Três Cachoeiras	23
4305	Três Coroas	23
4306	Três de Maio	23
4307	Três Forquilhas	23
4308	Três Palmeiras	23
4309	Três Passos	23
4310	Trindade do Sul	23
4311	Triunfo	23
4312	Tucunduva	23
4313	Tunas	23
4314	Tupanci do Sul	23
4315	Tupanciretã	23
4316	Tupandi	23
4317	Tuparendi	23
4318	Turuçu	23
4319	Ubiretama	23
4320	União da Serra	23
4321	Unistalda	23
4322	Uruguaiana	23
4323	Vacaria	23
4324	Vale do Sol	23
4325	Vale Real	23
4326	Vale Verde	23
4327	Vanini	23
4328	Venâncio Aires	23
4329	Vera Cruz	23
4330	Veranópolis	23
4331	Vespasiano Correa	23
4332	Viadutos	23
4333	Viamão	23
4334	Vicente Dutra	23
4335	Victor Graeff	23
4336	Vila Flores	23
4337	Vila Lângaro	23
4338	Vila Maria	23
4339	Vila Nova do Sul	23
4340	Vista Alegre	23
4341	Vista Alegre do Prata	23
4342	Vista Gaúcha	23
4343	Vitória das Missões	23
4344	Westfália	23
4345	Xangri-lá	23
4346	Alta Floresta d"Oeste	21
4347	Alto Alegre dos Parecis	21
4348	Alto Paraíso	21
4349	Alvorada d"Oeste	21
4350	Ariquemes	21
4351	Buritis	21
4352	Cabixi	21
4353	Cacaulândia	21
4354	Cacoal	21
4355	Campo Novo de Rondônia	21
4356	Candeias do Jamari	21
4357	Castanheiras	21
4358	Cerejeiras	21
4359	Chupinguaia	21
4360	Colorado do Oeste	21
4361	Corumbiara	21
4362	Costa Marques	21
4363	Cujubim	21
4364	Espigão d"Oeste	21
4365	Governador Jorge Teixeira	21
4366	Guajará-Mirim	21
4367	Itapuã do Oeste	21
4368	Jaru	21
4369	Ji-Paraná	21
4370	Machadinho d"Oeste	21
4371	Ministro Andreazza	21
4372	Mirante da Serra	21
4373	Monte Negro	21
4374	Nova Brasilândia d"Oeste	21
4375	Nova Mamoré	21
4376	Nova União	21
4377	Novo Horizonte do Oeste	21
4378	Ouro Preto do Oeste	21
4379	Parecis	21
4380	Pimenta Bueno	21
4381	Pimenteiras do Oeste	21
4382	Porto Velho	21
4383	Presidente Médici	21
4384	Primavera de Rondônia	21
4385	Rio Crespo	21
4386	Rolim de Moura	21
4387	Santa Luzia d"Oeste	21
4388	São Felipe d"Oeste	21
4389	São Francisco do Guaporé	21
4390	São Miguel do Guaporé	21
4391	Seringueiras	21
4392	Teixeirópolis	21
4393	Theobroma	21
4394	Urupá	21
4395	Vale do Anari	21
4396	Vale do Paraíso	21
4397	Vilhena	21
4398	Alto Alegre	22
4399	Amajari	22
4400	Boa Vista	22
4401	Bonfim	22
4402	Cantá	22
4403	Caracaraí	22
4404	Caroebe	22
4405	Iracema	22
4406	Mucajaí	22
4407	Normandia	22
4408	Pacaraima	22
4409	Rorainópolis	22
4410	São João da Baliza	22
4411	São Luiz	22
4412	Uiramutã	22
4413	Abdon Batista	24
4414	Abelardo Luz	24
4415	Agrolândia	24
4416	Agronômica	24
4417	Água Doce	24
4418	Águas de Chapecó	24
4419	Águas Frias	24
4420	Águas Mornas	24
4421	Alfredo Wagner	24
4422	Alto Bela Vista	24
4423	Anchieta	24
4424	Angelina	24
4425	Anita Garibaldi	24
4426	Anitápolis	24
4427	Antônio Carlos	24
4428	Apiúna	24
4429	Arabutã	24
4430	Araquari	24
4431	Araranguá	24
4432	Armazém	24
4433	Arroio Trinta	24
4434	Arvoredo	24
4435	Ascurra	24
4436	Atalanta	24
4437	Aurora	24
4438	Balneário Arroio do Silva	24
4439	Balneário Barra do Sul	24
4440	Balneário Camboriú	24
4441	Balneário Gaivota	24
4442	Bandeirante	24
4443	Barra Bonita	24
4444	Barra Velha	24
4445	Bela Vista do Toldo	24
4446	Belmonte	24
4447	Benedito Novo	24
4448	Biguaçu	24
4449	Blumenau	24
4450	Bocaina do Sul	24
4451	Bom Jardim da Serra	24
4452	Bom Jesus	24
4453	Bom Jesus do Oeste	24
4454	Bom Retiro	24
4455	Bombinhas	24
4456	Botuverá	24
4457	Braço do Norte	24
4458	Braço do Trombudo	24
4459	Brunópolis	24
4460	Brusque	24
4461	Caçador	24
4462	Caibi	24
4463	Calmon	24
4464	Camboriú	24
4465	Campo Alegre	24
4466	Campo Belo do Sul	24
4467	Campo Erê	24
4468	Campos Novos	24
4469	Canelinha	24
4470	Canoinhas	24
4471	Capão Alto	24
4472	Capinzal	24
4473	Capivari de Baixo	24
4474	Catanduvas	24
4475	Caxambu do Sul	24
4476	Celso Ramos	24
4477	Cerro Negro	24
4478	Chapadão do Lageado	24
4479	Chapecó	24
4480	Cocal do Sul	24
4481	Concórdia	24
4482	Cordilheira Alta	24
4483	Coronel Freitas	24
4484	Coronel Martins	24
4485	Correia Pinto	24
4486	Corupá	24
4487	Criciúma	24
4488	Cunha Porã	24
4489	Cunhataí	24
4490	Curitibanos	24
4491	Descanso	24
4492	Dionísio Cerqueira	24
4493	Dona Emma	24
4494	Doutor Pedrinho	24
4495	Entre Rios	24
4496	Ermo	24
4497	Erval Velho	24
4498	Faxinal dos Guedes	24
4499	Flor do Sertão	24
4500	Florianópolis	24
4501	Formosa do Sul	24
4502	Forquilhinha	24
4503	Fraiburgo	24
4504	Frei Rogério	24
4505	Galvão	24
4506	Garopaba	24
4507	Garuva	24
4508	Gaspar	24
4509	Governador Celso Ramos	24
4510	Grão Pará	24
4511	Gravatal	24
4512	Guabiruba	24
4513	Guaraciaba	24
4514	Guaramirim	24
4515	Guarujá do Sul	24
4516	Guatambú	24
4517	Herval d"Oeste	24
4518	Ibiam	24
4519	Ibicaré	24
4520	Ibirama	24
4521	Içara	24
4522	Ilhota	24
4523	Imaruí	24
4524	Imbituba	24
4525	Imbuia	24
4526	Indaial	24
4527	Iomerê	24
4528	Ipira	24
4529	Iporã do Oeste	24
4530	Ipuaçu	24
4531	Ipumirim	24
4532	Iraceminha	24
4533	Irani	24
4534	Irati	24
4535	Irineópolis	24
4536	Itá	24
4537	Itaiópolis	24
4538	Itajaí	24
4539	Itapema	24
4540	Itapiranga	24
4541	Itapoá	24
4542	Ituporanga	24
4543	Jaborá	24
4544	Jacinto Machado	24
4545	Jaguaruna	24
4546	Jaraguá do Sul	24
4547	Jardinópolis	24
4548	Joaçaba	24
4549	Joinville	24
4550	José Boiteux	24
4551	Jupiá	24
4552	Lacerdópolis	24
4553	Lages	24
4554	Laguna	24
4555	Lajeado Grande	24
4556	Laurentino	24
4557	Lauro Muller	24
4558	Lebon Régis	24
4559	Leoberto Leal	24
4560	Lindóia do Sul	24
4561	Lontras	24
4562	Luiz Alves	24
4563	Luzerna	24
4564	Macieira	24
4565	Mafra	24
4566	Major Gercino	24
4567	Major Vieira	24
4568	Maracajá	24
4569	Maravilha	24
4570	Marema	24
4571	Massaranduba	24
4572	Matos Costa	24
4573	Meleiro	24
4574	Mirim Doce	24
4575	Modelo	24
4576	Mondaí	24
4577	Monte Carlo	24
4578	Monte Castelo	24
4579	Morro da Fumaça	24
4580	Morro Grande	24
4581	Navegantes	24
4582	Nova Erechim	24
4583	Nova Itaberaba	24
4584	Nova Trento	24
4585	Nova Veneza	24
4586	Novo Horizonte	24
4587	Orleans	24
4588	Otacílio Costa	24
4589	Ouro	24
4590	Ouro Verde	24
4591	Paial	24
4592	Painel	24
4593	Palhoça	24
4594	Palma Sola	24
4595	Palmeira	24
4596	Palmitos	24
4597	Papanduva	24
4598	Paraíso	24
4599	Passo de Torres	24
4600	Passos Maia	24
4601	Paulo Lopes	24
4602	Pedras Grandes	24
4603	Penha	24
4604	Peritiba	24
4605	Petrolândia	24
4606	Piçarras	24
4607	Pinhalzinho	24
4608	Pinheiro Preto	24
4609	Piratuba	24
4610	Planalto Alegre	24
4611	Pomerode	24
4612	Ponte Alta	24
4613	Ponte Alta do Norte	24
4614	Ponte Serrada	24
4615	Porto Belo	24
4616	Porto União	24
4617	Pouso Redondo	24
4618	Praia Grande	24
4619	Presidente Castelo Branco	24
4620	Presidente Getúlio	24
4621	Presidente Nereu	24
4622	Princesa	24
4623	Quilombo	24
4624	Rancho Queimado	24
4625	Rio das Antas	24
4626	Rio do Campo	24
4627	Rio do Oeste	24
4628	Rio do Sul	24
4629	Rio dos Cedros	24
4630	Rio Fortuna	24
4631	Rio Negrinho	24
4632	Rio Rufino	24
4633	Riqueza	24
4634	Rodeio	24
4635	Romelândia	24
4636	Salete	24
4637	Saltinho	24
4638	Salto Veloso	24
4639	Sangão	24
4640	Santa Cecília	24
4641	Santa Helena	24
4642	Santa Rosa de Lima	24
4643	Santa Rosa do Sul	24
4644	Santa Terezinha	24
4645	Santa Terezinha do Progresso	24
4646	Santiago do Sul	24
4647	Santo Amaro da Imperatriz	24
4648	São Bento do Sul	24
4649	São Bernardino	24
4650	São Bonifácio	24
4651	São Carlos	24
4652	São Cristovão do Sul	24
4653	São Domingos	24
4654	São Francisco do Sul	24
4655	São João Batista	24
4656	São João do Itaperiú	24
4657	São João do Oeste	24
4658	São João do Sul	24
4659	São Joaquim	24
4660	São José	24
4661	São José do Cedro	24
4662	São José do Cerrito	24
4663	São Lourenço do Oeste	24
4664	São Ludgero	24
4665	São Martinho	24
4666	São Miguel da Boa Vista	24
4667	São Miguel do Oeste	24
4668	São Pedro de Alcântara	24
4669	Saudades	24
4670	Schroeder	24
4671	Seara	24
4672	Serra Alta	24
4673	Siderópolis	24
4674	Sombrio	24
4675	Sul Brasil	24
4676	Taió	24
4677	Tangará	24
4678	Tigrinhos	24
4679	Tijucas	24
4680	Timbé do Sul	24
4681	Timbó	24
4682	Timbó Grande	24
4683	Três Barras	24
4684	Treviso	24
4685	Treze de Maio	24
4686	Treze Tílias	24
4687	Trombudo Central	24
4688	Tubarão	24
4689	Tunápolis	24
4690	Turvo	24
4691	União do Oeste	24
4692	Urubici	24
4693	Urupema	24
4694	Urussanga	24
4695	Vargeão	24
4696	Vargem	24
4697	Vargem Bonita	24
4698	Vidal Ramos	24
4699	Videira	24
4700	Vitor Meireles	24
4701	Witmarsum	24
4702	Xanxerê	24
4703	Xavantina	24
4704	Xaxim	24
4705	Zortéa	24
4706	Adamantina	26
4707	Adolfo	26
4708	Aguaí	26
4709	Águas da Prata	26
4710	Águas de Lindóia	26
4711	Águas de Santa Bárbara	26
4712	Águas de São Pedro	26
4713	Agudos	26
4714	Alambari	26
4715	Alfredo Marcondes	26
4716	Altair	26
4717	Altinópolis	26
4718	Alto Alegre	26
4719	Alumínio	26
4720	Álvares Florence	26
4721	Álvares Machado	26
4722	Álvaro de Carvalho	26
4723	Alvinlândia	26
4724	Americana	26
4725	Américo Brasiliense	26
4726	Américo de Campos	26
4727	Amparo	26
4728	Analândia	26
4729	Andradina	26
4730	Angatuba	26
4731	Anhembi	26
4732	Anhumas	26
4733	Aparecida	26
4734	Aparecida d"Oeste	26
4735	Apiaí	26
4736	Araçariguama	26
4737	Araçatuba	26
4738	Araçoiaba da Serra	26
4739	Aramina	26
4740	Arandu	26
4741	Arapeí	26
4742	Araraquara	26
4743	Araras	26
4744	Arco-Íris	26
4745	Arealva	26
4746	Areias	26
4747	Areiópolis	26
4748	Ariranha	26
4749	Artur Nogueira	26
4750	Arujá	26
4751	Aspásia	26
4752	Assis	26
4753	Atibaia	26
4754	Auriflama	26
4755	Avaí	26
4756	Avanhandava	26
4757	Avaré	26
4758	Bady Bassitt	26
4759	Balbinos	26
4760	Bálsamo	26
4761	Bananal	26
4762	Barão de Antonina	26
4763	Barbosa	26
4764	Bariri	26
4765	Barra Bonita	26
4766	Barra do Chapéu	26
4767	Barra do Turvo	26
4768	Barretos	26
4769	Barrinha	26
4770	Barueri	26
4771	Bastos	26
4772	Batatais	26
4773	Bauru	26
4774	Bebedouro	26
4775	Bento de Abreu	26
4776	Bernardino de Campos	26
4777	Bertioga	26
4778	Bilac	26
4779	Birigui	26
4780	Biritiba-Mirim	26
4781	Boa Esperança do Sul	26
4782	Bocaina	26
4783	Bofete	26
4784	Boituva	26
4785	Bom Jesus dos Perdões	26
4786	Bom Sucesso de Itararé	26
4787	Borá	26
4788	Boracéia	26
4789	Borborema	26
4790	Borebi	26
4791	Botucatu	26
4792	Bragança Paulista	26
4793	Braúna	26
4794	Brejo Alegre	26
4795	Brodowski	26
4796	Brotas	26
4797	Buri	26
4798	Buritama	26
4799	Buritizal	26
4800	Cabrália Paulista	26
4801	Cabreúva	26
4802	Caçapava	26
4803	Cachoeira Paulista	26
4804	Caconde	26
4805	Cafelândia	26
4806	Caiabu	26
4807	Caieiras	26
4808	Caiuá	26
4809	Cajamar	26
4810	Cajati	26
4811	Cajobi	26
4812	Cajuru	26
4813	Campina do Monte Alegre	26
4814	Campinas	26
4815	Campo Limpo Paulista	26
4816	Campos do Jordão	26
4817	Campos Novos Paulista	26
4818	Cananéia	26
4819	Canas	26
4820	Cândido Mota	26
4821	Cândido Rodrigues	26
4822	Canitar	26
4823	Capão Bonito	26
4824	Capela do Alto	26
4825	Capivari	26
4826	Caraguatatuba	26
4827	Carapicuíba	26
4828	Cardoso	26
4829	Casa Branca	26
4830	Cássia dos Coqueiros	26
4831	Castilho	26
4832	Catanduva	26
4833	Catiguá	26
4834	Cedral	26
4835	Cerqueira César	26
4836	Cerquilho	26
4837	Cesário Lange	26
4838	Charqueada	26
4839	Chavantes	26
4840	Clementina	26
4841	Colina	26
4842	Colômbia	26
4843	Conchal	26
4844	Conchas	26
4845	Cordeirópolis	26
4846	Coroados	26
4847	Coronel Macedo	26
4848	Corumbataí	26
4849	Cosmópolis	26
4850	Cosmorama	26
4851	Cotia	26
4852	Cravinhos	26
4853	Cristais Paulista	26
4854	Cruzália	26
4855	Cruzeiro	26
4856	Cubatão	26
4857	Cunha	26
4858	Descalvado	26
4859	Diadema	26
4860	Dirce Reis	26
4861	Divinolândia	26
4862	Dobrada	26
4863	Dois Córregos	26
4864	Dolcinópolis	26
4865	Dourado	26
4866	Dracena	26
4867	Duartina	26
4868	Dumont	26
4869	Echaporã	26
4870	Eldorado	26
4871	Elias Fausto	26
4872	Elisiário	26
4873	Embaúba	26
4874	Embu	26
4875	Embu-Guaçu	26
4876	Emilianópolis	26
4877	Engenheiro Coelho	26
4878	Espírito Santo do Pinhal	26
4879	Espírito Santo do Turvo	26
4880	Estiva Gerbi	26
4881	Estrela d"Oeste	26
4882	Estrela do Norte	26
4883	Euclides da Cunha Paulista	26
4884	Fartura	26
4885	Fernando Prestes	26
4886	Fernandópolis	26
4887	Fernão	26
4888	Ferraz de Vasconcelos	26
4889	Flora Rica	26
4890	Floreal	26
4891	Flórida Paulista	26
4892	Florínia	26
4893	Franca	26
4894	Francisco Morato	26
4895	Franco da Rocha	26
4896	Gabriel Monteiro	26
4897	Gália	26
4898	Garça	26
4899	Gastão Vidigal	26
4900	Gavião Peixoto	26
4901	General Salgado	26
4902	Getulina	26
4903	Glicério	26
4904	Guaiçara	26
4905	Guaimbê	26
4906	Guaíra	26
4907	Guapiaçu	26
4908	Guapiara	26
4909	Guará	26
4910	Guaraçaí	26
4911	Guaraci	26
4912	Guarani d"Oeste	26
4913	Guarantã	26
4914	Guararapes	26
4915	Guararema	26
4916	Guaratinguetá	26
4917	Guareí	26
4918	Guariba	26
4919	Guarujá	26
4920	Guarulhos	26
4921	Guatapará	26
4922	Guzolândia	26
4923	Herculândia	26
4924	Holambra	26
4925	Hortolândia	26
4926	Iacanga	26
4927	Iacri	26
4928	Iaras	26
4929	Ibaté	26
4930	Ibirá	26
4931	Ibirarema	26
4932	Ibitinga	26
4933	Ibiúna	26
4934	Icém	26
4935	Iepê	26
4936	Igaraçu do Tietê	26
4937	Igarapava	26
4938	Igaratá	26
4939	Iguape	26
4940	Ilha Comprida	26
4941	Ilha Solteira	26
4942	Ilhabela	26
4943	Indaiatuba	26
4944	Indiana	26
4945	Indiaporã	26
4946	Inúbia Paulista	26
4947	Ipaussu	26
4948	Iperó	26
4949	Ipeúna	26
4950	Ipiguá	26
4951	Iporanga	26
4952	Ipuã	26
4953	Iracemápolis	26
4954	Irapuã	26
4955	Irapuru	26
4956	Itaberá	26
4957	Itaí	26
4958	Itajobi	26
4959	Itaju	26
4960	Itanhaém	26
4961	Itaóca	26
4962	Itapecerica da Serra	26
4963	Itapetininga	26
4964	Itapeva	26
4965	Itapevi	26
4966	Itapira	26
4967	Itapirapuã Paulista	26
4968	Itápolis	26
4969	Itaporanga	26
4970	Itapuí	26
4971	Itapura	26
4972	Itaquaquecetuba	26
4973	Itararé	26
4974	Itariri	26
4975	Itatiba	26
4976	Itatinga	26
4977	Itirapina	26
4978	Itirapuã	26
4979	Itobi	26
4980	Itu	26
4981	Itupeva	26
4982	Ituverava	26
4983	Jaborandi	26
4984	Jaboticabal	26
4985	Jacareí	26
4986	Jaci	26
4987	Jacupiranga	26
4988	Jaguariúna	26
4989	Jales	26
4990	Jambeiro	26
4991	Jandira	26
4992	Jardinópolis	26
4993	Jarinu	26
4994	Jaú	26
4995	Jeriquara	26
4996	Joanópolis	26
4997	João Ramalho	26
4998	José Bonifácio	26
4999	Júlio Mesquita	26
5000	Jumirim	26
5001	Jundiaí	26
5002	Junqueirópolis	26
5003	Juquiá	26
5004	Juquitiba	26
5005	Lagoinha	26
5006	Laranjal Paulista	26
5007	Lavínia	26
5008	Lavrinhas	26
5009	Leme	26
5010	Lençóis Paulista	26
5011	Limeira	26
5012	Lindóia	26
5013	Lins	26
5014	Lorena	26
5015	Lourdes	26
5016	Louveira	26
5017	Lucélia	26
5018	Lucianópolis	26
5019	Luís Antônio	26
5020	Luiziânia	26
5021	Lupércio	26
5022	Lutécia	26
5023	Macatuba	26
5024	Macaubal	26
5025	Macedônia	26
5026	Magda	26
5027	Mairinque	26
5028	Mairiporã	26
5029	Manduri	26
5030	Marabá Paulista	26
5031	Maracaí	26
5032	Marapoama	26
5033	Mariápolis	26
5034	Marília	26
5035	Marinópolis	26
5036	Martinópolis	26
5037	Matão	26
5038	Mauá	26
5039	Mendonça	26
5040	Meridiano	26
5041	Mesópolis	26
5042	Miguelópolis	26
5043	Mineiros do Tietê	26
5044	Mira Estrela	26
5045	Miracatu	26
5046	Mirandópolis	26
5047	Mirante do Paranapanema	26
5048	Mirassol	26
5049	Mirassolândia	26
5050	Mococa	26
5051	Mogi das Cruzes	26
5052	Mogi Guaçu	26
5053	Moji Mirim	26
5054	Mombuca	26
5055	Monções	26
5056	Mongaguá	26
5057	Monte Alegre do Sul	26
5058	Monte Alto	26
5059	Monte Aprazível	26
5060	Monte Azul Paulista	26
5061	Monte Castelo	26
5062	Monte Mor	26
5063	Monteiro Lobato	26
5064	Morro Agudo	26
5065	Morungaba	26
5066	Motuca	26
5067	Murutinga do Sul	26
5068	Nantes	26
5069	Narandiba	26
5070	Natividade da Serra	26
5071	Nazaré Paulista	26
5072	Neves Paulista	26
5073	Nhandeara	26
5074	Nipoã	26
5075	Nova Aliança	26
5076	Nova Campina	26
5077	Nova Canaã Paulista	26
5078	Nova Castilho	26
5079	Nova Europa	26
5080	Nova Granada	26
5081	Nova Guataporanga	26
5082	Nova Independência	26
5083	Nova Luzitânia	26
5084	Nova Odessa	26
5085	Novais	26
5086	Novo Horizonte	26
5087	Nuporanga	26
5088	Ocauçu	26
5089	Óleo	26
5090	Olímpia	26
5091	Onda Verde	26
5092	Oriente	26
5093	Orindiúva	26
5094	Orlândia	26
5095	Osasco	26
5096	Oscar Bressane	26
5097	Osvaldo Cruz	26
5098	Ourinhos	26
5099	Ouro Verde	26
5100	Ouroeste	26
5101	Pacaembu	26
5102	Palestina	26
5103	Palmares Paulista	26
5104	Palmeira d"Oeste	26
5105	Palmital	26
5106	Panorama	26
5107	Paraguaçu Paulista	26
5108	Paraibuna	26
5109	Paraíso	26
5110	Paranapanema	26
5111	Paranapuã	26
5112	Parapuã	26
5113	Pardinho	26
5114	Pariquera-Açu	26
5115	Parisi	26
5116	Patrocínio Paulista	26
5117	Paulicéia	26
5118	Paulínia	26
5119	Paulistânia	26
5120	Paulo de Faria	26
5121	Pederneiras	26
5122	Pedra Bela	26
5123	Pedranópolis	26
5124	Pedregulho	26
5125	Pedreira	26
5126	Pedrinhas Paulista	26
5127	Pedro de Toledo	26
5128	Penápolis	26
5129	Pereira Barreto	26
5130	Pereiras	26
5131	Peruíbe	26
5132	Piacatu	26
5133	Piedade	26
5134	Pilar do Sul	26
5135	Pindamonhangaba	26
5136	Pindorama	26
5137	Pinhalzinho	26
5138	Piquerobi	26
5139	Piquete	26
5140	Piracaia	26
5141	Piracicaba	26
5142	Piraju	26
5143	Pirajuí	26
5144	Pirangi	26
5145	Pirapora do Bom Jesus	26
5146	Pirapozinho	26
5147	Pirassununga	26
5148	Piratininga	26
5149	Pitangueiras	26
5150	Planalto	26
5151	Platina	26
5152	Poá	26
5153	Poloni	26
5154	Pompéia	26
5155	Pongaí	26
5156	Pontal	26
5157	Pontalinda	26
5158	Pontes Gestal	26
5159	Populina	26
5160	Porangaba	26
5161	Porto Feliz	26
5162	Porto Ferreira	26
5163	Potim	26
5164	Potirendaba	26
5165	Pracinha	26
5166	Pradópolis	26
5167	Praia Grande	26
5168	Pratânia	26
5169	Presidente Alves	26
5170	Presidente Bernardes	26
5171	Presidente Epitácio	26
5172	Presidente Prudente	26
5173	Presidente Venceslau	26
5174	Promissão	26
5175	Quadra	26
5176	Quatá	26
5177	Queiroz	26
5178	Queluz	26
5179	Quintana	26
5180	Rafard	26
5181	Rancharia	26
5182	Redenção da Serra	26
5183	Regente Feijó	26
5184	Reginópolis	26
5185	Registro	26
5186	Restinga	26
5187	Ribeira	26
5188	Ribeirão Bonito	26
5189	Ribeirão Branco	26
5190	Ribeirão Corrente	26
5191	Ribeirão do Sul	26
5192	Ribeirão dos Índios	26
5193	Ribeirão Grande	26
5194	Ribeirão Pires	26
5195	Ribeirão Preto	26
5196	Rifaina	26
5197	Rincão	26
5198	Rinópolis	26
5199	Rio Claro	26
5200	Rio das Pedras	26
5201	Rio Grande da Serra	26
5202	Riolândia	26
5203	Riversul	26
5204	Rosana	26
5205	Roseira	26
5206	Rubiácea	26
5207	Rubinéia	26
5208	Sabino	26
5209	Sagres	26
5210	Sales	26
5211	Sales Oliveira	26
5212	Salesópolis	26
5213	Salmourão	26
5214	Saltinho	26
5215	Salto	26
5216	Salto de Pirapora	26
5217	Salto Grande	26
5218	Sandovalina	26
5219	Santa Adélia	26
5220	Santa Albertina	26
5221	Santa Bárbara d"Oeste	26
5222	Santa Branca	26
5223	Santa Clara d"Oeste	26
5224	Santa Cruz da Conceição	26
5225	Santa Cruz da Esperança	26
5226	Santa Cruz das Palmeiras	26
5227	Santa Cruz do Rio Pardo	26
5228	Santa Ernestina	26
5229	Santa Fé do Sul	26
5230	Santa Gertrudes	26
5231	Santa Isabel	26
5232	Santa Lúcia	26
5233	Santa Maria da Serra	26
5234	Santa Mercedes	26
5235	Santa Rita d"Oeste	26
5236	Santa Rita do Passa Quatro	26
5237	Santa Rosa de Viterbo	26
5238	Santa Salete	26
5239	Santana da Ponte Pensa	26
5240	Santana de Parnaíba	26
5241	Santo Anastácio	26
5242	Santo André	26
5243	Santo Antônio da Alegria	26
5244	Santo Antônio de Posse	26
5245	Santo Antônio do Aracanguá	26
5246	Santo Antônio do Jardim	26
5247	Santo Antônio do Pinhal	26
5248	Santo Expedito	26
5249	Santópolis do Aguapeí	26
5250	Santos	26
5251	São Bento do Sapucaí	26
5252	São Bernardo do Campo	26
5253	São Caetano do Sul	26
5254	São Carlos	26
5255	São Francisco	26
5256	São João da Boa Vista	26
5257	São João das Duas Pontes	26
5258	São João de Iracema	26
5259	São João do Pau d"Alho	26
5260	São Joaquim da Barra	26
5261	São José da Bela Vista	26
5262	São José do Barreiro	26
5263	São José do Rio Pardo	26
5264	São José do Rio Preto	26
5265	São José dos Campos	26
5266	São Lourenço da Serra	26
5267	São Luís do Paraitinga	26
5268	São Manuel	26
5269	São Miguel Arcanjo	26
5270	São Paulo	26
5271	São Pedro	26
5272	São Pedro do Turvo	26
5273	São Roque	26
5274	São Sebastião	26
5275	São Sebastião da Grama	26
5276	São Simão	26
5277	São Vicente	26
5278	Sarapuí	26
5279	Sarutaiá	26
5280	Sebastianópolis do Sul	26
5281	Serra Azul	26
5282	Serra Negra	26
5283	Serrana	26
5284	Sertãozinho	26
5285	Sete Barras	26
5286	Severínia	26
5287	Silveiras	26
5288	Socorro	26
5289	Sorocaba	26
5290	Sud Mennucci	26
5291	Sumaré	26
5292	Suzanápolis	26
5293	Suzano	26
5294	Tabapuã	26
5295	Tabatinga	26
5296	Taboão da Serra	26
5297	Taciba	26
5298	Taguaí	26
5299	Taiaçu	26
5300	Taiúva	26
5301	Tambaú	26
5302	Tanabi	26
5303	Tapiraí	26
5304	Tapiratiba	26
5305	Taquaral	26
5306	Taquaritinga	26
5307	Taquarituba	26
5308	Taquarivaí	26
5309	Tarabai	26
5310	Tarumã	26
5311	Tatuí	26
5312	Taubaté	26
5313	Tejupá	26
5314	Teodoro Sampaio	26
5315	Terra Roxa	26
5316	Tietê	26
5317	Timburi	26
5318	Torre de Pedra	26
5319	Torrinha	26
5320	Trabiju	26
5321	Tremembé	26
5322	Três Fronteiras	26
5323	Tuiuti	26
5324	Tupã	26
5325	Tupi Paulista	26
5326	Turiúba	26
5327	Turmalina	26
5328	Ubarana	26
5329	Ubatuba	26
5330	Ubirajara	26
5331	Uchoa	26
5332	União Paulista	26
5333	Urânia	26
5334	Uru	26
5335	Urupês	26
5336	Valentim Gentil	26
5337	Valinhos	26
5338	Valparaíso	26
5339	Vargem	26
5340	Vargem Grande do Sul	26
5341	Vargem Grande Paulista	26
5342	Várzea Paulista	26
5343	Vera Cruz	26
5344	Vinhedo	26
5345	Viradouro	26
5346	Vista Alegre do Alto	26
5347	Vitória Brasil	26
5348	Votorantim	26
5349	Votuporanga	26
5350	Zacarias	26
5351	Amparo de São Francisco	25
5352	Aquidabã	25
5353	Aracaju	25
5354	Arauá	25
5355	Areia Branca	25
5356	Barra dos Coqueiros	25
5357	Boquim	25
5358	Brejo Grande	25
5359	Campo do Brito	25
5360	Canhoba	25
5361	Canindé de São Francisco	25
5362	Capela	25
5363	Carira	25
5364	Carmópolis	25
5365	Cedro de São João	25
5366	Cristinápolis	25
5367	Cumbe	25
5368	Divina Pastora	25
5369	Estância	25
5370	Feira Nova	25
5371	Frei Paulo	25
5372	Gararu	25
5373	General Maynard	25
5374	Gracho Cardoso	25
5375	Ilha das Flores	25
5376	Indiaroba	25
5377	Itabaiana	25
5378	Itabaianinha	25
5379	Itabi	25
5380	Itaporanga d"Ajuda	25
5381	Japaratuba	25
5382	Japoatã	25
5383	Lagarto	25
5384	Laranjeiras	25
5385	Macambira	25
5386	Malhada dos Bois	25
5387	Malhador	25
5388	Maruim	25
5389	Moita Bonita	25
5390	Monte Alegre de Sergipe	25
5391	Muribeca	25
5392	Neópolis	25
5393	Nossa Senhora Aparecida	25
5394	Nossa Senhora da Glória	25
5395	Nossa Senhora das Dores	25
5396	Nossa Senhora de Lourdes	25
5397	Nossa Senhora do Socorro	25
5398	Pacatuba	25
5399	Pedra Mole	25
5400	Pedrinhas	25
5401	Pinhão	25
5402	Pirambu	25
5403	Poço Redondo	25
5404	Poço Verde	25
5405	Porto da Folha	25
5406	Propriá	25
5407	Riachão do Dantas	25
5408	Riachuelo	25
5409	Ribeirópolis	25
5410	Rosário do Catete	25
5411	Salgado	25
5412	Santa Luzia do Itanhy	25
5413	Santa Rosa de Lima	25
5414	Santana do São Francisco	25
5415	Santo Amaro das Brotas	25
5416	São Cristóvão	25
5417	São Domingos	25
5418	São Francisco	25
5419	São Miguel do Aleixo	25
5420	Simão Dias	25
5421	Siriri	25
5422	Telha	25
5423	Tobias Barreto	25
5424	Tomar do Geru	25
5425	Umbaúba	25
5426	Abreulândia	27
5427	Aguiarnópolis	27
5428	Aliança do Tocantins	27
5429	Almas	27
5430	Alvorada	27
5431	Ananás	27
5432	Angico	27
5433	Aparecida do Rio Negro	27
5434	Aragominas	27
5435	Araguacema	27
5436	Araguaçu	27
5437	Araguaína	27
5438	Araguanã	27
5439	Araguatins	27
5440	Arapoema	27
5441	Arraias	27
5442	Augustinópolis	27
5443	Aurora do Tocantins	27
5444	Axixá do Tocantins	27
5445	Babaçulândia	27
5446	Bandeirantes do Tocantins	27
5447	Barra do Ouro	27
5448	Barrolândia	27
5449	Bernardo Sayão	27
5450	Bom Jesus do Tocantins	27
5451	Brasilândia do Tocantins	27
5452	Brejinho de Nazaré	27
5453	Buriti do Tocantins	27
5454	Cachoeirinha	27
5455	Campos Lindos	27
5456	Cariri do Tocantins	27
5457	Carmolândia	27
5458	Carrasco Bonito	27
5459	Caseara	27
5460	Centenário	27
5461	Chapada da Natividade	27
5462	Chapada de Areia	27
5463	Colinas do Tocantins	27
5464	Colméia	27
5465	Combinado	27
5466	Conceição do Tocantins	27
5467	Couto de Magalhães	27
5468	Cristalândia	27
5469	Crixás do Tocantins	27
5470	Darcinópolis	27
5471	Dianópolis	27
5472	Divinópolis do Tocantins	27
5473	Dois Irmãos do Tocantins	27
5474	Dueré	27
5475	Esperantina	27
5476	Fátima	27
5477	Figueirópolis	27
5478	Filadélfia	27
5479	Formoso do Araguaia	27
5480	Fortaleza do Tabocão	27
5481	Goianorte	27
5482	Goiatins	27
5483	Guaraí	27
5484	Gurupi	27
5485	Ipueiras	27
5486	Itacajá	27
5487	Itaguatins	27
5488	Itapiratins	27
5489	Itaporã do Tocantins	27
5490	Jaú do Tocantins	27
5491	Juarina	27
5492	Lagoa da Confusão	27
5493	Lagoa do Tocantins	27
5494	Lajeado	27
5495	Lavandeira	27
5496	Lizarda	27
5497	Luzinópolis	27
5498	Marianópolis do Tocantins	27
5499	Mateiros	27
5500	Maurilândia do Tocantins	27
5501	Miracema do Tocantins	27
5502	Miranorte	27
5503	Monte do Carmo	27
5504	Monte Santo do Tocantins	27
5505	Muricilândia	27
5506	Natividade	27
5507	Nazaré	27
5508	Nova Olinda	27
5509	Nova Rosalândia	27
5510	Novo Acordo	27
5511	Novo Alegre	27
5512	Novo Jardim	27
5513	Oliveira de Fátima	27
5514	Palmas	27
5515	Palmeirante	27
5516	Palmeiras do Tocantins	27
5517	Palmeirópolis	27
5518	Paraíso do Tocantins	27
5519	Paranã	27
5520	Pau d"Arco	27
5521	Pedro Afonso	27
5522	Peixe	27
5523	Pequizeiro	27
5524	Pindorama do Tocantins	27
5525	Piraquê	27
5526	Pium	27
5527	Ponte Alta do Bom Jesus	27
5528	Ponte Alta do Tocantins	27
5529	Porto Alegre do Tocantins	27
5530	Porto Nacional	27
5531	Praia Norte	27
5532	Presidente Kennedy	27
5533	Pugmil	27
5534	Recursolândia	27
5535	Riachinho	27
5536	Rio da Conceição	27
5537	Rio dos Bois	27
5538	Rio Sono	27
5539	Sampaio	27
5540	Sandolândia	27
5541	Santa Fé do Araguaia	27
5542	Santa Maria do Tocantins	27
5543	Santa Rita do Tocantins	27
5544	Santa Rosa do Tocantins	27
5545	Santa Tereza do Tocantins	27
5546	Santa Terezinha do Tocantins	27
5547	São Bento do Tocantins	27
5548	São Félix do Tocantins	27
5549	São Miguel do Tocantins	27
5550	São Salvador do Tocantins	27
5551	São Sebastião do Tocantins	27
5552	São Valério da Natividade	27
5553	Silvanópolis	27
5554	Sítio Novo do Tocantins	27
5555	Sucupira	27
5556	Taguatinga	27
5557	Taipas do Tocantins	27
5558	Talismã	27
5559	Tocantínia	27
5560	Tocantinópolis	27
5561	Tupirama	27
5562	Tupiratins	27
5563	Wanderlândia	27
5564	Xambioá	27
\.


--
-- TOC entry 3828 (class 0 OID 0)
-- Dependencies: 173
-- Name: tb_cidade_id_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_cidade_id_seq', 5564, true);


--
-- TOC entry 3560 (class 0 OID 18221)
-- Dependencies: 174
-- Data for Name: tb_clti; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_clti (idtb_clti, efetivo_oficiais, efetivo_pracas, nome, sigla, indicativo, data_ativacao) FROM stdin;
1	2	5	CLTI COM3ºDN	CLTI-3ºDN	CLTINA	2012-04-30
\.


--
-- TOC entry 3829 (class 0 OID 0)
-- Dependencies: 175
-- Name: tb_clti_idtb_clti_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_clti_idtb_clti_seq', 1, true);


--
-- TOC entry 3562 (class 0 OID 18226)
-- Dependencies: 176
-- Data for Name: tb_conectividade; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_conectividade (idtb_conectividade, idtb_om_apoiadas, fabricante, modelo, end_ip, data_aquisicao, data_garantia, idtb_om_setores, qtde_portas, nome, status) FROM stdin;
1	1	HP	HP1410-24G		2018-12-25	2019-12-25	4	24	SW-01	
\.


--
-- TOC entry 3663 (class 0 OID 19225)
-- Dependencies: 294
-- Data for Name: tb_conectividade_excluidos; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_conectividade_excluidos (idtb_conectividade_excluidos, idtb_om_apoiadas, fabricante, modelo, end_ip, data_del, hora_del) FROM stdin;
\.


--
-- TOC entry 3830 (class 0 OID 0)
-- Dependencies: 293
-- Name: tb_conectividade_excluidos_idtb_conectividade_excluidos_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_conectividade_excluidos_idtb_conectividade_excluidos_seq', 1, false);


--
-- TOC entry 3831 (class 0 OID 0)
-- Dependencies: 177
-- Name: tb_conectividade_idtb_conectividade_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_conectividade_idtb_conectividade_seq', 1, true);


--
-- TOC entry 3564 (class 0 OID 18234)
-- Dependencies: 178
-- Data for Name: tb_config; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_config (idtb_config, parametro, valor) FROM stdin;
2	ESTADO	RN
3	CIDADE	Natal
1	URL	http://localhost/sisclti
5	author	99242991 Lúcio ALEXANDRE Correia dos Santos lucio.alexandre@marinha.mil.br
6	generator	LucioACSantos
7	description	Sistema de Gestão de TI
8	TITULO	sisclti
4	VERSAO	1.5.25
\.


--
-- TOC entry 3832 (class 0 OID 0)
-- Dependencies: 179
-- Name: tb_config_idtb_config_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_config_idtb_config_seq', 8, true);


--
-- TOC entry 3566 (class 0 OID 18242)
-- Dependencies: 180
-- Data for Name: tb_controle_internet; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_controle_internet (idtb_controle_internet, idtb_om_apoiadas, idtb_pessoal_om, perfis, status) FROM stdin;
1	1	1	1, 2, 3, 4, 5, 6	\N
\.


--
-- TOC entry 3833 (class 0 OID 0)
-- Dependencies: 181
-- Name: tb_controle_internet_idtb_controle_internet_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_controle_internet_idtb_controle_internet_seq', 1, true);


--
-- TOC entry 3568 (class 0 OID 18250)
-- Dependencies: 182
-- Data for Name: tb_controle_usb; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_controle_usb (idtb_controle_usb, idtb_om_apoiadas, idtb_estacoes, autorizacao, status) FROM stdin;
2	1	7	OS XX/2021	\N
3	1	11	OS XX/2021	\N
4	1	4	OS XX/2021	\N
5	1	6	OS XX/2021	\N
6	1	5	OS XX/2021	\N
7	1	10	OS XX/2021	\N
8	1	8	OS XX/2021	\N
9	1	2	OS XX/2021	\N
10	1	3	OS XX/2021	\N
1	1	1	OS XX/2021	\N
11	1	12	OS XX/2021	\N
\.


--
-- TOC entry 3834 (class 0 OID 0)
-- Dependencies: 183
-- Name: tb_controle_usb_idtb_controle_usb_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_controle_usb_idtb_controle_usb_seq', 11, true);


--
-- TOC entry 3570 (class 0 OID 18258)
-- Dependencies: 184
-- Data for Name: tb_corpo_quadro; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_corpo_quadro (idtb_corpo_quadro, nome, sigla, exibir) FROM stdin;
4	CPA	CPA	NÃO
5	CAP	CAP	NÃO
19	AA	AA	SIM
11	NA	N/A	NÃO
20	TTM	TTM	SIM
21	RM1	RM1	SIM
22	QC-CA	QC-CA	SIM
18	QC-IM	QC-IM	SIM
2	CA	CA	NÃO
3	CPFN	FN	SIM
6	CAF	CAF	NÃO
7	CSM	S	NÃO
8	CD	CD	SIM
9	IM	IM	SIM
12	AFN	AFN	SIM
10	T	T	SIM
13	RM2	RM2	SIM
14	MD	MD	SIM
15	F	F	SIM
16	QC-FN	QC-FN	SIM
17	CORPO DE PRAÇAS DA RESERVA	CPR	NÃO
1	CFN	FN	SIM
23	EN	EN	SIM
\.


--
-- TOC entry 3835 (class 0 OID 0)
-- Dependencies: 185
-- Name: tb_corpo_quadro_idtb_corpo_quadro_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_corpo_quadro_idtb_corpo_quadro_seq', 23, true);


--
-- TOC entry 3572 (class 0 OID 18263)
-- Dependencies: 186
-- Data for Name: tb_det_serv; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_det_serv (idtb_det_serv, idtb_lotacao_clti, data_entra_servico, data_sai_servico, status) FROM stdin;
1	6	2022-05-17	2022-05-18	ENCERRADO
2	14	2022-05-18	2022-05-19	ENCERRADO
3	9	2022-05-19	2022-05-20	ENCERRADO
4	14	2022-05-20	2022-05-23	ENCERRADO
5	4	2022-05-23	2022-05-24	ENCERRADO
6	3	2022-05-24	2022-05-25	ENCERRADO
7	6	2022-05-25	2022-05-26	ENCERRADO
8	14	2022-05-26	2022-05-27	ENCERRADO
9	9	2022-05-27	2022-05-30	ENCERRADO
10	4	2022-05-30	2022-05-31	ENCERRADO
11	3	2022-05-31	2022-06-01	ENCERRADO
12	6	2022-06-01	2022-06-02	ENCERRADO
13	14	2022-06-02	2022-06-03	ENCERRADO
14	3	2022-06-03	2022-06-06	ENCERRADO
15	12	2022-06-06	2022-06-07	ENCERRADO
16	6	2022-06-07	2022-06-08	ENCERRADO
17	14	2022-06-08	2022-06-09	ENCERRADO
18	3	2022-06-09	2022-06-10	ENCERRADO
19	12	2022-06-10	2022-06-13	ENCERRADO
20	6	2022-06-13	2022-06-14	ENCERRADO
21	14	2022-06-14	2022-06-15	ENCERRADO
22	3	2022-06-15	2022-06-16	ENCERRADO
23	12	2022-06-16	2022-06-17	ENCERRADO
24	14	2022-06-17	2022-06-20	ENCERRADO
25	3	2022-06-20	2022-06-21	ENCERRADO
26	12	2022-06-21	2022-06-22	ENCERRADO
27	14	2022-06-22	2022-06-23	ENCERRADO
28	12	2022-06-23	2022-06-24	ENCERRADO
29	3	2022-06-24	2022-06-27	ENCERRADO
30	14	2022-06-27	2022-06-28	ENCERRADO
31	9	2022-06-28	2022-06-29	ENCERRADO
32	4	2022-06-29	2022-06-30	ENCERRADO
66	3	2022-08-16	2022-08-17	ENCERRADO
67	17	2022-08-17	2022-08-18	ENCERRADO
33	3	2022-06-30	2022-07-01	ENCERRADO
34	9	2022-07-01	2022-07-04	ENCERRADO
35	14	2022-07-04	2022-07-05	ENCERRADO
36	9	2022-07-05	2022-07-06	ENCERRADO
38	14	2022-07-07	2022-07-08	ENCERRADO
68	3	2022-08-18	2022-08-19	ENCERRADO
69	12	2022-08-19	2022-08-22	ENCERRADO
70	3	2022-08-22	2022-08-23	ENCERRADO
39	4	2022-07-08	2022-07-11	ENCERRADO
40	9	2022-07-11	2022-07-12	ENCERRADO
41	4	2022-07-12	2022-07-13	ENCERRADO
42	3	2022-07-13	2022-07-14	ENCERRADO
43	6	2022-07-14	2022-07-15	ENCERRADO
44	3	2022-07-15	2022-07-18	ENCERRADO
77	3	2022-08-31	2022-09-01	PROGRAMADO
71	3	2022-08-23	2022-08-24	ENCERRADO
37	6	2022-07-06	2022-07-07	ENCERRADO
72	12	2022-08-24	2022-08-25	ENCERRADO
73	17	2022-08-25	2022-08-26	ENCERRADO
74	14	2022-08-26	2022-08-29	ENCERRADO
75	9	2022-08-29	2022-08-30	ENCERRADO
76	12	2022-08-30	2022-08-31	ENCERRADO
45	14	2022-07-18	2022-07-19	ENCERRADO
46	9	2022-07-19	2022-07-20	ENCERRADO
47	4	2022-07-20	2022-07-21	ENCERRADO
48	3	2022-07-21	2022-07-22	ENCERRADO
49	14	2022-07-22	2022-07-25	ENCERRADO
50	17	2022-07-25	2022-07-26	ENCERRADO
51	4	2022-07-26	2022-07-27	ENCERRADO
52	9	2022-07-27	2022-07-28	ENCERRADO
53	3	2022-07-28	2022-07-29	ENCERRADO
54	17	2022-07-29	2022-08-01	ENCERRADO
55	14	2022-08-01	2022-08-02	ENCERRADO
56	17	2022-08-02	2022-08-03	ENCERRADO
57	9	2022-08-03	2022-08-04	ENCERRADO
58	3	2022-08-04	2022-08-05	ENCERRADO
59	9	2022-08-05	2022-08-08	ENCERRADO
60	17	2022-08-08	2022-08-09	ENCERRADO
61	9	2022-08-09	2022-08-10	ENCERRADO
62	3	2022-08-10	2022-08-11	ENCERRADO
63	17	2022-08-11	2022-08-12	ENCERRADO
64	3	2022-08-12	2022-08-15	ENCERRADO
65	9	2022-08-15	2022-08-16	ENCERRADO
\.


--
-- TOC entry 3836 (class 0 OID 0)
-- Dependencies: 187
-- Name: tb_det_serv_idtb_det_serv_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_det_serv_idtb_det_serv_seq', 77, true);


--
-- TOC entry 3574 (class 0 OID 18268)
-- Dependencies: 188
-- Data for Name: tb_dias_troca; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_dias_troca (idtb_dias_troca, id_usuario, dias_troca) FROM stdin;
86	80	-35
24	28	-35
61	61	-35
25	29	20
2	2	-875
3	3	-875
4	4	-875
28	34	-29
5	5	-875
1	1	-659
7	1	-659
6	6	-875
8	2	-875
9	3	-875
84	78	-630
60	60	-630
10	8	-875
11	10	-875
12	11	-875
13	12	-875
14	13	-875
15	15	-875
16	16	-875
17	22	-875
18	24	-875
19	25	-875
20	33	-875
21	26	-875
23	27	-875
26	32	-875
27	35	-875
29	36	-875
30	21	-875
31	4	-875
32	23	-875
33	6	-875
34	7	-875
35	30	-875
36	9	-875
37	19	-875
38	37	-875
39	18	-875
40	20	-875
41	17	-875
42	31	-875
43	41	-875
44	43	-875
45	47	-875
46	48	-875
47	49	-875
48	5	-875
49	50	-875
50	51	-875
51	52	-875
52	53	-875
53	54	-875
54	55	-875
55	56	-875
56	57	-875
57	58	-875
58	39	-875
62	62	-875
63	63	-875
64	64	-875
65	65	-875
66	46	-875
67	66	-875
68	67	-875
69	68	-875
70	69	-875
71	70	-875
72	44	-875
73	71	-875
74	72	-875
75	38	-875
76	45	-875
77	40	-875
78	42	-875
79	73	-875
80	74	-875
81	75	-875
82	76	-875
83	77	-875
85	79	-875
87	81	-875
59	59	-36
22	14	52
\.


--
-- TOC entry 3575 (class 0 OID 18271)
-- Dependencies: 189
-- Data for Name: tb_dias_troca_clti; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_dias_troca_clti (idtb_dias_troca_clti, id_usuario, dias_troca) FROM stdin;
12	12	-170
1	2	-843
3	4	-843
4	5	-843
8	1	-843
9	9	-704
10	10	-700
11	11	-700
13	13	-700
7	8	-426
5	6	-284
15	15	-264
2	3	-197
16	16	-99
14	14	-44
6	7	-98
17	17	42
\.


--
-- TOC entry 3837 (class 0 OID 0)
-- Dependencies: 190
-- Name: tb_dias_troca_clti_idtb_dias_troca_clti_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_dias_troca_clti_idtb_dias_troca_clti_seq', 17, true);


--
-- TOC entry 3838 (class 0 OID 0)
-- Dependencies: 191
-- Name: tb_dias_troca_idtb_dias_troca_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_dias_troca_idtb_dias_troca_seq', 87, true);


--
-- TOC entry 3578 (class 0 OID 18278)
-- Dependencies: 192
-- Data for Name: tb_especialidade; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_especialidade (idtb_especialidade, nome, sigla, exibir) FROM stdin;
25	TÉCNICO	T	SIM
26	DIREÇÃO DE TIRO	DT	SIM
12	NÃO APLICÁVEL	NA	NÃO
27	FAROLEIRO	FR	SIM
28	PAIOLEIRO	PL	SIM
29	SINALEIRO	SI	SIM
30	COMUNICAÇÕES INTERIORES	CI	SIM
4	ADMINISTRAÇÃO	AD	SIM
17	ARRUMADOR	AR	SIM
5	ARTILHARIA	AT	SIM
18	BARBEIRO	BA	SIM
19	RESERVISTA PRIMEIRA CATEGORIA	RM1	SIM
22	RECRUTA	RC	SIM
14	CALDEIRA	CA	SIM
21	CARPINTEIRO	CP	SIM
3	COMUNICAÇÕES NAVAIS	CN	SIM
11	CORNETEIRO	CT	SIM
16	COZINHEIRO	CO	SIM
8	ELETRÔNICA	ET	SIM
15	ENFERMEIRO	EF	SIM
7	ENGENHARIA	EG	SIM
2	ESCRITA	ES	SIM
1	INFANTARIA	IF	SIM
20	MANOBRAS E REPARO DE AVIÇÃO	RV	SIM
6	MOTORISTA	MO	SIM
24	MÁQUINAS	MA	SIM
9	MÚSICO	MU	SIM
23	RESERVISTA DE SEGUNDA CATEGORIA	RM-2	SIM
13	NÃO INFORMADA	NI	NÃO
10	PROCESSAMENTO DE DADOS	PD	SIM
31	TELECOMUNICAÇÕES	TC	SIM
32	ENGENHEIRO NAVAL	EN	SIM
33	HIGIENE DENTAL	HD	SIM
\.


--
-- TOC entry 3839 (class 0 OID 0)
-- Dependencies: 193
-- Name: tb_especialidade_idtb_especialidade_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_especialidade_idtb_especialidade_seq', 33, true);


--
-- TOC entry 3580 (class 0 OID 18286)
-- Dependencies: 194
-- Data for Name: tb_estacoes; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_estacoes (idtb_estacoes, idtb_om_apoiadas, idtb_proc_modelo, clock_proc, fabricante, modelo, memoria, armazenamento, idtb_sor, end_ip, end_mac, data_aquisicao, data_garantia, req_minimos, status, idtb_memorias, idtb_om_setores, nome) FROM stdin;
1	1	47	3.20000005	ARQUIMEDES	CORPORATIVO - A	8	1000	15	172.23.119.135	b4:2e:99:f3:65:cd	2020-07-06	2021-06-06	SIM	EM PRODUÇÃO	30	4	COM3DN-0163.1
3	1	47	3.20000005	ARQUIMEDES	CORPORATIVO - A	8	1000	14	172.23.119.115	00-e0-4c-8d-40-1e	2020-06-01	2021-06-01	SIM	EM PRODUÇÃO	30	4	COM3DN-0163
20	1	59	2.0999999	LENOVO	G400S	6	1024	15	172.23.119.35	64:1c:67:62:83:17	2014-05-10	2015-05-10	NÃO	EM PRODUÇÃO	19	4	COM3DN-01632
4	1	54	3.4000001	LENOVO	2122ABP	8	500	15	172.23.119.119	d4:3d:7e:fc:fd:c7	2018-01-01	2019-12-31	NÃO	EM MANUTENÇÃO	19	2	COM3DN-01614
8	1	53	3.79999995	SPACEBR	IPMH61R2	8	1000	14	172.23.119.13	00:1a:3f:71:e4:50	2012-04-01	2013-04-03	SIM	EM PRODUÇÃO	18	3	COM3DN-01622
9	1	56	3.0999999	ARQUIMEDES	CORPORATIVO - B	16	1000	14	172.23.119.84	7c-05-07-bf-a0-8b	2015-01-01	2016-01-01	SIM	EM PRODUÇÃO	18	3	COM3DN-01621
10	1	53	3	SPACEBR	IPMH61R2	4	1000	14	172.23.119.120	38:60:77:27:53:4A	2012-03-01	2013-03-01	SIM	EM PRODUÇÃO	18	2	COM3DN-0161
15	1	15	3.20000005	ASUSTEK COMPUTER INC.	M5A78L-M PLUS/USB3	4	1000	5	172.23.34.201	34:97:F6:58:A7:03	2016-04-04	2017-04-04	SIM	EM PRODUÇÃO	19	3	COM3DN-0111
14	1	11	3.20000005	GIGABYTE TECHNOLOGY CO.	B75M-D3H	8	500	5	172.23.34.18	 50:E5:49:FC:A6:70	2012-03-22	2013-03-22	SIM	EM PRODUÇÃO	15	3	COM3DN-011
16	1	15	3.20000005	ASUSTEK COMPUTER INC	M5A78L-M PLUS/USB3	8	250	5	172.23.34.23	34:97:F6:58:A5:79	2016-04-04	2017-04-04	SIM	EM PRODUÇÃO	1	3	COM3DN-01103
5	1	55	3.29999995	SPACEBR	IPMH81G1	12	500	15	172.23.119.139	FC:AA:14:F9:2B:2F	2018-01-01	2019-01-01	SIM	EM PRODUÇÃO	18	2	COM3DN-01611
12	1	2	3	HP	HP COMPAQ 6000 PRO SFF PC	16	250	14	172.23.119.81	D8:D3:85:6C:A3:B6	2018-01-01	2019-01-01	SIM	EM PRODUÇÃO	18	1	COM3DN-016
6	1	53	3.79999995	SPACEBR	IPMH61R2	8	2000	14	172.23.119.135	38:60:77:27:50:d6	2012-01-01	2013-01-01	SIM	EM PRODUÇÃO	18	2	COM3DN-01633
11	1	56	3.0999999	ARQUIMEDIS	ARQUIMEDES CORPORATIVO-B	8	1000	15	172.23.119.61	7C:05:07:BF:a1:28	2018-01-02	2019-01-02	SIM	EM PRODUÇÃO	18	2	COM3DN-01613
7	1	53	3.79999995	SPACEBR	IPMH61R2	8	1000	15	172.23.119.26	38:60:77:27:50:D5	2012-04-30	2013-04-30	SIM	EM PRODUÇÃO	18	2	COM3DN-01612
2	1	47	3.20000005	ARQUIMEDES	CORPORATIVO - A	8	1000	15	172.23.119.33	00:e0:4c:9e:bc:7c	2020-06-01	2021-06-01	SIM	EM PRODUÇÃO	30	4	COM3DN-01631
18	1	11	3.0999999	HP	COMPAC B200	8	1000	15	172.23.34.116	80:C1:6E:8C:20:72	2011-11-10	2012-10-10	SIM	EM PRODUÇÃO	18	11	COM3DN-8528
17	1	1	2.20000005	SPACE BR	D1800B-ITX	4	153	13	172.23.119.245	D0:50:99:79:19:DA	2014-11-04	2015-11-04	NÃO	EM MANUTENÇÃO	15	2	COM3DN-MONITORAMENTO
13	1	11	2.70000005	HEWLETT-PACKARD	ALL-IN-ONE	4	1000	5	172.23.32.3	6C:3B:E5:E8:15:8A	2013-04-14	2014-04-14	SIM	EM PRODUÇÃO	19	3	COM3DN-01
21	18	11	3.20000005	POSITIVO	POS-PIQ57BQ	8	320	14	172.23.12.251	E0:69:95:3B:1A:4B	2021-01-01	2021-01-01	SIM	EM PRODUÇÃO	19	80	SSN3-213
\.


--
-- TOC entry 3661 (class 0 OID 19214)
-- Dependencies: 292
-- Data for Name: tb_estacoes_excluidas; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_estacoes_excluidas (idtb_estacoes_excluidas, idtb_om_apoiadas, fabricante, modelo, nome, end_ip, end_mac, data_del, hora_del) FROM stdin;
\.


--
-- TOC entry 3840 (class 0 OID 0)
-- Dependencies: 291
-- Name: tb_estacoes_excluidas_idtb_estacoes_excluidas_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_estacoes_excluidas_idtb_estacoes_excluidas_seq', 1, false);


--
-- TOC entry 3841 (class 0 OID 0)
-- Dependencies: 195
-- Name: tb_estacoes_idtb_estacoes_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_estacoes_idtb_estacoes_seq', 21, true);


--
-- TOC entry 3582 (class 0 OID 18295)
-- Dependencies: 196
-- Data for Name: tb_estado; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_estado (id, nome, uf, pais) FROM stdin;
1	Acre	AC	1
2	Alagoas	AL	1
3	Amazonas	AM	1
4	Amapá	AP	1
5	Bahia	BA	1
6	Ceará	CE	1
7	Distrito Federal	DF	1
8	Espírito Santo	ES	1
9	Goiás	GO	1
10	Maranhão	MA	1
11	Minas Gerais	MG	1
12	Mato Grosso do Sul	MS	1
13	Mato Grosso	MT	1
14	Pará	PA	1
15	Paraíba	PB	1
16	Pernambuco	PE	1
17	Piauí	PI	1
18	Paraná	PR	1
19	Rio de Janeiro	RJ	1
20	Rio Grande do Norte	RN	1
21	Rondônia	RO	1
22	Roraima	RR	1
23	Rio Grande do Sul	RS	1
24	Santa Catarina	SC	1
25	Sergipe	SE	1
26	São Paulo	SP	1
27	Tocantins	TO	1
\.


--
-- TOC entry 3842 (class 0 OID 0)
-- Dependencies: 197
-- Name: tb_estado_id_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_estado_id_seq', 27, true);


--
-- TOC entry 3584 (class 0 OID 18300)
-- Dependencies: 198
-- Data for Name: tb_funcoes_clti; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_funcoes_clti (idtb_funcoes_clti, sigla, descricao, requerida) FROM stdin;
1	Enc.CLTI	Encarregado do CLTI	Sim
2	Aprov.Rel.Sv	Aprovação de Relatórios de Serviço	Sim
3	Sup.Sv.	Supervisor de Serviço	Sim
\.


--
-- TOC entry 3843 (class 0 OID 0)
-- Dependencies: 199
-- Name: tb_funcoes_clti_idtb_funcoes_clti_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_funcoes_clti_idtb_funcoes_clti_seq', 3, true);


--
-- TOC entry 3586 (class 0 OID 18308)
-- Dependencies: 200
-- Data for Name: tb_funcoes_sigdem; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_funcoes_sigdem (idtb_funcoes_sigdem, idtb_om_apoiadas, descricao, sigla, idtb_pessoal_om, status) FROM stdin;
2	1	ENCARREGADO DO CLTI	DN-01.6	2	\N
3	1	ENCARREGADO DA DIVISÃO DE INFRAESTRUTURA DO CLTI	DN-01.6.1	4	\N
4	1	SUPERVISOR DA DIVISÃO DE INFRAESTRUTURA DO CLTI	DN-01.6.1.1	6	\N
5	1	AUXILIAR DA DIVISÃO DE INFRAESTRUTURA DO CLTI	DN-01.6.1.2	8	\N
6	1	AUXILIAR DA DIVISÃO DE INFRAESTRUTURA DO CLTI	DN-01.6.1.3	10	\N
7	1	AUXILIAR DA DIVISÃO DE INFRAESTRUTURA DO CLTI	DN-01.6.1.4	11	\N
8	1	AUXILIAR DA DIVISÃO DE INFRAESTRUTURA DO CLTI	DN-01.6.1.5	12	\N
1	1	AUXILIAR DA DIVISÃO DE SISTEMAS DO CLTI	DN-01.6.3.2	1	\N
11	1	SUPERVISOR DA DIVISÃO DE SISTEMAS DO CLTI	DN-01.6.3.1	7	\N
12	1	ENCARREGADO DA DIVISÃO DE SISTEMAS DO CLTI	DN-01.6.3	3	\N
9	1	SUPERVISOR DA DIVISÃO DE SEGURANÇA DAS INFORMAÇÕES DIGITAIS DO CLTI	DN-01.6.2.1	5	\N
10	1	AUXILIAR DA DIVISÃO DE SEGURANÇA DAS INFORMAÇÕES DIGITAIS DO CLTI	DN-01.6.2.2	9	\N
\.


--
-- TOC entry 3844 (class 0 OID 0)
-- Dependencies: 201
-- Name: tb_funcoes_sigdem_idtb_funcoes_sigdem_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_funcoes_sigdem_idtb_funcoes_sigdem_seq', 12, true);


--
-- TOC entry 3588 (class 0 OID 18316)
-- Dependencies: 202
-- Data for Name: tb_funcoes_ti; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_funcoes_ti (idtb_funcoes_ti, descricao, sigla) FROM stdin;
1	ADMINISTRADOR DA REDE LOCAL	ADMIN
2	OFICIAL DE SEGURANÇA DAS INFORMAÇÕES E COMUNICAÇÕES	OSIC
3	TÉCNICO DE SUPORTE AO USUÁRIO	TEC.SUPORTE
4	TÉCNICO DE MANUTENÇÃO DE HARDWARE	TEC.MANUT.
5	ADMINISTRADOR DE SISTEMAS DO CLTI	ADMINCLTI
\.


--
-- TOC entry 3845 (class 0 OID 0)
-- Dependencies: 203
-- Name: tb_funcoes_ti_idtb_funcoes_ti_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_funcoes_ti_idtb_funcoes_ti_seq', 5, true);


--
-- TOC entry 3590 (class 0 OID 18321)
-- Dependencies: 204
-- Data for Name: tb_gw_om; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_gw_om (idtb_gw_om, idtb_om_apoiadas, ip_gw, status, qtde_vrf) FROM stdin;
\.


--
-- TOC entry 3846 (class 0 OID 0)
-- Dependencies: 205
-- Name: tb_gw_om_idtb_gw_om_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_gw_om_idtb_gw_om_seq', 1, false);


--
-- TOC entry 3592 (class 0 OID 18326)
-- Dependencies: 206
-- Data for Name: tb_lotacao_clti; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_lotacao_clti (idtb_lotacao_clti, idtb_posto_grad, idtb_corpo_quadro, idtb_especialidade, nip, cpf, nome, nome_guerra, status, senha, perfil, correio_eletronico, idtb_funcoes_clti, tarefa, secret, ip_acesso, cont_erro) FROM stdin;
1	16	1	8	12345678		ADMINCLTI	ADMINCLTI	INATIVO	1f82ea75c5cc526729e2d581aeb3aeccfef4407e256127614ef298fedf9376775a7d7328090f63bf	TEC_CLTI	adminclti@marinha.mil.br	\N	\N	Não ativado	0.0.0.0	0
10	8	13	32	18151299		FRANKELENE PINHEIRO DE SOUZA	FRANKELENE	ATIVO	4ffec1b96b5dcc0d22e44e16b7522383b92d9729e4eb0c1b7f6a2599d7d5b47487dd1e3ab1b828d4	TEC_CLTI	FRANKELENE@MARINHA.MIL.BR	\N	Aprov.Rel.Sv	Não ativado	0.0.0.0	0
2	8	13	25	17098602		CARLOS AUGUSTO RODRIGUES DIAS	CARLOS AUGUSTO	ATIVO	508017483633ee899396415ae9a71749412e0232e4eb0c1b7f6a2599d7d5b47487dd1e3ab1b828d4	TEC_CLTI	C.DIAS@MARINHA.MIL.BR	\N	Aprov.Rel.Sv	Não ativado	0.0.0.0	0
15	9	13	25	21371628		ADERSON JAMIER SANTOS REIS	JAMIER REIS	ATIVO	9a458afd5d42d869fb816bfd6014008a41eca3d4e4eb0c1b7f6a2599d7d5b47487dd1e3ab1b828d4	TEC_CLTI	JAMIER.REIS@MARINHA.MIL.BR	\N	\N	Não ativado	0.0.0.0	0
13	12	4	2	96114843		FRANCINALDO JOSÉ DE LACERDA	LACERDA	ATIVO	0dcba5a0c94800984c4d9a27132c31a03e465e47e4eb0c1b7f6a2599d7d5b47487dd1e3ab1b828d4	TEC_CLTI	FRANCINALDO.LACERDA@MARINHA.MIL.BR	\N	\N	Não ativado	0.0.0.0	0
11	6	11	25	00038008		LEONARDO AZEVEDO EDUARDO	EDUARDO	ATIVO	bc1771562b74fe5c7f7d0ca6e58c488072e37c47e4eb0c1b7f6a2599d7d5b47487dd1e3ab1b828d4	TEC_CLTI	LEONARDO.EDUARDO@MARINHA.MIL.BR	\N	Aprov.Rel.Sv	Não ativado	0.0.0.0	0
4	14	4	8	06039057		RAIMUNDO RUFINO DA SILVA MENDES RAULINO	RUFINO	ATIVO	d83b65ea0d496c4bd07982515fee1b1b1e6e166be4eb0c1b7f6a2599d7d5b47487dd1e3ab1b828d4	TEC_CLTI	RUFINO.MENDES@MARINHA.MIL.BR	\N	Escala de Serviço	Não ativado	0.0.0.0	0
3	16	1	8	99242991		LÚCIO ALEXANDRE CORREIA DOS SANTOS	ALEXANDRE	ATIVO	c4ce9a5fa42b7026826369e2e6faa9d3b15f03946d70db7ca89a72739f95ebbfffb25ce615fef27d	TEC_CLTI	LUCIO.ALEXANDRE@MARINHA.MIL.BR	\N	Escala de Serviço	Não ativado	0.0.0.0	0
9	15	4	26	07360649		FRANCISCO INÁCIO DO SANTOS JUNIOR	INÁCIO	ATIVO	28b80c83d1e7390e1bce3724c72d52619a718dc8e4eb0c1b7f6a2599d7d5b47487dd1e3ab1b828d4	TEC_CLTI	INACIO.SANTOS@MARINHA.MIL.BR	\N	Escala de Serviço	Não ativado	0.0.0.0	0
14	15	5	10	12136999		LAIS SOUZA E SILVA	LAIS SOUZA	ATIVO	128023fe6773aaa6d7da4b0c5752d69d1a207dcb951e2ddfef267f8353eaeff0918377488b0d2b96	TEC_CLTI	LAIS.SOUZA@MARINHA.MIL.BR	\N	Escala de Serviço	Não ativado	0.0.0.0	0
12	15	5	10	14149711		MATHEUS PINTO DA SILVA	DA SILVA	ATIVO	dfc64bac8dd3659b29744431825a04b82ffeede9e4eb0c1b7f6a2599d7d5b47487dd1e3ab1b828d4	TEC_CLTI	MATHEUS.PINTO@MARINHA.MIL.BR	\N	Escala de Serviço	Não ativado	0.0.0.0	0
6	15	5	10	13073672		IRRAYRAS FREIRE AUGUSTO	IRRAYRAS	INATIVO	95ef990e534ced8c38323c805345aed9b09526e2baaa3b1056a02ed47e3b0b994eda5db82c46ce75	TEC_CLTI	IRRAYRAS@MARINHA.MIL.BR	\N	Escala de Serviço	Não ativado	0.0.0.0	0
16	7	10	12	15089509		PAULO PESSOA DE CARVALHO FILHO	PAULO PESSOA	ATIVO	7a057a40dda48a116213cc234c97ee950ad33487e4eb0c1b7f6a2599d7d5b47487dd1e3ab1b828d4	TEC_CLTI	PAULO.PESSOA@MARINHA.MIL.BR	\N		Não ativado	0.0.0.0	0
17	15	5	10	11112832		HIAGO BRANDÃO DE MOURA	HIAGO	ATIVO	607290bfc45fb7fdc35eddbbe212a7b1b94b4851dc6f0616d82a0af06128875a25129ad5728e302a	TEC_CLTI	HIAGO.BRANDAO@MARINHA.MIL.BR	\N	Escala de Serviço	Não ativado	0.0.0.0	0
7	12	4	8	95111531		CARLOS JOSÉ NOGUEIRA DA SILVA	CARLOS JOSÉ	ATIVO	5c7439d072e6a7a25d023036332a63888570ebdce4eb0c1b7f6a2599d7d5b47487dd1e3ab1b828d4	TEC_CLTI	CARLOS.NOGUEIRA@MARINHA.MIL.BR	\N	\N	FELHWOXYPNAGINK3	0.0.0.0	0
8	16	13	31	21042624		WALLACE UBIRAJARA DE LIMA	UBIRAJARA	ATIVO	36fdd037dadb96c165f487fd161a83723e089c09e4eb0c1b7f6a2599d7d5b47487dd1e3ab1b828d4	TEC_CLTI	W.BIRAJARA@MARINHA.MIL	\N	\N	VA7EURLOA5VQSX3N	0.0.0.0	0
5	16	5	10	19091761		VALDINEI DA SILVA SANTOS	VALDINEI	ATIVO	2c31c32296b543348c7afa9df39b91c4fd56a2b5e4eb0c1b7f6a2599d7d5b47487dd1e3ab1b828d4	TEC_CLTI	VALDINEI.SANTOS@MARINHA.MIL.BR	\N	\N	YZGEN5BCUQR4UC52	0.0.0.0	0
\.


--
-- TOC entry 3847 (class 0 OID 0)
-- Dependencies: 207
-- Name: tb_lotacao_clti_idtb_lotacao_clti_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_lotacao_clti_idtb_lotacao_clti_seq', 17, true);


--
-- TOC entry 3594 (class 0 OID 18336)
-- Dependencies: 208
-- Data for Name: tb_manutencao_et; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_manutencao_et (idtb_manutencao_et, idtb_estacoes, idtb_om_apoiadas, data_entrada, data_saida, diagnostico, custo_manutencao, situacao) FROM stdin;
2	17	1	2021-09-24	\N	TROCA DE MEMÓRIA                                                                                                                                                                                                                                               	0	EM PRODUÇÃO
1	2	1	2021-01-27	\N	NÃO LIGA                                                                                                                                                                                                                                                       	0	EM PRODUÇÃO
3	17	1	2021-09-24	\N	NÃO LIGA                                                                                                                                                                                                                                                       	0	EM MANUTENÇÃO
\.


--
-- TOC entry 3848 (class 0 OID 0)
-- Dependencies: 209
-- Name: tb_manutencao_et_idtb_manutencao_et_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_manutencao_et_idtb_manutencao_et_seq', 3, true);


--
-- TOC entry 3596 (class 0 OID 18344)
-- Dependencies: 210
-- Data for Name: tb_mapainfra; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_mapainfra (idtb_mapainfra, idtb_conectividade_orig, idtb_conectividade_dest, idtb_servidores_dest, idtb_estacoes_dest, porta_orig, porta_dest, idtb_om_apoiadas) FROM stdin;
1	1	\N	\N	1	23	\N	1
2	1	\N	\N	3	20	\N	1
\.


--
-- TOC entry 3849 (class 0 OID 0)
-- Dependencies: 211
-- Name: tb_mapainfra_idtb_mapainfra_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_mapainfra_idtb_mapainfra_seq', 2, true);


--
-- TOC entry 3598 (class 0 OID 18349)
-- Dependencies: 212
-- Data for Name: tb_memorias; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_memorias (idtb_memorias, tipo, modelo, clock) FROM stdin;
1	DDR	PC-1600	200
2	DDR	PC-2100	266
3	DDR	PC-2400	300
4	DDR	PC-2700	333
5	DDR	PC-3000	370
6	DDR	PC-3200	400
7	DDR	PC-3700	466
8	DDR	PC-4000	500
9	DDR2	PC2-4200	533
10	DDR2	PC2-5300	667
11	DDR2	PC2-6400	800
12	DDR2	PC2-7400	933
13	DDR2	PC2-8500	1066
14	DDR2	PC2-9600	1200
15	DDR2	PC2-1066	1333
16	DDR3	PC3-6400	800
17	DDR3	PC3-8500	1066
18	DDR3	PC3-10600	1333
19	DDR3	PC3-12800	1600
20	DDR3	PC3-14900	1866
21	DDR3	PC3-16000	2000
22	DDR3	PC3-17000	2133
23	DDR3	PC3-19200	2400
24	DDR3	PC3-20800	2600
25	DDR3	PC3-22400	2800
26	DDR4	PC4-12800	1600
27	DDR4	PC4-14900	1866
28	DDR4	PC4-17000	2133
29	DDR4	PC4-19200	2400
30	DDR4	PC4-21300	2666
31	DDR4	PC4-25600	3200
32	DDR4	PC4-27700	3466
33	DDR4	PC4-28000	3600
34	DDR4	PC4-32000	4000
\.


--
-- TOC entry 3850 (class 0 OID 0)
-- Dependencies: 213
-- Name: tb_memorias_idtb_memorias_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_memorias_idtb_memorias_seq', 34, true);


--
-- TOC entry 3600 (class 0 OID 18357)
-- Dependencies: 214
-- Data for Name: tb_nao_padronizados; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_nao_padronizados (idtb_nao_padronizados, idtb_om_apoiadas, idtb_estacoes, autorizacao, soft_autorizados) FROM stdin;
1	1	3	OS XX/2021	KFIND, VMWARE, VIRTUALBOX
\.


--
-- TOC entry 3851 (class 0 OID 0)
-- Dependencies: 215
-- Name: tb_nao_padronizados_idtb_nao_padronizados_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_nao_padronizados_idtb_nao_padronizados_seq', 1, true);


--
-- TOC entry 3602 (class 0 OID 18365)
-- Dependencies: 216
-- Data for Name: tb_nec_aquisicao; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_nec_aquisicao (idtb_nec_aquisicao, idtb_manutencao_et, desc_nec_aquisicao, preco_cotado, previsao_aquisicao, situacao, motivo_cancelamento) FROM stdin;
\.


--
-- TOC entry 3852 (class 0 OID 0)
-- Dependencies: 217
-- Name: tb_nec_aquisicao_idtb_nec_aquisicao_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_nec_aquisicao_idtb_nec_aquisicao_seq', 1, false);


--
-- TOC entry 3604 (class 0 OID 18373)
-- Dependencies: 218
-- Data for Name: tb_numerador; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_numerador (idtb_numerador, parametro, prox_num) FROM stdin;
1	RelServico	290
\.


--
-- TOC entry 3853 (class 0 OID 0)
-- Dependencies: 219
-- Name: tb_numerador_idtb_numerador_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_numerador_idtb_numerador_seq', 1, true);


--
-- TOC entry 3606 (class 0 OID 18378)
-- Dependencies: 220
-- Data for Name: tb_om_apoiadas; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_om_apoiadas (idtb_om_apoiadas, cod_om, nome, sigla, indicativo, idtb_estado, idtb_cidade) FROM stdin;
2	83401	ESTAÇÃO RADIOGONIOMÉTRICA DA MARINHA EM NATAL	ERMN	ERMNAT	20	3302
3	83200	GRUPAMENTO DE FUZILEIROS NAVAIS DE NATAL	GPTFNNA	GRFNAT	20	3770
4	83100	COMANDO DO GRUPAMENTO DE PATRULHA NAVAL DO NORDESTE	COMGPTPATNAVNE	GPNDES	20	3770
5	83103	NAVIO-PATRULHA OCEÂNICO ARAGUARI	NPAOCARAGUARI	NPOCAR	20	3770
6	83142	NAVIO-PATRULHA GRAÚNA	NPAGRAUNA	NPAUNA	20	3770
7	83140	NAVIO-PATRULHA GRAJAÚ	NPAGRAJAU	NPAJAU	20	3770
8	83143	NAVIO-PATRULHA GOIANA	NPAGOIANA	NPAGOI	20	3770
9	83141	NAVIO-PATRULHA GUAÍBA	NPAGUAIBA	NPAIBA	20	3770
10	83171	NAVIO-PATRULHA MACAU	NPAMACAU	NPACAU	20	3770
11	83123	REBOCADOR DE ALTO-MAR TRIUNFO	RBAMTRIUNFO	RTRNFO	20	3770
12	83800	BASE NAVAL DE NATAL	BNN	BNNATL	20	3770
13	83810	CENTRO DE INTENDÊNCIA DA MARINHA EM NATAL	CEIMNA	CITNAT	20	3770
14	83601	ESCOLA DE APRENDIZES-MARINHEIROS DO CEARÁ	EAMCE	EAMFTZ	6	756
16	83701	HOSPITAL NAVAL DE NATAL	HNNA	HOSNAT	20	3770
17	83702	HOSPITAL NAVAL DE RECIFE	HNRE	HOSRCF	16	3315
15	83602	ESCOLA DE APRENDIZES-MARINHEIROS DE PERNAMBUCO	EAMPE	EAMRCF	16	3294
18	83510	SERVIÇO DE SINALIZAÇÃO NÁUTICA DO NORDESTE	SSN-3	SINDES	20	3770
20	83310	CAPITANIA DOS PORTOS DE ALAGOAS	CPAL	CPCEIO	2	147
21	83311	AGÊNCIA FLUVIAL DE PENEDO	AGPENEDO	AGNEDO	2	173
22	83320	CAPITANIA DOS PORTOS DO CEARÁ	CPCE	CPFTZA	6	756
23	83322	AGÊNCIA DA CAPITANIA DOS PORTOS EM CAMOCIM	AGCAMOCIM	AGOCIM	6	729
24	83323	AGÊNCIA DA CAPITANIA DOS PORTOS EM ARACATI	AGARACATI	AGCATI	6	710
25	83330	CAPITANIA DOS PORTOS DA PARAIBA	CPPB	CPSSOA	15	2655
26	83350	CAPITANIA DOS PORTOS DO RIO GRANDE DO NORTE	CPRN	CPNATL	20	3770
27	83351	AGÊNCIA DA CAPITANIA DOS PORTOS EM AREIA BRANCA	AGABRANCA	AGBRAN	20	3693
28	83340	CAPITANIA DOS PORTOS DE PERNAMBUCO	CPPE	CPCIFE	16	3315
19	83511	NAVIO HIDROGRÁFICO BALIZADOR COMANDANTE MANHÃES	NHIBCOMTEMANHÃES	NBHAES	20	3770
1	83000	COMANDO DO 3º DISTRITO NAVAL	COM3ºDN	TERDIS	20	3770
\.


--
-- TOC entry 3854 (class 0 OID 0)
-- Dependencies: 221
-- Name: tb_om_apoiadas_idtb_om_apoiadas_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_om_apoiadas_idtb_om_apoiadas_seq', 28, true);


--
-- TOC entry 3608 (class 0 OID 18383)
-- Dependencies: 222
-- Data for Name: tb_om_setores; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_om_setores (idtb_om_setores, idtb_om_apoiadas, nome_setor, sigla_setor, cod_funcional, compartimento) FROM stdin;
2	1	CENTRO LOCAL DE TECNOLOGIA DA INFORMAÇÃO	CLTI	DN-01.6.1	DIVISÃO DE INFRAESTRUTURA
52	1	CHEFE DO ESTADO-MAIOR	CEM	DN-02.1	CHEFE DO ESTADO-MAIOR
3	1	CENTRO LOCAL DE TECNOLOGIA DA INFORMAÇÃO	CLTI	DN-01.6.2	DIVISÃO DE SID
4	1	CENTRO LOCAL DE TECNOLOGIA DA INFORMAÇÃO	CLTI	DN-01.6.3	DIVISÃO DE SISTEMAS
5	1	CENTRO LOCAL DE TECNOLOGIA DA INFORMAÇÃO	CLTI	DN-01.6	SALA DE SERVIDORES
6	1	RÁDIO MARINHA	RM	DN-01.3	ESTÚDIO
7	1	RÁDIO MARINHA	RM	DN-01.3	SALA DE TRANSMISSORES
8	1	RÁDIO MARINHA	RM	DN-01.3	OFICINA
1	1	CENTRO LOCAL DE TECNOLOGIA DA INFORMAÇÃO	CLTI	DN-01.6	SALA DO ENCARREGADO
9	1	TELEMÁTICA	TELEMÁTICA	DN-85	SALA DO ENCARREGADO
10	1	TELEMÁTICA	TELEMÁTICA	DN-85	SALA DOS SERVIDORES
11	1	TELEMÁTICA	TELEMÁTICA	DN-85	SALA DO SUPERVISOR
12	1	TELEMÁTICA	TELEMÁTICA	DN-85	OFICINA DE INFORMÁTICA
13	1	TELEMÁTICA	TELEMÁTICA	DN-85	SALA DO ENCARREGADO
14	1	SEÇÃO DE  ORGANIZAÇÃO	SEÇÃO DE  ORGANIZAÇÃO	DN-10 	SEÇÃO DE  ORGANIZAÇÃO
15	1	SUBSEÇÃO DE  PESSOAL MILITAR	SUBSEÇÃO DE  PESSOAL MILITAR	DN-11	SUBSEÇÃO DE  PESSOAL MILITAR
16	1	SUBSEÇÃO DE  PESSOAL CIVIL	SUBSEÇÃO DE  PESSOAL CIVIL	DN-12	SUBSEÇÃO DE  PESSOAL CIVIL
17	1	SUBSEÇÃO DE  LEGISLAÇÃO	SUBSEÇÃO DE  LEGISLAÇÃO	DN-13	SUBSEÇÃO DE  LEGISLAÇÃO
18	1	SEÇÃO DE INTELIGÊNCIA	SEÇÃO DE INTELIGÊNCIA	DN-20	SEÇÃO DE INTELIGÊNCIA
19	1	SUBSEÇÃO DE INTELIGÊNCIA	SUBSEÇÃO DE INTELIGÊNCIA	DN-21	SUBSEÇÃO DE INTELIGÊNCIA
20	1	OPERACIONAL	OPERACIONAL	DN-22	OPERACIONAL
21	1	SUBSEÇÃO DE  CONTRAINTELIGÊNCIA	SUBSEÇÃO DE  CONTRAINTELIGÊNCIA	DN-23	SUBSEÇÃO DE  CONTRAINTELIGÊNCIA
22	1	SUBSEÇÃO DE PESQUISA  DE INTELIGÊNCIA	SUBSEÇÃO DE PESQUISA  DE INTELIGÊNCIA	DN-24	SUBSEÇÃO DE PESQUISA  DE INTELIGÊNCIA
23	1	SEÇÃO DE OPERAÇÕES	SEÇÃO DE OPERAÇÕES	DN-30	SEÇÃO DE OPERAÇÕES
24	1	SUBSEÇÃO DE  ADESTRAMENTO E  EMPREGO DE  MEIOS	SUBSEÇÃO DE  ADESTRAMENTO E  EMPREGO DE  MEIOS	DN-31	SUBSEÇÃO DE  ADESTRAMENTO E  EMPREGO DE  MEIOS
25	1	SUBSEÇÃO DE  PATRULHA NAVAL,  DE SOCORRO E  SALVAMENTO E DE  TRÁFEGO MARÍTIMO	SUBSEÇÃO DE  PATRULHA NAVAL,  DE SOCORRO E  SALVAMENTO E DE  TRÁFEGO MARÍTIMO	DN-32	SUBSEÇÃO DE  PATRULHA NAVAL,  DE SOCORRO E  SALVAMENTO E DE  TRÁFEGO MARÍTIMO
26	1	SEÇÃO DE LOGÍSTICA E  MOBILIZAÇÃO	SEÇÃO DE LOGÍSTICA E  MOBILIZAÇÃO	DN-40	SEÇÃO DE LOGÍSTICA E  MOBILIZAÇÃO
27	1	SUBSEÇÃO DE  PLANEJAMENTO	SUBSEÇÃO DE  PLANEJAMENTO	DN-41	SUBSEÇÃO DE  PLANEJAMENTO
28	1	SUBSEÇÃO DE  LOGÍSTICA DE  MATERIAL	SUBSEÇÃO DE  LOGÍSTICA DE  MATERIAL	DN-42	SUBSEÇÃO DE  LOGÍSTICA DE  MATERIAL
29	1	SEÇÃO DE ASSUNTOS  MARÍTIMOS	SEÇÃO DE ASSUNTOS  MARÍTIMOS	DN-50	SEÇÃO DE ASSUNTOS  MARÍTIMOS
30	1	SUBSEÇÃO DE MEIO AMBIENTE	SUBSEÇÃO DE MEIO AMBIENTE	DN-51	SUBSEÇÃO DE MEIO AMBIENTE
31	1	SUBSEÇÃO DE STA/EPM	SUBSEÇÃO DE STA/EPM	DN-52	SUBSEÇÃO DE STA/EPM
32	1	SEÇÃO INTELIGÊNCIA  MARÍTIMA	SEÇÃO INTELIGÊNCIA  MARÍTIMA	DN-60	SEÇÃO INTELIGÊNCIA  MARÍTIMA
33	1	SEÇÃO DE OPERAÇÕES  DE INFORMAÇÃO	SEÇÃO DE OPERAÇÕES  DE INFORMAÇÃO	DN-70	SEÇÃO DE OPERAÇÕES  DE INFORMAÇÃO
34	1	SUBSEÇÃO DE RELAÇÕES CIVIS	SUBSEÇÃO DE RELAÇÕES CIVIS	DN-71	SUBSEÇÃO DE RELAÇÕES CIVIS
35	1	SUBSEÇÃO DE OPERAÇÕES  PSICOLÓGIC	SUBSEÇÃO DE OPERAÇÕES  PSICOLÓGIC	DN-72	SUBSEÇÃO DE OPERAÇÕES  PSICOLÓGIC
36	1	SUBSEÇÃO DE RELAÇÕES  INSTITUCIONAIS	SUBSEÇÃO DE RELAÇÕES  INSTITUCIONAIS	DN-73	SUBSEÇÃO DE RELAÇÕES  INSTITUCIONAIS
37	1	DEPARTAMENTO DE  ADMINISTRAÇÃO	DEPARTAMENTO DE  ADMINISTRAÇÃO	DN-80	DEPARTAMENTO DE  ADMINISTRAÇÃO
38	1	DIVISÃO DE FINANÇAS E ABASTECIMENTO	DIVISÃO DE FINANÇAS E ABASTECIMENTO	DN-81	DIVISÃO DE FINANÇAS E ABASTECIMENTO
39	1	DIVISÃO DE PESSOAL	DIVISÃO DE PESSOAL	DN-82	DIVISÃO DE PESSOAL
40	1	DIVISÃO DE  MANUTENÇÃO	DIVISÃO DE  MANUTENÇÃO	DN-83	DIVISÃO DE  MANUTENÇÃO
41	1	DIVISÃO DE  SEGURANÇA ORGÂNICA	DIVISÃO DE  SEGURANÇA ORGÂNICA	DN-84	DIVISÃO DE  SEGURANÇA ORGÂNICA
43	1	DIVISÃO DE SERVIÇO  MILITAR	DIVISÃO DE SERVIÇO  MILITAR	DN-91	DIVISÃO DE SERVIÇO  MILITAR
44	1	DIVISÃO DE  MOBILIZAÇÃO E RESERVA NAVAL	DIVISÃO DE  MOBILIZAÇÃO E RESERVA NAVAL	DN-92	DIVISÃO DE  MOBILIZAÇÃO E RESERVA NAVAL
45	1	DIVISÃO DE CONCURSOS  E PROCESSOS SELETIVOS	DIVISÃO DE CONCURSOS  E PROCESSOS SELETIVOS	DN-93	DIVISÃO DE CONCURSOS  E PROCESSOS SELETIVOS
47	1	SERVIÇO DE ASSISTÊNCIA PSICOLÓGICA	SAP	DN-101	SERVIÇO DE ASSISTÊNCIA PSICOLÓGICA
46	1	NÚCLEO DE ASSISTÊNCIA  SOCIAL	NAS	DN-100	NÚCLEO DE ASSISTÊNCIA  SOCIAL
48	1	NÚCLEO DE ASSISTÊNCIA  SOCIAL	NAS	DN-102	NÚCLEO DE ASSISTÊNCIA  SOCIAL
49	1	DEPARTAMENTO DE VETERANOS E PENSIONISTAS	DEPARTAMENTO DE VETERANOS E PENSIONISTAS	DN-110	DEPARTAMENTO DE VETERANOS E PENSIONISTAS
50	1	DIVISÃO DE ATENDIMENTO AO PÚBLICO	DAP	DN-111	DIVISÃO DE ATENDIMENTO AO PÚBLICO
51	1	POSTO LOCAL DE  IDENTIFICAÇÃO DA MARINHA	POSTO LOCAL DE  IDENTIFICAÇÃO DA MARINHA	DN-112	POSTO LOCAL DE  IDENTIFICAÇÃO DA MARINHA
53	1	ASSESSORIA DE GESTÃO DE  CONTRATOS DE OBRAS CIVIS	ASSESSORIA DE GESTÃO DE  CONTRATOS DE OBRAS CIVIS	DN-02.1	ASSESSORIA DE GESTÃO DE  CONTRATOS DE OBRAS CIVIS
54	1	SERVIÇO DE ASSISTÊNCIA RELIGIOSA	SERVIÇO DE ASSISTÊNCIA RELIGIOSA	DN-02.2	SERVIÇO DE ASSISTÊNCIA RELIGIOSA
55	1	SERVIÇO DE POLÍCIA JUDICIÁRIA  MILITAR	SPJM	DN-02.3	SERVIÇO DE POLÍCIA JUDICIÁRIA  MILITAR
56	1	CHEFE GERAL DOS SERVIÇOS	CGS	DN-03	CHEFE GERAL DOS SERVIÇOS
57	1	GABINETE	GABINETE	DN-01DN-01.1	GABINETE
58	1	ASSESSORIA JURÍDICA	ASSESSORIA JURÍDICA	DN-01.2	ASSESSORIA JURÍDICA
59	1	ASSESSORIA DE GESTÃO E CONTROLE INTERNO	ASSESSORIA DE GESTÃO E CONTROLE INTERNO	DN-01.4	ASSESSORIA DE GESTÃO E CONTROLE INTERNO
60	1	CENTRO LOCAL DE TECNOLOGIA DA INFORMAÇÃO	CENTRO LOCAL DE TECNOLOGIA DA INFORMAÇÃO	DN-01.6	CENTRO LOCAL DE TECNOLOGIA DA INFORMAÇÃO
62	1	SECOM	SECOM	DN-09	SECOM
63	1	ASSESSORIA ADJUNTA DE RELAÇÕES PÚBLICAS	ASSESSORIA ADJUNTA DE RELAÇÕES PÚBLICAS	DN-01.3.1	ASSESSORIA ADJUNTA DE RELAÇÕES PÚBLICAS
64	1	ASSESSORIA ADJUNTA DE IMPRENSA	ASSESSORIA ADJUNTA DE IMPRENSA	DN-01.3.2	ASSESSORIA ADJUNTA DE IMPRENSA
65	1	ASSESSORIA ADJUNTA DE DIVULGAÇÃO	ASSESSORIA ADJUNTA DE DIVULGAÇÃO	DN-01.3.3	ASSESSORIA ADJUNTA DE DIVULGAÇÃO
42	1	SERVIÇO DE RECRUTAMENTO DISTRITA	SRD	DN-90	SERVIÇO DE RECRUTAMENTO DISTRITA
66	3	SEÇÃO DE PROCESSAMENTO DE DADOS	SPD	GPTFNNA-06	SEÇÃO DE PROCESSAMENTO DE DADOS
67	3	SEÇÃO DE OPERAÇÕES	S-3	GPTFNNA-30	SEÇÃO DE OPERAÇÕES
68	4	GABINETE	GAB	GPNDES-01	SECRETÁRIA
69	4	DIVISÃO DE INFORMÁTICA	DIV. INFO	GPNDES-53	CPD
70	4	DIVISÃO DE INFORMÁTICA	DIV.INFO	GPNDES-53	SALA DOS SERVIDORES
71	3	COMANDO	CMDO	GPTFNNA-01	GABINETE DO COMANDANTE
61	1	ASSESSORIA DE COMUNICAÇÃO SOCIAL	COMSOC	DN-01.3	ASSESSORIA DE COMUNICAÇÃO SOCIAL
72	2	CUIDADO	SQL INJECTION	00111	FALHA
73	16	DIVISÃO DE PESSOAL	DIV. PESSOAL	HNNA-21.1	SEÇÃO PESSOAL MILITAR
76	16	DIVISÃO DE PESSOAL	DIV. PESSOAL	HNNA-21	ENCARREGADO DIVISÃO DE PESSOAL
74	16	DIVISÃO DE PESSOAL	DIV. PESSOAL	HNNA-21.3	SEÇÃO DE PAGAMENTO
75	16	DIVISÃO DE PESSOAL	DIV. PESSOAL	HNNA-21.2	SEÇÃO DE PESSOAL CIVIL
77	16	DIVISÃO DE INTENDÊNCIA	DIV. INTENDÊNCIA	HNNA-22	DIVISÃO DE INTENDÊNCIA
78	18	DIVISÃO DE BALIZAMENTO	SEC. BALIZAMENTO	SSN3-11	SETOR DE BALIZAMENTO
79	18	DIVISÃO DE OPERAÇÕES	SEC. OPERAÇÕES	SSN3-31	SETOR DE OPERAÇÕES
80	18	SEÇÃO DE INFORMATICA	CPD	SSN3-26	SALA DO CPD
\.


--
-- TOC entry 3855 (class 0 OID 0)
-- Dependencies: 223
-- Name: tb_om_setores_idtb_om_setores_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_om_setores_idtb_om_setores_seq', 80, true);


--
-- TOC entry 3610 (class 0 OID 18391)
-- Dependencies: 224
-- Data for Name: tb_osic; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_osic (idtb_osic, idtb_om_apoiadas, idtb_posto_grad, idtb_corpo_quadro, idtb_especialidade, nip, cpf, nome, nome_guerra, perfil, senha, status, correio_eletronico) FROM stdin;
\.


--
-- TOC entry 3856 (class 0 OID 0)
-- Dependencies: 225
-- Name: tb_osic_idtb_osic_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_osic_idtb_osic_seq', 1, false);


--
-- TOC entry 3612 (class 0 OID 18399)
-- Dependencies: 226
-- Data for Name: tb_pad_sic_tic; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_pad_sic_tic (idtb_pad_sic_tic, idtb_om_apoiadas, ano_base, data_assinatura, data_revisao, status) FROM stdin;
1	1	2021	2021-02-04	2021-02-04	CORRENTE
2	3	2021	2020-01-08	2020-01-09	CORRENTE
\.


--
-- TOC entry 3857 (class 0 OID 0)
-- Dependencies: 227
-- Name: tb_pad_sic_tic_idtb_pad_sic_tic_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_pad_sic_tic_idtb_pad_sic_tic_seq', 2, true);


--
-- TOC entry 3614 (class 0 OID 18407)
-- Dependencies: 228
-- Data for Name: tb_pais; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_pais (id, nome, sigla) FROM stdin;
1	Brasil	BR
\.


--
-- TOC entry 3858 (class 0 OID 0)
-- Dependencies: 229
-- Name: tb_pais_id_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_pais_id_seq', 1, true);


--
-- TOC entry 3616 (class 0 OID 18412)
-- Dependencies: 230
-- Data for Name: tb_perfil_internet; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_perfil_internet (idtb_perfil_internet, nome, status) FROM stdin;
2	ARMAZENAMENTO	ATIVO
1	PADRÃO	ATIVO
3	COMUNICAÇÃO	ATIVO
4	VÍDEO	ATIVO
5	SEGURANÇA	ATIVO
6	REDES SOCIAIS	ATIVO
\.


--
-- TOC entry 3859 (class 0 OID 0)
-- Dependencies: 231
-- Name: tb_perfil_internet_idtb_perfil_internet_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_perfil_internet_idtb_perfil_internet_seq', 6, true);


--
-- TOC entry 3618 (class 0 OID 18417)
-- Dependencies: 232
-- Data for Name: tb_permissoes_admin; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_permissoes_admin (idtb_permissoes_admin, idtb_om_apoiadas, idtb_estacoes, autorizacao) FROM stdin;
1	1	1	OS Nº XX/2021
2	1	7	OS XX/2021
3	1	11	OS XX/2021
4	1	4	OS XX/2021
5	1	6	OS XX/2021
6	1	5	OS XX/2021
7	1	10	OS XX/2021
8	1	9	OS XX/2021
9	1	8	OS XX/2021
10	1	2	OS XX/2021
11	1	3	OS XX/2021
12	1	12	OS XX/2021
13	1	12	OS XX/2021
14	1	12	OS XX/2021
\.


--
-- TOC entry 3860 (class 0 OID 0)
-- Dependencies: 233
-- Name: tb_permissoes_admin_idtb_permissoes_admin_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_permissoes_admin_idtb_permissoes_admin_seq', 14, true);


--
-- TOC entry 3667 (class 0 OID 19247)
-- Dependencies: 298
-- Data for Name: tb_pessoal_excluido; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_pessoal_excluido (idtb_pessoal_excluido, idtb_om_apoiadas, nip, cpf, nome, nome_guerra, funcao, data_del, hora_del) FROM stdin;
\.


--
-- TOC entry 3861 (class 0 OID 0)
-- Dependencies: 297
-- Name: tb_pessoal_excluido_idtb_pessoal_excluido_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_pessoal_excluido_idtb_pessoal_excluido_seq', 1, false);


--
-- TOC entry 3620 (class 0 OID 18422)
-- Dependencies: 234
-- Data for Name: tb_pessoal_om; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_pessoal_om (idtb_pessoal_om, idtb_om_apoiadas, idtb_posto_grad, idtb_corpo_quadro, idtb_especialidade, nip, cpf, nome, nome_guerra, correio_eletronico, status, foradaareati) FROM stdin;
1	1	16	1	8	99242991		LÚCIO ALEXANDRE CORREIA DOS SANTOS	ALEXANDRE	LUCIO.ALEXANDRE@MARINHA.MIL.BR	ATIVO	NÃO
2	1	6	10	12	00038008		LEONARDO AZEVEDO EDUARDO	EDUARDO	LEONARDO.EDUARDO@MARINHA.MIL.BR	ATIVO	NÃO
3	1	8	13	25	17098602		CARLOS AUGUSTO RODRIGUES DIAS	CARLOS AUGUSTO	C.DIAS@MARINHA.MIL.BR	ATIVO	NÃO
5	1	12	4	2	96114843		FRANCINALDO JOSÉ DE LACERDA	LACERDA	FRANCINALDO.LACERDA@MARINHA.MIL.BR	ATIVO	NÃO
6	1	12	4	8	95111531		CARLOS JOSÉ NOGUEIRA DA SILVA	CARLOS JOSÉ	CARLOS.NOGUEIRA@MARINHA.MIL.BR	ATIVO	NÃO
8	1	15	4	26	07360649		FRANCISCO INÁCIO DO SANTOS JUNIOR	INÁCIO	INACIO.SANTOS@MARINHA.MIL.BR	ATIVO	NÃO
9	1	15	5	10	13073672		IRRAYRAS FREIRE AUGUSTO	IRRAYRAS	IRRAYRAS@MARINHA.MIL.BR	ATIVO	NÃO
7	1	14	4	8	06039057		RAIMUNDO RUFINO DA SILVA MENDES RAULINO	RUFINO	RUFINO.MENDES@MARINHA.MIL.BR	ATIVO	NÃO
10	1	15	5	10	14149711		MATHEUS PINTO DA SILVA	DA SILVA	MATHEUS.PINTO@MARINHA.MIL.BR	ATIVO	NÃO
11	1	16	5	10	19091761		VALDINEI DA SILVA SANTOS	VALDINEI	VALDINEI.SANTOS@MARINHA.MIL.BR	ATIVO	NÃO
12	1	16	13	31	21042624		WALLACE UBIRAJARA DE LIMA	UBIRAJARA	W.BIRAJARA@MARINHA.MIL	ATIVO	NÃO
13	1	16	13	8	16130189		BRENDO JACKSON LEITE DA SILVA	BRENDO	BRENDO.JACKSON@MARINHA.MIL.BR	ATIVO	NÃO
4	1	8	13	32	18151299		FRANKELENE PINHEIRO DE SOUZA	FRANKELENE	FRANKELENE@MARINHA.MIL.BR	ATIVO	NÃO
\.


--
-- TOC entry 3862 (class 0 OID 0)
-- Dependencies: 235
-- Name: tb_pessoal_om_idtb_pessoal_om_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_pessoal_om_idtb_pessoal_om_seq', 13, true);


--
-- TOC entry 3622 (class 0 OID 18430)
-- Dependencies: 236
-- Data for Name: tb_pessoal_ti; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_pessoal_ti (idtb_pessoal_ti, idtb_om_apoiadas, idtb_posto_grad, idtb_corpo_quadro, idtb_especialidade, nip, cpf, nome, nome_guerra, correio_eletronico, status, senha, idtb_funcoes_ti, secret, ip_acesso, cont_erro) FROM stdin;
2	2	14	5	3	02117517		PEDRO FRANCYS FREIRE COIMBRA	COIMBRA	PEDRO.FRANCYS@MARINHA.MIL.BR	ATIVO	44b011aaef071f8d87dd9a89b60476e4f37059df4000150ac0db7d2d141a07b120c716b40d920d76	1	Não ativado	0.0.0.0	0
11	26	8	19	12	86297091		MAX DE EDEM BARROS BORGES	MAX DE EDEM	MAX.DE.EDEM@MARINHA.MIL.BR	ATIVO	4449f57607faa6e6623643bb528c4b6ee04431045e912ea7603c06f3f836787dcfecc029b7df3b56	2	Não ativado	0.0.0.0	0
15	2	8	13	25	17098572		GUSTAVO COSTA HOLANDA	HOLANDA	HOLANDA.COSTA@MARINHA.MIL.BR	ATIVO	abff1352fd22d41e8922135cede0bc00313cf4ad234f4892b1395b45fb4fff7d9d5c34a902462e53	2	Não ativado	0.0.0.0	0
22	6	15	4	3	07364067		LEANDRO NERES NASCIMENTO	NERES	LEANDRO.NERES@MARINHA.MIL.BR	ATIVO	37db720a8ef88a995edc77126fac796d2ea0fc8f47b00c4c6b6b5588f7a4db950746f4b59b845981	1	Não ativado	0.0.0.0	0
25	5	16	4	3	13015222		MARCOS FELIPE OLIVEIRA DANTAS 	DANTAS	MARCOS.DANTAS@MARINHA.MIL.BR	ATIVO	c2a9fddab28bef207dfdb8a23d88cbc6ba96f30274a8f25dd45ff14d7fe1df95c66923356ea8daae	1	Não ativado	0.0.0.0	0
33	26	15	5	10	09097147		JOÃO MARIA DA COSTA MOURA	MOURA	JOAO.MOURA@MARINHA.MIL.BR	ATIVO	bfb6df9fd7e2fdb81398881f227b89c68e07b8366cc57c960e0ca6923c17370b668e6390b73913a5	1	Não ativado	0.0.0.0	0
32	22	15	5	10	06034641		THIAGO SOUSA DE MOURA	SOUSA MOURA	SOUSA.MOURA@MARINHA.MIL.BR	ATIVO	81b2203e33925229d474c98d2454774f61880497952271128ee17324b132e281fb71a98b8591937a	1	Não ativado	0.0.0.0	0
35	25	14	5	10	07444688		DEULLYSSES DAEL DE OLIVEIRA E SILVA	DEULLYSSES	DEULLYSSES@MARINHA.MIL.BR	ATIVO	6d1ea23cf4b4de666dcbc9e0829fd837bd3141a703107626b3fc305719ae3d26a5bb80df55ec6eea	1	Não ativado	0.0.0.0	0
26	23	21	20	12	09135201		JOSÉ WELLINGTON ARAGÃO MENEZES	WELLINGTON	WELLINGTON.MENEZES@MARINHA.MIL.BR	ATIVO	09603fae43cc980ee5b4bfcab8de5c3c6cd7764ade24fa913c57789f706bf1a0626eab9c9ab49f6a	1	Não ativado	0.0.0.0	0
52	23	7	19	12	87195151		MÁRCIO LUIZ NETO	MÁRCIO	MARCIO.NETO@MARINHA.MIL.BR	ATIVO	28579dadf3e41efc6a6b193a6fd52b57d00e242697f72b1efb5b2c27ef6ceb01c3188bff3a6919e4	2	Não ativado	0.0.0.0	0
53	12	8	13	25	19092661		FRANK WAGNER CABRAL WESNER	WESNER	WESNER@MARINHA.MIL.BR	ATIVO	62025c65442a48cd57ee12a6e7222011cdbd1e8aa734cfb77e2f93141723d9ce352805b14e0fdcb1	2	Não ativado	0.0.0.0	0
36	14	13	4	29	99185547		TIAGO BAUMGARTNER	BAUMGARTNER	BAUMGARTNER@MARINHA.MIL.BR	ATIVO	9d23f25895d81ef1dcc685387d9663b2d965d990b7086759fec5d8c8a563f35e3286de6e88f9f386	1	Não ativado	0.0.0.0	0
29	13	12	4	28	86921568		HELTON JULIANO MAFALDA	HELTON	HELTON.JULIANO@MARINHA.MIL.BR	ATIVO	4045e90f6cedcd41d1d4b01e15542d305ec8d344100218ec77cde754df7354f495f6349efff02103	1	Não ativado	0.0.0.0	0
28	1	13	5	10	00124524		KAREN DE SOUZA VIEIRA	KAREN	KAREN.SOUZA@MARINHA.MIL.BR	ATIVO	3c9de54283c326b394bec58fe90f55c909d643e187729f150af868128ec422bda2d42224772ce262	1	Não ativado	0.0.0.0	0
34	16	6	21	25	81921241		MARCIA MARIA MARQUES DA SILVA	MARCIA	MARCIA.MARQUES@MARINHA.MIL.BR	ATIVO	dda193875295116867a349cc720784991c22d253c25c1d2994195e32160f827f7d8187290b30f7e8	2	Não ativado	0.0.0.0	0
55	20	12	4	8	86911414		SANDRO CORRÊA BIELLA	BIELLA	SANDRO.BIELLA@MARINHA.MIL.BR	ATIVO	79c27d8a449d481cb629afba9243d456ea1fe8734e0671abfd3a8f43e653819368ce52998a87ff2e	1	Não ativado	0.0.0.0	0
57	15	9	13	25	19092407		WILLIAM LUÍS LIMA PEREIRA	LUÍS LIMA	LIMA.LUIS@MARINHA.MIL.BR	ATIVO	32c26335ec9be905ea87b274f79f6a2e1712e27348e543cae193a9c450d199cf0f949befea148bd2	2	Não ativado	0.0.0.0	0
62	19	16	4	30	16012348		ERICK FERREIRA CALZAVARA	ERICK	ERICK.CALZAVARA@MARINHA.MIL.BR	ATIVO	8be7436d64f1c801bb32134c5fa17aa078e937a6d5c9d2f6d4a67d9e2a781085db9b0d6fc4968fb1	1	Não ativado	0.0.0.0	0
65	10	15	4	26	07384939		BENNYSON EMANUELL DE SOUSA	EMANUELL	EMANUELL.SOUSA@MARINHA.MIL.BR	ATIVO	9266284559d7b38956d5aa288e81c21c5f4e9d88617b713e0ca29bcb2f2d082583e22c08989935e7	1	Não ativado	0.0.0.0	0
66	8	7	11	12	07340885		CAIO CORDEIRO QUEIROZ	CORDEIRO	CAIO.CORDEIRO@MARINHA.MIL.BR	ATIVO	309c54e7de7bf4f6d9f5b9032fcbcec0759b8c95e9375214cc6cdcc4f28ea196960a242100625e02	2	Não ativado	0.0.0.0	0
67	8	16	4	3	16006674		LUAN KENNEDY LIMA BITENCOURT DA CRUZ	DAVID	LUAN.BITENCOURT@MARINHA.MIL.BR	ATIVO	14b93a0f1ccbb3c97bdfdb6baf909918bc39c5d6417ed32ff40a860cb1a76bce4cd5c1d857212c04	1	Não ativado	0.0.0.0	0
70	7	16	4	3	16034244		GUSTAVO DE SOUZA DIAS DE OLIVEIRA	DIAS	DIAS.GUSTAVO@MARINHA.MIL.BR	ATIVO	e77452a1c70c01170dd36b90376ec0b2c8948b443285d49f6c52d58a70dc8cdfeade92d0f8fb2a9b	1	Não ativado	0.0.0.0	0
51	24	14	4	24	06020607		THIAGO ANASTÁCIO DA SILVA	ANASTÁCIO	THIAGO.ANASTACIO@MARINHA.MIL.BR	ATIVO	56e74a47e305fa318695ce745ac459f3ff4ef1fa83336f9713b927d21a26ed3b090529d918e91f31	1	Não ativado	0.0.0.0	0
14	18	13	4	27	99186594		ODIVANILDO GOUVEIA DE SOUSA	GOUVEIA	ODIVANILDO.GOUVEIA@MARINHA.MIL.BR	ATIVO	2d5373068ea51cb292557c1e7cad4cef050a2361a720dc6cba01c92297f4db57a9de074aabcf84a4	1	Não ativado	0.0.0.0	0
75	16	19	13	23	15069001		DERICK ETIENE DE MELO SILVA	MELO	DERICKETIENE2@GMAIL.COM	ATIVO	645efb11900b2348218533b16a80723c8bf3d93be97394329738614e38ac75ef5c3e303d03ba80fb	3	Não ativado	0.0.0.0	0
59	4	15	4	3	06029663		LEANDRO MARQUES DE CARVALHO	CARVALHO	LEANDRO.MARQUES@MARINHA.MIL.BR	ATIVO	23f5ce612859464fe6f069982d740c8d80e8ca48c54d9f953a30e2f9f37b68c820ce006e8042b571	1	Não ativado	0.0.0.0	0
61	3	13	3	9	96010690		ANAXMANDRO PEREIRA DA SILVA	ANAXMANDRO	ANAXMANDRO.SILVA@MARINHA.MIL.BR	ATIVO	53f9a342e40b36560c7d7c4adb1024487d6f43614b571255d5ccee596ad5c58597fa854f35d70338	1	Não ativado	0.0.0.0	0
77	16	19	13	23	16047532		AIALIS ARAÚJO DA SILVA	AIALIS	AIALIS@GMAIL.COM	ATIVO	bd5c4b5acf9bb7ea8890037f759d713de81ed4afbd5c4b5acf9bb7ea8890037f759d713de81ed4af	3	Não ativado	0.0.0.0	0
79	9	9	2	12	87375591		JONATAS ALVES SILVA SOARES	SILVA SOARES	JONATAS.ALVES@MARINHA.MIL.BR	ATIVO	95aeed09dde2b4dac749c3d5f0d125a66d2af8b4eb7c09835c6c27c0920c9b998e1dd45e3a195d3a	2	Não ativado	0.0.0.0	0
83	11	15	4	8	11037610		JONATHAN ERICK SAMPAIO DE BARROS SILVA	ERICK	JONATHAN.BARROS@MARINHA.MIL.BR	ATIVO	eac912f39ce668cc732b2404542c3e921041ac0572e9a48dbbe51b6dc0fb06685b0a9a06f4037f02	1	Não ativado	0.0.0.0	0
86	6	9	2	12	12046744		BRENO GOMES STORCH	BRENO STORCH	BRENO.STORCH@MARINHA.MIL.BR	ATIVO	80d3da3854f297f57862856c2e6877aef6d789c3875792e010a6f8b49e64792841623e12111484d2	2	Não ativado	0.0.0.0	0
87	21	7	19	12	87297027		CARLOS OTÁVIO CORREIA DE ALCÂNTARA	OTÁVIO	CARLOS.OTAVIO@MARINHA.MIL.BR	ATIVO	b0c8fff862273c43e21eacf4373e9bb6f15a3fa583e425b1aecf52151e3ef20352c32bbf23692c5f	2	Não ativado	0.0.0.0	0
90	27	15	5	10	86689185		LILIAN ARAGÃO TORRES	LILIAN	LILIAN.TORRES@MARINHA.MIL.BR	ATIVO	84f31ab0be746fd24375e0036fc0d6bd30e356e8ed844e0debc15321be08c095f2fb98e001f2aadb	1	Não ativado	0.0.0.0	0
84	9	16	4	3	15027881		IGOR ARQUEU DE LIMA AZEVEDO	ARQUEU	IGOR.ARQUEU@MARINHA.MIL.BR	ATIVO	e83dcd1bd14d6064338d9f185b4fef53860464ebeb7c09835c6c27c0920c9b998e1dd45e3a195d3a	1	Não ativado	0.0.0.0	0
96	7	9	4	12	13032330		MATHEUS PEREIRA DA SILVA	PEREIRA	MATHEUS.PEREIRA.SILVA@MARINHA.MIL.BR	ATIVO	06b7d2ec9adbf42ba8b0e80be4e8038cd44cf0b6a09c666031da1123ada22fa74b9bb8f60a5668e1	2	Não ativado	0.0.0.0	0
97	25	6	19	12	95013474		ROGERIO FERNANDES DA COSTA	COSTA	ROGERIO.COSTA@MARINHA.MIL.BR	ATIVO	995c818d39b18b1bb121a37b8e41b43c22a09a37adfa15367c5ea8c7e0a8f4501d62d8c8239dbf1b	2	Não ativado	0.0.0.0	0
92	28	15	5	10	13126628		MARIA VANESSA GONÇALO DA COSTA	MARIA	MARIA.VANESSA@MARINHA.MIL.BR	ATIVO	67128698e636eb756f1f7d27242b59c250eb35d51ad22b982ebb89c355d9ee50eb069df24ef3b737	1	Não ativado	0.0.0.0	0
93	12	14	4	21	04012739		EMERSON DE ALMEIDA DA SILVA	EMERSON	EMERSON.ALMEIDA@MARINHA.MIL.BR	ATIVO	607a9eb4093f81ed650478acccb089c52e239e356c74511499079c072e4942a8b90fccd1d1f83a9b	1	Não ativado	0.0.0.0	0
94	27	7	19	12	86967550		ELCIMAR MACHADO DA SILVA	ELCIMAR	ELCIMAR@MARINHA.MIL.BR	ATIVO	701221250a908d53dbb0aabd6f8a97eaf5b992c76eb4e2d6a3516654d8ce9c4af3a5d97c589b5b2c	2	Não ativado	0.0.0.0	0
95	19	8	2	12	09023330		GUSTAVO LUIS PESSANHA FERREIRA	PESSANHA	GUSTAVO.PESSANHA@MARINHA.MIL.BR	ATIVO	a4db9ea19477ec249315ca57cff7fc89bbf618783791439e08405cdcc22b87f9cbf1d6a6083991d3	2	Não ativado	0.0.0.0	0
1	1	16	1	8	99242991		LÚCIO ALEXANDRE CORREIA DOS SANTOS	ALEXANDRE	LUCIO.ALEXANDRE.SANTOS@GMAIL.COM	ATIVO	c4ce9a5fa42b7026826369e2e6faa9d3b15f0394cfa2e07cce7164559deb40983ccefed9255e11bd	5	Não ativado	0.0.0.0	0
98	15	15	5	10	14142872		PEDRO RAFAEL LEAL DA SILVA BEZERRA	PEDRO	RAFAEL.LEAL@MARINHA.MIL.BR	ATIVO	fcc6c8bcc0507ee298f3789201aead7b8c3c93b126d9cc86152d7285c4b9b2208a281f88b08a8609	1	Não ativado	0.0.0.0	0
100	24	7	2	12	13082388		ANDERSON DE OLIVEIRA PAULA	ANDERSON	ANDERSON.PAULA@MARINHA.MIL.BR	ATIVO	e930a89b2493663dba00e1b93fabf9a3601905b2e98c1d5f3afe97cc9c166fa7280966d3332e4574	2	Não ativado	0.0.0.0	0
102	22	5	11	12	06624391		SIDNEY GOUVEIA DA SILVA	SIDNEY	SIDNEY.GOUVEIA@MARINHA.MIL.BR	ATIVO	e374a985bd8c2fffb4ad86d34d8be5d875f6ea4e0315f3e94cf9e62814a6588e2e6ff34c56e00e4a	2	Não ativado	0.0.0.0	0
103	28	8	13	25	20343621		EVELYN BRAGA CUNHA	EVELYN	EVELYN.CUNHA@MARINHA.MIL.BR	ATIVO	f50f90b52830722c41964a18b4ba32dd2d2763a26ac68b257ab2da0c81d594a74daf926b1d6f7fef	2	Não ativado	0.0.0.0	0
104	14	7	23	13	15089827		NAYARA PEREIRA LOBO	NAYARA LOBO	NAYARA.LOBO@MARINHA.MIL.BR	ATIVO	ac38ab42e2ac6c164680d99c5348f89ab528bf3306838f575f655251a27149bc81b8e058d936f336	2	Não ativado	0.0.0.0	0
105	17	8	13	12	20345828		MARCELO SOARES DOS SANTOS	MARCELO	MARCELO-SOARES.SANTOS@MARINHA.MIL.BR	ATIVO	e40b46af2a76d307ccd7b300d552fd79f6bfd4d9f4c9726a6c4072da71a2199822a4394624737b80	2	Não ativado	0.0.0.0	0
106	10	8	22	12	16049993		RICARDO MIRANDA CIDRAL	CIDRAL	CIDRAL@MARINHA.MIL.BR	ATIVO	32bf48e296ab3e6c56aa42440eee13a76618f7b70f8ce69deb5b727e3e003c47bc1663558556cc87	2	Não ativado	0.0.0.0	0
107	5	8	4	12	09023887		JOÃO CARLOS PEREIRA DE ABREU	JOÃO ABREU	JOAO.ABREU@MARINHA.MIL.BR	ATIVO	e449b4df5b06783dfe8479fed734a74e991785db4581b4666848b9e410ded9fa98279ae53523def7	2	Não ativado	0.0.0.0	0
108	11	9	4	12	95091041		EVERTON ALVARINHO DE OLIVEIRA	EVERTON	EVERTON.ALVARINHO@MARINHA.MIL.BR	ATIVO	86646bcc33b086e23af34a9aade5ddbe6f223f6a642e9ee727f022f619e6257b55e9d12963de3d15	2	Não ativado	0.0.0.0	0
110	3	9	1	13	12047163		ADRIEL HEBER MAX GUIMARÃES	ADRIEL	ADRIEL.HEBER@MARINHA.MIL.BR	ATIVO	44b217933f5a3524eaf9eb2c7d18401c421da0b30f04f93f4579bee2690dcf0567e017c5bd1486af	2	Não ativado	0.0.0.0	0
85	20	6	2	12	00036161		ROBERTO WALLACE BRAGA LATA JÚNIOR	ROBERTO WALLACE	ROBERTO.WALLACE@MARINHA.MIL.BR	ATIVO	e3914732974dd85067037b3c343dc91cc650c8641e71b1d44f7df03ae2bf08b5c53056af8533d5b4	2	Não ativado	0.0.0.0	0
109	18	9	19	12	85725196		RAFAEL ARAUJO SZAZ	SZAZ	SZAZ@MARINHA.MIL.BR	ATIVO	4d551eb68cef0abd3af165aa0b90fd575e16e47f69e35bab0fcb4c478290f9fe23c56b78e7bc164f	2	Não ativado	0.0.0.0	0
101	13	8	9	12	09022686		REINALDO ALMEIDA DAS CHAGAS JUNIOR	REINALDO	REINALDO.CHAGAS@MARINHA.MIL.BR	ATIVO	6328d53a1335f75dc5e7fee95564242bd0b524926ba959bc445821e88c41a4595213c312c3bb487d	2	Não ativado	0.0.0.0	0
80	1	8	13	25	18103251		DIEGO VITOR SOARES DOS SANTOS	VITOR	DIEGO.VITOR@MARINHA.MIL.BR	ATIVO	e5d51ec7106c2fd5c54439f568d6e359b67d5129e3c699d88a4b32c86e5853062728ab0e03068d99	2	Não ativado	0.0.0.0	0
89	1	15	5	10	07351836		ALEX CAETANO BARBOSA	ALEX	ALEX.CAETANO@MARINHA.MIL.BR	ATIVO	0a6873fd676fb06f30c22648d99069227b981464e7b348cb5a08159e24385eab2336b15cb58c22c5	1	Não ativado	0.0.0.0	0
76	16	19	13	23	13050311		CHRISTYAN JORDAN BARROS FERREIRA	JORDAN	CHRISTYANSRN@GMAIL.COM	INATIVO	c7f9175e30e309c7f01930c88e9a1e79a221a426c7f9175e30e309c7f01930c88e9a1e79a221a426	3	Não ativado	0.0.0.0	0
111	21	15	5	10	15163725		FABIANO DO NASCIMENTO CELESTINO	CELESTINO	FABIANO.CELESTINO@MARINHA.MIL.BR	ATIVO	a84d2fab7b7d3c5a8e667843a145b8d9f941f252abae9f368c6b1c7f3de70b8b8c12f0d172268845	1	Não ativado	0.0.0.0	0
114	17	15	5	10	12134414		MANOEL DE ANDRADE DOMINGOS	DOMINGOS	MANOEL.DOMINGOS@MARINHA.MIL.BR	ATIVO	844500653b41d365e4c9d65e5d5a15916e2dc910f4c9726a6c4072da71a2199822a4394624737b80	1	Não ativado	0.0.0.0	0
113	4	7	4	12	14088975		MAURICIO BARROS DE SOUZA	MAURICIO BARROS	MAURICIO.BARROS@MARINHA.MIL.BR	ATIVO	2417507ea8ae316619ba1b9c2a6ad57e02ba53e912eb60344b218b3250f6c01e09ea121621112ebc	2	Não ativado	0.0.0.0	0
115	16	15	5	10	13073672		IRRAYRAS FREIRE AUGUSTO	IRRAYRAS	IRRAYRAS@MARINHA.MIL.BR	ATIVO	95ef990e534ced8c38323c805345aed9b09526e2e2a783d9d7f3dd562d9f763a453c52ad278a53b6	1	Não ativado	0.0.0.0	0
116	16	19	13	23	17047943		LUCAS MATEUS SALVIANO DA SILVA	SALVIANO	TESTE@MARINHA.MIL.BR	ATIVO	f36e176dd49ee1f98788832d99112ec511c376b0ac425e42c5fe32581d64d481cf3592c7cd7ffd6b	3	Não ativado	0.0.0.0	0
\.


--
-- TOC entry 3863 (class 0 OID 0)
-- Dependencies: 237
-- Name: tb_pessoal_ti_idtb_pessoal_ti_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_pessoal_ti_idtb_pessoal_ti_seq', 116, true);


--
-- TOC entry 3624 (class 0 OID 18438)
-- Dependencies: 238
-- Data for Name: tb_posto_grad; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_posto_grad (idtb_posto_grad, nome, sigla) FROM stdin;
1	Almirante-de-Esquadra	AE
2	Vice-Almirante	VA
3	Contra-Almirante	CA
4	Capitão-de-Mar-e-Guerra	CMG
5	Capitão-de-Fragata	CF
6	Capitão-de-Corveta	CC
7	Capitão-Tenente	CT
10	Guarda-Marinha	GM
11	Aspirante	ASP
12	Suboficial	SO
16	Cabo	CB
17	Soldado	SD
18	Marinheiro Especializado	MN-ESP
19	Marinheiro	MN
20	Marinheiro Recruta	MN-RC
13	PRIMEIRO-SARGENTO	1ºSG
8	PRIMEIRO-TENENTE	1ºTEN
21	SERVIDOR CIVIL	SC
9	SEGUNDO-TENENTE	2ºTEN
14	SEGUNDO-SARGENTO	2ºSG
15	TERCEIRO-SARGENTO	3ºSG
\.


--
-- TOC entry 3864 (class 0 OID 0)
-- Dependencies: 239
-- Name: tb_posto_grad_idtb_posto_grad_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_posto_grad_idtb_posto_grad_seq', 21, true);


--
-- TOC entry 3626 (class 0 OID 18443)
-- Dependencies: 240
-- Data for Name: tb_proc_fab; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_proc_fab (idtb_proc_fab, nome) FROM stdin;
1	INTEL
2	AMD
3	
\.


--
-- TOC entry 3865 (class 0 OID 0)
-- Dependencies: 241
-- Name: tb_proc_fab_idtb_proc_fab_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_proc_fab_idtb_proc_fab_seq', 3, true);


--
-- TOC entry 3628 (class 0 OID 18448)
-- Dependencies: 242
-- Data for Name: tb_proc_modelo; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_proc_modelo (idtb_proc_modelo, idtb_proc_fab, modelo) FROM stdin;
1	1	CELERON
2	1	CORE 2 DUO
3	1	Core 2 Extreme
4	1	Core 2 Quad
5	1	Pentium 4
6	1	Pentium D
7	1	Pentium Dual Core
8	1	Pentium Extreme
9	1	Xeon
10	1	Core i3
11	1	Core i5
12	1	Core i7
13	1	Core i7 Extreme Edition
15	2	Athlon FX
16	2	AthlonX2
17	2	Dual-core Opteron
18	2	Sempron
19	2	Sempron X2
20	2	Athlon X2
21	2	Phenom
22	2	Phenom II X2
23	2	Phenom II X3
24	2	Phenom II X4
25	2	Phenom II X6
26	2	Athlon II
27	2	Dual-Core A4 3300
28	2	Dual-Core A4 3400
29	2	Triple-Core A6 3500
30	2	Quad-core A6 3650
31	2	Quad-core A6 3650K Black Edition
32	2	Quad-core A8 3850
33	2	Quad-core A8 3870K Black Edition
34	2	Dual-Core A4 4000
35	2	Dual-Core 5300
36	2	Dual-Core 6300
37	2	Dual-Core A6 5400K
38	2	Quad-Core A8 5500
39	2	Quad-Core A8 5600K
40	2	Quad-Core A8 6500
41	2	Quad-Core A8 6600K
42	2	Quad-Core A10 5700
43	2	Quad-Core A8 6700
44	2	Quad-Core A8 5800K
45	2	Quad-Core A8 6790K
46	2	Quad-Core A8 6800K
14	2	ATHLON 64
47	2	RYZEN 5 1600 SIX-CORE
48	1	XEON E5-2630 V4
49	1	XEON E5-2630 V2
50	1	XEON E5649
51	1	XEON X5675
52	1	XEON E3-1220 V5
53	1	CORE I5-2320
54	1	CORE I3-3240
55	1	PENTIUM G3260
56	1	CORE I5-2400
57	1	XEON E5-2430 V2
58	1	XEON E5-2620
59	1	I7-3612QM
\.


--
-- TOC entry 3866 (class 0 OID 0)
-- Dependencies: 243
-- Name: tb_proc_modelo_idtb_proc_modelo_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_proc_modelo_idtb_proc_modelo_seq', 59, true);


--
-- TOC entry 3630 (class 0 OID 18453)
-- Dependencies: 244
-- Data for Name: tb_qualificacao_clti; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_qualificacao_clti (idtb_qualificacao_clti, nome_curso, instituicao, data_conclusao, carga_horaria, tipo, custo, meio, situacao, idtb_lotacao_clti) FROM stdin;
38	GESTÃO DE RISCOS DE TI - NBR 27005 E 27701	ESCOLA SUPERIOR DE REDES (ESR)	2020-11-20	40	LIVRE	R$ 0,00	EAD	CONCLUÍDO	2
36	CYBERSECURITY ESSENTIALS	ESCOM-EB	\N	30	LIVRE	R$ 0,00	EAD	EM ANDAMENTO	15
37	LINUX BEGINNERS IN CLOUD ONLINE	4LINUX	2020-06-15	20	LIVRE	R$ 0,00	EAD	CONCLUÍDO	2
21	CURSO GERAL DE PROPRIEDADE INTELECTUAL À DISTÂNCIA	WORLD INTELECTUAL PROPERTY ORGANIZATION - WIPO	2017-07-07	75	LIVRE	R$ 0,00	EAD	CONCLUÍDO	3
20	ZABBIX: CONSTRUINDO UM AMBIENTE DE MONITORAMENTO	UDEMY	2018-05-07	9	LIVRE	R$ 0,00	EAD	CONCLUÍDO	3
11	PYTHON	DEVMEDIA	2017-07-16	66	LIVRE	R$ 0,00	EAD	CONCLUIÍDO	3
22	MBA EM TELECOMUNICAÇÕES COM ÊNFASE EM REDES, SISTEMAS DE INFORMAÇÃO E INTERNET DAS COISAS	FACUMINAS	\N	1440	POSGRAD	R$ 0,00	EAD	EM ANDAMENTO	3
24	CURSO DE DEFESA CIBERNÉTICA	UNIVERSIDADE DAS FORÇAS ARMADAS DO EQUADOR	\N	50	LIVRE	R$ 0,00	EAD	EM ANDAMENTO	11
25	CURSO DE DEFESA CIBERNÉTICA	UNIVERSIDADE DAS FORÇAS ARMADAS DO EQUADOR	\N	50	LIVRE	R$ 0,00	EAD	EM ANDAMENTO	3
26	CURSO DE DEFESA CIBERNÉTICA	UNIVERSIDADE DAS FORÇAS ARMADAS DO EQUADOR	\N	50	LIVRE	R$ 0,00	EAD	EM ANDAMENTO	4
2	SEGURANÇA DA INFORMAÇÃO	UNIVERSIDADE ESTÁCIO DE SÁ	\N	361	POSGRAD	R$ 0,00	EAD	EM ANDAMENTO	4
28	NETWORK DEFENSE ESSENTIALS	ENADCIBER	\N	10	LIVRE	R$ 0,00	EAD	EM ANDAMENTO	16
27	NETWORK DEFENSE ESSENTIALS	ENADCIBER	\N	10	LIVRE	R$ 0,00	EAD	EM ANDAMENTO	11
29	NETWORK DEFENSE ESSENTIALS	ENADCIBER	\N	10	LIVRE	R$ 0,00	EAD	EM ANDAMENTO	15
30	NETWORK DEFENSE ESSENTIALS	ENADCIBER	\N	10	LIVRE	R$ 0,00	EAD	EM ANDAMENTO	4
31	NETWORK DEFENSE ESSENTIALS	ENADCIBER	\N	10	LIVRE	R$ 0,00	EAD	EM ANDAMENTO	14
32	NETWORK DEFENSE ESSENTIALS	ENADCIBER	\N	10	LIVRE	R$ 0,00	EAD	EM ANDAMENTO	6
33	NETWORK DEFENSE ESSENTIALS	ENADCIBER	\N	10	LIVRE	R$ 0,00	EAD	EM ANDAMENTO	5
34	CYBERSECURITY ESSENTIALS	ESCOM-EB	\N	30	LIVRE	R$ 0,00	EAD	EM ANDAMENTO	16
35	CYBERSECURITY ESSENTIALS	ESCOM-EB	\N	30	LIVRE	R$ 0,00	EAD	EM ANDAMENTO	10
19	TENSOR FLOW: MACHINE LEARNING AND DEEP LEARNING PYTHON	UDEMY	2021-03-17	19	LIVRE	R$ 0,00	EAD	CONCLUÍDO	3
43	ITIL V3	EXIN	2013-12-20	24	CERTIFICAÇÃO	R$ 0,00	PRESENCIAL	CONCLUÍDO	2
3	GESTÃO DA TECNOLOGIA DA INFORMAÇÃO	UNIVERSIDADE ESTÁCIO DE SÁ	2020-08-26	2145	GRADUAÇÃO	R$ 0,00	EAD	CONCLUÍDO	4
4	ANÁLISE E DESENVOLVIMENTO DE SISTEMAS	UNIVERSIDADE ESTÁCIO DE SÁ	2021-08-23	2145	GRADUAÇÃO	R$ 0,00	EAD	CONCLUÍDO	3
18	PREPARATÓRIO PARA LPIC-1 COMPTIA+	UDEMY	2019-03-11	28	LIVRE	R$ 0,00	EAD	CONCLUÍDO	3
1	NR-35-TRABALHO EM ALTURA	SERVIÇOS TÉCNICOS DE ENGENHARIA LTDA	2020-12-08	8	LIVRE	R$ 0,00	PRESENCIAL	CONCLUÍDO	4
42	NDG LINUX ESSENTIALS	NETACAD - CISCO	2021-12-17	70	LIVRE	R$ 0,00	EAD	CONCLUÍDO	2
41	REDES DE COMPUTADORES	IMD - UFRN	2016-08-10	1000	TÉCNICO	R$ 0,00	SEMIPRESENCIAL	CONCLUÍDO	2
40	REDES DE COMPUTADORES	UNIRN	2012-12-31	360	POSGRAD	R$ 0,00	PRESENCIAL	CONCLUÍDO	2
39	SISTEMAS DE INFORMAÇÃO	UNIRN	2008-12-31	3600	BACHARELADO	R$ 0,00	PRESENCIAL	CONCLUÍDO	2
17	CURSO COMPLETO DE BANCOS DE DADOS SQL	UDEMY	2020-09-26	58	LIVRE	R$ 0,00	EAD	CONCLUÍDO	3
16	INFRAESTRUTURA DE TI COM SAMBA4/PFSENSE/AD/FILE SERVER	UDEMY	2020-12-09	16	LIVRE	R$ 0,00	EAD	CONCLUÍDO	3
15	PYTHON PARA MINERAÇÃO DE DADOS	UDEMY	2020-10-22	3	LIVRE	R$ 0,00	EAD	CONCLUÍDO	3
14	AMBIENTE DE DESENVOLVIMENTO PARA ANDROID	DEVMEDIA	2017-12-24	6	LIVRE	R$ 0,00	EAD	CONCLUÍDO	3
13	DESENVOLVIMENTO COM MVC	DEVMEDIA	2018-01-20	2	LIVRE	R$ 0,00	EAD	CONCLUÍDO	3
12	CERTIFICADOS DIGITAIS	DEVMEDIA	2018-01-20	3	LIVRE	R$ 0,00	EAD	CONCLUÍDO	3
10	CURSO DE POSTGRESQL	DEVMEDIA	2018-01-20	35	LIVRE	R$ 0,00	EAD	CONCLUÍDO	3
9	CURSO BÁSICO DE IPV6 - A DISTÂNCIA,	CEPTRO.BR	2020-06-01	25	LIVRE	R$ 0,00	EAD	CONCLUÍDO	3
8	INI.100.0001-INSTALAÇÕES ELÉTRICAS EM BAIXA TENSÃO RESIDENCIAL	SENAI	2020-06-01	100	LIVRE	R$ 0,00	EAD	CONCLUÍDO	3
7	WEB PROGRAMMING WITH PYTHON AND JAVASCRIPT	HARVARD UNIVERSITY - EDX HARVARDX	2021-09-23	140	LIVRE	R$ 0,00	EAD	CONCLUÍDO	3
6	TENSORFLOW: MACHINE LEARNING E DEEP LEARNING COM PYTHON	UDEMY	2021-03-17	19	LIVRE	R$ 0,00	EAD	CONCLUÍDO	3
5	TECNOLOGIAS EM REDES DE COMPUTADORES	INSTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA DO RIO GRANDE DO NORTE	2021-12-10	2437	GRADUAÇÃO	R$ 0,00	PRESENCIAL	CONCLUÍDO	3
23	ANTENAS E PROPAGAÇÃO	BETA TELECOM	2022-05-17	12	LIVRE	R$ 0,00	EAD	CONCLUÍDO	10
44	CURSO EXPEDITO DE TÉCNICA DE ENSINO (C-EXP-TE)	EAMCE	\N	70	EXPEDITO	R$ 0,00	PRESENCIAL	EM ANDAMENTO	4
45	CURSO EXPEDITO DE TÉCNICA DE ENSINO (C-EXP-TE)	EAMCE	\N	70	EXPEDITO	R$ 0,00	PRESENCIAL	EM ANDAMENTO	9
46	PROTEÇÃO DE DADOS PESSOAIS NO SETOR PÚBLICO	ENAP	2022-05-26	15	LIVRE	R$ 0,00	EAD	CONCLUÍDO	2
\.


--
-- TOC entry 3867 (class 0 OID 0)
-- Dependencies: 245
-- Name: tb_qualificacao_clti_idtb_qualificacao_clti_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_qualificacao_clti_idtb_qualificacao_clti_seq', 46, true);


--
-- TOC entry 3632 (class 0 OID 18461)
-- Dependencies: 246
-- Data for Name: tb_qualificacao_ti; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_qualificacao_ti (idtb_qualificacao_ti, nome_curso, instituicao, data_conclusao, carga_horaria, tipo, custo, meio, situacao, idtb_pessoal_ti) FROM stdin;
\.


--
-- TOC entry 3868 (class 0 OID 0)
-- Dependencies: 247
-- Name: tb_qualificacao_ti_idtb_qualificacao_ti_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_qualificacao_ti_idtb_qualificacao_ti_seq', 4, true);


--
-- TOC entry 3659 (class 0 OID 19166)
-- Dependencies: 290
-- Data for Name: tb_range_ip; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_range_ip (idtb_range_ip, idtb_om_apoiadas, sub_rede, mascara) FROM stdin;
\.


--
-- TOC entry 3869 (class 0 OID 0)
-- Dependencies: 289
-- Name: tb_range_ip_idtb_range_ip_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_range_ip_idtb_range_ip_seq', 1, false);


--
-- TOC entry 3634 (class 0 OID 18469)
-- Dependencies: 248
-- Data for Name: tb_registro_log; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_registro_log (idtb_registro_log, data_acao, acao, nip_cps_resp) FROM stdin;
\.


--
-- TOC entry 3870 (class 0 OID 0)
-- Dependencies: 249
-- Name: tb_registro_log_idtb_registro_log_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_registro_log_idtb_registro_log_seq', 1, false);


--
-- TOC entry 3636 (class 0 OID 18474)
-- Dependencies: 250
-- Data for Name: tb_rel_servico; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_rel_servico (idtb_rel_servico, sup_sai_servico, sup_entra_servico, num_rel, data_entra_servico, data_sai_servico, cel_funcional, sit_servidores, sit_backup, status) FROM stdin;
26	8	5	26	2021-08-18	2021-08-19	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
27	5	3	27	2021-08-19	2021-08-20	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
15	8	5	15	2021-08-03	2021-08-04	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
16	5	3	16	2021-08-04	2021-08-05	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
35	9	4	35	2021-08-31	2021-09-01	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
17	3	8	17	2021-08-05	2021-08-06	Funcionando normalmente	Operando normalmente	Com observações	Sup. que entra ciente
2	8	3	2	2021-07-15	2021-07-16	Funcionando normalmente	Operando normalmente	Executado normalmente	Relatório aprovado
4	4	9	4	2021-07-19	2021-07-20	Funcionando normalmente	Operando normalmente	Executado normalmente	Relatório aprovado
28	3	9	28	2021-08-20	2021-08-23	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
18	8	9	18	2021-08-06	2021-08-09	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
19	9	8	19	2021-08-09	2021-08-10	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
8	9	4	8	2021-07-23	2021-07-26	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
20	8	5	20	2021-08-10	2021-08-11	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
9	4	8	9	2021-07-26	2021-07-27	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
29	9	4	29	2021-08-23	2021-08-24	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
21	5	3	21	2021-08-11	2021-08-12	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
10	8	3	10	2021-07-27	2021-07-28	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
11	3	5	11	2021-07-28	2021-07-29	Funcionando normalmente	Com observações	Executado normalmente	Sup. que entra ciente
1	3	8	1	2021-07-14	2021-07-15	Funcionando normalmente	Operando normalmente	Executado normalmente	Relatório aprovado
3	3	4	3	2021-07-16	2021-07-19	Funcionando normalmente	Operando normalmente	Executado normalmente	Relatório aprovado
5	9	5	5	2021-07-20	2021-07-21	Funcionando normalmente	Operando normalmente	Executado normalmente	Relatório aprovado
6	5	3	6	2021-07-21	2021-07-22	Funcionando normalmente	Operando normalmente	Executado normalmente	Relatório aprovado
7	3	9	7	2021-07-22	2021-07-23	Funcionando normalmente	Operando normalmente	Executado normalmente	Relatório aprovado
12	5	4	12	2021-07-29	2021-07-30	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
22	3	5	22	2021-08-12	2021-08-13	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
13	4	9	13	2021-07-30	2021-08-02	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
14	9	8	14	2021-08-02	2021-08-03	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
23	5	9	23	2021-08-13	2021-08-16	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
30	4	8	30	2021-08-24	2021-08-25	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
24	9	4	24	2021-08-16	2021-08-17	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
36	4	8	36	2021-09-01	2021-09-02	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
25	4	8	25	2021-08-17	2021-08-18	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
43	8	3	43	2021-09-10	2021-09-13	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
37	8	4	37	2021-09-02	2021-09-03	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
32	5	9	32	2021-08-26	2021-08-27	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
33	9	3	33	2021-08-27	2021-08-30	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
31	8	5	31	2021-08-25	2021-08-26	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
40	3	9	40	2021-09-07	2021-09-08	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
34	3	9	34	2021-08-30	2021-08-30	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
41	9	4	41	2021-09-08	2021-09-09	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
38	4	8	38	2021-09-03	2021-09-06	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
45	9	4	45	2021-09-14	2021-09-15	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
39	8	3	39	2021-09-06	2021-09-07	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
42	4	8	42	2021-09-09	2021-09-10	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
44	3	9	44	2021-09-13	2021-09-14	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
46	4	8	46	2021-09-15	2021-09-16	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
48	3	5	48	2021-09-17	2021-09-20	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
47	8	3	47	2021-09-16	2021-09-17	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
49	5	3	49	2021-09-20	2021-09-21	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
50	3	9	50	2021-09-21	2021-09-22	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
51	9	4	51	2021-09-22	2021-09-23	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
52	4	9	52	2021-09-23	2021-09-24	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
53	9	8	53	2021-09-24	2021-09-27	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
82	5	4	82	2021-11-04	2021-11-05	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
54	8	3	54	2021-09-27	2021-09-28	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
71	8	9	71	2021-10-20	2021-10-21	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
72	9	3	72	2021-10-21	2021-10-22	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
56	3	9	56	2021-09-29	2021-09-30	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
55	5	3	55	2021-09-28	2021-09-29	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
89	3	8	89	2021-11-15	2021-11-16	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
58	5	4	58	2021-10-01	2021-10-04	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
73	3	9	73	2021-10-22	2021-10-25	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
59	4	8	59	2021-10-04	2021-10-05	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
57	9	5	57	2021-09-30	2021-10-01	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
60	8	5	60	2021-10-05	2021-10-06	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
83	4	5	83	2021-11-05	2021-11-08	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
61	5	3	61	2021-10-06	2021-10-07	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
62	3	8	62	2021-10-07	2021-10-08	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
74	9	8	74	2021-10-25	2021-10-26	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
63	8	5	63	2021-10-08	2021-10-11	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
75	8	9	75	2021-10-26	2021-10-27	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
65	4	8	65	2021-10-12	2021-10-13	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
66	8	9	66	2021-10-13	2021-10-14	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
64	5	4	64	2021-10-11	2021-10-12	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
67	9	4	67	2021-10-14	2021-10-15	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
68	4	9	68	2021-10-15	2021-10-18	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
84	5	4	84	2021-11-08	2021-11-09	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
69	9	4	69	2021-10-18	2021-10-19	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
70	4	8	70	2021-10-19	2021-10-20	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
78	9	5	78	2021-10-29	2021-11-01	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
79	5	3	79	2021-11-01	2021-11-02	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
76	9	3	76	2021-10-27	2021-10-28	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
90	8	5	90	2021-11-16	2021-11-17	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
77	3	9	77	2021-10-28	2021-10-29	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
80	3	9	80	2021-11-02	2021-11-03	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
85	4	8	85	2021-11-09	2021-11-10	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
81	9	5	81	2021-11-03	2021-11-04	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
86	8	3	86	2021-11-10	2021-11-11	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
91	5	3	91	2021-11-17	2021-11-18	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
87	3	8	87	2021-11-11	2021-11-12	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
88	8	3	88	2021-11-12	2021-11-15	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
94	9	4	94	2021-11-22	2021-11-23	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
97	5	3	97	2021-11-25	2021-11-26	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
92	3	5	92	2021-11-18	2021-11-19	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
95	4	8	95	2021-11-23	2021-11-24	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
93	5	9	93	2021-11-19	2021-11-22	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
96	8	5	96	2021-11-24	2021-11-25	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
98	3	9	98	2021-11-26	2021-11-29	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
99	9	4	99	2021-11-29	2021-11-30	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
100	4	8	100	2021-11-30	2021-12-01	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
101	8	5	101	2021-12-01	2021-12-02	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
102	5	3	102	2021-12-02	2021-12-03	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
103	3	9	103	2021-12-03	2021-12-06	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
104	9	4	104	2021-12-06	2021-12-07	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
105	4	3	105	2021-12-07	2021-12-08	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
107	5	4	107	2021-12-09	2021-12-10	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
108	4	3	108	2021-12-10	2021-12-13	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
124	5	3	124	2022-01-11	2022-01-12	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
109	3	9	109	2021-12-13	2021-12-14	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
106	3	5	106	2021-12-08	2021-12-09	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
110	9	4	110	2021-12-14	2021-12-15	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
122	9	8	122	2022-01-07	2022-01-10	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
125	3	5	125	2022-01-12	2022-01-13	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
111	4	3	111	2021-12-15	2021-12-16	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
146	8	5	145	2022-02-09	2022-02-10	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
112	3	5	112	2021-12-16	2021-12-17	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
113	4	5	113	2021-12-20	2021-12-23	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
126	5	3	126	2022-01-13	2022-01-14	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
114	5	9	114	2021-12-23	2021-12-26	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
135	8	4	135	2022-01-26	2022-01-27	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
115	9	3	115	2021-12-26	2021-12-28	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
127	3	5	127	2022-01-14	2022-01-17	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
116	3	8	116	2021-12-28	2021-12-31	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
117	8	5	117	2021-12-31	2022-01-03	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
118	5	8	118	2022-01-03	2022-01-04	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
128	5	3	128	2022-01-17	2022-01-18	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
119	8	5	119	2022-01-04	2022-01-05	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
120	5	3	120	2022-01-05	2022-01-06	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
121	3	9	121	2022-01-06	2022-01-07	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
136	4	8	136	2022-01-27	2022-01-28	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
129	3	5	129	2022-01-18	2022-01-19	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
123	8	5	123	2022-01-10	2022-01-11	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
130	5	3	130	2022-01-19	2022-01-20	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
131	3	4	131	2022-01-20	2022-01-21	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
137	8	4	137	2022-01-28	2022-01-31	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
132	4	9	132	2022-01-21	2022-01-24	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
133	9	4	133	2022-01-24	2022-01-25	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
142	5	9	142	2022-02-04	2022-02-07	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
134	4	8	134	2022-01-25	2022-01-26	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
138	4	8	138	2022-01-31	2022-02-01	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
139	8	4	139	2022-02-01	2022-02-02	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
150	5	3	149	2022-02-15	2022-02-16	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
140	4	8	140	2022-02-02	2022-02-03	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
141	8	5	141	2022-02-03	2022-02-04	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
144	9	4	144	2022-02-07	2022-02-08	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
143	4	8	143	2022-02-08	2022-02-09	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
147	5	9	146	2022-02-10	2022-02-11	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
149	4	5	148	2022-02-14	2022-02-15	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
148	9	4	147	2022-02-11	2022-02-14	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
151	3	6	150	2022-02-16	2022-02-17	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
152	6	3	151	2022-02-17	2022-02-18	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
159	14	9	158	2022-02-28	2022-03-01	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
154	9	4	153	2022-02-21	2022-02-22	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
153	3	9	152	2022-02-18	2022-02-21	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
155	4	3	154	2022-02-22	2022-02-23	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
156	3	6	155	2022-02-23	2022-02-24	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
158	3	14	157	2022-02-25	2022-02-28	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
157	6	3	156	2022-02-24	2022-02-25	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
199	9	4	198	2022-04-27	2022-04-28	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
160	9	3	159	2022-03-01	2022-03-02	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
189	3	6	188	2022-04-11	2022-04-12	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
196	4	9	195	2022-04-21	2022-04-22	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
190	6	14	189	2022-04-12	2022-04-13	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
161	3	14	160	2022-03-02	2022-03-03	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
182	4	3	181	2022-03-31	2022-04-01	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
162	14	6	161	2022-03-03	2022-03-04	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
163	6	9	162	2022-03-04	2022-03-07	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
183	3	6	182	2022-04-01	2022-04-04	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
164	9	3	163	2022-03-07	2022-03-08	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
165	3	6	164	2022-03-08	2022-03-09	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
166	6	14	165	2022-03-09	2022-03-10	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
167	14	9	166	2022-03-10	2022-03-11	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
184	6	14	183	2022-04-04	2022-04-05	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
172	3	14	171	2022-03-17	2022-03-18	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
174	6	14	173	2022-03-21	2022-03-22	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
173	14	6	172	2022-03-18	2022-03-21	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
175	14	9	174	2022-03-22	2022-03-23	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
168	9	3	167	2022-03-11	2022-03-14	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
169	3	6	168	2022-03-14	2022-03-15	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
170	6	9	169	2022-03-15	2022-03-16	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
180	14	9	179	2022-03-29	2022-03-30	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
171	9	3	170	2022-03-16	2022-03-17	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
185	14	9	184	2022-04-05	2022-04-06	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
192	6	4	191	2022-04-15	2022-04-18	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
176	9	3	175	2022-03-23	2022-03-24	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
177	3	4	176	2022-03-24	2022-03-25	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
181	9	4	180	2022-03-30	2022-03-31	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
178	4	6	177	2022-03-25	2022-03-28	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
186	9	4	185	2022-04-06	2022-04-07	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
179	6	14	178	2022-03-28	2022-03-29	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
187	4	14	186	2022-04-07	2022-04-08	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
197	9	3	196	2022-04-25	2022-04-26	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
188	14	3	187	2022-04-08	2022-04-11	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
191	14	9	190	2022-04-13	2022-04-14	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
193	4	9	192	2022-04-18	2022-04-19	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
200	3	4	199	2022-04-28	2022-04-29	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
194	3	14	193	2022-04-19	2022-04-20	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
195	14	4	194	2022-04-20	2022-04-21	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
198	14	9	197	2022-04-26	2022-04-27	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
202	6	14	201	2022-05-02	2022-05-03	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
204	9	4	203	2022-05-04	2022-05-05	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
201	4	14	200	2022-04-29	2022-05-02	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
203	14	9	202	2022-05-03	2022-05-04	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
205	4	3	204	2022-05-05	2022-05-06	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
206	3	14	205	2022-05-06	2022-05-09	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
207	14	6	206	2022-05-09	2022-05-10	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
208	6	9	207	2022-05-10	2022-05-11	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
209	9	4	208	2022-05-11	2022-05-12	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
211	6	3	210	2022-05-13	2022-05-16	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
210	4	6	209	2022-05-12	2022-05-13	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
212	3	6	211	2022-05-16	2022-05-17	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
215	6	14	214	2022-05-17	2022-05-18	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
214	6	14	213	2022-05-17	2022-05-18	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
213	9	14	212	2022-05-17	2022-05-18	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
218	14	4	217	2022-05-20	2022-05-23	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
217	9	14	216	2022-05-19	2022-05-20	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
219	4	3	218	2022-05-23	2022-05-24	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
216	14	9	215	2022-05-18	2022-05-19	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
221	6	14	220	2022-05-25	2022-05-26	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
220	3	6	219	2022-05-24	2022-05-25	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
222	14	9	221	2022-05-26	2022-05-27	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
249	4	3	248	2022-07-04	2022-07-05	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
223	9	4	222	2022-05-27	2022-05-30	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
239	3	12	238	2022-06-20	2022-06-21	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
224	4	3	223	2022-05-30	2022-05-31	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
225	3	6	224	2022-05-31	2022-06-01	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
256	3	6	255	2022-07-13	2022-07-14	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
227	14	3	226	2022-06-02	2022-06-03	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
226	6	14	225	2022-06-01	2022-06-02	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
228	3	12	227	2022-06-03	2022-06-06	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
229	12	6	228	2022-06-06	2022-06-07	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
230	6	14	229	2022-06-07	2022-06-08	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
242	12	3	241	2022-06-23	2022-06-24	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
231	14	3	230	2022-06-08	2022-06-09	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
232	3	12	231	2022-06-09	2022-06-10	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
250	3	6	249	2022-07-05	2022-07-06	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
233	12	6	232	2022-06-10	2022-06-13	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
234	6	14	233	2022-06-13	2022-06-14	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
248	9	14	247	2022-07-01	2022-07-04	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
235	14	3	234	2022-06-14	2022-06-15	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
240	12	14	239	2022-06-21	2022-06-22	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
236	3	12	235	2022-06-15	2022-06-16	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
243	3	14	242	2022-06-24	2022-06-27	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
237	12	14	236	2022-06-16	2022-06-17	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
238	14	3	237	2022-06-17	2022-06-20	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
244	14	9	243	2022-06-27	2022-06-28	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
245	9	4	244	2022-06-28	2022-06-29	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
246	4	3	245	2022-06-29	2022-06-30	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
241	14	12	240	2022-06-22	2022-06-23	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
255	4	3	254	2022-07-12	2022-07-13	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
257	6	3	256	2022-07-14	2022-07-15	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
251	6	14	250	2022-07-06	2022-07-07	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
252	14	4	251	2022-07-07	2022-07-08	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
254	9	4	253	2022-07-11	2022-07-12	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
247	3	9	246	2022-06-30	2022-07-01	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
253	4	9	252	2022-07-08	2022-07-11	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
261	4	3	260	2022-07-20	2022-07-21	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
259	14	9	258	2022-07-18	2022-07-19	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
260	9	4	259	2022-07-19	2022-07-20	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
258	3	14	257	2022-07-15	2022-07-18	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
262	3	14	261	2022-07-21	2022-07-22	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
263	14	17	262	2022-07-22	2022-07-25	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
265	4	9	264	2022-07-26	2022-07-27	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
264	17	4	263	2022-07-25	2022-07-26	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
266	9	3	265	2022-07-27	2022-07-28	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
268	17	14	267	2022-07-29	2022-08-01	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
274	17	9	273	2022-08-08	2022-08-09	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
270	17	9	269	2022-08-02	2022-08-03	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
271	9	3	270	2022-08-03	2022-08-04	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
272	3	9	271	2022-08-04	2022-08-05	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
267	3	17	266	2022-07-28	2022-07-29	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
273	9	17	272	2022-08-05	2022-08-08	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
269	14	17	268	2022-08-01	2022-08-02	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
275	9	3	274	2022-08-09	2022-08-10	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
287	17	14	286	2022-08-25	2022-08-26	Funcionando normalmente	Operando normalmente	Executado normalmente	Encerrado
276	3	17	275	2022-08-10	2022-08-11	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
289	9	12	288	2022-08-29	2022-08-30	Funcionando normalmente	Operando normalmente	Executado normalmente	Em andamento
277	17	3	276	2022-08-11	2022-08-12	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
288	14	9	287	2022-08-26	2022-08-29	Funcionando normalmente	Operando normalmente	Executado normalmente	Encerrado
290	12	3	289	2022-08-30	2022-08-31	Funcionando normalmente	Operando normalmente	Executado normalmente	Em andamento
278	3	12	277	2022-08-12	2022-08-15	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
279	9	3	278	2022-08-15	2022-08-16	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
280	3	17	279	2022-08-16	2022-08-17	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
281	17	3	280	2022-08-17	2022-08-18	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
282	3	12	281	2022-08-18	2022-08-19	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
283	12	17	282	2022-08-19	2022-08-22	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
284	17	12	283	2022-08-22	2022-08-23	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
285	12	17	284	2022-08-23	2022-08-24	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
286	17	3	285	2022-08-24	2022-08-25	Funcionando normalmente	Operando normalmente	Executado normalmente	Sup. que entra ciente
\.


--
-- TOC entry 3871 (class 0 OID 0)
-- Dependencies: 251
-- Name: tb_rel_servico_idtb_rel_servico_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_rel_servico_idtb_rel_servico_seq', 290, true);


--
-- TOC entry 3638 (class 0 OID 18482)
-- Dependencies: 252
-- Data for Name: tb_rel_servico_log; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_rel_servico_log (idtb_rel_servico_log, idtb_lotacao_clti, num_rel, cod_aut, data_hora) FROM stdin;
1	2	2	1de5f0702b51bf1b64b4a1bc2c7b8208	2021-07-21 09:56:35
2	2	4	12aa688a0598057449d328cc4debe87c	2021-07-21 15:22:07
3	2	1	999568cbfa22894cf8d5bcad1e563f7d	2021-07-29 09:14:19
4	2	3	98e60a80a707670dd25166127a4ba560	2021-07-29 09:14:26
5	2	5	55c6b4c09c1d84b67253de61129b0337	2021-07-29 09:14:33
6	2	6	fa8e6b0c6980a6e88e9e6c6967d732e2	2021-07-29 09:14:40
7	2	7	2bd8e23014df8cfd417ac81611375012	2021-07-29 09:14:48
\.


--
-- TOC entry 3872 (class 0 OID 0)
-- Dependencies: 253
-- Name: tb_rel_servico_log_idtb_rel_servico_log_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_rel_servico_log_idtb_rel_servico_log_seq', 7, true);


--
-- TOC entry 3640 (class 0 OID 18487)
-- Dependencies: 254
-- Data for Name: tb_rel_servico_ocorrencias; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_rel_servico_ocorrencias (idtb_rel_servico_ocorrencias, num_rel, ocorrencia, status) FROM stdin;
1	8	Houve queda de energia na BNNa as 09:13 da manha do dia 23/07/2021, voltando após 15min.\r\nApós o retorno, todos os equipamentos funcionando normalmente.	Sup. que entra ciente
2	8	Manutenção da rede elétrica da BNNa, de 08:00 as 15:00hs no dia 24/07/20201.\r\nA princípio nesse período, apenas as rede do Cais da BNNa ficou fora. Voltando normalmente, após os reestabelecimento.\r\n\r\nO Ar condicionado do Paiol de Fibra, desligou com a ausência de energia, e foi religado logo após.\r\n\r\n	Sup. que entra ciente
3	11	Servidor SiGDEM clti-com3dn1, que atende às OM da área de Natal exceto o Com3ºDN, ficou indisponível durante a manhã, sendo reportado pelo Admin da ERMN em 29/JUL às 07:20h, estando em manutenção até o momento.	Em andamento
4	12	Indisponibilidade do servidor SiGDEM clti-com3dn1 sanada às 11h38 de 29/07/2021.	Sup. que entra ciente
5	16	Por volta das 11h de 04/08/2021, ocorreu uma queda de energia no CTIM o que acarretou em uma indisponibilidade inicial e posterior intermitência dos serviços oferecidos por aquele Centro. Contudo, no fim do 2ºT a situação estabilizou-se.	Sup. que entra ciente
11	30	ROD operando normalmente, o Protocolo: 2021.0461, foi encerrado.	Sup. que entra ciente
6	17	O backup para fita LTO não foi executado corretamente. O drive ejetou a fita antes de o backup ser finalizado.	Sup. que entra ciente
7	18	PTC, informo que no dia 06/08/21, a OM ERMN esteve com instabilidade de sinal, durante o dia, devido a varias quedas de energia, o sistema foi restabelecido no final da tarde.	Sup. que entra ciente
8	22	Foram concluídas corretamente as atualizações do SiGDEM do Com3ºDN, BNN e EAMCE. Os respectivos Admin reportaram que os sistemas operam adequadamente após as atualizações.	Sup. que entra ciente
12	32	Foi solicitado apoio pelo NPaGoiana a fim de restabelecer a conexão com a RECIM após atracar no Cais BNN. Os militares 3ªSG-DT Inácio, 3ªSG-PD Irrayras e CB-RM2-TC Ubirajara executaram os procedimentos de configuração de rede no período de 15h30 até 17h00 de 26/08/2021, com apoio no monitoramento de conectividade do CB-PD Valdinei. \r\nDe modo a restabelecer a rede do navio com sucesso.	Sup. que entra ciente
10	29	- Inatividade da Rede Operacional de Desefa (ROD), as 14:00hs. Foi aberto chamado na pagina de suporte do sistema.\r\nhttp://172.21.81.96\r\n        -> Solicitação de Serviços - Protocolo: 2021.0461\r\n           (61) 3321-4000 - SG Aguiar\r\n- Ativado o LINK RNP, para uso no GLO do GptFNNa, período de uso 23 a 27/08.	Sup. que entra ciente
9	23	1 - Em 13/08/2021 atualização do SIGDEM do NPaMacau, RBAmTriunfo, EAMPE e HNNa;\r\n\r\n2 - Durante o dia 14/08/2021 houve intermitência nos serviços do CTIM devido à manutenção dos sistemas elétricos daquele Centro; e\r\n\r\n3 - Fechadura da Rack 01 da Sala dos Servidores quebrou em 14/08/2021.	Sup. que entra ciente
20	37	RNP, inoperante durante 20 minutos, durante o horário das 12:10 ate 12:30 foi constatado sua queda.	Sup. que entra ciente
18	37	Registro de Queda do sinal da ROD às 08:43. Foi aberto o chamado no site da Rede Operacional de Defesa às 08:51:43 pelo 3ºSG-DT INÁCIO 	Sup. que entra ciente
15	36	Sala dos servidores apresentando umidade acima de 70%. Cabe ressaltar que ao ultrapassar 70% , o processo de ferrugem é acelerado, causando a deterioração de materiais de metal. Os aparelhos eletrônicos também podem ter seu funcionamento comprometido, ao passarem longos períodos expostos ao vapor de água em excesso, presente no ar.	Sup. que entra ciente
14	34	Foi detectado incremento de CRC na Porta 20 do Switch Cisco 3750 (CPRN), sendo necessário verificar a situação do equipamentos do Rádio Enlace.	Sup. que entra ciente
13	34	Foi detectado incremento de CRC na porta 22 do Switch Cisco 3750 (SSN-3). Em contato com a OM verificou-se que o Admin encontra-se em comissão.	Sup. que entra ciente
16	36	Às 0945P o backbone principal e switch dos servidores pararam de responder. Foi necessário reiniciar os mesmos.	Sup. que entra ciente
17	36	Registro de Queda do sinal da ROD às 12:36. Foi aberto o chamado no site da Rede Operacional de Defesa às 13:15:28 pelo 3ºSG-DT INÁCIO 	Sup. que entra ciente
19	37	Foi feito a desativação do link RNP, solicitado pelo GPTFNNa.	Sup. que entra ciente
21	40	O sistema de monitoramento detectou alto tráfego de Internet no período compreendido entre as 18:30h do dia 07/SET até as 03:50h do dia 08/SET. O referido incidente foi relatado ao Admin3DN pela CI Nº 016-10/2021.	Em andamento
23	41	Durante inspeção rotineira na sala dos servidores constatou-se que o ar-condicionado de meia parede, ELGIN, apresenta sinais de congelamento, no duto de saída de ar e na serpentina, estando totalmente coberto com gelo. \r\nO Ar-Condicionado foi desligado e está aguardando manutenção. \r\nFoi aberto o Chamado solicitando o serviço junto a divisão de refrigeração do COM3DN.	Sup. que entra ciente
24	41	Durante inspeção rotineira na sala dos servidores, foi observado que umidade nas paredes da anti-sala continuam, e estão maiores. A mesma já foi verificada pela PRENAN, e hoje nos foi informado que está no aguardo de material para reparar a parede, dando uma previsão para o pronto do serviço de duas semanas.	Sup. que entra ciente
25	41	Apareceu, um foco de umidade, na parede embaixo do ar-condicionado piso-teto ELGIN, dentro da sala dos servidores.\r\nA parede encontra-se descascando e molhada, próximo ao canal de passagem dos dutos do Ar-Condicionado.	Sup. que entra ciente
22	41	Foi verificado nessa tarde as 13:36, um ganho elevado na taxa de umidade da sala dos servidores.\r\nMIN: 19,6 Cº\r\nMAX: 23,4 Cº\r\nUmidade: 73%\r\n	Sup. que entra ciente
26	41	O buraco que foi aberto no teto para verificação de possíveis vazamentos, pela PRENAN, será fechedo amanhã dia 09/09/2021.\r\nA prefeitura irá mandar um militar reparar.	Sup. que entra ciente
27	42	Mesmo após a visita do grupo de refrigeração o Ar condicionado ELGIN continuar congelando. \r\nNeste momento utilizando apenas o Ar Condicionado inferior.	Sup. que entra ciente
40	56	1 - Às 5h17 a CPRN ficou em baixa, retornando às 7h36 devido a problemas internos.	Sup. que entra ciente
28	45	Realizado Reconfiguração e Teste, telefone VOIP que será utilizado pelo Almirante durante comissão no Navio Araguari, dos dias 15 a 27/09.\r\nNúmero de Teste:\r\n81509010 - Linha de teste dos VOIPs na CTIM.\r\n\r\n81107010 - Setor da CTIM responsável pela telefonia VOIP	Sup. que entra ciente
29	45	Realizado identificação dos compartimentos, PAIOL DE FIBRA e SALA DOS SERVIDORES.\r\nNo mesmo momento, foi realizada a troca da vedação luminosa da anti-sala dos servidores.\r\n\r\nFoi marcado com o mestre do Complexo NAS, um reparo na infiltração da parece dentro da sala dos serviços para amanhã dia 15/09.	Sup. que entra ciente
53	70	Das 14:28 às 14:34 ocorreu uma indisponibilidade no roteador de borda do Com3ºDN. Foi realizado pesquisa na infraestrutura do CLTI e não foram encontrados erros.	Sup. que entra ciente
34	53	Realizado teste nas portas 3 e 4 da IDU do Rádio Enlace, em prol de uma futura ligação da ROD para um futuro monitoramento deste sinal, segundo ordens do comande Eduardo.\r\nApós realização do teste, foi constado que ambas as portas estão em pleno funcionamento.	Sup. que entra ciente
35	53	Durante a Faina de teste da ROD, houve um remanejamento de material e isso levou a inoperância do sinal da ROD. Foi realizado chamado de suporte para assistência ao mesmo as 11:07hs.\r\nTendo a chegada do técnico as 12:50, realizado reparo e prontificado o sistema funcionando as 13:15.\r\nSuporte realizado pelo servidor Sr. Jefferson da empresa TERA TELECOM	Sup. que entra ciente
36	53	EAMCE prontificou via telefone, reestabelecimento com a RECIM.	Sup. que entra ciente
30	46	Às 151204P o PRTG registrou falha nas ventoinhas do Switch 172.23.116.1 (Backbone), posteriormente foi registrado também falha na CPU. 	Sup. que entra ciente
31	46	Realizada a troca do Ar condicionado para o n° 2, no intuito de reduzir a umidade.	Sup. que entra ciente
32	47	Foi identificado e detectado a queda de energia na sala dos equipamentos na Radio Marinha, no ocorrido ouve a falha na alimentação de energia, do no-break havendo a queda das transmissões de 3(três) OMs, no horário 14:25 ate 15:10, com isso o sistema foi restabelecido com a troca e correção da tomada. 	Sup. que entra ciente
37	53	Segunda-feira dia 27 de setembro, às 07:00, ao abrir o CLTI foi constatado, inoperância da rede interna. \r\nApós pesquisa de avaria, foi observado travamento do Switch de distribuição do sinal dentro do nosso rack.\r\nMediante isso, reiniciamos o equipamento e o mesmo voltou a funcionar.	Sup. que entra ciente
33	52	EAMCE informou a inoperância do circuito 102 da Recim conforme mensagem R232006Z/SET/2021 devido problemas com o MPLS. A empresa embratel já foi contactada.	Sup. que entra ciente
42	60	No dia 05/10/21, foi feito o acompanhamento na sala do servidor a manutenção do Ar-condicionado 01, a manutenção foi constituída da troca do gás, apos a troca foi constatado um ERRO no equipamento acarretando uma mensagem "E8", o 2ºSGT-EL PITASSI responsável pelo serviço informou que vai avaliar o devido ERRO, e depois informará qual será a solução para tal mensagem.\r\nNo demais os equipamentos de Ar-condicionado ficaram ligados, Ar 2, ficou na temperatura de 18°C e o Ar 1 ficou na temperatura 22°C, ambos funcionando.\r\nFoi feito a verificação da temperatura as 17:26hs, mínima 20.8°C, máxima 25.7°C, umidade 54%.\r\nVerificação de temperatura dia 06/10/21, as 07:47hs, mínima 18.4°C, máxima 22.8°C, umidade 36%.\r\n   	Sup. que entra ciente
41	58	1 - Das 8h30 até as 16h de 01/10/2021 ocorreu o desligamento programado do CNBNN, fim içamento de gerador da subestação nº 3. \r\n\r\n2 - Foi observado que durante 03/10/2021 que o ar-condicionado 01 da Sala dos Servidores não estava gelando corretamente. Assim, ele foi desligado e ligou-se o ar-condicionado 02 e a temperatura normalizou-se.\r\n\r\n3 - Observou-se também que o Nobreak 02 está apresentando sobretensão.	Sup. que entra ciente
38	54	Segunda-feira dia 27 de setembro, às 10:14 ate 10:22  neste período ouve uma queda de energia paralisando as informações do gráficos do switch 3750. apos o restabelecimento da energia o sistema normalizou. 	Sup. que entra ciente
39	54	PTC, que no dia 27/09/2021 AgAracati veio cair a comunicação no Horário 16:44 ate as 18:01, foi feito o contato com a Agencia, o SGT Mateus informou que devido a queda de energia ouve a perca do sinal, energia restabelecida AgAracati normalizados.	Sup. que entra ciente
44	62	A temperatura da sala dos servidores voltou a subir, apresentando 29ºC às 13:45h, mesmo após revezamento entre os aparelhos de ar condicionado.	Sup. que entra ciente
45	62	Às 17:30h verificou-se que o aparelho de ar condicionado Nº 01 desligou novamente, no entanto a temperatura manteve-se estável tendo em vista a temperatura exterior mais amena do horário.	Sup. que entra ciente
43	62	Verificada temperatura em 31ºC às 10:50h, tendo em vista que o aparelho de ar condicionado Nº 02 congelou, estando o referido aparelho desligado a partir de então.	Sup. que entra ciente
46	63	No dia 08/10 as 09:32hs, verificou-se que a temperatura da sala do servidor encontrava-se na media de 25.3°C a mínima, 27.0°C a máxima e umidade 36%.	Sup. que entra ciente
47	63	No dia 08/10 as 13:54hs, verificou-se que a temperatura da sala do servidor encontrava-se muito alta  na media de 31.3°C a mínima, 34.4°C a máxima e umidade 27%.\r\nFoi feito a manutenção no dois ar condicionados, no período da tarde ate as 17:48, no qual foi colocado o gás e corrigido o erro do ar 01 que vinha apresentando, feito isso a temperatura estabilizou criando assim uma rotina de medição.\r\nApos o termino foi aferido a temperatura novamente, 19.6ºC a mínima, 20.3ºC a máxima umidade 38%.	Sup. que entra ciente
48	63	PTC, que no dia 09/10 as 09:00 foi pedida a comunicação dos navios que estão ligados a mureta de comunicação devido a manutenção elétricas na BNN, também foi aferido a temperatura na sala do servidor as 09:45 constando Mínima 20.3°C , Maxima 20.7°C , Umidade 76%.	Sup. que entra ciente
56	76	Atenção!! Seu sistema está vulnerável a ataque de SQL INJECTION no formulário de LOGIN.	Sup. que entra ciente
49	67	Ligação realizada pelo celular do serviço. Nº (21) 97583-6466, fim realizar contado com ADMIN da Agência da Capitania dos Portos em Areia Branca, em prol da VAT VIRTUAL.	Sup. que entra ciente
50	67	Foi realizado reparo parcial na parede da anti sala, na sala dos servidores, onde o Conceito 5 (COM3DN) junto com a PRENAN (BNN), fizeram a raspagem e passaram massa, em toda a parede a qual apresentava focos de infiltração e umidade.\r\nAmanhã a parede será lixada e pintada.	Sup. que entra ciente
60	91	1 - Entre 7h23min e 7h31min de 17NOV2021 ocorreu uma queda de energia da COSERN que afetou o monitoramento ZABBIX e o Roteador EMBRATEL (Cisco 4321), de modo que estes desligaram durante o ocorrido. Após análise na Sala dos Servidores, verificou-se que o referido roteador está conectado no Nobreak-02, o  qual apresenta bateria com necessidade de ser substituída.	Sup. que entra ciente
51	69	Chamado aberto por GptFNNa, em SOL de liberação do acesso a segregada, para apresentação do COC ao Comandante de Operações Navais (CON), em simulação de GLO.\r\nLink ficará ativo de 18 a 20/OUT.	Sup. que entra ciente
52	69	No dia 15/OUT foi instalado duas folhas de telha de amianto, em reparo do telhado do paiol de fibras.\r\nAs telhas foram cedidas pela BNN - PRENAN, bem como também os insumos para instalação da mesma.\r\n	Sup. que entra ciente
57	82	1 - Ocorreu em 03NOV2021 por volta das 14h30 uma falha no monitoramento ZABBIX dos ativos de rede. O que implicou em uma aparente queda de quase todos os ativos (exceto o servidor de hora). Contudo, após análise na Sala de Transmissão, verificou-se que o servidor que hospeda o ZABBIX estava apresentando problemas. Após modificação na porta de comunicação do servidor, o serviço foi reestabelecido.	Sup. que entra ciente
64	103	Houve interrupção no fornecimento de energia elétrica da concessionária por volta das 11:10h do dia 05/DEZ, ocasionando queda nos ativos do MPLS e interrupção do acesso à RECIM por cerca de dez minutos. Constata-se que o equipamento de proteção (Nobreak) está com defeito tendo em vista que não foi capaz de manter os ativos de conectividade em operação neste intervalo de falta de energia.	Sup. que entra ciente
54	74	Termômetro da Sala dos servidores apresentou falha.\r\nRealizado pesquisa de avaria, observou-se que o mesmo desligou devido descarregamento da pilha. A mesma foi trocada e o mesmo voltou a funcionar.\r\nAproveitamos para realocar o termômetro e câmera, para que tivesse uma visão melhor, e também para que o termômetro não sofresse nenhum interferência de temperatura de nenhum equipamento.\r\nCom isso, agora é possível para o monitoramento e controle da temperatura dentro da sala, bem como, dos ares-condicionados e quadro elétrico de alimentação da sala.	Sup. que entra ciente
55	74	Foi instalado novo servidor para monitoramento do tráfego com a RECIM.\r\nDELL R710\r\nUBUNTU SERVER\r\nSNORT	Sup. que entra ciente
61	97	1 - Roteador da CPRN apresentou instabilidades durante à noite de 25NOV e a manhã de 26NOV. 	Sup. que entra ciente
58	85	Realizada a troca da fibra do Rádio do Comº3DN. Utilizado o par 17/18	Sup. que entra ciente
66	104	Aberto Chamado para Embratel\r\nProtocolo: 2021759530746\r\nAtendente: Franciele\r\nHorário: 09:40hs\r\n\r\nTicket de Acompanhamento:\r\nCircuito 05301 -> 3279950\r\nCircuito 05300 -> 3279951\r\n	Sup. que entra ciente
59	90	PTC, que no dia 16/11, devido a uma oscilação na energia o switch localizado na sala da radio marinha perdeu a comunicação temporária, deixando o sistema de monitoramento de MPLS fora por 9 min no horário de 13:17 ate 13:26hs, feito a verificação nos níveis de sinais não houve nenhuma alteração. 	Sup. que entra ciente
62	98	Após atracação no dia 26/NO por volta das 17:40h, o roteador do NBHAES não apresentou conectividade, sendo necessária a substituição do mesmo pelo roteador reserva.	Sup. que entra ciente
63	98	Às 17:45h do dia 26/NOV foi verificado tráfego anormal a partir de várias ET do complexo para o IP 10.9.16.2, via porta 80. Não sendo identificado o referido IP foi aberto chamado no SisCSRECIM nº 2021073781, ainda sem resposta.	Sup. que entra ciente
105	181	\r\n	Em andamento
109	198	Serviço Domino do SIGDEM travou as 17:45. O Sistema foi reiniciado e o mesmo voltou a funcionar.	Sup. que entra ciente
65	104	Desde 07:30h as OM Apoiadas fora da Área de Natal tem reportado lentidão para acesso aos serviços mantidos por este CLTI. Em testes efetuados a partir deste horário observou-se que a infraestrutura interna está operando com desempenho satisfatório, no entanto o acesso aos serviços fora da área de Natal via MPLS tem apresentado lentidão acentuada.\r\n\r\n\r\nServiços como acesso ao Zimbra, por exemplo, tem apresentado grande lentidão para acesso a partir da infraestrutura do CLTI e das OM sediadas em Natal, já as OM fora de Natal, que possuem acesso independente para RECIM via MPLS próprios reportaram acesso normal ao Zimbra. Reitero que o mesmo ocorre com o acesso a demais serviços da área Rio, bem como outros DN.\r\n\r\n\r\nOs ativos de rede principais foram verificados, Roteador da Claro (172.23.104.2) e Switch do "Backbone" CNBNN Sw3750G (172.23.116.1), e aparentemente não apresentam problemas. Também estamos acompanhando o tráfego total que encontra-se em limites bastante baixos, o que não ocasionaria lentidão.\r\n	Sup. que entra ciente
67	104	- Realizado Visita Técnica da Embratel -\r\nTécnico: Alan\r\nHorário: 12:05 às 14:45hs\r\nManifesto: 0006202\r\n\r\nRelatório da Pesquisa de Avaria: Serviço MPLS taxando erros após queda de energia na sala dos servidores.\r\nApós tentativa de acesso ao roteador, foi constatado que o mesmo estava travado. Houve a necessidade de reset no roteador e no DATACOM DM16E1, após reset, foi realizado teste com o Douglas no GRC, erro eliminados, sistema normalizado.\r\n\r\nFoi observado pelo técnico que futuras quedas de energia, podem acarretar em dados maiores para o equipamento, que dependendo da intensidade pode ocorrer erros irreparáveis.	Sup. que entra ciente
70	106	HNRe ficou inoperante entre as 07:00h e 09:45h devido a rompimento de fibra óptica da operadora.	Sup. que entra ciente
71	106	A AgPenedo apresentou oscilações na conectividade no período das 09:00h às 14:30h devido a oscilações na rede elétrica da OM.	Sup. que entra ciente
80	125	AgCamocim permaneceu inoperante durante todo o expediente por problemas no MPLS. A conectividade foi restabelecida às 18:15h.	Sup. que entra ciente
68	105	Às 14:50 do dia 07/12, ocorreu interrupção no fornecimento de energia elétrica por parte da Cosern, ocasionando a interrupção de todos os serviços oferecidos por este CLTI. \r\nÀs 15:40, foi acionado o gerador da BNN, restabelecendo parcialmente os serviços, a única exceção, foram os rádios enlace, que continuaram desalimentados.\r\nÀs 15:55, foi restabelecido o fornecimento de energia elétrica por parte da Cosern, restabelecendo todos os serviços hospedados pelo CLTI e alimentado os rádios enlace.	Sup. que entra ciente
69	105	Às 07:30 do dia 07/12 ocorreu interrupção no fornecimento de energia elétrica no HNNa, retornando as 18:30	Sup. que entra ciente
110	206	PTC indisponibilidade de AGNEDO 09h05m por perda de link do MPLS. Chamado aberto com a Claro protocolo 2002 763 228 363. \r\nRetornou ao normal as 09h45m.	Sup. que entra ciente
72	111	No período das 1404P às 1500P foi realizada manutenção na rede elétrica da Sala dos Servidores. O MPLS e a Internet Distrital ficaram indisponíveis nesse período.	Sup. que entra ciente
73	113	CLTI-com3dn2 apresentou falha e precisou ser reiniciado. O serviço ficou inoperante de 201420P a 201440P	Sup. que entra ciente
74	115	Por volta das 02h da madrugada do dia 26 para 27/12 houve interrupção no fornecimento de energia elétrica, o que causou interrupção de todos os serviços do CLTI, bem como do acesso à RECIM e desligamento dos Rádio Enlaces. Todos os serviços foram restabelecidos a partir das 06:30h do dia 27/12.	Sup. que entra ciente
78	123	PTC, que a OM Estação Radio de Natal, no período da manha durante os horários 07:20 ate 10hs, devido a queda de energia no local, havendo oscilação no sinal. 	Sup. que entra ciente
75	118		Sup. que entra ciente
76	118	Sem Ocorrência	Sup. que entra ciente
79	123	PTC, que Capitania dos portos de fortaleza encontra-se fora sem transmissão, foi feito o contato com ADMIN, o mesmo informou que estava chegando a bordo para fazer a verificação do problema.	Sup. que entra ciente
106	182	Após as fortes chuvas, verificou-se  infiltrações e gotejamentos na Sala de Servidores do 3ºDN (próximo aos servidores) e na Casa da Torre do 3ºDN (próximo aos equipamentos). Foi encaminhada CP para OSE e demais envolvidos.\r\n\r\nTambém verificou-se entrada de água pela porta da Sala de Servidores do CLTI, alcançando apenas a área adjacente à porta.\r\n\r\nTambém verificou-se aumento das infiltrações na Antessala da Sala de Servidores do CLTI.	Sup. que entra ciente
111	207	PTC indisponibilidade da CPRN das 07:25h as 08:30h do dia 10/05, por motivos elétricos.	Sup. que entra ciente
77	122	Foi observado pela divisão de Sistemas, uma anormalidade no acesso fora do expediente. Sendo reportado por e-mail conforme abaixo exposto:\r\n============================================================\r\nDe: "Alexandre" <lucio.alexandre@marinha.mil.br>\r\nPara: "alex caetano" <alex.caetano@marinha.mil.br>, "karen souza" <karen.souza@marinha.mil.br>, "diego vitor" <diego.vitor@marinha.mil.br>\r\nCc: "c dias" <c.dias@marinha.mil.br>, "frankelene" <frankelene@marinha.mil.br>, "francinaldo lacerda" <francinaldo.lacerda@marinha.mil.br>, "leonardo eduardo" <leonardo.eduardo@marinha.mil.br>, "Lais Souza" <lais.souza@marinha.mil.br>, "irrayras" <irrayras@marinha.mil.br>, "Da Silva" <matheus.pinto@marinha.mil.br>, "rufino mendes" <rufino.mendes@marinha.mil.br>, "carlos.nogueira" <carlos.nogueira@marinha.mil.br>\r\nEnviadas: Sexta-feira, 7 de janeiro de 2022 14:37:47\r\nAssunto: CLTI-3DN - DIVISÃO DE SISTEMAS - TRÁFEGO ANÔMALO EM HORÁRIO FORA DO EXPEDIENTE\r\n\r\nCLTI-3DN - DIVISÃO DE SISTEMAS - TRÁFEGO ANÔMALO EM HORÁRIO FORA DO EXPEDIENTE\r\n\r\nEm análise rotineira do tráfego de rede, constatou-se tráfego de Internet fora do horário do expediente,\r\na partir dos endereços IP abaixo relacionados, com os respectivos volumes de dados constatados, sendo\r\nverificado grande volume de tráfego de dados após as 18:00h diariamente, no período analisado de\r\n01 a 07/JAN/2022:\r\n\r\n\r\nIP origem                      IP destino               Tráfego\r\n10.210.124.3 (Proxy)    172.23.34.123        24GB\r\n172.23.116.32 (proxy)   172.23.34.241        3,7GB\r\n\r\n\r\nParticipo, ainda, que o referido volume de dados é considerado anormal tendo em vista se tratar de\r\num serviço existente para uso exclusivo em função das necessidades de serviço da OM, conforme\r\nespecificado no Item 5.4 da DGMM-0540.\r\n\r\nAlém disso, constatou-se nas ferramentas de monitoramento a utilização do modo de navegação anônimo\r\nativado no navegador Mozilla Firefox das Estações de Trabalho em questão, cabendo ressaltar que a\r\nativação do modo anônimo por si só não impede que as ferramentas de auditoria analisem e registrem\r\ntodo o tráfego de Internet originado nas ET.\r\n\r\nFace ao exposto, consulto a possibilidade ao Sr. Admin verificar a causa do tráfego excessivo nas\r\nreferidas ET.\r\n\r\n\r\n\r\nLúcio ALEXANDRE Correia dos Santos\r\nCB-FN-ET\r\nAdminCLTI3DN/Auxiliar da Divisão de Sistemas\r\nComando do 3° Distrito Naval\r\nCentro Local de Tecnologia da Informação\r\nTel: (84) 3216-3542 / RETELMA 8311-3542	Sup. que entra ciente
89	148	Por volta das 17hrs ocorreu o travamento do serviço HTTP no servidor domino clti-com3dn2/terdis/Mar . Pelo log é possível observar erro de execução do HTTP JVM. Aberto chamado 2022014042 para o CTIM	Sup. que entra ciente
81	128	1 - Por volta das 16h40min de 17JAN2022 ocorreu uma queda de energia devido à troca de gerador da BNN. Após poucos segundos a energia foi reestabelecida, contudo as ET do CLTI ficaram sem conectividade com a RECIM.\r\n\r\n2 - Por volta das 7h10min de 18JAN2022, verificou-se que o Switch Cisco Catalyst 3750G - 24 portas não estava ligando. Por conta disso, realizou-se a troca desse equipamento pelo Switch Cisco Catalyst 3750 v2 Series de 48 portas (Fast Ethernet). Desse modo, a conectividade foi reestabelecida no setor.	Sup. que entra ciente
85	145	PTC, que devido a queda de energia no período do almoço no horário 12:20P ate 12:45P, a vendo uma avaria nos  2 nobreak do setor de sistema.	Sup. que entra ciente
82	130	1 - Dia 18JAN2022 por volta das 9h foi identificado que a Branch2 do Rádio Enlace da Rádio Marinha-COM3DN, na ponta da Rádio Marinha ficou indisponível. Provavelmente por conta das fortes chuvas que podem ter ocasionado infiltração no cabeamento.\r\n\r\n2 - Dia 19JAN2022, durante o 2º tempo, foi realizada faina de descer o cabo da Branch2 por 2ºSG-ET Rufino e CB-PD Valdinei.	Sup. que entra ciente
83	131	A conectividade do HNRe ficou indisponível das 12:25h às 17:20h por problemas com MPLS da Claro/Embratel.	Sup. que entra ciente
84	142	1 - De 16h de 05FEV2022 até às 01h de 06FEV2022 o HNRe ficou indisponível. Contudo a Claro/EMBRATEL foi acionada e resolveu a inoperância.\r\n\r\n2 - O Coletor de área apresentou travamento, sendo necessário reiniciar o serviço do domino.	Sup. que entra ciente
87	147	No dia 12 no turno da manhã, ocorreu manutenção na rede elétrica da BNN.\r\nApenas o cais e o CeIMNA e os Cais, ficou em baixa. Normalizando o Serviço de 11:30.	Sup. que entra ciente
88	147	No dia 12, foi realizado a troca dos ares-condicionados para equalizar a utilização dos meios.\r\nRessalta que essa prática vem sendo adotada em todos os serviços.	Sup. que entra ciente
90	151	Alterado ar condicionado para o 3.	Sup. que entra ciente
86	146	1 - Por volta das 18h de 10FEV2022 o Admin da CPPB entrou em contato informando indisponibilidade no serviço SiGDEM da referida OM. Após isso, Comandante (CC-T) Eduardo do CLTI também informou que a CPCE apresentava o mesmo problema e o Admin do HNRe da mesma forma. Após análises nas ferramentas de monitoramento constatou-se que o servidor clti-com3dn2.com3dn.mb não estava funcionando corretamente.\r\n2 - A fim de resolver a situação, 2ºSG-ET Rufino verificou os serviços do servidor e notou-se que o serviço HTTP apresentou travamento. Após reiniciar o referido serviço, o SiGDEM foi restabelecido às 18h44min.	Sup. que entra ciente
98	165	Apoio ao ADMIN do NPa Goiana na configuração de novo Servidor de Arquivos.\r\nFoi instalado SAMBA e realizado restore de configurações do servidor antigo.	Sup. que entra ciente
94	158	CPPE fora às 11:03, devido a falta de energia no local. Serviço reestabelecido às 13:42.	Sup. que entra ciente
92	156		Sup. que entra ciente
95	158	Manutenção da rede elétrica da BNNa, as 14:00hs. A princípio nesse período, apenas as rede do Cais da BNNa ficou fora. Voltando normalmente, após o reestabelecimento. 	Sup. que entra ciente
91	154	Devido a um problema em um switch interno do CLTI, a rede 172.23.116.0/22 foi afetada, deixando intermitente todos os serviços oferecidos. O problema foi sanado e todos os serviços voltaram ao normal.	Sup. que entra ciente
96	165	Configurado no Zimbra, envio de notificações dos monitoramentos: PRTG e Zabbix.	Sup. que entra ciente
102	172	PTC que ao tentar realizar o backup do 3°DN no sábado não foi possível devido o CB Breno ter retirado a fonte do leitor de HD. No domingo ao chegar na sala dos servidores, o CB Breno entrou na sala e conectou a fonte, e assim foi possível executar o backup. 	Encerrado
93	157	Constatado às 08:45h que o Circuito 05301 do MPLS estava indisponível. Aberto chamado junto à EMBRATEL sob o protocolo nº 2022761664909/3400077. Serviço foi restabelecido às 11h.	Sup. que entra ciente
97	165	Indisponibilidade do SiGDEM do COM3DN aproximadamente as 15:30h.\r\nApoio do CLTI ao ADMIN do COM3DN, serviço reestabelecido aproximadamente as 18:00h.	Sup. que entra ciente
99	166		Sup. que entra ciente
100	167	Indisponibilidade da AgBranca, realizando manutenção da rede local.	Sup. que entra ciente
101	167	 \tIndisponibilidade da AgPenedo, chamado CLARO/EMBRATEL Nº 2022762000683.	Sup. que entra ciente
103	175	Admin da AgABranca reportou que permanece o problema de arrefecimento na sala de servidores e equipamentos, sendo necessário manter os equipamentos desligados entre 242000P e 250700P. O problema repete-se desde o dia 22/MAR/2022.	Sup. que entra ciente
104	181	\r\n\r\n	Em andamento
107	184	Falta de conectividade registrada em CPCE, devido a falta de energia no local.	Sup. que entra ciente
108	192	Indisponibilidade da ERMN das 11:05 as 13:15 devido a um problema junto a concessionária de energia elétrica.	Sup. que entra ciente
113	210	No dia 14/05/22 - Foi configurado o Voip do Sr Almirante no NPaAraguari. Aberto chamado N° 2022040404 para o CTIM para liberar o uso do Voip na RECIM. \r\nNo dia 15/05/22 - CPRN ficou indisponível por volta das 7h as 7:40h, problemas elétricos. 	Sup. que entra ciente
112	209	11/05\r\nUNO - Tráfego alto observado no MPLS a partir das 13:30hrs. Após análise do relatório do PRTG observou-se que se tratava de downloads realizados pelas OM GPTFNNA e CPRN;\r\n\r\nDOIS -  Tráfego alto observado no MPLS a partir das 15:15hrs. Após análise do relatório do PRTG observou-se que se tratava de atualizações do WSUS que durou até as 19:30hrs;\r\n\r\n12/05\r\nTRÊS - Tráfego alto observado no MPLS a partir das 06:20hrs. Após análise do relatório do PRTG observou-se que se tratava de atualizações do UBUNTU que durou até as 08:30hrs no momento em que foi desligado o servidor repositório;\r\n\r\nQUATRO -  Tráfego alto observado no MPLS a partir das 08:30hrs. Após análise do relatório do PRTG observou-se que se tratava de atualizações do WSUS. No momento que foi desligado o servidor de repositório UBUNTU, as ET com Windows começaram a buscar atualizações. O tráfego alto permanece até o momento; \r\n\r\nCINCO – Às 10:00hrs foi determinado o desligamento do servidor WSUS do CLTI. Após essa ação, ocorreu um novo problema, pois as ET passaram a buscar atualização no WSUS do RJ e também em outras ET já atualizadas. O sistema de otimização de entrega do Windows Update utilizando a porta 7680, para buscar atualização em ET já atualizadas;\r\n\r\nSEIS – ÀS 17:30hrs foi determinado ligar o servidor do repositório Ubuntu. Após essa ação observado que algumas ET voltaram a buscar atualização no repositório;\r\n\r\n13/05\r\nSETE -  Tráfego alto observado no MPLS a partir das 06:30hrs.  Após análise do relatório do PRTG observou-se que se tratava de atualizações do UBUNTU e atualizações do Windows através do WSUS;\r\n\r\nOITO -  ÀS 7:34hrs foi determinado desligar o servidor do repositório Ubuntu. Após essa ação, observou-se o tráfego alto passou ser ocasionado apenas pelas atualizações do Windows.	Sup. que entra ciente
114	216	Realizado UPLOAD do site do COM3DN para o repositório do CLTI. Faina realizada no período de 16:00 as 17:43.\r\nRealizado troca da Fita de BACKUP, fita inserida nº30	Sup. que entra ciente
121	236	Foi trocado o ar-condicionado da sala dos servidores do CLTI. Anteriormente estava ligado o Elgin, agora, o Philco (novo).	Sup. que entra ciente
115	220	Foi observado que a ante sala da sala de servidores está apresentando infiltração. Fotos estão em PUBLICO/DETALHE DE SERVIÇO/FOTOS/25MAI2022.	Sup. que entra ciente
116	224	A rede segredada de Internet foi ativada às 20:40h para o GptFNNa.	Sup. que entra ciente
137	263	PTC que ao entrar na ante sala dos servidores, constatei que havia um vazamento na porta de entrada referente a um cano no piso superior. PTC ainda que fiz um vídeo mostrando a ocorrência e o mesmo foi enviado para o SG Inácio que se encarregou de enviar para a 1T Frankelene Encarregada da Divisão de Infraestrutura.	Sup. que entra ciente
117	228	CPPE com problema de conectividade com a Claro.\r\nAgPenedo com problema no fornecimento de energia.	Sup. que entra ciente
122	237	PTC queda de energia as 15h45m. Permanecendo energia na Sala dos Servidores, nada foi afetado. Após 10min a energia da base foi reestabelecida.	Sup. que entra ciente
118	230	PTC ida a Sala de Servidores para acompanhar uma faina no Ar condicionado 01, apos a faina realizada foi constatado um problema no Ar condicionado 02, o mesmo encontrava-se ligando e desligando sozinho. Para resolver o problema o mesmo foi desligado no quadro de energia.	Sup. que entra ciente
119	232	O CB-RM2-EO Brendo disse que está preparando um novo servidor para backup e que ainda não fez o script de backup, ainda faltam alguns testes. Esse final de semana não será realizado o backup na telemática, somente a troca dos ares condicionados.	Sup. que entra ciente
120	232	Às 15:00 de sábado o MIL de serviço regressou para VRF a indisponibilidade da mureta do Araguari. Foi solucionado às 10:00 de domingo. Após os testes realizados, foi necessário trocar dois conversores de fibra, um no paiol de fibras e outro na mureta.	Sup. que entra ciente
135	259	- Incremento dos arquivos temporários no servidor clti-com3dn2 ocasionou o travamento do referido servidor. Foi realizada a limpeza dos arquivos e reiniciado o serviço.\r\n\r\n- Problema elétrico na OM AGCATI. 	Sup. que entra ciente
132	250	- Troca do aparelho de ar condicionado às 13:00h para o aparelho nº 01 (cima).\r\n- Verificação da temperatura/umidade às 14:00h: 20,2ºC/57%.\r\n	Sup. que entra ciente
128	248	Grande infiltração na sala da Div de Sic	Sup. que entra ciente
123	239	O ar-condicionado do paiol de fibras estava desligado devido as quedas de energia da BNN. O mesmo foi ligado aproximadamente às 17:40.	Sup. que entra ciente
124	242	CPPE permaneceu inoperante no período de 06:20h às 08:35h do dia 24/06 devido a falta de energia elétrica na OM. O problema iniciou-se novamente às 14:45h, sendo restabelecido às 18:10.	Sup. que entra ciente
125	243	PTC troca de Ar Cond realizada.	Sup. que entra ciente
126	246	Verificação da temperatura/umidade às 09:00h: 22,5ºC/66%.	Sup. que entra ciente
127	246	Troca do aparelho de ar condicionado às 09:00h para o aparelho nº 01 (cima).	Sup. que entra ciente
129	249	Aparelho de ar condicionado nº 03 em operação.	Sup. que entra ciente
130	249	Umidade em 66% verificada às 10:30h.	Sup. que entra ciente
131	249	No-break nº 02 danificado. Em verificação dos led de status constata-se falha nas baterias, falhas no circuito inversor e falha na tensão de entrada.	Sup. que entra ciente
136	262	PTC que no dia 23/07 o ar cond do DN estava na Temperatura de 25°. Tinha ocorrido queda de energia e o mesmo tinha desarmado. Coloquei o ar na temperatura correta e ao voltar no domingo estava tudo funcionando tudo perfeitamente.	Sup. que entra ciente
133	255	Troca do aparelho de ar condicionado efetuada para o nº 01 (cima).	Sup. que entra ciente
134	255	Verificação de temperatura e umidade às 16h em 25,9º/40%.	Sup. que entra ciente
139	265	Realizada a troca da Fita de Backup.	Sup. que entra ciente
140	265	Inspecionada sala dos servidores e foi constado um novo gotejamento no teto a cima da porta, fato registrado por fotos. Foi reportado a Encarregado da Divisão de Infraestrutura - 1TEN Frankelene. 	Sup. que entra ciente
138	265	Realizada a troca dos Ares-condicionados.\r\n	Sup. que entra ciente
149	273	PTC que foi identificado pelo SO Carlos as 12:48 do dia 08/08/2022 que a conexão com a CPCE foi perdida, o mesmo de pronto realizou contato telefônico junto a equipe de informática dessa Capitania e os mesmos se prontificaram na busca de solucionar o problema.\r\n\r\nNo dia 09/08/2022 foi identificado que a conexão com a CPCE foi reestabelecida. Às 08:40 foi realizado contato telefônico com o 2SG-PD Souza Moura  e o mesmo reportou que a conexão foi reestabelecida às 20:30 do dia 08/08/2022.\r\n\r\n	Sup. que entra ciente
141	267	PTC que houve uma queda de energia no prédio da rádio Marinha, ocasionando a interrupção dos rádios que fazem o enlace do Com3dn, CPPR e ERMN. PTC que o serviço foi reestabelecido dentro de 15 minutos.	Sup. que entra ciente
142	267	PTC que ao regressar no sábado, dia 30/07/22, no complexo da base, para verificar as instalações de rede e funcionamento do ar-condicionado da sala dos servidores e paiol de fibra, constatei que o ar-condicionado do paiol de fibra estava desligado, como medida corretiva, liguei o ar-condicionado.	Sup. que entra ciente
157	283	PTC que foi identificado no ZABBIX uma interrupção por ICMP na agência de Aracati, as 16:00 e perdurando até as 16:40 quando a conexão voltou sem nenhuma interferência do CLTI. PTC que tentei realizar contato telefônico, antes da conexão ser reestabelecida, porém a chamada não completava. Sendo assim, não foi possível saber o motivo da inoperância da rede.	Sup. que entra ciente
158	283	PTC que foi identificado as 17:40 perda de conexão com a EAMCE, ficando sem conexão via ICMP pelo ZABBIX até o momento de desguarnecimento do CLTI as 18:00. PTC que foi realizado contato telefônico com a OM mais sem sucesso, nenhum dos telefones funcionavam, pressupondo uma possível queda de energia na região.	Sup. que entra ciente
154	276	PTC que foi verificado a falta de conexão com a agência de Penedo às 16:15. Como ação, realizei o contato telefônico com a agência, onde o cabo auxiliar INF que à Agência estava sem energia.	Sup. que entra ciente
144	270	No dia de hoje, as 09:00, os militares que concorrem a escala de serviço do CLTI, compareceram a TELEMÁTICA COM3DN, para adestramento da nova política de Backup do servidor de arquivos.\r\nAdestramento Realizado pelo 2ºSG-PD ALEX.[\r\nEstiveram Presentes: \r\n1ºSG-PD Karen;\r\n1ºSG-BA Wendell;\r\n2ºSG-DT Inácio;\r\n3ºSG-PD Hiago;\r\n3ºSG-PD Laís; e\r\nCB-FN-ET Alexandre.	Sup. que entra ciente
145	270	No 04/AGO será necessário rodar a fita de limpeza no servidor de backup, antes de continuar com o Backup.\r\nSolicita-se ao militar de serviço fazer esse procedimento.	Sup. que entra ciente
146	270	Durante o serviço de hoje, foi observado uma avaria na fechadura da grade da entrada do CLTI. A chave entra mais não gira, para abrir ou fechar a tranca.\r\nFoi realizado diversas tentativas,  e nem forçando deu certo.	Sup. que entra ciente
150	274	Inoperância da CPPB. - O Admin SG- Deulisses ligou as 16:39 informando intermitência na rede elétrica da OM e que seria necessário desligamento dos equipamentos para manutenção. / Não foi informado previsão para retorno.\r\n\r\n\r\n-= 09.08.2022_16:43:13 Inoperante, 1 hora média de intervalo de 605 kbit/s (Tráfego de entrada) em geral é baixo para essa hora da semana (No response (check: firewalls, routing, snmp settings of device, IPs, SNMP version, community, passwords etc) (erro de SNMP Nº -2003)) =-	Sup. que entra ciente
151	274	Resolução da Inoperância CPPB, resolvido as 06h59 Dia 10/08/2022.	Sup. que entra ciente
147	271	Realizada a limpeza do drive de backup com a Fita de Limpeza nº 02.	Sup. que entra ciente
148	271	Fita de Limpeza nº 01 apresentou erro e encontra-se marcada como danificada e lacrada.	Sup. que entra ciente
143	268	PTC que ao fechar o CLTI no dia 1AGO22, a fechadura da Grade estava com problemas. Não foi possível girar a chave ficando apenas no lugar.	Sup. que entra ciente
155	276	Conexão com à agência de Penedo reestabelecida.	Sup. que entra ciente
153	152	PTC que foi verificado a falta de conexão com a agência de Penedo às 16:15. Como ação, realizei o contato telefônico com a agência, onde o cabo auxiliar INF que à Agência estava sem energia.	Em andamento
152	276	PTC que foi verificado a falta de conexão com a agência de Penedo às 16:15. Como ação, realizei o contato telefônico com a agência, cujo o cabo auxiliar INF que à Agência estava sem energia.	Sup. que entra ciente
160	285	PTC que as 16:46 foi aberto um chamado pela AGBRAN de nº 2022067585, informando erro 500 no servidor do SIGDEM ao tentar anexar um documento. Ao VRF o servidor da OM, foi constatado que a partição /local estava com 100% do espaço alocado, provando assim o erro reportado. Ao analisar os arquivos do servidor e da própria AGBRAN, foi identificado um arquivo de log da base do SIGDEM com aproximadamente 2GB do ano de 2018, logo, através do filezilla copiei essa base, que ficou armazenada na ET do 1T Carlos Augusto, posteriormente dentro do servidor, executei o comando para apagar a base. Em seguida a função do SIGDEM voltou a funcionar, segundo resposta do chamado.	Sup. que entra ciente
156	277	A conectividade do Com3ºDN apresentou oscilações durante os dias 13 e 14/AGO, havendo interrupção total entre as 08:15h e 10:30h do dia 13/AGO. Verificando-se as ferramentas de monitoramento, não foi possível determinar as causas. Suspeita-se que tenha sido problema interno à OM, tendo em vista que não houveram outras OM da área da Grande Natal apresentando problemas de conectividade.	Sup. que entra ciente
159	284	Infiltração próximo ao televisor de monitoramento dos rádios. Enviado e-mail 24AGO 08:05P.	Sup. que entra ciente
\.


--
-- TOC entry 3873 (class 0 OID 0)
-- Dependencies: 255
-- Name: tb_rel_servico_ocorrencias_idtb_rel_servico_ocorrencias_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_rel_servico_ocorrencias_idtb_rel_servico_ocorrencias_seq', 160, true);


--
-- TOC entry 3642 (class 0 OID 18495)
-- Dependencies: 256
-- Data for Name: tb_rel_sv_v2; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_rel_sv_v2 (idtb_rel_servico, sup_sai_servico, sup_entra_servico, num_rel, data_entra_servico, data_sai_servico, cel_funcional, sit_servidores, sit_backup, status) FROM stdin;
\.


--
-- TOC entry 3874 (class 0 OID 0)
-- Dependencies: 257
-- Name: tb_rel_sv_v2_idtb_rel_servico_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_rel_sv_v2_idtb_rel_servico_seq', 1, false);


--
-- TOC entry 3644 (class 0 OID 18503)
-- Dependencies: 258
-- Data for Name: tb_rel_sv_v2_ocorrencias; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_rel_sv_v2_ocorrencias (idtb_rel_servico_ocorrencias, num_rel, ocorrencia) FROM stdin;
\.


--
-- TOC entry 3875 (class 0 OID 0)
-- Dependencies: 259
-- Name: tb_rel_sv_v2_ocorrencias_idtb_rel_servico_ocorrencias_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_rel_sv_v2_ocorrencias_idtb_rel_servico_ocorrencias_seq', 1, false);


--
-- TOC entry 3646 (class 0 OID 18511)
-- Dependencies: 260
-- Data for Name: tb_servidores; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_servidores (idtb_servidores, idtb_om_apoiadas, fabricante, modelo, idtb_proc_modelo, clock_proc, qtde_proc, memoria, armazenamento, end_ip, end_mac, idtb_sor, finalidade, data_aquisicao, data_garantia, status, idtb_om_setores, nome) FROM stdin;
1	1	HP	PROLIANT DL360 GEN9	48	2.20000005	2	128	2300	172.23.116.10	14:02:ec:96:78:1c	25	SIGDEM/CORREIO NOTES	2018-12-25	2019-12-25	EM PRODUÇÃO	5	BNN1
2	1	HP	PROLIANT DL360P GEN8	49	2.5999999	2	1810	128	172.23.116.54	40:a8:f0:31:5c:cc	22	VIRTUALIZAÇÃO	2018-01-01	2019-01-01	EM PRODUÇÃO	5	VMWARE03
3	1	IBM	 IBM SYSTEM X3650 M4	50	2.5	2	32	600	172.23.119.0	34:40:b5:d9:5a:5c	22	VIRTUALIZAÇÃO	2012-01-01	2013-01-01	EM PRODUÇÃO	5	VMWARE01
4	1	DELL	R710	51	3	2	96	1000	172.23.116.13	bc-30-5b-fe-68-b4	9	WSUS	2014-01-01	2015-01-01	EM PRODUÇÃO	5	WSUS-CLTI3DN
6	1	HP	PROLIANT DL380E GEN8	57	2.5	2	128	1630	172.23.119.3	14:58:d0:5a:3f:fc	22	VIRTUALIZAÇÃO	2019-01-01	2020-01-01	EM PRODUÇÃO	7	VMWARE04
7	1	IBM	SYSTEM X3500 M4	58	2	2	16	8000	172.23.116.15	40:f2:e9:66:31:90	25	BACKUP	2014-01-01	2015-01-01	EM PRODUÇÃO	7	BK01
5	1	MCAFEE	WG-4500-D	52	3	1	64	1000	172.23.116.32	00:1E:67:06:38:CA	26	PROXY	2015-01-01	2016-01-01	EM PRODUÇÃO	5	WEBGATEWAY
\.


--
-- TOC entry 3665 (class 0 OID 19236)
-- Dependencies: 296
-- Data for Name: tb_servidores_excluidos; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_servidores_excluidos (idtb_servidores_excluidos, idtb_om_apoiadas, fabricante, modelo, end_ip, end_mac, data_del, hora_del) FROM stdin;
\.


--
-- TOC entry 3876 (class 0 OID 0)
-- Dependencies: 295
-- Name: tb_servidores_excluidos_idtb_servidores_excluidos_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_servidores_excluidos_idtb_servidores_excluidos_seq', 1, false);


--
-- TOC entry 3877 (class 0 OID 0)
-- Dependencies: 261
-- Name: tb_servidores_idtb_servidores_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_servidores_idtb_servidores_seq', 7, true);


--
-- TOC entry 3648 (class 0 OID 18519)
-- Dependencies: 262
-- Data for Name: tb_soft_padronizados; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_soft_padronizados (idtb_soft_padronizados, categoria, software, status) FROM stdin;
1	SUITE DE SEGURANÇA	KASPERSKY	ATIVO
2	AUTOMAÇÃO DE ESCRITÓRIO	LIBRE OFFICE	ATIVO
3	NAVEGADOR WEB	FIREFOX	ATIVO
4	LEITOR DE ARQUIVOS PDF	ADOBE READER	ATIVO
5	COMPACTADOR DE ARQUIVOS	7-ZIP	ATIVO
6	EXCLUSÃO SEGURA DE ARQUIVOS	ERASER	ATIVO
7	EXCLUSÃO SEGURA DE ARQUIVOS	SECURE-DELETE	ATIVO
8	IMPRESSORA PDF	PDF CREATOR	ATIVO
9	JAVA RUNTIME	ORACLE JAVA SE	ATIVO
10	COMPACTADOR DE ARQUIVOS	WINRAR	ATIVO
11	ASSINATURA DIGITAL	ORION	ATIVO
\.


--
-- TOC entry 3878 (class 0 OID 0)
-- Dependencies: 263
-- Name: tb_soft_padronizados_idtb_soft_padronizados_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_soft_padronizados_idtb_soft_padronizados_seq', 11, true);


--
-- TOC entry 3650 (class 0 OID 18527)
-- Dependencies: 264
-- Data for Name: tb_sor; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_sor (idtb_sor, desenvolvedor, descricao, versao, situacao) FROM stdin;
1	MICROSOFT	WINDOWS	XP	DESCONTINUADO
2	MICROSOFT	WINDOWS	7	DESCONTINUADO
3	MICROSOFT	WINDOWS	8	DESCONTINUADO
4	MICROSOFT	WINDOWS	8.1	ATIVO
5	MICROSOFT	WINDOWS	10	ATIVO
6	MICROSOFT	WINDOWS SERVER	2000	DESCONTINUADO
7	MICROSOFT	WINDOWS SERVER	2003	DESCONTINUADO
8	MICROSOFT	WINDOWS SERVER	2008	DESCONTINUADO
9	MICROSOFT	WINDOWS SERVER	2012	ATIVO
10	MICROSOFT	WINDOWS SERVER	2016	ATIVO
11	MICROSOFT	WINDOWS SERVER	2019	ATIVO
12	CANONICAL	UBUNTU MB	14.04	DESCONTINUADO
14	CANONICAL	UBUNTU MB	18.04	ATIVO
15	CANONICAL	UBUNTU MB	20.04	ATIVO
16	CITRIX	HYPERVISOR XENSERVER	7.0	ATIVO
17	CITRIX	HYPERVISOR XENSERVER	7.1	ATIVO
18	CITRIX	HYPERVISOR XENSERVER	8.0	ATIVO
19	CITRIX	HYPERVISOR XENSERVER	8.1	ATIVO
20	VMWARE	VMWARE ESXI	5.5	DESCONTINUADO
21	VMWARE	VMWARE ESXI	6.0	ATIVO
22	VMWARE	VMWARE ESXI	6.7	ATIVO
23	VMWARE	VMWARE ESXI	6.5	ATIVO
24	VMWARE	VMWARE ESXI	7.0	ATIVO
25	ORACLE	ORACLE LINUX	7	ATIVO
26	MCAFEE	WEBGATEWAY	7	ATIVO
13	CANONICAL	UBUNTU MB	16.04	DESCONTINUADO
27	CANONICAL	UBUNTU MB	22.04	ATIVO
\.


--
-- TOC entry 3879 (class 0 OID 0)
-- Dependencies: 265
-- Name: tb_sor_idtb_sor_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_sor_idtb_sor_seq', 27, true);


--
-- TOC entry 3652 (class 0 OID 18535)
-- Dependencies: 266
-- Data for Name: tb_temas_pad_sic_tic; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_temas_pad_sic_tic (idtb_temas_pad_sic_tic, idtb_pad_sic_tic, tema, status, justificativa, data_ade) FROM stdin;
1	1	Adestramento básico de SIC	PREVISTO	\N	\N
2	1	Conceitos Gerais de SIC	PREVISTO	\N	\N
3	1	ISIC da OM	PREVISTO	\N	\N
4	1	Recursos de SIC	PREVISTO	\N	\N
5	1	Legislação, Normas e Documentos de SIC	PREVISTO	\N	\N
6	1	Ativação dos Planos de Contingência da OM	PREVISTO	\N	\N
7	1	Segurança Orgânica, no que se refere à SIC	PREVISTO	\N	\N
8	1	Normas para a salvaguarda de materiais controlados, dados, informações, \n                documentos emateriais sigilosos	PREVISTO	\N	\N
9	1	Recursos Criptológicos	PREVISTO	\N	\N
10	1	Engenharia Social	PREVISTO	\N	\N
11	1	Crimes de Informática	PREVISTO	\N	\N
12	2	Adestramento básico de SIC	PREVISTO	\N	\N
13	2	Conceitos Gerais de SIC	PREVISTO	\N	\N
14	2	ISIC da OM	PREVISTO	\N	\N
15	2	Recursos de SIC	PREVISTO	\N	\N
16	2	Legislação, Normas e Documentos de SIC	PREVISTO	\N	\N
17	2	Ativação dos Planos de Contingência da OM	PREVISTO	\N	\N
18	2	Segurança Orgânica, no que se refere à SIC	PREVISTO	\N	\N
19	2	Normas para a salvaguarda de materiais controlados, dados, informações, \n                documentos e materiais sigilosos	PREVISTO	\N	\N
20	2	Recursos Criptológicos	PREVISTO	\N	\N
21	2	Engenharia Social	PREVISTO	\N	\N
22	2	Crimes de Informática	PREVISTO	\N	\N
\.


--
-- TOC entry 3880 (class 0 OID 0)
-- Dependencies: 267
-- Name: tb_temas_pad_sic_tic_idtb_temas_pad_sic_tic_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_temas_pad_sic_tic_idtb_temas_pad_sic_tic_seq', 22, true);


--
-- TOC entry 3654 (class 0 OID 18543)
-- Dependencies: 268
-- Data for Name: tb_tipos_clti; Type: TABLE DATA; Schema: db_clti; Owner: -
--

COPY tb_tipos_clti (idtb_tipos_clti, norma_atual, data_norma, lotacao_oficiais, lotacao_pracas, tipo_clti) FROM stdin;
1	DCTIMARINST 30-06C	2019-04-30	1	1	1
\.


--
-- TOC entry 3881 (class 0 OID 0)
-- Dependencies: 269
-- Name: tb_tipos_clti_idtb_tipos_clti_seq; Type: SEQUENCE SET; Schema: db_clti; Owner: -
--

SELECT pg_catalog.setval('tb_tipos_clti_idtb_tipos_clti_seq', 1, true);


--
-- TOC entry 3232 (class 2606 OID 18674)
-- Name: cidade_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_cidade
    ADD CONSTRAINT cidade_pkey PRIMARY KEY (id);


--
-- TOC entry 3262 (class 2606 OID 18676)
-- Name: estado_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_estado
    ADD CONSTRAINT estado_pkey PRIMARY KEY (id);


--
-- TOC entry 3304 (class 2606 OID 18678)
-- Name: pais_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_pais
    ADD CONSTRAINT pais_pkey PRIMARY KEY (id);


--
-- TOC entry 3356 (class 2606 OID 19163)
-- Name: tb_acesso_suspeito_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_acesso_suspeito
    ADD CONSTRAINT tb_acesso_suspeito_pkey PRIMARY KEY (idtb_acesso_suspeito);


--
-- TOC entry 3230 (class 2606 OID 18680)
-- Name: tb_ade_pad_sic_tic_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_ade_pad_sic_tic
    ADD CONSTRAINT tb_ade_pad_sic_tic_pkey PRIMARY KEY (idtb_ade_pad_sic_tic);


--
-- TOC entry 3234 (class 2606 OID 18682)
-- Name: tb_clti_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_clti
    ADD CONSTRAINT tb_clti_pkey PRIMARY KEY (idtb_clti);


--
-- TOC entry 3236 (class 2606 OID 18684)
-- Name: tb_conectividade_end_ip_key; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_conectividade
    ADD CONSTRAINT tb_conectividade_end_ip_key UNIQUE (end_ip);


--
-- TOC entry 3362 (class 2606 OID 19233)
-- Name: tb_conectividade_excluidos_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_conectividade_excluidos
    ADD CONSTRAINT tb_conectividade_excluidos_pkey PRIMARY KEY (idtb_conectividade_excluidos);


--
-- TOC entry 3238 (class 2606 OID 18686)
-- Name: tb_conectividade_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_conectividade
    ADD CONSTRAINT tb_conectividade_pkey PRIMARY KEY (idtb_conectividade);


--
-- TOC entry 3240 (class 2606 OID 18688)
-- Name: tb_conectividade_un; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_conectividade
    ADD CONSTRAINT tb_conectividade_un UNIQUE (nome);


--
-- TOC entry 3242 (class 2606 OID 18690)
-- Name: tb_config_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_config
    ADD CONSTRAINT tb_config_pkey PRIMARY KEY (idtb_config);


--
-- TOC entry 3244 (class 2606 OID 18692)
-- Name: tb_controle_internet_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_controle_internet
    ADD CONSTRAINT tb_controle_internet_pkey PRIMARY KEY (idtb_controle_internet);


--
-- TOC entry 3246 (class 2606 OID 18694)
-- Name: tb_controle_usb_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_controle_usb
    ADD CONSTRAINT tb_controle_usb_pkey PRIMARY KEY (idtb_controle_usb);


--
-- TOC entry 3248 (class 2606 OID 18696)
-- Name: tb_corpo_quadro_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_corpo_quadro
    ADD CONSTRAINT tb_corpo_quadro_pkey PRIMARY KEY (idtb_corpo_quadro);


--
-- TOC entry 3250 (class 2606 OID 18698)
-- Name: tb_det_serv_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_det_serv
    ADD CONSTRAINT tb_det_serv_pkey PRIMARY KEY (idtb_det_serv);


--
-- TOC entry 3254 (class 2606 OID 18700)
-- Name: tb_dias_troca_clti_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_dias_troca_clti
    ADD CONSTRAINT tb_dias_troca_clti_pkey PRIMARY KEY (idtb_dias_troca_clti);


--
-- TOC entry 3252 (class 2606 OID 18702)
-- Name: tb_dias_troca_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_dias_troca
    ADD CONSTRAINT tb_dias_troca_pkey PRIMARY KEY (idtb_dias_troca);


--
-- TOC entry 3256 (class 2606 OID 18704)
-- Name: tb_especialidade_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_especialidade
    ADD CONSTRAINT tb_especialidade_pkey PRIMARY KEY (idtb_especialidade);


--
-- TOC entry 3360 (class 2606 OID 19222)
-- Name: tb_estacoes_excluidas_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_estacoes_excluidas
    ADD CONSTRAINT tb_estacoes_excluidas_pkey PRIMARY KEY (idtb_estacoes_excluidas);


--
-- TOC entry 3258 (class 2606 OID 18706)
-- Name: tb_estacoes_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_estacoes
    ADD CONSTRAINT tb_estacoes_pkey PRIMARY KEY (idtb_estacoes);


--
-- TOC entry 3260 (class 2606 OID 18708)
-- Name: tb_estacoes_un; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_estacoes
    ADD CONSTRAINT tb_estacoes_un UNIQUE (nome);


--
-- TOC entry 3268 (class 2606 OID 18710)
-- Name: tb_funcao_ti_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_funcoes_ti
    ADD CONSTRAINT tb_funcao_ti_pkey PRIMARY KEY (idtb_funcoes_ti);


--
-- TOC entry 3264 (class 2606 OID 18712)
-- Name: tb_funcoes_clti_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_funcoes_clti
    ADD CONSTRAINT tb_funcoes_clti_pkey PRIMARY KEY (idtb_funcoes_clti);


--
-- TOC entry 3266 (class 2606 OID 18714)
-- Name: tb_funcoes_sigdem_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_funcoes_sigdem
    ADD CONSTRAINT tb_funcoes_sigdem_pkey PRIMARY KEY (idtb_funcoes_sigdem);


--
-- TOC entry 3270 (class 2606 OID 18716)
-- Name: tb_gw_om_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_gw_om
    ADD CONSTRAINT tb_gw_om_pkey PRIMARY KEY (idtb_gw_om);


--
-- TOC entry 3280 (class 2606 OID 18718)
-- Name: tb_manutencao_et_pk; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_manutencao_et
    ADD CONSTRAINT tb_manutencao_et_pk PRIMARY KEY (idtb_manutencao_et);


--
-- TOC entry 3282 (class 2606 OID 18720)
-- Name: tb_mapainfra_pk; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_mapainfra
    ADD CONSTRAINT tb_mapainfra_pk PRIMARY KEY (idtb_mapainfra);


--
-- TOC entry 3284 (class 2606 OID 18722)
-- Name: tb_memorias_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_memorias
    ADD CONSTRAINT tb_memorias_pkey PRIMARY KEY (idtb_memorias);


--
-- TOC entry 3286 (class 2606 OID 18724)
-- Name: tb_nao_padronizados_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_nao_padronizados
    ADD CONSTRAINT tb_nao_padronizados_pkey PRIMARY KEY (idtb_nao_padronizados);


--
-- TOC entry 3289 (class 2606 OID 18726)
-- Name: tb_nec_aquisicao_pk; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_nec_aquisicao
    ADD CONSTRAINT tb_nec_aquisicao_pk PRIMARY KEY (idtb_nec_aquisicao);


--
-- TOC entry 3291 (class 2606 OID 18728)
-- Name: tb_numerador_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_numerador
    ADD CONSTRAINT tb_numerador_pkey PRIMARY KEY (idtb_numerador);


--
-- TOC entry 3293 (class 2606 OID 18730)
-- Name: tb_om_apoiadas_cod_om_nome_sigla_indicativo_key; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_om_apoiadas
    ADD CONSTRAINT tb_om_apoiadas_cod_om_nome_sigla_indicativo_key UNIQUE (cod_om, nome, sigla, indicativo);


--
-- TOC entry 3295 (class 2606 OID 18732)
-- Name: tb_om_apoiadas_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_om_apoiadas
    ADD CONSTRAINT tb_om_apoiadas_pkey PRIMARY KEY (idtb_om_apoiadas);


--
-- TOC entry 3298 (class 2606 OID 18734)
-- Name: tb_om_setores_pk; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_om_setores
    ADD CONSTRAINT tb_om_setores_pk PRIMARY KEY (idtb_om_setores);


--
-- TOC entry 3300 (class 2606 OID 18736)
-- Name: tb_osic_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_osic
    ADD CONSTRAINT tb_osic_pkey PRIMARY KEY (idtb_osic);


--
-- TOC entry 3302 (class 2606 OID 18738)
-- Name: tb_pad_sic_tic_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_pad_sic_tic
    ADD CONSTRAINT tb_pad_sic_tic_pkey PRIMARY KEY (idtb_pad_sic_tic);


--
-- TOC entry 3306 (class 2606 OID 18740)
-- Name: tb_perfil_internet_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_perfil_internet
    ADD CONSTRAINT tb_perfil_internet_pkey PRIMARY KEY (idtb_perfil_internet);


--
-- TOC entry 3308 (class 2606 OID 18742)
-- Name: tb_permissoes_admin_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_permissoes_admin
    ADD CONSTRAINT tb_permissoes_admin_pkey PRIMARY KEY (idtb_permissoes_admin);


--
-- TOC entry 3366 (class 2606 OID 19255)
-- Name: tb_pessoal_excluido_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_pessoal_excluido
    ADD CONSTRAINT tb_pessoal_excluido_pkey PRIMARY KEY (idtb_pessoal_excluido);


--
-- TOC entry 3310 (class 2606 OID 18744)
-- Name: tb_pessoal_om_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_pessoal_om
    ADD CONSTRAINT tb_pessoal_om_pkey PRIMARY KEY (idtb_pessoal_om);


--
-- TOC entry 3312 (class 2606 OID 18746)
-- Name: tb_pessoal_ti_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_pessoal_ti
    ADD CONSTRAINT tb_pessoal_ti_pkey PRIMARY KEY (idtb_pessoal_ti);


--
-- TOC entry 3314 (class 2606 OID 18748)
-- Name: tb_posto_grad_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_posto_grad
    ADD CONSTRAINT tb_posto_grad_pkey PRIMARY KEY (idtb_posto_grad);


--
-- TOC entry 3316 (class 2606 OID 18750)
-- Name: tb_proc_fab_nome_key; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_proc_fab
    ADD CONSTRAINT tb_proc_fab_nome_key UNIQUE (nome);


--
-- TOC entry 3318 (class 2606 OID 18752)
-- Name: tb_proc_fab_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_proc_fab
    ADD CONSTRAINT tb_proc_fab_pkey PRIMARY KEY (idtb_proc_fab);


--
-- TOC entry 3320 (class 2606 OID 18754)
-- Name: tb_proc_modelo_modelo_key; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_proc_modelo
    ADD CONSTRAINT tb_proc_modelo_modelo_key UNIQUE (modelo);


--
-- TOC entry 3322 (class 2606 OID 18756)
-- Name: tb_proc_modelo_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_proc_modelo
    ADD CONSTRAINT tb_proc_modelo_pkey PRIMARY KEY (idtb_proc_modelo);


--
-- TOC entry 3324 (class 2606 OID 18758)
-- Name: tb_qualificacao_clti_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_qualificacao_clti
    ADD CONSTRAINT tb_qualificacao_clti_pkey PRIMARY KEY (idtb_qualificacao_clti);


--
-- TOC entry 3326 (class 2606 OID 18760)
-- Name: tb_qualificacao_ti_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_qualificacao_ti
    ADD CONSTRAINT tb_qualificacao_ti_pkey PRIMARY KEY (idtb_qualificacao_ti);


--
-- TOC entry 3358 (class 2606 OID 19171)
-- Name: tb_range_ip_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_range_ip
    ADD CONSTRAINT tb_range_ip_pkey PRIMARY KEY (idtb_range_ip);


--
-- TOC entry 3328 (class 2606 OID 18762)
-- Name: tb_registro_log_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_registro_log
    ADD CONSTRAINT tb_registro_log_pkey PRIMARY KEY (idtb_registro_log);


--
-- TOC entry 3334 (class 2606 OID 18764)
-- Name: tb_rel_servico_log_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_rel_servico_log
    ADD CONSTRAINT tb_rel_servico_log_pkey PRIMARY KEY (idtb_rel_servico_log);


--
-- TOC entry 3336 (class 2606 OID 18766)
-- Name: tb_rel_servico_ocorrencias_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_rel_servico_ocorrencias
    ADD CONSTRAINT tb_rel_servico_ocorrencias_pkey PRIMARY KEY (idtb_rel_servico_ocorrencias);


--
-- TOC entry 3330 (class 2606 OID 18768)
-- Name: tb_rel_servico_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_rel_servico
    ADD CONSTRAINT tb_rel_servico_pkey PRIMARY KEY (idtb_rel_servico);


--
-- TOC entry 3332 (class 2606 OID 18770)
-- Name: tb_rel_servico_unique; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_rel_servico
    ADD CONSTRAINT tb_rel_servico_unique UNIQUE (num_rel);


--
-- TOC entry 3342 (class 2606 OID 18772)
-- Name: tb_rel_sv_v2_ocorrencias_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_rel_sv_v2_ocorrencias
    ADD CONSTRAINT tb_rel_sv_v2_ocorrencias_pkey PRIMARY KEY (idtb_rel_servico_ocorrencias);


--
-- TOC entry 3338 (class 2606 OID 18774)
-- Name: tb_rel_sv_v2_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_rel_sv_v2
    ADD CONSTRAINT tb_rel_sv_v2_pkey PRIMARY KEY (idtb_rel_servico);


--
-- TOC entry 3340 (class 2606 OID 18776)
-- Name: tb_rel_sv_v2_unique; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_rel_sv_v2
    ADD CONSTRAINT tb_rel_sv_v2_unique UNIQUE (num_rel);


--
-- TOC entry 3364 (class 2606 OID 19244)
-- Name: tb_servidores_excluidos_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_servidores_excluidos
    ADD CONSTRAINT tb_servidores_excluidos_pkey PRIMARY KEY (idtb_servidores_excluidos);


--
-- TOC entry 3344 (class 2606 OID 18778)
-- Name: tb_servidores_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_servidores
    ADD CONSTRAINT tb_servidores_pkey PRIMARY KEY (idtb_servidores);


--
-- TOC entry 3346 (class 2606 OID 18780)
-- Name: tb_servidores_un; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_servidores
    ADD CONSTRAINT tb_servidores_un UNIQUE (nome);


--
-- TOC entry 3348 (class 2606 OID 18782)
-- Name: tb_soft_padronizados_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_soft_padronizados
    ADD CONSTRAINT tb_soft_padronizados_pkey PRIMARY KEY (idtb_soft_padronizados);


--
-- TOC entry 3350 (class 2606 OID 18784)
-- Name: tb_sor_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_sor
    ADD CONSTRAINT tb_sor_pkey PRIMARY KEY (idtb_sor);


--
-- TOC entry 3352 (class 2606 OID 18786)
-- Name: tb_temas_pad_sic_tic_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_temas_pad_sic_tic
    ADD CONSTRAINT tb_temas_pad_sic_tic_pkey PRIMARY KEY (idtb_temas_pad_sic_tic);


--
-- TOC entry 3354 (class 2606 OID 18788)
-- Name: tb_tipos_clti_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_tipos_clti
    ADD CONSTRAINT tb_tipos_clti_pkey PRIMARY KEY (idtb_tipos_clti);


--
-- TOC entry 3275 (class 2606 OID 18790)
-- Name: tb_tripulacao_clti_pkey; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_lotacao_clti
    ADD CONSTRAINT tb_tripulacao_clti_pkey PRIMARY KEY (idtb_lotacao_clti);


--
-- TOC entry 3277 (class 2606 OID 18792)
-- Name: unico_nip_cpf; Type: CONSTRAINT; Schema: db_clti; Owner: -; Tablespace: 
--

ALTER TABLE ONLY tb_lotacao_clti
    ADD CONSTRAINT unico_nip_cpf UNIQUE (nip, cpf);


--
-- TOC entry 3271 (class 1259 OID 18793)
-- Name: fki_id_corpo_quadro; Type: INDEX; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE INDEX fki_id_corpo_quadro ON tb_lotacao_clti USING btree (idtb_corpo_quadro);


--
-- TOC entry 3272 (class 1259 OID 18794)
-- Name: fki_id_especialidade; Type: INDEX; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE INDEX fki_id_especialidade ON tb_lotacao_clti USING btree (idtb_especialidade);


--
-- TOC entry 3273 (class 1259 OID 18795)
-- Name: fki_id_posto_grad; Type: INDEX; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE INDEX fki_id_posto_grad ON tb_lotacao_clti USING btree (idtb_posto_grad);


--
-- TOC entry 3278 (class 1259 OID 18796)
-- Name: tb_manutencao_et_idtb_manutencao_et_idx; Type: INDEX; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE INDEX tb_manutencao_et_idtb_manutencao_et_idx ON tb_manutencao_et USING btree (idtb_manutencao_et);


--
-- TOC entry 3287 (class 1259 OID 18797)
-- Name: tb_nec_aquisicao_idtb_nec_aquisicao_idx; Type: INDEX; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE INDEX tb_nec_aquisicao_idtb_nec_aquisicao_idx ON tb_nec_aquisicao USING btree (idtb_nec_aquisicao);


--
-- TOC entry 3296 (class 1259 OID 18798)
-- Name: tb_om_setores_idtb_om_setores_idx; Type: INDEX; Schema: db_clti; Owner: -; Tablespace: 
--

CREATE UNIQUE INDEX tb_om_setores_idtb_om_setores_idx ON tb_om_setores USING btree (idtb_om_setores);


--
-- TOC entry 3367 (class 2606 OID 18799)
-- Name: tb_ade_pad_sic_tic_fk; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_ade_pad_sic_tic
    ADD CONSTRAINT tb_ade_pad_sic_tic_fk FOREIGN KEY (idtb_temas_pad_sic_tic) REFERENCES tb_temas_pad_sic_tic(idtb_temas_pad_sic_tic);


--
-- TOC entry 3368 (class 2606 OID 18804)
-- Name: tb_ade_pad_sic_tic_fk2; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_ade_pad_sic_tic
    ADD CONSTRAINT tb_ade_pad_sic_tic_fk2 FOREIGN KEY (idtb_pessoal_om) REFERENCES tb_pessoal_om(idtb_pessoal_om);


--
-- TOC entry 3369 (class 2606 OID 18809)
-- Name: tb_cidade_estado_fkey; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_cidade
    ADD CONSTRAINT tb_cidade_estado_fkey FOREIGN KEY (estado) REFERENCES tb_estado(id);


--
-- TOC entry 3370 (class 2606 OID 18814)
-- Name: tb_conectividade_fk; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_conectividade
    ADD CONSTRAINT tb_conectividade_fk FOREIGN KEY (idtb_om_setores) REFERENCES tb_om_setores(idtb_om_setores);


--
-- TOC entry 3371 (class 2606 OID 18819)
-- Name: tb_conectividade_idtb_om_apoiadas_fkey; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_conectividade
    ADD CONSTRAINT tb_conectividade_idtb_om_apoiadas_fkey FOREIGN KEY (idtb_om_apoiadas) REFERENCES tb_om_apoiadas(idtb_om_apoiadas);


--
-- TOC entry 3372 (class 2606 OID 18824)
-- Name: tb_controle_internet_fk; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_controle_internet
    ADD CONSTRAINT tb_controle_internet_fk FOREIGN KEY (idtb_pessoal_om) REFERENCES tb_pessoal_om(idtb_pessoal_om);


--
-- TOC entry 3373 (class 2606 OID 18829)
-- Name: tb_controle_internet_fk1; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_controle_internet
    ADD CONSTRAINT tb_controle_internet_fk1 FOREIGN KEY (idtb_om_apoiadas) REFERENCES tb_om_apoiadas(idtb_om_apoiadas);


--
-- TOC entry 3374 (class 2606 OID 18834)
-- Name: tb_controle_usb_fk; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_controle_usb
    ADD CONSTRAINT tb_controle_usb_fk FOREIGN KEY (idtb_estacoes) REFERENCES tb_estacoes(idtb_estacoes);


--
-- TOC entry 3375 (class 2606 OID 18839)
-- Name: tb_controle_usb_fk1; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_controle_usb
    ADD CONSTRAINT tb_controle_usb_fk1 FOREIGN KEY (idtb_om_apoiadas) REFERENCES tb_om_apoiadas(idtb_om_apoiadas);


--
-- TOC entry 3376 (class 2606 OID 18844)
-- Name: tb_det_serv_fkey1; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_det_serv
    ADD CONSTRAINT tb_det_serv_fkey1 FOREIGN KEY (idtb_lotacao_clti) REFERENCES tb_lotacao_clti(idtb_lotacao_clti);


--
-- TOC entry 3377 (class 2606 OID 18849)
-- Name: tb_estacoes_fk; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_estacoes
    ADD CONSTRAINT tb_estacoes_fk FOREIGN KEY (idtb_memorias) REFERENCES tb_memorias(idtb_memorias);


--
-- TOC entry 3378 (class 2606 OID 18854)
-- Name: tb_estacoes_fk_1; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_estacoes
    ADD CONSTRAINT tb_estacoes_fk_1 FOREIGN KEY (idtb_om_apoiadas) REFERENCES tb_om_apoiadas(idtb_om_apoiadas);


--
-- TOC entry 3379 (class 2606 OID 18859)
-- Name: tb_estacoes_fk_2; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_estacoes
    ADD CONSTRAINT tb_estacoes_fk_2 FOREIGN KEY (idtb_proc_modelo) REFERENCES tb_proc_modelo(idtb_proc_modelo);


--
-- TOC entry 3380 (class 2606 OID 18864)
-- Name: tb_estacoes_fk_3; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_estacoes
    ADD CONSTRAINT tb_estacoes_fk_3 FOREIGN KEY (idtb_sor) REFERENCES tb_sor(idtb_sor);


--
-- TOC entry 3381 (class 2606 OID 18869)
-- Name: tb_estacoes_fk_4; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_estacoes
    ADD CONSTRAINT tb_estacoes_fk_4 FOREIGN KEY (idtb_om_setores) REFERENCES tb_om_setores(idtb_om_setores);


--
-- TOC entry 3382 (class 2606 OID 18874)
-- Name: tb_estado_pais_fkey; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_estado
    ADD CONSTRAINT tb_estado_pais_fkey FOREIGN KEY (pais) REFERENCES tb_pais(id);


--
-- TOC entry 3383 (class 2606 OID 18879)
-- Name: tb_funcoes_sigdem_fk; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_funcoes_sigdem
    ADD CONSTRAINT tb_funcoes_sigdem_fk FOREIGN KEY (idtb_pessoal_om) REFERENCES tb_pessoal_om(idtb_pessoal_om);


--
-- TOC entry 3384 (class 2606 OID 18884)
-- Name: tb_funcoes_sigdem_idtb_om_apoiadas_fkey; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_funcoes_sigdem
    ADD CONSTRAINT tb_funcoes_sigdem_idtb_om_apoiadas_fkey FOREIGN KEY (idtb_om_apoiadas) REFERENCES tb_om_apoiadas(idtb_om_apoiadas);


--
-- TOC entry 3385 (class 2606 OID 18889)
-- Name: tb_gw_om_fk1; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_gw_om
    ADD CONSTRAINT tb_gw_om_fk1 FOREIGN KEY (idtb_om_apoiadas) REFERENCES tb_om_apoiadas(idtb_om_apoiadas);


--
-- TOC entry 3386 (class 2606 OID 18894)
-- Name: tb_lotacao_clti_idtb_corpo_quadro_fkey; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_lotacao_clti
    ADD CONSTRAINT tb_lotacao_clti_idtb_corpo_quadro_fkey FOREIGN KEY (idtb_corpo_quadro) REFERENCES tb_corpo_quadro(idtb_corpo_quadro);


--
-- TOC entry 3387 (class 2606 OID 18899)
-- Name: tb_lotacao_clti_idtb_especialidade_fkey; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_lotacao_clti
    ADD CONSTRAINT tb_lotacao_clti_idtb_especialidade_fkey FOREIGN KEY (idtb_especialidade) REFERENCES tb_especialidade(idtb_especialidade);


--
-- TOC entry 3388 (class 2606 OID 18904)
-- Name: tb_lotacao_clti_idtb_posto_grad_fkey; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_lotacao_clti
    ADD CONSTRAINT tb_lotacao_clti_idtb_posto_grad_fkey FOREIGN KEY (idtb_posto_grad) REFERENCES tb_posto_grad(idtb_posto_grad);


--
-- TOC entry 3389 (class 2606 OID 18909)
-- Name: tb_manutencao_et_fk; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_manutencao_et
    ADD CONSTRAINT tb_manutencao_et_fk FOREIGN KEY (idtb_estacoes) REFERENCES tb_estacoes(idtb_estacoes);


--
-- TOC entry 3390 (class 2606 OID 18914)
-- Name: tb_manutencao_et_fk_1; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_manutencao_et
    ADD CONSTRAINT tb_manutencao_et_fk_1 FOREIGN KEY (idtb_om_apoiadas) REFERENCES tb_om_apoiadas(idtb_om_apoiadas);


--
-- TOC entry 3391 (class 2606 OID 18919)
-- Name: tb_mapainfra_fk_1; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_mapainfra
    ADD CONSTRAINT tb_mapainfra_fk_1 FOREIGN KEY (idtb_estacoes_dest) REFERENCES tb_estacoes(idtb_estacoes);


--
-- TOC entry 3392 (class 2606 OID 18924)
-- Name: tb_mapainfra_fk_2; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_mapainfra
    ADD CONSTRAINT tb_mapainfra_fk_2 FOREIGN KEY (idtb_servidores_dest) REFERENCES tb_servidores(idtb_servidores);


--
-- TOC entry 3393 (class 2606 OID 18929)
-- Name: tb_mapainfra_fk_3; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_mapainfra
    ADD CONSTRAINT tb_mapainfra_fk_3 FOREIGN KEY (idtb_conectividade_orig) REFERENCES tb_conectividade(idtb_conectividade);


--
-- TOC entry 3394 (class 2606 OID 18934)
-- Name: tb_mapainfra_fk_4; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_mapainfra
    ADD CONSTRAINT tb_mapainfra_fk_4 FOREIGN KEY (idtb_om_apoiadas) REFERENCES tb_om_apoiadas(idtb_om_apoiadas);


--
-- TOC entry 3395 (class 2606 OID 18939)
-- Name: tb_mapainfra_fk_5; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_mapainfra
    ADD CONSTRAINT tb_mapainfra_fk_5 FOREIGN KEY (idtb_conectividade_dest) REFERENCES tb_conectividade(idtb_conectividade);


--
-- TOC entry 3396 (class 2606 OID 18944)
-- Name: tb_nao_padronizados_fk; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_nao_padronizados
    ADD CONSTRAINT tb_nao_padronizados_fk FOREIGN KEY (idtb_estacoes) REFERENCES tb_estacoes(idtb_estacoes);


--
-- TOC entry 3397 (class 2606 OID 18949)
-- Name: tb_nao_padronizados_fk1; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_nao_padronizados
    ADD CONSTRAINT tb_nao_padronizados_fk1 FOREIGN KEY (idtb_om_apoiadas) REFERENCES tb_om_apoiadas(idtb_om_apoiadas);


--
-- TOC entry 3398 (class 2606 OID 18954)
-- Name: tb_nec_aquisicao_fk; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_nec_aquisicao
    ADD CONSTRAINT tb_nec_aquisicao_fk FOREIGN KEY (idtb_manutencao_et) REFERENCES tb_manutencao_et(idtb_manutencao_et);


--
-- TOC entry 3399 (class 2606 OID 18959)
-- Name: tb_om_apoiadas_id_cidade_fkey; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_om_apoiadas
    ADD CONSTRAINT tb_om_apoiadas_id_cidade_fkey FOREIGN KEY (idtb_cidade) REFERENCES tb_cidade(id);


--
-- TOC entry 3400 (class 2606 OID 18964)
-- Name: tb_om_apoiadas_id_estado_fkey; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_om_apoiadas
    ADD CONSTRAINT tb_om_apoiadas_id_estado_fkey FOREIGN KEY (idtb_estado) REFERENCES tb_estado(id);


--
-- TOC entry 3401 (class 2606 OID 18969)
-- Name: tb_om_setores_fk; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_om_setores
    ADD CONSTRAINT tb_om_setores_fk FOREIGN KEY (idtb_om_apoiadas) REFERENCES tb_om_apoiadas(idtb_om_apoiadas);


--
-- TOC entry 3402 (class 2606 OID 18974)
-- Name: tb_osic_idtb_corpo_quadro_fkey; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_osic
    ADD CONSTRAINT tb_osic_idtb_corpo_quadro_fkey FOREIGN KEY (idtb_corpo_quadro) REFERENCES tb_corpo_quadro(idtb_corpo_quadro);


--
-- TOC entry 3403 (class 2606 OID 18979)
-- Name: tb_osic_idtb_especialidade_fkey; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_osic
    ADD CONSTRAINT tb_osic_idtb_especialidade_fkey FOREIGN KEY (idtb_especialidade) REFERENCES tb_especialidade(idtb_especialidade);


--
-- TOC entry 3404 (class 2606 OID 18984)
-- Name: tb_osic_idtb_om_apoiadas_fkey; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_osic
    ADD CONSTRAINT tb_osic_idtb_om_apoiadas_fkey FOREIGN KEY (idtb_om_apoiadas) REFERENCES tb_om_apoiadas(idtb_om_apoiadas);


--
-- TOC entry 3405 (class 2606 OID 18989)
-- Name: tb_osic_idtb_posto_grad_fkey; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_osic
    ADD CONSTRAINT tb_osic_idtb_posto_grad_fkey FOREIGN KEY (idtb_posto_grad) REFERENCES tb_posto_grad(idtb_posto_grad);


--
-- TOC entry 3406 (class 2606 OID 18994)
-- Name: tb_pad_sic_tic_fk1; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_pad_sic_tic
    ADD CONSTRAINT tb_pad_sic_tic_fk1 FOREIGN KEY (idtb_om_apoiadas) REFERENCES tb_om_apoiadas(idtb_om_apoiadas);


--
-- TOC entry 3407 (class 2606 OID 18999)
-- Name: tb_permissoes_admin_fk; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_permissoes_admin
    ADD CONSTRAINT tb_permissoes_admin_fk FOREIGN KEY (idtb_estacoes) REFERENCES tb_estacoes(idtb_estacoes);


--
-- TOC entry 3408 (class 2606 OID 19004)
-- Name: tb_permissoes_admin_fk1; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_permissoes_admin
    ADD CONSTRAINT tb_permissoes_admin_fk1 FOREIGN KEY (idtb_om_apoiadas) REFERENCES tb_om_apoiadas(idtb_om_apoiadas);


--
-- TOC entry 3409 (class 2606 OID 19009)
-- Name: tb_pessoal_om_idtb_corpo_quadro_fkey; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_pessoal_om
    ADD CONSTRAINT tb_pessoal_om_idtb_corpo_quadro_fkey FOREIGN KEY (idtb_corpo_quadro) REFERENCES tb_corpo_quadro(idtb_corpo_quadro);


--
-- TOC entry 3410 (class 2606 OID 19014)
-- Name: tb_pessoal_om_idtb_especialidade_fkey; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_pessoal_om
    ADD CONSTRAINT tb_pessoal_om_idtb_especialidade_fkey FOREIGN KEY (idtb_especialidade) REFERENCES tb_especialidade(idtb_especialidade);


--
-- TOC entry 3411 (class 2606 OID 19019)
-- Name: tb_pessoal_om_idtb_om_apoiada_fkey; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_pessoal_om
    ADD CONSTRAINT tb_pessoal_om_idtb_om_apoiada_fkey FOREIGN KEY (idtb_om_apoiadas) REFERENCES tb_om_apoiadas(idtb_om_apoiadas);


--
-- TOC entry 3412 (class 2606 OID 19024)
-- Name: tb_pessoal_om_idtb_posto_grad_fkey; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_pessoal_om
    ADD CONSTRAINT tb_pessoal_om_idtb_posto_grad_fkey FOREIGN KEY (idtb_posto_grad) REFERENCES tb_posto_grad(idtb_posto_grad);


--
-- TOC entry 3413 (class 2606 OID 19029)
-- Name: tb_pessoal_ti_idtb_corpo_quadro_fkey; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_pessoal_ti
    ADD CONSTRAINT tb_pessoal_ti_idtb_corpo_quadro_fkey FOREIGN KEY (idtb_corpo_quadro) REFERENCES tb_corpo_quadro(idtb_corpo_quadro);


--
-- TOC entry 3414 (class 2606 OID 19034)
-- Name: tb_pessoal_ti_idtb_especialidade_fkey; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_pessoal_ti
    ADD CONSTRAINT tb_pessoal_ti_idtb_especialidade_fkey FOREIGN KEY (idtb_especialidade) REFERENCES tb_especialidade(idtb_especialidade);


--
-- TOC entry 3415 (class 2606 OID 19039)
-- Name: tb_pessoal_ti_idtb_funcoes_ti_fkey; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_pessoal_ti
    ADD CONSTRAINT tb_pessoal_ti_idtb_funcoes_ti_fkey FOREIGN KEY (idtb_funcoes_ti) REFERENCES tb_funcoes_ti(idtb_funcoes_ti);


--
-- TOC entry 3416 (class 2606 OID 19044)
-- Name: tb_pessoal_ti_idtb_om_apoiada_fkey; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_pessoal_ti
    ADD CONSTRAINT tb_pessoal_ti_idtb_om_apoiada_fkey FOREIGN KEY (idtb_om_apoiadas) REFERENCES tb_om_apoiadas(idtb_om_apoiadas);


--
-- TOC entry 3417 (class 2606 OID 19049)
-- Name: tb_pessoal_ti_idtb_posto_grad_fkey; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_pessoal_ti
    ADD CONSTRAINT tb_pessoal_ti_idtb_posto_grad_fkey FOREIGN KEY (idtb_posto_grad) REFERENCES tb_posto_grad(idtb_posto_grad);


--
-- TOC entry 3418 (class 2606 OID 19054)
-- Name: tb_proc_modelo_idtb_proc_fab_fkey; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_proc_modelo
    ADD CONSTRAINT tb_proc_modelo_idtb_proc_fab_fkey FOREIGN KEY (idtb_proc_fab) REFERENCES tb_proc_fab(idtb_proc_fab);


--
-- TOC entry 3419 (class 2606 OID 19059)
-- Name: tb_qualificacao_clti_idtb_lotacao_clti_fkey; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_qualificacao_clti
    ADD CONSTRAINT tb_qualificacao_clti_idtb_lotacao_clti_fkey FOREIGN KEY (idtb_lotacao_clti) REFERENCES tb_lotacao_clti(idtb_lotacao_clti);


--
-- TOC entry 3420 (class 2606 OID 19064)
-- Name: tb_qualificacao_ti_idtb_pessoal_ti_fkey; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_qualificacao_ti
    ADD CONSTRAINT tb_qualificacao_ti_idtb_pessoal_ti_fkey FOREIGN KEY (idtb_pessoal_ti) REFERENCES tb_pessoal_ti(idtb_pessoal_ti);


--
-- TOC entry 3421 (class 2606 OID 19069)
-- Name: tb_rel_servico_fkey1; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_rel_servico
    ADD CONSTRAINT tb_rel_servico_fkey1 FOREIGN KEY (sup_sai_servico) REFERENCES tb_lotacao_clti(idtb_lotacao_clti);


--
-- TOC entry 3422 (class 2606 OID 19074)
-- Name: tb_rel_servico_fkey2; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_rel_servico
    ADD CONSTRAINT tb_rel_servico_fkey2 FOREIGN KEY (sup_entra_servico) REFERENCES tb_lotacao_clti(idtb_lotacao_clti);


--
-- TOC entry 3423 (class 2606 OID 19079)
-- Name: tb_rel_servico_log_fk1; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_rel_servico_log
    ADD CONSTRAINT tb_rel_servico_log_fk1 FOREIGN KEY (num_rel) REFERENCES tb_rel_servico(num_rel);


--
-- TOC entry 3424 (class 2606 OID 19084)
-- Name: tb_rel_servico_ocorrencias_fk1; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_rel_servico_ocorrencias
    ADD CONSTRAINT tb_rel_servico_ocorrencias_fk1 FOREIGN KEY (num_rel) REFERENCES tb_rel_servico(num_rel);


--
-- TOC entry 3425 (class 2606 OID 19089)
-- Name: tb_rel_sv_v2_fkey1; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_rel_sv_v2
    ADD CONSTRAINT tb_rel_sv_v2_fkey1 FOREIGN KEY (sup_sai_servico) REFERENCES tb_lotacao_clti(idtb_lotacao_clti);


--
-- TOC entry 3426 (class 2606 OID 19094)
-- Name: tb_rel_sv_v2_fkey2; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_rel_sv_v2
    ADD CONSTRAINT tb_rel_sv_v2_fkey2 FOREIGN KEY (sup_entra_servico) REFERENCES tb_lotacao_clti(idtb_lotacao_clti);


--
-- TOC entry 3427 (class 2606 OID 19099)
-- Name: tb_rel_sv_v2_ocorrencias_fk1; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_rel_sv_v2_ocorrencias
    ADD CONSTRAINT tb_rel_sv_v2_ocorrencias_fk1 FOREIGN KEY (num_rel) REFERENCES tb_rel_sv_v2(num_rel);


--
-- TOC entry 3428 (class 2606 OID 19104)
-- Name: tb_servidores_fk; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_servidores
    ADD CONSTRAINT tb_servidores_fk FOREIGN KEY (idtb_om_setores) REFERENCES tb_om_setores(idtb_om_setores);


--
-- TOC entry 3429 (class 2606 OID 19109)
-- Name: tb_servidores_idtb_om_apoiadas_fkey; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_servidores
    ADD CONSTRAINT tb_servidores_idtb_om_apoiadas_fkey FOREIGN KEY (idtb_om_apoiadas) REFERENCES tb_om_apoiadas(idtb_om_apoiadas);


--
-- TOC entry 3430 (class 2606 OID 19114)
-- Name: tb_servidores_idtb_proc_modelo_fkey; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_servidores
    ADD CONSTRAINT tb_servidores_idtb_proc_modelo_fkey FOREIGN KEY (idtb_proc_modelo) REFERENCES tb_proc_modelo(idtb_proc_modelo);


--
-- TOC entry 3431 (class 2606 OID 19119)
-- Name: tb_servidores_idtb_sor_fkey; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_servidores
    ADD CONSTRAINT tb_servidores_idtb_sor_fkey FOREIGN KEY (idtb_sor) REFERENCES tb_sor(idtb_sor);


--
-- TOC entry 3432 (class 2606 OID 19124)
-- Name: tb_temas_pad_sic_tic_fk1; Type: FK CONSTRAINT; Schema: db_clti; Owner: -
--

ALTER TABLE ONLY tb_temas_pad_sic_tic
    ADD CONSTRAINT tb_temas_pad_sic_tic_fk1 FOREIGN KEY (idtb_pad_sic_tic) REFERENCES tb_pad_sic_tic(idtb_pad_sic_tic);


--
-- TOC entry 3674 (class 0 OID 0)
-- Dependencies: 8
-- Name: public; Type: ACL; Schema: -; Owner: -
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- TOC entry 3680 (class 0 OID 0)
-- Dependencies: 172
-- Name: tb_cidade; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE tb_cidade FROM PUBLIC;
REVOKE ALL ON TABLE tb_cidade FROM postgres;
GRANT ALL ON TABLE tb_cidade TO postgres;
GRANT ALL ON TABLE tb_cidade TO sisclti;


--
-- TOC entry 3683 (class 0 OID 0)
-- Dependencies: 174
-- Name: tb_clti; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE tb_clti FROM PUBLIC;
REVOKE ALL ON TABLE tb_clti FROM postgres;
GRANT ALL ON TABLE tb_clti TO postgres;
GRANT ALL ON TABLE tb_clti TO sisclti;


--
-- TOC entry 3687 (class 0 OID 0)
-- Dependencies: 176
-- Name: tb_conectividade; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE tb_conectividade FROM PUBLIC;
REVOKE ALL ON TABLE tb_conectividade FROM postgres;
GRANT ALL ON TABLE tb_conectividade TO postgres;
GRANT ALL ON TABLE tb_conectividade TO sisclti;


--
-- TOC entry 3692 (class 0 OID 0)
-- Dependencies: 178
-- Name: tb_config; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE tb_config FROM PUBLIC;
REVOKE ALL ON TABLE tb_config FROM postgres;
GRANT ALL ON TABLE tb_config TO postgres;
GRANT ALL ON TABLE tb_config TO sisclti;


--
-- TOC entry 3695 (class 0 OID 0)
-- Dependencies: 180
-- Name: tb_controle_internet; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE tb_controle_internet FROM PUBLIC;
REVOKE ALL ON TABLE tb_controle_internet FROM postgres;
GRANT ALL ON TABLE tb_controle_internet TO postgres;
GRANT ALL ON TABLE tb_controle_internet TO sisclti;


--
-- TOC entry 3698 (class 0 OID 0)
-- Dependencies: 182
-- Name: tb_controle_usb; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE tb_controle_usb FROM PUBLIC;
REVOKE ALL ON TABLE tb_controle_usb FROM postgres;
GRANT ALL ON TABLE tb_controle_usb TO postgres;
GRANT ALL ON TABLE tb_controle_usb TO sisclti;


--
-- TOC entry 3701 (class 0 OID 0)
-- Dependencies: 184
-- Name: tb_corpo_quadro; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE tb_corpo_quadro FROM PUBLIC;
REVOKE ALL ON TABLE tb_corpo_quadro FROM postgres;
GRANT ALL ON TABLE tb_corpo_quadro TO postgres;
GRANT ALL ON TABLE tb_corpo_quadro TO sisclti;


--
-- TOC entry 3709 (class 0 OID 0)
-- Dependencies: 192
-- Name: tb_especialidade; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE tb_especialidade FROM PUBLIC;
REVOKE ALL ON TABLE tb_especialidade FROM postgres;
GRANT ALL ON TABLE tb_especialidade TO postgres;
GRANT ALL ON TABLE tb_especialidade TO sisclti;


--
-- TOC entry 3712 (class 0 OID 0)
-- Dependencies: 194
-- Name: tb_estacoes; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE tb_estacoes FROM PUBLIC;
REVOKE ALL ON TABLE tb_estacoes FROM postgres;
GRANT ALL ON TABLE tb_estacoes TO postgres;
GRANT ALL ON TABLE tb_estacoes TO sisclti;


--
-- TOC entry 3717 (class 0 OID 0)
-- Dependencies: 196
-- Name: tb_estado; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE tb_estado FROM PUBLIC;
REVOKE ALL ON TABLE tb_estado FROM postgres;
GRANT ALL ON TABLE tb_estado TO postgres;
GRANT ALL ON TABLE tb_estado TO sisclti;


--
-- TOC entry 3722 (class 0 OID 0)
-- Dependencies: 200
-- Name: tb_funcoes_sigdem; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE tb_funcoes_sigdem FROM PUBLIC;
REVOKE ALL ON TABLE tb_funcoes_sigdem FROM postgres;
GRANT ALL ON TABLE tb_funcoes_sigdem TO postgres;
GRANT ALL ON TABLE tb_funcoes_sigdem TO sisclti;


--
-- TOC entry 3725 (class 0 OID 0)
-- Dependencies: 202
-- Name: tb_funcoes_ti; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE tb_funcoes_ti FROM PUBLIC;
REVOKE ALL ON TABLE tb_funcoes_ti FROM postgres;
GRANT ALL ON TABLE tb_funcoes_ti TO postgres;
GRANT ALL ON TABLE tb_funcoes_ti TO sisclti;


--
-- TOC entry 3730 (class 0 OID 0)
-- Dependencies: 206
-- Name: tb_lotacao_clti; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE tb_lotacao_clti FROM PUBLIC;
REVOKE ALL ON TABLE tb_lotacao_clti FROM postgres;
GRANT ALL ON TABLE tb_lotacao_clti TO postgres;
GRANT ALL ON TABLE tb_lotacao_clti TO sisclti;


--
-- TOC entry 3733 (class 0 OID 0)
-- Dependencies: 208
-- Name: tb_manutencao_et; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE tb_manutencao_et FROM PUBLIC;
REVOKE ALL ON TABLE tb_manutencao_et FROM postgres;
GRANT ALL ON TABLE tb_manutencao_et TO postgres;
GRANT ALL ON TABLE tb_manutencao_et TO sisclti;


--
-- TOC entry 3736 (class 0 OID 0)
-- Dependencies: 210
-- Name: tb_mapainfra; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE tb_mapainfra FROM PUBLIC;
REVOKE ALL ON TABLE tb_mapainfra FROM postgres;
GRANT ALL ON TABLE tb_mapainfra TO postgres;
GRANT ALL ON TABLE tb_mapainfra TO sisclti;


--
-- TOC entry 3739 (class 0 OID 0)
-- Dependencies: 212
-- Name: tb_memorias; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE tb_memorias FROM PUBLIC;
REVOKE ALL ON TABLE tb_memorias FROM postgres;
GRANT ALL ON TABLE tb_memorias TO postgres;
GRANT ALL ON TABLE tb_memorias TO sisclti;


--
-- TOC entry 3744 (class 0 OID 0)
-- Dependencies: 216
-- Name: tb_nec_aquisicao; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE tb_nec_aquisicao FROM PUBLIC;
REVOKE ALL ON TABLE tb_nec_aquisicao FROM postgres;
GRANT ALL ON TABLE tb_nec_aquisicao TO postgres;
GRANT ALL ON TABLE tb_nec_aquisicao TO sisclti;


--
-- TOC entry 3748 (class 0 OID 0)
-- Dependencies: 220
-- Name: tb_om_apoiadas; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE tb_om_apoiadas FROM PUBLIC;
REVOKE ALL ON TABLE tb_om_apoiadas FROM postgres;
GRANT ALL ON TABLE tb_om_apoiadas TO postgres;
GRANT ALL ON TABLE tb_om_apoiadas TO sisclti;


--
-- TOC entry 3751 (class 0 OID 0)
-- Dependencies: 222
-- Name: tb_om_setores; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE tb_om_setores FROM PUBLIC;
REVOKE ALL ON TABLE tb_om_setores FROM postgres;
GRANT ALL ON TABLE tb_om_setores TO postgres;
GRANT ALL ON TABLE tb_om_setores TO sisclti;


--
-- TOC entry 3754 (class 0 OID 0)
-- Dependencies: 224
-- Name: tb_osic; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE tb_osic FROM PUBLIC;
REVOKE ALL ON TABLE tb_osic FROM postgres;
GRANT ALL ON TABLE tb_osic TO postgres;
GRANT ALL ON TABLE tb_osic TO sisclti;


--
-- TOC entry 3759 (class 0 OID 0)
-- Dependencies: 228
-- Name: tb_pais; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE tb_pais FROM PUBLIC;
REVOKE ALL ON TABLE tb_pais FROM postgres;
GRANT ALL ON TABLE tb_pais TO postgres;
GRANT ALL ON TABLE tb_pais TO sisclti;


--
-- TOC entry 3762 (class 0 OID 0)
-- Dependencies: 230
-- Name: tb_perfil_internet; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE tb_perfil_internet FROM PUBLIC;
REVOKE ALL ON TABLE tb_perfil_internet FROM postgres;
GRANT ALL ON TABLE tb_perfil_internet TO postgres;
GRANT ALL ON TABLE tb_perfil_internet TO sisclti;


--
-- TOC entry 3769 (class 0 OID 0)
-- Dependencies: 234
-- Name: tb_pessoal_om; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE tb_pessoal_om FROM PUBLIC;
REVOKE ALL ON TABLE tb_pessoal_om FROM postgres;
GRANT ALL ON TABLE tb_pessoal_om TO postgres;
GRANT ALL ON TABLE tb_pessoal_om TO sisclti;


--
-- TOC entry 3772 (class 0 OID 0)
-- Dependencies: 236
-- Name: tb_pessoal_ti; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE tb_pessoal_ti FROM PUBLIC;
REVOKE ALL ON TABLE tb_pessoal_ti FROM postgres;
GRANT ALL ON TABLE tb_pessoal_ti TO postgres;
GRANT ALL ON TABLE tb_pessoal_ti TO sisclti;


--
-- TOC entry 3775 (class 0 OID 0)
-- Dependencies: 238
-- Name: tb_posto_grad; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE tb_posto_grad FROM PUBLIC;
REVOKE ALL ON TABLE tb_posto_grad FROM postgres;
GRANT ALL ON TABLE tb_posto_grad TO postgres;
GRANT ALL ON TABLE tb_posto_grad TO sisclti;


--
-- TOC entry 3778 (class 0 OID 0)
-- Dependencies: 240
-- Name: tb_proc_fab; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE tb_proc_fab FROM PUBLIC;
REVOKE ALL ON TABLE tb_proc_fab FROM postgres;
GRANT ALL ON TABLE tb_proc_fab TO postgres;
GRANT ALL ON TABLE tb_proc_fab TO sisclti;


--
-- TOC entry 3781 (class 0 OID 0)
-- Dependencies: 242
-- Name: tb_proc_modelo; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE tb_proc_modelo FROM PUBLIC;
REVOKE ALL ON TABLE tb_proc_modelo FROM postgres;
GRANT ALL ON TABLE tb_proc_modelo TO postgres;
GRANT ALL ON TABLE tb_proc_modelo TO sisclti;


--
-- TOC entry 3784 (class 0 OID 0)
-- Dependencies: 244
-- Name: tb_qualificacao_clti; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE tb_qualificacao_clti FROM PUBLIC;
REVOKE ALL ON TABLE tb_qualificacao_clti FROM postgres;
GRANT ALL ON TABLE tb_qualificacao_clti TO postgres;
GRANT ALL ON TABLE tb_qualificacao_clti TO sisclti;


--
-- TOC entry 3787 (class 0 OID 0)
-- Dependencies: 246
-- Name: tb_qualificacao_ti; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE tb_qualificacao_ti FROM PUBLIC;
REVOKE ALL ON TABLE tb_qualificacao_ti FROM postgres;
GRANT ALL ON TABLE tb_qualificacao_ti TO postgres;
GRANT ALL ON TABLE tb_qualificacao_ti TO sisclti;


--
-- TOC entry 3792 (class 0 OID 0)
-- Dependencies: 248
-- Name: tb_registro_log; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE tb_registro_log FROM PUBLIC;
REVOKE ALL ON TABLE tb_registro_log FROM postgres;
GRANT ALL ON TABLE tb_registro_log TO postgres;
GRANT ALL ON TABLE tb_registro_log TO sisclti;


--
-- TOC entry 3805 (class 0 OID 0)
-- Dependencies: 260
-- Name: tb_servidores; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE tb_servidores FROM PUBLIC;
REVOKE ALL ON TABLE tb_servidores FROM postgres;
GRANT ALL ON TABLE tb_servidores TO postgres;
GRANT ALL ON TABLE tb_servidores TO sisclti;


--
-- TOC entry 3812 (class 0 OID 0)
-- Dependencies: 264
-- Name: tb_sor; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE tb_sor FROM PUBLIC;
REVOKE ALL ON TABLE tb_sor FROM postgres;
GRANT ALL ON TABLE tb_sor TO postgres;
GRANT ALL ON TABLE tb_sor TO sisclti;


--
-- TOC entry 3816 (class 0 OID 0)
-- Dependencies: 268
-- Name: tb_tipos_clti; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE tb_tipos_clti FROM PUBLIC;
REVOKE ALL ON TABLE tb_tipos_clti FROM postgres;
GRANT ALL ON TABLE tb_tipos_clti TO postgres;
GRANT ALL ON TABLE tb_tipos_clti TO sisclti;


--
-- TOC entry 3818 (class 0 OID 0)
-- Dependencies: 273
-- Name: vw_controle_usb; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE vw_controle_usb FROM PUBLIC;
REVOKE ALL ON TABLE vw_controle_usb FROM postgres;
GRANT ALL ON TABLE vw_controle_usb TO postgres;
GRANT ALL ON TABLE vw_controle_usb TO sisclti;


--
-- TOC entry 3819 (class 0 OID 0)
-- Dependencies: 274
-- Name: vw_estacoes; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE vw_estacoes FROM PUBLIC;
REVOKE ALL ON TABLE vw_estacoes FROM postgres;
GRANT ALL ON TABLE vw_estacoes TO postgres;
GRANT ALL ON TABLE vw_estacoes TO sisclti;


--
-- TOC entry 3820 (class 0 OID 0)
-- Dependencies: 276
-- Name: vw_mapainfra; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE vw_mapainfra FROM PUBLIC;
REVOKE ALL ON TABLE vw_mapainfra FROM postgres;
GRANT ALL ON TABLE vw_mapainfra TO postgres;
GRANT ALL ON TABLE vw_mapainfra TO sisclti;


--
-- TOC entry 3821 (class 0 OID 0)
-- Dependencies: 278
-- Name: vw_osic; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE vw_osic FROM PUBLIC;
REVOKE ALL ON TABLE vw_osic FROM postgres;
GRANT ALL ON TABLE vw_osic TO postgres;
GRANT ALL ON TABLE vw_osic TO sisclti;


--
-- TOC entry 3822 (class 0 OID 0)
-- Dependencies: 281
-- Name: vw_pessoal_ti; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE vw_pessoal_ti FROM PUBLIC;
REVOKE ALL ON TABLE vw_pessoal_ti FROM postgres;
GRANT ALL ON TABLE vw_pessoal_ti TO postgres;
GRANT ALL ON TABLE vw_pessoal_ti TO sisclti;


--
-- TOC entry 3823 (class 0 OID 0)
-- Dependencies: 282
-- Name: vw_processadores; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE vw_processadores FROM PUBLIC;
REVOKE ALL ON TABLE vw_processadores FROM postgres;
GRANT ALL ON TABLE vw_processadores TO postgres;
GRANT ALL ON TABLE vw_processadores TO sisclti;


--
-- TOC entry 3824 (class 0 OID 0)
-- Dependencies: 285
-- Name: vw_servidores; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE vw_servidores FROM PUBLIC;
REVOKE ALL ON TABLE vw_servidores FROM postgres;
GRANT ALL ON TABLE vw_servidores TO postgres;
GRANT ALL ON TABLE vw_servidores TO sisclti;


--
-- TOC entry 3825 (class 0 OID 0)
-- Dependencies: 286
-- Name: vw_setores; Type: ACL; Schema: db_clti; Owner: -
--

REVOKE ALL ON TABLE vw_setores FROM PUBLIC;
REVOKE ALL ON TABLE vw_setores FROM postgres;
GRANT ALL ON TABLE vw_setores TO postgres;
GRANT ALL ON TABLE vw_setores TO sisclti;


-- Completed on 2022-08-30 00:15:02 -03

--
-- PostgreSQL database dump complete
--

