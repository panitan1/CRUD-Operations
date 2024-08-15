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

<?php 
$no = isset($_GET['No']) ? $_GET['No'] : '';
$sql = "SELECT * FROM loginrmutr WHERE No = '$no'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ส่วนการจัดการ</title>
    <link rel="stylesheet" href="up_data_user_web.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="webR.js"></script>
</head>

<body>
    <h1>แก้ไขข้อมูลของผู้ใช้</h1>


    <div class="amin">
        <form method="post" action="up_data_user.php">

            <h3>No</h3>
            <input type="text" name="no" value="<?= htmlspecialchars($row['No']) ?>" required readonly>

            <h3>Name</h3>
            <input type="text" name="name" value="<?= htmlspecialchars($row['Name']) ?>" required>

            <h3>Surname</h3>
            <input type="text" name="surname" required value="<?= htmlspecialchars($row['Surname']) ?>">

            <h3>Username</h3>
            <input type="text" name="username" required value="<?= htmlspecialchars($row['Username']) ?>">

            <h3>Password NEW</h3>
            <input type="text" name="password" required value="">

            <h3>เบอร์โทรศัพท์</h3>
            <input type="text" name="phone_number" required value="<?= htmlspecialchars($row['Phone_number']) ?>">

            <h3>Email</h3>
            <input type="email" name="email" required value="<?= htmlspecialchars($row['Email']) ?>">

            <h3>Status</h3>
            <input type="text" name="status" required value="<?= htmlspecialchars($row['Status']) ?>">

    </div>

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
        <button type="submit" name="submit">แก้ไขผู้ใช้งาน</button>
    </div>

</body>

</html>