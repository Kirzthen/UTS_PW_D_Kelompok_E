<?php

    if(isset($_POST['login'])){
        include('../db.php'); 
        
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

      
        $query = mysqli_query($conn, "SELECT * FROM tb_users WHERE email = '".$email."' ");
        

        if(mysqli_num_rows($query) > 0){
            session_start();
            $user = mysqli_fetch_assoc($query);
            if(password_verify($password, $user['password'])){
               if($user['activation_status'] == 1) {
                    $_SESSION['isLogin'] = true;
                    $_SESSION['user'] = $user;
                    $_SESSION['user_id'] = $user['user_id'];
                    echo '<script> alert("Login Success"); window.location = "../index.php" </script>';
               } else {
                    echo '<script> alert("Email Is Not Verified"); window.location = "../loginuser.php"</script>';
               }
            } else {
                echo '<script> alert("Password Invalid"); window.location = "../loginuser.php" </script>';
            }
        } else {
            echo '<script> alert("Email not found!"); window.location = "../loginuser.php" </script>';
        }
    }    else {
        echo '<script> window.history.back() </script>';
    }
?>
