<?php 
    session_start();
    include('server.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าสมัครสมาชิก</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <div class="header">
        <h2>สมัครสมาชิก</h2>
    </div>

    <form action="register_db.php" method="post">
        <?php include('errors.php'); ?>
        <?php if (isset($_SESSION['error'])) : ?>
            <div class="error">
                <h3>
                    <?php 
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
                </h3>
            </div>
        <?php endif ?>

        <div class="input-group">
            <label for="username">ชื่อในระบบ</label>
            <input type="text" name="username">
        </div>

        <div class="input-group">
            <label for="email">อีเมลล์</label>
            <input type="email" name="email">
        </div>

        <div class="input-group">
            <label for="password_1">รหัสผ่าน</label>
            <input type="password" name="password_1">
        </div>

        <div class="input-group">
            <label for="password_2">ใส่รหัสผ่านอีกครั้ง</label>
            <input type="password" name="password_2">
        </div>

        <div class="input-group">
            <button type="submit" name="reg_user" class="btn">สมัครสมาชิก</button>
        </div>
        <p>คุณมีบัญชีอยู่แล้วใช่ไหม ? <a href="login.php">เข้าสู่ระบบ</a></p>
    </form>

</body>
</html>