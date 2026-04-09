<?php
    header("Content-Type: application/json;");

    $metodo = $_SERVER["REQUEST_METHOD"];
    //echo "METODO DE AQUISIÇÃO: $metodo";

    // $usuarios = [
    //     ["id"=>1, "nome"=>"João", "email"=>"joao@gmail.com"],
    //     ["id"=>2, "nome"=>"Maria", "email"=>"maria@gmail.com"]
    // ];
    // echo json_encode($usuarios);
    switch ($metodo){
        case "GET":
            echo "Aquisição do tipo GET";
            break;
        case "POST":
            echo "Aquisição do tipo POST";  
            break;
        default:
            echo "Método de aquisição não encontrado";
            break;
    }
            
?>  