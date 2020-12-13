<?php
    session_start();
    include('server.php'); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รีเซ็ตรหัสผ่าน</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <div class="header">
        <h2>รีเซ็ตรหัสผ่านใหม่</h2>
    </div>

    <form class="input-group" action="login.php" method="post" style="text-align: center;">
		<p> เราส่งอีเมลไปที่  <b> <?php echo $_GET['email'] ?> </b> เพื่อช่วยคุณกู้คืนบัญชีของคุณ </p>
	    <p> กรุณาลงชื่อเข้าใช้บัญชีอีเมลของคุณและคลิกลิงก์ที่เราส่งไปเพื่อรีเซ็ตรหัสผ่านของคุณ </p>
	</form>

</body>
</html>