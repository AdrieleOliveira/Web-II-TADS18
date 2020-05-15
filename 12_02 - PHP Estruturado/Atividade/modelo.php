<?php

    function ler(){

        $dados = array();

        $fp = fopen('pessoas.txt', 'r');

        if($fp) {

            while(!feof($fp)){
                $linha = fgets($fp);

                if(!empty($linha)){
                    $aux = explode("#", $linha);

                    $cpf = $aux[0];
                    $nome = $aux[1];
                    $endereco = $aux[2];
                    $telefone = $aux[3];

                    $dados[$cpf] = array();
                    $dados[$cpf]["nome"] = $nome;
                    $dados[$cpf]["endereco"] = $endereco;
                    $dados[$cpf]["telefone"] = $telefone;
                }
            }

            fclose($fp);
        }

        return $dados;
    }

    function escrever($pessoa, $flag){

        $dados = ler();

        if($flag == 0) {
            $cpf = $pessoa["cpf"];
            $dados[$cpf] = array();
            $dados[$cpf]["nome"] = $pessoa["nome"];
            $dados[$cpf]["endereco"] = $pessoa["endereco"];
            $dados[$cpf]["telefone"] = $pessoa["telefone"];
        }

        $fp = fopen("pessoas.txt", "w");

        if($fp){
            if(!empty($dados)){
                foreach ($dados as $cpf => $valor){
                    $linha = $cpf;

                    foreach ($valor as $v){
                        $linha = $linha . "#" . $v;
                    }

                    fputs($fp, "$linha");
                }

                fclose($fp);
            }
        }
    }
