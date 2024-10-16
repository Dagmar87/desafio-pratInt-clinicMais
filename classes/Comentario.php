<?php

class Comentario
{
	public function retornarComentarios($filtrar, $offset, $limit)
	{
		try {
			global $pdo;

			$sql = "SELECT 
			comentarios.id as id,
			comentarios.nome as nome,
			comentarios.comentario as comentario
			FROM comentarios";

			if (!empty($filtrar)) {
				$sql .= "WHERE nome LIKE ? ORDER BY id DESC LIMIT $offset, $limit";
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

	public function adicionarComentario($nome, $comentario)
	{
		try {
			if (!empty($nome) && !empty($comentario)) {
				global $pdo;

				$sql = $pdo->prepare("INSERT INTO comentarios SET nome = :nome, comentario = : comentario");
				$sql->bindValue(":nome", $nome);
				$sql->bindValue(":comentario", $comentario);
				$sql->execute();

				return true;
			} else {
				return false;
			}
		} catch (PDOException $e) {
			echo "Erro ao cadastrar comentario: " . $e->getMessage();
		}
	}

	public function retornarComentario($id)
	{
		try {
			global $pdo;

			$sql = $pdo->prepare("SELECT * FROM comentarios WHERE id = :id");
			$sql->bindValue(":id", $id);
			$sql->execute();

			return $sql->fetch();
		} catch (PDOException $e) {
			echo "Erro ao buscar comentario: " . $e->getMessage();
			exit;
		}
	}

	public function editarComentario($nome, $comentario, $id)
	{
		try {
			if (!empty($nome) && !empty($comentario) && !empty($id)) {
				global $pdo;

				$sql = $pdo->prepare("UPDATE comentarios SET nome = :nome, comentario = : comentario WHERE id = :id");
				$sql->bindValue(":nome", $nome);
				$sql->bindValue(":comentario", $comentario);
				$sql->bindValue(":id", $id);
				$sql->execute();

				return true;
			} else {
				return false;
			}
		} catch (PDOException $e) {
			echo "Erro ao cadastrar comentario: " . $e->getMessage();
			exit;
		}
	}

	public function excluirComentario($id)
	{
		try {
			global $pdo;

			$sql = $pdo->prepare("DELETE FROM comentarios WHERE id = :id");
			$sql->bindValue(":id", $id);
			$sql->execute();

			return true;
		} catch (PDOException $e) {
			echo "Erro ao deletar comentario: " . $e->getMessage();
			exit;
		}
	}

	public function totalComentarios($filtrar)
	{
		global $pdo;

		$sql = "SELECT count(*) as total FROM comentarios";

		if (!empty($filtrar)) {
			$sql .= " WHERE nome LIKE ?";
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
