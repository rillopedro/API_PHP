<?php
    //CABEÇALHO
    header("Content-Type: application/json;");//DEFINE O TIPO DE RESPOSTA

    $metodo = $_SERVER["REQUEST_METHOD"];
    //echo "METODO DE AQUISIÇÃO: $metodo";
    //RECUPERA O ARQUIVO JSON NA MESMA PASTA DO PROJETO
    $arquivo = 'usuarios.json';
    // VERIFICA SE O ARQUIVO EXISTE, SE NÃO EXISTIR CRIA ARRAY VAZIO
    if(!file_exists($arquivo)){
        file_put_contents($arquivo,json_encode([],JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
    }
    //LÊ O CONTEUDO DO ARQUIVO
    $usuarios = json_decode(file_get_contents($arquivo),true);

    //CONTEUDO
    // $usuarios = [
    //     ["id"=>1, "nome"=>"Maria Luiza", "email"=>"marilu@gmail.com"],
    //     ["id"=>2, "nome"=>"João Pedro", "email"=>"jotape@gmail.com"]
    // ];

    switch ($metodo){
        case "GET":
            // echo "Aquisição do tipo GET";
            //CONVERTE PARA JSON
            echo json_encode($usuarios);
            break;
        case "POST":
            // echo "Aquisição do tipo POST";  
            //LER OS DADOS NO CORPO DA REQUISIÇÃO
            $dados = json_decode(file_get_contents("php://input"), true);
            // print_r($dados);
            if(!isset($dados["id"])||!isset($dados["nome"])|| !isset($dados["email"])){
                http_response_code(400);
                echo json_encode(["erro"=>"Dados incompletos."], JSON_UNESCAPED_UNICODE);
                exit;
            }
            //CRIA NOVO USER
            $novo_usuario = [
                "id" => $dados["id"],
                "nome" => $dados["nome"],
                "email" => $dados["email"]
            ];
            //ADICIONA AO ARRAY DE USERS
            $usuarios[]= $novo_usuario;
            
            //SALVA O ARRAY ATT NO JSON
            file_put_contents($arquivo, json_encode($usuarios, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
            break;

            // adiciona o novo usuario ao array existente
            // array_push($usuarios,$novo_usuario);
            // echo json_encode("Usuário adicionado com sucesso!");
            // print_r($usuarios);
            break;
        default:
            //echo "Método de aquisição não encontrado";
            //break;
            http_response_code(405); //Método não permitido
            echo json_encode(["erro"=>"Método não permitido"], JSON_UNESCAPED_UNICODE);
            break;
    }        
?>  