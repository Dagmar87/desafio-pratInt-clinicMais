SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Estrutura da tabela noticias

CREATE TABLE `noticias` (
  `id` int(11) NOT NULL,  
  `titulo` varchar(100) NOT NULL,
  `conteudo` text NOT NULL,
	`comentario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Índices para tabela noticias

ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`)
	ADD KEY `fk_comentario_noticia` (`comentario_id`);
  
-- AUTO_INCREMENT de tabela noticias

ALTER TABLE `noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

-- Limitadores para a tabela noticias

ALTER TABLE `noticias`
  ADD CONSTRAINT `fk_comentario_noticia` FOREIGN KEY (`comentario_id`) REFERENCES `comentarios` (`id`);
COMMIT;

-- Estrutura da tabela comentarios

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,  
  `nome` varchar(100) NOT NULL,
  `comentario` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Índices para tabela comentarios

ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`)

-- AUTO_INCREMENT de tabela comentarios

ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;