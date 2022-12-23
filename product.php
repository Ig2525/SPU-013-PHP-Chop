<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/product.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
include($_SERVER['DOCUMENT_ROOT'].'/_header.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/options/connection_database.php');
$id=$_GET['id'];
$name='';
$price='';
$description='';
$sql='
        SELECT id,name,price,description 
        FROM tbl_products 
        WHERE id=:id;
';
$stm = $dbh->prepare($sql);
$stm->execute([':id'=>$id]);
if($row=$stm->fetch()){
    $name=$row['name'];
    $price=$row['price'];
    $description=$row['description'];
}
$sql='
        SELECT pi.name
        FROM tbl_product_images pi
        WHERE pi.product_id=:id
        ORDER BY pi.priority
';
$stm=$dbh->prepare($sql);
$stm->execute([':id'=>$id]);
$images=$stm->fetchAll();
?>


<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="row">
                    <div class="col-md-6">
                        <div class="images p-3">
                            <div class="text-center p-4">
                                <img id="main-image" src="/images/<?php echo $images[0]['name']; ?>" width="250" />
                            </div>
                            <div class="thumbnail text-center">
                                <?php
                                foreach ($images as $img)
                                    echo '
                                        <img onclick="change_image(this)" src="/images/'.$img["name"].'" width="70">
                                        ';
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="product p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center"> <i class="fa fa-long-arrow-left"></i> <span class="ml-1">Back</span> </div> <i class="fa fa-shopping-cart text-muted"></i>
                            </div>
                            <div class="mt-4 mb-3"> <span class="text-uppercase text-muted brand">Orianz</span>
                                <h5 class="text-uppercase"><?php echo $name; ?></h5>
                                <div class="price d-flex flex-row align-items-center">
                                    <span class="act-price"><?php echo $price; ?>&nbsp;грн.</span>

                                </div>
                            </div>
                            <p class="about"><?php echo $description; ?></p>

                            <div class="cart mt-4 align-items-center"> <button class="btn btn-danger text-uppercase mr-2 px-4">Add to cart</button> <i class="fa fa-heart text-muted"></i> <i class="fa fa-share-alt text-muted"></i> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/bootstrap.bundle.min.js"></script>
<script>
    function change_image(image){
        var container = document.getElementById("main-image");
        container.src = image.src;
    }
    document.addEventListener("DOMContentLoaded", function(event) {
    });
</script>
</body>
</html>

