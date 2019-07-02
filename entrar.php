<?php
  require "header.php";
?>

<form action="./incluidos/entrar.inc.php" method="post" class="Formularios">
  <h1> Iniciar Sessão </h1>

  <input name="email" type="text" placeholder="Email de utilizador">
  <input name="password" type="password" placeholder="Password">
  <input name="entrar" type="submit" value="Entrar">
</form>

<?php
  require "footer.php";
?>
