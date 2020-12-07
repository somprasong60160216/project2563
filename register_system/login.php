<?php
    session_start();
    include('server.php'); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าเข้าสู่ระบบ</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <div class="header">
        <h2>เข้าสู่ระบบ</h2>
    </div>

    <form action="login_db.php" method="post">
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
            <label for="password">รหัสผ่าน</label>
            <input type="password" name="password">
        </div>
        <div class="input-group">
            <button type="submit" name="login_user" class="btn">เข้าสู่ระบบ</button>
        </div>
        <p> ยังไม่มีบัญชีผู้ใช้งาน ? <a href="register.php"> สมัครสมาชิก </a></p>
        <p> ลืมรหัสผ่าน ? <a href="register.php"> ลืมรหัสผ่าน </a></p>
        
    </form>

</body>
</html>