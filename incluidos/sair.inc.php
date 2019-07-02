<?php

//comecar a sessao
session_start();
//retirar os valores das variaveis
session_unset();
//retirar os valores das variaves dentro do site
session_destroy();
//volta para o site
header("Location: ../index.php");
