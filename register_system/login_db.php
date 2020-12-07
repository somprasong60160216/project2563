<?php 
    session_start();
    include('server.php');

    $errors = array();

    if (isset($_POST['login_user'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        if (empty($username)) {
            array_push($errors, "Username is required");
        }

        if (empty($password)) {
            array_push($errors, "Password is required");
        }

        if (count($errors) == 0) {
            $password = md5($password);
            $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password' ";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) == 1) {
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "ตอนนี้คุณได้เข้าสู่ระบบแล้ว";
                header("location: index.php");
            } else {
                array_push($errors, "เมื่อกรอกรหัสผิด");
                $_SESSION['error'] = "ชื่อหรือรหัสผ่านไม่ถูกต้อง !";
                header("location: login.php");
            }
        } else {
            array_push($errors, "เมื่อไม่กรอกอะไรเลย");
            $_SESSION['error'] = "จำเป็นต้องใส่ชื่อหรือรหัสผ่าน !";
            header("location: login.php");
        }
    }

?>