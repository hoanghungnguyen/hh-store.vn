<div class="ads-grid py-sm-5 py-4">
    <div class="container py-xl-4 py-lg-2">
        <!-- tittle heading -->
        <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
            <?php echo "Xem đơn hàng"; ?>
        </h3>
        <!-- //tittle heading -->
        <div class="row">
            <div class="agileinfo-ads-display col-lg-9">
                <div class="wrapper">
                    <!-- first section -->
                    <div class="product-sec1 px-sm-4 px-3 py-sm-5 py-3 mb-4">
                        <div class="row">
                            <?php
                            if (isset($_SESSION['dangnhap_login'])) {
                                echo "Xem đơn hàng : " . $_SESSION['dangnhap_login'] . "";
                            }
                            ?>
                            <div class="col-md-12">
                                <?php
                                if (isset($_GET['khachhang'])) {
                                    $id_khachhang = $_GET['khachhang'];
                                } else {
                                    $id_khachhang = '';
                                }
                                $sql_select = mysqli_query($con, "SELECT * FROM tbl_giaodich WHERE tbl_giaodich.khachhang_id='$id_khachhang' GROUP BY tbl_giaodich.magiaodich");

                                ?>
                                <table class="table table-bordered">
                                    <tr>
                                        <td>Thứ tự</td>
                                        <td>Mã giao dịch</td>
                                        <td>Ngày đặt</td>
                                    </tr>
                                    <?php
                                    $tt = 0;
                                    while ($row_giaodich = mysqli_fetch_array($sql_select)) {
                                        $tt++;
                                    ?>
                                        <tr>
                                            <td><?php echo $tt ?></td>
                                            <td><?php echo $row_giaodich['magiaodich']; ?></td>
                                            <td><?php echo $row_giaodich['ngaythang']; ?></td>

                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>