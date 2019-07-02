<?php
	require "./header.php";
?>

<main>

	<div class="PaginaFilme">
		<?php
			require "./incluidos/gestorbd.inc.php";

			$filme = $_GET['filme'];

			//Busca as coisas necessarias para a exposicao do filme
			$sqlFilme = "SELECT * FROM filme WHERE id_filme = ".$filme; //Preencho o codigo SQL com o ID que recebi pelo header
			$infoFilme = mysqli_query($coneccao, $sqlFilme);

			//Poe a busca em vector
			while ($row = mysqli_fetch_row($infoFilme))
			{
		?>
					<div class="Imagem_Filme">
						<img src="<?php echo $row[2]; //Poster ?>">
					</div>
					
						<div class="TextoFilme">
							<h1><?php echo $row[1] //Titulo ?></h1>
							<p><?php echo $row[3] //Descricao ?></p>
							<p><b>Duracao </b>: <?php echo $row[4] //Duracao ?></p>
							<p><b>Realizador </b>: <?php echo $row[5] //Realizador ?></p>
						</div>
		<?php
			}
		?>
	</div>

</main>

<?php
	require "./footer.php";
?>
