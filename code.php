<?php
session_start();
require_once __DIR__ . "./dbcon.php";

$conn = \Config\Database::getConnection();
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