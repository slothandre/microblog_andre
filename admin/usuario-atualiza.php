<?php 
use Microblog\{Usuario, Utilitarios};
require_once "../inc/cabecalho-admin.php";

// Script de exibição
$usuario = new Usuario;
$usuario->setId($_GET['id']);
$dadosDoUsuario = $usuario->listarUm();

// Script de atualização
if(isset($_POST['atualizar'])){
	// Dados ja sanitizados
	$usuario->setNome($_POST['nome']);
	$usuario->setEmail($_POST['email']);
	$usuario->setTipo($_POST['tipo']);

	// Algoritmo geral para tratamento de senha
	if(empty($_POST['senha'])){
		// Se a senha estiver vazia é passado o valor da senha vinda do banco (Sem Alteração).
		$usuario->setSenha($dadosDoUsuario['senha']);
	} else {
		// Verificando se a senha digitada é igual a do banco.
		$usuario->setSenha(
			$usuario->verificaSenha($_POST['senha'], $dadosDoUsuario['senha'])
		);
	}

	// Chamando metodo para atualização
	$usuario->atualizar();

	// Redirecionamento
	header('location:usuarios.php');
}
?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">
		Atualizar dados do usuário
		</h2>
				
		<form class="mx-auto w-75" action="" method="post" id="form-atualizar" name="form-atualizar">

			<div class="mb-3">
				<label class="form-label" for="nome">Nome:</label>
				<input class="form-control" type="text" id="nome" name="nome" value="<?=$dadosDoUsuario['nome']?>" required>
			</div>

			<div class="mb-3">
				<label class="form-label" for="email">E-mail:</label>
				<input class="form-control" type="email" id="email" name="email" value="<?=$dadosDoUsuario['email']?>" required>
			</div>

			<div class="mb-3">
				<label class="form-label" for="senha">Senha:</label>

				<input class="form-control" type="password" id="senha" name="senha" placeholder="Preencha apenas se for alterar">
			</div>

			<div class="mb-3">
				<label class="form-label" for="tipo">Tipo:</label>

				<select class="form-select" name="tipo" id="tipo" required>
					<option value=""></option>
					<option <?php if($dadosDoUsuario['tipo'] === 'editor') echo ' selected '?> value="editor">Editor</option>
					<option <?php if($dadosDoUsuario['tipo'] === 'admin') echo ' selected '?> value="admin">Administrador</option>
				</select>
			</div>
			
			<button class="btn btn-primary" name="atualizar"><i class="bi bi-arrow-clockwise"></i> Atualizar</button>
		</form>
		
	</article>
</div>


<?php 
require_once "../inc/rodape-admin.php";
?>

