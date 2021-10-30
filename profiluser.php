<?php 
    session_start();
    include 'db.php';
    if($_SESSION['isLogin'] != true){
        echo '<script>window.location="loginuser.php" </script>';
    }

    $kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin
        WHERE admin_id = 1");
    $a = mysqli_fetch_object($kontak);
    $query =  mysqli_query($conn, "SELECT * FROM tb_users WHERE user_id = '".$_SESSION['user_id']."'");
    $tampung = mysqli_fetch_object($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <title>My Profil | Super Computer</title>
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
    <!-- Content -->
    <div class="section">
        <div class="container">
            <h3>Profil</h3>
            <div class="box">
                <form action="" method="POST">
                    <input class="input-control" type="text" name="name" placeholder="Nama" value="<?php echo $tampung->name?>" required>
                    <input class="input-control" type="text" name="phone" placeholder="Nomor Telephone" value="<?php echo $tampung->phone?>" required>
                    <input class="input-control" type="text" name="address" placeholder="Alamat" value="<?php echo $tampung->address?>" required>
                    <input type="submit" name="submit" class="btn" value="Update Profile">
                </form>
                <?php
                    if(isset($_POST['submit'])){
                        $name = ucwords($_POST['name']);
                        $phone = $_POST['phone'];
                        $address = ucwords($_POST['address']);

                        $update = mysqli_query($conn, "UPDATE tb_users SET 
                            name = '".$name."',
                            phone = '".$phone."',
                            address = '".$address."'
                            WHERE user_id = '".$tampung->user_id."'");
                        
                        if($update){
                            echo '<script>alert("Berhasil Update Data!!")</script>';
                            echo '<script>window.location="profiluser.php"</script>';
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
                        $pass1 = password_hash($_POST['pass1'], PASSWORD_DEFAULT);
                        $pass2 = password_hash($_POST['pass2'], PASSWORD_DEFAULT);

                        if(password_verify($pass1,$pass2)){
                            echo '<script>alert("Konfirmasi Password Baru Tidak Sesuai !!")</script>';
                        } else{
                            $update_pass = mysqli_query($conn, "UPDATE tb_users SET password = '".$pass1."' WHERE user_id = '".$tampung->user_id."'");
                        
                            if($update_pass){
                                echo '<script>alert("Berhasil Ubah Password !!")</script>';
                                echo '<script>window.location="profiluser.php"</script>';
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