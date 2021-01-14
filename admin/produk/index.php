
<div class="card mb-4">
    <div class="card-header">
        <button type="button" id="btn-tambah-produk" class="btn btn-primary"><span class="text"><i class="fas fa-car fa-sm"></i> Tambah produk</span></button>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
                // include database
                include '../config/database.php';
                // perintah sql untuk menampilkan daftar produk
                $id_kategori=$_GET['kategori'];
                $sql="select * from produk inner join kategori on kategori.id_kategori=produk.id_kategori where kategori.id_kategori='$id_kategori' order by id_produk desc";
                $hasil=mysqli_query($kon,$sql);
                $no=0;
                //Menampilkan data dengan perulangan while
                while ($data = mysqli_fetch_array($hasil)):
                $no++;
            ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><img  src="produk/gambar/<?php echo $data['gambar'];?>" alt="Card image cap" width="80px"></td>
                <td><?php echo $data['judul_produk']; ?></td>
                <td><?php echo  $data['nama_kategori'];  ?></td>
                <td><?php echo date("d-m-Y",strtotime($data['tanggal'])); ?></td>
                <td><?php echo $data['status'] == 1 ? "<span class='text-success'>Publish</span>" : "<span class='text-warning'>Konsep</span>"; ?> </td>
                <td>   
                    <button class="btn-edit-produk btn btn-warning btn-circle" id_produk="<?php echo $data['id_produk']; ?>" kode_produk="<?php echo $data['kode_produk']; ?>" data-toggle="tooltip" title="Edit produk" data-placement="top">Edit</button> 
                    <button class="btn-hapus-produk btn btn-danger btn-circle"  id_produk="<?php echo $data['id_produk']; ?>"  gambar="<?php echo $data['gambar']; ?>"  data-toggle="tooltip" title="Hapus produk" data-placement="top">Hapus</button>
                </td>
            </tr>
            <!-- bagian akhir (penutup) while -->
            <?php endwhile; ?>
            </tbody>
        </table>
     
    </div>
</div>




<!-- Modal -->
<div class="modal fade" id="modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        <!-- Bagian header -->
        <div class="modal-header">
            <h4 class="modal-title" id="judul"></h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Bagian body -->
        <div class="modal-body">
            <div id="tampil_data">

            </div>  
        </div>
        <!-- Bagian footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

        </div>
    </div>
</div>

<input type="hidden" name="kategori" id="kategori" value="<?php echo $_GET['kategori'];?>" />

<script>

    $('#btn-tambah-produk').on('click',function(){
        var kategori = $('#kategori').val();
        $.ajax({
            url: 'produk/tambah-produk.php',
            data: {kategori:kategori},
            method: 'post',
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Tambah produk';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });

        // fungsi edit produk
    $('.btn-edit-produk').on('click',function(){
    
        var id_produk = $(this).attr("id_produk");
        var kode_produk = $(this).attr("kode_produk");
     
        $.ajax({
            url: 'produk/edit-produk.php',
            method: 'post',
            data: {id_produk:id_produk,kode_produk:kode_produk},
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Edit produk #'+kode_produk;
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });


    // fungsi hapus produk
    $('.btn-hapus-produk').on('click',function(){

        var id_produk = $(this).attr("id_produk");
        var gambar = $(this).attr("gambar");
        var kategori = $('#kategori').val();
        konfirmasi=confirm("Yakin ingin menghapus?")
        
        if (konfirmasi){
            $.ajax({
                url: 'produk/hapus-produk.php',
                method: 'post',
                data: {id_produk:id_produk,gambar:gambar},
                success:function(data){
                    window.location.href = 'index.php?halaman=produk&kategori='+kategori+'&hapus=berhasil';
                }
            });
        }

     
    });

</script>