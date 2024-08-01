<?php
require("../db/connect.php");
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
            <div class="col-md-4">
                <h4>Thêm danh mục</h4>
                <label for="">Tên danh mục</label>
                <form action="" method="POST">
                    <input type="text" name="danhmuc" class="form-control" placeholder="Tên danh mục">
                    <input style="margin-top: 12px;" type="submit" name="themdanhmuc" class="btn btn-default" value="Thêm danh mục">
                </form>
            </div>
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
                            <td><a href="">Xóa</a> || <a href="">Cập nhật</a></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>

</body>

</html>