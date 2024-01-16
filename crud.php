<?php 
function findAllUsers(){
  include('db.php');
  header("Content-Type:application/json");
      $conn_pronta = $conn->prepare('SELECT * FROM users');
      if($conn_pronta->execute()){
        if($conn_pronta->rowCount() > 0){
          $users = $conn_pronta->fetchAll();
          echo '
Users: 
        ';
        foreach($users as $user){
          echo '
  Id: '.$user['id'].'
  Nome: '.$user['name'].'
  Email: '.$user['email'].'
                  ';
        }
    }  
    else{
      echo 'Nenhum User encontrado!';
      }
    }
}
function findAllTodos(){
  include('db.php');
  header("Content-Type:application/json");
        $conn_pronta = $conn->prepare('SELECT * FROM afazeres');
        if($conn_pronta->execute()){
          if($conn_pronta->rowCount() > 0){
            $todos = $conn_pronta->fetchAll();
            echo '
  Todos: 
          ';
          foreach($todos as $todo){
            echo '
    Id: '.$todo['id'].'
    Nome : '.$todo['name'].'
    Descrição: '.$todo['description'].'
                    ';
          }
      }  
      else{
        echo 'Nenhum Todo encontrado!';
        }
      }
}
function findById($id){
  include('db.php');
  header('Content-Type: application/json');
  $conn_pronta = $conn->prepare('SELECT * FROM afazeres WHERE id=:id');
  $conn_pronta->bindValue(":id", $id);
  if($conn_pronta->execute()){
        if($conn_pronta->rowCount() > 0){
          $todoById = $conn_pronta->fetchAll();
echo '
User: 
        ';
        foreach($todoById as $todo){
echo '
  Id: '.$todo['id'].'
  Nome: '.$todo['name'].'
  Descrição: '.$todo['description'].'
                      ';
        }
    }  
    else{
      echo 'Nenhum Todo encontrado!';
      }
    }
}
function postTodo(){
  include('db.php');
  header('Content-Type: application/json');
  $requestBody = json_decode(file_get_contents('php://input'), true);
  $name = $requestBody['name'];
  $description = $requestBody['description'];

  $cmdSql = 'INSERT INTO afazeres(name, description) VALUES (:name, :description)';

  $conn_pronta = $conn->prepare($cmdSql);
  $conn_pronta->bindValue(":name", $name);
  $conn_pronta->bindValue(":description", $description);

  if($conn_pronta->execute()){}
    else{
      echo 'Erro ao cadastrar!';
    }
}
function putTodo($id){
  include('db.php');
  header('Content-Type: application/json');
  $requestBody = json_decode(file_get_contents('php://input'), true);
  $name = $requestBody['name'];
  $description = $requestBody['description'];

  $cmdSql = 'UPDATE afazeres SET name=:name, description=:description WHERE id=:id';

  $conn_pronta = $conn->prepare($cmdSql);
  $conn_pronta->bindValue(":id", $id);
  $conn_pronta->bindValue(":name", $name);
  $conn_pronta->bindValue(":description", $description);

  if($conn_pronta->execute()){}
    else{
      echo 'Erro ao cadastrar!';
    }
}
function deleteTodo($id){
  include('db.php');
  header('Content-Type: application/json');
  $cmdSql = 'DELETE FROM afazeres WHERE id = :id';

  $conn_pronta = $conn->prepare($cmdSql);
  $conn_pronta->bindValue(":id", $id);
    if($conn_pronta->execute()){}
    else{
      echo 'Erro ao excluir!';
    }
}
?>