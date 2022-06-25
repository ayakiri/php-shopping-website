<?php
    include("../classes/db.php");
    $review = '';
    $id = $_GET['id'];
    $review = preg_replace("/[^A-Za-z0-9 ]/", "", $_POST['review']);
    $score = preg_replace("/[^A-Za-z0-9 ]/", "", $_POST['score']);
    $by = preg_replace("/[^A-Za-z0-9 ]/", "", $_POST['by']);

    session_start();

    $db = new DataBase();

    $insert = "INSERT INTO `rating`(`product_id`, `rating_review`, `rating_score`, `rating_by`)
            VALUES 
            ('" . $id . "', '" . $review . "', '" . $score . "', '" . $by . "')";

    $db->connectToDB()->query($insert);

    $return = "../product_info.php?id=" . $id;
    header('Location: ' . $return . '');
?>