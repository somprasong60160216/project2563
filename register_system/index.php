<?php 
    session_start();

    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "คุณต้องเข้าสู่ระบบก่อน";
        header('location: login.php');
    }

    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header('location: login.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าแรก</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <div class="homeheader">
        <h2>SHOP 2 HANDS</h2>
    </div>

    <div class="homecontent">
        <!--  ข้อความแจ้งเตือน -->
        <?php if (isset($_SESSION['success'])) : ?>
            <div class="success">
                <h3>
                    <?php 
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </h3>
            </div>
        <?php endif ?>
    
        <!-- เข้าสู่ระบบข้อมูลบัญชีผู้ใช้ -->
        <?php if (isset($_SESSION['username'])) : ?>
            <p> ยินดีต้อนรับ <strong><?php echo $_SESSION['username']; ?></strong></p>
            <p><a href="index.php?logout='1'" style="color: red;">ออกจากระบบ</a></p>
        <?php endif ?>
    </div>

</body>
</html>