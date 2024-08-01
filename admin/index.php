<?php
session_start();
ob_start();
?>

<?php
require('../db/connect.php');
if (isset($_POST['btn-login'])) {
    $error = array();
    if (empty($_POST['email'])) {
        $error['email'] = 'Tên đăng nhập không được để trống';
    } else {
        if (!(strlen($_POST['email']) >= 6 && strlen($_POST['email']) <= 32)) {
            $error['email'] = 'Gmail yêu cầu từ 6 đến 32 ký tự';
        } else {
            $partten = "/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/";
            if (!preg_match($partten, $_POST['email'])) {
                $error['email'] = 'Gmail không đúng định dạng, vui long nhập lại !';
            } else {
                $email = $_POST['email'];
            }
        }
    }

    if (empty($_POST['password'])) {
        $error['password'] = 'mật khẩu không được để trống';
    } else {
        if (!(strlen($_POST['password']) >= 6 && strlen($_POST['password']) <= 32)) {
            $error['password'] = 'Mật khẩu yêu cầu từ 6 đến 32 ký tự';
        } else {
            $partten = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/";
            if (!preg_match($partten, $_POST['password'])) {
                $error['password'] = 'Mật khẩu sai, vui lòng nhập lại';
            } else {
                $password = md5($_POST['password']);
            }
        }
    }

    //kết luận
    if (empty($error)) {
        $sql_login_admin = mysqli_query($con, "SELECT *FROM tbl_admin WHERE email = '$email' AND password = '$password' LIMIT 1");
        $count = mysqli_num_rows($sql_login_admin);
        $row_login_admin = mysqli_fetch_array($sql_login_admin);
        if ($count > 0) {
            header("location: dashboard.php");
            $_SESSION['btn-login'] = $row_login_admin['admin_name'];
            $_SESSION['admin_id'] = $row_login_admin['admin_id'];
        } else {
            echo "<p>Tên đăng nhập hoặc mật khẩu sai</p>";
        }
    }
    //  else {
    //     echo "Lỗi";
    // }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <title>Admin</title>
</head>

<body>
    <h2 align="center">Đăng nhập Admin</h2>
    <div class="col-md-6">
        <div class="form-group">
            <form action="" method="POST">
                <label for="">Tài khoản</label>
                <?php $email = isset($_POST['email']) ? $_POST['email'] : ''; ?>
                <input type="text" name="email" placeholder="Vui lòng nhập gmail" class="form-control" value="<?php if (!empty('email')) echo $email; ?>">
                <p class="error"><?php if (!empty($error['email'])) echo $error['email'] ?></p>
                <label for="">Mật khẩu</label>
                <input type="password" name="password" placeholder="Nhập mật khẩu" class="form-control">
                <p class="error"><?php if (!empty($error['password'])) echo $error['password'] ?></p>
                <input style="margin-top: 18px;" type="submit" name="btn-login" class="btn btn-primary" value="Đăng nhập Admin">
            </form>
        </div>
    </div>
</body>

</html>