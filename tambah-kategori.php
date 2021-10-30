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
    <title>Tambah Kategori | Super Computer</title>
</head>
<body>
    <header>
        <div class="container">
            <h1><a href="dashboard.php">Super Computer</a></h1>
            <ul>
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
            <h3>Tambah Data Kategori</h3>
            <div class="box">
                <form action="" method="POST">
                    <input class="input-control" type="text" name="nama" placeholder="Nama Kategori" required>
                    <input type="submit" name="submit" class="btn" value="Tambah Data">
                </form>
                <?php
                    if(isset($_POST['submit'])){

                        $nama = ucwords($_POST['nama']);
                        $insert = mysqli_query($conn, "INSERT INTO tb_category VALUES(
                                  null,
                                  '".$nama."')");
                        
                        if($insert){
                            echo '<script>alert("Berhasil Tambah Data!!")</script>';
                            echo '<script>window.location="data-kategori.php"</script>';
                        } else{
                            echo 'Gagal' .mysqli_error($conn);
                        }
                    
                    }
                ?>
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