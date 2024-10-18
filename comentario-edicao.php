<?php

require_once 'header-noticia.php';
require_once 'classes/Comentario.php';

$comentario_id = $_GET['id'];
if (!isset($comentario_id)) {
?><script type="text/javascript">
		window.location.href = "index.php";
	</script><?php
						exit;
					}

					$c = new Comentario();

					$edicao = null;
					if (isset($_POST['nome']) && isset($_POST['comentario'])) {

						$nome         = addslashes($_POST['nome']);
						$comentario       = addslashes($_POST['comentario']);
						$edicao      		= $c->editarComentario($nome, $comentario, $comentario_id);
					}

					$comentario = $c->retornarComentario($comentario_id);
						?>

<div class="container">
	<div class="form--editar">
		<h1>Edição de Comentario</h1>
		<form method="POST" name="editar">
			<input type="text" name="nome" placeholder="Nome do Usuario"
				class="input--nome" value="<?php echo $comentario['nome'] ?>" />
			<textarea name="comentario" placeholder="Comentario"
				class="textarea--comentario"><?php echo $comentario['comentario'] ?></textarea>
			<div class="botoes">
				<a type="submit" class="btn btn-danger mr-10"
					href="comentario-exclusao.php?id=<?php echo $comentario['id']; ?>">Excluir</a>
				<a type="submit" class="btn btn-default" href="index.php">Voltar</a>
				<a class="btn btn-success ml-10" href='javascript:editar.submit()' ">Atualizar</a>
                </div>
            </form>
            <?php if ($edicao): ?>
            <div class=" container alerta sucesso">
					Comentario atualizado com sucesso!
			</div>
		<?php endif; ?>
		<?php if (!is_null($edicao) && !$edicao): ?>
			<div class="container alerta erro">
				Preencha todos os campos!
			</div>
		<?php endif; ?>
	</div>
</div>

<?php require_once  'pages/includes/footer.php'; ?>