<?php

    function rotas($url){
        $dados = explode("/", $url);

        if(strcmp($dados[0], "cadastrar") == 0){
            echo "<script> window.location=\"viewCadastrar.php\" </script>";
        }
    }

    function rotasCadastrar($post){

        if(strcmp($post["acao"], "voltar") == 0){
            echo "<script> window.location=\"viewMain.php\" </script>";
        } else if(strcmp($post["acao"], "confirmar") == 0){
            cadastrar($post);
        }
    }

    function cadastrar($post){
        include_once ("modelo.php");

        escrever($post, 0);
        echo "<script> window.location=\"viewMain.php\" </script>";
    }

    function carregar(){
        include_once ("modelo.php");

        $pessoas = ler();

        foreach ($pessoas as $cpf => $dados){
            echo "<tr>";
                echo "<td>" . $cpf . "</td>";

                foreach($dados as $valor){
                    echo "<td>" . $valor . "</td>";
                }

                echo "<td>";
                    echo "<button type='submit' name='acao' value='alterar/" . $cpf . "' class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></button>";
                    echo "&nbsp";
                    echo "<button type='submit' name='acao' value='remover/" . $cpf . "' class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-remove'></span></button>";
                echo "</td>";
            echo "</tr>";
        }
    }
