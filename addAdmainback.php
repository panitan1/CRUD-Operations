<?php
session_start();
include 'server.php';
$errors = array();

if (isset($_POST['submit'])) {
    // กำจัดและ escape ข้อมูลที่ผู้ใช้กรอกเข้ามา
    $name = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['name']));
    $surname = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['surname']));
    $username = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['username']));
    $password = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['password']));
    $password_confirm = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['password_confirm']));
    $email = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['email']));
    $phone_number = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['phone_number']));

    // ตรวจสอบว่า username, email หรือ phone_number มีอยู่แล้วหรือไม่
    $user_check_query = "SELECT * FROM loginrmutr WHERE Username = '$username' OR email = '$email' OR phone_number = '$phone_number'";
    $query = mysqli_query($conn, $user_check_query);

    if (mysqli_num_rows($query) > 0) {
        $reslist = mysqli_fetch_assoc($query);
        if ($reslist['Username'] === $username) {
            $_SESSION['errors'][] = "Username นี้มีผู้ใช้งานแล้ว";
        }
        if ($reslist['Email'] === $email) {
            $_SESSION['errors'][] = "Email นี้มีผู้ใช้งานแล้ว";
        }
        if ($reslist['Phone_number'] === $phone_number) {
            $_SESSION['errors'][] = "หมายเลขโทรศัพท์นี้มีผู้ใช้งานแล้ว";
        }
    // ตรวจสอบว่ารหัสผ่านตรงกันหรือไม่
    if ($password != $password_confirm) {
        $_SESSION['errors'][] = "รหัสผ่านไม่ตรงกัน";
        header('Location: addAdmain.php');
        exit();
    }

        header('Location: addAdmain.php');
        exit(); // หยุดการทำงานของสคริปต์ทันทีหลังจาก redirect
    } else {
        $length = random_int(99, 999);
        $Salt_password = bin2hex(random_bytes($length));
        $passwordSalt = md5($password . $Salt_password);
        $algo = PASSWORD_ARGON2ID; 
        $options =  [
            'cost' => PASSWORD_ARGON2_DEFAULT_MEMORY_COST,
            'time_cost' => PASSWORD_ARGON2_DEFAULT_TIME_COST,
            'threads' => PASSWORD_ARGON2_DEFAULT_THREADS,
            'memory_cost' => PASSWORD_ARGON2_DEFAULT_MEMORY_COST,
        ];

        $password = password_hash($passwordSalt, $algo , $options );
    }

    // ถ้าไม่มีข้อผิดพลาด ให้ดำเนินการสมัครสมาชิก
    $Time = date("Y-m-d H:i:s");
    $Status = 'admin';

    $sql = "INSERT INTO loginrmutr (Name, Surname, Username, Password, Email, Phone_number, Salt_password, Time, Status) 
            VALUES ('$name', '$surname', '$username', '$password', '$email', '$phone_number', '$Salt_password', '$Time', '$Status')";
    
    if (mysqli_query($conn, $sql)) {
        header('Location: adduser.php');
        exit();
    } else {
        $_SESSION['errors'][] = "เกิดข้อผิดพลาดในการสมัครสมาชิก: " . mysqli_error($conn);
        header('Location: adduser.php');
        exit(); // หยุดการทำงานของสคริปต์ทันทีหลังจาก redirect
    }
}
?>