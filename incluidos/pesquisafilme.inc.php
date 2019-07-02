<?php
  session_start();

  require 'gestorbd.inc.php';

  //Declaracao de variavel
  if(isset($_GET['pfilme']))
    $val_pesquisa = $_GET['pfilme'];
  //Podia reenviar o utilizador para outra pagina, mas nao achei necessario
  else
    $val_pesquisa = '';

  //Sql que conta quantos filmes exite com o filtro
  $sql = "SELECT COUNT(id_filme) AS total FROM filme WHERE titulo_filme LIKE '%$val_pesquisa%'";

  //Corre a querry
  $resultado = mysqli_query($coneccao, $sql);
  $numTotalFilmes = mysqli_fetch_assoc($resultado);

  //acho que 28 e um bom numero para os filmes a serem apresentados
  if ($numTotalFilmes["total"] <= 28 && $numTotalFilmes["total"] > 0)
  {
      //Busca as coisas necessarias para a exposicao do filme
      $sqlFilme = "SELECT * FROM filme WHERE titulo_filme LIKE '%$val_pesquisa%'";
      $infoFilme = mysqli_query($coneccao, $sqlFilme);

      //Exposicao dos filmes em HTML filme a filme
      while ($row = mysqli_fetch_row($infoFilme))
      {
        echo '<div class="filme">';   //Div que indica que isto e um filme
          echo '<img src="'.$row[2].'">';   //Poster do filme
          echo '<div class="titulo">';    //Div que trata do formatacao do titulo do filme
            echo '<a href="./filme.php?filme='.$row[0].'">'.$row[1].'</a>';   //Titulo do filme e orientacao para a sua pagina
          echo '</div>';    //fechar do div do titulo
        echo '</div>';    //fechar o div do filme
      }
  }
  //falta por codigo para outras paginas
  else
  {
    //Se nao houver filmes com o titulo desejado
    if ($numTotalFilmes["total"] == 0)
      echo "<script type='text/javascript'>alert('Não há filmes com tal nome');</script>";
    else
      echo "Erro com a Base de Dados!"; //pois eu sei que tenho menos do que 28 filmes
  }


?>
