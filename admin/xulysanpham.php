<?php
require("../db/connect.php");
?>
<?php
if (isset($_POST['themsanpham'])) {
    $danhmuc = $_POST['danhmuc'];
    $tensanpham = $_POST['tensanpham'];
    $hinhanh = $_FILES['file']['name'];
    $chitiet = $_POST['chitiet'];
    $mota = $_POST['mota'];
    $gia = $_POST['giasanpham'];
    $giakhuyenmai = $_POST['giakhuyenmai'];
    $soluong = $_POST['soluong'];
    // $image = $_FILES['file']['name'];
    $path = '../images/';
    $image_tmp = $_FILES['file']['tmp_name'];

    $sql_themsanpham = mysqli_query($con, "INSERT INTO tbl_sanpham (category_id, sanpham_name, sanpham_chitiet, 
            sanpham_mota, sanpham_gia, sanpham_giakhuyenmai, sanpham_soluong, sanpham_image ) VALUES 
            ('$danhmuc','$tensanpham','$chitiet','$mota','$gia','$giakhuyenmai','$soluong','$hinhanh')");
    move_uploaded_file($image_tmp, $path . $hinhanh);
} elseif (isset($_POST['capnhatsanpham'])) {
    $id_update_sp = $_POST['id_update'];
    $danhmuc = $_POST['danhmuc'];
    $tensanpham = $_POST['tensanpham'];
    $hinhanh = $_FILES['file']['name'];
    $chitiet = $_POST['chitiet'];
    $mota = $_POST['mota'];
    $gia = $_POST['giasanpham'];
    $giakhuyenmai = $_POST['giakhuyenmai'];
    $soluong = $_POST['soluong'];
    $path = '../images/';
    $image_tmp = $_FILES['file']['tmp_name'];
    if ($hinhanh == '') {
        $sql_update_img = "UPDATE tbl_sanpham SET category_id='$danhmuc', sanpham_name='$tensanpham',sanpham_chitiet='$chitiet',sanpham_mota='$mota',
        sanpham_gia='$gia',sanpham_giakhuyenmai='$giakhuyenmai',sanpham_soluong='$soluong' WHERE sanpham_id = '$id_update_sp' ";
    } else {
        move_uploaded_file($image_tmp, $path . $hinhanh);
        $sql_update_img = "UPDATE tbl_sanpham SET category_id='$danhmuc', sanpham_name='$tensanpham',sanpham_chitiet='$chitiet',sanpham_mota='$mota',
        sanpham_gia='$gia',sanpham_giakhuyenmai='$giakhuyenmai',sanpham_soluong='$soluong', sanpham_image= '$hinhanh' WHERE sanpham_id = '$id_update_sp' ";
    }
    mysqli_query($con, $sql_update_img);
}
if (isset($_GET['quanly'])) {
    $xoa = $_GET['quanly'];
    $id_delete = $_GET['id'];
} else {
    $xoa = '';
}
if ($xoa == 'xoa') {
    $sql_delete = mysqli_query($con, "DELETE FROM tbl_sanpham WHERE sanpham_id = '$id_delete'");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <title>Sản phẩm</title>
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
                    <a class="nav-link " href="#">Khách hàng</a>
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
                $capnhat_sp = $_GET['quanly'];
                $id_capnhat_sp = $_GET['id'];
            } else {
                $capnhat_sp = "";
            }
            if ($capnhat_sp == 'update') {
                $sql_update_sp = mysqli_query($con, "SELECT * FROM tbl_sanpham WHERE sanpham_id = '$id_capnhat_sp'");
                $row_capnhat_sp = mysqli_fetch_array($sql_update_sp);
                $row_sp_id = $row_capnhat_sp['category_id'];
            ?>
            <div class="col-md-4">
                <h4>Cập nhật sản phẩm</h4>
                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="">Tên sản phẩm</label>
                    <input type="text" name="tensanpham" class="form-control"
                        value="<?php echo $row_capnhat_sp['sanpham_name'] ?>">
                    <input type="hidden" name="id_update" value="<?php echo $row_capnhat_sp['sanpham_id'] ?>">
                    <label for="">Hình ảnh</label>
                    <input type="file" name="file" class="form-control">
                    <img style="height: 80px; width: 80px"
                        src="../images/<?php echo $row_capnhat_sp['sanpham_image'] ?>" alt=""><br>
                    <label for="">Giá</label>
                    <input type="text" name="giasanpham" class="form-control"
                        value="<?php echo $row_capnhat_sp['sanpham_gia'] ?>">
                    <label for="">Giá khuyến mãi</label>
                    <input type="text" name="giakhuyenmai" class="form-control"
                        value="<?php echo $row_capnhat_sp['sanpham_giakhuyenmai'] ?>">
                    <label for="">Số lương</label>
                    <input type="text" name="soluong" class="form-control"
                        value="<?php echo $row_capnhat_sp['sanpham_soluong'] ?>">
                    <label for="">Mô tả</label>
                    <textarea name="mota" class="form-control"><?php echo $row_capnhat_sp['sanpham_mota'] ?></textarea>
                    <label for="">Chi tiết</label>
                    <textarea name="chitiet"
                        class="form-control"><?php echo $row_capnhat_sp['sanpham_chitiet'] ?></textarea>
                    <label for="">Danh mục</label>
                    <?php
                        $sql_danhmuc = mysqli_query($con, "SELECT * FROM tbl_category ORDER BY category_id ASC");
                        ?>
                    <select name="danhmuc" class="form-control">
                        <option value="0">---Chọn danh mục---</option>
                        <?php
                            while ($row_danhmuc = mysqli_fetch_array($sql_danhmuc)) {
                                if ($row_sp_id == $row_danhmuc['category_id']) {
                            ?>
                        <option selected value="<?php echo $row_danhmuc['category_id'] ?>">
                            <?php echo $row_danhmuc['category_name'] ?></option>
                        <?php
                                } else {
                                ?>
                        <option value="<?php echo $row_danhmuc['category_id'] ?>">
                            <?php echo $row_danhmuc['category_name'] ?></option>
                        <?php
                                }
                            }
                            ?>
                    </select>
                    <input style="margin-top: 15px;" type="submit" name="capnhatsanpham"
                        class="btn btn-default btn-outline-success " value="Cập nhật sản phẩm">
                </form>
            </div>
            <?php } else { ?>
            <div class="col-md-4">
                <h4>Thêm sản phẩm</h4>
                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="">Tên sản phẩm</label>
                    <input type="text" name="tensanpham" class="form-control" placeholder="Tên sản phẩm">
                    <label for="">Hình ảnh</label>
                    <input type="file" name="file" class="form-control">
                    <label for="">Giá</label>
                    <input type="text" name="giasanpham" class="form-control" placeholder="Giá">
                    <label for="">Giá khuyến mãi</label>
                    <input type="text" name="giakhuyenmai" class="form-control" placeholder="Giá Khuyến mãi">
                    <label for="">Số lương</label>
                    <input type="text" name="soluong" class="form-control" placeholder="Số lượng">
                    <label for="">Mô tả</label>
                    <textarea name="mota" class="form-control"></textarea>
                    <label for="">Chi tiết</label>
                    <textarea name="chitiet" class="form-control"></textarea>
                    <label for="">Danh mục</label>
                    <?php
                        $sql_danhmuc = mysqli_query($con, "SELECT * FROM tbl_category ORDER BY category_id ASC");
                        ?>
                    <select name="danhmuc" class="form-control">
                        <option value="0">---Chọn danh mục---</option>
                        <?php
                            while ($row_danhmuc = mysqli_fetch_array($sql_danhmuc)) {
                            ?>
                        <option value="<?php echo $row_danhmuc['category_id'] ?>">
                            <?php echo $row_danhmuc['category_name'] ?></option>
                        <?php } ?>
                    </select>
                    <input style="margin-top: 15px;" type="submit" name="themsanpham"
                        class="btn btn-default btn-outline-success " value="Thêm sản phẩm">
                </form>
            </div>
            <?php } ?>
            <div class="col-md-8">
                <h4>Liệt kê sản phẩm</h4>
                <?php
                $sql_select_sp = mysqli_query($con, "SELECT * FROM tbl_sanpham,tbl_category WHERE tbl_sanpham.category_id = 
                        tbl_category.category_id ORDER BY tbl_sanpham.sanpham_id ASC");
                ?>
                <table class="table table-bordered">
                    <tr>
                        <td>Thứ tự</td>
                        <td>Tên sản phẩm</td>
                        <td>Hình ảnh</td>
                        <td>Tên danh mục</td>
                        <td>Số lượng</td>
                        <td>Giá sản phẩm</td>
                        <td>Giá khuyến mãi</td>
                        <td>Quản lý</td>
                    </tr>
                    <!-- <?php
                            $tt = 0;
                            while ($row_sp = mysqli_fetch_array($sql_select_sp)) {
                                $tt++;
                            ?> -->
                    <tr>
                        <td><?php echo $tt; ?></td>
                        <td>
                            <?Php echo $row_sp['sanpham_name'] ?>
                        </td>
                        <td>
                            <img style="height: 80px; width: 80px"
                                src="../images/<?Php echo $row_sp['sanpham_image'] ?>" alt="">
                        </td>
                        <td>
                            <?Php echo $row_sp['category_name'] ?>
                        </td>
                        <td>
                            <?Php echo $row_sp['sanpham_soluong'] ?>
                        </td>
                        <td>
                            <?Php echo number_format($row_sp['sanpham_gia']) . 'vnđ' ?>
                        </td>
                        <td>
                            <?Php echo number_format($row_sp['sanpham_giakhuyenmai']) . 'vnđ' ?>
                        </td>
                        <td><a class="btn btn-default btn-outline-success"
                                href="?quanly=xoa&id=<?php echo $row_sp['sanpham_id'] ?>">Xóa</a>
                            <a class="btn btn-default btn-outline-success"
                                href="?quanly=update&id=<?php echo $row_sp['sanpham_id'] ?>">Cập nhật</a>
                        </td>
                    </tr>
                    <!-- <?php } ?> -->
                </table>
            </div>
        </div>
    </div>

</body>

</html>