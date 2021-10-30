<?php  
    include('../db.php');

    if(isset($_GET['token'])) {
        $token = $_GET['token'];

        $query = mysqli_query($conn, "SELECT * FROM tb_users WHERE token = '$token' ");

        if(mysqli_num_rows($query) > 0) {
            $user = mysqli_fetch_assoc($query);
            $id = $user['user_id'];
            $update = mysqli_query($conn, "UPDATE tb_users SET activation_status = 1 WHERE user_id = $id ");

            if($update) {
                echo '<script> alert("Verification Success"); window.location = "../loginuser.php"</script>';
            } else {
                echo '<script>alert("Verification Failed"); window.location = "../registeruser.php"</script>';
            }
        } else {
            echo '<script>alert("Token Invalid"); window.location = "../registeruser.php"</script>';
        }

    } else {
        echo '<script>alert("Token Not Found"); window.location = "../registeruser.php"</script>';
    }

?>