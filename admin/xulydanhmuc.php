<?php
require("../db/connect.php");
?>
<?php
if (isset($_POST['themdanhmuc'])) {
    $tendanhmuc = $_POST['danhmuc'];
    $sql_insert = mysqli_query($con, "INSERT INTO tbl_category (category_name) VALUES ('$tendanhmuc')");
} elseif (isset($_POST['capnhatdanhmuc'])) {
    $id_post = $_POST['id_danhmuc'];
    $namedanhmuc = $_POST['name_danhmuc'];
    $sql_capnhat = mysqli_query($con, "UPDATE tbl_category SET category_name = '$namedanhmuc' WHERE category_id = '$id_post'");
    header("location: xulydanhmuc.php");
    exit();
}
if (isset($_GET['quanly'])) {
    $xoa = $_GET['quanly'];
    $id_delete = $_GET['id'];
} else {
    $xoa = '';
}
if ($xoa == 'xoa') {
    $sql_delete = mysqli_query($con, "DELETE FROM tbl_category WHERE category_id = '$id_delete'");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <title>Danh mục</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"><img style="height: 35px; width: 35px;" src="../images/logoshop.JPG"
                alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="xulydonhang.php">Đơn hàng <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="xulydanhmuc.php">Danh mục</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="xulysanpham.php" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Sản phẩm
                    </a>
                    <!-- <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div> -->
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="xulykhachhang.php">Khách hàng</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <div style="margin-top: 38px;" class="container">
        <div class="row">
            <?php
            if (isset($_GET['quanly'])) {
                $capnhat = $_GET['quanly'];
                $id_capnhat = $_GET['id'];
            } else {
                $capnhat = "";
            }
            if ($capnhat == 'update') {
                $sql_update = mysqli_query($con, "SELECT * FROM tbl_category WHERE category_id = '$id_capnhat'");
                $row_capnhat = mysqli_fetch_array($sql_update);
            ?>
            <div class="col-md-4">
                <h4>Cập nhật danh mục</h4>
                <label for="">Tên danh mục</label>
                <form action="" method="POST">
                    <input type="text" name="name_danhmuc" class="form-control" placeholder="Tên danh mục"
                        value="<?php echo $row_capnhat['category_name'] ?>">
                    <input type="hidden" name="id_danhmuc" value="<?php echo $row_capnhat['category_id'] ?>"
                        class="form-control" placeholder="Tên danh mục">
                    <input style="margin-top: 12px;" type="submit" name="capnhatdanhmuc"
                        class="btn btn-default btn-outline-success" value="Cập nhật danh mục">
                </form>
            </div>
            <?php } else { ?>
            <div class="col-md-4">
                <h4>Thêm danh mục</h4>
                <label for="">Tên danh mục</label>
                <form action="" method="POST">
                    <input type="text" name="danhmuc" class="form-control" placeholder="Tên danh mục">
                    <input style="margin-top: 12px;" type="submit" name="themdanhmuc"
                        class="btn btn-default btn-outline-success" value="Thêm danh mục">
                </form>
            </div>
            <?php } ?>
            <div class="col-md-8">
                <h4>Liệt kê danh mục</h4>
                <?php
                $sql_danhmuc = mysqli_query($con, "SELECT * FROM tbl_category ORDER BY category_id ASC");
                ?>
                <table class="table table-bordered">
                    <tr>
                        <td>Thứ tự</td>
                        <td>Tên danh mục</td>
                        <td>Quản lý</td>
                    </tr>
                    <?php
                    $tt = 0;
                    while ($row_danhmuc = mysqli_fetch_array($sql_danhmuc)) {
                        $tt++;
                    ?>
                    <tr>
                        <td><?php echo $tt ?></td>
                        <td><?php echo $row_danhmuc['category_name']; ?></td>
                        <td><a class="btn btn-default btn-outline-success"
                                href="?quanly=xoa&id=<?php echo $row_danhmuc['category_id'] ?>">Xóa</a> || <a
                                class="btn btn-default btn-outline-success"
                                href="?quanly=update&id=<?php echo $row_danhmuc['category_id'] ?>">Cập nhật</a></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>

</body>

</html>