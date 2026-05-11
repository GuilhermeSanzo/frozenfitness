--
-- Database: `frozenfitness`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aprovacao`
--

CREATE TABLE `aprovacao` (
  `aprovacao_id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `artigo`
--

CREATE TABLE `artigo` (
  `artigo_id` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `conteudo` text NOT NULL,
  `caminho_imagem` varchar(100) NOT NULL,
  `artigo_data` date NOT NULL,
  `autor` varchar(100) NOT NULL,
  `categoria_artigo_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `banner`
--

CREATE TABLE `banner` (
  `banner_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `caminho_imagem` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `caminhao`
--

CREATE TABLE `caminhao` (
  `caminhao_id` int(11) NOT NULL,
  `placa` varchar(8) NOT NULL,
  `latitude` double(10,8) DEFAULT NULL,
  `longitude` double(10,8) DEFAULT NULL,
  `transportadora_id` int(11) NOT NULL,
  `motorista_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria_artigo`
--

CREATE TABLE `categoria_artigo` (
  `categoria_artigo_id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria_fale_conosco`
--

CREATE TABLE `categoria_fale_conosco` (
  `categoria_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidade`
--

CREATE TABLE `cidade` (
  `cidade_id` int(11) NOT NULL,
  `nome` varchar(120) DEFAULT NULL,
  `estado_id` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `cliente_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(60) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `data_nascimento` date NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `peso` double(10,2) DEFAULT NULL,
  `altura` double(10,2) DEFAULT NULL,
  `tipo_dieta_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `dieta`
--

CREATE TABLE `dieta` (
  `dieta_id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `tipo_dieta_id` int(11) DEFAULT NULL,
  `tipo_usuario_id` int(11) DEFAULT NULL,
  `descricao` text,
  `aprovacao_id` int(11) DEFAULT '1',
  `horario_aprovacao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `endereco_id` int(11) NOT NULL,
  `logradouro` varchar(25) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `numero` int(6) DEFAULT NULL,
  `cep` varchar(15) DEFAULT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `tipo_endereco_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `estado`
--

CREATE TABLE `estado` (
  `estado_id` int(11) NOT NULL,
  `nome` varchar(75) DEFAULT NULL,
  `uf` varchar(5) DEFAULT NULL,
  `pais_id` int(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `faleconosco`
--

CREATE TABLE `faleconosco` (
  `fale_conosco_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `mensagem` text NOT NULL,
  `categoria` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE `fornecedor` (
  `fornecedor_id` int(11) NOT NULL,
  `razao_social` varchar(100) NOT NULL,
  `nome_fantasia` varchar(100) NOT NULL,
  `cnpj` varchar(20) NOT NULL,
  `endereco_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `horario_do_dia`
--

CREATE TABLE `horario_do_dia` (
  `horario_do_dia_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ingrediente`
--

CREATE TABLE `ingrediente` (
  `ingrediente_id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `unidade_id` int(11) DEFAULT NULL,
  `kcal_por_100g` int(11) DEFAULT NULL,
  `tipo_ingrediente_id` int(11) DEFAULT NULL,
  `caminho_imagem` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `motorista`
--

CREATE TABLE `motorista` (
  `motorista_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `data_nascimento` date NOT NULL,
  `cnh` varchar(15) NOT NULL,
  `celular` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `necessidade`
--

CREATE TABLE `necessidade` (
  `necessidade_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `operacao`
--

CREATE TABLE `operacao` (
  `operacao_id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pais`
--

CREATE TABLE `pais` (
  `pais_id` int(11) NOT NULL,
  `nome` varchar(60) DEFAULT NULL,
  `sigla` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `parceiro`
--

CREATE TABLE `parceiro` (
  `parceiro_id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `caminho_imagem` varchar(100) DEFAULT NULL,
  `telefone` varchar(30) DEFAULT NULL,
  `endereco_id` int(11) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE `pedido` (
  `pedido_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `caminhao_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `prato`
--

CREATE TABLE `prato` (
  `prato_id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `validade` varchar(100) DEFAULT NULL,
  `valor_unitario` double(10,2) DEFAULT NULL,
  `caminho_imagem` varchar(45) DEFAULT NULL,
  `tipo_usuario_id` int(11) DEFAULT NULL,
  `tempo_preparo` double(10,2) DEFAULT NULL,
  `descricao` text,
  `tipo_dieta_id` int(11) DEFAULT NULL,
  `qtde_visualizacoes` int(11) DEFAULT NULL,
  `aprovacao_id` int(11) DEFAULT '1',
  `horario_aprovacao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `promocao`
--

CREATE TABLE `promocao` (
  `promocao_id` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `porcentagem_desc` double(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `rel_cliente_endereco`
--

CREATE TABLE `rel_cliente_endereco` (
  `rel_cliente_endereco_id` int(11) NOT NULL,
  `endereco_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `rel_dieta_pedido`
--

CREATE TABLE `rel_dieta_pedido` (
  `rel_dieta_pedido_id` int(11) NOT NULL,
  `dieta_id` int(11) DEFAULT NULL,
  `qtde` int(11) DEFAULT NULL,
  `pedido_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `rel_dieta_prato`
--

CREATE TABLE `rel_dieta_prato` (
  `rel_dieta_prato_id` int(11) NOT NULL,
  `dia` int(11) DEFAULT NULL,
  `horario_do_dia_id` int(11) DEFAULT NULL,
  `prato_id` int(11) DEFAULT NULL,
  `dieta_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `rel_ingrediente_fornecedor`
--

CREATE TABLE `rel_ingrediente_fornecedor` (
  `rel_ingrediente_fornecedor_id` int(11) NOT NULL,
  `fornecedor_id` int(11) NOT NULL,
  `ingrediente_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `rel_prato_ingrediente`
--

CREATE TABLE `rel_prato_ingrediente` (
  `rel_prato_ingrediente_id` int(11) NOT NULL,
  `qtd` int(11) NOT NULL,
  `ingrediente_id` int(11) NOT NULL,
  `prato_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `rel_prato_pedido`
--

CREATE TABLE `rel_prato_pedido` (
  `rel_prato_pedido_id` int(11) NOT NULL,
  `prato_id` int(11) DEFAULT NULL,
  `qtde` int(11) DEFAULT NULL,
  `pedido_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `rel_prato_promocao`
--

CREATE TABLE `rel_prato_promocao` (
  `rel_prato_promocao_id` int(11) NOT NULL,
  `prato_id` int(11) DEFAULT NULL,
  `promocao_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `rel_status_pedido`
--

CREATE TABLE `rel_status_pedido` (
  `rel_status_pedido_id` int(11) NOT NULL,
  `rel_status_pedido_data` date NOT NULL,
  `status_id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sexo`
--

CREATE TABLE `sexo` (
  `sexo_id` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `status`
--

CREATE TABLE `status` (
  `status_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_cadastro`
--

CREATE TABLE `tipo_cadastro` (
  `tipo_cadastro_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_dieta`
--

CREATE TABLE `tipo_dieta` (
  `tipo_dieta_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `caminho_imagem` varchar(100) DEFAULT NULL,
  `cor` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_endereco`
--

CREATE TABLE `tipo_endereco` (
  `tipo_endereco_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_ingrediente`
--

CREATE TABLE `tipo_ingrediente` (
  `tipo_ingrediente_id` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `tipo_usuario_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `transportadora`
--

CREATE TABLE `transportadora` (
  `transportadora_id` int(11) NOT NULL,
  `cnpj` varchar(20) NOT NULL,
  `razao_social` varchar(100) NOT NULL,
  `nome_fantasia` varchar(100) NOT NULL,
  `telefone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `unidade`
--

CREATE TABLE `unidade` (
  `unidade_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `abreviatura` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `sobre_nome` varchar(100) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `senha` varchar(100) DEFAULT NULL,
  `sexo` int(1) DEFAULT NULL,
  `data_nascimento` date DEFAULT '0000-00-00',
  `cpf` varchar(20) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `peso` double(10,2) DEFAULT NULL,
  `altura` double(10,2) DEFAULT NULL,
  `tipo_dieta_id` int(11) DEFAULT NULL,
  `tipo_usuario_id` int(11) DEFAULT NULL,
  `caminho_imagem` varchar(100) DEFAULT NULL,
  `endereco_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aprovacao`
--
ALTER TABLE `aprovacao`
  ADD PRIMARY KEY (`aprovacao_id`);

--
-- Indexes for table `artigo`
--
ALTER TABLE `artigo`
  ADD PRIMARY KEY (`artigo_id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`banner_id`);

--
-- Indexes for table `caminhao`
--
ALTER TABLE `caminhao`
  ADD PRIMARY KEY (`caminhao_id`);

--
-- Indexes for table `categoria_artigo`
--
ALTER TABLE `categoria_artigo`
  ADD PRIMARY KEY (`categoria_artigo_id`);

--
-- Indexes for table `categoria_fale_conosco`
--
ALTER TABLE `categoria_fale_conosco`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Indexes for table `cidade`
--
ALTER TABLE `cidade`
  ADD PRIMARY KEY (`cidade_id`),
  ADD KEY `fk_Cidade_estado` (`estado_id`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cliente_id`);

--
-- Indexes for table `dieta`
--
ALTER TABLE `dieta`
  ADD PRIMARY KEY (`dieta_id`);

--
-- Indexes for table `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`endereco_id`);

--
-- Indexes for table `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`estado_id`),
  ADD KEY `fk_Estado_pais` (`pais_id`);

--
-- Indexes for table `faleconosco`
--
ALTER TABLE `faleconosco`
  ADD PRIMARY KEY (`fale_conosco_id`);

--
-- Indexes for table `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`fornecedor_id`);

--
-- Indexes for table `horario_do_dia`
--
ALTER TABLE `horario_do_dia`
  ADD PRIMARY KEY (`horario_do_dia_id`);

--
-- Indexes for table `ingrediente`
--
ALTER TABLE `ingrediente`
  ADD PRIMARY KEY (`ingrediente_id`);

--
-- Indexes for table `motorista`
--
ALTER TABLE `motorista`
  ADD PRIMARY KEY (`motorista_id`);

--
-- Indexes for table `necessidade`
--
ALTER TABLE `necessidade`
  ADD PRIMARY KEY (`necessidade_id`);

--
-- Indexes for table `operacao`
--
ALTER TABLE `operacao`
  ADD PRIMARY KEY (`operacao_id`);

--
-- Indexes for table `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`pais_id`);

--
-- Indexes for table `parceiro`
--
ALTER TABLE `parceiro`
  ADD PRIMARY KEY (`parceiro_id`);

--
-- Indexes for table `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`pedido_id`);

--
-- Indexes for table `prato`
--
ALTER TABLE `prato`
  ADD PRIMARY KEY (`prato_id`);

--
-- Indexes for table `promocao`
--
ALTER TABLE `promocao`
  ADD PRIMARY KEY (`promocao_id`);

--
-- Indexes for table `rel_cliente_endereco`
--
ALTER TABLE `rel_cliente_endereco`
  ADD PRIMARY KEY (`rel_cliente_endereco_id`);

--
-- Indexes for table `rel_dieta_pedido`
--
ALTER TABLE `rel_dieta_pedido`
  ADD PRIMARY KEY (`rel_dieta_pedido_id`);

--
-- Indexes for table `rel_dieta_prato`
--
ALTER TABLE `rel_dieta_prato`
  ADD PRIMARY KEY (`rel_dieta_prato_id`);

--
-- Indexes for table `rel_ingrediente_fornecedor`
--
ALTER TABLE `rel_ingrediente_fornecedor`
  ADD PRIMARY KEY (`rel_ingrediente_fornecedor_id`);

--
-- Indexes for table `rel_prato_ingrediente`
--
ALTER TABLE `rel_prato_ingrediente`
  ADD PRIMARY KEY (`rel_prato_ingrediente_id`);

--
-- Indexes for table `rel_prato_pedido`
--
ALTER TABLE `rel_prato_pedido`
  ADD PRIMARY KEY (`rel_prato_pedido_id`);

--
-- Indexes for table `rel_prato_promocao`
--
ALTER TABLE `rel_prato_promocao`
  ADD PRIMARY KEY (`rel_prato_promocao_id`);

--
-- Indexes for table `rel_status_pedido`
--
ALTER TABLE `rel_status_pedido`
  ADD PRIMARY KEY (`rel_status_pedido_id`);

--
-- Indexes for table `sexo`
--
ALTER TABLE `sexo`
  ADD PRIMARY KEY (`sexo_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `tipo_cadastro`
--
ALTER TABLE `tipo_cadastro`
  ADD PRIMARY KEY (`tipo_cadastro_id`);

--
-- Indexes for table `tipo_dieta`
--
ALTER TABLE `tipo_dieta`
  ADD PRIMARY KEY (`tipo_dieta_id`);

--
-- Indexes for table `tipo_endereco`
--
ALTER TABLE `tipo_endereco`
  ADD PRIMARY KEY (`tipo_endereco_id`);

--
-- Indexes for table `tipo_ingrediente`
--
ALTER TABLE `tipo_ingrediente`
  ADD PRIMARY KEY (`tipo_ingrediente_id`);

--
-- Indexes for table `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`tipo_usuario_id`);

--
-- Indexes for table `transportadora`
--
ALTER TABLE `transportadora`
  ADD PRIMARY KEY (`transportadora_id`);

--
-- Indexes for table `unidade`
--
ALTER TABLE `unidade`
  ADD PRIMARY KEY (`unidade_id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artigo`
--
ALTER TABLE `artigo`
  MODIFY `artigo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `banner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `caminhao`
--
ALTER TABLE `caminhao`
  MODIFY `caminhao_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `categoria_fale_conosco`
--
ALTER TABLE `categoria_fale_conosco`
  MODIFY `categoria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `cidade`
--
ALTER TABLE `cidade`
  MODIFY `cidade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5565;
--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cliente_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dieta`
--
ALTER TABLE `dieta`
  MODIFY `dieta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `endereco`
--
ALTER TABLE `endereco`
  MODIFY `endereco_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `faleconosco`
--
ALTER TABLE `faleconosco`
  MODIFY `fale_conosco_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `fornecedor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `horario_do_dia`
--
ALTER TABLE `horario_do_dia`
  MODIFY `horario_do_dia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ingrediente`
--
ALTER TABLE `ingrediente`
  MODIFY `ingrediente_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `motorista`
--
ALTER TABLE `motorista`
  MODIFY `motorista_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `necessidade`
--
ALTER TABLE `necessidade`
  MODIFY `necessidade_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `operacao`
--
ALTER TABLE `operacao`
  MODIFY `operacao_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `parceiro`
--
ALTER TABLE `parceiro`
  MODIFY `parceiro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `pedido`
--
ALTER TABLE `pedido`
  MODIFY `pedido_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `prato`
--
ALTER TABLE `prato`
  MODIFY `prato_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `promocao`
--
ALTER TABLE `promocao`
  MODIFY `promocao_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `rel_cliente_endereco`
--
ALTER TABLE `rel_cliente_endereco`
  MODIFY `rel_cliente_endereco_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rel_dieta_pedido`
--
ALTER TABLE `rel_dieta_pedido`
  MODIFY `rel_dieta_pedido_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `rel_dieta_prato`
--
ALTER TABLE `rel_dieta_prato`
  MODIFY `rel_dieta_prato_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `rel_ingrediente_fornecedor`
--
ALTER TABLE `rel_ingrediente_fornecedor`
  MODIFY `rel_ingrediente_fornecedor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `rel_prato_ingrediente`
--
ALTER TABLE `rel_prato_ingrediente`
  MODIFY `rel_prato_ingrediente_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `rel_prato_pedido`
--
ALTER TABLE `rel_prato_pedido`
  MODIFY `rel_prato_pedido_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `rel_prato_promocao`
--
ALTER TABLE `rel_prato_promocao`
  MODIFY `rel_prato_promocao_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `rel_status_pedido`
--
ALTER TABLE `rel_status_pedido`
  MODIFY `rel_status_pedido_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tipo_cadastro`
--
ALTER TABLE `tipo_cadastro`
  MODIFY `tipo_cadastro_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tipo_dieta`
--
ALTER TABLE `tipo_dieta`
  MODIFY `tipo_dieta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tipo_endereco`
--
ALTER TABLE `tipo_endereco`
  MODIFY `tipo_endereco_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tipo_ingrediente`
--
ALTER TABLE `tipo_ingrediente`
  MODIFY `tipo_ingrediente_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `tipo_usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `transportadora`
--
ALTER TABLE `transportadora`
  MODIFY `transportadora_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `unidade`
--
ALTER TABLE `unidade`
  MODIFY `unidade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
