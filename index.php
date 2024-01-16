<?php 

include('db.php');
require __DIR__ .'/crud.php';

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

switch ($method | $uri) {
    case ($method == 'GET' && (($uri == '/api/users/') || $uri == '/api/users')):
      findAllUsers();
    break;

    case ($method == 'GET' && ($uri == '/api/todos/' || $uri == '/api/todos')):
      findAllTodos();
    break;

    case ($method == 'GET' && preg_match('/\/api\/todos\/[1-9]/', $uri)):
      $id = basename($uri);
      findById($id);
    break;
  
    case ($method == 'POST' && ($uri == '/api/todos' || $uri == '/api/todos/')):
      postTodo();
    break;
 
    case ($method == 'PUT' && preg_match('/\/api\/todos\/[1-9]/', $uri)):
      $id = basename($uri);
      putTodo($id);
    break;

    case ($method == 'DELETE' && preg_match('/\/api\/todos\/[1-9]/', $uri)):
      $id = basename($uri);
      deleteTodo($id);
    break;
  default:
    break;
}
?>