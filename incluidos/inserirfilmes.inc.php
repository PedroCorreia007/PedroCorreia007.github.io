<?php
  session_start();

  if(isset($_POST['filme_submit']))
  {
    require 'gestorbd.inc.php';

    //Variaveis
    //utilizador
    $email = $_SESSION['email'];
    //filme
    $titulo_filme = $_POST['titulo_filme'];
    $poster_filme = $_POST['poster_filme'];
    $duracao_filme = $_POST['duracao_filme'];
    $descricao_filme = $_POST['descricao_filme'];
    $nome_realizador = $_POST['nome_realizador'];
    //ut_fi
    if(empty($_POST['favorito'])) $favorito = 0;
    else $favorito = 1;

    //Verifica se todos os campos estao preenchidos
    if (empty($titulo_filme) || empty($poster_filme) || empty($duracao_filme) || empty($descricao_filme) || empty($nome_realizador))
    {
      header("Location: ../inserirfilme.php?erro=camposvazios&titulo_filme=".$titulo_filme."&poster_filme=".$poster_filme."&duracao_filme=".$duracao_filme."&descricao_filme=".$descricao_filme."&nome_realizador=".$nome_realizador."&favorito=".$favorito);
      exit();
    }
     //Verifica se o titulo do filme e valido (Apenas sao validos numeros, letras, e espacos (\s))
    else if (!preg_match('/^[a-zA-Z0-9\s]*$/', $titulo_filme))
    {
      header("Location: ../inserirfilme.php?erro=tituloinvalido&poster_filme=".$poster_filme."&duracao_filme=".$duracao_filme."&descricao_filme=".$descricao_filme."&nome_realizador=".$nome_realizador."&favorito=".$favorito);
      exit();
    }
    //Verifica se a duracao do filme e valido (Segundo a wikipedia, o maior filme comercial tem 873 minutos/14h 33min)
    else if (!preg_match("/^[0-9]*$/", $duracao_filme) || $duracao_filme > 900)
    {
      header("Location: ../inserirfilme.php?erro=duracaoinvalido&titulo_filme=".$titulo_filme."&poster_filme=".$poster_filme."&descricao_filme=".$descricao_filme."&nome_realizador=".$nome_realizador."&favorito=".$favorito);
      exit();
    }
    //Verifica se nome do realizador e valido
    else if (!preg_match("/^[a-zA-Z\s]*$/", $nome_realizador))
    {
      header("Location: ../inserirfilme.php?erro=nomerealizadorinvalido&titulo_filme=".$titulo_filme."&poster_filme=".$poster_filme."&duracao_filme=".$duracao_filme."&descricao_filme=".$descricao_filme."&favorito=".$favorito);
      exit();
    }
    //Verifica se ja existe o titulo na Base de Dados
    else
    {
      $sql = "SELECT titulo_filme FROM filme WHERE titulo_filme='".$titulo_filme."'";
      $stmt = mysqli_stmt_init($coneccao);

      //Prepara o SQL
      if(!mysqli_stmt_prepare($stmt, $sql))
      {
        header("Location: ../inserirfilme.php?erro=errosqltitulo");
        exit();
      }
      //Se poder inserir o filme
      else
      {
        //Corre o comando na base de dados
        mysqli_stmt_execute($stmt);
        //Verificar se houve um resultado
        mysqli_stmt_store_result($stmt);
        //ver o numero de resultados. Devera apenas ser 0 ou 1
        $verificacao_de_resultado = mysqli_stmt_num_rows($stmt);

        //Se houver titulos (1) ele fecha o codigo
        if ($verificacao_de_resultado > 0)
        {
          header("Location: ../inserirfilme.php?erro=titulo_filmeutilizado&poster_filme=".$poster_filme."&duracao_filme=".$duracao_filme."&descricao_filme=".$descricao_filme."&nome_realizador=".$nome_realizador."&favorito=".$favorito);
          exit();
        }
        //Se nao houver ja esse titulo
        else
        {
          //SQL para inseir filme
          //O NULL e para correr o autoincremento
          $sql = "INSERT INTO filme VALUES (NULL,'".$titulo_filme."','".$poster_filme."','".$descricao_filme."','".$duracao_filme."','".$nome_realizador."' )";

          //verificar se e possivel executar dentro da base de dados
          if(!mysqli_stmt_prepare($stmt, $sql))
          {
            header("Location: ../inserirfilme.php?erro=errosqlfilme");
            exit();
          }
          //Se poder inserir os resultados na tabela filme
          else
          {
            //Insere o filme na base de dados
            mysqli_stmt_execute($stmt);

            //header("Location: ../index.php?inserir=sucesso");
            //exit();

            //Vai buscar o id do filme posto, pois esta com auto incremento
            $sql = "SELECT id_filme FROM filme WHERE titulo_filme = '".$titulo_filme."'";

            //Se nao conseguir executar
            if(!mysqli_stmt_prepare($stmt, $sql))
            {
              header("Location: ../inserirfilme.php?erro=errosqlprocurafilme");
              exit();
            }
            //Se conseguir ir buscar o ID
            else
            {
              //Guarda o ID do filme inserido
              $id_filme = mysqli_query($coneccao, $sql);



                          header("Location: ../inserirfilme.php?teste=".$id_filme);
                          exit();





              //header("Location: ../inserirfilme.php?teste=".$filmeusado);
              //exit();


              //Preenche a tabale ut_fi
            //  $sql = "INSERT INTO ut_fi (email, id_filme, favorito) VALUES ('".$email."',".$id_filme.",".$favorito.")";
//$email='ee@dd.pt';

              $sql = "INSERT INTO ut_fi (email, id_filme, favorito) VALUES ('".$email."', $id_filme, $favorito)";


              //verificar se e possivel executar dentro da base de dados
              if(!mysqli_stmt_prepare($stmt, $sql))
              {
                header("Location: ../inserirfilme.php?erro=errosqlut_fi");
                exit();
              }
              //Se for possivel inserir
              else
              {
                //Insere os dados na tabela ut_fi
                mysqli_stmt_execute($stmt);

                header("Location: ../index.php?inserir=sucesso");
                exit();
              }
            }
          }
        }
      }
    }
    mysqli_stmt_close($stmt);
		mysqli_cclose($coneccao);
  }
  else
  {
    header("Location: ../index.php?erro=seumalandro");
  }

?>
