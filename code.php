<?php
session_start();
require_once __DIR__ . "./dbcon.php";

$conn = \Config\Database::getConnection();

if(isset($_POST['update_product_btn'])){
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

}

try {
    $sql = "UPDATE products SET name= ?,deskripsi=?,price =? WHERE id=?LIMIT 1";
    $statement = $conn->prepare($sql);

    $data = [
        $name,
        $description,
        $price,
        $product_id
    ];

    $sql_execute = $statement->execute($data);

    if($sql_execute){
        $_SESSION['message'] = "Update Successfully";
        header("Location: /index.php");
        exit();
    }else{
        $_SESSION['message'] = "Not Updated";
        header("Location: /index.php");
        exit();
    }
    

}catch(PDOException $e){
    echo $e->getMessage();
}

if(isset($_POST['save_product_btn'])){
    $name = $_POST['name'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $gambar = $_FILES['gambar']['name'];

    move_uploaded_file($_FILES['gambar']['tmp_name'], __DIR__ . "./file/". $_FILES['gambar']['name']);
    $sql = "INSERT INTO products (name,category,deskripsi,price, gambar) VALUES(?,?,?,?,?)";
    $statement = $conn->prepare($sql);
    $data =[
        $name,
        $category,
        $description,
        $price,
        $gambar
    ];
    $statement_execute = $statement->execute($data);

    if($statement_execute){
        $_SESSION['message'] = "Inserted Successfully";
        header("Location: /index.php");
        exit();
    }else{
        $_SESSION['message'] = "Not Inserted";
        header("Location: /index.php");
        exit();
    }
}

$conn = null;
?>