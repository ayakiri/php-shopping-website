<?php
    include_once("../classes/db.php");
    include_once("../classes/product_class.php");

    session_start();

    if(!isset($_SESSION['cart'])){
        echo "Add at least 1 item to cart";
        exit();
    }

    $firstName = ifCorrect($_POST['firstName']);
    $lastName = ifCorrect($_POST['lastName']);
    $email = validate($_POST['email']);

    $cc_name = ifCorrect($_POST['cc-name']);
    $cc_number = ifCorrect($_POST['cc-number']);
    $cc_expiration = ifCorrect($_POST['cc-expiration']);
    $cc_cvv = ifCorrect($_POST['cc-cvv']);

    $delivery_company = $_POST['delivery-company'];
    $address = ifCorrect($_POST['address']);
    $address2 = validate($_POST['address2']);
    $city = ifCorrect($_POST['city']);
    $zip = ifCorrect($_POST['zip']);

    //check if correct
    function ifCorrect($data){
        if(empty($data)){
            echo "Input all data";
            exit();
        }
        $item = validate($data);
        $pattern = '/^[a-zA-Z0-9\- ]*$/';
        if(!preg_match($pattern, $item, $match)){
            echo "Only letters, numbers, dashes and white space allowed in inputs";
            exit();
        }
        return $data;
    }

    //validate
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email";
        exit();
    }

    $db = new DataBase();

    //check if enough amount
    foreach ($_SESSION['cart'] as $item) {
        $query = "SELECT product_amount FROM product WHERE product_id=" . $item->getId();
        $result = $db->getResultsAssoc($query);
        $amountInTheShop = 0;
        while($row = $result->fetch()) {
            $amountInTheShop = $row['product_amount'];
        }
        if($item->getAmount()>$amountInTheShop){
            echo "There is at least 1 product in your cart over the available amount in our store";
            exit();
        }
    }

    //insert address
    $insert_address = "INSERT INTO `address`(`address_name`, `address_name_opt`, `address_city`, `address_zip_code`)
                        VALUES 
                        ('" . $address . "','" . $address2 . "','" . $city . "','" . $zip . "')";

    $db->connectToDB()->exec($insert_address);
    $address_id = $db->count("address", "");

    //insert payment
    $insert_payment = "INSERT INTO `payment`(`payment_name`, `payment_number`, `payment_expire`, `payment_cvv`)
                        VALUES 
                        ('" . $cc_name . "','" . $cc_number . "','" . $cc_expiration . "','" . $cc_cvv . "')";

    $db->connectToDB()->exec($insert_payment);
    $payment_id = $db->count("payment", "");

    //insert data
    $insert_data = "INSERT INTO `data`(`data_first_name`, `data_last_name`, `data_mail`, `address_id`)
                            VALUES 
                            ('" . $firstName . "','" . $lastName . "','" . $email . "','" . $address_id . "')";

    $db->connectToDB()->exec($insert_data);
    $data_id = $db->count("data", "");

    //count delivery
    $delivery = $_SESSION['delivery'];
    switch ($delivery_company){
        case 2:
            $delivery = $delivery * 0.9;
            break;
        case 3:
            $delivery= $delivery * 0.95;
            break;
    }

    $total = number_format(($_SESSION['sum'] + $delivery), 2, '.', '');

    //insert order
    $insert_order = "INSERT INTO `orders`(`data_id`, `value`, `payment_id`, `delivery_id`)
                                VALUES 
                                ('" . $data_id . "','" . $total . "','" . $payment_id . "','" . $delivery_company . "')";

    $db->connectToDB()->exec($insert_order);
    $order_id = $db->count("orders", "");

    //insert ordered products
    foreach ($_SESSION['cart'] as $item) {
        $insert_products = "INSERT INTO `ordered_products`(`orders_id`, `product_id`, `product_amount_ordered`)
                                VALUES 
                                ('" . $order_id . "','" . $item->getId() . "','" . $item->getAmount() . "')";
        $db->connectToDB()->exec($insert_products);

        $query = "SELECT product_amount FROM product WHERE product_id=" . $item->getId();
        $result = $db->getResultsAssoc($query);
        $current_amount = 0;
        while($row = $result->fetch()) {
            $current_amount = $row['product_amount'];
        }

        $new_amount = $current_amount - $item->getAmount();
        $update_amount = "UPDATE `product` SET `product_amount`='" . $new_amount . "' WHERE product_id=" . $item->getId();
        $db->connectToDB()->exec($update_amount);
    }

    $_SESSION['last_order'] = $order_id;
    $_SESSION['cart'] = null;
    header('Location: ../order_finished.php');
?>