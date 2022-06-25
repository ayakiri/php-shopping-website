<?php
    class DataBase{
        private $servername;
        private $username;
        private $password;
        private $database;

        private $connection;

        //selects
        public $selectAll = "SELECT * FROM ";

        public function __construct(){
            $this->servername = "localhost";
            $this->username = "root";
            $this->password = "";
            $this->database = "bb_db";
        }

        function count($table_name, $condition){
            $count_query = "SELECT COUNT(*) FROM " . $table_name . " " . $condition;
            $count = $this->connectToDB()->query($count_query);

            $count->setFetchMode(PDO::FETCH_ASSOC);
            while($row = $count->fetch()){
                return $row['COUNT(*)'];
            }
        }

        function getResultsAssoc($query){
            $result = $this->connectToDB()->query($query);
            if (!$result){
                header('Location: ./error.php');
                exit();
            }
            $result->setFetchMode(PDO::FETCH_ASSOC);
            return $result;
        }

        function checkIfIdInDB($table_name, $id){
            $count_query = "SELECT COUNT(*) FROM " . $table_name;
            $count = $this->connectToDB()->query($count_query);

            if (!$count){
                header('Location: ./error.php');
                exit();
            }

            $count->setFetchMode(PDO::FETCH_ASSOC);
            while($row = $count->fetch()){
                if($id > $row['COUNT(*)'] || $id < 0 || !(is_int(intval($id)))){
                    header('Location: ./error.php');
                    exit();
                }
            }
        }

        function closeConnection(){
            $this->connection = null;
        }

        function connectToDB(){
            try {
                if(empty($connection)){
                    $connection = new PDO("mysql:host=$this->servername;dbname=$this->database", $this->username, $this->password);
                }
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $connection;
            } catch(PDOException $e) {
                header('Location: ./error.php');
                exit();
            }
        }
    }
?>