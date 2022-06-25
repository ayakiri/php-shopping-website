<div class="container">
    <main>
        <div class="row g-3">
            <?php
                $db = new DataBase();

                $query = $db->selectAll . "product";
                $result = $db->getResultsAssoc($query);

                while($row = $result->fetch()){
                    $src = "./components/img/" . $row['product_img_id'];
                    $link = "./product_info.php?id=" . $row['product_id'];
                    echo '<div class="col-md-3">';
                    echo '<div class="card" style="width: 22rem">';
                    echo '<h4 class="card-title">' . $row['product_name'] . '</h4>';
                    echo '<img src=' . $src .' class="card-img-top" alt="product photo">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-text">Price: ' . $row['product_price'] . '</h5>
                    <h5 class="card-text">Delivery: ' . $row['product_delivery_price'] . '</h5>
                    <h6 class="card-text">Amount: ' . $row['product_amount'] . '</h6>
                    <p class="card-text">' . $row['product_short_desc'] . '</p>
                    ';
                    echo '<a href="./succesfully_added.php?amount=1&id=' . $row['product_id'] .'" class="btn btn-danger" style="">
                            <svg class="bi bi-exclamation-triangle text-light" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9H2zM1 7v1h14V7H1zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5z"/>
                            </svg>
                            Add to cart
                    </a>';
                    echo '<a href="' . $link . '" class="btn btn-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
                              <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                            </svg>
                            Details
                    </a>';
                    echo '</div></div></div><br/>';
                }

                $db->closeConnection();
            ?>
        </div>
    </main>
</div>
