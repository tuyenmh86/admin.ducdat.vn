<?php
include "header.php";
if ($admin["cap"]>=3) {
    echo "Not Thing";
    exit();
}
?>
    <body>
        <?php
         include "menu.php";
         if (isset($_GET["id"])):
            $id=$_GET["id"]; 
             $q1="select * from khachhang where idkh=$id";
            $r1=confirm_query($q1);
            $sl=mysqli_num_rows($r1);

            if($sl > 0){
            $kq1 = mysqli_fetch_array($r1,MYSQLI_ASSOC);
        ?>

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Chỉnh Sửa khách hàng <b><?=$kq1["tenkh"]?></h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <form method="post" enctype="multipart/form-data">

                <div class="row card-box">                          

                    <div class="text-muted font-14 col-md-12">
                        <?php if (isset($_GET["tb"])){
                            echo '<p style="color:red"> Thông báo:'.$_GET["tb"].'</p>';
                        }else{
                            echo ' Bạn có thể <a href="'.BASE_URL.'delete.php?idkh='.$kq1["idkh"].'">Xóa Vĩnh Viễn</a> thông tin khách hàng "'.$kq1["tenkh"].'", khi xóa rồi không khôi phục lại được, và mất luôn những dữ liệu liên quan.<br>Muốn chỉnh sửa hãy nhập lại dữ liệu ở ô dưới và nhấn nút "Chỉnh sửa" để hoàn tất.';
                        } ?>
                            
                      
                    </div>
                    <div class="col-md-5">
                        <div class="row">
                                    <div class="col-12">
                                        <label >Tên Cty tổ chức</label>
                                        <input  class="form-control"  type="text" name="tencty" value="<?=$kq1["tencty"]?>">
                                    </div>
                                    <div class="col-4">
                                        <label >Người đại diện</label>
                                        <input class="form-control" type="text" name="ten" value="<?=$kq1["tenkh"]?>">
                                    </div>
                                     <div class="col-4">
                                        <label >Số điện thoại</label>
                                        <input class="form-control" type="text" name="sodt" value="<?=$kq1["sodtkh"]?>">
                                    </div>
                                    <div class="col-4">
                                        <label >Mail</label>
                                        <input class="form-control" type="text" name="mail" value="<?=$kq1["mailkh"]?>">
                                    </div>
                                     <div class="col-12">
                                        <label >Ảnh đại diện</label>
                                        <input class="form-control" type="text" name="avatar" value="<?=$kq1["avatar"]?>">
                                    </div>
                                    <div class="col-12">
                                        <label >Địa chỉ</label>
                                        <input class="form-control" type="text" name="diachi"  value="<?=$kq1["diachikh"]?>">
                                    </div>
                                    <div class="col-12">
                                        <label >Thông tin xuất hóa đơn</label>
                                        <textarea  class="form-control" name="vat" ><?=$kq1["vatkh"]?></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label >Ghi chú</label>
                                        <textarea  class="form-control" name="ghichukh" > <?=$kq1["ghichukh"]?> </textarea>
                                    </div>


                                <div class="col-12 text-center">
                                        <button class="btn btn-block btn-custom waves-effect waves-light" name="submit" type="submit">Sửa đổi</button>
                                </div>
                               
                        </div> <!-- End Row -->   
                            <?php } endif ?>
                             <?php
                                if(isset($_POST["submit"])){
                                          $ten=post("ten");
                                            $tencty = post("tencty");
                                            $diachi = post("diachi");
                                            $avatar = post("avatar");
                                            $sodt = post("sodt");
                                            $mail=post("mail");
                                            $vat = post("vat");
                                            $ghichukh = post("ghichukh");
                                            $idkh=$kq1["idkh"];
                                            $q = "UPDATE khachhang SET mailkh='{$mail}', tenkh='{$ten}',avatar='{$avatar}', tencty='{$tencty}', diachikh='{$diachi}', sodtkh='{$sodt}', ghichukh='{$ghichukh}',vatkh='{$vat}' where idkh='{$idkh}'";
                                            $kq=confirm_query($q);
                                            $url="editkh.php?id=".$idkh;
                                            redirect_to($url);                                       
                                }
                            ?>
                    </div> <!-- End md6 -->
                    <div class="col-md-7">
                        <?php include "inc/module_vip.php"?>
                    </div> <!-- row card-box -->
                </div> <!-- end row -->
            </form>

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->


        <?php
            include "footer.php";
        ?>


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

             $( document ).on( "click", "body .deleteimage", function(){
                $v=$(this).attr("id");
                $v='<input name="deleteimage[]" style="display:none" value="'+$v+'">';
                $(this).parent().remove();
                $(".images").append($v);
            })

        })
    </script>
    </body>
</html>