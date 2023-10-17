<?php
// Require e use do namespace
use Microblog\{Usuario, ControleDeAcesso};
require_once '../vendor/autoload.php';

$sessao = new ControleDeAcesso;
$sessao->verificaAcesso();

// Script de exclusão
$usuario = new Usuario;
$usuario->setId($_GET['id']);
$usuario->deletar();

// Redirecionamento
header('location:usuarios.php');