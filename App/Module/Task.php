<?php
namespace App\Module;

class Task{
    var $model;
    function __construct()
    {
        $this->model = new TaskModel;
    }

    function addTask(){
        try{
            return [
                'code' => 200,
                'message' => 'addTask'
            ];
        }catch(\Exception $err){

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