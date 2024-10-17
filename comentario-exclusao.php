<?php

require_once 'config.php';
require_once 'classes/Comentario.php';

$c = new Comentario();

if(isset($_GET['id']) && !empty($_GET['id'])) {
	$c->excluirComentario($_GET['id']);
}

header("Location: index.php");