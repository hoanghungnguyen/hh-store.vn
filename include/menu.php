<div class="navbar-inner">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="agileits-navi_search">
                <form action="#" method="post">
                    <select id="agileinfo-nav_search" name="agileinfo_search" class="border" required="">
                        <option value="">Tất cả danh mục</option>
                        <?php
                        $sql_category = mysqli_query($con, "SELECT * FROM `tbl_category` ORDER BY `category_id` ASC");
                        while ($row_category = mysqli_fetch_array($sql_category)) {
                        ?>
                            <option value="Televisions"><?php echo $row_category['category_name']; ?></option>
                        <?php } ?>



                    </select>
                </form>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto text-center mr-xl-5">
                    <li class="nav-item active mr-lg-2 mb-lg-0 mb-2">
                        <a class="nav-link" href="?">Trang chủ
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <?php
                    $sql_category_danhmuc = mysqli_query($con, "SELECT * FROM `tbl_category` ORDER BY `category_id` ASC");
                    while ($row_category_danhmuc = mysqli_fetch_array($sql_category_danhmuc)) {
                    ?>
                        <li class="nav-item  mr-lg-2 mb-lg-0 mb-2">
                            <a class="nav-link " href="?quanly=danhmuc&id=<?php echo $row_category_danhmuc["category_id"]; ?>" role="button">
                                <?php echo $row_category_danhmuc['category_name'];  ?>
                            </a>
                        </li>
                    <?php } ?>
                    <li class="nav-item mr-lg-2 mb-lg-0 mb-2">
                        <a class="nav-link" href="product.html">Tin tức</a>
                    </li>
                    <li class="nav-item dropdown mr-lg-2 mb-lg-0 mb-2">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Trang..
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="product.html">Product 1</a>
                            <a class="dropdown-item" href="product2.html">Product 2</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="single.html">Single Product 1</a>
                            <a class="dropdown-item" href="single2.html">Single Product 2</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="checkout.html">Checkout Page</a>
                            <a class="dropdown-item" href="payment.html">Payment Page</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.html">Liên hệ</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<!-- //navigation -->