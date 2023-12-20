<?php
    namespace App\Connection;

    use PDO;
    class LiteConnection{

        function connect(){
            $sqlPath = getenv('SQLITEPATH');
            $db = new PDO('sqlite:'.$sqlPath, null,null,array(PDO::ATTR_PERSISTENT => true));
            return $db;
        }
    }
?>