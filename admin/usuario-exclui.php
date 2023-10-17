<?php
// Require e use do namespace
use Microblog\{Usuario};
require_once '../vendor/autoload.php';

// Script de exclusão
$usuario = new Usuario;
$usuario->setId($_GET['id']);
$usuario->deletar();

// Redirecionamento
header('location:usuarios.php');