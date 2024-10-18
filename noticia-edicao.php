<?php

require_once 'header-noticia.php';
require_once 'classes/Noticia.php';

$noticia_id = $_GET['id'];
if (!isset($noticia_id)) {
?><script type="text/javascript">
		window.location.href = "blog-noticia.php";
	</script><?php
						exit;
					}

					$n = new Noticia();

					$edicao = null;
					if (isset($_POST['titulo']) && isset($_POST['conteudo'])) {

						$titulo         = addslashes($_POST['titulo']);
						$conteudo       = addslashes($_POST['conteudo']);
						$edicao      		= $n->editarNoticia($titulo, $conteudo, $noticia_id);
					}

					$noticia = $n->retornarNoticia($noticia_id);
						?>

<div class="container">
	<div class="form--editar">
		<h1>Edição de Notícias</h1>
		<form method="POST" name="editar">
			<input type="text" name="titulo" placeholder="Titulo da noticia"
				class="input--titulo" value="<?php echo $noticia['titulo'] ?>" />
			<textarea name="conteudo" placeholder="Conteúdo da notícia"
				class="textarea--conteudo"><?php echo $noticia['conteudo'] ?></textarea>
			<div class="botoes">
				<a type="submit" class="btn btn-danger mr-10"
					href="noticia-exclusao.php?id=<?php echo $noticia['id']; ?>">Excluir</a>
				<a type="submit" class="btn btn-default" href="blog-noticia.php">Voltar</a>
				<a class="btn btn-success ml-10" href='javascript:editar.submit()' ">Atualizar</a>
                </div>
            </form>
            <?php if ($edicao): ?>
            <div class=" container alerta sucesso">
					Noticia atualizada com sucesso!
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