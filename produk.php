<?php 
    error_reporting(0);
    include 'db.php';
    $kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin
        WHERE admin_id = 1");
    $a = mysqli_fetch_object($kontak);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <title>Produk | Super Computer</title>
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

    <!-- Produk Baru -->
    <div class="section">
        <div class="container">
            <h3>Produk</h3>
            <div class="box">
                <?php
                    if($_GET['search'] != '' || $_GET['kat'] != ''){
                        $where = "AND product_name LIKE '%".$_GET['search']."%' AND category_id LIKE '%".$_GET['kat']."%' ";
                    }
                    
                    $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 $where    
                        ORDER BY product_id DESC");
                    if(mysqli_num_rows($produk) > 0) {
                        while($p = mysqli_fetch_array($produk)) {                    
                ?>
                    <a href="detail-produk.php?id=<?php echo $p['product_id'] ?>">
                        <div class="col-4">
                            <img src="produk/<?php echo $p['product_image'] ?>">
                            <p class="nama"><?php echo substr($p['product_name'], 0, 35) ?></p>
                            <p class="harga">Rp. <?php echo number_format($p['product_price']) ?></p>
                        </div>
                    </a>
                <?php }}else{ ?>
                    <p>Produk Tidak Ada</p>
                <?php } ?>
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