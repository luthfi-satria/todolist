<?php
require_once __DIR__.'/vendor/autoload.php';

use App\Module\Task;

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
$task = new Task();
$result = [];
if($method == 'GET'){
    $result = $task->viewTask();
}else if($method == 'POST'){
    $result = $task->addTask();
}else if($method == 'PUT'){
    $result = $task->completeTask();
}else if($method == 'DELETE'){
    $result = $task->deleteTask();
}
header('content-type: application/json', true);
echo json_encode($result);

?>