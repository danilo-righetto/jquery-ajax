<?php
// testando a requisição pro PHP
//echo "ok";
if ($_GET) {
    // ele para assim que ele mostrar o $_GET
    var_dump($_GET);exit;
    // caso precisasemos pegar um valor do array
    // poderiamos pegar assim: $_GET['name']
}

if ($_POST) {
    // exit; - para a execução de um script ou metodo
    var_dump($_GET);exit;
}


?>