<!DOCTYPE html>

<html lang="en">
    <head>
        <?php
        include("./components/bootstrap.php");
        include("./classes/db.php");
        ?>
        <title>Beyond beauty - login</title>
    </head>

    <body class="text-center">
        <?php
        //check if connection possible
        $db = new DataBase();
        $db->connectToDB();

        session_start();

        if (isset($_SESSION['user'])) {
            header('Location: ./admin_page.php');
            exit();
        } else {
            // not logged in
        }

        include("./components/navbar.php");
        echo "<br/><br/>";
        ?>

        <main class="form-signin w-100 m-auto">
            <form action="./forms/logingIn.php" method="post">
                <span>
                    <svg class="bi bi-exclamation-triangle text-danger" width="42" height="42" fill="currentColor" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.1.7a.5.5 0 0 1 .4-.2h9a.5.5 0 0 1 .4.2l2.976 3.974c.149.185.156.45.01.644L8.4 15.3a.5.5 0 0 1-.8 0L.1 5.3a.5.5 0 0 1 0-.6l3-4zm11.386 3.785-1.806-2.41-.776 2.413 2.582-.003zm-3.633.004.961-2.989H4.186l.963 2.995 5.704-.006zM5.47 5.495 8 13.366l2.532-7.876-5.062.005zm-1.371-.999-.78-2.422-1.818 2.425 2.598-.003zM1.499 5.5l5.113 6.817-2.192-6.82L1.5 5.5zm7.889 6.817 5.123-6.83-2.928.002-2.195 6.828z"/>
                    </svg>
                </span>
                <h2>Login</h2>

                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingInput" name="login" placeholder="Login" required>
                    <label for="floatingInput">Login</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" required>
                    <label for="floatingPassword">Password</label>
                </div>
                <br/>
                <button class="w-100 btn btn-lg btn-danger" type="submit">Login</button>
            </form>
        </main>

        <?php include("./components/footer.php"); ?>
    </body>
</html>