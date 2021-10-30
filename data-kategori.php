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
    <title>Data Kategori | Super Computer</title>
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
            <h3>Data Kategori</h3>
            <div class="box">
                <p><a href="tambah-kategori.php"><button class="btn btn-success">Tambah Data</button></a></p><br>
               <table border="1" cellspacing="0" class="table">
                   <thead>
                       <tr>
                           <th width="60px">No</th>
                           <th>Kategori</th>
                           <th width="150px">Aksi</th>
                       </tr>
                   </thead>
                   <tbody>
                        <?php
                            $no = 1;
                            $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                            if(mysqli_num_rows($kategori) > 0){

                            
                            while ($row = mysqli_fetch_array($kategori)) {
                        ?>
                    <tr>
                        <td><?php echo $no++?></td>
                        <td><?php echo $row['category_name']?></td>
                        <td>
                            <a href="edit-kategori.php?id=<?php echo $row['category_id'] ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            <a href="proses-hapus.php?idk=<?php echo $row['category_id']?>" onclick="return confirm('Yakin ingin menghapus data??')"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>          
                    <?php }}else{ ?>
                        <tr>
                            <td colspan="3">Tidak Ada Data!!</td>
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