<?php
    header("Content-Type: application/json;");

    $metodo = $_SERVER["REQUEST_METHOD"];
    //echo "METODO DE AQUISIÇÃO: $metodo";
   
    $arquivo = 'usuarios.json';

    if(!file_exists($arquivo)){
        file_put_contents($arquivo,json_encode([],JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
    }
    $usuarios = json_decode(file_get_contents($arquivo),true);


    // $usuarios = [
    //     ["id"=>1, "nome"=>"Maria Luiza", "email"=>"marilu@gmail.com"],
    //     ["id"=>2, "nome"=>"João Pedro", "email"=>"jotape@gmail.com"]
    // ];

    switch ($metodo){
        case "GET":
            // echo "Aquisição do tipo GET";
            echo json_encode($usuarios);
            break;
        case "POST":
            // echo "Aquisição do tipo POST";  
            $dados = json_decode(file_get_contents("php://input"), true);
            // print_r($dados);     
            $novo_usuario = [
                "id" => $dados["id"],
                "nome" => $dados["nome"],
                "email" => $dados["email"]
            ];

            array_push($usuarios,$novo_usuario);
            echo json_encode("Usuário adicionado com sucesso!");
            print_r($usuarios);

            break;
        default:
            echo "Método de aquisição não encontrado";
            break;
    }
            
?>  