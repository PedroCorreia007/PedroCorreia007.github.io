<?php
	session_start();

	//Verifica se o botao foi primido
	if(isset($_POST['registar_submit']))
	{
		require 'gestorbd.inc.php';

		//Variaveis
		$nome_utilizador = $_POST['nome_utilizador'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$password_repetir = $_POST['password_repetir'];

		//Verifica se todos os campos estao preenchidos
		if (empty($nome_utilizador) || empty($email) || empty($password) || empty($password_repetir))
		{
			header("Location: ../registar.php?erro=camposvazios&nome_utilizador=".$nome_utilizador."&email=".$email);
			exit();
		}

		//Verifica se ambas a passworde e o nome de utilizador funcionam
		else
		if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $nome_utilizador))
		{
			header("Location: ../registar.php?erro=nome_utilizadorinvalido");
			exit();
		}

		//Verifica se o email e valido
		else
		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			header("Location: ../registar.php?erro=emailinvalido&nome_utilizador=".$nome_utilizador);
			exit();
		}

		//Verifica se o nome de utilizador e valido		 procurar search pattern no mmtuts
		else
		if (!preg_match("/^[a-zA-Z0-9]*$/", $nome_utilizador))
		{
			header("Location: ../registar.php?erro=nome_utilizadorinvalido&email=".$email);
			exit();
		}

		//Verifica se ambas a passwords estao iguais
		else
		if ($password != $password_repetir)
		{
			header("Location: ../registar.php?erro=passwordsdiferentes&email=".$email."&nome_utilizador=".$nome_utilizador);
			exit();
		}

		//verifica se o nome de utilizador ja foi usado
		else
		{
			//Query de busca dos utilizadores da tabela
			$sql = "SELECT nome_utilizador FROM utilizador WHERE nome_utilizador=?";
			$stmt = mysqli_stmt_init($coneccao);

			if(!mysqli_stmt_prepare($stmt, $sql))
			{
				header("Location: ../registar.php?erro=errosql");
				exit();
			}
			else
			{
				//Preenche o codigo SQL
				mysqli_stmt_bind_param($stmt, "s", $nome_utilizador);
				//Corre o comando na base de dados
				mysqli_stmt_execute($stmt);
				//Verificar se houve um resultado
				mysqli_stmt_store_result($stmt);
				//ver o numero de resultados. Devera apenas ser 0 ou 1
				$verificacao_de_resultado = mysqli_stmt_num_rows($stmt);

				//Se ouver utilizadores (1) ele fecha o codigo
				if ($verificacao_de_resultado > 0)
				{
					header("Location: ../registar.php?erro=nome_utilizadorutilizado&email=".$email);
					exit();
				}

				/*  ####INSERCAO NA BASE DE DADOS####  */

				//Se nao houver (0) ele insere na base de dados
				else
				{
					$sql = "INSERT INTO utilizador(email, nome_utilizador, password) VALUES (?, ?, ?)";
					$stmt = mysqli_stmt_init($coneccao);
					//verificar se e possivel executar dentro da base de dados
					if(!mysqli_stmt_prepare($stmt, $sql))
					{
						header("Location: ../registar.php?erro=errosql");
						exit();
					}
					else
					{
						$password_misturada = md5($password);

						//temos tres s pois temos tres ?
						mysqli_stmt_bind_param($stmt, "sss", $email, $nome_utilizador, $password_misturada);
						//Corre o comando na base de dados
						mysqli_stmt_execute($stmt);

						$_SESSION['email'] = $email;
		        $_SESSION['nome_utilizador'] = $nome_utilizador;

						header("Location: ../index.php?registo=sucesso");
						exit();
					}
				}
			}
		}
		//Fechar todas as ligacoes abertas
		mysqli_stmt_close($stmt);
		mysqli_cclose($coneccao);
	}

	//Caso nao tenha primido o botao
	else
	{
		header("Location: ../index.php");
		exit();
	}
