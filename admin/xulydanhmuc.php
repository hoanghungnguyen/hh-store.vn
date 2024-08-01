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
    <div class="container">
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
                        <input type="text" name="name_danhmuc" class="form-control" placeholder="Tên danh mục" value="<?php echo $row_capnhat['category_name'] ?>">
                        <input type="hidden" name="id_danhmuc" value="<?php echo $row_capnhat['category_id'] ?>" class="form-control" placeholder="Tên danh mục">
                        <input style="margin-top: 12px;" type="submit" name="capnhatdanhmuc" class="btn btn-default" value="Cập nhật danh mục">
                    </form>
                </div>
            <?php } else { ?>
                <div class="col-md-4">
                    <h4>Thêm danh mục</h4>
                    <label for="">Tên danh mục</label>
                    <form action="" method="POST">
                        <input type="text" name="danhmuc" class="form-control" placeholder="Tên danh mục">
                        <input style="margin-top: 12px;" type="submit" name="themdanhmuc" class="btn btn-default" value="Thêm danh mục">
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
                            <td><a href="?quanly=xoa&id=<?php echo $row_danhmuc['category_id'] ?>">Xóa</a> || <a href="?quanly=update&id=<?php echo $row_danhmuc['category_id'] ?>">Cập nhật</a></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>

</body>

</html>