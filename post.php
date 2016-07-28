<?php
// testando a requisição pro PHP
//echo "ok";
if ($_GET) {
    // ele para assim que ele mostrar o $_GET
    //var_dump($_GET);exit;
    // caso precisasemos pegar um valor do array
    // poderiamos pegar assim: $_GET['name']

    // passando um erro como resposta
    header("HTTP / 1.0 404 Not Found");exit;
}

if ($_POST) {
    // exit; - para a execução de um script ou metodo
    var_dump($_GET);exit;
}


?>