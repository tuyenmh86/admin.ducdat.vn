<?php
$title="Vip Member";
include "header.php";
if ($admin["cap"]>=3) {
        redirect_to();
    }   
?>
    <body>
        <?php
         include "menu.php";
        ?>

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                                    <li class="breadcrumb-item"><a href="#">Thêm mới</a></li>
                                </ol>
                            </div>
                            <h4 class="page-title">Khách hàng thân thiết (Vip Member <i class="fas fa-chess-queen"></i>)</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->
                <form method="post" enctype="multipart/form-data">  

                <div class=" card-box row">
                        <div class="col-12">
                             <h4 class="m-t-0 header-title">Thông tin </h4>
                            <p class="text-muted font-14 m-b-30">
                                Khu vực dành cho khách hàng thân thiết, những khách là đối tác thường xuyên.
                                <br>
                                Mục đích để phân loại và tổng hợp các đơn hàng theo kì của khách hàng.
                            </p>
                            <a href="addkh.php" class="red"><b>Thêm mới <?=$vipmember?></b></a>
                        </div>
                        <?php include "inc/module_vip.php"?>
                </div> <!-- end cart box -->
                </form>                 
                    <?php
                     if(isset($_GET["view"])&& filter_var($_GET['view'], FILTER_VALIDATE_INT, array('min_range' => 1))){
                        $data=get_file(" where file.idkh=".$_GET["view"]);
                        if(count($data) > 0){
                        ?>
                        <form method="post" action="action.php?action=tt">
                        <div id="tong" class="card-box row">
                        <div><h4>Các đơn hàng của khách hàng : <?=$data[0]["vip"]?> </h4> </div> 
                            <?=isset($_GET["tt"])?'<input class="btn btn-info btn-md" type="submit" name="" value="Thanh toán hàng loạt">':""?>
                            <div class="dhdate">
                                <?php foreach ($data as $k => $v): ?>
                                <?php  include "inc/div_admin.php"; ?>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </form>
                    <?php }}?>
            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->
        <?php include "footer.php";?>        
    </body>
</html>