<?php
require("../db/connect.php");
?>
<?php
if (isset($_POST['capnhatdonhang'])) {
    $xuly = $_POST['xuly'];
    $mahang_tt = $_POST['mahang_xuly'];
    $sql_update_tinhtrang = mysqli_query($con, "UPDATE tbl_donhang SET tinhtrang = '$xuly' WHERE mahang = '$mahang_tt'");
}

?>
<?php
// if (isset($_POST['themdanhmuc'])) {
//     $tendanhmuc = $_POST['danhmuc'];
//     $sql_insert = mysqli_query($con, "INSERT INTO tbl_category (category_name) VALUES ('$tendanhmuc')");
// } elseif (isset($_POST['capnhatdanhmuc'])) {
//     $id_post = $_POST['id_danhmuc'];
//     $namedanhmuc = $_POST['name_danhmuc'];
//     $sql_capnhat = mysqli_query($con, "UPDATE tbl_category SET category_name = '$namedanhmuc' WHERE category_id = '$id_post'");
//     header("location: xulydanhmuc.php");
//     exit();
// }
if (isset($_GET['quanly'])) {
    $xoa = $_GET['quanly'];
    $delete = isset($_GET['id']) ? $_GET['id'] : '';
} else {
    $xoa = '';
    $delete = '';
}

if ($xoa == 'delete' && !empty($delete)) {
    $sql_delete = mysqli_query($con, "DELETE FROM tbl_donhang WHERE donhang_id = '$delete'");
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
                    <a class="nav-link" href="?">Đơn hàng <span class="sr-only">(current)</span></a>
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
                $mahang = isset($_GET['mahang']) ? $_GET['mahang'] : '';
            } else {
                $capnhat = "";
                $mahang = '';
            }
            if ($capnhat == 'xemdonhang' && !empty($mahang)) {
                $sql_order = mysqli_query($con, "SELECT * FROM tbl_donhang, tbl_sanpham WHERE tbl_donhang.sanpham_id = tbl_sanpham.sanpham_id AND tbl_donhang.mahang = '$mahang'");
            ?>
            <div class="col-md-7">
                <p>xem chi tiết đơn hàng</p>
                <form action="" method="POST">
                    <table class="table table-bordered">
                        <tr>
                            <td>Thứ tự</td>
                            <td>Mã hàng</td>
                            <td>Tên sản phẩm</td>
                            <td>Số lương</td>
                            <td>Giá</td>
                            <td>Tổng tiền</td>
                            <td>Ngày đặt</td>
                            <td>Quản lý</td>
                        </tr>
                        <?php
                            $tt = 0;
                            while ($row_donhang = mysqli_fetch_array($sql_order)) {
                                $tt++;
                            ?>
                        <tr>
                            <td><?php echo $tt ?></td>
                            <td><?php echo $row_donhang['mahang']; ?></td>
                            <td><?php echo $row_donhang['sanpham_name']; ?></td>
                            <td><?php echo $row_donhang['soluong']; ?></td>
                            <td><?php echo $row_donhang['sanpham_gia']; ?></td>
                            <td><?php echo number_format($row_donhang['soluong'] * $row_donhang['soluong']); ?></td>
                            <td><?php echo $row_donhang['ngaythang']; ?></td>
                            <input type="hidden" name="mahang_xuly" value="<?php echo $row_donhang['mahang']; ?>">
                            <!-- <td><a class="btn btn-default btn-outline-success" href="?quanly=xoa&id=<?php echo $row_donhang['donhang_id'] ?>">Xóa</a>
                                    || <a class="btn btn-default btn-outline-success" href="?quanly=xemdonhang&mahang=<?php echo $row_donhang['mahang'] ?>">Cập nhật</a></td> -->
                        </tr>
                        <?php } ?>
                    </table>
                    <select class="form-control" name="xuly">
                        <option>---Chọn xử lý---</option>
                        <option value="1">Đã xử lý</option>
                        <option value="0">Chưa xử lý</option>
                    </select><br>
                    <input type="submit" name="capnhatdonhang" value="Cập nhật đơn hàng"
                        class="btn btn-default btn-outline-success">
            </div>
            </form>
            <?php } else { ?>
            <p>đơn hàng</p>
            <!-- <div class="col-md-4">
                    <h4>Thêm danh mục</h4>
                    <label for="">Tên danh mục</label>
                    <form action="" method="POST">
                        <input type="text" name="danhmuc" class="form-control" placeholder="Tên danh mục">
                        <input style="margin-top: 12px;" type="submit" name="themdanhmuc" class="btn btn-default btn-outline-success" value="Thêm danh mục">
                    </form>
                </div> -->
            <?php } ?>
            <div class="col-md-5">
                <h4>Liệt kê đơn hàng</h4>
                <?php
                $sql_donhang = mysqli_query($con, "SELECT * FROM tbl_sanpham,tbl_khachhang,tbl_donhang
                WHERE tbl_sanpham.sanpham_id = tbl_donhang.sanpham_id AND tbl_khachhang.khachhang_id = tbl_donhang.khachhang_id ORDER BY tbl_donhang.donhang_id ASC");
                ?>
                <table class="table table-bordered">
                    <tr>
                        <td>Thứ tự</td>
                        <td>Mã hàng</td>
                        <td>Tình trạng</td>
                        <td>Tên khách hàng</td>
                        <td>Ngày đặt</td>
                        <td>Quản lý</td>
                    </tr>
                    <?php
                    $tt = 0;
                    while ($row_donhang = mysqli_fetch_array($sql_donhang)) {
                        $tt++;
                    ?>
                    <tr>
                        <td><?php echo $tt ?></td>
                        <td><?php echo $row_donhang['mahang']; ?></td>
                        <td>
                            <?php
                                if ($row_donhang['tinhtrang'] == 0) {
                                    echo "Chưa xử lý";
                                } else {
                                    echo "Đã xử lý";
                                }
                                ?>
                        </td>
                        <td><?php echo $row_donhang['name']; ?></td>
                        <td><?php echo $row_donhang['ngaythang']; ?></td>
                        <td><a class="btn btn-default btn-outline-success"
                                href="?quanly=delete&id=<?php echo $row_donhang['donhang_id'] ?>">Xóa</a>
                            || <a class="btn btn-default btn-outline-success"
                                href="?quanly=xemdonhang&mahang=<?php echo $row_donhang['mahang'] ?>">Xem chi tiết</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>

</body>

</html>