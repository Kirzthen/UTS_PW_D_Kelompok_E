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
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <title>Tambah Produk | Super Computer</title>
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
            <h3>Tambah Data Produk</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <select name="kategori" class="input-control" required>
                        <option value="">--- Pilih ---</option>
                        <?php
                            $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                            while ($r = mysqli_fetch_array($kategori)) {
                        ?>

                        <option value="<?php echo $r['category_id'] ?>"><?php echo $r['category_name'] ?></option>
                    <?php } ?>
                    </select>

                    <input type="text" name="nama" class="input-control" placeholder="Nama Produk" required>
                    <input type="text" name="harga" class="input-control" placeholder="Harga" required>
                    <input type="file" name="gambar" class="input-control" required>
                    <textarea class="input-control" name="deskripsi" placeholder="Deskripsi"></textarea><br>
                    <select class="input-control" name="status">
                        <option value="">--- Pilih ---</option>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                    <input type="submit" name="submit" class="btn" value="Tambah Data">
                </form>
                <?php
                    if(isset($_POST['submit'])){

                      // print_r($_FILES['gambar']);
                      //Tampung inputan dari form
                      $kategori = $_POST['kategori'];
                      $nama = $_POST['nama'];
                      $harga = $_POST['harga'];
                      $deskripsi = $_POST['deskripsi'];
                      $status = $_POST['status'];

                      //Tampung Data File yang diupload
                      $filename = $_FILES['gambar']['name'];
                      $tmp_name = $_FILES['gambar']['tmp_name'];

                      $type1 = explode('.', $filename);
                      $type2 =  $type1[1];

                      $newname = 'produk'.time().'.'.$type2;

                      //Tampung Data File yang diizinkan
                      $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

                      //Validasi Format file
                      if(!in_array($type2, $tipe_diizinkan)) {
                          //Format file tidak diizinkan
                          echo '<script>alert("Format file tidak diizinkan")</script>';
                      }else {
                            //Format file diizinkan
                            //Proses upload file dan insert ke database
                            move_uploaded_file($tmp_name, './produk/'.$newname);
                        
                            $insert = mysqli_query($conn, "INSERT INTO tb_product VALUES(
                                null,
                                '".$kategori."',
                                '".$nama."',
                                '".$harga."',
                                '".$deskripsi."',
                                '".$newname."',
                                '".$status."',
                                null
                                    )");
                            
                            if($insert) {
                                echo '<script>alert("Data berhasil disimpan !!")</script>';
                                echo '<script>window.location="data-produk.php"</script>';
                            }else{
                                echo 'gagal '.mysqli_error($conn);
                            }
                    
                        }    
                      //Proses Upload File
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
    
    <script>
        CKEDITOR.replace( 'deskripsi' );
    </script>
</body>
</html>