<div class="row">
<?php    
    include 'config/database.php';
    if (isset($_GET['kategori'])) {
        $sql="select * from produk where status=1 and id_kategori=".$_GET['kategori']." order by id_produk desc limit 1";
    }else {
        $sql="select * from produk where status=1 order by id_produk desc limit 1";
    }
    
    $hasil=mysqli_query($kon,$sql);
    $jumlah = mysqli_num_rows($hasil);
    if ($jumlah>0){
        while ($data = mysqli_fetch_array($hasil)):
    ?>
        <div class="thumbnail">
            <a href="index.php?halaman=produk&id=<?php echo $data['id_produk'];?>"><img src="admin/produk/gambar/<?php echo $data['gambar'];?>" width="100%" alt="Cinque Terre"></a>
            <div class="caption">
                <h3><?php echo $data['judul_produk'];?></h3>
                <p>
                    <?php 
                    $ambil=$data["isi_produk"];
                    $panjang = strip_tags(html_entity_decode($ambil,ENT_QUOTES,"ISO-8859-1"));
                    echo substr($panjang, 0, 200);?>
                </p>
                <p><a href="index.php?halaman=produk&id=<?php echo $data['id_produk'];?>" class="btn btn-success" role="button">Selengkapnya</a></p>
            </div>
        </div>
    <?php 
        endwhile;
    }else {
        echo "<div class='alert alert-warning'> Tidak ada produk pada kategori ini.</div>";
    };
    ?>
</div>