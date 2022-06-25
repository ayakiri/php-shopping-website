<!DOCTYPE html>

<html lang="en">
    <head>
        <?php
            include("./components/bootstrap.php");
            include("./classes/db.php");
        ?>
        <title>Beyond beauty - home</title>
    </head>

    <body>
        <?php
            //check if connection possible before rendering page
            $db = new DataBase();
            $db->connectToDB();

            include("./components/navbar.php");
            include("./components/sidebar.php");
            include("./components/sorter.php");
            include("./components/product_card.php");
            include("./components/footer.php");
        ?>
    </body>
</html>