<!DOCTYPE html>

<html lang="en">
    <head>
        <?php
            include("./components/bootstrap.php");
            include_once("./classes/db.php");
        ?>
        <title>Beyond beauty - admin page</title>
    </head>

    <body>
        <?php
            session_start();

            if ($_SESSION['user'] == 1) {
            } else {
                header('Location: ./login.php');
                exit();
            }

            include("./components/navbar.php");

            $db = new DataBase();

            if(isset($_POST['logout'])) {
                $_SESSION['user'] = null;
                header('Location: ./admin_page.php');
            }

            if(isset($_POST['delete'])) {
                $delete = "DELETE FROM `rating` WHERE rating_id=" . $_POST['review_id'];
                $db->connectToDB()->exec($delete);
                header('Location: ./admin_page.php');
            }
        ?>

        <div class="container">
            <main>
                <br/>
                <form method="post">
                    <input type="submit" name="logout" class="btn btn-danger" value="Logout" />
                </form>
                <div class="py-5 text-center">
                    <span>
                            <svg class="bi bi-exclamation-triangle text-danger" width="42" height="42" fill="currentColor" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.1.7a.5.5 0 0 1 .4-.2h9a.5.5 0 0 1 .4.2l2.976 3.974c.149.185.156.45.01.644L8.4 15.3a.5.5 0 0 1-.8 0L.1 5.3a.5.5 0 0 1 0-.6l3-4zm11.386 3.785-1.806-2.41-.776 2.413 2.582-.003zm-3.633.004.961-2.989H4.186l.963 2.995 5.704-.006zM5.47 5.495 8 13.366l2.532-7.876-5.062.005zm-1.371-.999-.78-2.422-1.818 2.425 2.598-.003zM1.499 5.5l5.113 6.817-2.192-6.82L1.5 5.5zm7.889 6.817 5.123-6.83-2.928.002-2.195 6.828z"/>
                            </svg>
                        </span>
                    <h2>Administrator page</h2>
                </div>

                <div class="row g-5">
                    <div class="col-md-12 col-lg-21">
                        <h4 class="mb-3">Add product:</h4>
                        <form class="needs-validation" action="./forms/addProduct.php" method="post" enctype="multipart/form-data">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="name" class="form-label">Product name:</label>
                                    <div class="input-group has-validation">
                                        <input type="text" class="form-control" id="name" name="name" pattern="[a-zA-Z0-9 ]{1,40}" title="Only letters, numbers and whitespaces allowed" required>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label for="price" class="form-label">Price: </label>
                                    <input type="number" class="form-control" id="price" name="price" min="0.01" required>
                                </div>

                                <div class="col-sm-6">
                                    <label for="delivery" class="form-label">Delivery fee:</label>
                                    <input type="number" class="form-control" id="delivery" name="delivery" min="0.01" required>
                                </div>

                                <div class="col-12">
                                    <label for="short_desc" class="form-label">Short description</label>
                                    <input type="text" class="form-control" id="short_desc" name="short_desc" pattern="[a-zA-Z0-9 ]{1,255}" title="Only letters, numbers and whitespaces allowed, up to 255 characters" required>
                                </div>

                                <div class="col-12">
                                    <label for="long_desc" class="form-label">Long description</label>
                                    <textarea class="form-control" id="long_desc" name="long_desc" required></textarea>
                                </div>

                                <div class="col-md-4">
                                    <label for="category" class="form-label">Category:</label>
                                    <select class="form-select" id="category" name="category">
                                        <option value="1">Eyeshadow</option>
                                        <option value="2">Lipstick</option>
                                        <option value="3">Shampoo</option>
                                        <option value="4">Conditioner</option>
                                        <option value="5">Shower Gel</option>
                                        <option value="6">Body Sponge</option>
                                        <option value="7">Body scrub</option>
                                        <option value="8">Body lotion</option>
                                        <option value="9">Nail polish</option>
                                        <option value="10">Nail accessories</option>
                                        <option value="11">Vitamins</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a category.
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="amount" class="form-label">Amount:</label>
                                    <input type="number" class="form-control" id="amount" name="amount" min="0" required>
                                </div>

                                <div class="col-md-4">
                                    <label for="img" class="form-label">Product image:</label>
                                    <input type="file" class="form-control" id="img" name="img" required>
                                    <div class="invalid-feedback">
                                        Image required.
                                    </div>
                                </div>
                            </div>

                            <br/>

                            <button class="w-100 btn btn-danger btn-lg" type="submit">Add product</button>

                            <hr class="my-4">

                            <div class="row g-5">
                                <div class="col-md-12 col-lg-21">
                                    <h4 class="mb-3">Moderate reviews:</h4>

                                    <ul class="list-group mb-3">
                                        <?php
                                            $query2 = $db->selectAll . "rating";
                                            $result2 = $db->getResultsAssoc($query2);

                                            while($review = $result2->fetch()){
                                                echo '<li class="list-group-item d-flex justify-content-between lh-sm">
                                            <div class="col-md-11">
                                                <p class="my-0">' . $review['rating_review'] .'</p>
                                                <small class="text-muted">' . $review['rating_by'] .'</small>
                                            </div>
                                            <strong>
                                            ' . $review['rating_score'] . '
                                        </strong>
                                        <form method="post">
                                            <input type="submit" name="delete" class="btn btn-danger" value="X" />
                                            <input type="hidden" name="review_id" value="' . $review['rating_id'] . '" />
                                        </form>
                                        </li>';
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>

        <?php
        include("./components/footer.php");
        ?>
    </body>
</html>