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
            return [
                'code' => 200,
                'message' => 'viewTask'
            ];
        }catch(\Exception $err){

        }
    }

    function deleteTask(){
        try{
            return [
                'code' => 200,
                'message' => 'deleteTask'
            ];
        }catch(\Exception $err){

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