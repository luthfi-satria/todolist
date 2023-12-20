<?php
namespace App\Module;

use Exception;

class Task{
    var $model;
    function __construct()
    {
        $this->model = new TaskModel;
    }

    function addTask(){
        try{
            $data = json_decode(file_get_contents("php://input"), true);
            // Check the task is exists or not
            $checking = $this->model->getTaskByName($data['name']);
            if(empty($checking)){
                $execute = $this->model->insertTask($data);
                return [
                    'code' => 200,
                    'message' => 'Insert Successfully',
                    'result' => $execute,
                ];
            }
            throw new Exception('Tasks name already exists');
        }catch(Exception $err){
            return [
                'code' => 400,
                'message' => 'Bad Request',
                'error' => $err->getMessage(),
            ];
        }
    }

    function viewTask(){
        try{
            $tasks = $this->model->getAllTask();
            $stats = [
                'total' => count($tasks),
                'is_complete' => $this->model->getCompleteTask(),
            ];

            return [
                'code' => 200,
                'message' => 'tasks fetched',
                'data' => $tasks,
                'stats' => $stats,
            ];
        }catch(\Exception $err){
            return [
                'code' => 400,
                'message' => 'Bad Request',
            ];
        } 
    }

    function deleteTask(){
        try{
            $input = json_decode(file_get_contents('php://input'), true);
            // check id existence
            $data = $this->model->getTaskById($input['id']);
            if(empty($data)){
                throw new Exception('Id is not exists');
            }

            $deleting = $this->model->deleteTask($input['id']);

            return [
                'code' => 200,
                'message' => 'Task successfully deleted',
                'result' => $deleting,
            ];
        }catch(\Exception $err){
            return [
                'code' => 400,
                'message' => 'Bad Request',
                'error' => $err->getMessage(),
            ];
        }
    }

    function completeTask(){
        try{
            return [
                'code' => 200,
                'message' => 'completeTask'
            ];
        }catch(\Exception $err){

        }
    }
}