<?php 
    session_start();
    include('server.php');
    
    $errors = array();

    // รับอีเมล และ รหัสผ่านจากหน้า ลืมรหัสผ่าน และ เปลี่ยนรหัสผ่านใหม่

    if (isset($_POST['forpass_user'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        if (empty($email)) {
            array_push($errors, "ต้องระบุอีเมล");
        }

        if (empty($password)) {
            array_push($errors, "ต้องระบุรหัสผ่าน");
        }

    // หากไม่มีข้อผิดพลาดในรูปแบบให้เข้าสู่ระบบผู้ใช้

    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM user WHERE email = '$email' AND password = '$password' ";
        $result = mysqli_query($conn, $query);
    
        if (mysqli_num_rows($result) == 1) {
            $_SESSION['email'] = $email;
            $_SESSION['success'] = "ตอนนี้คุณได้เข้าสู่ระบบแล้ว";
            header("location: index.php");
        } else {
            array_push($errors, "เมื่อกรอกอีเมลผิด");
            $_SESSION['error'] = "อีเมลไม่ถูกต้อง หรือ ไม่มีอยู่ในระบบ !";
            header("location: login.php");
        }
    }
}

    //ยอมรับอีเมลของผู้ใช้ที่จะรีเซ็ตรหัสผ่าน
    //ส่งอีเมลไปยังผู้ใช้เพื่อรีเซ็ตรหัสผ่าน

    if (isset($_POST['forpass_user'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        
        // ตรวจสอบให้แน่ใจว่ามีผู้ใช้อยู่ในระบบของเรา

        $query = "SELECT * FROM user WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if (empty($email)) {
            array_push($errors, "ต้องระบุอีเมลของคุณ");
        } else if (mysqli_num_rows($results) <= 0) {
            array_push($errors, "ขออภัยไม่มีผู้ใช้ในระบบที่ใช้อีเมลนี้");
        }

        // สร้างโทเค็นแบบสุ่มเฉพาะที่มีความยาว 100

        $token = bin2hex(random_bytes(50));

        // จัดเก็บโทเค็นในตารางฐานข้อมูลรีเซ็ตรหัสผ่านกับอีเมลของผู้ใช้

        if (count($errors) == 0) {
            $sql = "INSERT INTO password_reset(email, token) VALUES ('$email', '$token')";
            mysqli_query($conn, $sql);

            // ส่งอีเมลถึงผู้ใช้พร้อมโทเค็นในลิงก์ที่คลิกได้

            $to = $email;
            $subject = "เปลี่ยนรหัสผ่านใหม่ของคุณบน examplesite.com";
            $msg = "สวัสดีครับ/ค่ะ คลิกที่นี่  <a href="newpassword.php ?token=" . $token > รหัสผ่านใหม่ </a> เพื่อรีเซ็ตรหัสผ่านของคุณบนเว็บไซต์ของเรา" ;
            $msg = wordwrap($msg,70);
            $headers = "From: info@examplesite.com";
            mail($to, $subject, $msg, $headers);
            header('location: pending.php?email=' . $email);
        }
    }

    if (isset($_POST['new_pass'])) {
        $new_password_1 = mysqli_real_escape_string($conn, $_POST['new_password_1']);
        $new_password_2 = mysqli_real_escape_string($conn, $_POST['new_password_2']);

        // โทเค็นที่มาจากลิงก์อีเมล

        $token = $_SESSION['token'];

        if (empty($new_password_1) || ($new_password_2)) {
            array_push($errors, "ต้องระบุรหัสผ่านของคุณ");
        }

        if ($new_password_1 != $new_password_2) {
            array_push($errors, "รหัสผ่านไม่ตรงกัน");
        }

        if (count($errors) == 0) {

            // เลือกที่อยู่อีเมลของผู้ใช้จากตาราง password_reset

            $sql = "SELECT email FROM password_reset WHERE token='$token' LIMIT 1";
            $results = mysqli_query($db, $sql);
            $email = mysqli_fetch_assoc($results)['email'];

            if ($email) {
                $new_pass = md5($new_pass);
                $sql = "UPDATE users SET password='$new_pass' WHERE email='$email'";
                $results = mysqli_query($db, $sql);
                header('location: index.php');
        }
    }
}

?>

//https://codewithawa.com/posts/password-reset-system-in-php