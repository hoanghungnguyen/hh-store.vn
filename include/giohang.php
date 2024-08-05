<?php
if (isset($_POST['btn_giohang'])) {
    $tensanpham = $_POST['tensanpham'];
    $sanpham_id = $_POST['sanpham_id'];
    $giasanpham = $_POST['giasanpham'];
    $hinhanh = $_POST['hinhanh'];
    $soluong = $_POST['soluong'];

    $sql_select_giohang = mysqli_query($con, "SELECT * FROM tbl_giohang WHERE sanpham_id = '$sanpham_id'");
    $count = mysqli_num_rows($sql_select_giohang);
    if ($count > 0) {
        $row_sanpham = mysqli_fetch_array($sql_select_giohang);
        $soluong = $row_sanpham['soluong'] + 1;
        $sql_giohang = "UPDATE tbl_giohang SET soluong = '$soluong' WHERE sanpham_id = '$sanpham_id'";
    } else {
        $soluong = $soluong;
        $sql_giohang = "INSERT INTO tbl_giohang (tensanpham, sanpham_id, giasanpham, hinhanh, soluong) values ('$tensanpham','$sanpham_id','$giasanpham','$hinhanh','$soluong')";
    }
    $insert_row = mysqli_query($con, $sql_giohang);
    if ($sql_giohang == 0) {
        header("location:index.php?quanly=chitietsp&id=" . $sanpham_id);
    }
} elseif (isset($_POST['capnhatgiohang'])) {
    for ($i = 0; $i < count($_POST['product_id']); $i++) {
        $sanpham_id = $_POST['product_id'][$i];
        $soluong = $_POST['soluong'][$i];
        if ($soluong <= 0) {
            $sql_delete = mysqli_query($con, "DELETE FROM tbl_giohang WHERE sanpham_id = '$sanpham_id'");
        } else {
            $sql_update = mysqli_query($con, "UPDATE tbl_giohang SET soluong = '$soluong' WHERE sanpham_id = '$sanpham_id'");
        }
    }
} elseif (isset($_GET['xoa'])) {
    $id = $_GET['xoa'];
    $sql_delete = mysqli_query($con, "DELETE FROM tbl_giohang WHERE giohang_id = '$id'");
} elseif (isset($_GET['dangxuat'])) {
    $id = $_GET['dangxuat'];
    if ($id = 1) {
        unset($_SESSION['dangnhap_login']);
    }
    header('location: ?quanly=giohang');
} elseif (isset($_POST['thanhtoan'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $note = $_POST['note'];
    $gmail = $_POST['email'];
    $password = $_POST['password'];
    $giaohang = $_POST['giaohang'];
    $sql_khachhang = mysqli_query($con, "INSERT INTO tbl_khachhang (name, phone, address, note, email, giaohang, password ) VALUES('$name','$phone','$address','$note','$gmail','$giaohang', '$password') ");

    if ($sql_khachhang) {
        $sql_select_khachhang = mysqli_query($con, "SELECT * FROM tbl_khachhang ORDER BY khachhang_id DESC LIMIT 1");
        $mahang = rand(0, 9999);
        $row_khachhang = mysqli_fetch_array($sql_select_khachhang);
        $khachhang_id = $row_khachhang['khachhang_id'];
        $_SESSION['dangnhap_login'] = $row_khachhang['name'];
        $_SESSION['khachhang_id'] = $khachhang_id;
        for ($i = 0; $i < count($_POST['thanhtoan_product_id']); $i++) {
            $sanpham_id = $_POST['thanhtoan_product_id'][$i];
            $soluong = $_POST['thanhtoan_soluong'][$i];
            $sql_donhang = mysqli_query($con, "INSERT INTO tbl_donhang(sanpham_id, khachhang_id, soluong, mahang) VALUES ('$sanpham_id', '$khachhang_id','$soluong', '$mahang') ");
            $sql_giaodich = mysqli_query($con, "INSERT INTO tbl_giaodich(sanpham_id, soluong, magiaodich, khachhang_id) 
            VALUES ('$sanpham_id', '$soluong','$mahang', '$khachhang_id') ");
            $sql_delete_thanhtoan = mysqli_query($con, "DELETE FROM tbl_giohang WHERE sanpham_id = '$sanpham_id'");
        }
    }
}
?>
<div class="services-breadcrumb">
    <div class="agile_inner_breadcrumb">
        <div class="container">
            <ul class="w3_short">
                <li>
                    <a href="index.html">Trang chủ</a>
                    <i>|</i>
                </li>
                <li>Giỏ hàng</li>
            </ul>
        </div>
    </div>
</div>
<!-- //page -->
<!-- checkout page -->
<div class="privacy py-sm-5 py-4">
    <div class="container py-xl-4 py-lg-2">
        <!-- tittle heading -->
        <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
            <span>Giỏ hàng của bạn</span>
        </h3>
        <?php
        if (isset($_SESSION['dangnhap_login'])) {
            echo "<p>Xin chào: " . $_SESSION['dangnhap_login'] . "<a href='?quanly=giohang&dangxuat=1'> Đăng xuất</a></p></br>";
        } else {
            echo  '';
        }
        ?>
        <!-- //tittle heading -->
        <div class="checkout-right">
            <!-- <h4 class="mb-sm-4 mb-3">Your shopping cart contains:
                <span>3 Products</span>
            </h4> -->
            <div class="table-responsive">
                <form action="" method="POST">
                    <table class="timetable_sub">
                        <thead>
                            <tr>
                                <th>Thứ tự</th>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Tổng giá</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $tt = 0;
                            $total = 0;
                            $sql_lay_giohang = mysqli_query($con, "SELECT * FROM `tbl_giohang` ORDER BY sanpham_id DESC");
                            while ($row_lay_giohang = mysqli_fetch_array($sql_lay_giohang)) {
                                $sub_total = $row_lay_giohang['soluong'] * $row_lay_giohang['giasanpham'];
                                $tt++;
                                $total += $sub_total;
                            ?>
                            <tr class="rem1">
                                <td class="invert"><?php echo $tt; ?></td>
                                <td class="invert-image" style="width: 269px">
                                    <a href="single.html">
                                        <img src="images/<?php echo $row_lay_giohang['hinhanh']; ?>" alt=" "
                                            class="img-responsive">
                                    </a>
                                </td>
                                <td class="invert">
                                    <div class="quantity">
                                        <input type="hidden" name="product_id[]"
                                            value="<?php echo $row_lay_giohang['sanpham_id']; ?>">
                                        </input>
                                        <input style="text-align: center; width: 48px;" name="soluong[]" type="number"
                                            min="0" value="<?php echo $row_lay_giohang['soluong']; ?>"
                                            class="quantity-select">
                                        </input>
                                    </div>
                                </td>
                                <td class="invert"><?php echo $row_lay_giohang['tensanpham']; ?></td>
                                <td class="invert"><?php echo number_format($row_lay_giohang['giasanpham']) . "vnđ";  ?>
                                </td>
                                <td class="invert"><?php echo number_format($sub_total) . "vnđ"; ?></td>
                                <td class="invert">
                                    <div class="rem">
                                        <a
                                            href="?quanly=giohang&xoa=<?php echo $row_lay_giohang['giohang_id']; ?>">Xóa</a>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="7">Tổng tiền: <?php echo number_format($total) . "vnđ"; ?></td>
                            </tr>
                            <tr>
                                <td colspan="7">
                                    <input type="submit" class="btn btn-success" value="Cập nhật giỏ hàng"
                                        name="capnhatgiohang">
                                    <?php
                                    $sql_giohang_select = mysqli_query($con, "SELECT *FROM tbl_giohang");
                                    $count_giohang_select = mysqli_num_rows($sql_giohang_select);
                                    if (isset($_SESSION['dangnhap_login']) && $count_giohang_select > 0 ) {
                                    ?>
                                    <input type="submit" class="btn btn-primary" value="Thanh toán giỏ hàng"
                                        name="thanhtoangiohang">
                                    <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
        <?php
        if (empty($_SESSION['dangnhap_login'])) {
        ?>
        <div class="checkout-left">
            <div class="address_form_agile mt-sm-5 mt-4">
                <h4 class="mb-sm-4 mb-3">Thêm địa chỉ giao hàng</h4>
                <form action="" method="POST" class="creditly-card-form agileinfo_form">
                    <div class="creditly-wrapper wthree, w3_agileits_wrapper">
                        <div class="information-wrapper">
                            <div class="first-row">
                                <div class="controls form-group">
                                    <input class="billing-address-name form-control" type="text" name="name"
                                        placeholder="Họ và tên" required="">
                                </div>
                                <div class="w3_agileits_card_number_grids">
                                    <div class="w3_agileits_card_number_grid_left form-group">
                                        <div class="controls">
                                            <input type="text" class="form-control" placeholder="Số điện thoại"
                                                name="phone" required="">
                                        </div>
                                    </div>
                                    <div class="w3_agileits_card_number_grid_right form-group">
                                        <div class="controls">
                                            <input type="text" class="form-control" placeholder="Địa chỉ" name="address"
                                                required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="controls form-group">
                                    <input type="text" class="form-control" placeholder="Gmail" name="email"
                                        required="">
                                </div>
                                <div class="controls form-group">
                                    <input type="hidden" class="form-control" placeholder="Password" name="password"
                                        required="">
                                </div>
                                <div class="controls form-group">
                                    <textarea style="resize: none;" name="note" class="form-control"
                                        placeholder="Ghi chú..."></textarea>
                                </div>
                                <div class="controls form-group">
                                    <select name="giaohang" class="option-w3ls">
                                        <option>Chọn hình thức thanh toán</option>
                                        <option value="1">Thanh toán ATM</option>
                                        <option value="0">Thanh toán tại nhà</option>
                                    </select>
                                </div>
                            </div>
                            <?php
                                $sql_lay_giohang = mysqli_query($con, "SELECT * FROM `tbl_giohang` ORDER BY sanpham_id DESC");
                                while ($row_thanhtoan = mysqli_fetch_array($sql_lay_giohang)) {
                                ?>

                            <input type="hidden" name="thanhtoan_product_id[]"
                                value="<?php echo $row_thanhtoan['sanpham_id']; ?>">
                            </input>
                            <input style="text-align: center; width: 48px;" name="thanhtoan_soluong[]" type="hidden"
                                value="<?php echo $row_thanhtoan['soluong']; ?>" class="quantity-select">
                            </input>
                            <?php } ?>
                            <input type="submit" name="thanhtoan" class="submit check_out btn"
                                value="Thanh toán đến địa chỉ này" style="width: 22%;">
                        </div>
                    </div>
                </form>
                <!-- <div class="checkout-right-basket">
                    <a href="payment.html">Thực hiện thanh toán
                        <span class="far fa-hand-point-right"></span>
                    </a>
                </div> -->
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>
<!-- //checkout page -->