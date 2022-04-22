<?php
require_once __DIR__ . "./dbcon.php";


$conn = \Config\Database::getConnection();
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Edit Product</title>
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Edit & update Data using PDO
                            <a href="index.php" class="btn btn-danger float-end">back</a>
                        </h3>
                    </div>
                    <div class="card-body">
                        <?php

                        if(isset($_GET['id'])){
                            $product_id = $_GET['id'];

                            $sql = "SELECT * FROM products WHERE id= ?";
                            $statement = $conn->prepare($sql);

                            $statement->execute([$product_id]);

                            $result = $statement->fetch();
                        }
                        ?>
                        <form action="code.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="product_id" value="<?= $result['id']?>">
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" value="<?= $result['name']?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="description">Deskripsi</label>
                                <input type="text" name="description" value="<?= $result['deskripsi']?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="price">Harga</label>
                                <input type="number" name="price" value="<?= $result['price']?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="update_product_btn" class="btn btn-primary">Update</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>

<?php

$conn = null;
?>