<?php 
    session_start();
    include('server.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลืมรหัสผ่าน</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <div class="header">
        <h2>ลืมรหัสผ่าน</h2>
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
            <label for="email">อีเมลล์</label>
            <input type="email" name="email">
        </div>

        <div class="input-group">
            <button type="submit" name="forpass_user" class="btn">ยืนยันการส่งรหัสผ่าน</button>
        </div>

</body>
</html>