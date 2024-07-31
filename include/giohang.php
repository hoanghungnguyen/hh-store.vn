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
            <span>Đơn hàng của bạn</span>
        </h3>
        <!-- //tittle heading -->
        <div class="checkout-right">
            <!-- <h4 class="mb-sm-4 mb-3">Your shopping cart contains:
                <span>3 Products</span>
            </h4> -->
            <div class="table-responsive">
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
                        $sql_lay_giohang = mysqli_query($con, "SELECT * FROM `tbl_giohang` ORDER BY sanpham_id");
                        while ($row_lay_giohang = mysqli_fetch_array($sql_lay_giohang)) {
                            $sub_total = $row_lay_giohang['soluong'] * $row_lay_giohang['giasanpham'];
                            $tt++;
                            $total += $sub_total;
                        ?>
                            <tr class="rem1">
                                <td class="invert"><?php echo $tt; ?></td>
                                <td class="invert-image" style="width: 269px">
                                    <a href="single.html">
                                        <img src="images/<?php echo $row_lay_giohang['hinhanh']; ?>" alt=" " class="img-responsive">
                                    </a>
                                </td>
                                <td class="invert">
                                    <div class="quantity">
                                        <input style="text-align: center; width: 48px;" type="number" min="1" value="<?php echo $row_lay_giohang['soluong']; ?>" class="quantity-select">

                                        </input>
                                    </div>
                                </td>
                                <td class="invert"><?php echo $row_lay_giohang['tensanpham']; ?></td>
                                <td class="invert"><?php echo number_format($row_lay_giohang['giasanpham']) . "vnđ";  ?>
                                </td>
                                <td class="invert"><?php echo number_format($sub_total) . "vnđ"; ?></td>
                                <td class="invert">
                                    <div class="rem">
                                        <div class="close1"> </div>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="7">Tổng tiền: <?php echo number_format($total) . "vnđ"; ?></td>
                        </tr>
                        <tr>
                            <td colspan="7"><input type="submit" class="btn btn-success" value="Cập nhật giỏ hàng" name="capnhatgiohang"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="checkout-left">
            <div class="address_form_agile mt-sm-5 mt-4">
                <h4 class="mb-sm-4 mb-3">Thêm địa chỉ giao hàng</h4>
                <form action="payment.html" method="post" class="creditly-card-form agileinfo_form">
                    <div class="creditly-wrapper wthree, w3_agileits_wrapper">
                        <div class="information-wrapper">
                            <div class="first-row">
                                <div class="controls form-group">
                                    <input class="billing-address-name form-control" type="text" name="name" placeholder="Họ và tên" required="">
                                </div>
                                <div class="w3_agileits_card_number_grids">
                                    <div class="w3_agileits_card_number_grid_left form-group">
                                        <div class="controls">
                                            <input type="text" class="form-control" placeholder="Số điện thoại" name="number" required="">
                                        </div>
                                    </div>
                                    <div class="w3_agileits_card_number_grid_right form-group">
                                        <div class="controls">
                                            <input type="text" class="form-control" placeholder="Tỉnh/thành phố" name="landmark" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="controls form-group">
                                    <input type="text" class="form-control" placeholder="Town/City" name="city" required="">
                                </div>
                                <div class="controls form-group">
                                    <select class="option-w3ls">
                                        <option>Select Address type</option>
                                        <option>Office</option>
                                        <option>Home</option>
                                        <option>Commercial</option>

                                    </select>
                                </div>
                            </div>
                            <button class="submit check_out btn">Giao hàng đến địa chỉ này</button>
                        </div>
                    </div>
                </form>
                <div class="checkout-right-basket">
                    <a href="payment.html">Thực hiện thanh toán
                        <span class="far fa-hand-point-right"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- //checkout page -->