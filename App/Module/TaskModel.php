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
        $getTask = $this->db
                        ->connect()
                        ->query('SELECT * FROM tasks ORDER BY `priority` DESC, `name` ASC')
                        ->fetchAll(\PDO::FETCH_ASSOC);
        return $getTask;
    }
    
    function getCompleteTask(){
        $getTask = $this->db
                        ->connect()
                        ->query('SELECT COUNT(id) as total FROM tasks WHERE is_complete = 1')
                        ->fetch(\PDO::FETCH_ASSOC);
        return $getTask;
    }

    function getTaskByName($name){
        return $this->db
                    ->connect()
                    ->query('SELECT name FROM tasks WHERE name = "'.$name.'" LIMIT 1')
                    ->fetch(\PDO::FETCH_ASSOC);
    }

    function getTaskById($id){
        return $this->db
                    ->connect()
                    ->query('SELECT id FROM tasks WHERE id = "'.$id.'"')
                    ->fetch(\PDO::FETCH_ASSOC);
    }

    function insertTask($data){
        $query = 'INSERT INTO tasks(priority, name) VALUES("%d","%s")';
        $statement = sprintf($query, $data['priority'], $data['name']);
        $execute = $this->db->connect()->exec($statement);
        return $execute;
    }

    function deleteTask($id){
        $query = 'DELETE FROM tasks WHERE id="'.$id.'"';
        return $this->db
                    ->connect()
                    ->query($query)
                    ->execute();
    }

    function completingTask(){

    }
}