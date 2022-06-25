<?php
    include_once("../classes/db.php");

    session_start();

    //validate all text/number data
    $name = validate($_POST['name']);
    $price = validate($_POST['price']);
    $delivery = validate($_POST['delivery']);
    $short_desc = validate($_POST['short_desc']);
    $long_desc = validate($_POST['long_desc']);
    $category = validate($_POST['category']);
    $amount = validate($_POST['amount']);

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //check image
    $target_directory = "../components/img/";
    $target_file = $target_directory . basename($_FILES["img"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $uploaded = 1;

    //check if exists
    if (file_exists($target_file)) {
        echo "File already exists";
        $uploaded = 0;
    }

    //allow only png
    if($imageFileType != "png") {
        echo "File needs to be in PNG format";
        $uploadOk = 0;
    }

    if ($uploaded == 1) {
        if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["img"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $db = new DataBase();

    //insert product to db
    $insert = "INSERT INTO `product`(`product_name`, `product_price`, `product_delivery_price`, `product_short_desc`, `product_long_desc`, `product_img_id`, `product_amount`, `category_id`) 
                VALUES 
                ('" . $name . "','" . $price . "','" . $delivery . "','" . $short_desc . "','" . $long_desc . "','" . basename($_FILES["img"]["name"]) . "','" . $amount . "','" . $category . "')";

    $db->connectToDB()->exec($insert);

    echo "<br/>Product added succesfully";
?>