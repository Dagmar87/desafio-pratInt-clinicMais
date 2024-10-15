<?php

global $pdo;

try {
	$pdo = new PDO("mysql:dbname=clinic_noticias;host=localhost", "root", "");
} catch (PDOException $e) {
	echo "Erro na tentativa de conexão com o banco de dados: " . $e->getMessage();
	exit;
}
