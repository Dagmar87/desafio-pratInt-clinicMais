<?php

session_start();

require_once 'pages/includes/header.php';
require_once 'classes/Noticia.php';

$n = new Noticia();

$cookieFiltrar  = $_COOKIE['filtrar'] ?? null;
$filtrar 		= $_GET['filtrar'] ?? null;
$filtrar 		=   $cookieFiltrar  ?? $filtrar;

$limit = 6;
$paginaAtual = !empty($_GET['p']) ? intval($_GET['p']) : 1;
$offset = ($paginaAtual * $limit) - $limit;
$qtdNoticias = $n->totalNoticias($filtrar);
$qtdPaginas = ceil($qtdNoticias / $limit);

$noticias = $n->retornarNoticias($filtrar, $offset, $limit);

?>

<div class="container">
	<?php foreach ($noticias as $noticia) : ?>
		<div class="noticias--box">
			<h1><?php echo $noticia['titulo']; ?></h1>
			<p><?php echo $noticia['conteudo']; ?></p>
			<a type="submit" class="btn btn--noticias"
				href="noticia-edicao.php?id=<?php echo $noticia['id']; ?>">
				Acessar
			</a>
		</div>
	<?php endforeach; ?>
</div>
<div class="container">
	<?php if ($qtdPaginas > 1): ?>
		<div class="conteiner_paginacao">
			<a class="paginacao simbolo" href="blog-noticia.php?p=1">
				<< /a>
					<?php for ($q = 1; $q <= $qtdPaginas; $q++): ?>
						<?php if ($paginaAtual == $q): ?>
							<a class="paginacao active" href="blog-noticia.php?p=<?php echo $q; ?>"><?php echo $q; ?></a>
						<?php else: ?>
							<a class="paginacao" href="blog-noticia.php?p=<?php echo $q; ?>"><?php echo $q; ?></a>
						<?php endif; ?>
					<?php endfor ?>
					<a class="paginacao simbolo" href="blog-noticia.php?p=<?php echo $qtdPaginas; ?>">></a>
		</div>
	<?php endif ?>
</div>

<?php require_once  'pages/includes/footer.php'; ?>