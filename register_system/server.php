<?php

    $severname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "register_db";

    // สร้างการเชื่อมต่อ
    $conn = mysqli_connect($severname, $username, $password, $dbname);

    //เช็คการเชื่อมต่อ
    if(!$conn) {
        die("การเชื่อมต่อผิดพลาด" . mysqli_connect_error());
    }

?>