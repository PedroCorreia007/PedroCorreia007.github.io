 <?php

	//Dados para liagacao
	$BDnome_servidor="localhost";
	$BDnome_utilizador="root";
	$BDpassword="usbw";
	$BDnome="pap";

	//Ligacao estabelecida
	$coneccao = mysqli_connect($BDnome_servidor, $BDnome_utilizador, $BDpassword, $BDnome);

	//Teste se foi estabelecida
	if(!$coneccao)
	{
		die("Erro ao estabelecer a ligação ao MySql:".mysqli_connect_error());
	}

	//Defenicao do tipo de letra
	mysqli_set_charset($coneccao, "utf8");

?>
