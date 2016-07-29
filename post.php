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
    $data = listAll();
    // ele para assim que ele mostrar o $_GET
    //var_dump($_GET);exit;
    // caso precisasemos pegar um valor do array
    // poderiamos pegar assim: $_GET['name']

    // passando um erro como resposta
    //header("HTTP / 1.0 404 Not Found");exit;

    //vamos retornar um XML
    //echo "<name>{$_GET[name]}</name>";
    echo json_encode($data);exit; //Caso precise retornar um JSON
}

if ($_POST) {
    // exit; - para a execução de um script ou metodo
    //var_dump($_GET);exit;

    // Manipulando dados
    //$_POST['name'] = $_POST['name']." DB";
    //$_POST['email'] = $_POST['email']." DB";
    //$_POST['tel'] = $_POST['tel']." DB";

    $name = $_POST['name'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];

    if ($name == "") {
        json_encode(["status"=>false, "msg"=>"Digite um nome"]);exit;
    }

    if ($email == "") {
        json_encode(["status"=>false, "msg"=>"Digite um email"]);exit;
    }

    if ($tel == "") {
        json_encode(["status"=>false, "msg"=>"Digite um telefone"]);exit;
    }

    // mandando os dados no banco de dados
    $id = save($_POST);
    if ($id) {
        $data = find($id);
        json_encode(["status"=>true, "msg"=>"sucess", "contacts"=>$data]);exit;
    }else{
        json_encode(["status"=>false, "msg"=>"Erro"]);exit;
    }
    
}

/* Para salvar dados no banco vamos criar atendendo as 
informações abaixo: 
banco: mysql 
Schema: ajax_jquery 
Table name: Contacts
Coluns: id, name, email, tel
*/

// Conexão com o banco de dados
function conn(){
    $conn = new \PDO("mysql:host=localhost;dbname=ajax_jquery","root","root");
    return $conn;
}

// Salvando dados no banco
function save($data){
    $db = conn();
    $query = "Insert into `contacts` (`name`,`email`,`tel`) VALUES (:name, :email, :tel)";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':name',$data['name']);
    $stmt->bindValue(':email',$data['email']);
    $stmt->bindValue(':tel',$data['tel']);
    $stmt->execute();
    return $db->lastInsertId();
}

// Função para listar todos os registros da tabela
function listAll(){
    $db = conn();
    $query = "select * from `contacts` order by id DESC";
    //$query = "Insert into `contacts` (`name`,`email`,`tel`) VALUES (:name, :email, :tel)";
    $stmt = $db->prepare($query);
    //$stmt->bindValue(':name',$data['name']);
    //$stmt->bindValue(':email',$data['email']);
    //$stmt->bindValue(':tel',$data['tel']);
    $stmt->execute();
    // retorna todos os resultados da Query
    return $stmt->fetchAll();
}

function find($id){
    $db = conn();
    $query = "select * from `contacts` where id=:id";
    $stmt = $db->prepare($query);  
    $stmt->bindValue(':id',$id);
    $stmt->execute();
    return $stmt->fetch(\PDO::FETCH_ASSOC);
}


?>