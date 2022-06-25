<!doctype html>

<html lang="en">
    <head>
        <?php
        include_once("./components/bootstrap.php");
        include_once("./classes/product_class.php");
        ?>
        <title>Beyond beauty - checkout</title>
    </head>

    <body class="bg-light">
    <?php
    session_start();

    include("./components/navbar.php");
    echo "<br/>";

    if(isset($_POST['delete'])) {
        for($i = 0; $i < count($_SESSION['cart']); $i++) {
            if($_SESSION['cart'][$i]->getId() == $_POST['id']){
                array_splice($_SESSION['cart'], $i, 1);
            }
        }
    }
    ?>

    <div class="container">
        <main>
            <div class="row g-6">
                <div class="col-md-5 col-lg-5 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-danger">Your cart</span>
                    </h4>
                    <ul class="list-group mb-3">
                        <?php
                        $sum = 0;
                        $delivery = 0;

                        if(isset($_SESSION['cart'])) {
                            foreach ($_SESSION['cart'] as $item) {
                                echo '<li class="list-group-item d-flex justify-content-between lh-sm">
                                                <div class="col-md-8">
                                                    <h6 class="my-0">';
                                echo $item->getName();
                                echo '</h6>
                                                    <small class="text-muted">';
                                echo $item->getAmount();
                                echo '</small>
                                                </div>
                                                <span class="text-muted">';
                                echo ($item->getPrice() * $item->getAmount()) . " $";
                                echo '</span>
                                            <form method="post">
                                                <input type="submit" name="delete" class="btn btn-danger" value="X" />
                                                <input type="hidden" name="id" value="' . $item->getId() . '" />
                                            </form>
                                             </li>';

                                $sum = $sum + ($item->getPrice() * $item->getAmount());
                                $delivery = $delivery + ($item->getDelivery());
                            }
                        }
                        ?>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Products </span>
                            <?php
                            echo $sum . " $";
                            $_SESSION['sum'] = $sum;
                            ?>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Delivery </span>
                            <?php
                            echo $delivery . " $";
                            $_SESSION['delivery'] = $delivery;
                            ?>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><strong>Total</strong></span>
                            <strong>
                                <?php
                                echo ($sum + $delivery) . " $";
                                ?>
                            </strong>
                        </li>
                    </ul>

                    <a href="succesfully_cleared_cart.php" class="btn btn-danger" style="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-bag-x-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zM6.854 8.146a.5.5 0 1 0-.708.708L7.293 10l-1.147 1.146a.5.5 0 0 0 .708.708L8 10.707l1.146 1.147a.5.5 0 0 0 .708-.708L8.707 10l1.147-1.146a.5.5 0 0 0-.708-.708L8 9.293 6.854 8.146z"/>
                        </svg>
                        Clear cart
                    </a>
                </div>

                <div class="col-md-6 col-lg-7">
                    <h4 class="mb-3">Billing address</h4>
                    <form action="forms/order.php" method="post">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="firstName" class="form-label">First name</label>
                                <input type="text" class="form-control" id="firstName"  name="firstName" pattern="[a-zA-Z ]{1,50}" title="Only letters and whitespaces allowed" alt="Only letters and whitespaces allowed" placeholder="ex John" required>
                            </div>

                            <div class="col-sm-6">
                                <label for="lastName" class="form-label">Last name</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" pattern="[a-zA-Z ]{1,50}" placeholder="ex Smith" title="Only letters and whitespaces allowed" alt="Only letters and whitespaces allowed" required>
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="your@email.com" name="email" required>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h4 class="mb-3">Payment</h4>

                        <div class="row gy-3">
                            <div class="col-md-6">
                                <label for="cc-name" class="form-label">Name on card</label>
                                <input type="text" class="form-control" id="cc-name" name="cc-name" pattern="[a-zA-Z ]{1,50}" alt="Only letters and whitespaces allowed" placeholder="ex John Smith" required>
                                <small class="text-muted">Full name as displayed on card</small>
                            </div>

                            <div class="col-md-6">
                                <label for="cc-number" class="form-label">Credit card number</label>
                                <input type="text" class="form-control" id="cc-number" name="cc-number" pattern="[0-9]{15,16}" placeholder="ex 123456789012345" title="15-16 numbers only" required>
                            </div>

                            <div class="col-md-3">
                                <label for="cc-expiration" class="form-label">Expiration</label>
                                <input type="text" class="form-control" id="cc-expiration" name="cc-expiration" pattern="[0-9]{2}-[0-9]{2}" placeholder="ex 01-01" title="Format: mm-yy" required>
                            </div>

                            <div class="col-md-3">
                                <label for="cc-cvv" class="form-label">CVV</label>
                                <input type="text" class="form-control" id="cc-cvv" name="cc-cvv" pattern="[0-9]{3}" placeholder="ex 123" title="Only 3 digit number" required>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h4 class="mb-3">Delivery</h4>

                        <div class="row gy-3">
                            <div class="col-md-3">
                                <label for="cc-cvv" class="form-label">Company</label>
                                <select class="form-control" name="delivery-company">
                                    <option value="1">Poczta Polska</option>
                                    <option value="2">DPD</option>
                                    <option value="3">Inpost</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <p>10% discount on delivery fee with DPD</p>
                                <p>5% discount on delivery fee with Inpost</p>
                            </div>

                            <div class="col-12">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" pattern="[a-zA-Z0-9 ]{1,}" placeholder="ex Oak Street 57" title="Only letters, numbers and whitespaces allowed" required>
                            </div>

                            <div class="col-12">
                                <label for="address2" class="form-label">Address 2 <span class="text-muted">(Optional)</span></label>
                                <input type="text" class="form-control" id="address2" pattern="[a-zA-Z0-9 ]{0,}" placeholder="ex Apartment 7" title="Only letters, numbers and whitespaces allowed" name="address2">
                            </div>

                            <div class="col-md-6">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control" id="city" name="city" pattern="[a-zA-Z ]{1,}" placeholder="ex Washington" title="Only letters- and whitespaces allowed" required>
                            </div>

                            <div class="col-md-6">
                                <label for="zip" class="form-label">Zip code</label>
                                <input type="text" class="form-control" id="zip" name="zip" pattern="[0-9]{2}-[0-9]{3}" placeholder="ex 11-111" title="Format: 11-111" required>
                            </div>
                        </div>

                        <hr class="my-4">

                        <button class="w-100 btn btn-danger btn-lg" type="submit">Continue to checkout</button>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <?php include("./components/footer.php"); ?>
    </body>
</html>