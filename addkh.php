<?php
$title="Thêm khach hàng";
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
                        </div>
                        <div class="col-5">
                               <div class="row">
                                    <div class="col-12">
                                        <label >Tên Cty tổ chức</label>
                                        <input  class="form-control" id="date" type="text" name="tencty" placeholder="Nhập tên công ty">
                                    </div>
                                    <div class="col-4">
                                        <label >Người đại diện</label>
                                        <input class="form-control" type="text" name="ten" required="" placeholder="Nhập tên người đại diện">
                                    </div>
                                     <div class="col-4">
                                        <label >Số điện thoại</label>
                                        <input class="form-control" type="text" name="sodt" placeholder="Nhập tên số điện thoại">
                                    </div>
                                    <div class="col-4">
                                        <label >Mail</label>
                                        <input class="form-control" type="text" name="mail" placeholder="Nhập mail">
                                    </div>
                                    <div class="col-12">
                                        <label >Ảnh đại diện</label>
                                        <input class="form-control" type="text" name="avatar" placeholder="Nhập địa chỉ ảnh">
                                    </div>                                   
                                    <div class="col-12">
                                        <label >Địa chỉ</label>
                                        <input class="form-control" type="text" name="diachi"  placeholder="Nhập địa chỉ">
                                    </div>
                                    <div class="col-12">
                                        <label >Thông tin xuất hóa đơn</label>
                                        <textarea  class="form-control" name="vat" > </textarea>
                                    </div>
                                    <div class="col-12">
                                        <label >Ghi chú</label>
                                        <textarea  class="form-control" name="ghichukh" > </textarea>
                                    </div>


                                <div class="col-12 text-center">
                                        <button class="btn btn-block btn-custom waves-effect waves-light" name="submit" type="submit">Thêm mới khách hàng</button>
                                </div>
                               
                                </div> <!-- End Row -->   
                           
                        </div> <!-- End col-6 -->                       
                </div> <!-- end cart box -->
                </form>
            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->
<?php
if(isset($_POST["submit"])){
$ten=post("ten");
$tencty = post("tencty");
$diachi = post("diachi");
$mail=post("mail");
$avatar=post("avatar");
$sodt = post("sodt");
$vat = post("vat");
$ghichukh = post("ghichukh");
$q = "INSERT INTO khachhang (tenkh, tencty, diachikh, sodtkh,mailkh, avatar, vatkh, ghichukh) 
VALUES ('$ten', '$tencty', '$diachi', '$sodt','$mail','$avatar', '$vat', '$ghichukh')";
$temp=confirm_query($q);
redirect_to("vip.php");
}
?>

        <?php
            include "footer.php";
        ?>        

    </body>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#addmore").click(function(){
                $.get("inc/images.html", function(data){
                    $(".images").append(data);
                });
               
            });
            $( document ).on( "click", "body .delete", function(){
                $(this).parent().remove();
            })
        })
    </script>
</html>