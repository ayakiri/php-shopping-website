<!DOCTYPE html>

<html lang="en">
    <head>
        <?php
            include("./components/bootstrap.php");
            include("./classes/db.php");
        ?>
        <title>Beyond beauty - product details</title>
    </head>

    <body>
        <?php
            $db = new DataBase();

            // check if id given exists
            $db->checkIfIdInDB('product', $_GET['id']);

            //display products and page if id exists
            include("./components/navbar.php");
            echo "<br/>";

            $query = $db->selectAll . "product WHERE product_id=" . $_GET['id'];
            $result = $db->getResultsAssoc($query);

            $product_name = $src = $product_price = $product_delivery_price = $product_amount = $product_long_desc = "";

            while($row = $result->fetch()){
                $product_name = $row['product_name'];
                $src = "./components/img/" . $row['product_img_id'];
                $product_price = $row['product_price'];
                $product_delivery_price = $row['product_delivery_price'];
                $product_amount = $row['product_amount'];
                $product_long_desc = $row['product_long_desc'];
            }
        ?>

        <div class="container">
            <div class="row g-5">
                <div class="col-md-7 col-lg-6">
                    <img src=" <?php echo $src; ?>" class="img-fluid" alt="product photo">
                </div>
                <div class="col-md-5 col-lg-6 ">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <?php echo $product_name; ?>
                    </h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div class="col-md-7 col-lg-6">
                                <h6 class="my-0">Price</h6>
                                <p>
                                    <?php echo $product_price; ?>
                                </p>
                            </div>
                            <div class="col-md-7 col-lg-6">
                                <h6 class="my-0">Price with delivery</h6>
                                <p>
                                    <?php echo $product_delivery_price; ?>
                                </p>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Description</h6>
                                <small class="text-muted">
                                    <?php echo $product_long_desc; ?>
                                </small>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Amount</h6>
                                <small class="text-muted">Available amount in the store</small>
                            </div>
                            <strong>
                                <?php echo $product_amount; ?>
                            </strong>
                        </li>
                    </ul>
                        <div class="input-group">
                            <div class="col-md-7 col-lg-2">
                                <div>
                                    <h6 class="my-0">Delivery: </h6>
                                </div>
                            </div>
                            <div class="col-md-7 col-lg-4">
                                <select>
                                    <option selected>Poczta polska</option>
                                    <option value="1">inpost</option>
                                    <option value="2">dpd</option>
                                </select>
                            </div>
                            <div class="col-md-7 col-lg-2">
                                <div>
                                    <h6 class="my-0">Add to cart: </h6>
                                </div>
                            </div>
                            <div class="col-md-7 col-lg-4">
                                <form action="./forms/addToCart.php" method="get">
                                <?php
                                    echo '<input type="number" class="col-lg-7" name="amount" value="1" min="1" max="' . $product_amount .'">';
                                    echo '<input type="hidden" class="col-lg-7" name="id" value="' . $_GET['id'] . '">';
                                ?>
                                    <input type="submit" class="col-lg-7 btn btn-danger" value="To cart">
                                </form>
                            </div>
                        </div>
                </div>
            </div>
        </div>

        <div class="b-example-divider"></div>

        <div class="container">
            <div class="row g-5">
                <div class="col-md-5 col-lg-12 ">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        Add a review:
                    </h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div class="col-md-7 col-lg-6">
                                <h6 class="my-0">Add a review:</h6>
                            </div>
                            <div class="col-md-7 col-lg-6">
                                <h6 class="my-0">Rules:</h6>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div class="col-md-7 col-lg-6">
                                <div class="form-floating">
                                    <?php
                                        echo '<form method="post" action="./forms/addReview.php?id=' . $_GET['id'] . '">';
                                    ?>
                                        <textarea class="form-control col-lg-11" placeholder="Leave a comment here" name="review" style="height: 100px" required></textarea>
                                        <input type="number" class="col-lg-7 form-control" name="score" placeholder="1-10" min="1" max="10" required>
                                        <input type="text" class="col-lg-7 form-control" name="by" placeholder="Your name" pattern="[a-zA-Z0-9]{1,20}" title="Only letters and numbers allowed" required>
                                        <input type="submit" class="btn btn-danger" value="Leave a review!">
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-7 col-lg-6">
                                <ul>
                                    <li>Make sure to follow the guidelines</li>
                                    <li>Any review breaking the guidelines might get deleted</li>
                                    <li>Only letters, numbers and whitespaces available</li>
                                    <li>Any special characters will be removed</li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="b-example-divider"></div>

        <div class="container">
            <div class="row g-5">
                <div class="col-md-5 col-lg-12 ">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        Our customers reviews:
                    </h4>
                    <ul class="list-group mb-3">
                        <?php
                            $query2 = $db->selectAll . "rating WHERE product_id=" . $_GET['id'];
                            $result2 = $db->getResultsAssoc($query2);

                            while($review = $result2->fetch()){
                            echo '<li class="list-group-item d-flex justify-content-between lh-sm">
                                    <div>
                                        <p class="my-0">' . $review['rating_review'] .'</p>
                                        <small class="text-muted">' . $review['rating_by'] .'</small>
                                    </div>
                                    <strong>
                                    ' . $review['rating_score'] . '
                                </strong>
                                </li>';
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>

        <?php
            $db->closeConnection();
            include("./components/footer.php");
        ?>
    </body>
</html>