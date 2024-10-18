<?php

require_once 'config.php';

if (!empty($_GET['filtrar']) && !stripos($_SERVER['REQUEST_URI'], 'blog-noticia')) {
	setcookie('filtrar', $_GET['filtrar'], time() + 2);
	header('Location: blog-noticia.php');
	exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>Albert Teste</title>
	<link rel="stylesheet" href="assets/css/style.css" />
	<script src='assets/script.js'></script>
</head>

<body>
	<header>
		<div class="header container">
			<div class="menu-logo">
				<a href="blog-noticia.php">Blog de Noticias</a>
			</div>
			<nav class="menu-nav">
				<ul>
					<li><a href="blog-noticia.php">Principal</a></li>
					<li><a href="noticia-cadastro.php">Cadastrar Notícia</a></li>					
				</ul>
				<form method="GET" class="menu-nav--buscar">
					<input type="text" name="filtrar" id="busca" />
					<input type="submit" id="lupa" value="Buscar" />
				</form>
			</nav>
		</div>
	</header>
	<section>