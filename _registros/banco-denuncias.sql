-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 07-Nov-2018 às 14:49
-- Versão do servidor: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banco-denuncias`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_anexos`
--

CREATE TABLE `tb_anexos` (
  `ID` int(20) NOT NULL,
  `ID_DENUNCIA` int(20) NOT NULL,
  `DS_TIPO` enum('COMPLEMENTO DO DENUNCIANTE','RESULTADO DE TRIAGEM','STATUS DA DENUNCIA') NOT NULL,
  `DS_COMENTARIOS` varchar(100) DEFAULT NULL,
  `DT_RECEBIMENTO_EOUV` date DEFAULT NULL,
  `DT_RECEBIMENTO_SISTEMA` date NOT NULL,
  `NM_ARQUIVO` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_anexos`
--

INSERT INTO `tb_anexos` (`ID`, `ID_DENUNCIA`, `DS_TIPO`, `DS_COMENTARIOS`, `DT_RECEBIMENTO_EOUV`, `DT_RECEBIMENTO_SISTEMA`, `NM_ARQUIVO`) VALUES
(1, 1, 'COMPLEMENTO DO DENUNCIANTE', NULL, '2018-10-23', '0000-00-00', 'credenciais-github.txt'),
(3, 1, 'COMPLEMENTO DO DENUNCIANTE', NULL, '2019-02-20', '0000-00-00', 'credenciais-ODP.txt'),
(31, 1, 'STATUS DA DENUNCIA', 'asadasdasdasdadadasdasdasd', '0000-00-00', '0000-00-00', '[1]Painel-de-Controle-da-Transparencia.docx'),
(32, 1, 'STATUS DA DENUNCIA', 'ASDASDASDAS', '0000-00-00', '0000-00-00', '[1]credenciais-ODP.txt'),
(33, 1, 'STATUS DA DENUNCIA', 'ASDADADADAS', '0000-00-00', '0000-00-00', 'Relatorio-FAPEAL.doc'),
(34, 1, 'STATUS DA DENUNCIA', 'sadasdasdasda', '0000-00-00', '0000-00-00', '[2]Painel-de-Controle-da-Transparencia.docx'),
(35, 6, 'STATUS DA DENUNCIA', 'hehehehehhehee', '0000-00-00', '0000-00-00', '[2]credenciais-ODP.txt');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_assuntos_denuncia`
--

CREATE TABLE `tb_assuntos_denuncia` (
  `ID` int(20) NOT NULL,
  `DS_NOME_MACRO` varchar(100) NOT NULL,
  `DS_NOME_MICRO` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_assuntos_denuncia`
--

INSERT INTO `tb_assuntos_denuncia` (`ID`, `DS_NOME_MACRO`, `DS_NOME_MICRO`) VALUES
(1, 'EDUCAÇÃO', 'Vestibular'),
(2, 'EDUCAÇÃO', 'Mestrado'),
(3, 'EDUCAÇÃO', 'Doutorado'),
(4, 'EDUCAÇÃO', 'Escolas Públicas Estaduais'),
(5, 'EDUCAÇÃO', 'Transporte escolar'),
(6, 'EDUCAÇÃO', 'Merenda escolar'),
(7, 'EDUCAÇÃO', 'Certificado escolar'),
(8, 'EDUCAÇÃO', 'Histórico escolar'),
(9, 'EDUCAÇÃO', 'Acessibilidade nas escolas'),
(10, 'EDUCAÇÃO', 'Vagas nas escolas'),
(11, 'EDUCAÇÃO', 'Documento escolar'),
(12, 'EDUCAÇÃO', 'Construção de escolas públicas'),
(13, 'EDUCAÇÃO', 'Inspeção escolar'),
(14, 'EDUCAÇÃO', 'Estágio'),
(15, 'EDUCAÇÃO', 'Gestão escolar'),
(16, 'EDUCAÇÃO', 'Procedimento da Direção da Escola Públicas'),
(17, 'SAÚDE', 'Hospital'),
(18, 'SAÚDE', 'Vigilância Sanitária'),
(19, 'SAÚDE', 'Central de Transplante'),
(20, 'SAÚDE', 'Assistência Hospitalar'),
(21, 'SAÚDE', 'Assistência Farmacêutica – CEAF'),
(22, 'SAÚDE', 'Hemoal'),
(23, 'SAÚDE', 'SUS'),
(24, 'SAÚDE', 'SAMU'),
(25, 'SAÚDE', 'Ambulatório'),
(26, 'SAÚDE', 'Atendimento prestado'),
(27, 'SAÚDE', 'Medicamento'),
(28, 'SAÚDE', 'Plantão'),
(29, 'SAÚDE', 'Conselho Estadual de Saúde – CES'),
(30, 'SAÚDE', 'Fundo Estadual de Saúde – FES'),
(31, 'SAÚDE', 'Portal do Cidadão'),
(32, 'TRABALHO E EMPREGO', 'Vagas de trabalho'),
(33, 'TRABALHO E EMPREGO', 'SINE Estadual'),
(34, 'TRABALHO E EMPREGO', 'Programas e Projetos'),
(35, 'SEGURANÇA PÚBLICA', 'Polícia Militar'),
(36, 'CULTURA', NULL),
(37, 'INFRAESTRUTURA', NULL),
(38, 'AGRICULTURA, PECUÁRIA, PESCA E AQUICULTURA', NULL),
(39, 'DESENVOLVIMENTO E TURISMO', 'Energia'),
(40, 'DESENVOLVIMENTO E TURISMO', 'Mineração indústria'),
(41, 'DESENVOLVIMENTO E TURISMO', 'Comércio'),
(42, 'DESENVOLVIMENTO E TURISMO', 'Serviços'),
(43, 'DESENVOLVIMENTO E TURISMO', 'Turismo'),
(44, 'DESENVOLVIMENTO E TURISMO', 'Desenvolvimento Econômico'),
(45, 'PESSOAL', 'Servidor público'),
(46, 'PESSOAL', 'Concurso público'),
(47, 'PESSOAL', 'Conduta de servidores públicos'),
(48, 'PESSOAL', 'Acumulação de cargos públicos'),
(49, 'PESSOAL', 'Pensão'),
(50, 'PESSOAL', 'Processo Administrativo Disciplinar - PAD'),
(51, 'PESSOAL', 'Comissão de Acumulação de Cargos'),
(52, 'PESSOAL', 'Nepotismo'),
(53, 'PESSOAL', 'Empréstimo'),
(54, 'PESSOAL', 'Desconto indevido'),
(55, 'PESSOAL', 'Auxilio doença'),
(56, 'PESSOAL', 'Salário'),
(57, 'PESSOAL', 'Verbas rescisórias'),
(58, 'PESSOAL', 'Diárias'),
(59, 'PESSOAL', 'Correição'),
(60, 'PESSOAL', 'FGTS'),
(61, 'PESSOAL', 'PIS'),
(62, 'PESSOAL', 'PASEP'),
(63, 'PESSOAL', 'Monitoria'),
(64, 'SERVIÇO PÚBLICO/UTILIDADE PÚBLICA', 'Transporte'),
(65, 'SERVIÇO PÚBLICO/UTILIDADE PÚBLICA', 'Comunicação'),
(66, 'SERVIÇO PÚBLICO/UTILIDADE PÚBLICA', 'Insatisfação no atendimento recebido pelo órgão/Entidade'),
(67, 'SERVIÇO PÚBLICO/UTILIDADE PÚBLICA', 'Insatisfação do serviço prestado'),
(68, 'SERVIÇO PÚBLICO/UTILIDADE PÚBLICA', 'Energia elétrica'),
(69, 'SERVIÇO PÚBLICO/UTILIDADE PÚBLICA', 'Violência contra mulher'),
(70, 'SERVIÇO PÚBLICO/UTILIDADE PÚBLICA', 'Direitos Humanos'),
(71, 'SERVIÇO PÚBLICO/UTILIDADE PÚBLICA', 'Desenvolvimento Urbano'),
(72, 'SERVIÇO PÚBLICO/UTILIDADE PÚBLICA', 'Esporte'),
(73, 'SERVIÇO PÚBLICO/UTILIDADE PÚBLICA', 'Lazer'),
(74, 'SERVIÇO PÚBLICO/UTILIDADE PÚBLICA', 'Ressocialização'),
(75, 'SERVIÇO PÚBLICO/UTILIDADE PÚBLICA', 'Inclusão Social'),
(76, 'SERVIÇO PÚBLICO/UTILIDADE PÚBLICA', 'Diário Oficial'),
(77, 'INFORMAÇÃO PROCEDIMENTAL', 'Alvará'),
(78, 'INFORMAÇÃO PROCEDIMENTAL', 'Proteção Ambiental'),
(79, 'INFORMAÇÃO PROCEDIMENTAL', 'Certificado'),
(80, 'INFORMAÇÃO PROCEDIMENTAL', 'Processo Administrativo'),
(81, 'INFORMAÇÃO PROCEDIMENTAL', 'Transferência de Veiculo'),
(82, 'TRANSPARÊNCIA PÚBLICA/CONTROLE INTERNO', 'Cadastro Nacional de Empresas Inidôneas e Suspensas – CEIS'),
(83, 'TRANSPARÊNCIA PÚBLICA/CONTROLE INTERNO', 'Auditoria'),
(84, 'TRANSPARÊNCIA PÚBLICA/CONTROLE INTERNO', 'Portal da Transparência'),
(85, 'TRANSPARÊNCIA PÚBLICA/CONTROLE INTERNO', 'Sistema Eletrônico do Serviço de Informação ao Cidadão - e-Sic'),
(86, 'TRANSPARÊNCIA PÚBLICA/CONTROLE INTERNO', 'Acesso à Informação'),
(87, 'TRANSPARÊNCIA PÚBLICA/CONTROLE INTERNO', 'e-Ouv'),
(88, 'TRANSPARÊNCIA PÚBLICA/CONTROLE INTERNO', 'Fale conosco'),
(89, 'TRANSPARÊNCIA PÚBLICA/CONTROLE INTERNO', 'Monitoramento das Despesas Públicas'),
(90, 'TRANSPARÊNCIA PÚBLICA/CONTROLE INTERNO', 'Cartilhas'),
(91, 'TRANSPARÊNCIA PÚBLICA/CONTROLE INTERNO', 'Cadastro Nacional de Empresas Inidôneas e Suspensas – CEIS'),
(92, 'TRANSPARÊNCIA PÚBLICA/CONTROLE INTERNO', 'Ouvidoria'),
(93, 'CONTRATAÇÃO PÚBLICA', 'Licitação'),
(94, 'CONTRATAÇÃO PÚBLICA', 'Contrato'),
(95, 'CONTRATAÇÃO PÚBLICA', 'Convênios'),
(96, 'LEGISLAÇÃO', 'Regimento Interno'),
(97, 'RECEITA/DESPESA', 'Imposto'),
(98, 'RECEITA/DESPESA', 'Imposto'),
(99, 'RECEITA/DESPESA', 'IPVA'),
(100, 'RECEITA/DESPESA', 'Tributos'),
(101, 'RECEITA/DESPESA', 'Multa'),
(102, 'RECEITA/DESPESA', 'Sonegação fiscal'),
(103, 'PATRIMÔNIO PÚBLICO', NULL),
(104, 'OUTROS', 'Administração Pública'),
(105, 'OUTROS', 'Estágio'),
(106, 'OUTROS', 'Ciência'),
(107, 'OUTROS', 'Tecnologia'),
(108, 'OUTROS', 'Assistência Social'),
(109, 'OUTROS', 'Desenvolvimento Social'),
(110, 'OUTROS', 'Economia, Trabalho, Emprego e Renda'),
(111, 'OUTROS', 'Proteção Ambiental'),
(112, 'OUTROS', 'Malversação do dinheiro público'),
(113, 'OUTROS', 'Estelionato'),
(114, 'OUTROS', 'Documentos'),
(115, 'OUTROS', 'Limites territoriais'),
(116, 'OUTROS', 'Atestado médico'),
(117, 'OUTROS', 'Dados cadastrais'),
(118, 'OUTROS', 'Composição societária'),
(119, 'OUTROS', 'Autarquias'),
(120, 'OUTROS', 'Empresas Públicas'),
(121, 'OUTROS', 'Frota'),
(122, 'OUTROS', 'Prestação de Contas');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_denuncias`
--

CREATE TABLE `tb_denuncias` (
  `ID` int(20) NOT NULL,
  `DS_NUMERO` varchar(20) NOT NULL,
  `DS_TIPO` enum('IDENTIFICADA','ANÔNIMA') NOT NULL,
  `ID_SERVIDOR` int(20) NOT NULL,
  `ID_ASSUNTO` int(20) NOT NULL,
  `DS_NOME_DENUNCIANTE` varchar(50) DEFAULT NULL,
  `DS_CPF_DENUNCIANTE` varchar(14) DEFAULT NULL,
  `DS_EMAIL_DENUNCIANTE` varchar(30) DEFAULT NULL,
  `DS_TELEFONE_DENUNCIANTE` varchar(9) DEFAULT NULL,
  `TX_DESCRICAO_FATO` text NOT NULL,
  `ID_ORGAO_DENUNCIADO` int(20) DEFAULT NULL,
  `ID_MUNICIPIO_FATO` int(20) DEFAULT NULL,
  `DS_ENVOLVIDOS` varchar(100) DEFAULT NULL,
  `DT_REGISTRO_EOUV` date NOT NULL,
  `DT_REGISTRO` date NOT NULL,
  `DS_NUMERO_PROCESSO_SEI` varchar(23) NOT NULL,
  `BL_ACESSO_RESTRITO` tinyint(1) DEFAULT NULL,
  `ID_RESPONSAVEL_TRIAGEM` int(20) DEFAULT NULL,
  `BL_RELEVANCIA` tinyint(1) DEFAULT NULL,
  `DT_TERMINO_TRIAGEM` date DEFAULT NULL,
  `DS_ANDAMENTO` enum('AGUARDANDO COMPLEMENTAÇÃO DO DENUNCIANTE','AGUARDANDO ANÁLISE PRELIMINAR DA OUVIDORIA') DEFAULT NULL,
  `DS_SITUACAO` enum('AGUARDANDO TRIAGEM','EM TRIAGEM','APTA','NÃO APTA') DEFAULT 'AGUARDANDO TRIAGEM',
  `ID_UNIDADE_APURACAO` int(20) DEFAULT NULL,
  `BL_TRIAGEM_CONCLUIDA` tinyint(4) NOT NULL DEFAULT '0',
  `DS_STATUS` enum('PROCEDENTE','NÃO PROCEDENTE - NÃO OCORRÊNCIA DO FATO DENUNCIADO','NÃO PROCEDENTE - INEXISTÊNCIA DE PROVAS','NÃO TRATADA') NOT NULL DEFAULT 'NÃO TRATADA'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_denuncias`
--

INSERT INTO `tb_denuncias` (`ID`, `DS_NUMERO`, `DS_TIPO`, `ID_SERVIDOR`, `ID_ASSUNTO`, `DS_NOME_DENUNCIANTE`, `DS_CPF_DENUNCIANTE`, `DS_EMAIL_DENUNCIANTE`, `DS_TELEFONE_DENUNCIANTE`, `TX_DESCRICAO_FATO`, `ID_ORGAO_DENUNCIADO`, `ID_MUNICIPIO_FATO`, `DS_ENVOLVIDOS`, `DT_REGISTRO_EOUV`, `DT_REGISTRO`, `DS_NUMERO_PROCESSO_SEI`, `BL_ACESSO_RESTRITO`, `ID_RESPONSAVEL_TRIAGEM`, `BL_RELEVANCIA`, `DT_TERMINO_TRIAGEM`, `DS_ANDAMENTO`, `DS_SITUACAO`, `ID_UNIDADE_APURACAO`, `BL_TRIAGEM_CONCLUIDA`, `DS_STATUS`) VALUES
(1, '1/20181001', 'ANÔNIMA', 1, 57, NULL, NULL, NULL, NULL, '<h2 style=\"text-align: left;\"><em>Est&aacute;gio</em></h2>\r\n<p style=\"text-align: left;\">&nbsp;</p>\r\n<p style=\"text-align: left;\"><em>Eu quero um est&aacute;gio e n&atilde;o arrumo. Eu quero um est&aacute;gio e n&atilde;o arrumo. Eu quero um est&aacute;gio e n&atilde;o arrumo. Eu quero um est&aacute;gio e n&atilde;o arrumo. Eu quero um est&aacute;gio e n&atilde;o arrumo. Eu quero um est&aacute;gio e n&atilde;o arrumo. Eu quero um est&aacute;gio e n&atilde;o arrumo. Eu quero um est&aacute;gio e n&atilde;o arrumo. Eu quero um est&aacute;gio e n&atilde;o arrumo. Eu quero um est&aacute;gio e n&atilde;o arrumo. Eu quero um est&aacute;gio e n&atilde;o arrumo. Eu quero um est&aacute;gio </em></p>\r\n<p style=\"text-align: left;\">&nbsp;</p>\r\n<p style=\"text-align: left;\">Judson Bandeira</p>\r\n<p style=\"text-align: left;\">&nbsp;</p>\r\n<p style=\"text-align: left;\">cora&ccedil;&atilde;o&nbsp;</p>', 66, 26, 'sdasdsadasdasdasdas', '2018-10-01', '2018-12-02', '01104 000563/2018', 1, 1, 1, '2018-10-24', NULL, 'APTA', 1, 1, 'NÃO PROCEDENTE - NÃO OCORRÊNCIA DO FATO DENUNCIADO'),
(2, '2/20181024-P', 'IDENTIFICADA', 1, 95, 'Antonio', NULL, NULL, NULL, '<p style=\"text-align: justify;\">Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui&nbsp;</p>\r\n<p style=\"text-align: justify;\">&nbsp;</p>\r\n<p style=\"text-align: justify;\"><span style=\"text-align: start;\">Seu texto aqui&nbsp;</span>Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui Seu texto aqui&nbsp;</p>', 11, 12, NULL, '2018-10-24', '2019-01-01', '12000 000555/2018', 1, 1, 1, '2018-10-31', NULL, 'EM TRIAGEM', 1, 0, 'NÃO TRATADA'),
(3, '3/20181024-P', 'ANÔNIMA', 1, 11, NULL, NULL, NULL, NULL, '<p>Seu texto aqui xto aqui xto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aquixto aqui xto aqui</p>', 12, 7, NULL, '2018-10-24', '2018-10-31', '55555 555555/2018', NULL, NULL, NULL, NULL, NULL, 'EM TRIAGEM', NULL, 0, 'NÃO TRATADA'),
(6, '6/20181120-P', 'ANÔNIMA', 1, 4, NULL, NULL, NULL, NULL, '<p style=\"text-align: justify;\">&nbsp;Seu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aquiSeu texto aqui</p>', 15, 18, 'JUDSON, WILLIAMS', '2018-11-20', '2018-11-05', '01104 000055/2018', 0, 4, 1, '2018-11-05', NULL, 'EM TRIAGEM', 2, 1, 'PROCEDENTE');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_historico_denuncia`
--

CREATE TABLE `tb_historico_denuncia` (
  `ID` int(20) NOT NULL,
  `ID_DENUNCIA` int(20) NOT NULL,
  `ID_SERVIDOR` int(20) NOT NULL,
  `DT_ACAO` datetime NOT NULL,
  `DS_TIPO_ACAO` enum('CADASTRO','EDIÇÃO','SALVAMENTO DE TRIAGEM','CONCLUSÃO DE TRIAGEM','ANDAMENTO') NOT NULL,
  `TX_MENSAGEM` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_historico_denuncia`
--

INSERT INTO `tb_historico_denuncia` (`ID`, `ID_DENUNCIA`, `ID_SERVIDOR`, `DT_ACAO`, `DS_TIPO_ACAO`, `TX_MENSAGEM`) VALUES
(1, 6, 1, '2018-11-05 09:37:27', 'CADASTRO', 'EFETUOU O CADASTRO'),
(2, 6, 1, '2018-11-05 09:37:54', 'EDIÇÃO', 'EDITOU A DENÚNCIA'),
(3, 6, 1, '2018-11-05 09:38:31', 'SALVAMENTO DE TRIAGEM', 'SALVOU A TRIAGEM'),
(4, 6, 1, '2018-11-05 09:38:39', 'CONCLUSÃO DE TRIAGEM', 'CONCLUIU A TRIAGEM'),
(5, 6, 1, '2018-11-05 09:38:56', 'ANDAMENTO', 'DEU ANDAMENTO A DENÚNCIA'),
(6, 3, 4, '2018-11-07 09:18:52', 'EDIÇÃO', 'EDITOU A DENÚNCIA'),
(7, 3, 4, '2018-11-07 09:50:54', 'EDIÇÃO', 'EDITOU A DENÚNCIA'),
(8, 3, 4, '2018-11-07 09:58:03', 'EDIÇÃO', ''),
(9, 3, 4, '2018-11-07 09:58:42', 'EDIÇÃO', ''),
(10, 3, 4, '2018-11-07 09:59:49', 'EDIÇÃO', ''),
(11, 3, 4, '2018-11-07 10:01:57', 'EDIÇÃO', 'EDITOU A DENÚNCIA. Foram alterados os dados:  Assunto da denúncia; Nome do denunciante; CPF do denunciante; Telefone do denunciante; E-mail do denunciante; Envolvidos;');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_municipios`
--

CREATE TABLE `tb_municipios` (
  `ID` int(20) NOT NULL,
  `DS_NOME` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_municipios`
--

INSERT INTO `tb_municipios` (`ID`, `DS_NOME`) VALUES
(1, 'Água Branca'),
(2, 'Anadia'),
(3, 'Arapiraca'),
(4, 'Atalaia'),
(5, 'Barra de Santo Antônio'),
(6, 'Barra de São Miguel'),
(7, 'Batalha'),
(8, 'Belém'),
(9, 'Belo Monte'),
(10, 'Boca da Mata'),
(11, 'Branquinha'),
(12, 'Cacimbinhas'),
(13, 'Cajueiro'),
(14, 'Campestre'),
(15, 'Campo Alegre'),
(16, 'Campo Grande'),
(17, 'Canapi'),
(18, 'Capela'),
(19, 'Carneiros'),
(20, 'Chã Preta'),
(21, 'Coité do Noia'),
(22, 'Colônia Leopoldina'),
(23, 'Coqueiro Seco'),
(24, 'Coruripe'),
(25, 'Craíbas'),
(26, 'Delmiro Gouveia'),
(27, 'Dois Riachos'),
(28, 'Estrela de Alagoas'),
(29, 'Feira Grande'),
(30, 'Feliz Deserto'),
(31, 'Flexeiras'),
(32, 'Girau do Ponciano'),
(33, 'Ibateguara'),
(34, 'Igaci'),
(35, 'Igreja Nova'),
(36, 'Inhapi'),
(37, 'Jacaré dos Homens'),
(38, 'Jacuipe'),
(39, 'Japaratinga'),
(40, 'Jaramataia'),
(41, 'Joaquim Gomes'),
(42, 'Jequiá da Praia '),
(43, 'Jundiá'),
(44, 'Junqueiro'),
(45, 'Lagoa da Canoa'),
(46, 'Limoeiro de Anadia'),
(47, 'Maceió'),
(48, 'Major Isidoro'),
(49, 'Mar Vermelho'),
(50, 'Maragogi'),
(51, 'Maravilha'),
(52, 'Marechal Deodoro'),
(53, 'Maribondo'),
(54, 'Mata Grande'),
(55, 'Matriz de Camaragibe'),
(56, 'Messias'),
(57, 'Minador do Negrão'),
(58, 'Monteirópolis'),
(59, 'Murici'),
(60, 'Novo Lino'),
(61, 'Olho d\'água Grande'),
(62, 'Olho d\'água das Flores'),
(63, 'Olho d\'água do Casado'),
(64, 'Olivenca'),
(65, 'Ouro Branco'),
(66, 'Palestina'),
(67, 'Palmeira dos Indios'),
(68, 'Pão de Acucar'),
(69, 'Pariconha'),
(70, 'Paripueira'),
(71, 'Passo de Camaragibe'),
(72, 'Paulo Jacinto'),
(73, 'Penedo'),
(74, 'Piacabuçu'),
(75, 'Pilar'),
(76, 'Pindoba'),
(77, 'Piranhas'),
(78, 'Poço das Trincheiras'),
(79, 'Porto Calvo'),
(80, 'Porto Real do Colégio'),
(81, 'Porto de Pedras'),
(82, 'Quebrangulo'),
(83, 'Rio Largo'),
(84, 'Roteiro'),
(85, 'Santa Luzia do Norte'),
(86, 'Santana do Ipanema'),
(87, 'Santana do Mundaú'),
(88, 'São Brás'),
(89, 'São José da Laje'),
(90, 'São José da Tapera'),
(91, 'São Luis do Quitunde'),
(92, 'São Miguel dos Campos'),
(93, 'São Miguel dos Milagres'),
(94, 'São Sebastião'),
(95, 'Satuba'),
(96, 'Senador Rui Palmeira'),
(97, 'Tanque d\'Arca'),
(98, 'Taquarana'),
(99, 'Teotonio Vilela'),
(100, 'Traipu'),
(101, 'União dos Palmares'),
(102, 'Viçosa');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_orgaos`
--

CREATE TABLE `tb_orgaos` (
  `ID` int(20) NOT NULL,
  `DS_ABREVIACAO` varchar(10) NOT NULL,
  `DS_NOME` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_orgaos`
--

INSERT INTO `tb_orgaos` (`ID`, `DS_ABREVIACAO`, `DS_NOME`) VALUES
(1, 'ADEAL', 'AGENCIA DE DEFESA E INSPECAO AGROPECUARIA ESTADO DE ALAGOAS'),
(2, 'DESENVOLVE', 'AGENCIA DE FOMENTO DE ALAGOAS'),
(3, 'AMGESP', 'AGENCIA DE MODERNIZACAO DA GESTAO DE PROCESSOS'),
(4, 'ARSAL', 'AGENCIA REGULADORA DE SERVICOS PUBLICOS DO ESTADO DE ALAGOAS'),
(5, 'ALPREV', 'AL PREVIDENCIA'),
(6, 'AL-PREV', 'ALAGOAS PREVIDENCIA'),
(7, 'CARHP', 'COMPANHIA ALAGOANA DE RECUROS HUMANOS E PATRIMONIAIS'),
(8, 'CGE', 'CONTROLADORIA GERAL DO ESTADO'),
(9, 'CBMAL', 'CORPO DE BOMBEIROS MILITAR DE ALAGOAS'),
(10, 'DPE', 'DEFENSORIA PÚBLICA GERAL DO ESTADO'),
(11, 'DER', 'DEPARTAMENTO DE ESTRADAS DE RODAGEM'),
(12, 'DETRAN', 'DEPARTAMENTO ESTADUAL DE TRANSITO DE ALAGOAS'),
(13, 'DITEAL', 'DIRETORIA DE TEATROS DO ESTADO DE ALAGOAS'),
(14, 'FAPEAL', 'FUNDACAO DE AMPARO A PESQUISA DE ALAGOAS'),
(15, 'GCG', 'GABINETE CIVIL DO GOVERNADOR'),
(16, 'GVG', 'GABINETE DO VICE GOVERNADOR'),
(17, 'GM', 'GABINETE MILITAR DO ESTADO DE ALAGOAS'),
(18, 'IPASEAL', 'INSTITUTO DE ASSISTENCIA A SAUDE DOS SERVIDORES DO ESTADO DE ALAGOAS'),
(19, 'IDERAL', 'INSTITUTO DE DESENVOLVIMENTO RURAL E ABASTECIMENTO DE ALAGOAS'),
(20, 'EMATER', 'INSTITUTO DE INOVACAO PARA O DESENV RURAL SUSTENTAVEL'),
(21, 'INMEQ', 'INSTITUTO DE METROLOGIA E QUALIDADE DE ALAGOAS'),
(22, 'ITEC', 'INSTITUTO DE TECNOLOGIA EM INFORMATICA E INF DE ALAGOAS'),
(23, 'ITERAL', 'INSTITUTO DE TERRAS E REFORMA AGRARIA DE ALAGOAS'),
(24, 'IMA', 'INSTITUTO DO MEIO AMBIENTE DO ESTADO DE ALAGOAS'),
(25, 'IZP', 'INSTITUTO ZUMBI DOS PALMARES'),
(26, 'JUCEAL', 'JUNTA COMERCIAL DO ESTADO DE ALAGOAS'),
(27, 'MPC', 'MINISTÉRIO PÚBLICO DE CONTAS'),
(28, 'POAL', 'PERICIA OFICIAL DO ESTADO DE ALAGOAS'),
(29, 'PCAL', 'POLICIA CIVIL DO ESTADO DE ALAGOAS'),
(30, 'PMAL', 'POLICIA MILITAR DE ALAGOAS'),
(31, 'PGE', 'PROCURADORIA GERAL DO ESTADO'),
(32, 'SEAGRE', 'SEC DE ESTADO DA AGRICULTURA PECUARIA PESCA E AQUICULTURA'),
(34, 'SEADES', 'SECRETARIA DE ESTADO DA ASSISTENCIA E DESENVOLVIMENTO SOCIAL'),
(35, 'SECTI', 'SECRETARIA DE ESTADO DA CIENCIA DA TECNOLOGIA E DA INOVACAO'),
(36, 'SECOM', 'SECRETARIA DE ESTADO DA COMUNICACAO'),
(37, 'SECULT', 'SECRETARIA DE ESTADO DA CULTURA'),
(38, 'SEDUC', 'SECRETARIA DE ESTADO DA EDUCACAO'),
(39, 'SEFAZ', 'SECRETARIA DE ESTADO DA FAZENDA'),
(40, 'SEINFRA', 'SECRETARIA DE ESTADO DA INFRA ESTRUTURA'),
(41, 'SEMUDH', 'SECRETARIA DE ESTADO DA MULHER CIDADANIA DIREITOS HUMANOS'),
(42, 'SEPAQ', 'SECRETARIA DE ESTADO DA PESCA E AQUICULTURA  DE ALAGOAS'),
(43, 'SESAU', 'SECRETARIA DE ESTADO DA SAUDE'),
(44, 'SSP', 'SECRETARIA DE ESTADO DA SEGURANCA PUBLICA'),
(45, 'SEAP', 'SECRETARIA DE ESTADO DE ARTICULAÇÃO POLÍTICA DE ALAGOAS'),
(46, 'SEPREV', 'SECRETARIA DE ESTADO DE PREVENCAO A VIOLENCIA'),
(47, 'SERIS', 'SECRETARIA DE ESTADO DE RESSOCIALIZACAO E INCLUSAO SOCIAL'),
(48, 'SETRAND', 'SECRETARIA DE ESTADO DE TRANSPORTE E DESENVOLVIMENTO URBANO'),
(49, 'SEDETUR', 'SECRETARIA DE ESTADO DO DESENVOLVIMENTO ECONOMICO E TURISMO'),
(50, 'SELAJ', 'SECRETARIA DE ESTADO DO ESPORTE LAZER E JUVENTUDE'),
(51, 'SEMARH', 'SECRETARIA DE ESTADO DO MEIO AMBIENTE E RECURSOS HIDRICOS'),
(53, 'SEPLAG', 'SECRETARIA DE ESTADO DO PLANEJAMENTO GESTAO E PATRIMONIO'),
(54, 'SETE', 'SECRETARIA DE ESTADO DO TRABALHO E EMPREGO'),
(55, 'SERVEAL', 'SERVICOS DE ENGENHARIA DE ALAGOAS S/A'),
(56, 'SGAP', 'SUPERINTENDÊNCIA GERAL DE ADMINISTRAÇÃO PENITENCIÁRIA'),
(57, 'UNEAL', 'UNIVERSIDADE ESTADUAL DE ALAGOAS'),
(58, 'UNCISAL', 'UNIVERSIDADE ESTADUAL DE CIENCIAS DA SAUDE DE ALAGOAS'),
(59, 'CEPAL', 'IMPRENSA OFICIAL GRACILIANO RAMOS'),
(60, 'MPE', 'MINISTÉRIO PÚBLICO ESTADUAL'),
(62, 'ALGAS', 'GAS DE ALAGOAS SA'),
(63, 'TCE', 'TRIBUNAL DE CONTAS DO ESTADO'),
(64, 'CASAL', 'COMPANHIA DE ABASTECIMENTO DE ALAGOAS'),
(65, 'UFAL', 'Universidade Federal de Alagoas'),
(66, 'UFAL', 'UNIVERSIDADE FEDERAL DE ALAGOAS'),
(67, 'CGU', 'CONTROLADORIA GERAL DA UNIÃO'),
(68, 'DPE', 'DEFENSORIA PÚBLICA'),
(69, 'TCE', 'TRIBUNAL DE CONTAS DO ESTADO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_palavras_chave_denuncia`
--

CREATE TABLE `tb_palavras_chave_denuncia` (
  `ID` int(20) NOT NULL,
  `ID_DENUNCIA` int(20) NOT NULL,
  `DS_PALAVRA_CHAVE` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_palavras_chave_denuncia`
--

INSERT INTO `tb_palavras_chave_denuncia` (`ID`, `ID_DENUNCIA`, `DS_PALAVRA_CHAVE`) VALUES
(3, 1, 'teste'),
(4, 1, 'automatico'),
(5, 2, 'judson'),
(6, 2, 'melo'),
(7, 2, 'bandeira');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_servidores`
--

CREATE TABLE `tb_servidores` (
  `ID` int(20) NOT NULL,
  `DS_NOME` varchar(50) NOT NULL,
  `DS_MATRICULA` varchar(10) NOT NULL,
  `DS_EMAIL` varchar(30) NOT NULL,
  `DS_TELEFONE` varchar(9) NOT NULL,
  `ID_ORGAO` int(20) NOT NULL,
  `ID_UNIDADE_APURACAO` int(20) DEFAULT NULL,
  `DS_FOTO` varchar(25) NOT NULL DEFAULT 'default.jpg',
  `DS_TIPO` enum('OUVIDORIA','UNIDADE DE APURAÇÃO','ADMINISTRADOR') NOT NULL,
  `DS_CPF` varchar(14) NOT NULL,
  `SENHA` varchar(32) NOT NULL DEFAULT 'e10adc3949ba59abbe56e057f20f883e',
  `STATUS` enum('ATIVO','INATIVO') DEFAULT 'ATIVO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_servidores`
--

INSERT INTO `tb_servidores` (`ID`, `DS_NOME`, `DS_MATRICULA`, `DS_EMAIL`, `DS_TELEFONE`, `ID_ORGAO`, `ID_UNIDADE_APURACAO`, `DS_FOTO`, `DS_TIPO`, `DS_CPF`, `SENHA`, `STATUS`) VALUES
(1, 'Judson Melo Bandeira', '00000-0', 'judson.bandeira@cge.al.gov.br', '3315-3630', 8, 1, 'perfil.jpg', 'UNIDADE DE APURAÇÃO', '062.200.904-46', 'e10adc3949ba59abbe56e057f20f883e', 'ATIVO'),
(4, 'Administrador', '00000-0', 'admin@cge.al.gov.br', '0000-0000', 8, NULL, 'default.jpg', 'ADMINISTRADOR', '000.000.000-00', 'e10adc3949ba59abbe56e057f20f883e', 'ATIVO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_trilhas`
--

CREATE TABLE `tb_trilhas` (
  `ID` int(20) NOT NULL,
  `ID_DENUNCIA` int(20) NOT NULL,
  `DS_NOME` varchar(50) NOT NULL,
  `BL_ALERTA` tinyint(4) NOT NULL,
  `ID_UNIDADE_APURACAO` int(20) NOT NULL,
  `NR_PERIODICIDADE` int(3) NOT NULL,
  `DS_TIPO_ALERTA` enum('GERAR ALERTA SEMPRE QUE A TRILHA FOR EXECUTADA','GERAR ALERTA SEMPRE QUE REGISTROS RESULTANTES MAIOR QUE REGISTROS') NOT NULL,
  `DS_EMAIL_ALERTA` varchar(50) NOT NULL,
  `BL_AGRUPADOR` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_trilhas`
--

INSERT INTO `tb_trilhas` (`ID`, `ID_DENUNCIA`, `DS_NOME`, `BL_ALERTA`, `ID_UNIDADE_APURACAO`, `NR_PERIODICIDADE`, `DS_TIPO_ALERTA`, `DS_EMAIL_ALERTA`, `BL_AGRUPADOR`) VALUES
(5, 1, 'asdasdasd', 1, 1, 4, 'GERAR ALERTA SEMPRE QUE REGISTROS RESULTANTES MAIOR QUE REGISTROS', 'asdsas@sdasdasd', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_unidades_apuracao`
--

CREATE TABLE `tb_unidades_apuracao` (
  `ID` int(20) NOT NULL,
  `ID_ORGAO` int(20) NOT NULL,
  `DS_ABREVIACAO` varchar(10) NOT NULL,
  `DS_NOME` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_unidades_apuracao`
--

INSERT INTO `tb_unidades_apuracao` (`ID`, `ID_ORGAO`, `DS_ABREVIACAO`, `DS_NOME`) VALUES
(1, 8, 'SUPAD', 'Superintendencia de Auditagem'),
(2, 44, 'COR', 'Corregedoria');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_anexos`
--
ALTER TABLE `tb_anexos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_DENUNCIA` (`ID_DENUNCIA`);

--
-- Indexes for table `tb_assuntos_denuncia`
--
ALTER TABLE `tb_assuntos_denuncia`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tb_denuncias`
--
ALTER TABLE `tb_denuncias`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_ASSUNTO` (`ID_ASSUNTO`),
  ADD KEY `ID_ORGAO_DENUNCIADO` (`ID_ORGAO_DENUNCIADO`),
  ADD KEY `ID_SERVIDOR` (`ID_SERVIDOR`),
  ADD KEY `ID_UNIDADE_APURACAO` (`ID_UNIDADE_APURACAO`),
  ADD KEY `ID_MUNICIPIO_DENUNCIADO` (`ID_MUNICIPIO_FATO`),
  ADD KEY `ID_RESPONSAVEL_TRIAGEM` (`ID_RESPONSAVEL_TRIAGEM`);

--
-- Indexes for table `tb_historico_denuncia`
--
ALTER TABLE `tb_historico_denuncia`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_DENUNCIA` (`ID_DENUNCIA`),
  ADD KEY `ID_SERVIDOR` (`ID_SERVIDOR`);

--
-- Indexes for table `tb_municipios`
--
ALTER TABLE `tb_municipios`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tb_orgaos`
--
ALTER TABLE `tb_orgaos`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tb_palavras_chave_denuncia`
--
ALTER TABLE `tb_palavras_chave_denuncia`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_DENUNCIA` (`ID_DENUNCIA`);

--
-- Indexes for table `tb_servidores`
--
ALTER TABLE `tb_servidores`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_ORGAO` (`ID_ORGAO`),
  ADD KEY `ID_UNIDADE_APURACAO` (`ID_UNIDADE_APURACAO`);

--
-- Indexes for table `tb_trilhas`
--
ALTER TABLE `tb_trilhas`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_DENUNCIA` (`ID_DENUNCIA`),
  ADD KEY `ID_UNIDADE_APURACAO` (`ID_UNIDADE_APURACAO`);

--
-- Indexes for table `tb_unidades_apuracao`
--
ALTER TABLE `tb_unidades_apuracao`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_ORGAO` (`ID_ORGAO`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_anexos`
--
ALTER TABLE `tb_anexos`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tb_assuntos_denuncia`
--
ALTER TABLE `tb_assuntos_denuncia`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `tb_denuncias`
--
ALTER TABLE `tb_denuncias`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_historico_denuncia`
--
ALTER TABLE `tb_historico_denuncia`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_municipios`
--
ALTER TABLE `tb_municipios`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `tb_orgaos`
--
ALTER TABLE `tb_orgaos`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `tb_palavras_chave_denuncia`
--
ALTER TABLE `tb_palavras_chave_denuncia`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_servidores`
--
ALTER TABLE `tb_servidores`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_trilhas`
--
ALTER TABLE `tb_trilhas`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_unidades_apuracao`
--
ALTER TABLE `tb_unidades_apuracao`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tb_anexos`
--
ALTER TABLE `tb_anexos`
  ADD CONSTRAINT `tb_anexos_ibfk_1` FOREIGN KEY (`ID_DENUNCIA`) REFERENCES `tb_denuncias` (`ID`);

--
-- Limitadores para a tabela `tb_denuncias`
--
ALTER TABLE `tb_denuncias`
  ADD CONSTRAINT `tb_denuncias_ibfk_1` FOREIGN KEY (`ID_ASSUNTO`) REFERENCES `tb_assuntos_denuncia` (`ID`),
  ADD CONSTRAINT `tb_denuncias_ibfk_2` FOREIGN KEY (`ID_ORGAO_DENUNCIADO`) REFERENCES `tb_orgaos` (`ID`),
  ADD CONSTRAINT `tb_denuncias_ibfk_3` FOREIGN KEY (`ID_SERVIDOR`) REFERENCES `tb_servidores` (`ID`),
  ADD CONSTRAINT `tb_denuncias_ibfk_4` FOREIGN KEY (`ID_UNIDADE_APURACAO`) REFERENCES `tb_unidades_apuracao` (`ID`),
  ADD CONSTRAINT `tb_denuncias_ibfk_5` FOREIGN KEY (`ID_MUNICIPIO_FATO`) REFERENCES `tb_municipios` (`ID`),
  ADD CONSTRAINT `tb_denuncias_ibfk_6` FOREIGN KEY (`ID_RESPONSAVEL_TRIAGEM`) REFERENCES `tb_servidores` (`ID`);

--
-- Limitadores para a tabela `tb_historico_denuncia`
--
ALTER TABLE `tb_historico_denuncia`
  ADD CONSTRAINT `tb_historico_denuncia_ibfk_1` FOREIGN KEY (`ID_DENUNCIA`) REFERENCES `tb_denuncias` (`ID`),
  ADD CONSTRAINT `tb_historico_denuncia_ibfk_2` FOREIGN KEY (`ID_SERVIDOR`) REFERENCES `tb_servidores` (`ID`);

--
-- Limitadores para a tabela `tb_palavras_chave_denuncia`
--
ALTER TABLE `tb_palavras_chave_denuncia`
  ADD CONSTRAINT `tb_palavras_chave_denuncia_ibfk_1` FOREIGN KEY (`ID_DENUNCIA`) REFERENCES `tb_denuncias` (`ID`);

--
-- Limitadores para a tabela `tb_servidores`
--
ALTER TABLE `tb_servidores`
  ADD CONSTRAINT `tb_servidores_ibfk_1` FOREIGN KEY (`ID_ORGAO`) REFERENCES `tb_orgaos` (`ID`),
  ADD CONSTRAINT `tb_servidores_ibfk_2` FOREIGN KEY (`ID_UNIDADE_APURACAO`) REFERENCES `tb_unidades_apuracao` (`ID`);

--
-- Limitadores para a tabela `tb_trilhas`
--
ALTER TABLE `tb_trilhas`
  ADD CONSTRAINT `tb_trilhas_ibfk_1` FOREIGN KEY (`ID_DENUNCIA`) REFERENCES `tb_denuncias` (`ID`),
  ADD CONSTRAINT `tb_trilhas_ibfk_2` FOREIGN KEY (`ID_UNIDADE_APURACAO`) REFERENCES `tb_unidades_apuracao` (`ID`);

--
-- Limitadores para a tabela `tb_unidades_apuracao`
--
ALTER TABLE `tb_unidades_apuracao`
  ADD CONSTRAINT `tb_unidades_apuracao_ibfk_1` FOREIGN KEY (`ID_ORGAO`) REFERENCES `tb_orgaos` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
