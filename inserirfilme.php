<?php
  require "header.php";
?>

  <form class="InserirFilme" action="./incluidos/inserirfilmes.inc.php" method="post">

    <h1> Inserir Filme </h1>
    <input type="text" name="titulo_filme" placeholder="Nome do filme" value="<?php if(isset($_GET['titulo_filme'])) echo $_GET['titulo_filme']; ?>">
    <input type="text" name="poster_filme" placeholder="Poster do filme" value="<?php if(isset($_GET['poster_filme'])) echo $_GET['poster_filme']; ?>">
    <input type="text" name="duracao_filme" placeholder="Duracao do filme em minutos" value="<?php if(isset($_GET['duracao_filme'])) echo $_GET['duracao_filme']; ?>">
    <input type="text" name="nome_realizador" placeholder="Nome do realizador" value="<?php if(isset($_GET['nome_realizador'])) echo $_GET['nome_realizador']; ?>">
    <textarea name="descricao_filme" placeholder="Descricao do filme" value="<?php if(isset($_GET['descricao_filme'])) echo $_GET['descricao_filme']; ?>"></textarea>
    Filme Favorito <input type="checkbox" name="favorito" value="1" <?php if(isset($_GET['favorito']) && $_GET['favorito'] == 1) echo 'checked'; /*Useless*/?>>
    <input type="submit" name="filme_submit">

  </form>

<?php
  require "footer.php";
?>
