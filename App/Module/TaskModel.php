<?php
namespace App\Module;

use App\Connection\LiteConnection;

class TaskModel{
    var $db;
    function __construct()
    {
        $this->db = new LiteConnection();
        SELF::createTable();
    }
    
    function createTable(){
        $command = 'CREATE TABLE IF NOT EXISTS tasks (
            id INTEGER PRIMARY KEY,
            priority INTEGER DEFAULT 1,
            name VARCHAR (50) NOT NULL,
            is_complete INTEGER DEFAULT 0
        )';
        $this->db->connect()->exec($command);
    }

    function getAllTask(){

    }
    
    function getCompleteTask(){

    }

    function getTaskByName(){

    }

    function getTaskById(){

    }

    function insertTask(){

    }

    function deleteTask(){

    }

    function completingTask(){

    }
}