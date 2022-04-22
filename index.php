<?php
session_start();


require_once __DIR__ . "./dbcon.php";

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Learn CRUD</title>
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">
                <?php if(isset($_SESSION['message'])):?>

                    <h5 class="alert alert-success"><?= $_SESSION['message']?></h5>
                <?php
                    unset($_SESSION['message']);
                endif; 
                ?>
                <div class="card">
                    <div class="card-header">
                        <h3>CRUD
                            <a href="product-add.php" class="btn btn-primary float-end">Add Product</a>
                        </h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Gambar</th>
                                    <th>Nama</th>
                                    <th>kategory</th>
                                    <th>Deskripsi</th>
                                    <th>Harga</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $conn = \Config\Database::getConnection();

                                    $sql = "SELECT * FROM products";
                                    $statement = $conn->prepare($sql);
                                    $statement->execute();
                                    $result = $statement->fetchAll();
                                    if($result){
                                        foreach($result as $row){
                                            ?>
                                            <tr>
                                                <td><?= $row['id'] ?></td>
                                                <td><img src="file/<?= $row['gambar'] ?>"width="100" height="130"/></td>
                                                <td><?= $row['name'] ?></td>
                                                <td><?= $row['category'] ?></td>
                                                <td><?= $row['deskripsi'] ?></td>
                                                <td>Rp <?= $row['price'] ?></td>
                                                <td>
                                                    <a href="edit_product.php?id=<?= $row['id'] ?>" class="btn btn-primary">Edit</a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }else{
                                        ?>
                                        <tr>
                                            <td colspan='6'>No Found Data Record</td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
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