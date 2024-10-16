<?php

require_once 'pages/includes/header.php';
require_once 'classes/Noticia.php';

$n = new Noticia();

if (isset($_POST['titulo']) && isset($_POST['conteudo'])) {

	$titulo         = addslashes($_POST['titulo']);
	$conteudo       = addslashes($_POST['conteudo']);
	$categoria      = $n->adicionarNoticia($titulo, $conteudo);
}

?>

<div class="container">
	<div class="form--cadastrar">
		<h1>Cadastro de Notícias</h1>
		<form method="POST" name="cadastrar">
			<input type="text" name="titulo" placeholder="Titulo da noticia" class="input--titulo" />
			<textarea name="conteudo" placeholder="Conteúdo da notícia" class="textarea--conteudo"></textarea>
			<div class="botoes">
				<a type="submit" class="btn btn-default" href="index.php">Voltar</a>
				<a class="btn btn-success ml-10" href='javascript:cadastrar.submit()'>Cadastrar</a>
			</div>
		</form>
	</div>
</div>

<?php require_once  'pages/includes/footer.php'; ?>