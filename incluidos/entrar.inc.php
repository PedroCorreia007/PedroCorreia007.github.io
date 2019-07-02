<?php
session_start();

if(isset($_POST['entrar']))
{
	require'gestorbd.inc.php';

	//Extrair a informacao que o utilizador pos
	$email = $_POST['email'];
	$password = $_POST['password'];

	//Verifica se os campos estao vazios
	if(empty($email) || empty($password))
	{
			header("Location: ../entrar.php?erro=camposvazios");
			exit();
	}
	//se os campos estiverem preenchidos
  else
  {
    //Codigo SQL para ir buscar toda a informacao do utilizador
    $sql = "SELECT * FROM utilizador WHERE email='".$email."'";
    //Executa o codigo SQL
    $resultado = mysqli_query($coneccao, $sql);

    //Se houver um resultado (so deve haver um com a mesma conta de email)
    if(mysqli_num_rows($resultado) == 1)
    {
      //Poe o resultado num vector
      $coluna = mysqli_fetch_assoc($resultado);

      //Se a password estiver correta
      if(md5($password) == $coluna["password"])
      {
        $_SESSION['email'] = $coluna['email'];
        $_SESSION['nome_utilizador'] = $coluna['nome_utilizador'];

        header("Location: ../index.php?login=sucesso");
        exit();
      }
			//Se a password estiver errada
      else
      {
				header("Location: ../entrar.php?erro=passworderrada&email=".$email);
				exit();
      }
    }
    //Erro com o email/chaves primarias
    else
    {
    	header("Location: ../entrar.php?erro=emailerrado");
    	exit();
    }
  }
}
//Redireciona para o index caso o utilizador tenha entrado nesta pagina sem ser pelo botao
else
{
	header("Location: ../index.php?erro=seumalandro");
	exit();
}
