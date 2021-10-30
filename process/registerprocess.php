<?php
    //Import PHPMailer classes into the global namespace
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    // untuk ngecek tombol yang namenya 'register' sudah di pencet atau belum
    // $_POST itu method di formnya
    if(isset($_POST['register'])){

        // untuk mengoneksikan dengan database dengan memanggil file db.php
        include('../db.php');

        require '../PHPMailer/src/Exception.php';
        require '../PHPMailer/src/OAuth.php';
        require '../PHPMailer/src/PHPMailer.php';
        require '../PHPMailer/src/POP3.php';
        require '../PHPMailer/src/SMTP.php';
            
        // tampung nilai yang ada di from ke variabel
        // sesuaikan variabel name yang ada di registerPage.php disetiap input
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $name = $_POST['name'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $token = md5($email.date('d-m-Y'));

        $cek = mysqli_query($conn, "SELECT * FROM tb_users WHERE email='$email' ");

        if(mysqli_num_rows($cek) > 0) {
            echo '<script> alert("Email Already Registered !"); window.location = "../registeruser.php"</script>';
        } else {
            // Melakukan insert ke databse dengan query dibawah ini
            $query = mysqli_query($conn,
                "INSERT INTO tb_users(email, password, name, address, phone, token)
                VALUES
                ('$email', '$password', '$name', '$address', '$phone', '$token')")
                or die(mysqli_error($con)); // perintah mysql yang gagal dijalankan ditangani oleh perintah “or die”

            //Create a new PHPMailer instance
            $mail = new PHPMailer();

            //Tell PHPMailer to use SMTP
            $mail->isSMTP();

            //Enable SMTP debugging
            //SMTP::DEBUG_OFF = off (for production use)
            //SMTP::DEBUG_CLIENT = client messages
            //SMTP::DEBUG_SERVER = client and server messages
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;

            //Set the hostname of the mail server
            $mail->Host = 'smtp.gmail.com';
            //Use `$mail->Host = gethostbyname('smtp.gmail.com');`
            //if your network does not support SMTP over IPv6,
            //though this may cause issues with TLS

            //Set the SMTP port number:
            // - 465 for SMTP with implicit TLS, a.k.a. RFC8314 SMTPS or
            // - 587 for SMTP+STARTTLS
            $mail->Port = 465;

            //Set the encryption mechanism to use:
            // - SMTPS (implicit TLS on port 465) or
            // - STARTTLS (explicit TLS on port 587)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

            //Whether to use SMTP authentication
            $mail->SMTPAuth = true;

            //Username to use for SMTP authentication - use full email address for gmail
            $mail->Username = 'tubespw123@gmail.com';

            //Password to use for SMTP authentication
            $mail->Password = '@TubesPW123';

            //Set who the message is to be sent from
            //Note that with gmail you can only use your account address (same as `Username`)
            //or predefined aliases that you have configured within your account.
            //Do not use user-submitted addresses in here
            $mail->setFrom('tubespw123@gmail.com', 'Super Computer');

            //Set an alternative reply-to address
            //This is a good place to put user-submitted addresses
            // $mail->addReplyTo('replyto@example.com', 'First Last');

            //Set who the message is to be sent to
            $mail->addAddress($email, $name);

            //Set the subject line
            $mail->Subject = 'Account Verification';

            //Read an HTML message body from an external file, convert referenced images to embedded,
            //convert HTML into a basic plain-text alternative body
            $body = "Hello, ".$name." <br> Verifikasi akun terlebih dahulu untuk login: <br> http://shopatsupercomputer.com/process/verifikasi.php?token=".$token;
            $mail->Body = $body;

            //Replace the plain text body with one created manually
            $mail->AltBody = 'Account Verification';


            //send the message, check for errors
            if (!$mail->send()) {
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Silahkan Login';
                //Section 2: IMAP
                //Uncomment these to save your message in the 'Sent Mail' folder.
                #if (save_mail($mail)) {
                #    echo "Message saved!";
                #}
            }
            
            if($query){
                echo '<script> alert("Register Success"); window.location = "../loginuser.php"</script>';
            } else{
                echo '<script> alert("Register Failed"); </script>';
            }
        }
    } else{
        echo '<script> window.history.back()</script>';
    }
?>