<?php
session_start();
    include '../../config/database.php';

    $id_produk=$_POST["id_produk"];
    $gambar=$_POST["gambar"];

    $sql="delete from produk where id_produk=$id_produk";
    $hapus_produk=mysqli_query($kon,$sql);

    //Menghapus gambar, gambar yang dihapus jika selain gambar default
    if ($gambar!='gambar_default.png'){
        unlink("gambar/".$gambar);
    }
 

?>