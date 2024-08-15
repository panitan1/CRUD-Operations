<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดผู้ใช้</title>
    <script src="adduserjs.js"></script>
    <link rel="stylesheet" href="adduser.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <div class="main">
        <h1> รายละเอียดผู้ใช้ </h1>

        <div class="inputs">
            <input id=search type="search" name="search" placeholder="ค้นหา...">
        </div>
        <script type="text/javascript">
        $(document).ready(function() {
            $("#search").keyup(function() {
                var search = $(this)
                    .val(); // แก้ไข "ver" เป็น "var" และเพิ่มเครื่องหมายปีกกาที่ขาดหายไปหลังจาก "search != """
                if (search != "") {
                    $.ajax({
                        url: "search.php",
                        method: "POST",
                        data: {
                            search: search
                        },
                        success: function(data) {
                            $(".tablemain").html(data);
                        }
                    })
                }
            });
        });
        </script>


        <div class="a2">
            <br><a href="addAdmain.php">เพิ่มผู้ใช้งาน</a>
        </div>

    </div>


    <table class="tablemain">
        <thead>
            <tr>
                <th scope="col">ลำดับ</th>
                <th scope="col">ชื่อผู้ใช้</th>
                <th scope="col">นามสกุล</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Phone Number</th>
                <th scope="col">สถานะ</th>
                <th scope="col">แก้ไข</th>
                <th scope="col">ลบผู้ใช้</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include("server.php");
            $sql = "SELECT * FROM loginrmutr";
            $result = mysqli_query($conn, $sql);
            $index = 1;
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<th scope='row'>{$index}</th>";
                echo "<td>{$row['Name']}</td>";
                echo "<td>{$row['Surname']}</td>";
                echo "<td>{$row['Username']}</td>";
                echo "<td>{$row['Email']}</td>";
                echo "<td>{$row['Phone_number']}</td>";
                echo "<td>{$row['Status']}</td>";
                echo "<td class='Ayellow'><a href='up_data_user_web.php?No={$row['No']}'>แก้ไขผู้ใช้งาน</a></td>";
                echo "<td class='Ared'><a href='delete.php?No={$row['No']}
                ' onclick='return confirm(\"คุณต้องการลบผู้ใช้งานนี้หรือไม่?\")'>ลบผู้ใช้งาน</a></td>";

                
                $index++;
            }
            mysqli_close($conn);
            ?>
        </tbody>
    </table>
</body>

</html>