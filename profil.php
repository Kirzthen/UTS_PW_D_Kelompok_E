<?php
    session_start();
    include 'db.php';

    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php" </script>';
    }

    $query =  mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id = '".$_SESSION['id']."'");
    $d = mysqli_fetch_object($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <title>Profil | Super Computer</title>
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
            <h3>Profil</h3>
            <div class="box">
                <form action="" method="POST">
                    <input class="input-control" type="text" name="nama" placeholder="Nama Lengkap" value="<?php echo $d->admin_name?>" required>
                    <input class="input-control" type="text" name="user" placeholder="Username" value="<?php echo $d->username?>" required>
                    <input class="input-control" type="text" name="hp" placeholder="Nomor Telepon" value="<?php echo $d->admin_telp?>" required>
                    <input class="input-control" type="email" name="email" placeholder="Email" value="<?php echo $d->admin_email?>" required>
                    <input class="input-control" type="text" name="alamat" placeholder="Alamat" value="<?php echo $d->admin_address?>" required>
                    <input type="submit" name="submit" class="btn" value="Update Profile">
                </form>
                <?php
                    if(isset($_POST['submit'])){
                        $nama = ucwords($_POST['nama']);
                        $user = $_POST['user'];
                        $hp = $_POST['hp'];
                        $email = $_POST['email'];
                        $alamat = ucwords($_POST['alamat']);

                        $update = mysqli_query($conn, "UPDATE tb_admin SET 
                            admin_name = '".$nama."',
                            username = '".$user."',
                            admin_telp = '".$hp."',
                            admin_email = '".$email."',
                            admin_address = '".$alamat."'
                            WHERE admin_id = '".$d->admin_id."'");
                        
                        if($update){
                            echo '<script>alert("Berhasil Update Data!!")</script>';
                            echo '<script>window.location="profil.php"</script>';
                        } else {
                            echo 'Gagal Update' .mysqli_error($conn);
                        }
                    }
                ?>
            </div>
            <h3>Update Password</h3>
            <div class="box">
                <form action="" method="POST">
                    <input class="input-control" type="password" name="pass1" placeholder="Password Baru" required>
                    <input class="input-control" type="password" name="pass2" placeholder="Konfirmasi Password"  required>
                    <input type="submit" name="ubah_password" class="btn" value="Ubah Password">
                </form>
                <?php
                    if(isset($_POST['ubah_password'])) {
                        $pass1 = $_POST['pass1'];
                        $pass2 = $_POST['pass2'];

                        if($pass2 != $pass1 ){
                            echo '<script>alert("Konfirmasi Password Baru Tidak Sesuai !!")</script>';
                        } else{
                            $u_pass = mysqli_query($conn, "UPDATE tb_admin SET password = '".MD5($pass1)."' WHERE admin_id = '".$d->admin_id."'");
                        
                            if($u_pass){
                                echo '<script>alert("Berhasil Ubah Password !!")</script>';
                                echo '<script>window.location="profil.php"</script>';
                            } else{
                                echo 'Gagal Update' .mysqli_error($conn);
                            }
                        
                        
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