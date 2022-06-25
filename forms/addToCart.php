<?php
    echo $_GET['id'];
    echo $_GET['amount'];
    echo 'working';

    $return = "../succesfully_added.php?amount=" . $_GET['amount'] . "&id=" . $_GET['id'];
    header('Location: ' . $return . '');
?>