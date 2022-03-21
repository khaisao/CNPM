<?php
include '../lib/session.php';
include '../classes/staff.php';
Session::checkSession('manager');
$role_id = Session::get('role_id');
$staff = new staff();
$liststaff = mysqli_fetch_all($staff->getAllStaff(), MYSQLI_ASSOC);
if ($role_id == 3) {
    # code...
} else {
    header("Location:../index.php");
}
    
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $staff = new staff();
    if (isset($_POST['block'])) {
        $result = $staff->block($_POST['id']);
        if ($result) {
            header("location:stafflist.php");
        } else {
            header("location:stafflist.php");

        }
    } else if (isset($_POST['active'])) {
        $result = $staff->active($_POST['id']);
        if ($result) {
            header("location:stafflist.php");
        } else {
            header("location:stafflist.php");
        }
    } else {
        echo '<script type="text/javascript">alert("Có lỗi xảy ra!");</script>';
        die();
    }
}

$staff = new staff();
$list = $staff->getAllAdmin((isset($_GET['page']) ? $_GET['page'] : 1));
$pageCount = $staff->getCountPaging();
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
    <title>Danh sách danh mục</title>
</head>

<body>
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <label class="logo">MANAGER</label>
        <ul>
            <li><a href="stafflist.php" class="active">Quản lý Nhân viên</a></li>
        </ul>
    </nav>
    <div class="title">
        <h1>Danh sách danh mục</h1>
    </div>
    <div class="addNew">
        <a href="add_staff.php">Thêm mới</a>
    </div>
    <div class="container">
        <?php $count = 1;
        if ($list) { ?>
            <table class="list">
                <tr>
                    <th>STT</th>
                    <th>Tên nhân viên</th>
                    <th>Ngày sinh</th>
                    <th>Email</th>
                    <th>Địa chỉ</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
                <?php
                foreach ($liststaff as $key => $value) { ?>
                    <tr>
                        <td><?= $count++ ?></td>
                        <td><?php echo $value["fullname"] ?></td>
                        <td><?= $value['dob'] ?></td>
                        <td><?= $value['email'] ?></td>
                        <td><?= $value['address'] ?></td>
                        <td><?= ($value['status']) ? "Active" : "Block" ?></td>
                        <td>
                            <a href="edit_staff.php?id=<?= $value['id'] ?>">Xem/Sửa</a>
                            <?php
                            if ($value['status']) { ?>
                                <form action="stafflist.php" method="post">
                                    <input type="text" name="id" hidden value="<?= $value['id'] ?>" style="display: none;">
                                    <input type="submit" value="Khóa" name="block">
                                </form>
                            <?php } else { ?>
                                <form action="stafflist.php" method="post">
                                    <input type="text" name="id" hidden value="<?= $value['id'] ?>" style="display: none;">
                                    <input type="submit" value="Mở" name="active">
                                </form>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
            </table>
        <?php } else { ?>
            <h3>Chưa có nhân viên nào...</h3>
        <?php } ?>
        <div class="pagination">
            <a href="stafflist.php?page=<?= (isset($_GET['page'])) ? (($_GET['page'] <= 1) ? 1 : $_GET['page'] - 1) : 1 ?>">&laquo;</a>
            <?php
            for ($i = 1; $i <= $pageCount; $i++) {
                if (isset($_GET['page'])) {
                    if ($i == $_GET['page']) { ?>
                        <a class="active" href="stafflist.php?page=<?= $i ?>"><?= $i ?></a>
                    <?php } else { ?>
                        <a href="stafflist.php?page=<?= $i ?>"><?= $i ?></a>
                    <?php  }
                } else {
                    if ($i == 1) { ?>
                        <a class="active" href="stafflist.php?page=<?= $i ?>"><?= $i ?></a>
                    <?php  } else { ?>
                        <a href="stafflist.php?page=<?= $i ?>"><?= $i ?></a>
                    <?php   } ?>
                <?php  } ?>
            <?php }
            ?>
            <a href="stafflist.php?page=<?= (isset($_GET['page'])) ? $_GET['page'] + 1 : 2 ?>">&raquo;</a>
        </div>
    </div>
    </div>
    <footer>
        <p class="copyright">COMPUTERSTORE @ 2021</p>
    </footer>
</body>

</html>