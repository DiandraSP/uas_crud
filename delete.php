<?php
include('config.php');

// Pastikan ID produk diterima
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $delete_query = "DELETE FROM produk WHERE product_id = '$id'";

    if (mysqli_query($con, $delete_query)) {
        header('Location: order.php');
        exit;
    } else {
        echo "Error: " . mysqli_error($con);
    }
} else {
    echo "ID produk tidak ditemukan.";
    exit;
}
?>
