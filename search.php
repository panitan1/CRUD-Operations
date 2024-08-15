<?php 
include ("server.php");

if (isset($_POST["search"])) { 

    $search = $_POST['search'];

    $sql = "SELECT * FROM loginrmutr WHERE 
        No LIKE '%$search%' OR
        Name LIKE '%$search%' OR
        Surname LIKE '%$search%' OR
        Username LIKE '%$search%' OR 
        Email LIKE '%$search%' OR 
        Phone_number LIKE '%$search%' OR 
        Status LIKE '%$search%'";

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // แสดงผลข้อมูลที่พบ
            echo "<tr>";
            echo "<th scope='row'>{$row['No']}</th>";
            echo "<td>{$row['Name']}</td>";
            echo "<td>{$row['Surname']}</td>";
            echo "<td>{$row['Username']}</td>";
            echo "<td>{$row['Email']}</td>";
            echo "<td>{$row['Phone_number']}</td>";
            echo "<td>{$row['Status']}</td>";
            echo "<td class='Ayellow'><a href='up_data_user_web.php?No={$row['No']}'>แก้ไขผู้ใช้งาน</a></td>";
            echo "<td class='Ared'><a href='delete.php?No={$row['No']}' onclick='return confirm(\"คุณต้องการลบผู้ใช้งานนี้หรือไม่?\")'>ลบผู้ใช้งาน</a></td>";
            echo "</tr>";
        }
    } else {
        // ถ้าไม่พบข้อมูลตามเงื่อนไขที่กำหนด
        echo "<tr><td colspan='9'>ไม่พบข้อมูล</td></tr>";
    }
}

mysqli_close($conn);
?>