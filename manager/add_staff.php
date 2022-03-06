<?php
include '../lib/session.php';
include '../classes/staff.php';
Session::checkSession('manager');
$role_id = Session::get('role_id');
if ($role_id == 4) {
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
            <form action="add_staff.php" method="post" enctype="multipart/form-data">
                <label for="name">Tên sản phẩm</label>
                <input type="text" id="fullname" name="fullname" placeholder="Tên nhân viên.." required>

                <label for="originalPrice">Giá gốc</label>
                <input type="number" id="originalPrice" name="originalPrice" placeholder="Giá.." required min="1">

                <label for="promotionPrice">Giá khuyến mãi</label>
                <input type="number" id="promotionPrice" name="promotionPrice" placeholder="Giá.." required min="1">

                <label for="image">Hình ảnh</label>
                <input type="file" id="image" name="image" required>

                <label for="cateId">Loại sản phẩm</label>
                <select id="cateId" name="cateId">
                    <?php
                    foreach ($categoriesList as $key => $value) { ?>
                        <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                    <?php }
                    ?>
                </select>

                <label for="qty">Số lượng</label>
                <input type="number" id="qty" name="qty" required min="1">

                <label for="des">Mô tả</label>
                <textarea name="des" id="des" cols="30" rows="10" required></textarea>

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