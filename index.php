<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
include($_SERVER['DOCUMENT_ROOT'].'/_header.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/options/connection_database.php');
?>
<h1 class="text-center">Головна сторінка</h1>
<section style="background-color: #eee;">
    <div class="container py-5">
        <div class="row">
            <?php
            $sql = "SELECT id,name,image,price FROM tbl_products;";
            foreach ($dbh->query($sql) as $row)
            {
                $id=$row['id'];
                $name=$row['name'];
                $image=$row['image'];
                $price=$row['price'];
                echo '
            <div class="col-md-6 col-lg-4 mb-4 mb-md-0">
                <div class="card">
                    <img src="images/'.$image.'"
                         class="card-img-top" alt="Gaming Laptop"/>
                    <div class="card-body">

                        <div class="d-flex justify-content-between mb-3">
                            <h5 class="mb-0">'.$name.'</h5>
                            <h5 class="text-dark mb-0">'.$price.'</h5>
                        </div>

                        <div class="mb-2 text-end">
                            <button type="button" class="btn btn-success">Купить</button>
                        </div>
                    </div>
                </div>
            </div>
                    
                    ';
            }
            ?>
        </div>
    </div>
</section>

<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
