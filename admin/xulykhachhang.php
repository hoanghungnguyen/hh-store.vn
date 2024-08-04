<?php
require("../db/connect.php");
?>
<?php
// if (isset($_POST['capnhatdonhang'])) {
//     $xuly = $_POST['xuly'];
//     $mahang_tt = $_POST['mahang_xuly'];
//     $sql_update_tinhtrang = mysqli_query($con, "UPDATE tbl_donhang SET tinhtrang = '$xuly' WHERE mahang = '$mahang_tt'");
// }

// 
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
// if (isset($_GET['quanly'])) {
//     $xoa = $_GET['quanly'];
//     $delete = isset($_GET['id']) ? $_GET['id'] : '';
// } else {
//     $xoa = '';
//     $delete = '';
// }

// if ($xoa == 'delete' && !empty($delete)) {
//     $sql_delete = mysqli_query($con, "DELETE FROM tbl_donhang WHERE donhang_id = '$delete'");
// }
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
            <div class="col-md-12">
                <h4>Liệt kê khách hàng</h4>
                <?php
                $sql_khachhang = mysqli_query($con, "SELECT * FROM tbl_khachhang, tbl_giaodich WHERE tbl_khachhang.khachhang_id = tbl_giaodich.khachhang_id  ORDER BY tbl_khachhang.khachhang_id DESC");
                ?>
                <table class="table table-bordered">
                    <tr>
                        <td>Thứ tự</td>
                        <td>Tên khách hàng</td>
                        <td>Số điện thoại</td>
                        <td>Gmail</td>
                        <td>Địa chỉ</td>
                        <td>Ngày mua</td>
                        <td>Quản lý</td>
                    </tr>
                    <?php
                    $tt = 0;
                    while ($row_khachhang = mysqli_fetch_array($sql_khachhang)) {
                        $tt++;
                    ?>
                    <tr>
                        <td><?php echo $tt ?></td>
                        <td><?php echo $row_khachhang['name']; ?></td>
                        <td><?php echo $row_khachhang['phone']; ?></td>
                        <td><?php echo $row_khachhang['email']; ?></td>
                        <td><?php echo $row_khachhang['address']; ?></td>
                        <td><?php echo $row_khachhang['ngaythang']; ?></td>
                        <td><a class="btn btn-default btn-outline-success"
                                href="?quanly=giaodich&khachhang=<?php echo $row_khachhang['magiaodich'] ?>">Xem giao
                                dịch</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>

</body>

</html>