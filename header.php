<?php
	session_start();
?>
<!doctype html>
<html>

	<head>
		<title>Movies Seen</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="style.css"/>
	</head>

	<body>
		<header>

			<!-- Menu horizontal -->
			<div class="BarraNavegacao">

				<!-- Icon que redireciona para a pagina principal -->
				<div class="BarraLogo">
					<a href="index.php"><img src="./posters/fundos/icon1.png" style="float:left" border="0"></a>
				</div>

				<?php
					//Se o utilizador nao estiver loggado
					if(!isset($_SESSION['email']))
					{
						//Formulario para registar casa o utilizador nao esteja logado
						echo '<a href="registar.php">Registar</a>';

						//Informacao para o utilizador entrar na sua conta
						echo '<a href="entrar.php">Iniciar Sessão</a>';
					}
					//Se o utilizador estiver loggado
					else
					{
						//Menu Dropdown com as coisas que posso inserir
						echo '
						<div class="Dropdown">
							<button class="BotaoDropdown">Inserir</button>
							<div class="ConteudoDropdown">
								<a href="inserirfilme.php">Filme</a>
								<a href="registar.php">Utilizador</a>
							</div>
						</div>';

						//Botao de sair
						echo '
						<a href="./incluidos/sair.inc.php" style="float:right">Sair</a>';
					}
				?>
				
				<form method="get">
					<input name="pfilme" type="text" placeholder="Pesquisa" >
				</form>
			</div>
		</header>
