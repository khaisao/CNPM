<?php
include '../lib/session.php';
include '../classes/staff.php';
Session::checkSession('manager');
$role_id = Session::get('role_id');
if ($role_id == 3) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $staff = new staff();
        $result = $staff->insert($_POST, $_FILES);
    }
} else {
    header("Location:../index.php");
}
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
    <title>Thêm mới nhân viên</title>
</head>

<body>
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <label class="logo">MANAGER</label>
        <ul>
            <li><a href="stafflist.php">Quản lý Nhân viên</a></li>
        </ul>
    </nav>
    <div class="title">
        <h1>Thêm mới nhân viên</h1>
    </div>
    <div class="container">
        <p style="color: green;"><?= !empty($result) ? $result : '' ?></p>
        <div class="form-add">
            <form action="add_staff.php" method="post"  >
                <label for="fullname">Tên nhân viên</label>
                <input type="text" id="fullname" name="fullname" placeholder="Tên nhân viên.." required>

                <label for="email">Email</label>
                <input type="text" id="email" name="email" placeholder="Email.." required min="1">

                <label for="password">Password</label>
                <input type="text" id="password" name="password" placeholder="Password.." required min="1">

                <label for="dob">Ngày sinh</label>
                <input type="date" id="dob" name="dob" placeholder="Ngày sinh.." required min="1">

                <label for="role_id">Chức vụ</label>
                <input type="text" id="role_id" name="role_id" placeholder="Chức vụ.." required>

                <label for="address">Địa chỉ</label>
                <input type="text" id="address" name="address" placeholder="Địa chỉ.." required min="1">

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