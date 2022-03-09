<?php
include '../lib/session.php';
include '../classes/staff.php';
$staff = new staff();
$result = $staff->getStaffbyId($_GET['id']);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://use.fontawesome.com/2145adbb48.js"></script>
    <script src="https://kit.fontawesome.com/a42aeb5b72.js" crossorigin="anonymous"></script>
    <title>Chỉnh sửa nhân viên</title>
</head>

<body>
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <label class="logo">ADMIN</label>
        <ul>           
            <li><a href="stafflist.php">Quản lý Nhân viên</a></li>
        </ul>
    </nav>
    <div class="title">
        <h1>Chỉnh sửa sản phẩm</h1>
    </div>
    <div class="container">
        <?php
        if (isset($result)) {
            echo $result;
        }
        ?>
        <div class="form-add">
            <form action="edit_staff.php?id=<?= $staffUpdate['id'] ?>" method="post">
                <input type="text" hidden name="id" style="display: none;" value="<?= $result['id'] ?>">
                <label for="fullname">Tên nhân viên</label>
                <input type="text" id="fullname" name="fullname" placeholder="Tên nhân viên.." value="<?= $result['fullname'] ?>">

                <label for="email">Email</label>
                <input type="text" id="email" name="email" value="<?= $result['email'] ?>">

                <label for="password">Password</label>
                <input type="text" id="password" name="password">

                <label for="dob">Ngày sinh</label>
                <input type="date" id="dob" name="dob" value="<?= $result['dob'] ?>">


                <input type="submit" value="Lưu" name="submit">
            </form>
        </div>
    </div>
    </div>
    
    <footer>
        <p class="copyright">COMPUTERSTORE @ 2021</p>
    </footer>
</body>

</html>