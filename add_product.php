<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        echo "POST REQUEST SERVER";
        $name=$_POST['name'];
        $price=$_POST['price'];
        $description=$_POST['description'];
        $image=$_FILES['image']['tmp_name'];
        print_r([$name,$price,$description, $image]);
        $dir_save='images/'; //папка де будуть зберігатись фото
        $image_name = uniqid().'.jpg';
        $uploadfile = $dir_save.$image_name;
        if(move_uploaded_file($image, $uploadfile))
        {
            echo "Файл успішно додано";
            include_once($_SERVER['DOCUMENT_ROOT'].'/options/connection_database.php');
            $sql = 'INSERT INTO tbl_products (name, image, price, datecreate, description) VALUES (:name, :image, :price, NOW(), :description);';
            $stmt=$dbh->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':image', $image_name);
            $stmt->execute();
            header("Location: /");
        }
        else
        {
            echo "Помилка додавання файлу";
        }
        exit();
    }
?>
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
include($_SERVER['DOCUMENT_ROOT'].'/_header.php');?>
<h1 class="text-center">Додати продукт</h1>
<form class="col-md-6 offset-md-3" enctype="multipart/form-data" method="post">
    <div class="mb-3">
        <label for="name" class="form-label">Назва</label>
        <input type="text" class="form-control" id="name" name="name">
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Ціна</label>
        <input type="text" class="form-control" id="price" name="price">
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Фото</label>
        <input type="file" class="form-control" id="image" name="image">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Опис</label>
        <input type="text" class="form-control" id="description" name="description">
    </div>

    <button type="submit" class="btn btn-primary">Додати</button>
</form>

<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
