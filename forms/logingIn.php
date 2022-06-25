<?php
    include_once("../classes/db.php");

    session_start();

    $login = validate($_POST['login']);
    $password = validate($_POST['password']);

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if(empty($login) || !preg_match('/^[a-zA-Z0-9_]+$/', $login) || empty($password) || !preg_match('/^[a-zA-Z0-9_]+$/', $password)){
        echo "Input valid login and password (only letters and numbers)";
    } else{
        $db = new DataBase();

        $findId = "SELECT accounts_id FROM accounts WHERE accounts_login = '" . $login . "'";
        $result = $db->getResultsAssoc($findId);

        //find id of this login
        $id = 0;
        while($row = $result->fetch()) {
            $id = $row['accounts_id'];
        }

        //find password of this id
        $findId = "SELECT accounts_password FROM accounts WHERE accounts_id = '" . $id . "'";
        $result = $db->getResultsAssoc($findId);

        $passwordToCompare = "";

        while($row = $result->fetch()) {
            $passwordToCompare = $row['accounts_password'];
        }

        if($password == $passwordToCompare){
            $_SESSION['user'] = $id;
            header('Location: ../admin_page.php');
            exit();
        } else {
            echo "Incorrect data";
        }
    }


?>