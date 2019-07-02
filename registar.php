<?php
  require "header.php";
?>

<style>
  body
  {
    background: url(./posters/fundos/fundoentrar.jpg) rgb(88, 11, 28, 0.7);
  }
</style>

	<main>

		<form class="Formularios" action="./incluidos/registar.inc.php" method="post">

			<h1> Registar </h1>
			<?php

				if(isset($_GET['erro']))
				{
					switch ($_GET['erro'])
					{
						case 'camposvazios':
							echo 'Preencha todos os campos!';
							break;

						case 'nome_utilizadorinvalido':
							echo 'Nome de utilizador invalido!';
							break;

						case 'emailinvalido':
							echo 'Email invalido!';
							break;

						case 'passwordsdiferentes':
							echo 'As passowords não são iguais!';
							break;

						case 'errosql':
							echo 'Houve um erro de SQL!';
							break;

						case 'nome_utilizadorutilizado':
							echo 'Nome de utilizador já existente!';
							break;

						default:
							break;
					}
				}
				else
				if(isset($_GET['registo']) == "sucesso")
				{
					echo 'Registo criado com sucesso!';
				}
			?>
			<input type="text" name="nome_utilizador" placeholder="Nome de utilizador" value="<?php if(isset($_GET['nome_utilizador'])) echo $_GET['nome_utilizador'] ?>">
			<input type="text" name="email" placeholder="Email de utilizador" value="<?php if(isset($_GET['email'])) echo $_GET['email'] ?>">
			<input type="password" name="password" placeholder="Password">
			<input type="password" name="password_repetir" placeholder="Repetir Password">
			<input type="submit" name="registar_submit">

		</form>

	</main>

	<?php
	  require "footer.php";
	?>
