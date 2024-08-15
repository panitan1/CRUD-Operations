<?php 
session_start();

include('server.php');

$no = $_POST['no'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$phone_number = $_POST['phone_number'];
$status = $_POST['status'];


// สร้าง Salt
$length = random_int(99, 999);
$salt_password = bin2hex(random_bytes($length)); 
$passwordSalt = md5($password . $salt_password);
$algo = PASSWORD_ARGON2ID; 
$options =  [
    'cost' => PASSWORD_ARGON2_DEFAULT_MEMORY_COST,
    'time_cost' => PASSWORD_ARGON2_DEFAULT_TIME_COST,
    'threads' => PASSWORD_ARGON2_DEFAULT_THREADS,
    'memory_cost' => PASSWORD_ARGON2_DEFAULT_MEMORY_COST,
];

$password = password_hash($passwordSalt, $algo , $options );

$sql_chack = "SELECT * FROM loginrmutr WHERE 
Username = '$username' OR
Email = '$email' OR
Phone_number = '$phone_number'";

$sql_update = "UPDATE loginrmutr SET 
                Name='$name', 
                Surname='$surname', 
                Username='$username',
                Password='$password', 
                Email='$email', 
                Phone_number='$phone_number',
                Salt_password='$salt_password',
                Status='$status'
                WHERE No='$no'";

$result_update = mysqli_query($conn, $sql_update);


if ($result_update) { 
    echo "แก้ไขข้อมูลเรียบร้อย";
    header('Location:adduser.php');
} else {
    echo "เกิดข้อผิดพลาดในการอัปเดตข้อมูล: " . mysqli_error($conn);
}



mysqli_close($conn);

?>
