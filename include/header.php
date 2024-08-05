<?php
session_start();
ob_start();
if (isset($_POST['dangnhap_login'])) {
    $error = array();
    if (empty($_POST['email_login'])) {
        // $error['email_login'] = 'Tên đăng nhập không được để trống';
        $error = "<script>alert('Tên đăng nhập không được để trống');</script>";
        echo $error;
    } else {
        if (!(strlen($_POST['email_login']) >= 6 && strlen($_POST['email_login']) <= 32)) {
            // $error['email_login'] = 'Gmail yêu cầu từ 6 đến 32 ký tự';
            $error = "<script>alert('Gmail yêu cầu từ 6 đến 32 ký tự');</script>";
            echo $error;
        } else {
            $partten = "/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/";
            if (!preg_match(
                $partten,
                $_POST['email_login']
            )) {
                // $error['email_login'] = 'Gmail không đúng định dạng, vui long nhập lại !';
                $error = "<script>alert('Gmail không đúng định dạng, vui long nhập lại!');</script>";
                echo $error;
            } else {
                $email = $_POST['email_login'];
            }
        }
    }

    if (empty($_POST['password_login'])) {
        // $error['password_login'] = 'mật khẩu không được để trống';
        $error = "<script>alert('Mật khẩu không được để trống');</script>";
        echo $error;
    } else {
        if (!(strlen($_POST['password_login']) >= 6 && strlen($_POST['password_login']) <= 32)) {
            // $error['password_login'] = 'Mật khẩu yêu cầu từ 6 đến 32 ký tự';
            $error = "<script>alert('Mật khẩu yêu cầu từ 6 đến 32 ký tự');</script>";
            echo $error;
        } else {
            $partten = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/";
            if (!preg_match(
                $partten,
                $_POST['password_login']
            )) {
                // $error['password_login'] = 'Mật khẩu sai, vui lòng nhập lại';
                $error = "<script>alert('Mật khẩu sai, vui lòng nhập lại');</script>";
                echo $error;
            } else {
                $password = md5($_POST['password_login']);
            }
        }
    }

    if (empty($error)) {
        $sql_login_index = mysqli_query($con, "SELECT *FROM tbl_khachhang WHERE email = '$email' AND password = '$password' LIMIT 1");
        $count = mysqli_num_rows($sql_login_index);
        $row_login_index = mysqli_fetch_array($sql_login_index);
        if ($count > 0) {
            header("location: ?quanly=giohang");
            $_SESSION['dangnhap_login'] = $row_login_index['name'];
            $_SESSION['khachhang_id'] = $row_login_index['khachhang_id '];
        } else {
            echo "<script>alert('Tên đăng nhập hoặc mật khẩu sai');</script>";
        }
    }
    //  else {
    //     echo "Lỗi";
    // }
} elseif (isset($_POST['dangky'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $gmail = $_POST['email'];
    $password = md5($_POST['password']);
    $sql_khachhang = mysqli_query($con, "INSERT INTO tbl_khachhang (name, phone, address, email, password ) VALUES('$name','$phone','$address','$gmail', '$password') ");

    $sql_select_khachhang = mysqli_query($con, "SELECT *FROM tbl_khachhang ORDER BY khachhang_id DESC LIMIT 1");
    $row_select_khachhang = mysqli_fetch_array($sql_select_khachhang);
    $_SESSION['dangnhap_login'] = $name;
    $_SESSION['khachhang_id'] = $row_select_khachhang['khachhang_id '];
    header("location: ?quanly=giohang");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>HH-Store - Điện thoại, laptop...</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords"
        content="Electro Store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script>
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>
    <!-- //Meta tag Keywords -->

    <!-- Custom-Files -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <!-- Bootstrap css -->
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <!-- Main css -->
    <link rel="stylesheet" href="css/fontawesome-all.css">
    <!-- Font-Awesome-Icons-CSS -->
    <link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
    <!-- pop-up-box -->
    <link href="css/menu.css" rel="stylesheet" type="text/css" media="all" />
    <!-- menu style -->
    <!-- //Custom-Files -->

    <!-- web fonts -->
    <link
        href="//fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i&amp;subset=latin-ext"
        rel="stylesheet">
    <link
        href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese"
        rel="stylesheet">
    <!-- //web fonts -->

</head>

<body>
    <!-- top-header -->
    <div class="agile-main-top">
        <div class="container-fluid">
            <div class="row main-top-w3l py-2">
                <div class="col-lg-4 header-most-top">
                    <p class="text-white text-lg-left text-center">Ưu đãi & giảm giá hàng đầu
                        <i class="fas fa-shopping-cart ml-1"></i>
                    </p>
                </div>
                <div class="col-lg-8 header-right mt-lg-0 mt-2">
                    <!-- header lists -->
                    <ul>
                        <li class="text-center border-right text-white">
                            <a href="#" data-toggle="modal" data-target="#exampleModal" class="text-white">
                                <i class="fas fa-truck mr-2"></i>Theo dõi đơn hàng</a>
                        </li>
                        <li class="text-center border-right text-white">
                            <i class="fas fa-phone mr-2"></i> 0777682597
                        </li>
                        <li class="text-center border-right text-white">
                            <a href="#" data-toggle="modal" data-target="#dangnhap" name="email" class="text-white">
                                <i class="fas fa-sign-in-alt mr-2"></i> Đăng nhập </a>
                        </li>
                        <li class="text-center text-white">
                            <a href="#" data-toggle="modal" data-target="#dangky" class="text-white">
                                <i class="fas fa-sign-out-alt mr-2"></i>Đăng ký </a>
                        </li>
                    </ul>
                    <!-- //header lists -->
                </div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal(select-location) -->
    <!-- <div id="small-dialog1" class="mfp-hide">
        <div class="select-city">
            <h3>
                <i class="fas fa-map-marker"></i> Please Select Your Location
            </h3>
            <select class="list_of_cities">
                <optgroup label="Popular Cities">
                    <option selected style="display:none;color:#eee;">Select City</option>
                    <option>Birmingham</option>
                    <option>Anchorage</option>
                    <option>Phoenix</option>
                    <option>Little Rock</option>
                    <option>Los Angeles</option>
                    <option>Denver</option>
                    <option>Bridgeport</option>
                    <option>Wilmington</option>
                    <option>Jacksonville</option>
                    <option>Atlanta</option>
                    <option>Honolulu</option>
                    <option>Boise</option>
                    <option>Chicago</option>
                    <option>Indianapolis</option>
                </optgroup>


            </select>
            <div class="clearfix"></div>
        </div>
    </div> -->
    <!-- //shop locator (popup) -->

    <!-- modals -->
    <!-- log in -->
    <div class="modal fade" id="dangnhap" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center">Đăng nhập</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label class="col-form-label">Gmail</label>
                            <input type="text" class="form-control" placeholder=" " name="email_login" required="">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Mật khẩu</label>
                            <input type="password" class="form-control" placeholder=" " name="password_login"
                                required="">
                        </div>
                        <div class="right-w3l">
                            <input type="submit" class="form-control" name="dangnhap_login" value="Đăng nhập">
                        </div>
                        <!-- <div class="sub-w3l">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                                <label class="custom-control-label" for="customControlAutosizing">Remember me?</label>
                            </div>
                        </div> -->
                        <p class="text-center dont-do mt-3">Bạn chưa có tài khoản?
                            <a href="#" data-toggle="modal" data-target="#dangky">
                                Đăng ký</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- register -->
    <div class="modal fade" id="dangky" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Đăng ký</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label class="col-form-label">Họ và tên</label>
                            <input type="text" class="form-control" placeholder=" " name="name" required="">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Gmail</label>
                            <input type="email" class="form-control" placeholder=" " name="email" required="">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Mật khẩu</label>
                            <input type="password" class="form-control" placeholder=" " name="password" id="password1"
                                required="">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Số điện thoại</label>
                            <input type="text" class="form-control" placeholder=" " name="phone" required="">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Địa chỉ</label>
                            <input type="text" class="form-control" placeholder=" " name="address" required="">
                        </div>
                        <div class="right-w3l">
                            <input type="submit" class="form-control" value="Đăng ký" name="dangky">
                        </div>
                        <!-- <div class="sub-w3l">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="customControlAutosizing2">
                                <label class="custom-control-label" for="customControlAutosizing2">I Accept to the Terms
                                    & Conditions</label>
                            </div>
                        </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- //modal -->
    <!-- //top-header -->

    <!-- header-bottom-->
    <div class="header-bot">
        <div class="container">
            <div class="row header-bot_inner_wthreeinfo_header_mid">
                <!-- logo -->
                <div class="col-md-3 logo_agile">
                    <h1 class="text-center">
                        <a href="?" class="font-weight-bold font-italic">
                            <img src="images/logoshop2-remo.png" alt=" " class="img-fluid">
                        </a>
                    </h1>
                </div>
                <!-- //logo -->
                <!-- header-bot -->
                <div class="col-md-9 header mt-4 mb-md-0 mb-4">
                    <div class="row">
                        <!-- search -->
                        <div class="col-10 agileits_search">
                            <form class="form-inline" action="?quanly=timkiem" method="POST">
                                <input class="form-control mr-sm-2" type="search" placeholder="Bạn cần tìm gì..?"
                                    name="search_product" aria-label="Search" required>
                                <button class="btn my-2 my-sm-0" name="search_btn" type="submit">Tìm kiếm</button>
                            </form>
                        </div>
                        <!-- //search -->
                        <!-- cart details -->
                        <div class="col-2 top_nav_right text-center mt-sm-0 mt-2">
                            <div class="wthreecartaits wthreecartaits2 cart cart box_1">
                                <form action="#" method="post" class="last">
                                    <input type="hidden" name="cmd" value="_cart">
                                    <input type="hidden" name="display" value="1">
                                    <button class="btn w3view-cart" type="submit" name="submit" value="">
                                        <i class="fas fa-cart-arrow-down"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <!-- //cart details -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- shop locator (popup) -->
    <!-- //header-bottom -->
    <!-- navigation -->