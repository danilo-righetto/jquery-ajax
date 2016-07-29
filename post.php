<?php

// Quando você não sabe o metodo da requisição AJAX
// podemos capturar a requisição e realizar um tratamento
// usando o $_REQUEST
if ($_REQUEST) {
    // o $_REQUEST é executado toda vez que tiver 
    // uma requisição, sendo qualquer requisição

    echo json_encode(["msg"=>"Request"]);exit;
}

// testando a requisição pro PHP
//echo "ok";
if ($_GET) {
    // ele para assim que ele mostrar o $_GET
    //var_dump($_GET);exit;
    // caso precisasemos pegar um valor do array
    // poderiamos pegar assim: $_GET['name']

    // passando um erro como resposta
    //header("HTTP / 1.0 404 Not Found");exit;

    //vamos retornar um XML
    echo "<name>{$_GET[name]}</name>";
    json_encode($_GET); //Caso precise retornar um JSON
}

if ($_POST) {
    // exit; - para a execução de um script ou metodo
    //var_dump($_GET);exit;

    // Manipulando dados
    $_POST['name'] = $_POST['name']." DB";
    $_POST['email'] = $_POST['email']." DB";
    $_POST['tel'] = $_POST['tel']." DB";
    json_encode($_POST);
}


?>