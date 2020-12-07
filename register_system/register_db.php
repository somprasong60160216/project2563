<?php 
    session_start();
    include('server.php');
    
    $errors = array();

    if (isset($_POST['reg_user'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);

        if (empty($username)) {
            array_push($errors, "โปรดระบุชื่อผู้ใช้");
            $_SESSION['error'] = "โปรดระบุชื่อผู้ใช้";
        }
        if (empty($email)) {
            array_push($errors, "โปรดระบุอีเมลล์");
            $_SESSION['error'] = "โปรดระบุอีเมลล์";
        }
        if (empty($password_1)) {
            array_push($errors, "โปรดใส่รหัสผ่าน");
            $_SESSION['error'] = "โปรดใส่รหัสผ่าน";
        }
        if ($password_1 != $password_2) {
            array_push($errors, "The two passwords do not match");
            $_SESSION['error'] = "The two passwords do not match";
        }

        $user_check_query = "SELECT * FROM user WHERE username = '$username' OR email = '$email' LIMIT 1";
        $query = mysqli_query($conn, $user_check_query);
        $result = mysqli_fetch_assoc($query);

        if ($result) { // if user exists
            if ($result['username'] === $username) {
                array_push($errors, "Username already exists");
            }
            if ($result['email'] === $email) {
                array_push($errors, "Email already exists");
            }
        }

        if (count($errors) == 0) {
            $password = md5($password_1);

            $sql = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$password')";
            mysqli_query($conn, $sql);

            $_SESSION['username'] = $username;
            $_SESSION['success'] = "คุณกำลังเข้าสู่ระบบอยู่ขณะนี้";
            header('location: index.php');
        } else {
            header("location: register.php");
        }
    }

?>