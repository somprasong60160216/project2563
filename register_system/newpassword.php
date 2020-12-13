<?php 
    session_start();
    include('server.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รหัสผ่านใหม่</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <div class="header">
        <h2>รหัสผ่านใหม่</h2>
    </div>

    <form action="forgotpassword_db.php" method="post">
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
            <label for="password">รหัสผ่านใหม่</label>
            <input type="password" name="new_password_1">
        </div>

        <div class="input-group">
            <label for="password">ยืนยันรหัสผ่านใหม่</label>
            <input type="password" name="new_password_2">
        </div>

        <div class="input-group">
            <button type="submit" name="new_pass" class="btn">ยืนยัน</button>
        </div>

</body>
</html>