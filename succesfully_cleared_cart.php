<!DOCTYPE html>

<html lang="en">
    <head>
        <?php include("./components/bootstrap.php"); ?>
        <title>Beyond beauty - cleared cart!</title>
    </head>

    <body class="d-flex h-100 text-center bg-secondary">
        <?php
            //load the session cart and empty it
            session_start();
            if(!(empty($_SESSION['cart']))){
                $_SESSION['cart'] = array();
            }
        ?>

        <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
            <div class="modal modal-alert position-static d-block py-5" tabindex="-1" role="dialog" id="modalChoice">
                <div class="modal-dialog" role="document">
                    <div class="modal-content rounded-3 shadow">
                        <div class="modal-body p-4 text-center">
                                    <span>
                                        <svg class="bi bi-exclamation-triangle text-danger" width="42" height="42" fill="currentColor" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.1.7a.5.5 0 0 1 .4-.2h9a.5.5 0 0 1 .4.2l2.976 3.974c.149.185.156.45.01.644L8.4 15.3a.5.5 0 0 1-.8 0L.1 5.3a.5.5 0 0 1 0-.6l3-4zm11.386 3.785-1.806-2.41-.776 2.413 2.582-.003zm-3.633.004.961-2.989H4.186l.963 2.995 5.704-.006zM5.47 5.495 8 13.366l2.532-7.876-5.062.005zm-1.371-.999-.78-2.422-1.818 2.425 2.598-.003zM1.499 5.5l5.113 6.817-2.192-6.82L1.5 5.5zm7.889 6.817 5.123-6.83-2.928.002-2.195 6.828z"/>
                                        </svg>
                                    </span>
                            <br />
                            <br/>
                            <h5 class="mb-0">Successfully removed item(s) in Your cart!</h5>
                        </div>
                        <div class="modal-footer flex-nowrap p-0">
                            <a href="./main.php" class=" col-6 m-0 fs-6 btn btn-lg btn-link text-danger text-decoration-none rounded-0 border-end">
                                <strong>
                                    Go to the main page
                                </strong>
                            </a>
                            <a href="./checkout.php" class="col-6 m-0 fs-6 btn btn-lg btn-link text-danger text-decoration-none rounded-0">
                                Go to the checkout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>