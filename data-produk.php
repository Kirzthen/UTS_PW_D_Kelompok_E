<?php
    session_start();
    include 'db.php';

    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php" </script>';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Data Produk | Super Computer</title>
</head>
<body>
    <header>
        <div class="container">
            <h1><a href="dashboard.php">Super Computer</a></h1>
            <ul class="warna">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="data-kategori.php">Data Kategori</a></li>
                <li><a href="data-produk.php">Data Produk</a></li>
                <li><a href="keluar.php">Logout</a></li>
            </ul>
        </div>
    </header>

    <!-- Content -->
    <div class="section">
        <div class="container">
            <h3>Data Produk</h3>
            <div class="box">
                <p><a href="tambah-produk.php"><button class="btn btn-success">Tambah Data</button></a>
                    <a href="./process/report.php"><button type="button" class="btn btn-danger">Download Report</button></a>
                </p><br>
               <table border="1" cellspacing="0" class="table">
                   <thead>
                       <tr>
                           <th width="60px">No</th>
                           <th>Kategori</th>
                           <th>Nama Produk</th>
                           <th>Harga</th>
                           <th>Gambar</th>
                           <th>Status</th>
                           <th width="150px">Control</th>
                       </tr>
                   </thead>
                   <tbody>
                        <?php
                            $no = 1;
                            $produk = mysqli_query($conn, "SELECT * FROM tb_product LEFT JOIN tb_category USING (category_id) ORDER BY product_id DESC");
                            if(mysqli_num_rows($produk) > 0){                         
                            while ($row = mysqli_fetch_array($produk)) {
                        ?>
                    <tr> 
                        <td><?php echo $no++?></td>
                        <td><?php echo $row['category_name']?></td>
                        <td><?php echo $row['product_name']?></td>
                        <td>Rp. <?php echo number_format($row['product_price'])?></td>
                        <td><a href="produk/<?php echo $row['product_image']?>" target="_blank"><img src="produk/<?php echo $row['product_image']?>" width="100px"></a></td>
                        <td><?php echo ($row['product_status'] == 0)? 'Tidak Aktif':'Aktif'; ?></td>
                        <td>
                            <a href="edit-produk.php?id=<?php echo $row['product_id'] ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            <a href="proses-hapus.php?idp=<?php echo $row['product_id']?>" onclick="return confirm('Yakin ingin menghapus data??')"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>          
                    <?php }}else{ ?>
                        <tr>
                            <td colspan="7">Data Masih Kosong !</td>
                        </tr>
                    <?php } ?>
                   </tbody>         
               </table>
            </div>
        </div>
    </div>
                        
    <!-- Footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2021 - Super Computer.</small>
        </div>
    </footer>
    
</body>
</html>