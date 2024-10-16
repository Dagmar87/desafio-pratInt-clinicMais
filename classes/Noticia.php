<?php

class Noticia
{
	public function retornarNoticias($filtrar, $offset, $limit)
	{
		try {
			global $pdo;

			$sql = "SELECT 
			noticias.id as id,
			noticias.titulo as titulo,
			noticias.conteudo as conteudo,
			comentarios.nome as nome_comentario,
			comentarios.comentario as texto_comentario
			FROM noticias
			INNER JOIN comentarios 
      ON comentarios.id = noticias.comentario_id";

			if (!empty($filtrar)) {
				$sql .= "WHERE titulo LIKE ? ORDER BY id DESC LIMIT $offset, $limit";
				$sql = $pdo->prepare($sql);
				$sql->bindValue(1, "%$filtrar%");
				$sql->execute();
			} else {
				$sql = $pdo->query($sql . " ORDER BY id DESC LIMIT $offset, $limit");
			}

			return $sql->fetchAll();
		} catch (PDOException $e) {
			echo "Erro: " . $e->getMessage();
			exit;
		}
	}

	public function adicionarNoticia($titulo, $conteudo)
	{
		try {
			if (!empty($titulo) && !empty($conteudo)) {
				global $pdo;

				$sql = $pdo->prepare("INSERT INTO noticias SET titulo = :titulo, conteudo = : conteudo");
				$sql->bindValue(":titulo", $titulo);
				$sql->bindValue(":conteudo", $conteudo);
				$sql->execute();

				return true;
			} else {
				return false;
			}
		} catch (PDOException $e) {
			echo "Erro ao cadastrar noticia: " . $e->getMessage();
		}
	}

	public function retornarNoticia($id)
	{
		try {
			global $pdo;

			$sql = $pdo->prepare("SELECT * FROM noticias WHERE id = :id");
			$sql->bindValue(":id", $id);
			$sql->execute();

			return $sql->fetch();
		} catch (PDOException $e) {
			echo "Erro ao buscar notícia: " . $e->getMessage();
			exit;
		}
	}

	public function editarNoticia($titulo, $conteudo, $id)
	{
		try {
			if (!empty($titulo) && !empty($conteudo) && !empty($id)) {
				global $pdo;

				$sql = $pdo->prepare("UPDATE noticias SET titulo = :titulo, conteudo = : conteudo WHERE id = :id");
				$sql->bindValue(":titulo", $titulo);
				$sql->bindValue(":conteudo", $conteudo);
				$sql->bindValue(":id", $id);
				$sql->execute();

				return true;
			} else {
				return false;
			}
		} catch (PDOException $e) {
			echo "Erro ao cadastrar noticia: " . $e->getMessage();
			exit;
		}
	}

	public function excluirNoticia($id)
	{
		try {
			global $pdo;

			$sql = $pdo->prepare("DELETE FROM noticias WHERE id = :id");
			$sql->bindValue(":id", $id);
			$sql->execute();

			return true;
		} catch (PDOException $e) {
			echo "Erro ao deletar noticia: " . $e->getMessage();
			exit;
		}
	}

	public function totalNoticias($filtrar)
	{
		global $pdo;

		$sql = "SELECT count(*) as total FROM noticias";

		if (!empty($filtrar)) {
			$sql .= " WHERE titulo LIKE ?";
			$sql = $pdo->prepare($sql);
			$sql->bindValue(1, "%$filtrar%");
			$sql->execute();
		} else {
			$sql = $pdo->query($sql);
		}

		$sql = $sql->fetch();

		return $sql['total'];
	}
}
