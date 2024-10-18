<?php

require_once 'header-noticia.php';
require_once 'classes/Comentario.php';

$c = new Comentario();

$adicao = null;
if (isset($_POST['nome']) && isset($_POST['comentario'])) {

	$nome         = addslashes($_POST['nome']);
	$comentario       = addslashes($_POST['comentario']);
	$adicao      = $c->adicionarComentario($nome, $comentario);
}

?>

<div class="container">
	<div class="form--cadastrar">
		<h1>Cadastro de Comentario</h1>
		<form method="POST" name="cadastrar">
			<input type="text" name="nome" placeholder="Nome do Usuario" class="input--nome" />
			<textarea name="comentario" placeholder="Comentario" class="textarea--comentario"></textarea>
			<div class="botoes">
				<a type="submit" class="btn btn-default" href="index.php">Voltar</a>
				<a class="btn btn-success ml-10" href='javascript:cadastrar.submit()'>Cadastrar</a>
			</div>
		</form>
		<?php if ($adicao): ?>
			<div class="container alerta sucesso">
				Comentario cadastrado com sucesso!
			</div>
		<?php endif; ?>
		<?php if (!is_null($adicao) && !$adicao): ?>
			<div class="container alerta erro">
				Preencha todos os campos!
			</div>
		<?php endif; ?>
	</div>
</div>

<?php require_once  'pages/includes/footer.php'; ?>