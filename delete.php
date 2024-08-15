<?php 
include 'server.php';

$no = $_GET['No'];
$sql = "DELETE FROM loginrmutr WHERE No = '$no'";
if (mysqli_query($conn,$sql)) {
    echo "<script>alert('ลบข้อมูลเสร็จสิ้น');</script>";
    echo "<script>window.location = 'adduser.php';</script>";
}else {
    echo "<script>alert('ลบข้อมูลไม่สำเสร็จ');</script>";
}

mysqli_close($conn);
?>