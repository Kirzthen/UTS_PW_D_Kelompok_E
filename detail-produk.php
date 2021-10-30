<?php 
    session_start();
    error_reporting(0);
    include 'db.php';
    if($_SESSION['isLogin'] != true){
        echo '<script>window.location="loginuser.php" </script>';
    }

    $kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin
        WHERE admin_id = 1");
    $a = mysqli_fetch_object($kontak);

    $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."' ");
    $p = mysqli_fetch_object($produk);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Detail Produk | Super Computer</title>
</head>
<body>
    <header>
        <div class="container">
            <h1><a href="index.php">Super Computer</a></h1>
            <ul class="warna">
                <li><a href="profiluser.php">Profil</a></li>
                <li><a href="produk.php">Produk</a></li>
                <li><a href="keluaruser.php">Keluar</a></li>
            </ul>
        </div>
    </header>

    <!--- Pencarian --->
    <div class="search">
        <div class="container">
            <form action="produk.php">
                <input type="text" name="search" placeholder="Cari Produk">
                <input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>">
                <input type="submit" name="cari" value="Cari Produk">
            </form>
        </div>
    </div>

    <!-- Detail Produk -->
    <div class="section">
        <div class="container">
            <h3>Detail Produk</h3>
            <div class="box">
                <div class="col-2">
                    <img src="produk/<?php echo $p->product_image ?>" width="100%">
                </div>
                <div class="col-2">
                    <h3><?php echo $p->product_name ?></h3>
                    <h4>Rp <?php echo number_format($p->product_price) ?></h4>
                    <p>Deskripsi :<br>
                        <?php echo $p->product_description ?>
                    </p>
                    <p><a href="https://api.whatsapp.com/send?phone=<?php echo $a->admin_telp ?>&text=Halo, saya tertarik dengan produk anda."><i class="fa fa-whatsapp fa-3x" aria-hidden="true"></i></a>
                    <a href="https://www.instagram.com/ardhikawida/"><i class="fa fa-instagram fa-3x" aria-hidden="true"></i></a></p>

                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="container">
            <h4>Alamat</h4>
            <p><?php echo $a->admin_address ?></p> 

            <h4>Email</h4>
            <p><?php echo $a->admin_email ?></p> 

            <h4>No. Hp</h4>
            <p><?php echo $a->admin_telp ?></p> 

            <small>Copyright &copy; 2021 - Super Computer.</small>
        </div>
    </div>
</body>
</html>