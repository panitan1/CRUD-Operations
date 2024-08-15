<?php
session_start();
include 'server.php';
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : array();
unset($_SESSION['errors']); // Clear errors after displaying
if (isset($_POST['submit'])) {

    // ถ้ามีข้อผิดพลาด ส่งกลับไปยังหน้าสมัครสมาชิก
    if (count($errors) > 0) {
        header('Location:webregister.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ส่วนการจัดการ</title>
    <link rel="stylesheet" href="webR.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="webR.js"></script>
</head>

<body>
    <h1>เพื่มผู้ดูแลระบบ(Admain)</h1>


    <div class="amin">
        <div class="a1suma2">
            <div class="a1">
                <form method="post" action="addAdmainback.php">
                    <h3>Name</h3>
                    <input type="text" name="name" placeholder="กรอกชื่อของคุณ" required>
            </div>

            <div class="a2">
                <h3>Surname</h3>
                <input type="text" name="surname" required placeholder="กรอกนามสกุลของคุณ" id="myInput">

            </div>

        </div>

        <div class="a3suma4">
            <div class="a3">
                <h3>username</h3>
                <input type="username" name="username" required placeholder="username">
            </div>

            <div class="a4">
                <h3>password</h3>
                <input type="password" name="password" required placeholder="password">


            </div>
        </div>

        <div class="newsum">
            <div class="new2">
                <h3>เบอร์โทรศัพท์</h3>
                <input type="text" name="phone_number" required placeholder="กรอกเบอร์โทรศัพท์ของคุณ">
            </div>

            <div class="new1">
                <h3>password confirm</h3>
                <input type="text" name="password_confirm" required placeholder="ยืนยันรหัสผ่าน">


            </div>
        </div>




        <div class="a5suma6">
            <div class="a5">
                <h3>Email</h3>
                <input type="email" name="email" required placeholder="กรอกอีเมลของคุณ">
            </div>

        </div>
        </di>
        <div class="Lottonone">


            <!-- แสดงข้อผิดพลาดหากมี -->
            <?php if (!empty($errors)): ?>

            <div class="myphp">
                <ul>
                    <?php foreach ($errors as $error): ?>
                    <li><?php echo $error;?></li>
                    <?php endforeach; ?>
                </ul>

            </div>
            <?php endif; ?>
            <button type="submit" name="submit">เพิ่มผู้ใช้งาน</button>
        </div>

</body>

</html>